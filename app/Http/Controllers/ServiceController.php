<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Menu\AdminMenu;
use App\Http\Controllers\Menu\FaIcon;
use App\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!view()->exists('admin.service')) {
            abort('404');
        }
        $services = Service::all();
        $title = __('Services');
        $menu = AdminMenu::get('services');
        return view('admin.service')
            ->with('services',$services)
            ->with('title',$title)
            ->with('menu',$menu);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!view()->exists('admin.service_add')) {
            abort('404');
        }

        $menu = AdminMenu::get();
        $title = __('Add service');
        $icons = FaIcon::getIcons();

        return view('admin.service_add',compact('menu','title','icons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'=>'required|max:255',
            'text'=>'required',
            'icon'=>'required'
        ]);

        $service = Service::create(
            $request->input()
        );

        return redirect()->route('service.index')
            ->with('status',__('Service was created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $data = $service->toArray();
        if(!view()->exists('admin.service_edit')) {
            abort('404');
        }
        $menu = AdminMenu::get();
        $title = __('Edit service');
        $icons = FaIcon::getIcons();
        return view('admin.service_edit',compact('data','menu','title','icons'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Service                  $service
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Service $service,Request $request)
    {
        $validatedData = $request->validate([
            'name'=>'required|max:255',
            'text'=>'required',
            'icon'=>'required'
        ]);
        $service->fill($validatedData);
        $service->update();
        return redirect()->route('service.index')
            ->with('status',__('Service was save'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Service::destroy($id);
        return redirect()->route('service.index')
            ->with('status',__('Service was deleted'));
    }
}
