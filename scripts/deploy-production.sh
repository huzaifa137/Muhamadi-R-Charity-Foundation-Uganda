#!/usr/bin/env bash
set -Eeuo pipefail

if [[ "${CONFIRM_PRODUCTION_DEPLOY-}" != "YES" ]]; then
  echo "Refusing to deploy. Set CONFIRM_PRODUCTION_DEPLOY=YES after reviewing docs/PRODUCTION-DEPLOYMENT.md."
  exit 2
fi

command -v php >/dev/null || { echo "PHP CLI is required."; exit 2; }
command -v composer >/dev/null || { echo "Composer is required."; exit 2; }
[[ -f artisan ]] || { echo "Run this script from the Laravel project root."; exit 2; }

echo "Creating a private backup before deployment..."
php artisan foundation:backup

maintenance=0
restore_online() {
  if [[ "$maintenance" == "1" ]]; then
    php artisan up || true
  fi
}
trap restore_online EXIT

php artisan down
maintenance=1
composer install --no-dev --prefer-dist --optimize-autoloader
php artisan migrate --force
php artisan storage:link
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan queue:restart

echo "Deployment commands completed. Run the smoke tests from docs/PRODUCTION-DEPLOYMENT.md."
echo "The script will now bring the site online; verify immediately after deployment."
php artisan up
maintenance=0
trap - EXIT
