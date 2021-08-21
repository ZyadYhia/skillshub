<?php

namespace App\Http\Controllers\admin;

use App\Models\Cat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class CatController extends Controller
{
    public function index()
    {
        $data['cats'] = Cat::orderBy('id', 'DESC')->paginate(10);
        return view('admin.cats.index')->with($data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:50',
        ]);
        Cat::create([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ])
        ]);
        $request->session()->flash('msg','row added successfully');

        return back();
    }
    public function update(Request $request)
    {

        $request->validate([
            'id' =>'exists:cats,id',
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:50',
        ]);
        Cat::findOrFail($request->id)->update([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ])
        ]);
        $request->session()->flash('msg','row updated successfully');
        return back();
    }
    public function delete(Request $request, Cat $cat)
    {
        try {
            $cat->delete();
            $msg = 'row deleted successfully';
        } catch (Exception $e) {
            $msg ="row can't br deleted";
        }
        $request->session()->flash('msg',$msg);
        return  back();
    }
    public function toggle(Cat $cat)
    {
        $cat->update([
            'active' => !$cat->active,
        ]);
        return back();
    }
}
