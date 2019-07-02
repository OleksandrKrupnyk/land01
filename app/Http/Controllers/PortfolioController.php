<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Menu\AdminMenu;
use App\Portfolio;
use Arr;
use File;
use Illuminate\Http\Request;
use Validator;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::all();
        if (!view()->exists('admin.portfolios')) abort('404');
        $title = __('Portfolios');
        $menu = AdminMenu::get('portfolios');
        return view('admin.portfolios', compact('title', 'portfolios', 'menu'));
    }


    public function add(Request $request)
    {
        if ($request->isMethod('get')) {

            if (!view()->exists('admin.portfolio_add')) abort('404');

            $filters = $this->getFiltersRange();

            $title = __("New portfolio");
            $menu = AdminMenu::get();
            return view('admin.portfolio_add', compact('title', 'menu', 'filters'));

        } elseif ($request->isMethod('post')) {
            $input = $request->except('_token');
            $rules = [
                'name' => "required|max:100",
                'filter' => "required",
                'images' => "required"
            ];

            $messages = [
                'required' => 'Поле :attribute обязательно к заполнению'
            ];

            $validator = Validator::make($input, $rules, $messages);

            // Неверные данные
            if ($validator->fails()) return redirect()->route('portfolioAdd')->withErrors($validator)->withInput();


            if ($request->hasFile('images')) {

                $file = $request->file('images');
                $fileName = $file->getClientOriginalName();
                $file->move(public_path() . '/assets/img', $fileName);

            } else {
                $fileName = '';
            }

            $input['images'] = $fileName;

            $portfolio = new Portfolio();

            $portfolio->fill($input);

            if ($portfolio->save()) {
                return redirect()->route('admin')->with('status', __('Portfolio was add'));
            }
        } else {
            abort('404');
        }

    }

    /**
     * @param Portfolio $portfolio
     * @param Request   $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     * @throws \Exception
     */
    public function edit(Portfolio $portfolio, Request $request)
    {
        if ($request->isMethod('get')) {
            if (!view()->exists('admin.portfolio_edit')) {
                abort('404');
            }

            $menu = AdminMenu::get();
            $data = $portfolio->toArray();
            $filters = $this->getFiltersRange();
            $title = __('Portfolio edit');

            return view('admin.portfolio_edit', compact('data', 'title', 'filters', 'menu'));

        } elseif ($request->isMethod('post')) {
            $input = $request->except('_token');

            $messages = [

                'required' => 'Поле :attribute обязательно к заполнению',
            ];

            $rules = [
                'name' => 'required|max:100',
                'filter' => 'required'
            ];

            $validator = Validator::make($input, $rules, $messages);

            // Неверные данные
            if ($validator->fails()) {
                return redirect()->route('portfoliosEdit', ['portfolio' => $input['id']])->withErrors($validator)->withInput();
            }

            if ($request->hasFile('images')) {

                $file = $request->file('images');
                $fileName = $file->getClientOriginalName();
                $file->move(public_path() . '/assets/img', $fileName);

            } else {
                $fileName = !empty($input['old_images']) ? $input['old_images'] : '';
            }
            $input['images'] = $fileName;
            unset($input['old_images']);
            //$portfolio уже заполнена так как в запросе передается параметр
            $portfolio->fill($input);
            if ($portfolio->update()) {
                return redirect('admin')->with('status', __('Portfolio was updated'));
            }


        } elseif ($request->isMethod('delete')) {

            if (!empty($portfolio->images)) {
                $file = public_path() . '/assets/img/' . $portfolio->images;
                if (!File::delete($file)) {
                    return redirect()->route('portfolios')->with('status', __('Unable to delete file '));
                }
            }
            $portfolio->delete();
            return redirect()->route('admin')->with('status', __('Portfolio was deleted'));
        } else {
            abort('404');
        }

    }

    private function getFiltersRange()
    {
        $filters = Portfolio::distinct()->get('filter')->toArray();
        $a = Arr::pluck($filters, 'filter');
        $filters = array_combine($a, $a);
        unset($a);
        return $filters;
    }

}
