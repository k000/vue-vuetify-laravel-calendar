  
　 
　 
# Vueを使って筋トレサイトを作る
  

# 認証を使う

php artisan make:auth
→このコマンドは無くなりました。


composer require laravel/ui


php artisan ui vue --auth
　Vue scaffolding installed successfully.
　Please run "npm install && npm run dev" to compile your fresh scaffolding.
　Authentication scaffolding generated successfully.

npm install

npm run dev


これでウェルカムページに
loginとregisterが表示されるので認証機能が使えるようになりました。


  
# ツイッター認証を入れる
  
composer require laravel/socialite
  
## Servicesの追加
  
config/services.php
  
  
'twitter' => [
    'client_id' => env('TWITTER_KEY'),
    'client_secret' => env('TWITTER_SECRET'),
    'redirect' => env('TWITTER_REDIRECT_URI'),
],
  
## configの修正を行う

config/app.php

providers
Laravel\Socialite\SocialiteServiceProvider::class,

aliases
'Socialite'    => Laravel\Socialite\Facades\Socialite::class,

## envの修正

TWITTER_KEY=hoge
TWITTER_SECRET=hoge
TWITTER_REDIRECT_URI=hoge

## usersマイグレーションファイルの修正

CreateUsersTable

emailとpasswordにnullableを追加
twitterのid,avter,nicnameのカラムを追加

## DB情報を修正（ホームステードよう）

DB_DATABASE=vuekintore
DB_USERNAME=homestead
DB_PASSWORD=secret

　

## マイグレーション実行

php artisan migrate

 Migration table created successfully.
 Migrating: 2014_10_12_000000_create_users_table
 Migrated:  2014_10_12_000000_create_users_table (0.13 seconds)
 Migrating: 2014_10_12_100000_create_password_resets_table
 Migrated:  2014_10_12_100000_create_password_resets_table (0.09 seconds)
 Migrating: 2019_08_19_000000_create_failed_jobs_table
 Migrated:  2019_08_19_000000_create_failed_jobs_table (0.05 seconds)

## コントローラーの作成

php artisan make:controller Auth/TwitterController

https://pllogg.com/laravel/1320/


## ルートの設定


  
## Vue　を使う


まずはヘッダーmetaタグを入れる

<meta name="csrf-token" content="{{ csrf_token() }}">



## vuetify


npm install vuetify


## v-icon

npm install material-design-icons-iconfont -D
npm install @mdi/font -D

import 'material-design-icons-iconfont/dist/material-design-icons.css'
import '@mdi/font/css/materialdesignicons.css'




<v-toolbar-items>
    <v-btn text>Link 1</v-btn>
    <v-btn text>Link 2</v-btn>
</v-toolbar-items>






