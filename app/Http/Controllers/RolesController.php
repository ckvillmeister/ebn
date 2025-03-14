<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Permission;
use App\Models\RoleHasPermissions;
use App\Models\User;

class RolesController extends Controller
{
    function index(Request $request){
        if (! Gate::allows('Roles and Permission Manager')) {
            abort(403);
        }

        return view('roles.index');
    }

    function retrieve(Request $request){
        $status = $request->input('status');
        $roles = Role::where('status', $status)->get();
        return view('roles.list',compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    function create(Request $request){
        $id = $request->input('id');
        $role = isset($id) ? Role::where('id', $id)->first() : null;
        $permissions = Permission::where('status', 1)->get();
        $role_permissions = RoleHasPermissions::where('role_id', $id)->get();
        return view('roles.create', ['role' => $role, 'permissions' => $permissions, 'role_permissions' => $role_permissions]);
    }

    public function store(Request $request)
    {   
        $id = $request->input('id');
        $permissions = $request->input('permissions') ? explode(",", $request->input('permissions')) : null;

        if ($id){
            Role::where('id', $id)->update(['name' => $request->input('name'),
                                                'updated_at' => date('Y-m-d H:i:s')
                                            ]);
            $role = Role::find($id);
            
            RoleHasPermissions::where('role_id', $id)->delete();

            if ($permissions != null){
                foreach($permissions as $permission):
                    $perm = Permission::find($permission);
                    $role->givePermissionTo($perm->name);
                endforeach;
            }

            return ['icon'=>'success',
                    'title'=>'Success',
                    'message'=>"Role successfully updated!"];
        }
        else{
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:roles,name'
            ]);

            if ($validator->fails()){
                return ['icon'=>'error',
                    'title'=>'Error',
                    'message'=> $validator->errors()->first()];
            }
    
            $role = Role::create($request->except('updated_at') + ['guard_name' => Auth::getDefaultDriver()]);

            if ($permissions):
                foreach($permissions as $permission):
                    $perm = Permission::find($permission);
                    $role->givePermissionTo($perm->name);
                endforeach;
            endif;

            return ['icon'=>'success',
                    'title'=>'Success',
                    'message'=>"Role successfully created!"];
        }
    }

    function toggleStatus(Request $request){
        $id = $request->input('id');
        $status = $request->input('status');

        if (!$status):
            $results = User::where('id', $id)->get();

            if (count($results)):
                return ['icon'=>'error', 
                            'title'=>'Error',
                            'message'=>"Unable to delete! Role is currently associated to a user."];
            endif;
        endif;

        Role::where('id', $id)->update(['status' => $status]);
        return ($status) ? ['icon'=>'success','title'=>'Success','message'=>"Role successfully re-activated!"] : ['icon'=>'success','title'=>'Success','message'=>"Role successfully deleted!"];
    }
}
