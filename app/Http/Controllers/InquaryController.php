<?php

namespace App\Http\Controllers;

use App\Models\Inquary;
use Illuminate\Http\Request;

class InquaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inquaries=Inquary::orderBy('id','DESC')->get();
        return view('admin.inquiry.index')->with('inquaries', $inquaries);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.inquiry.add');
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
            'vendor_name'=>'string|required',
            'vendor_id'=>'numeric|required',
            'product_name'=>'string|required',
            'product_id'=>'numeric|required',
            'description'=>'string|required',
            'quantity'=>'numeric|required',
            'price_at_vendor'=>'numeric|required',
        ]);

        $data= $request->all();

        if($request->assistance=='on'){
            $data['assistance']='Yes';
        }else{
            $data['assistance']='No';
        }

        if($request->attachment=='on'){
            $data['attachment']='Yes';
        }else{
            $data['attachment']='No';
        }

        if($request->video_call=='on'){
            $data['video_call']='Yes';
        }else{
            $data['video_call']='No';
        }

        $status=Inquary::create($data);
        if($status){
            request()->session()->flash('success','Inquiry successfully added');
        }
        else{
            request()->session()->flash('error','Error occurred, Please try again!');
        }
        return redirect()->route('inquary.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inquary  $inquary
     * @return \Illuminate\Http\Response
     */
    public function show(Inquary $inquary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inquary  $inquary
     * @return \Illuminate\Http\Response
     */
    public function edit(Inquary $inquary)
    {
        return view('admin.inquiry.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inquary  $inquary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inquary $inquary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inquary  $inquary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inquary $inquary)
    {
        //
    }
}
