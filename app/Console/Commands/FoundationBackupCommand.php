<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Process;
use ZipArchive;

class FoundationBackupCommand extends Command
{
    protected $signature = 'foundation:backup {--keep=14 : Number of recent backup archives to retain}';
    protected $description = 'Create a private database and uploaded-file backup archive';

    public function handle(): int
    {
        $connection = config('database.default');
        $database = config("database.connections.{$connection}");
        if ($connection !== 'mysql' || empty($database['database']) || empty($database['username'])) {
            $this->error('Backups currently require a configured MySQL/MariaDB connection.');
            return self::FAILURE;
        }

        $directory = storage_path('app/private/backups');
        File::ensureDirectoryExists($directory, 0700, true);
        $stamp = now()->format('Ymd-His');
        $sqlPath = $directory.DIRECTORY_SEPARATOR.'database-'.$stamp.'.sql.gz';
        $zipPath = $directory.DIRECTORY_SEPARATOR.'foundation-backup-'.$stamp.'.zip';

        $process = new Process([
            'mysqldump', '--single-transaction', '--quick', '--lock-tables=false', '--skip-comments',
            '--host=' . ($database['host'] ?? '127.0.0.1'),
            '--port=' . ($database['port'] ?? '3306'),
            '--user=' . $database['username'],
            $database['database'],
        ], base_path(), ['MYSQL_PWD' => (string) ($database['password'] ?? '')], null, 600);

        try {
            $process->run();
        } catch (\Throwable $exception) {
            $this->error('Could not start mysqldump: '.$exception->getMessage());
            return self::FAILURE;
        }

        if (!$process->isSuccessful()) {
            $this->error('Database export failed. Ensure mysqldump is installed and the database user has backup privileges.');
            $this->line($process->getErrorOutput());
            return self::FAILURE;
        }

        $compressed = gzencode($process->getOutput(), 6);
        if ($compressed === false || file_put_contents($sqlPath, $compressed, LOCK_EX) === false) {
            $this->error('Could not write the private database backup.');
            return self::FAILURE;
        }

        if (!class_exists(ZipArchive::class)) {
            $this->warn('Database backup created, but ZIP extension is unavailable; uploaded files were not archived.');
            $this->info($sqlPath);
            return self::SUCCESS;
        }

        $zip = new ZipArchive();
        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            $this->error('Database backup was created, but the ZIP archive could not be opened.');
            return self::FAILURE;
        }
        $zip->addFile($sqlPath, basename($sqlPath));
        $uploads = storage_path('app/public');
        if (is_dir($uploads)) {
            $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($uploads, \FilesystemIterator::SKIP_DOTS));
            foreach ($iterator as $file) {
                if ($file->isFile() && !$file->isLink()) {
                    $relative = 'uploads/'.substr($file->getPathname(), strlen($uploads) + 1);
                    $zip->addFile($file->getPathname(), str_replace(DIRECTORY_SEPARATOR, '/', $relative));
                }
            }
        }
        $zip->close();
        @chmod($zipPath, 0600);

        $keep = max(1, min(365, (int) $this->option('keep')));
        $archives = collect(File::glob($directory.DIRECTORY_SEPARATOR.'foundation-backup-*.zip'))->sortDesc()->values();
        foreach ($archives->slice($keep) as $old) File::delete($old);
        foreach (File::glob($directory.DIRECTORY_SEPARATOR.'database-*.sql.gz') as $oldSql) {
            if (basename($oldSql) !== basename($sqlPath) && !in_array($oldSql, $archives->take($keep)->all(), true)) File::delete($oldSql);
        }

        $this->info('Private backup created: '.$zipPath);
        return self::SUCCESS;
    }
}
