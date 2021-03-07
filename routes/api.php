<?php

/*O PHP possui um servidor embutido, que é invocado quando chamamos o comando php artisan serve, porém não é recomendado usa-lo, já que o propósito dele é para desenvolvimento.

Você terá que configurar um servidor WEB como o Apache ou Nginx, se o propósito for para múltiplos acessos.

Entretanto, se você fizer o comando php artisan serve --host=0.0.0.0, a aplicação estará acessível na rede pelo ip da sua máquina + a porta 8000.*/
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('register', 'api\AuthController@register');
    Route::post('login', 'api\AuthController@login');
    //Route::post('logout', 'JWTAuthController@logout');
    //Route::post('refresh', 'JWTAuthController@refresh');
    //Route::get('profile', 'JWTAuthController@profile');

});
Route::group(['middleware' => ['apiJwt']], function () {
	
});
Route::apiResource('users', 'api\UserController');
Route::apiResource('culturas', 'api\CulturaController');



