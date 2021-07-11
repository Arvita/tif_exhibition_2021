<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Platform;
use App\Models\Category;
use App\Models\Product;
use App\Models\Visit;
use App\Models\Gallery;
use App\Models\Vote;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // dd("TES");
        // $platforms = Platform::where('active','1')->get();
        // dd($platforms);
        $categories = Category::where('active','1')->orderBy('category','asc')->get();
        
        $semester = $request->input('semester');
        $category = $request->input('category');
        $search = $request->input('search');
        if($semester != null && $category !== null && $search != null){
            if(($semester=="*") && ($category=="*")){
                $products = Product::where('title', 'LIKE', '%' . Str::lower($search) .'%')
                ->paginate(env('PRODUCT_PER_PAGE'));
            } else if ($semester=="*") {
                $products = Product::where('category', $category)
                ->where('title', 'LIKE', '%' . Str::lower($search) .'%')
                ->paginate(env('PRODUCT_PER_PAGE'));
            } else if($category=="*"){
                $products = Product::where('semester',$semester)
                ->where('title', 'LIKE', '%' . Str::lower($search) .'%')
                ->paginate(env('PRODUCT_PER_PAGE'));
            } else{
                $products = Product::where('semester', $semester)
                ->where('category', $category)
                ->where('title', 'LIKE', '%' . Str::lower($search) .'%')
                ->paginate(env('PRODUCT_PER_PAGE'));
            }
        } 
        else if ($semester != null && $category !== null){
            if(($semester=="*") && ($category=="*")){
                $products = Product::inRandomOrder()->paginate(env('PRODUCT_PER_PAGE'));
            }
            else if ($semester=="*") {
                $products = Product::where('category', $category)
                ->paginate(env('PRODUCT_PER_PAGE'));
            } else if($category=="*"){
                $products = Product::where('semester',$semester)
                ->paginate(env('PRODUCT_PER_PAGE'));
            } else{
                $products = Product::where('semester',$semester)
                ->where('category', $category)
                ->paginate(env('PRODUCT_PER_PAGE'));
            }            
        }
        else {
            $products = Product::inRandomOrder()->paginate(env('PRODUCT_PER_PAGE'));
            $product = Product::with('visits')->get();
            visits(Product::class)->increment();
        }
        // foreach ($product as $key) {
        //     $key->id = Crypt::encrypt($key->id);            
        // }
        // dd($product);
        return view('home', compact('categories','products'));
    }

    public function product(Request $request)
    {
        $id = Crypt::decrypt($request->segment(2));
        $vote = null;
        if (Auth::check()) {
            $vote = Vote::where('user_id',Auth::user()->id)->first();
        }
        $vote_rating = Vote::where('product_id',$id)->count();
        $product = Product::where('id', $id)->where('active', '1')->first();
        $galleries = Gallery::where('product_id', $id)->inRandomOrder()->get();
        
        $others = Product::inRandomOrder()->limit(5)->get();

        if($product != null){
            return view('product', compact('id','product','galleries','others','vote','vote_rating'));
        } else {
            abort(404);
        }
    }
    public function vote($id)
    {
        $id = Crypt::decrypt($id);
        $title = Product::find($id);
        Vote::create([
            'user_id' => Auth::user()->id,
            'product_id' => $id,
            'vote' => 1
        ]);
        $id = Crypt::encrypt($id);
        return redirect(url('product/'.$id.'/'.$title->title))->with('success','Vote Berhasil!');
    }
}
