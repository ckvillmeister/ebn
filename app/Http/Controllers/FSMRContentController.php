<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Models\FSMRContent;
use App\Models\FSMRSubContents;
use App\Models\AttachmentTypes;

class FSMRContentController extends Controller
{
    function index(Request $request){
        if (! Gate::allows('FSMR Contents Manager')) {
            abort(403);
        }

        return view('setup.content.index');
    }

    function retrieve(Request $request){
        $status = $request->input('status');
        $contents = FSMRContent::where('status', $status)->get();
        return view('setup.content.list', compact('contents'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    function create(Request $request){
        $id = $request->input('id');
        $content = isset($id) ? FSMRContent::where('id', $id)->first() : null;
        return view('setup.content.create', ['content' => $content]);
    }

    public function store(Request $request)
    {   
        $id = $request->input('id');
        
        if ($id){
            $validator = Validator::make($request->all(), [
                'description' => 'required|unique:fsmr_content'
            ]);

            if ($validator->fails()){
                return ['icon'=>'error',
                    'title'=>'Error',
                    'message'=> $validator->errors()->first()];
            }

            FSMRContent::where('id', $id)->update(['description' => $request->input('description')]);
            return ['icon'=>'success',
                    'title'=>'Success',
                    'message'=>"FSMR Content successfully updated!"];
        }
        else{
            $validator = Validator::make($request->all(), [
                'description' => 'required|unique:fsmr_content'
            ]);

            if ($validator->fails()){
                return ['icon'=>'error',
                    'title'=>'Error',
                    'message'=> $validator->errors()->first()];
            }
    
            FSMRContent::create($request->all());
            return ['icon'=>'success',
                    'title'=>'Success',
                    'message'=>"FSMR Content successfully created!"];
        }
    }

    function toggleStatus(Request $request){
        $id = $request->input('id');
        $status = $request->input('status');
        FSMRContent::where('id', $id)->update(['status' => $status]);
        return ($status) ? ['icon'=>'success',
                            'title'=>'Success',
                            'message'=>"FSMR Content successfully re-activated!"] : ['icon'=>'success','title'=>'Success','message'=>"FSMR Content successfully deleted!"];
    }

    function fsmrSubContents(Request $request){
        $id = $request->input('id');
        $content = FSMRContent::where('id', $id)->first();

        return view('setup.content.sub-content.index', [
            'content' => $content
        ]);
    }

    function retrieveSubContents(Request $request){
        $id = $request->input('id');

        $content = FSMRContent::with(['subcontents.attachment_type'])->where('id', $id)->first();
        return view('setup.content.sub-content.list', compact('content'));
    }

    function createSubContent(Request $request){
        $content_id = $request->input('content_id');
        $att_id = $request->input('att_id');

        $excludedIds = FSMRSubContents::pluck('attachment_type_id');
        $attachmenttypes = AttachmentTypes::whereNotIn('id', $excludedIds)->get();
        return view('setup.content.sub-content.create', compact('attachmenttypes', 'content_id'));
    }

    public function storeSubContent(Request $request){   
        FSMRSubContents::create($request->all());
        return ['icon'=>'success',
                'title'=>'Success',
                'message'=>"FSMR Sub Content successfully added!"];
    }

    public function removeSubContent(Request $request){
        $att_id = $request->input('att_id');
        FSMRSubContents::where('attachment_type_id', $att_id)->delete();
        return ['icon'=>'success',
                'title'=>'Success',
                'message'=>"FSMR Sub Content successfully removed!"];
    }
}
