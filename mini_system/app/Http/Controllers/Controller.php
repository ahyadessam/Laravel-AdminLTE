<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(){
      date_default_timezone_set('Asia/Riyadh');
    }

    public function _checkPerm($perm=''){
      if(!in_array($perm, \Auth::user()->permissions)){
        echo view('admin.permission');
        exit;
      }
    }

    public function _config($key){
      $row = \App\Setting::where(['key' => $key])->get()->first();
      if($row)
        return $row->value;
      else
        return false;
    }

    public function _user(){
      return \App\User::find(\Auth::user()->id);
    }

    function _filter_numbers($string) {
      $newNumbers = range(0, 9);
      // 1. Persian HTML decimal
      $persianDecimal = array('&#1776;', '&#1777;', '&#1778;', '&#1779;', '&#1780;', '&#1781;', '&#1782;', '&#1783;', '&#1784;', '&#1785;');
      // 2. Arabic HTML decimal
      $arabicDecimal = array('&#1632;', '&#1633;', '&#1634;', '&#1635;', '&#1636;', '&#1637;', '&#1638;', '&#1639;', '&#1640;', '&#1641;');
      // 3. Arabic Numeric
      $arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
      // 4. Persian Numeric
      $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');

      $string =  str_replace($persianDecimal, $newNumbers, $string);
      $string =  str_replace($arabicDecimal, $newNumbers, $string);
      $string =  str_replace($arabic, $newNumbers, $string);
      return str_replace($persian, $newNumbers, $string);
    }

    function _clean($string) {
      $string = str_replace(['!', '/', '\\', 'or', 'OR', '"', "'"], '', strip_tags($string)); // Replaces all spaces with hyphens.
      return $string;
    }
}
