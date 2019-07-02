<?php

namespace App\Http\Controllers;

use App\Page;

class PageController extends Controller
{
    public function execute($alias)
    {
        if (!$alias || !view()->exists('site.page')) {
            abort(404);
        }

        $page = Page::where('alias', strip_tags($alias))->first();
        $title = $page->name;

        return view('site.page', compact('page', 'title'));
    }
}



