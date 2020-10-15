## Laravel Syntax

* front render and back render

```
composer global require laravel/installer
laravel new blog
composer install 

php artisan key:generate

php artisan -V
php artisan serve

composer require laravel/ui
php artisan ui bootstrap
php artisan ui vue


npm install
npm run watch
```

## migrate

```
php artisan migrate
php artisan make:seeder UsersTableSeeder # DatabaseSeeder  call

php artisan db:seed
```

## controller 

```
php artisan make:controller PostController --resource --model=Post
```

## router

```
php artisan route:cache|clear
```

```
php artisan make:component Alert
```

## test

```
php artisan test
php artisan test --group=feature --stop-on-failure

php artisan make:factory PostFactory --model=Post
```

## auth

* Auth::check()
* 路由中间件可用于只允许通过认证的用户访问给定路由

## Telescope

```
composer require laravel/telescope --dev
php artisan telescope:install
php artisan migrate

发布公共资源
php artisan telescope:publish
```

## UI

* app_1.js:为vue
* app.js:jetbream

## 参考

* [https://xueyuanjun.com/books/laravel-tutorial](https://xueyuanjun.com/books/laravel-tutorial)
