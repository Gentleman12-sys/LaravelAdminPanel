<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IFP;

class IFPController extends Controller {
    public function __invoke(Request $req) {
        $IFPS = IFP::orderBy('id', 'desc')->paginate(11);
        return view('admin-ifp', compact('IFPS'));
    }
    
    public function edit_page(Request $req) {
        $IFP = IFP::find((int)$req->id);
        return view('admin-ifp-edit', compact('IFP'));
    }
    
    public function delete(Request $req) {
        $response = array(
            'status' => 'success',
            'id' => (int)$req->id,
        );
        IFP::find($response['id'])->delete();
        
        return 'success';
    }
    
    public function edit(Request $req) {
        $response = array(
            'status' => 'success',
            'id' => (int)$req->id,
            'user_id' => (int)$req->user_id,
            'full_name' => $req->full_name,
            'email' => $req->email,
            'service' => $req->service,
            'status' => $req->status,
        );
        $ifp = IFP::find($response['id']);
        if ($ifp) {
            $ifp->user_id = $response['user_id'];
            $ifp->full_name = $response['full_name'];
            $ifp->email = $response['email'];
            $ifp->service = $response['service'];
            $ifp->status = $response['status'];
            $ifp->save();
        }
        return 'success';
    }
}