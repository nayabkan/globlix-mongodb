<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Auction;
use App\Models\Category;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Support\Str;

class AuctionController extends Controller
{
    public function __construct() {
       
    }

    public function index()
    {
        $auctions = Auction::where([['status', '=', 'active']])->get();
        //$auctions=Auction::where([['parent_id', '=', ''],['is_parent', '=', 1],['status', '=', 'active']])->get();
        $id='';
        $apidata=[];
        $products=[];
        $vendors=[];
        //dd($categories);
        if(!$auctions->isEmpty()){
            foreach ($auctions as $key => $aucts) {
                $apidata[$key]['_id']= $aucts->_id;
                $apidata[$key]['start_date']= $aucts->start_date;
                $apidata[$key]['expire_date']= $aucts->expire_date;

                $aucProducts=Product::where([['_id', '=', $aucts->product_id],['status', '=', 'active']])->first();
                if($aucProducts != null){
                    $products['_id']= $aucProducts->_id;
                    $products['title']= $aucProducts->title;
                    $products['slug']= $aucProducts->slug;
                    $products['sku']= $aucProducts->sku;
                    $products['price']= $aucProducts->price;
                    $products['sale_price']= $aucProducts->sale_price;
                    $products['created_at']= $aucProducts->created_at;
                    $products['updated_at']= $aucProducts->updated_at;
    
                    $cat_images=json_decode($aucProducts->images);
                    $prodImages=[];
                    if( sizeof($cat_images) ){
                        foreach ($cat_images as $ke => $catimg) {
                            $prodImages[$ke]= url($catimg);
                        }
                        $products['images'] =$prodImages;
                    }  
                }
                $apidata[$key]['products']= $products;

                $vendorDetail=Vendor::where([['_id', '=', $aucts->vendor_id],['status', '=', 'active']])->first();
                if($vendorDetail != null){
                    $vendors['_id']= $vendorDetail->_id;
                    $vendors['email']= $vendorDetail->email;
                    $vendors['firstname']= $vendorDetail->firstname;
                    $vendors['lastname']= $vendorDetail->lastname;
                    $vendors['website']= $vendorDetail->website;
                    $vendors['companyname']= $vendorDetail->companyname;
                }
                $apidata[$key]['vendor']= $vendors;

                $apidata[$key]['created_at']= $aucts->created_at;
                $apidata[$key]['updated_at']= $aucts->updated_at;

            }
        }

        return response()->json($apidata);
    }


    public function store(Request $request)
    {
        $request->validate([
            'product_id'=>'string|required',
            'vendor_id'=>'string|required',
            'start_date'=>'required',
            'expire_date'=>'required',
        ]);

        $data= $request->all();

        $newAuction = new Auction([
          'product_id' => $request->product_id,
          'vendor_id' => $request->vendor_id,
          'start_date' => $request->start_date,
          'expire_date' => $request->expire_date,
          'status' => 'active',
        ]);

        $newAuction->save();

        return response()->json([
        	'success' => true,
            'message' => 'Auction Successfully Created.',
            'data' => $newAuction
        ], 201);
    }

    public function show(Request $request)
    {
        $id= $request->auction_id;
        $auction = Auction::findOrFail($id);
        return response()->json([
        	'success' => true,
            'data' => $auction
        ], 201);
    }

    public function update(Request $request)
    {
        $request->validate([
            'title'=>'string|required',
            'parent_id'=>'nullable'
        ]);
        
        if($request->auction_id == ''){
            return response()->json([
                'success' => false,
                'message' => 'auction id not found.',
            ], 500);
        }else{
            $id= $request->auction_id;
            $auction = Auction::findOrFail($id);

        }

        
        

        

        $category->title = $request->get('title');
        $category->parent_id = $request->get('parent_id');

        $category->save();

        return response()->json($category);
    }


}
