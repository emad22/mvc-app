<?php

return [
  'template'   =>[
      'wrapperStart' => TEMPLATE_PATH . 'wrapperStart.php',
      'header'=> TEMPLATE_PATH.'header.php',
      'navbar' => TEMPLATE_PATH .'navbar.php',
      ':view' =>':actionView',
      'wrapperEnd' => TEMPLATE_PATH . 'wrapperEnd.php'
    ],
   'header_resources' =>[
        'css' => [
//            'font-awesome'               => CSS. 'bootstrap\css\bootstrap.min.css',
//            'bootstrap-rtl'              =>  CSS.'css\AdminLTE.min.css',
//            'bootstrap'                   => CSS. 'css\skins\_all-skins.min.css',
//            'bootstrap-rtl'                   => CSS. 'plugins/iCheck/flat/blue.css',
//            'AdminLTE'                   =>  CSS.'plugins/morris/morris.css',
//            'all-skins'                   => 'plugins/jvectormap/jquery-jvectormap-1.2.2.css',
//            'blue'                          =>  'plugins/datepicker/datepicker3.css',
//            'morris'                        =>  'plugins/daterangepicker/daterangepicker-bs3.css',
//            'jquery-jvectormap'                   =>  'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'
//            'main'                   => CSS . 'main' . '.css'
        ],
        'js' => [
            
        ]
    ],
   'footer_resources' =>[
//        'bootstrap'              => CSS . 'normalize.css',
//        'AdminLTE'               => CSS . 'fawsome.min.css',
//        'all-skins'              => CSS . 'googleicons.css',
    ]
];

