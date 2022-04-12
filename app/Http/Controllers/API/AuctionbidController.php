<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Auction;
use App\Models\Product;
use App\Models\Auctionbid;
use App\Models\Vendor;
use Illuminate\Http\Request;

class AuctionbidController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'auction_id'=>'string|required',
            'product_id'=>'string|required',
            'user_id'=>'string|required',
            'bid_price'=>'required|between:0,99.99',
            'vendor_id' =>'string|required'
        ]);

        $data= $request->all();

        $bids = new Auctionbid([
          'auction_id' => $request->auction_id,
          'product_id' => $request->product_id,
          'user_id' => $request->user_id,
          'bid_price' => $request->bid_price,
          'vendor_id' => $request->vendor_id,
          'status' => 'active',
        ]);

        $bids->save();
        return response()->json([
        	'success' => true,
            'message' => 'Your Bid Successfully Sent.',
            'data' => $bids
        ], 201);
    }
}
