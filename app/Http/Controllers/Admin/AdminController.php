<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        // dd(Product::where('platform', 'like', 'Desktop%')->count());
        $data = [
            'title' => "Selamat Datang",
            'subtitle' => "di Halaman Administrator",
            'npage' => 0,
            'dua_num' => Product::where('semester', '2')->count(),
            'empat_num' => Product::where('semester', '4')->count(),
            'enam_num' => Product::where('semester', '6')->count(),
            'user_num' => User::count(),
        ];
        return view('admin.dashboard', compact('data'));
    }
}
