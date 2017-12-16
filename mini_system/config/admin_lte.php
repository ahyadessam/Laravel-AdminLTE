<?php

return [
  [
    'link'        => '/admin',
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
      'en'        => 'General settings',
      'ar'        => 'الإعدادات العامة'
    ],
    'icon'        => '<i class="fa fa-cogs"></i>',
    'permission'  => ['admins', 'groups'],
    'submenu'     => [
      [
        'link'        => '/admin/admins',
        'title'       => [
          'en'        => 'Adminstrators',
          'ar'        => 'مديرين الموقع'
        ],
        'icon'        => '<i class="fa fa-user-secret"></i>',
        'permission'  => 'admins',
        'submenu'     => []
      ],
      
      [
        'link'        => '/admin/groups',
        'title'       => [
          'en'        => 'Groups',
          'ar'        => 'المجموعات'
        ],
        'icon'        => '<i class="fa fa-users"></i>',
        'permission'  => 'groups',
        'submenu'     => []
      ],
    ]
  ],
];
