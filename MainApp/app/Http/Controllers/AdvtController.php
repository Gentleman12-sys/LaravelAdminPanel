<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\ADVT;

class AdvtController extends Controller {
    public function __invoke(Request $req) {
        $ADVTS = ADVT::orderBy('id', 'desc')->paginate(11);
        return view('admin-advt', compact('ADVTS'));
    }
    
    public function edit_page(Request $req) {
        $ADVT = ADVT::find((int)$req->id);
        return view('admin-advt-edit', compact('ADVT'));
    }
    
    public function delete(Request $req) {
        $response = array(
            'status' => 'success',
            'id' => (int)$req->id,
        );
        ADVT::find($response['id'])->delete();
        
        return 'success';
    }
    
    public function edit(Request $req) {
        $response = array(
            'id' => (int)$req->id,
            'name' => $req->name,
            'category' => $req->category,
            'status' => $req->status,
        );
        $advt = ADVT::find($response['id']);
        if ($advt) {
            $advt->name = $response['name'];
            $advt->category = $response['category'];
            $advt->status = $response['status'];
            $advt->save();
        }
        return 'success';
    }
}