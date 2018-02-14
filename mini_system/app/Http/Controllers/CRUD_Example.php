<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Session;
use App\Traits\DefaultController;

class CustomerController extends Controller
{
    use DefaultController;

    public function __construct(){
      $this->_model           = 'App\User';
      $this->_default_where   = ['user_type' => 'user'];
      $this->_title           = 'العملاء';
      $this->_icon            = '<i class="fa fa-user"></i>';
      $this->_route_link      = '/admin/customer';
      $this->_columns         = [
        'id'        => [
          'label'   => '#'
        ],
        'full_name' => [
          'label'   => 'الاسم',
        ],
        'mobile'    => [
          'label'   => 'الجوال',
        ],
        'gender'    => [
          'label'   => 'الجنس',
          'value'   => 'echo ($row->gender == "m")? "ذكر" : "انثى";',
        ],
        'created_at'=> [
          'label'   => 'تاريخ التسجيل',
          'value'   => 'echo $row->created_at->format("Y-m-d h:i:s a");',
        ]
      ];

      $this->_fields = [
        'user_type'   => [
          'type'        => 'hidden',
          'value'       => 'user',
        ],
        'full_name'   => [
          'label'       => 'الاسم',
          'attributes'  => ['required'],
        ],
        'email'       => [
          'label'       => 'البريد الإلكتروني',
          'attributes'  => ['required'],
        ],
        'mobile'       => [
          'label'       => 'الجوال',
          'attributes'  => ['required'],
        ],
        'gender'       => [
          'label'       => 'الجنس',
          'type'        => 'select',
          'select_data' => [
            'm'   => 'ذكر',
            'f'   => 'انثى'
          ]
        ],
        'avatar'       => [
          'label'       => 'الصورة الشخصية',
          'type'        => 'file',
        ],
        'status'       => [
          'label'       => 'الحالة',
          'type'        => 'select',
          'select_data' => [
            '1'   => 'مفعل',
            '0'   => 'غير مفعل'
          ]
        ],
      ];

      $this->_show_fields = [
        'created_at'  => [
          'label'     => 'تاريخ الانشاء',
          'value'   => 'echo $row->created_at->format("Y-m-d h:i:s a");',
        ]
      ];

      $this->_rules = [
        'user_type'   => ['required', Rule::in(['user'])],
        'full_name'   => 'required',
        'email'       => 'required|email|unique:users',
        'mobile'      => 'required|unique:users'
      ];

      $this->_edit_rules = [
        'user_type'   => ['required', Rule::in(['user'])],
        'full_name'   => 'required',
        'email'       => 'required|email|unique:users,email,$id',
        'mobile'      => 'required|unique:users,mobile,$id'
      ];
    }
}
