<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function execute()
    {
        $pages = Page::all();
        if(!view()->exists('admin.pages')) abort('404');
        $title=__('Pages');
        return view('admin.pages',compact('pages','title'));
    }
}
