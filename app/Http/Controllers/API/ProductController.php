<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Admin;
use App\Models\Vendor;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function __construct() {
        // $this->middleware('assign.guard:vendor', ['except' => ['index']]);
    }

    public function index()
    {
        $products=Product::where([['status', '=', 'active']])->get();
        $apidata=[];
        $gallery=[];

        if(!$products->isEmpty()){
            foreach ($products as $key => $prods) {
                $apidata[$key]['_id']= $prods->_id;
                $apidata[$key]['title']= $prods->title;
                $apidata[$key]['slug']= $prods->slug;
                $apidata[$key]['sku']= $prods->sku;
                $apidata[$key]['price']= $prods->price;
                $apidata[$key]['sale_price']= $prods->sale_price;

                $cat_images=json_decode($prods->images);
                $prodImages=[];
                if( sizeof($cat_images) ){
                    foreach ($cat_images as $ke => $catimg) {
                        $prodImages[$ke]= url($catimg);
                    }
                    $apidata[$key]['images'] =$prodImages;
                }
                
                $apidata[$key]['created_at']= $prods->created_at;
                $apidata[$key]['updated_at']= $prods->updated_at;
            }
        }
        
        return response()->json($apidata);
    }

    public function productDetails(Request $request){
        $id= $request->product_id;
        //$childcats=Category::where([['parent_id', '=', $id],['status', '=', 'active']])->get();
        $Product=Product::where([['_id', '=', $id],['status', '=', 'active']])->first();
        $apidata=[];
        $vendors=[];
        $products=[];
        
        if($Product != null){
            $apidata['_id']= $Product->_id;
            $apidata['title']= $Product->title;
            $apidata['slug']= $Product->slug;
            $apidata['sku']= $Product->sku;
            $apidata['price']= $Product->price;
            $apidata['sale_price']= $Product->sale_price;
            $apidata['short_description']= $Product->short_description;
            $apidata['description']= $Product->description;
            $brand_name = \App\Models\Brand::where(['_id' => $Product->brand])->pluck('title')->first();
            $apidata['brand']= $brand_name;
            $category_name = \App\Models\Category::where(['_id' => $Product->category])->pluck('title')->first();
            $apidata['category']= $category_name;
            $vendorDetail=Vendor::where([['_id', '=', $Product->user_id]])->first();
            if($vendorDetail != null){
                $vendors['_id']= $vendorDetail->_id;
                $vendors['email']= $vendorDetail->email;
                $vendors['firstname']= $vendorDetail->firstname;
                $vendors['lastname']= $vendorDetail->lastname;
                $vendors['mobile']= $vendorDetail->mobile;
                $vendors['website']= $vendorDetail->website;
                $vendors['companyname']= $vendorDetail->companyname;
                $vendors['country']= $vendorDetail->country;
                $vendors['areacode']= $vendorDetail->areacode;
                $vendors['status']= $vendorDetail->status;
                
            }
            $apidata['vendor']= $vendors;
           
            $cat_images=json_decode($Product->images);
            $prodImages=[];
            if( sizeof($cat_images) ){
                foreach ($cat_images as $ke => $catimg) {
                    $prodImages[$ke]= url($catimg);
                }
                $apidata['images'] =$prodImages;
            }
            
            $apidata['created_at']= $Product->created_at;
            $apidata['updated_at']= $Product->updated_at;
        }

        return response()->json($apidata);
    }


    public function index2(){
        $products=Product::where([['status', '=', 'active']])->get();
        $id='';
        $apidata=[];
        $gallery=[];

        //dd($categories);
        foreach ($products as $key => $prods) {
            
            // $id = $cats;
            $apidata['_id']= $prods->_id;
            $apidata['title']= $prods->title;
            $apidata['slug']= $prods->slug;
            $apidata['sku']= $prods->sku;
            $apidata['short_description']= $prods->short_description;
            $apidata['brand']= $prods->brand;
            $apidata['price']= $prods->price;
            $apidata['sale_price']= $prods->sale_price;
            $apidata['category']= $prods->category;
            $apidata['description']= $prods->description;
            $apidata['status']= $prods->status;
            $apidata['created_at']= $prods->created_at;
            $apidata['updated_at']= $prods->updated_at;

            $images = json_decode($prods->images);
            if(!$images== ''){
                foreach($images as $key => $primgs){
                    $galler= url($primgs);
                    $gallery=$galler;
                }
            }
            
            $apidata['images']= $gallery;

            $vendor=Vendor::where([['_id', '=', $prods->user_id],['status', '=', 'active']])->get();
            $vendordetail=[];
            

            $apidata['vendor']= $vendordetail;
        }

        
        return response()->json($apidata);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'string|required',
            'sku'=>'string|required',
            'short_description'=>'string|required',
            'category'=>'required',
            'brand'=>'required',
            'price'=>'integer|required',
            'sale_price'=>'nullable|integer',
            'description'=>'string|required',
            'vendor_id' =>'string|required',
            'images'=>'required',
            'images.*' => 'mimes:jpeg,png,jpg,gif,svg'
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
            $images = json_encode($imgs);
        }else{
            $images ='';
        }

        $slug=Str::slug($request->title);
        $count=Product::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }
        $slug=$slug;

        $product = new Product([
          'title' => $request->title,
          'slug' => $slug,
          'sku' => $request->sku,
          'short_description' => $request->short_description,
          'category' => $request->category,
          'brand' => $request->brand,
          'sale_price' => $request->sale_price,
          'price' => $request->price,
          'description' => $request->description,
          'vendor_id' => $request->vendor_id,
          'images' => $images,
          'status' => 'active',
        ]);

        $product->save();

        return response()->json([
        	'success' => true,
            'message' => 'Product Successfully Added.',
            'data' => $product
        ], 201);
    }

    public function productTypes(){
        $featuredprod=Product::where([['is_featured', '=', 'on']])->orderBy('_id', 'desc')->take(8)->get();
        $saleproducts=Product::whereNotNull('sale_price')->where('sale_price', '<>', '')->orderBy('_id', 'desc')->take(8)->get();
        $apidata=[];
        $ftrdprods=[];
        $saleprods=[];
        $rateprods=[];
        $gallery=[];

        if(!$featuredprod->isEmpty()){
            foreach ($featuredprod as $key => $prods) {
                $ftrdprods[$key]['_id']= $prods->_id;
                $ftrdprods[$key]['title']= $prods->title;
                $ftrdprods[$key]['slug']= $prods->slug;
                $ftrdprods[$key]['sku']= $prods->sku;
                $ftrdprods[$key]['price']= $prods->price;
                $ftrdprods[$key]['sale_price']= $prods->sale_price;

                $cat_images=json_decode($prods->images);
                $prodImages=[];
                if( sizeof($cat_images) ){
                    foreach ($cat_images as $ke => $catimg) {
                        $prodImages[$ke]= url($catimg);
                    }
                    $ftrdprods[$key]['images'] =$prodImages;
                }
                
                $ftrdprods[$key]['created_at']= $prods->created_at;
                $ftrdprods[$key]['updated_at']= $prods->updated_at;
            }
        }

        if(!$saleproducts->isEmpty()){
            foreach ($saleproducts as $key => $prods) {
                $saleprods[$key]['_id']= $prods->_id;
                $saleprods[$key]['title']= $prods->title;
                $saleprods[$key]['slug']= $prods->slug;
                $saleprods[$key]['sku']= $prods->sku;
                $saleprods[$key]['price']= $prods->price;
                $saleprods[$key]['sale_price']= $prods->sale_price;

                $cat_images=json_decode($prods->images);
                $prodImages=[];
                if( sizeof($cat_images) ){
                    foreach ($cat_images as $ke => $catimg) {
                        $prodImages[$ke]= url($catimg);
                    }
                    $saleprods[$key]['images'] =$prodImages;
                }
                
                $saleprods[$key]['created_at']= $prods->created_at;
                $saleprods[$key]['updated_at']= $prods->updated_at;
            }
        }

        $apidata['featured']= $ftrdprods;
        $apidata['onsale']= $saleprods;
        $apidata['rated']= $rateprods;
        
        return response()->json($apidata);
    }

    public function productFurniture(){
        
    }

}
