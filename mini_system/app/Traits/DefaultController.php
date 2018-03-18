<?php

namespace App\Traits;
use Illuminate\Http\Request;
use Session;

/**
* SIMPLE LARAVEL CRUD
* Created by Ahyad Essam in 6-1-2018
* using larave collective https://laravelcollective.com/docs/master/html#installation
* { HOW TO USE }
* 1- Include my trait in your controller (use App\Traits\DefaultController;).
* 2- Use it inner class (use DefaultController;).
* 3- In your contstructor config what you need.
* 4- Mandatory configurations is ($_model, $_route_link, $_columns, $_fields).
* 5- configuration variables :-
* @param $_model (string) your model path ex. 'App\User';
* @param $_permission (string) permission name
* @param $_default_where (array) default where query will apply to all functions ex. ['user_type' => 'user'].
* @param $_order_by (string) by default 'id'.
* @param $_sort (string) by default 'DESC'.
* @param $_use_paginate (boolean) by default 'false', it for if you need pagination or data table.
* @param $_rows_per_page (integer) by default 20, how many rows in page.
* @param $_view (string) view name , default (default_view).
* @param $_title (string) title of page.
* @param $_icon (string) "font awesome" icon.
* @param $_route_link (string) resource route link.
* @param $_allow_create (boolean) by default true.
* @param $_allow_read (boolean) by default true.
* @param $_allow_update (boolean) by default true.
* @param $_allow_delete (boolean) by default true.
* @param $_columns (array) key => ['label', 'value'].
* @param $_fields (array) key => ['label', 'attributes' => [], 'class', 'type', value, 'select_data' => [],
* 'datepicker' => {true|false}, 'checkbox_data', 'new_line' => {true|false}].
* @param $_show_fields (array) additional fields you want to display it in show page.
* @param $_rules (array) validation rules.
* @param $_edit_rules (array) if you need to custom edit rules, you can type $id as string and i will replace it as a variable.
* @param $_upload_path (string) path name for upload in public folder, by default '/uploads'.
* @param $_variables_index (array) for passing variables to index view;
* @param $_variables_create (array) for passing variables to create view;
* @param $_variables_show (array) for passing variables to show view;
* @param $_variables_edit (array) for passing variables to edit view;
* -------- Thanks --------
*/

trait DefaultController {

  protected $_model           = '';
  protected $_permission      = '';
  protected $_default_where   = [];
  protected $_order_by        = 'id';
  protected $_sort            = 'DESC';
  protected $_use_paginate    = false;
  protected $_rows_per_page   = 20;

  protected $_view            = 'default_view';
  protected $_title           = 'Default';
  protected $_icon            = '<i class="fa fa-dot-circle-o"></i>';
  protected $_route_link      = '';

  protected $_allow_create    = true;
  protected $_allow_read      = true;
  protected $_allow_update    = true;
  protected $_allow_delete    = true;

  protected $_columns         = [];
  protected $_fields          = [];
  protected $_show_fields     = [];
  protected $_rules           = [];
  protected $_edit_rules      = [];
  protected $_upload_path     = '/uploads';

  protected $_variables_index = [];
  protected $_variables_create= [];
  protected $_variables_show  = [];
  protected $_variables_edit  = [];

  public function __construct(){
    if(Session::has('admin_lang')){
      \App::setLocale(Session::get('admin_lang'));
    }
  }

  public function index(){
    if(!empty($this->_permission))
      $this->_checkPerm($this->_permission);

    $title        = $this->_title;
    $icon         = $this->_icon;
    $route_link   = url($this->_route_link);
    $columns      = $this->_columns;
    $create       = $this->_allow_create;
    $read         = $this->_allow_read;
    $update       = $this->_allow_update;
    $delete       = $this->_allow_delete;
    $rows_per_page = $this->_rows_per_page;

    if($this->_use_paginate){
      if(!empty($this->_default_where)){
        $rows = $this->_model::where($this->_default_where)->orderBy($this->_order_by, $this->_sort)->paginate($this->_rows_per_page);
      }else{
        $rows = $this->_model::orderBy($this->_order_by, $this->_sort)->paginate($this->_rows_per_page);
      }

      $variables = ['rows', 'title', 'icon', 'route_link', 'columns',
        'create', 'read', 'update', 'delete'
      ];
      if(!empty($this->_variables_index)){
        extract($this->_variables_index);
        $variables = array_merge($variables, array_keys($this->_variables_index));
      }

      return view($this->_view.'.paginate', compact($variables));
    }else{
      if(!empty($this->_default_where)){
        $rows = $this->_model::where($this->_default_where)->orderBy($this->_order_by, $this->_sort)->get();
      }else{
        $rows = $this->_model::orderBy($this->_order_by, $this->_sort)->get();
      }

      $variables = ['rows', 'title', 'icon', 'route_link', 'columns',
        'create', 'read', 'update', 'delete', 'rows_per_page'
      ];
      if(!empty($this->_variables_index)){
        extract($this->_variables_index);
        $variables = array_merge($variables, array_keys($this->_variables_index));
      }

      return view($this->_view.'.index', compact($variables));
    }
  }

  public function create()
  {
    if(!$this->_allow_create)
      return $this->index();

    if(!empty($this->_permission))
      $this->_checkPerm($this->_permission);

    $title        = $this->_title;
    $icon         = $this->_icon;
    $route_link   = url($this->_route_link);
    $fields       = $this->_fields;
    $view_name    = $this->_view;

    $variables = ['title', 'icon', 'route_link', 'fields', 'view_name'];
    if(!empty($this->_variables_create)){
      extract($this->_variables_create);
      $variables = array_merge($variables, array_keys($this->_variables_create));
    }

    return view($view_name.'.create', compact($variables));
  }

