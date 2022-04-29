<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trade;

class TradeController extends Controller
{
    public function index(){
        $trades=Trade::get();

        foreach ($trades as $key => $trade) {
            // $id = $cats;
            $apidata[$key]['_id']= $trade->_id;
            $apidata[$key]['title']= $trade->title;
            $apidata[$key]['start_date']= $trade->start_date;
            $apidata[$key]['expire_date']= $trade->expire_date;
            $apidata[$key]['city']= $trade->city;
            $apidata[$key]['entry_amount']= $trade->entry_amount;
            $apidata[$key]['address']= $trade->address;
            $apidata[$key]['description']= $trade->description;
            $apidata[$key]['image']= url($trade->image);
            $apidata[$key]['status']= $trade->status;
            $apidata[$key]['created_at']= $trade->created_at;
            $apidata[$key]['updated_at']= $trade->updated_at;
        }
        return response()->json($apidata);

    }
}
