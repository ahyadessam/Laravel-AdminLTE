<?php

return [
  //dashboard
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
  //general settings
  [
    'link'        => '#',
    'title'       => [
      'en'        => 'General settings',
      'ar'        => 'الإعدادات العامة'
    ],
    'icon'        => '<i class="fa fa-cogs"></i>',
    'permission'  => ['admins', 'groups'],
    'submenu'     => [
      //admins
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
      //groups
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
