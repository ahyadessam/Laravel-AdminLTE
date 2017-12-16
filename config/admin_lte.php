<?php

return [
  [
    'link'        => '#',
    'title'       => [
      'en'        => 'dashboard',
      'ar'        => 'اللوحة الرئيسية'
    ],
    'icon'        => '<i class="fa fa-dashboard"></i>',
    'permission'  => '',
    'submenu'     => []
  ],

  [
    'link'        => '#',
    'title'       => [
      'en'        => 'Settings',
      'ar'        => 'الإعدادات'
    ],
    'icon'        => '<i class="fa fa-cogs"></i>',
    'permission'  => '',
    'submenu'     => [
      [
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
