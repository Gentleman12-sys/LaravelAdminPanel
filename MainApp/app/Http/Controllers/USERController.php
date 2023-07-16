<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\USER;

class USERController extends Controller {
    public function __invoke(Request $req) {
        $USERS = USER::orderBy('id', 'desc')->paginate(11);
        return view('admin-user', compact('USERS'));
    }
    
    public function edit_page(Request $req) {
        $USER = USER::find((int)$req->id);
        return view('admin-user-edit', compact('USER'));
    }
    
    public function delete(Request $req) {
        $response = array(
            'status' => 'success',
            'id' => (int)$req->id,
        );
        USER::find($response['id'])->delete();
        
        return 'success';
    }
    
    public function edit(Request $req) {
        $response = array(
            'status' => 'success',
            'id' => (int)$req->id,
            'full_name' => $req->full_name,
            'email' => $req->email,
            'phone' => $req->phone,
        );
        $user = USER::find($response['id']);
        if ($user) {
            $user->full_name = $response['full_name'];
            $user->email = $response['email'];
            $user->phone = $response['phone'];
            $user->save();
        }
        return 'success';
    }
}