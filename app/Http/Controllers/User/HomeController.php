<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Request;

class HomeController extends Controller
{
    public function index(){
      return 'Ok user';
    }
}
