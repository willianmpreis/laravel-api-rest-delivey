<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

## Sobre este

API REST desenvolvida para estudos do framework Laravel e utilizada como backand no estudo de outras aplicações.

<p>O Banco segue a seguinte estrutura</p>
<p align="center"><img src="https://github.com/willianmpreis/laravel-api-rest-delivey/blob/master/public/images/api-rest-delivery.png?raw=true" title="Modelo Relacional"></p>

<p>As rotas principais são:</p>
<p>
//Route::middleware('auth:api')->group(function () {
    Route::resource('categories', 'CategoryController');
    Route::resource('products', 'ProductController');
    Route::resource('clients', 'ClientController');    
    Route::resource('shoppings', 'ShoppingController');        
//});
</p>

## PASSOS

-   composer require laravel/passport
-   php artisan migrate
-   php artisan passport:install
-   Adicionar `use Laravel\Passport\HasApiTokens;` e fazer chamada em User.php
-   Adicionar `use Laravel\Passport\Passport;` e criar uma chamada para `Passport::routes();` em App\Providers\AuthServiceProvider@boot
-   Alterar o guards api driver para passport em config\auth.
