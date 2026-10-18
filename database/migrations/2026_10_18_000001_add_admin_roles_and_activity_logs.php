<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->string('role', 40)->default('content_manager')->after('is_active');
        });

        // Promote the oldest active administrator to owner-level access.
        // Existing accounts retain access while the remaining accounts receive
        // the least-privileged default role.
        $firstActiveAdmin = DB::table('admins')
            ->where('is_active', true)
            ->orderBy('id')
            ->value('id');

        if ($firstActiveAdmin !== null) {
            DB::table('admins')->where('id', $firstActiveAdmin)
                ->update(['role' => 'super_admin']);
        }

        Schema::create('admin_activity_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->nullable()->index();
            $table->string('action', 100)->index();
            $table->string('subject_type', 100)->nullable();
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->json('details')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();

            $table->foreign('admin_id')->references('id')->on('admins')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_activity_logs');

        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
