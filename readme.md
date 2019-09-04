<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

## JWT Auth API


#### 框架
 - Laravel 5.6
 
#### 環境
 - PHP >= 7.1.3
 - MySQL 5.7 
 
#### 步驟說明

- `git clone https://github.com/ChengVic/AuthJWT.git`

- `cd 專案名稱`

- `cp .env.example .env`

- `composer install`

- env 修改 mysql 連線位置

- `php artisan key:generate`

- `php artisan jwt:secret`

- `php artisan migrate`

- `php artisan db:seed` 建立測試資料, 密碼: "123456'

#### API

- POST /api/v1/auth/login (使用者登入)
```
{
    "tel": "xxxxxxx",
    "password": "123456"
}
```

- GET /api/v1/auth (查詢使用者，header 需帶 token)

- POST /api/v1/auth/logout (使用者登出，header 需帶 token)