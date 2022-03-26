<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $product=Product::orderBy('_id','DESC')->get();
        return view('admin.products.index')->with('products',$product);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category=Category::orderBy('title','ASC')->get();
        $brand=Brand::orderBy('title','ASC')->get();
        return view('admin.products.add')->with('categories',$category)->with('brands',$brand);
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
            'sku'=>'string|required',
            'short_description'=>'string|required',
            'category'=>'required',
            'brand'=>'required',
            'price'=>'integer|required',
            'sale_price'=>'nullable|integer',
            'description'=>'string|required',
            'images'=>'required',
            'images.*' => 'mimes:jpeg,png,jpg,gif,svg'
            // 'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data= $request->all();

        if($request->hasfile('images'))
        {
            foreach($request->file('images') as $key => $file)
            {
                $filname= time().$key;
                $imageName = $filname.'.'.$file->extension();
                $file->move(public_path('images/products'), $imageName);
                $imgs[$key] = '/images/products/'.$imageName;
            }
            $data['images'] = json_encode($imgs);
        }else{
            $data['images'] ='';
        }

        $slug=Str::slug($request->title);
        $count=Product::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }
        $data['slug']=$slug;

        $status=Product::create($data);
        if($status){
            request()->session()->flash('success','Product successfully added');
        }
        else{
            request()->session()->flash('error','Error occurred, Please try again!');
        }
        return redirect()->route('products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        $category=Category::orderBy('title','ASC')->get();
        $brand=Brand::orderBy('title','ASC')->get();
        $product=Product::findOrFail($id);

        return view('admin.products.edit')->with('product',$product)->with('category',$category)->with('brands',$brand);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category=Category::findOrFail($id);
        $this->validate($request,[
            'title'=>'string|required',
            'image'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'parent_id'=>'nullable',
            'banner' => 'nullable|mimes:jpeg,jpg,png,gif,svg|max:100000',
        ]);
        $data= $request->all();
        if($request->image != ''){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/category'), $imageName);
            $data['image'] = '/images/category/'.$imageName;
            if($category->image != "" && file_exists(public_path().$category->image)){
                $file_path = public_path().$category->image;
                unlink($file_path);
            }
        }else{
            $data['image']=$category->image;
        }

        if($request->banner!= '' || $request->banner!=null){
            $catBanner = time().'.'.$request->banner->extension();
            $request->banner->move(public_path('images/category'), $catBanner);
            $data['banner'] = '/images/category/'.$catBanner;
            //dd($category->banner);
            if($category->banner != null && file_exists(public_path().$category->banner)){
                $file_path = public_path().$category->banner;
                unlink($file_path);
            }
        }else{
            $data['banner']=$category->banner;
        }

        $slug=Str::slug($request->title);
        $count=Category::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }
        $data['slug']=$slug;
        

        if($request->is_parent=='on'){
            $data['is_parent']=1;
            $data['parent_id']="";
        }else{
            $data['is_parent']=0;
        }
        //dd($data);
        // return $data;
        $status=$category->fill($data)->save();
        if($status){
            request()->session()->flash('success','Category successfully updated');
        }
        else{
            request()->session()->flash('error','Error occurred, Please try again!');
        }
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    { 
        $category=Category::findOrFail($id);
        $child_cat_id=Category::where('parent_id',$id)->pluck('_id');
        //return $child_cat_id;
        // dd($child_cat_id);
        $status=$category->delete();
        
        if($status){
            if(count($child_cat_id)>0){
                Category::whereIn('_id', $child_cat_id)->update(array('parent_id' => '', 'is_parent' =>'1'));
            }
            if($category->image != ""){
                $file_path = public_path().$category->image;
                unlink($file_path);
            }
            if($category->banner != ""){
                $file_path = public_path().$category->banner;
                unlink($file_path);
            }
            request()->session()->flash('success','Category successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting category');
        }
        return redirect()->route('category.index');
    }
}
