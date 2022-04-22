<?php

namespace App\Http\Controllers;

use App\Imports\ProductImport;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Vendor;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
// use Maatwebsite\Excel\Facades\Excel;
use Excel;

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
        $vendor=Vendor::all();
        return view('admin.products.add')->with('categories',$category)->with('brands',$brand)->with('vendors',$vendor);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $data['user_id'] = $request->user_id;
        $this->validate($request,[
            'title'=>'string|required',
            'sku'=>'string|required',
            'short_description'=>'string|required',
            'category'=>'required',
            'brand'=>'required',
            'price'=>'required|between:0,99.99',
            'sale_price'=>'nullable|between:0,99.99',
            'description'=>'string|required',
            'vendor_id' =>'string|required',
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
    public function show(Product $product)
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
        $vendor=Vendor::all();
        $product=Product::findOrFail($id);

        return view('admin.products.edit')->with('product',$product)->with('categories',$category)->with('brands',$brand)->with('vendors',$vendor);
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
        $product=Product::findOrFail($id);
        $this->validate($request,[
            'title'=>'string|required',
            'sku'=>'string|required',
            'short_description'=>'string|required',
            'category'=>'required',
            'brand'=>'required',
            'price'=>'required|between:0,99.99',
            'sale_price'=>'nullable|between:0,99.99',
            'description'=>'string|required',
            'vendor_id' =>'string|required',
            'status' =>'string|required',
            'images.*' => 'nullable|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $data= $request->all();

        if($request->hasfile('images'))
        {
            $oldimages=json_decode($product->images);
            foreach($oldimages as $olds){
                $imgpth = public_path().$olds;
                if(file_exists($imgpth)){
                    unlink($imgpth);
                }
            }
            

            foreach($request->file('images') as $key => $file)
            {
                $filname= time().$key;
                $imageName = $filname.'.'.$file->extension();
                $file->move(public_path('images/products'), $imageName);
                $imgs[$key] = '/images/products/'.$imageName;
            }
            $data['images'] = json_encode($imgs);
        }else{
            $data['images'] =$product->images;
        }
        
        $slug=Str::slug($request->title);
        $count=Product::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }
        $data['slug']=$slug;
    
        $status=$product->fill($data)->save();
        if($status){
            request()->session()->flash('success','Product successfully updated');
        }
        else{
            request()->session()->flash('error','Error occurred, Please try again!');
        }
        return redirect()->route('products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    { 
        $product=Product::findOrFail($id);
        $status=$product->delete();
        
        if($status){
            $oldimages=json_decode($product->images);
            foreach($oldimages as $olds){
                $imgpth = public_path().$olds;
                if(file_exists($imgpth)){
                    unlink($imgpth);
                }
            }
            request()->session()->flash('success','Product successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting product');
        }
        return redirect()->route('products');
    }

    public function importView(Request $request){
        return view('admin.products.import');
    }

    public function importCsv(Request $request)
    {
        $this->validate($request,[
            'product'=>'required',
            'product.*' => 'mimes:xls,xlsx,csv'
        ]);
        
        Excel::import(new ProductImport, $request->file('product')->store('excel'));
        return redirect()->back();
    }
    
}
