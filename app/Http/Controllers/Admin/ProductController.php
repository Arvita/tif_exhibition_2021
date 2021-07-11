<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Validator;
use Carbon\Carbon;
use Image;
use File;
use App\Models\Product;
use App\Models\Platform;
use App\Models\Category;
use App\Models\Gallery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ProductController extends Controller
{
    public $path;

    public function __construct()
    {
        //DEFINISIKAN PATH
        $this->path = public_path('img/products');
    }

    public function index()
    {
        $data = [
            'title' => "Data Product",
            'subtitle' => "Halaman Manajemen Data Product",
            'npage' => 1,
            'product' => Product::orderBy('id', 'asc')->get(),
        ];
        return view('admin.product', compact('data'));
    }

    public function json()
    {
        
        if (Auth::user()->role == 0) {
            $products = Product::get();
        } else {
            $products = Product::where('user_id', Auth::user()->id)->get();
        }
         
        
        $data_json = [
			'data' => [],
        ];

        foreach ($products as $product) {
            $button_edit = '<a href="'.route('product.edit', Crypt::encrypt($product->id)).'" class="btn btn-primary btn-xs"><i class="icon-pencil"></i> Edit</a>';
            $button_hapus = ' <button data-href="'.route('product.destroy',  Crypt::encrypt($product->id)).'" class="btn btn-danger btn-xs hapus-btn" data-toggle="modal" data-target="#delModal"><i class="icon-trash"></i> Hapus</button>';
            if (Auth::user()->role==0) {
                $button = $button_hapus;
            } else {
                $button = $button_edit.$button_hapus;
            }
            
            $galleries = Gallery::where('product_id', $product->id)->get();
            $screenshot = "";
            foreach ($galleries as $gallery) {
                $screenshot .= '<img src="'.url(asset('img/screenshots/'.$gallery->picture)).'" height="30px" alt=" " />';
            }

            $item = [
                'id' => $product->id,
                'group_name'=> $product->group_name,
                'group_leader'=> $product->group_leader,
                'group_leader_nim'=> $product->group_leader_nim,
                'group_member'=> $product->group_member,
                'group_email'=> $product->group_email,
                'group_phone'=> $product->group_phone,
                'semester_class'=> $product->semester.' / '.$product->group_class,
                'title'=> $product->title,
                'description'=> Str::limit($product->description, 100),
                'category'=> $product->kategori->category,
                'platform'=> $product->platform,
                'featured_picture'=> '<img src="'.url(asset('img/products/'.$product->featured_picture)).'" height="30px" alt=" " />',
                'link_video'=> '<a href="https://youtu.be/'.$product->link_video.'" target="_blank">
                                    <img src="https://img.youtube.com/vi/'.$product->link_video.'/0.jpg" height="30px"/>
                                </a>',
                'link_web'=> '<a href="'.$product->link_web.'" target="_blank">'.$product->link_web.'</a>',
                'link_mobile'=> '<a href="'.$product->link_mobile.'" target="_blank">'.$product->link_mobile.'</a>',
                'link_desktop'=> '<a href="'.$product->link_desktop.'" target="_blank">'.$product->link_desktop.'</a>',
                'link_instagram'=> '<a href="'.$product->link_ig_poster.'" target="_blank">'.$product->link_ig_poster.'</a>',
                'screenshot'=> $screenshot,
                'button' => $button, 
            ];
            
            // dd($item);
            array_push($data_json['data'], $item);
        }
        
        return response()->json($data_json);
    }

    public function create()
    {
        $product = null;
        $data = [
            'title' => "Insert Data Product",
            'subtitle' => "Halaman Insert Product",
            'npage' => 1,
            'platforms' => Platform::all(),
            'categories' => Category::orderBy('category', 'asc')->get(),
        ];

        return view('admin.product_edit', compact('data','product'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:100',
            'leader' => 'required|string|max:25',
            'nim' => 'required|string|max:10',
            'semester' => 'required|string|digits:1',
            'group_class' => 'required|string|max:15',
            'member' => 'required|string',
            'title' => 'required|string',
            'description' => 'required|string',
            'platform' => 'required|string',
            'category' => 'required|string|digits:1',
            'email' => 'required|string|email',
            'phone' => 'required|string|max:15',
            'link_video' => 'required|string',
            'picture' => 'image|mimes:jpg,png,jpeg,gif|max:2048',
            'link_instagram' => 'required|string',
        ];
        
        // dd($rules);

        $validator = Validator::make($request->all(), $rules)->validate();

        $product = new Product();
        $galleries = new Gallery();

        // JIKA FOLDERNYA BELUM ADA
        if (!File::isDirectory($this->path)) {
            //MAKA FOLDER TERSEBUT AKAN DIBUAT
            File::makeDirectory($this->path, 0777, true);
        }

        $link_instagram = explode('/', request('link_instagram'));

            $product -> group_name =  request('name');
            $product -> group_leader =  request('leader');
            $product -> group_leader_nim =  request('nim');
            $product -> group_member =  request('member');
            $product -> group_email =  request('email');
            $product -> group_phone =  request('phone');
            $product -> semester =  request('semester');
            $product -> group_class =  request('group_class');
            $product -> title =  request('title');
            $product -> description =  request('description');
            $product -> category =  request('category');
            $product -> platform =  request('platform');
            $product -> link_video =  request('link_video');
            $product -> link_web =  request('link_web');
            $product -> link_mobile =  request('link_mobile');
            $product -> link_desktop =  request('link_desktop');
            $product -> link_ig_poster =  'https://www.instagram.com/p/'.$link_instagram[4].'/';
            $product -> active =  '1';
            $product -> user_id = Auth::user()->id;
        // dd($data_update);
        //MENGAMBIL FILE IMAGE DARI FORM
        $file = $request->file('picture');
        if($file != null){
            if($product->featured_picture){
                $picture_path = $this->path .'/'. $product->featured_picture;
                if(File::exists($picture_path)){
                    File::delete($picture_path);
                }
            }

            //MEMBUAT NAME FILE DARI GABUNGAN TANGGAL DAN UNIQID()
            $fileName = 'product_'.Carbon::now()->format('YmdHis') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $product -> featured_picture = $fileName;

            //MEMBUAT CANVAS IMAGE SEBESAR DIMENSI 
            $canvas = Image::canvas(850, 415);
            //RESIZE IMAGE SESUAI DIMENSI DENGAN MEMPERTAHANKAN RATIO
            $resizeImage  = Image::make($file)->resize(850, null, function($constraint) {
                $constraint->aspectRatio();
            });
            //MEMASUKAN IMAGE YANG TELAH DIRESIZE KE DALAM CANVAS
            $canvas->insert($resizeImage, 'top');
            //SIMPAN IMAGE KE FOLDER
            if($canvas->save($this->path . '/' . $fileName)){
                $product->save();
                $this->store_galleries($request, $product, $galleries);
                return redirect(route('product'))->with('info','Data berhasil ditambahkan!');
            } else {
                return redirect(route('product'))->with('error','Data gagal ditambahkan!');
            }
        } else {
            $product->save();
            $this->store_galleries($request, $product, $galleries);
            return redirect(route('product'))->with('info','Data berhasil ditambahkan!');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $product = Product::find($id);
        $data = [
            'title' => "Update Data Product",
            'subtitle' => "Halaman Update Product",
            'npage' => 1,
            // 'platforms' => Platform::all(),
            'categories' => Category::orderBy('category', 'asc')->get(),
        ];
        
        $id = Crypt::encrypt($product->id);
        return view('admin.product_edit', compact('data','product','id'));
    }

    public function update(Request $request, $id, Gallery $galleries)
    {
        $rules = [
            'name' => 'required|string|max:100',
            'leader' => 'required|string|max:25',
            'nim' => 'required|string|max:10',
            'semester' => 'required|string|digits:1',
            'group_class' => 'required|string|max:15',
            'member' => 'required|string',
            'title' => 'required|string',
            'description' => 'required|string',
            'platform' => 'required|string',
            'category' => 'required|string|digits:1',
            'email' => 'required|string|email',
            'phone' => 'required|string|max:15',
            'link_video' => 'required|string',
            'picture' => 'image|mimes:jpg,png,jpeg,gif|max:2048',
            'link_instagram' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules)->validate();

        // JIKA FOLDERNYA BELUM ADA
        if (!File::isDirectory($this->path)) {
            //MAKA FOLDER TERSEBUT AKAN DIBUAT
            File::makeDirectory($this->path, 0777, true);
        }

        $link_instagram = explode('/', request('link_instagram'));
        $id = Crypt::decrypt($id);
        $product = Product::find($id);
        $product -> group_name =  request('name');
            $product -> group_leader =  request('leader');
            $product -> group_leader_nim =  request('nim');
            $product -> group_member =  request('member');
            $product -> group_email =  request('email');
            $product -> group_phone =  request('phone');
            $product -> semester =  request('semester');
            $product -> group_class =  request('group_class');
            $product -> title =  request('title');
            $product -> description =  request('description');
            $product -> category =  request('category');
            $product -> platform =  request('platform');
            $product -> link_video =  request('link_video');
            $product -> link_web =  request('link_web');
            $product -> link_mobile =  request('link_mobile');
            $product -> link_desktop =  request('link_desktop');
            $product -> link_ig_poster =  'https://www.instagram.com/p/'.$link_instagram[4].'/';
            $product -> active =  '1';
            $product -> user_id = Auth::user()->id;
        
        // dd($data_update);
        //MENGAMBIL FILE IMAGE DARI FORM
        $file = $request->file('picture');
        if($file != null){
            if($product->featured_picture){
                $picture_path = $this->path .'/'. $product->featured_picture;
                if(File::exists($picture_path)){
                    File::delete($picture_path);
                }
            }

            //MEMBUAT NAME FILE DARI GABUNGAN TANGGAL DAN UNIQID()
            $fileName = 'product_'.Carbon::now()->format('YmdHis') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $product->featured_picture = $fileName;

            //MEMBUAT CANVAS IMAGE SEBESAR DIMENSI 
            $canvas = Image::canvas(850, 415);
            //RESIZE IMAGE SESUAI DIMENSI DENGAN MEMPERTAHANKAN RATIO
            $resizeImage  = Image::make($file)->resize(850, null, function($constraint) {
                $constraint->aspectRatio();
            });
            //MEMASUKAN IMAGE YANG TELAH DIRESIZE KE DALAM CANVAS
            $canvas->insert($resizeImage, 'top');
            //SIMPAN IMAGE KE FOLDER
            if($canvas->save($this->path . '/' . $fileName)){
                $product->save();
                $this->store_galleries($request, $product, $galleries);
                return redirect(route('product'))->with('info','Data berhasil diupdate!');
            } else {
                return redirect(route('product'))->with('error','Data gagal diupdate!');
            }
        } else {
            $product->save();
            $this->store_galleries($request, $product, $galleries);
            return redirect(route('product'))->with('info','Data berhasil diupdate!');
        }
        
    }

    public function store_galleries(Request $request, Product $product, Gallery $galleries)
    {
        $gallery = Gallery::where('product_id', $product->id)->orderBy('picture','asc')->get();

        $rules = [
            'ss_1' => 'image|mimes:jpg,png,jpeg,gif|max:2048',
            'ss_2' => 'image|mimes:jpg,png,jpeg,gif|max:2048',
            'ss_3' => 'image|mimes:jpg,png,jpeg,gif|max:2048',
            'ss_4' => 'image|mimes:jpg,png,jpeg,gif|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules)->validate();

        $galleries_path = public_path('img/screenshots');

        // JIKA FOLDERNYA BELUM ADA
        if (!File::isDirectory($galleries_path)) {
            //MAKA FOLDER TERSEBUT AKAN DIBUAT
            File::makeDirectory($galleries_path, 0777, true);
        }

        for ($i=1; $i <= 4 ; $i++) {
            $file = $request->file('ss_'.$i);
            if($file != null){
                if(isset($gallery[$i-1]->id)){
                    $picture_path = $galleries_path .'/'. $gallery[$i-1]->picture;
                    if(File::exists($picture_path)){
                        File::delete($picture_path);
                        Gallery::where('picture', 'like', '%'.$gallery[$i-1]->picture.'%')->where('product_id', $product->id)->delete();
                    }
                }

                //MEMBUAT NAME FILE DARI GABUNGAN TANGGAL DAN UNIQID()
                $fileName = $product->id .'_'. $i . '.' . $file->getClientOriginalExtension();

                $data_update['picture'] = $fileName;

                $image  = Image::make($file);

                if($image->save($galleries_path . '/' . $fileName)){
                    Gallery::create([
                        'picture' => $fileName,
                        'product_id' => $product->id,
                    ]);
                }
            }
        }
    }

    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        $product = Product::find($id);
        if($product->featured_picture){
            $picture_path = $this->path .'/'. $product->featured_picture;
            if(File::exists($picture_path)){
                File::delete($picture_path);
            }
        }

        $product->delete();

        return redirect(route('product'))->with('info','Data berhasil dihapus!');
    }
}
