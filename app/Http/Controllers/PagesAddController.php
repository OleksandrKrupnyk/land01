<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Menu\AdminMenu;
use App\Page;
use Illuminate\Http\Request;

class PagesAddController extends Controller
{
    public function execute(Request $request)
    {
        if (!view()->exists("admin.pages_add")) abort("404");
        if ($request->isMethod('get')) {
            $title = __("New Page");
            $menu = AdminMenu::get();
            return view('admin.pages_add', compact('title', 'menu'));
        } elseif ($request->isMethod('post')) {

            $input = $request->except('_token');

            $messages = [

                'required' => 'Поле :attribute обязательно к заполнению',
                'unique' => 'Поле :attribute должно быть уникальным'

            ];

            $rules = [
                'name' => 'required|max:100',
                'alias' => 'required|unique:pages|max:255',
                'text' => 'required'
            ];

            $validator = \Validator::make($input, $rules, $messages);

            // Неверные данные
            if ($validator->fails()) return redirect()->route('pagesAdd')->withErrors($validator)->withInput();


            if ($request->hasFile('images')) {

                $file = $request->file('images');
                $fileName = $file->getClientOriginalName();
                $file->move(public_path() . '/assets/img', $fileName);

            } else {
                $fileName = "";
            }

            $input['images'] = $fileName;

            $page = new Page();

            $page->fill($input);

            if ($page->save()) {
                return redirect()->route('admin')->with('status', __('Page was add'));
            }

        } else {
            abort("404");
        }
    }
}
