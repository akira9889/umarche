<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComponentTestController extends Controller
{
    public function showComponent1()
    {
        $message = 'メッセージ';
        return view('test.component-test1', compact('message'));
    }

    public function showComponent2()
    {
        return view('test.component-test2');
    }
}
