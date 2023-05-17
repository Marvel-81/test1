<?php

    $routes = array (
        'TheatresController' => array (
            'theatres/([0-9]*)' => 'main/$1',
        ),
        'HallsController' => array (
            'halls/([0-9]*)' => 'main/$1',
        ),
        'SeancesController' => array (
            'seances/([0-9]*)' => 'main/$1',
        ),
        'PlacesController' => array (
            'places/([0-9]*)' => 'main/$1',
        ),
        'MoviesController' => array (
            'movies/([0-9]*)' => 'main/$1',
        ),
        'TestController' => array (
            'test/([0-9]*)' => 'main/$1',
        ),
        'AuthController' => array(
            'auth' => 'main'
        ),
    );