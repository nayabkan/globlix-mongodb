<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Vendor;
use Illuminate\Support\Str;

class OpenController extends Controller
{
    public function category()
    {
        // $categories = Category::all();
        $categories=Category::where([['parent_id', '=', ''],['is_parent', '=', 1],['status', '=', 'active']])->get();
        $id='';
        $apidata=[];
        $childata=[];

        foreach ($categories as $key => $cats) {
            $apidata[$key]['_id']= $cats->_id;
            $apidata[$key]['title']= $cats->title;
            if($cats->is_parent == 1){
                $apidata[$key]['parent']= 'Yes';
            }
            $apidata[$key]['status']= $cats->status;
            $child_categor=Category::where([['parent_id', '=', $cats->_id],['status', '=', 'active']])->get();
            $child='';
            $subchild=[];
            if(!$child_categor->isEmpty()){
                foreach ($child_categor as $ke => $chcat) {
                    $childata['_id']= $chcat->_id;
                    $childata['title']= $chcat->title;
                    $childata['parent_id']= $chcat->parent_id;

                    $subchild_categor=Category::where([['parent_id', '=', $chcat->_id],['status', '=', 'active']])->get();
                    if(!$subchild_categor->isEmpty()){
                        foreach ($subchild_categor as $k => $subchcat) {
                            
                            $subchild['_id']=$subchcat->_id;
                            $subchild['title']= $subchcat->title;
                            $subchild['parent_id']= $subchcat->parent_id;
                        }
                        $childata['sub_child']=$subchild;
                    }
                    
                }

            }

            $apidata[$key]['child_cat']= $childata;
        }

        
        return response()->json($apidata);
    }

    public function brands()
    {
        $brands=Brand::where([['status', '=', 'active']])->get();
       
        foreach ($brands as $key => $brand) {
            // $id = $cats;
            $apidata[$key]['_id']= $brand->_id;
            $apidata[$key]['title']= $brand->title;
        }

        
        return response()->json($apidata);
    }

    public function vendors()
    {
        $vendors=Vendor::where([['status', '=', 'active']])->get();
       
        foreach ($vendors as $key => $vend) {
            // $id = $cats;
            $apidata[$key]['_id']= $vend->_id;
            $apidata[$key]['title']= $vend->firstname.' '.$vend->lastname;
        }

        
        return response()->json($apidata);
    }

}
