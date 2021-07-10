<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Platform;
use App\Models\Category;
use App\Models\Product;
use App\Models\Visit;
use App\Models\Gallery;

class HomeController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $platforms = Platform::where('active','1')->get();
        // dd($platforms);
        $categories = Category::where('active','1')->orderBy('category','asc')->get();
        
        $platform = $request->input('platform');
        $category = $request->input('category');
        $search = $request->input('search');

        // var_dump("TEs");die();
        
        if($platform != null && $category !== null && $search != null){
            $products = Product::where('platform', 'LIKE', '%' . $platform .'%')
            ->where('category', $category)
            ->where('title', 'LIKE', '%' . Str::lower($search) .'%')
            ->paginate(env('PRODUCT_PER_PAGE'));
        } else {
            $products = Product::inRandomOrder()->paginate(env('PRODUCT_PER_PAGE'));
            $product = Product::with('visits')->get();
            visits(Product::class)->increment();
        }

        return view('home', compact('platforms','categories','products'));
    }

    public function product(Request $request)
    {
        $id = $request->segment(2);
        
        $product = Product::where('id', $id)->where('active', '1')->first();
        $galleries = Gallery::where('product_id', $id)->inRandomOrder()->get();
        
        $others = Product::inRandomOrder()->limit(5)->get();

        if($product != null){
            return view('product', compact('id','product','galleries','others'));
        } else {
            abort(404);
        }
    }
}
