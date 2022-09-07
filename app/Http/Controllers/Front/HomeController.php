<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
      return view('news.home');
    }

    public function about()
    {
      return view('news.about');
    }
}
