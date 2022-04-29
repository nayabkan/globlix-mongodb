<?php

namespace App\Http\Controllers;

use App\Models\Trade;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;

class TradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trades=Trade::orderBy('_id','DESC')->get();
        return view('admin.trades.index')->with('trades',$trades);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.trades.add');
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
            'title'=>'string|required',
            'start_date'=>'required',
            'expire_date'=>'required',
            'city'=>'string|required',
            'entry_amount'=>'required|between:0,99.99',
            'address'=>'string|required',
            'description'=>'string|required',
            'image' => 'required|mimes:jpeg,jpg,png,gif,svg',
            'image' => 'max:10240',
        ]);

        $data= $request->all();

        if($request->image!= '' || $request->image!=null){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/trades'), $imageName);
        
            $data['image'] = '/images/trades/'.$imageName;
        }else{
            $data['image']='';
        }

        $status=Trade::create($data);
        if($status){
            request()->session()->flash('success','Trade successfully created');
        }
        else{
            request()->session()->flash('error','Error occurred, Please try again!');
        }
        return redirect()->route('trades.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $trade=Trade::findOrFail($id);
        return view('admin.trades.edit')->with('trade',$trade);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $trade=Trade::findOrFail($id);
        $this->validate($request,[
            'title'=>'string|required',
            'start_date'=>'required',
            'expire_date'=>'required',
            'city'=>'string|required',
            'entry_amount'=>'required|between:0,99.99',
            'address'=>'string|required',
            'description'=>'string|required',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif,svg',
            'image' => 'max:10240',
        ]);
        $data= $request->all();
        if($request->image != '' || $request->image!=null){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/trades'), $imageName);
            $data['image'] = '/images/trades/'.$imageName;
            if($trade->image != "" && file_exists(public_path().$trade->image)){
                $file_path = public_path().$trade->image;
                unlink($file_path);
            }
        }else{
            $data['image']=$trade->image;
        }
        
        $status=$trade->fill($data)->save();
        if($status){
            request()->session()->flash('success','Trade successfully updated');
        }
        else{
            request()->session()->flash('error','Error occurred, Please try again!');
        }
        return redirect()->route('trades.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $trade=Trade::findOrFail($id);
        $status=$trade->delete();
        
        if($status){
            if($trade->image != "" && file_exists(public_path().$trade->image)){
                $file_path = public_path().$trade->image;
                unlink($file_path);
            }
            request()->session()->flash('success','Trade successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting trade');
        }
        return redirect()->route('trades.index');
    }
}
