<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller {
    public function __invoke(Request $req) {
        return view('admin-login');
    }

    public function submit(Request $req) {
        return view('admin-login', ['data' => Admin::all()]);
    }
}
