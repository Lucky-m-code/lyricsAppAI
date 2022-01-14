<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Database Id and token.
    |--------------------------------------------------------------------------
    |
    | Here where you can define your database ID and recombee token.
    |
    */

    'database' => 'testing-123-dev',
    'token'    => '1vLdzUmVGYQ8rQk2R1sAGcbrcQC99EQhD7MUiimKj6NyQFtzXJklR1rqr4o5n7SN',

    /*
    |--------------------------------------------------------------------------
    | Recombee Timeout.
    |--------------------------------------------------------------------------
    |
    | Here where you can define recombee response timeout in milliseconds.
    |
    */

    'timeout'  => 2000,

    /*
    |--------------------------------------------------------------------------
    | Default protocol for sending requests.
    |--------------------------------------------------------------------------
    |
    | Here where you can define the default protocol for sending requests.
    |
    */

    'protocol' => 'http',

    /*
    |--------------------------------------------------------------------------
    | Default models for user and item.
    |--------------------------------------------------------------------------
    |
    | Here where you can define the default class for user and item.
    |
    */

    'user'  => app(\App\Models\User::class),
    'item'  => app(\App\Models\Lyrics::class),
];
