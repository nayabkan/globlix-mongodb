<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand=Brand::orderBy('_id','DESC')->get();
        return view('admin.brands.index')->with('brands',$brand);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brands.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'string|required',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data= $request->all();

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images/brands'), $imageName);
        
        $data['image'] = '/images/brands/'.$imageName;

        $slug=Str::slug($request->title);
        $count=Brand::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }
        $data['slug']=$slug;

        $status=Brand::create($data);
        if($status){
            request()->session()->flash('success','Brand successfully added');
        }
        else{
            request()->session()->flash('error','Error occurred, Please try again!');
        }
        return redirect()->route('brands.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brands=Brand::findOrFail($id);
        return view('admin.brands.edit')->with('brands',$brands);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $brands=Brand::findOrFail($id);
        $this->validate($request,[
            'title'=>'string|required',
            'image'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data= $request->all();
        if($request->image != ''){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/brands'), $imageName);
            $data['image'] = '/images/brands/'.$imageName;
            if($brands->image != "" && file_exists(public_path().$brands->image)){
                $file_path = public_path().$brands->image;
                unlink($file_path);
            }
        }else{
            $data['image']=$brands->image;
        }

        $slug=Str::slug($request->title);
        $count=Brand::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }
        $data['slug']=$slug;
    
        $status=$brands->fill($data)->save();
        if($status){
            request()->session()->flash('success','Brand successfully updated');
        }
        else{
            request()->session()->flash('error','Error occurred, Please try again!');
        }
        return redirect()->route('brands.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $brands=Brand::findOrFail($id);
        $status=$brands->delete();
        
        if($status){
            if($brands->image != ""){
                $file_path = public_path().$brands->image;
                unlink($file_path);
            }
            request()->session()->flash('success','Brand successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting brand');
        }
        return redirect()->route('brands.index');
    }
}
