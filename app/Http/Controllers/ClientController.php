<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Province;
use App\Models\Town;
use App\Models\Barangay;

class ClientController extends Controller
{
    function index(Request $request){
        if (! Gate::allows('View Client')) {
            abort(403);
        }

        $search = $request->input('search');
        $status = ($request->exists('status')) ? $request->input('status') : 1;

        if ($search):
            $entities = Client::where('status', $status)->where('role', 2)
                                ->when($search, function($query) use ($search){
                                    $query->where('firstname', 'LIKE', '%'.$search.'%')
                                            ->orWhere('middlename', 'LIKE', '%'.$search.'%')
                                            ->orWhere('lastname', 'LIKE', '%'.$search.'%')
                                            ->orWhere('entityname', 'LIKE', '%'.$search.'%');
                                })->paginate(12);
        else:
            $entities = Client::where('status', $status)->where('role', 2)->paginate(12);
        endif;
        
        return view('client.index', ['entities' => $entities]);
    }

    function create(Request $request){
        $id = $request->input('id');
        $client = Client::find($id);
        $provinces = Province::all()->sortBy("description");
        $towns = Town::where('province_code', '0712')->orderBy('description', 'ASC')->get();
        $brgys = Barangay::where('town_code', '071244')->orderBy('description', 'ASC')->get();
        return view('client.create', ['client' => $client, 'provinces' => $provinces, 'towns' => $towns, 'brgys' => $brgys]);
    }

    function store(Request $request){
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required'
        ]);

        if ($request->input('id')){
            Client::where('id', $request->input('id'))->update($request->all());
            return ['icon'=>'success',
                    'title'=>'Success',
                    'message'=>"Client record successfully updated!"
                ];
        }
        else{
            $data = $request->all();
            $data['username'] = strtolower(preg_replace('/\s+/', '', $request->input('firstname'))).'.'.strtolower(preg_replace('/\s+/', '', $request->input('lastname')));
            $data['password'] = Hash::make('password');

            Client::create($data);
            return ['icon'=>'success',
                    'title'=>'Success',
                    'message'=>"Client record successfully saved!"
                ];
        }
    }

    function toggleStatus(Request $request){
        $id = $request->input('id');
        $status = $request->input('status');
        Client::where('id', $id)->update(['status' => $status]);
        return ($status) ? ['icon'=>'success','title'=>'Success','message'=>"Client record successfully restored!"] : ['icon'=>'success','title'=>'Success','message'=>"Client record successfully deleted!"];
    }

    function profile(Request $request){
        $id = $request->input('id');
        $entity = Client::with(['barangay', 'town', 'province'])->find($id);
        return view('client.profile', ['entity' => $entity]);
    }
}
