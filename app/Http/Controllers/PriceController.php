<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function priceListing()
    {
        return view('pricing');
    }
}
