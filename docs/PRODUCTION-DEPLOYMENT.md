# Production deployment and recovery runbook

This change prepares the application for deployment; it does not deploy to a live server by itself. Run these steps only on the intended hosting environment, after confirming the domain, database, SMTP credentials and maintenance window.

## Required production configuration

- Set APP_ENV=production, APP_DEBUG=false, APP_URL to the HTTPS domain, and a valid unique APP_KEY.
- Configure the production database, HTTPS, secure session cookies, and MAIL_MAILER, MAIL_HOST, MAIL_PORT, MAIL_USERNAME, MAIL_PASSWORD, MAIL_FROM_ADDRESS, and MAIL_FROM_NAME.
- Set FOUNDATION_NOTIFICATION_EMAIL to the monitored mailbox for new contact, volunteer and donation-pledge notifications.
- Configure a persistent queue worker if QUEUE_CONNECTION is changed to a queued driver.
- Never commit .env, database dumps, uploaded files, credentials or production user data to Git.

## Deployment checklist

1. Take a verified database and uploaded-file backup before deploying.
2. Fetch and inspect the reviewed release branch/commit. Confirm the intended branch has passed CI and local tests.
3. Put the application into maintenance mode with php artisan down.
4. Install production dependencies with composer install --no-dev --prefer-dist --optimize-autoloader.
5. Apply schema changes with php artisan migrate --force.
6. Ensure uploads are writable and the storage symlink exists with php artisan storage:link.
7. Rebuild caches with php artisan optimize:clear followed by php artisan config:cache, php artisan route:cache, and php artisan view:cache.
8. Restart long-running workers if used with php artisan queue:restart.
9. Run a smoke test for the public Home, Programs, Impact, Stories, Get Involved and Contact pages; admin sign-in; reports; and a test notification.
10. Bring the site back online with php artisan up. If the smoke test fails, restore the previous release and follow the recovery steps below.

The optional scripts/deploy-production.sh automates the backup and common Artisan/Composer commands on a Linux host. Review it for the hosting provider before use; it does not configure DNS, TLS certificates, SMTP accounts or hosting-level services.

## Backups

Run php artisan foundation:backup on the production host. It writes archives to storage/app/private/backups, outside the public web root. The command requires mysqldump and a MySQL/MariaDB connection; uploaded files are included when PHP's ZIP extension is available. Keep an independent off-server copy (encrypted and access-restricted) because a backup on the same host is not disaster recovery.

Suggested schedule: daily database/file backup, weekly restore verification in a separate staging environment, and retention aligned with the foundation's data-protection obligations. Monitor command exit codes and free disk space. Do not treat a successful archive creation as proof of recoverability until a restore test has succeeded.

## Recovery outline

1. Enable maintenance mode and stop writes.
2. Provision an isolated recovery database and unpack the selected archive in a private directory.
3. Decompress the database-*.sql.gz file and import it into the recovery database using the provider's secure database tools.
4. Restore the archive's uploads/ directory into storage/app/public and check ownership/permissions.
5. Point a staging copy at the restored data, run php artisan optimize:clear, and verify representative public pages, admin workflows, media and receipts.
6. Only switch production to restored data after approval and a fresh backup of the current state.

## Security notes

- Keep APP_DEBUG=false in production and restrict access to logs, backups, audit history and private uploads.
- Use a least-privileged database account and enforce HTTPS at the proxy/web server.
- Test email delivery with a controlled mailbox. Failed email attempts are logged; a successful form submission means the request was stored, not that a recipient's mail server accepted it.
- Donation forms record pledges only. A receipt is generated only after an authorised administrator verifies and marks the payment as paid. This code does not integrate a payment gateway or independently verify mobile-money/bank transactions.
