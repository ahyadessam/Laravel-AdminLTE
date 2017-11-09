# Laravel-AdminLTE
Simple and easy to use [Admin LTE](https://adminlte.io) template for laravel

# 1- Installation
1. Require the package using composer:

    ```
    composer require ahyadessam/laravel-adminlte
    ```

2. Add the service provider to the `providers` in `config/app.php`:

    ```php
    ahyadessam\AdminLTE\AdminLTEServiceProvider::class,
    ```

3. Publish the public assets:

    ```
    php artisan vendor:publish --provider="ahyadessam\AdminLTE\AdminLTEServiceProvider"
    ```

# 2- Usage
Easy to use and you will find folder `adminlte_temp` in `views` folder it's contain examples for use
just create a blade it's extends layout `@extends('adminlte_layout.admin_lte')`

# You can use the following sections (all is optional) :
- `page_title` : page title
- `css-files` : add css files to header
- `js-files` : add javascript files
- `content-header` : head of content such as H1 and breadcrumb
- `content` : for page contents
- `javascript` : to add javascript code in the footer

# Sample example for a blade template (all is optional)
```html
@extends('adminlte_layout.admin_lte')

@section('page_title')
dashboard
@endsection

@section('css-files')
<link rel="stylesheet" href="file.css">
@endsection

@section('js-files')
<script src="file.js"></script>
@endsection

@section('content-header')
<h1>
  Dashboard
  <small>Control panel</small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Dashboard</li>
</ol>
@endsection

@section('content')
<div>i'm in dashboard</div>
@endsection

@section('javascript')
<script>
alert('test');
</script>
@endsection
```

# 3- Menu
You will find menu array in `config/admin_lte.php`, you can custom it as you link.

# I have a simple system for administrators and groups permissions (mini_system)
- This is a simple system you can used it to manage your admins and permissions
- It's contain administrators and groups modules
- you will find it in this link : [mini_system](https://github.com/ahyadessam/Laravel-AdminLTE/tree/master/mini_system)

# Contact
for any question you can contact with me on twitter [@AhyadEssam](https://twitter.com/AhyadEssam), thanks
