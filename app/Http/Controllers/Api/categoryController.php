<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\category;
use App\subCategory;
use App\Trending;
use App\City;
use App\VenueModel;

class categoryController extends Controller
{
    public function getCategory(){
        $cat = category::get();

        return response()->json([
            'success' => true,
            'message'    => 'Category',
            'data'    => $cat,
        ]);
    }

    public function subCategory(){
        $cat = subCategory::with('cat')->get();

        return response()->json([
            'success' => true,
            'message'    => 'Sub Category',
            'data'    => $cat,
        ]);
    }
    
    public function Trending(){
        $images = Trending::get();

        return response()->json([
            'success' => true,
            'message'    => 'Trending Images',
            'data'    => $images,
        ]);
    }

    public function city(){
        $city = City::get();

        return response()->json([
            'success' => true,
            'message'    => 'City List',
            'data'    => $city,
        ]);
    }

    public function search(Request $request){
        $search = VenueModel::where('venue_name','like','%'.$request->quary.'%')
                            ->orwhere('venue_address','like','%'.$request->quary.'%')
                            ->get();

        return response()->json([
            'success' => true,
            'message'    => 'Search Result',
            'data'    => $search,
        ]);
    }
}
