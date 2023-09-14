# Mytemplate
# Rese

・初期セットアップ
環境構築時に下記コマンドを実行

composer install
composer update
npm install
npm run build


・seederで登録　
下記コマンドを実行
php artisan db:seed --class AddShopsCSV

管理者の作成はdbに直接登録でのみ可能

管理者ID
username:master
email:master@master
password:master1234

店舗管理者ID
username:master_host
email:master@masterhost
password:master1234


.envファイル設定
下記を貼り付けて、stripeのキーを設定してください。
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailhog2
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

STRIPE_KEY=stripeのキーを設定
STRIPE_SECRET=stripeのキーを設定

・cronタブ設定（タスクスケジューラー起動用）
docker-compose exec php bash
crontab -e
vimのインサートモードで下記をペースト
* */1 * * * php artisan schedule:run

