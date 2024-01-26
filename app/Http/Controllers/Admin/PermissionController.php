<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use DB;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-permission|edit-permission|delete-permission', ['only' => ['index','show']]);
        $this->middleware('permission:create-permission', ['only' => ['create','store']]);
        $this->middleware('permission:edit-permission', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-permission', ['only' => ['destroy']]);
    }

    public function index(){
        $permissions = Permission::orderBy('id','DESC')->paginate(10);
        return view('dashboard.permissions.index',compact('permissions'));
    }

    public function create(){
        return view('dashboard.permissions.create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[a-z\-]+$/'
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
    
        $permission = new Permission;
        $permission->name = $request->name;
        $permission->guard_name = 'web';
        $permission->save();
        return redirect()->route('permissions.index')->withSuccess('New role is added successfully.');
    }

    public function show($ids = null){

    }

    public function update(Request $request,$id=null){

    }

    public function destroy($id=null){

    }

}
