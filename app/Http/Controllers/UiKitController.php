<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class UiKitController extends Controller
{
    /**
     * Display UI Component Showcase page.
     */
    public function index(): View
    {
        return view('admin.pages.uikit.index');
    }
}
