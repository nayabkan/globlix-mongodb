<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
 
class CategoryController extends Controller
{
    public function __construct() {
        $this->middleware('assign.guard:vendor', ['except' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $categories = Category::all();
        $categories=Category::where([['parent_id', '=', ''],['is_parent', '=', 1],['status', '=', 'active']])->get();
        $id='';
        $apidata=[];

        //dd($categories);
        foreach ($categories as $key => $cats) {
            
            // $id = $cats;
            $apidata[$key]['_id']= $cats->_id;
            $apidata[$key]['title']= $cats->title;
            $apidata[$key]['parent_id']= $cats->parent_id;
            $apidata[$key]['is_parent']= $cats->is_parent;
            $apidata[$key]['image']= url($cats->image);
            $apidata[$key]['banner']= url($cats->banner);
            $apidata[$key]['status']= $cats->status;
            $apidata[$key]['created_at']= $cats->created_at;
            $apidata[$key]['updated_at']= $cats->updated_at;
            $child_categor=Category::where([['parent_id', '=', $cats->_id],['status', '=', 'active']])->get();
            $child='';
            $subchild=[];
            if(!$child_categor->isEmpty()){
                foreach ($child_categor as $ke => $chcat) {
                    // $child = $chcat;
                    $childata['_id']= $chcat->_id;
                    $childata['title']= $chcat->title;
                    $childata['parent_id']= $chcat->parent_id;
                    $childata['is_parent']= $chcat->is_parent;
                    $childata['image']= url($chcat->image);
                    $childata['status']= $chcat->status;
                    $childata['created_at']= $chcat->created_at;
                    $childata['updated_at']= $chcat->updated_at;

                    $subchild_categor=Category::where([['parent_id', '=', $chcat->_id],['status', '=', 'active']])->get();
                    if(!$subchild_categor->isEmpty()){
                        foreach ($subchild_categor as $k => $subchcat) {
                            //$subchild = $subchcat;
                            $subchild['_id']=$subchcat->_id;
                            $subchild['title']= $subchcat->title;
                            $subchild['parent_id']= $subchcat->parent_id;
                            $subchild['is_parent']= $subchcat->is_parent;
                            $subchild['image']= url($subchcat->image);
                            $subchild['status']= $subchcat->status;
                            $subchild['created_at']= $subchcat->created_at;
                            $subchild['updated_at']= $subchcat->updated_at;
                        }
                        $childata['sub_child']=$subchild;
                    }
                    
                }

            }

            $apidata[$key]['child_cat']= $childata;
        }

        
        return response()->json($apidata);
    }

    public function parent(){
        $parentcats=Category::where([['parent_id', '=', ''],['is_parent', '=', 1],['status', '=', 'active']])->get();

        foreach ($parentcats as $key => $cats) {
            // $id = $cats;
            $apidata[$key]['_id']= $cats->_id;
            $apidata[$key]['title']= $cats->title;
            $apidata[$key]['slug']= $cats->slug;
            $apidata[$key]['image']= url($cats->image);
            $apidata[$key]['status']= $cats->status;
            $apidata[$key]['created_at']= $cats->created_at;
            $apidata[$key]['updated_at']= $cats->updated_at;
        }
        return response()->json($apidata);
    }

    public function childsbyparent(Request $request){
        $id= $request->cat_id;
        $childcats=Category::where([['parent_id', '=', $id],['status', '=', 'active']])->get();
        $catProducts=Product::where([['category', '=', $id],['status', '=', 'active']])->get();
        $apidata=[];
        $apicats=[];
        $products=[];
        
        $apidata['category_id']= $id;

        if(!$childcats->isEmpty()){
            foreach ($childcats as $key => $cats) {
                $apicats['_id']= $cats->_id;
                $apicats['title']= $cats->title;
                $apicats['slug']= $cats->slug;
                $apicats['parent_id']= $cats->parent_id;
                $apicats['image']= url($cats->image);
                $apicats['status']= $cats->status;
                $apicats['created_at']= $cats->created_at;
                $apicats['updated_at']= $cats->updated_at;
            }
        }

        $apidata['child_cats']= $apicats;

        if(!$catProducts->isEmpty()){
            foreach ($catProducts as $key => $prods) {
                $products[$key]['_id']= $prods->_id;
                $products[$key]['title']= $prods->title;
                $products[$key]['slug']= $prods->slug;
                $products[$key]['sku']= $prods->sku;
                $products[$key]['price']= $prods->price;
                $products[$key]['sale_price']= $prods->sale_price;

                $cat_images=json_decode($prods->images);
                $prodImages=[];
                if( sizeof($cat_images) ){
                    foreach ($cat_images as $ke => $catimg) {
                        $prodImages[$ke]= url($catimg);
                    }
                    $products[$key]['images'] =$prodImages;
                }
                $products[$key]['created_at']= $prods->created_at;
                $products[$key]['updated_at']= $prods->updated_at;
            }
        }
        $apidata['products']= $products;

        return response()->json($apidata);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'string|required',
            'parent_id'=>'nullable'
        ]);

        $data= $request->all();

        $slug=Str::slug($request->get('title'));
        $count=Category::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }
        $data['slug']=$slug;
        $parent_id = $request->get('parent_id');
        if($parent_id != '' || $parent_id != null ){
            $is_parent=0;
        }else{
            $is_parent=1;
        }

        $newCategory = new Category([
          'title' => $request->get('title'),
          'is_parent' => $is_parent,
          'parent_id' => $request->get('parent_id'),
          'status' => 'active',
          'slug' => $data['slug'],
        ]);

        $newCategory->save();

        return response()->json($newCategory);
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'title'=>'string|required',
            'parent_id'=>'nullable'
        ]);

        $category->title = $request->get('title');
        $category->parent_id = $request->get('parent_id');

        $category->save();

        return response()->json($category);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json($category::all());
    }
}
