- PHP8・Laravel8・mysql・Nginx・docker・phpdebug3
- 参考ブログ記事
https://maasaablog.com/development/docker/1169/

## udemy Laravel講座

## ダウンロード方法

git clone
git clone https://github.com/akira9889/umarche.git

git clone ブランチを指定してダウンロードする場合
git clone -b ブランチ名 https://github.com/akira9889/umarche.git

もしくはzipファイルでダウンロードしてください

## インストール方法

make init

appコンテナに入る(docker)
make php

composer install

cp .env.example .env
.env.exampleをコピーして．envファイルを作成

.envファイルの中の下記をご利用の環境に合わせて変更してください

DB_CONNECTION=mysql
DB_HOST=db-dl
DB_PORT=3306
DB_DATABASE=umarche
DB_USERNAME=root
DB_PASSWORD=root

php artisan migrate:fresh --seed

npm install && npm run dev

と実行してください。

最後に
php artisan key:generate
と入力してキーを生成

## インストール後の実施事項
画像のダミーデータは
public/imagesフォルダ内に
sample.jpg ~ sample6.jpgとして
保存しています。

php artisan storage:link で
storageフォルダにリンク後、

storage/app/public/productsフォルダ内に
保存すると表示されます。
(proctctsフォルダがない場合は作成してください。)

ショップの画像も表示する場合は、
storage/app/public/shopsフォルダを作成し
画像を保存してください。
