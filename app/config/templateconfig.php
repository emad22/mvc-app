<?php

return [
  'template'   =>[
      'wrapperStart' => TEMPLATE_PATH . 'wrapperStart.php',
      'header'=> TEMPLATE_PATH.'header.php',
      'navbar' => TEMPLATE_PATH .'navbar.php',
      ':view' =>':actionView',
      'wrapperEnd' => TEMPLATE_PATH . 'wrapperEnd.php'
    ],
   'header_resources' => [
        'css' => [
//            'normalize'         => CSS . 'normalize.css',
//            'fawsome'           => CSS . 'fawsome.min.css',
//            'gicons'            => CSS . 'googleicons.css',
//            'main'              => CSS . 'mainar.css'
        ],
        'js' => [
//            'modernizr'         => JS . 'vendor/modernizr-2.8.3.min.js'
        ]
    ],
    'footer_resources' => [
//        'jquery'                => JS . 'vendor/jquery-1.12.0.min.js',
//        'helper'                => JS . 'helper.js',
//        'datatables'            => JS . 'datatables.js',
//        'main'                  => JS . 'main.js'
    ]
];

