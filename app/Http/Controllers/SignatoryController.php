<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Models\Signatory;

class SignatoryController extends Controller
{
    function index(Request $request){
        if (! Gate::allows('Signatories Manager')) {
            abort(403);
        }

        return view('setup.signatories.index');
    }

    function retrieve(Request $request){
        $status = $request->input('status');
        $signatories = Signatory::where('status', $status)->get();
        return view('setup.signatories.list', compact('signatories'));
    }

    function create(Request $request){
        $id = $request->input('id');
        $signatory = isset($id) ? Signatory::where('id', $id)->first() : null;
        return view('setup.signatories.create', ['signatory' => $signatory]);
    }

    public function store(Request $request)
    {   
        $id = $request->input('id');
        
        if ($id){
            $validator = Validator::make($request->all(), [
                'name' => 'required:signatories',
                'position' => 'required'
            ]);

            if ($validator->fails()){
                return ['icon'=>'error',
                    'title'=>'Error',
                    'message'=> $validator->errors()->first()];
            }

            Signatory::where('id', $id)->update([
                'name' => $request->input('name'),
                'position' => $request->input('position')
            ]);

            return ['icon'=>'success',
                    'title'=>'Success',
                    'message'=>"Signatory successfully updated!"];
        }
        else{
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:signatories',
                'position' => 'required'
            ]);

            if ($validator->fails()){
                return ['icon'=>'error',
                    'title'=>'Error',
                    'message'=> $validator->errors()->first()];
            }
    
            Signatory::create([
                'name' => $request->input('name'),
                'position' => $request->input('position')
            ]);

            return ['icon'=>'success',
                    'title'=>'Success',
                    'message'=>"Signatory successfully created!"];
        }
    }

    function toggleStatus(Request $request){
        $id = $request->input('id');
        $status = $request->input('status');
        Signatory::where('id', $id)->update(['status' => $status]);
        return ($status) ? ['icon'=>'success',
                            'title'=>'Success',
                            'message'=>"Signatory successfully re-activated!"] : ['icon'=>'success','title'=>'Success','message'=>"Signatory successfully deleted!"];
    }
}
