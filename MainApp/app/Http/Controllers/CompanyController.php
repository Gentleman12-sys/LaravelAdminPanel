<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\COMPANY;

class CompanyController extends Controller {
    public function __invoke(Request $req) {
        $COMPANYS = COMPANY::orderBy('id', 'desc')->paginate(11);
        return view('admin-company', compact('COMPANYS'));
    }
    
    public function edit_page(Request $req) {
        $COMPANY = COMPANY::find((int)$req->id);
        return view('admin-company-edit', compact('COMPANY'));
    }
    
    public function delete(Request $req) {
        $response = array(
            'status' => 'success',
            'id' => (int)$req->id,
        );
        COMPANY::find($response['id'])->delete();
        
        return 'success';
    }
    
    public function edit(Request $req) {
        $response = array(
            'id' => (int)$req->id,
            'name' => $req->name,
            'region' => $req->category,
            'phone' => $req->phone,
            'status' => $req->status,
        );
        $company = COMPANY::find($response['id']);
        if ($company) {
            $company->name = $response['name'];
            $company->category = $response['category'];
            $company->status = $response['status'];
            $company->phone = $response['phone'];
            $company->save();
        }
        return 'success';
    }
}