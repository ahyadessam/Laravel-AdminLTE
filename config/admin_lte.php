<?php

return [
  '0' => [
    'link'        => '#',
    'title'       => [
      'en'        => 'dashboard',
      'ar'        => 'اللوحة الرئيسية'
    ],
    'icon'        => '<i class="fa fa-dashboard"></i>',
    'permission'  => '',
    'submenu'     => []
  ],
  '1' => [
    'link'        => '#',
    'title'       => [
      'en'        => 'Settings',
      'ar'        => 'الإعدادات'
    ],
    'icon'        => '<i class="fa fa-cogs"></i>',
    'permission'  => '',
    'submenu'     => [
      '0' => [
        'link'        => '#',
        'title'       => [
          'en'        => 'Adminstrators',
          'ar'        => 'مديرين الموقع'
        ],
        'icon'        => '<i class="fa fa-user-secret"></i>',
        'permission'  => '', 
        'submenu'     => []
      ],
    ]
  ],
];
