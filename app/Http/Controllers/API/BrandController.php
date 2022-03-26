<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function __construct() {
        // $this->middleware('assign.guard:vendor', ['except' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands=Brand::where([['status', '=', 'active']])->get();
       
        foreach ($brands as $key => $brand) {
            // $id = $cats;
            $apidata[$key]['_id']= $brand->_id;
            $apidata[$key]['title']= $brand->title;
            $apidata[$key]['slug']= $brand->slug;
            $apidata[$key]['image']= url($brand->image);
            $apidata[$key]['status']= $brand->status;
            $apidata[$key]['created_at']= $brand->created_at;
            $apidata[$key]['updated_at']= $brand->updated_at;
        }

        
        return response()->json($apidata);
    }
}
