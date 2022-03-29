<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Product;
use App\Models\Category;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuctionController extends Controller
{
    public function index() 
    {
        $auction=Auction::where('status','active')->orderBy('_id','DESC')->get();
        return view('admin.auction.index')->with('auctions',$auction);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products=Product::where('status','active')->orderBy('title','ASC')->get();
        $vendors=Vendor::where('status','active')->orderBy('title','ASC')->get();
        return view('admin.auction.add')->with('products',$products)->with('vendors',$vendors);
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
            'product_id'=>'string|required',
            'vendor_id'=>'string|required',
            'expire_date'=>'required',
        ]);

        $data= $request->all();

        $status=Auction::create($data);
        if($status){
            request()->session()->flash('success','Auction successfully added');
        }
        else{
            request()->session()->flash('error','Error occurred, Please try again!');
        }
        return redirect()->route('auctions');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        $products=Product::where('status', 'active')->orderBy('title','ASC')->get();
        $vendors=Vendor::where('status','active')->orderBy('title','ASC')->get();
        $auction=Auction::findOrFail($id);

        return view('admin.auction.edit')->with('products',$products)->with('auction',$auction)->with('vendors',$vendors);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $auction=Auction::findOrFail($id);
        $this->validate($request,[
            'product_id'=>'string|required',
            'vendor_id'=>'string|required',
            'expire_date'=>'required',
        ]);
        $data= $request->all();
        
        $status=$auction->fill($data)->save();
        if($status){
            request()->session()->flash('success','Auction successfully updated');
        }
        else{
            request()->session()->flash('error','Error occurred, Please try again!');
        }
        return redirect()->route('auctions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    { 
        $auction=Auction::findOrFail($id);
        $child_cat_id=Category::where('parent_id',$id)->pluck('_id');
        
        $status=$category->delete();
        
        if($status){
            if(count($child_cat_id)>0){
                Category::whereIn('_id', $child_cat_id)->update(array('parent_id' => '', 'is_parent' =>'1'));
            }
            if($category->image != ""){
                $file_path = public_path().$category->image;
                unlink($file_path);
            }
            if($category->banner != ""){
                $file_path = public_path().$category->banner;
                unlink($file_path);
            }
            request()->session()->flash('success','Category successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting category');
        }
        return redirect()->route('category.index');
    }
}
