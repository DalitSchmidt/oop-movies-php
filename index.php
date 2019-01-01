<?php
require_once 'Movie.class.php';

try {
    $m = new Movie('Django Unchained', '1998', 'Tarantino');
	$saved = $m->save();

    var_dump( $saved );
} catch ( InvalidArgumentException $e ) {
	echo $e->getMessage();
}