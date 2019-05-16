<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Menu\AdminMenu;
use App\Page;
use File;
use Illuminate\Http\Request;

class PagesEditController extends Controller
{
    /**
     * @param Page    $page
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Exception
     */
    public function execute(Page $page, Request $request)
    {
        //$page = Page::find($page);

        if ($request->isMethod('delete')) {

            if (!empty($page->images)) {
                $file = public_path() . '/assets/img/' . $page->images;
                if (!File::delete($file)) return redirect()->route('pages')->with('status', __('Unable to delete file '));
            }

            $page->delete();
            return redirect()->route('admin')->with('status', __('Page was deleted'));

        } else if ($request->isMethod('get')) {

            $old = $page->toArray();
            if (view()->exists('admin.pages_edit')) {

                $title = __('Edit page') . " - {$old['name']}";
                $data = $old;
                $menu = AdminMenu::get();
                return view('admin.pages_edit', compact('title', 'data', 'menu'));
            } else abort("404");

        } else if ($request->isMethod('post')) {

            $input = $request->except('_token');

            $messages = [

                'required' => 'Поле :attribute обязательно к заполнению',
                'unique' => 'Поле :attribute должно быть уникальным'

            ];

            $rules = [
                'name' => 'required|max:100',
                'alias' => 'required|max:255|unique:pages,alias,' . $input['id'], // Для исключения текущей редактируемой записи
                'text' => 'required'
            ];

            $validator = \Validator::make($input, $rules, $messages);

            // Неверные данные
            if ($validator->fails()) return redirect()->route('pagesEdit', ['page' => $input['id']])->withErrors($validator)->withInput();

            if ($request->hasFile('images')) {

                $file = $request->file('images');
                $fileName = $file->getClientOriginalName();
                $file->move(public_path() . '/assets/img', $fileName);

            } else {
                $fileName = (!empty($input['old_images'])) ? $input['old_images'] : "";
            }
            $input['images'] = $fileName;
            unset($input['old_images']);
            //$page уже заполнена так как в запросе передается параметр
            $page->fill($input);
            if ($page->update()) {
                return redirect('admin')->with('status', __('Page was updated'));
            }
        } else {
            abort("404");
        }
    }
}
