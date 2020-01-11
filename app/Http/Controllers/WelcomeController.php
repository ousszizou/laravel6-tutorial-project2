<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class WelcomeController extends Controller
{
  public function index() {
    return view('welcome', [
      'posts' => Post::all()
    ]);
  }
}