  public function store(Request $request)
  {
    if(!$this->_allow_create)
      return $this->index();

    if(!empty($this->_permission))
      $this->_checkPerm($this->_permission);

    if(!empty($this->_rules)){
      $validation = $this->validate($request, $this->_rules);
    }

    $fields = [];

    $img_counter = 1;
    foreach($this->_fields As $key=>$val){
      if(isset($val['type']) && $val['type'] == 'file'){
        $fields[$key] = '';
        if($request->hasFile($key)){
          $image = $request->file($key);
          $img_name = substr($key, 0, 3).$img_counter.time().'.'.$image->getClientOriginalExtension();
          if($image->move(public_path($this->_upload_path), $img_name))
            $fields[$key] = $img_name;
        }
      }else if(isset($val['type']) && $val['type'] == 'checkbox'){
        if(!isset($request->{$key}))
          $fields[$key] = 0;
        else
          $fields[$key] = $request->{$key};
      }else if(isset($request->{$key})){
        $fields[$key] = $request->{$key};
      }
      $img_counter++;
    }

    $row = $this->_model::create($fields);

    Session::flash('success', __('adminlte.created_success'));
    return redirect(url($this->_route_link));
  }

  public function show($id)
  {
    if(!$this->_allow_read)
      return $this->index();

    if(!empty($this->_permission))
      $this->_checkPerm($this->_permission);

    if(!empty($this->_default_where)){
      $row = $this->_model::where($this->_default_where)->findOrFail($id);
    }else{
      $row = $this->_model::findOrFail($id);
    }

    $title        = $this->_title;
    $icon         = $this->_icon;
    $route_link   = url($this->_route_link);
    $fields       = array_merge($this->_fields, $this->_show_fields);
    $view_name    = $this->_view;
    $update_path  = $this->_upload_path;
    $update       = $this->_allow_update;
    $delete       = $this->_allow_delete;

    $variables = ['row', 'title', 'icon', 'route_link', 'fields', 'view_name', 'update_path', 'update', 'delete'];
    if(!empty($this->_variables_show)){
      extract($this->_variables_show);
      $variables = array_merge($variables, array_keys($this->_variables_show));
    }

    return view($view_name.'.show', compact($variables));
  }

  public function edit($id)
  {
    if(!$this->_allow_update)
      return $this->index();

    if(!empty($this->_permission))
      $this->_checkPerm($this->_permission);

    if(!empty($this->_default_where)){
      $row = $this->_model::where($this->_default_where)->findOrFail($id);
    }else{
      $row = $this->_model::findOrFail($id);
    }

    $title        = $this->_title;
    $icon         = $this->_icon;
    $route_link   = url($this->_route_link);
    $fields       = $this->_fields;
    $view_name    = $this->_view;
    $update_path  = $this->_upload_path;

    $variables = ['row', 'title', 'icon', 'route_link', 'fields', 'view_name', 'update_path'];
    if(!empty($this->_variables_edit)){
      extract($this->_variables_edit);
      $variables = array_merge($variables, array_keys($this->_variables_edit));
    }

    return view($view_name.'.edit', compact($variables));
  }

  public function update(Request $request, $id)
  {
    if(!$this->_allow_update)
      return $this->index();

    if(!empty($this->_permission))
      $this->_checkPerm($this->_permission);

    if(!empty($this->_default_where)){
      $row = $this->_model::where($this->_default_where)->findOrFail($id);
    }else{
      $row = $this->_model::findOrFail($id);
    }

    if(!empty($this->_edit_rules)){
      $validation = $this->validate($request, str_replace(['$id'], [$id], $this->_edit_rules));
    }else if(!empty($this->_rules)){
      $validation = $this->validate($request, $this->_rules);
    }

    $fields = [];

    $img_counter = 1;
    foreach($this->_fields As $key=>$val){
      if(isset($val['type']) && $val['type'] == 'file'){
        $fields[$key] = $row->{$key};
        if($request->hasFile($key)){
          $image = $request->file($key);
          $img_name = substr($key, 0, 3).$img_counter.time().'.'.$image->getClientOriginalExtension();
          if($image->move(public_path($this->_upload_path), $img_name))
            $fields[$key] = $img_name;
        }
      }else if(isset($val['type']) && $val['type'] == 'checkbox'){
        if(!isset($request->{$key}))
          $fields[$key] = 0;
        else
          $fields[$key] = $request->{$key};
      }else if(isset($request->{$key})){
        $fields[$key] = $request->{$key};
      }

      $img_counter++;
    }

    $row->update($fields);

    Session::flash('success', __('adminlte.modified_success'));
    return redirect(url($this->_route_link.'/'.$id.'/edit'));
  }

  public function destroy($id)
  {
    if(!$this->_allow_delete)
      return $this->index();

    if(!empty($this->_permission))
      $this->_checkPerm($this->_permission);

    if(!empty($this->_default_where)){
      $delete = $this->_model::where($this->_default_where)->findOrFail($id);
    }else{
      $delete = $this->_model::findOrFail($id);
    }

    $delete->delete();

    Session::flash('success', __('adminlte.del_success'));
    return redirect(url($this->_route_link));
  }
}
