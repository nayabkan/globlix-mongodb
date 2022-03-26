<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inquary;

class InquiryController extends Controller
{ 
    public function __construct() {
        //$this->middleware('assign.guard:vendor', ['except' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inquaries = Inquary::all();
        return response()->json($inquaries);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id'=>'string|required',
            'quantity'=>'numeric|required',
            'quantity_type'=>'string|required',
            'email' => 'required|email|max:100',
            'message'=>'nullable',
            'attachment'=>'nullable',
            'user_id'=>'string|required'
        ]);

        $data= $request->all();

        $attachment = $request->get('attachment');

        $newInquary = new Inquary([
          'product_id' => $request->get('product_id'),
          'quantity' => $request->get('quantity'),
          'quantity_type' => $request->get('quantity_type'),
          'email' => $request->get('email'),
          'message' => $request->get('message'),
          'attachment' => $attachment,
          'user_id' => $request->get('user_id')
        ]);

        $newInquary->save();

        //return response()->json($newInquary);
        return response()->json([
        	'success' => true,
            'message' => 'Inquiry successfully sent to the vendor',
            'inquiry' => $newInquary
        ], 201);
    }

}
