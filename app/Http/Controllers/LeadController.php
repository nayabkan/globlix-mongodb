<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leads=Lead::orderBy('id','DESC')->get();
        return view('admin.leads.index')->with('leads', $leads);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.leads.add');
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

        $status=Lead::create($data);
        if($status){
            request()->session()->flash('success','Lead successfully added');
        }
        else{
            request()->session()->flash('error','Error occurred, Please try again!');
        }
        return redirect()->route('leads.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function show(Lead $lead)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function edit(Lead $lead)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lead $lead)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lead $lead)
    {
        //
    }
}
