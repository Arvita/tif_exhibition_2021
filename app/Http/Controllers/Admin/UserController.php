<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Models\User;
use Validator;
use Carbon\Carbon;
use Image;
use File;
use Auth;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    public $path;

    public function __construct()
    {
        //DEFINISIKAN PATH
        $this->path = public_path('img/users');
        $this->middleware(['superuser']);
    }
    
    public function index()
    {
        $data = [
            'title' => "Data User",
            'subtitle' => "Halaman Manajemen User",
            'npage' => 9,
        ];
        
        return view('admin.user', compact('data'));
    }

    public function json()
    {
        $users = User::all();
        
        $data_json = [
			'data' => [],
        ];

        foreach ($users as $user) {
            $button = '<a href="'.url('admin/user/edit', Crypt::encrypt($user->id)).'" class="btn btn-primary btn-xs"><i class="icon-pencil"></i> Edit</a> <button data-href="'.route('user.destroy', Crypt::encrypt($user->id)).'" class="btn btn-danger btn-xs hapus-btn" data-toggle="modal" data-target="#delModal"><i class="icon-trash"></i> Hapus</button>';
            
            $item = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'username' => $user->username,
                'avatar' => (substr($user->avatar, 0, 4) == 'http') ? '<img src="'.$user->avatar.'" alt="" height="50">' : '<img src="'.url(asset('img/users/'.$user->avatar)).'" alt="" height="50">',
                'role' => ($user->role == 0 ? 'Admin' : ($user->role == 1 ? 'Officer':'Common User')),
                'button' => $button, 
            ];
            
            array_push($data_json['data'], $item);
        }
        
        return response()->json($data_json);
    }

    public function create()
    {
        $data = [
            'title' => "Tambah Data User",
            'subtitle' => "Halaman Tambah User",
            'npage' => 9,
        ];

        return view('admin.user_add', compact('data'));
    }

    public function store(Request $request)
    {
        $messages = [
            'unique' => 'The :attribute field was recorded before in database.',
        ];

        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'avatar' => 'required|image|mimes:jpg,png,jpeg,gif|max:1024',

        ], $messages)->validate();

        // JIKA FOLDERNYA BELUM ADA
        if (!File::isDirectory($this->path)) {
            //MAKA FOLDER TERSEBUT AKAN DIBUAT
            File::makeDirectory($this->path, 0777, true);
        }

        //MENGAMBIL FILE IMAGE DARI FORM
        $file = $request->file('avatar');
        //MEMBUAT NAME FILE DARI GABUNGAN TANGGAL DAN UNIQID()
        $fileName = 'user_'.Carbon::now()->format('YmdHis') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        

        //MEMBUAT CANVAS IMAGE SEBESAR DIMENSI 
        $canvas = Image::canvas(128, 128);
        //RESIZE IMAGE SESUAI DIMENSI DENGAN MEMPERTAHANKAN RATIO
        $resizeImage  = Image::make($file)->resize(null, 128, function($constraint) {
            $constraint->aspectRatio();
        });
        //MEMASUKAN IMAGE YANG TELAH DIRESIZE KE DALAM CANVAS
        $canvas->insert($resizeImage, 'center');
        //SIMPAN IMAGE KE FOLDER
        if($canvas->save($this->path . '/' . $fileName)){
            $user = new User();
            $user->name=request('name');
            $user->email=request('email');
            $user->username=request('username');
            $user->password=bcrypt('123456');
            $user->google_id=bcrypt(request('email'));
            $user->avatar=$fileName;
            $user->role=request('role');
            
            // dd($user);
            $user->save();
            return redirect(route('user'))->with('success','Data berhasil ditambahkan!');
        } else {
            dd('tesss');
            return redirect(route('user'))->with('error','Data gagal ditambahkan!');
        }
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $user = User::find($id);
        $data = [
            'title' => "Update Data User",
            'subtitle' => "Halaman Update User",
            'npage' => 9,
        ];
        $id = Crypt::encrypt($user->id);
        return view('admin.user_edit', compact('data','user','id'));
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'unique' => 'The :attribute field was recorded before in database.',
        ];
        
        $rules = [
            'name' => 'required|string|max:100',
            'avatar' => 'image|mimes:jpg,png,jpeg,gif|max:1024',
            'password' => 'nullable|string|min:6',
        ];

        $id = Crypt::decrypt($id);
        $user = User::find($id);

        if ($user->email == request('email')) {
            $rules['email'] = 'required|string|email|max:255';
        } else {
            $rules['email'] = 'required|string|email|max:255|unique:users';
        }

        if ($user->username == request('username')) {
            $rules['username'] = 'required|string|max:255';
        } else {
            $rules['username'] = 'required|string|max:255|unique:users';
        }

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        // JIKA FOLDERNYA BELUM ADA
        if (!File::isDirectory($this->path)) {
            //MAKA FOLDER TERSEBUT AKAN DIBUAT
            File::makeDirectory($this->path, 0777, true);
        }
        $user->name =  request('name');
        $user->email = request('email');
        $user->username = request('username');
        $user->role = request('role');

        if (request('password') != null || request('password') != '') {
            $user->password  = bcrypt(request('password'));
        }

        //MENGAMBIL FILE IMAGE DARI FORM
        $file = $request->file('avatar');
        if($file != null){
            if($user->avatar){
                $avatar_path = $this->path .'/'. $user->avatar;
                if(File::exists($avatar_path)){
                    File::delete($avatar_path);
                }
            }
            //MEMBUAT NAME FILE DARI GABUNGAN TANGGAL DAN UNIQID()
            $fileName = 'user_'.Carbon::now()->format('YmdHis') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            // $data_user['avatar'] = $fileName;
            $user->avatar = $fileName;
    
            //MEMBUAT CANVAS IMAGE SEBESAR DIMENSI 
            $canvas = Image::canvas(128, 128);
            //RESIZE IMAGE SESUAI DIMENSI DENGAN MEMPERTAHANKAN RATIO
            $resizeImage  = Image::make($file)->resize(null, 128, function($constraint) {
                $constraint->aspectRatio();
            });
            //MEMASUKAN IMAGE YANG TELAH DIRESIZE KE DALAM CANVAS
            $canvas->insert($resizeImage, 'center');
            //SIMPAN IMAGE KE FOLDER
            if($canvas->save($this->path . '/' . $fileName)){
                $user->save();
                return redirect(route('user'))->with('info','Data berhasil diupdate!');
            } else {
                return redirect(route('user'))->with('error','Data gagal diupdate!');
            }
        } else {
            $user->save();
            return redirect(route('user'))->with('info','Data berhasil diupdate!');
        }
    }

    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        $user = User::find($id);
        if($user->avatar){
            $avatar_path = $this->path .'/'. $user->avatar; 
            if(File::exists($avatar_path)){
                File::delete($avatar_path);
            }
        }

        $user->delete();

        return redirect(route('user'))->with('info','Data berhasil dihapus!');
    }
}
