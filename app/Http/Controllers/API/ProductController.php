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
    public function index(){
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
}
