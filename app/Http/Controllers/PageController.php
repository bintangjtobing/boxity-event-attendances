<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function adminMaintenance()
    {
        $content = view('page.maintenance');
        return view('admin.main', compact('content'));
    }
}
