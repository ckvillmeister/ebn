<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Mailer;
use App\Models\User;
use App\Models\Province;
use App\Models\Town;
use App\Models\Barangay;
use App\Models\Settings;
use App\Models\Client;

class UserController extends Controller
{
    function index(Request $request){
        if (! Gate::allows('User Accounts Manager')) {
            abort(403);
        }

        return view('user.index');
    }

    function retrieve(Request $request){
        $status = $request->input('status');
        $users = User::with('role')->where('status', $status)->get();
        return view('user.list', ['users' => $users]);
    }

    function create(Request $request){
        $id = $request->input('id');
        $roles = Role::where('status', 1)->get();
        $user = User::where('id', $id)->first();
        return view('user.create', ['user' => $user, 'roles' => $roles]);
    }

    public function store(Request $request)
    {   
        $id = $request->input('id');
        
        if ($id){
            $validator = Validator::make($request->all(), [
                'firstname' => 'required',
                'lastname' => 'required',
                'role' => 'required',
            ]);

            if ($validator->fails()){
                return ['icon'=>'error',
                    'title'=>'Error',
                    'message'=> $validator->errors()->first()];
            }

            $user = User::where('id', $id)->update($request->all() + ['updated_by' => Auth::id(),
                                                                        'updated_at' => date('Y-m-d H:i:s')]);
            $user = User::where('id', $id)->first();
            $role = Role::where('id', $request->input('role'))->first();
            $user->assignRole($role);

            return ['icon'=>'success',
                    'title'=>'Success',
                    'message'=>"User successfully updated!"];
        }
        else{
            $validator = Validator::make($request->all(), [
                'firstname' => 'required',
                'lastname' => 'required',
                'username' => 'required|unique:users,username',
                'password' => 'required',
                'role' => 'required',
            ]);

            if ($validator->fails()){
                return ['icon'=>'error',
                    'title'=>'Error',
                    'message'=> $validator->errors()->first()];
            }
    
            $user = User::create($request->all());
            $role = Role::where('id', $request->input('role'))->first();
            $user->assignRole($role);
            
            return ['icon'=>'success',
                    'title'=>'Success',
                    'message'=>"User successfully created!"];
        }
    }

    function toggleStatus(Request $request){
        $id = $request->input('id');
        $status = $request->input('status');
        User::where('id', $id)->update(['status' => $status]);
        return ($status) ? ['icon'=>'success','title'=>'Success','message'=>"User successfully re-activated!"] : ['icon'=>'success','title'=>'Success','message'=>"User successfully de-activated!"];
    }

    public function resetPassword($action, Request $request)
    {   
        if ($action):
            $id = $request->input('id');
            $user = User::where('id', $id)->first();
            return view('user.resetpass', ['user' => $user]);
        else:
            $id = $request->input('id');
            User::where('id', $id)->update(['password' => Hash::make($request->input('password'))]);
            return ['icon'=>'success',
                    'title'=>'Success',
                    'message'=>"Password reset successfully!"];
        endif;
        
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'opassword' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    $fail('The old password is incorrect!');
                }
            }],
            'password' => ['required', 'min:8', 'different:opassword', 'confirmed'],
            'password_confirmation' => ['required'],
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Your password has been changed successfully!');
    }

    public function registration(Request $request){
        $provinces = Province::all()->sortBy("description");
        $towns = Town::where('province_code', '0712')->orderBy('description', 'ASC')->get();
        $brgys = Barangay::where('town_code', '071244')->orderBy('description', 'ASC')->get();

        return view('user.registration', ['provinces' => $provinces, 'towns' => $towns, 'brgys' => $brgys]);
    }

    public function register(Request $request){
        $settings = Settings::all();
        $business_name = $settings->where('code', 'business_name')->first()->description;
        $data = $request->all();
        $pass = Str::random(6);

        $validator = Validator::make($data, [
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required|unique:users,username',
        ]);

        if ($validator->fails()){
            return ['icon'=>'error',
                'title'=>'Error',
                'message'=> $validator->errors()->first()];
        }

        $emailData = [
            'name' => $data['firstname'],
            'email' => $data['username'],
            'business_name' => $business_name,
            'password' => $pass
        ];

        $data['password'] = Hash::make($pass);

        $user = User::create($data);
        $role = Role::where('id', 2)->first();
        $user->assignRole($role);

        Mail::to($data['username'])->send(new Mailer($emailData));


        return ['icon'=>'success',
                'title'=>'Registration Successful!',
                'message'=>"Kindly check your email or spam folder for your credentials."
            ];
    }

    public function profile(Request $request){
        $user = User::with(['addr_barangay', 'addr_town', 'addr_province'])->where('id', Auth::id())->first();
        return view('user.profile', ['user' => $user]);
    }
}
