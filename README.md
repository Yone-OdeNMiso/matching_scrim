# 動作環境
PHP8.0 + MySQL5.7

# 環境構築

## .envファイル

cp .env_origin .env


## インストール

```
// october cms インストール
php artisan october:install
// october cms データベース初期構築
php artisan october:up
```

## apache設定
ローカルサーバーを構築

## .htaccess
cp .htaccess_original .htaccess

## パーミッション設定

書き込み権限
```
/storage 
```

# ディレクトリ構成

~~~
/plugins プラグイン
/themes テーマファイル
~~~


# 管理画面
http://hostname/backend
インストール初期ID&PW

# なりすましログイン
管理画面: ユーザー > ユーザー選択 > impersonate user
