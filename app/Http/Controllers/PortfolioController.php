<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Menu\AdminMenu;
use App\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::all();
        if(!view()->exists('admin.pages')) abort('404');
        $title = __('Portfolios');
        $menu = AdminMenu::get('portfolios');
    return view('admin.portfolios',compact('title','portfolios','menu'));
    }


    public function add(Request $request)
    {

    }

    public function edit(Portfolio $portfolio,Request $request)
    {

    }

}
