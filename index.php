<?php
// debemos tener instalado composer
// ejecutamos en la consola composer install
require_once 'vendor/autoload.php'; // cargamos composer y lo que hemos instalado Dotenv y stripe

/**
 * Dotenv
 *
 * Environment variables
 */
$dotenv = Dotenv\Dotenv::create(__DIR__); // inicializamos la clase para cargar archivos .env
$dotenv->load(); // cargamos el archivo .env

Stripe\Stripe::setApiKey(getenv('STRIPE_API_SECRET')); // inicializamos stripe con la api key, esta es la secret. con getenv llamamos del archivo .env la llave

try {
    $resp = Stripe\Charge::create([
        "amount" => 200000, // lea la documentacion para revisar el tema del monto https://stripe.com/docs/api/charges/create
        "currency" => "cop", // esta es la moneda de la transaccion
        "source" => "tok_1EgN0JIO8sgC13QJFrkBjNmy", // este es el token que se genera en la app
        "description" => "Test charge for frank" // esta es la descripcion que se le va a dar a la transaccion
    ]);
    var_dump($resp); // imprimimos la respuesta de la peticion
} catch (\Throwable $th) {
    var_dump($th); // imprimimos el error que se genero en caso de que falle
}
