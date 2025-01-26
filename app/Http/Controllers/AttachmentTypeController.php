<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Models\AttachmentTypes;

class AttachmentTypeController extends Controller
{
    function index(Request $request){
        if (! Gate::allows('Attachment Types Manager')) {
            abort(403);
        }

        return view('setup.attachment-types.index');
    }

    function retrieve(Request $request){
        $status = $request->input('status');
        $types = AttachmentTypes::where('status', $status)->get();
        return view('setup.attachment-types.list', compact('types'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    function create(Request $request){
        $id = $request->input('id');
        $type = isset($id) ? AttachmentTypes::where('id', $id)->first() : null;
        
        return view('setup.attachment-types.create', ['type' => $type]);
    }

    public function store(Request $request)
    {   
        $id = $request->input('id');
        
        if ($id){
            $validator = Validator::make($request->all(), [
                'description' => 'required|unique:attachment_types'
            ]);

            if ($validator->fails()){
                return ['icon'=>'error',
                    'title'=>'Error',
                    'message'=> $validator->errors()->first()];
            }

            AttachmentTypes::where('id', $id)->update(['description' => $request->input('description')]);
            return ['icon'=>'success',
                    'title'=>'Success',
                    'message'=>"Attachment type successfully updated!"];
        }
        else{
            $validator = Validator::make($request->all(), [
                'description' => 'required|unique:attachment_types'
            ]);

            if ($validator->fails()){
                return ['icon'=>'error',
                    'title'=>'Error',
                    'message'=> $validator->errors()->first()];
            }
    
            AttachmentTypes::create($request->all());
            return ['icon'=>'success',
                    'title'=>'Success',
                    'message'=>"Attachment type successfully created!"];
        }
    }

    function toggleStatus(Request $request){
        $id = $request->input('id');
        $status = $request->input('status');
        AttachmentTypes::where('id', $id)->update(['status' => $status]);
        return ($status) ? ['icon'=>'success',
                            'title'=>'Success',
                            'message'=>"Attachment type successfully re-activated!"] : ['icon'=>'success','title'=>'Success','message'=>"Attachment type successfully deleted!"];
    }
}
