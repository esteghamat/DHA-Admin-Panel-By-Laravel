<?php

namespace App\Http\Controllers;

use App\Portfolio;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
      $potfolios = Portfolio::all();
      return view('test.test_view')->with(['portfolios' => $potfolios]);
    }

}
