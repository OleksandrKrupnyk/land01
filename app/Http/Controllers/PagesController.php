<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Menu\AdminMenu;
use App\Page;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function execute()
    {
        $menu = AdminMenu::get('pages');
        $pages = Page::all();
        if(!view()->exists('admin.pages')) abort('404');
        $title=__('Pages');
        return view('admin.pages',compact('pages','title','menu'));
    }
}
