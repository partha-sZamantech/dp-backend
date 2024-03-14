<?php

namespace App\Http\Controllers\Backend\Bn;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use Illuminate\Http\Request;

class CounterController extends Controller
{
    public function index(){

        $counter = Counter::find(1);

        return view('backend.counter.index', compact('counter'));

    }
}
