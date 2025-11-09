<?php

return [

    'default' => [
        'salt' => env('HASHIDS_SALT', 'your-random-salt'),
        'length' => 8,
    ],

];
