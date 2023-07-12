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

/*const CONFIG=[
    'db'=>[
        'HOST'=>'localhost',
        'PORT'=>'3306',
        'NAME'=>'dece5725_cathy',
        'USER'=>'dece5725_cezdigitevogue',
        'PWD'=>'Cezevogue1986@'

    ],
    'app'=>[
        'name'=>'starisland',
        'projecturl'=>'https://catherine.cezdigit.com'
    ]

];

const BASE_PATH='/';*/

