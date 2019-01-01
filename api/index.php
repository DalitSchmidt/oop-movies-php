<?php
require_once 'Slim/Slim.php';

require_once dirname( __FILE__ ) . '/../Movie.class.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->group('/movie', function() use ( $app ) {
    $app->post('/', function () use ( $app ) {
        $request_body = $app->request->getBody();

        $movie = json_decode( $request_body, true );

        try {
            $m = new Movie($movie["name"], $movie["year"], $movie["author"]);

            $m->save();
		} catch ( InvalidArgumentException $e ) {
            echo $e->getMessage();
        }
    });
});

$app->run();