<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
{
    public function __construct() {
        // $this->middleware('assign.guard:vendor', ['except' => ['index']]);
    }
    
    public function index(){
        $countries = Country::all();

        return response()->json($countries);
    }
}
