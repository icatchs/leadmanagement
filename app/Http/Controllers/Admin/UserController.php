<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-user|edit-user|delete-user', ['only' => ['index','show']]);
        $this->middleware('permission:create-user', ['only' => ['create','store']]);
        $this->middleware('permission:edit-user', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-user', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('dashboard.users.index', [
            'users' => User::latest('id')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('dashboard.users.create', [
            'roles' => Role::pluck('name')->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $user = User::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'email_verified_at' => now(),
            'password'          => Hash::make($request->password),
        ]);

        // Create a corresponding company
        $company = new Company;
        $company->user_id           = $user->id;
        $company->company_name      = $request->name;
        $company->company_email     = $request->email;
        $company->company_phone     = $request->phone;
        $company->company_city      = $request->city;
        $company->company_state     = $request->status;
        $company->contact_person    = $request->contact_person;
        $company->save();

        $user->assignRole($request->roles);

        return redirect()->route('users.index')->withSuccess('New user is added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): View
    {
        return view('dashboard.users.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        // Check Only Super Admin can update his own Profile
        if ($user->hasRole('Super Admin')){
            if($user->id != auth()->user()->id){
                abort(403, 'USER DOES NOT HAVE THE RIGHT PERMISSIONS');
            }
        }

        return view('dashboard.users.edit', [
            'user'    => $user,
            'company' => Company::where('user_id',$user->id)->first(),
            'roles' => Role::pluck('name')->all(),
            'userRoles' => $user->roles->pluck('name')->all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
       /*  $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]); */

        if($request->hasFile('profile_img')){
            $imageName = time().'.'.$request->profile_img->extension();
            $request->profile_img->move(public_path('assets/images/company/profiles'), $imageName);
        }else{
            $imageName = $user->img;
        }


        $user = User::where('id', $user->id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->img = $imageName; 
        $user->user_status = 1;
        $user->save();
        // Create a corresponding company
        $company = Company::where('user_id', $user->id)->first();;
        $company->user_id           = $user->id;
        $company->company_name      = $request->name;
        $company->company_email     = $request->email;
        $company->company_phone     = $request->phone;
        $company->company_city      = $request->city;
        $company->company_state     = $request->state;
        $company->contact_person    = $request->contact_person;
        $company->save();

        $user->syncRoles($request->roles);
        /* 
        $input = $request->all();
 
        if(!empty($request->password)){
            $input['password'] = Hash::make($request->password);
        }else{
            $input = $request->except('password');
        }
        
        $user->update($input); */

        return redirect()->route('users.index')->withSuccess('New user is added successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        // About if user is Super Admin or User ID belongs to Auth User
        if ($user->hasRole('Super Admin') || $user->id == auth()->user()->id)
        {
            abort(403, 'USER DOES NOT HAVE THE RIGHT PERMISSIONS');
        }

        $user->syncRoles([]);
        $user->soft_delete = 1;
        $user->save();
        return redirect()->route('users.index')->withSuccess('User is deleted successfully.');
    }
}