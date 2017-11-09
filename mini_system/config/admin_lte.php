<?php

return [
  '0' => [
    'link'        => '/admin',
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
      'en'        => 'General settings',
      'ar'        => 'الإعدادات العامة'
    ],
    'icon'        => '<i class="fa fa-cogs"></i>',
    'permission'  => ['admins', 'groups'],
    'submenu'     => [
      '0' => [
        'link'        => '/admin/admins',
        'title'       => [
          'en'        => 'Adminstrators',
          'ar'        => 'مديرين الموقع'
        ],
        'icon'        => '<i class="fa fa-user-secret"></i>',
        'permission'  => 'admins',
        'submenu'     => []
      ],
      '1' => [
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
