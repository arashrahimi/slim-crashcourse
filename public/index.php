<?php
require '../vendor/autoload.php';

$app = new \Slim\App();

$countries = ['IRAN','USA','UK','INDIA'];


$app->get('/',function ($request,$response,$args){
    return $response->write('welcome to slim crash course');
});

$app->get('/countries',function ($request,$response,$args) use ($countries) {
   return $response->withJson($countries);
});

function startWith($countries,$substr) {
    $len = strlen($substr);
    $filterdCountries = [];
    foreach ($countries as $country) {
        if ( substr(    strtolower($country),0,$len) ==    strtolower($substr) ) {
            array_push($filterdCountries,$country);
        }
    }
    return $filterdCountries;
}

$app->get('/countries/search',function ($request,$response,$args) use($countries) {
   $term = $request->getQueryParams()['term'];
   return $response->withJson(startWith($countries,$term));
});

$app->run();