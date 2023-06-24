<?php
//  fichier de config de l'app

session_start();

const CONFIG=[
    'db'=>[
        'HOST'=>'127.0.0.1',
        'PORT'=>'3306',
        'NAME'=>'star_island',
        'USER'=>'root',
        'PWD'=>''

    ],
    'app'=>[
        'name'=>'starisland',
        'projecturl'=>'http://127.0.0.1/starisland/'
    ]

];

const BASE_PATH='/starisland/';

