# How to configure this system
# ##  Warning ## take backup from your project first

1- Copy all files in the same path in your project.
2- Add this line in `kernal.php` file to `$routeMiddleware` array
  path : `app/Http/Kernel.php`
  ```php
  'userAuth' => \App\Http\Middleware\UserAuthMiddleware::class,
  ```
3- Add this function to laravel `Controller.php`
  path : `app/Http/Controllers/Controller.php`
  ```php
  public function _checkPerm($perm=''){
    if(!in_array($perm, Auth::user()->permissions)){
      echo view('admin.permission');
      exit;
    }
  }
  ```
4- Add this routes to your web routes page
  path : `routes/web.php`
  ```php
  route::get('/admin/login', "AdminController@login")->name('adminLogin');
  route::post('/admin/login', "AdminController@loginAuth")->name('adminAuth');

  Route::group(['middleware' => 'userAuth'], function(){
    Route::get('/admin', 'AdminController@dashboard');
    Route::resource('/admin/groups', 'GroupsController');
    Route::resource('/admin/admins', 'AdminController');
  });
  ```
5- Now you can go to `/admin` and login with this data
  Email : `admin@admin.com`
  Password : `123456`

# Thanks 
