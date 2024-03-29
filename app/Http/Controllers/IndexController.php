<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Mail\OrderShipped;
use App\Page;
use App\People;
use App\Portfolio;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;


class IndexController extends Controller
{
    //

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Illuminate\Validation\ValidationException
     */
    public function execute(Request $request)
    {
        if ($request->isMethod('post')) {
            return redirect()->route('homepage');
            /*
            $rules = [
                'name' => 'required|max:255',
                'email' => 'required|email',
                'text' => 'required'
            ];
            $messages = [
                'required' => 'Поле :attribute обязательно к заполнению',
                'email' => 'Поле :attribute должно быть электронным адресом',
                'max' => 'Максимально допустимая длинна поля :attribute не болле 255 символов. ',
            ];

            $this->validate($request, $rules, $messages);

            $data = $request->except('_token');

            Mail::send(new OrderShipped($data));

            if(!Mail::failures()) {
                return redirect()->route('homepage')
                    ->with('status', 'E-mail was send');

            }
            */
        }

        $pages = Page::all();
        $portfolios = Portfolio::get(['name', 'filter', 'images']);

        $services = Service::where('id', '<', 20)->get();
        $peoples = People::take(3)->get();

        $tags = DB::table('portfolios')->distinct()->pluck('filter');
        $menu = [];
        foreach ($pages as $page) {
            $menu [] = ['title' => $page->name, 'alias' => $page->alias];
        }
        $menu [] = ['title' => 'Service', 'alias' => 'service'];
        $menu [] = ['title' => 'Portfolio', 'alias' => 'Portfolio'];
        $menu [] = ['title' => 'Team', 'alias' => 'team'];
        $menu [] = ['title' => 'Contact', 'alias' => 'contact'];

        return view('site.index', compact('menu', 'pages', 'services', 'portfolios', 'peoples', 'tags'));


    }

}
