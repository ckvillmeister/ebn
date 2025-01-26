<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Models\FireEmergencyExitRoutesChecklist;
use App\Models\FireSuppressionSystemChecklist;

class QuestionnaireController extends Controller
{
    function index(Request $request){
        if (! Gate::allows('Question Checklist Manager')) {
            abort(403);
        }

        return view('setup.questions.index');
    }

    function retrieveQuestions(Request $request){
        $type = $request->input('type');
        $status = $request->input('status');

        if ($type == 'eer'){
            $questions = FireEmergencyExitRoutesChecklist::where('status', $status)->get();
            return view('setup.questions.eer-list', compact('questions'));
        }
        elseif ($type == 'fss'){
            $questions = FireSuppressionSystemChecklist::where('status', $status)->get();
            return view('setup.questions.fss-list', compact('questions'));
        }
    }

    function createQuestion(Request $request){
        $type = $request->input('type');
        $id = $request->input('id');
        $question = (object) [];

        if ($type == 'eer'){
            $question = isset($id) ? FireEmergencyExitRoutesChecklist::where('id', $id)->first() : null;
        }
        elseif ($type == 'fss'){
            $question = isset($id) ? FireSuppressionSystemChecklist::where('id', $id)->first() : null;
        }

        return view('setup.questions.create', [
            'question' => $question,
            'type' => $type
        ]);
    }

    public function storeQuestion(Request $request){
        $type = $request->input('type');   
        $id = $request->input('question-id');

        if ($id){
            if ($type == 'eer'){
                FireEmergencyExitRoutesChecklist::where('id', $id)->update(['description' => $request->input('description')]);
            }
            elseif ($type == 'fss'){
                FireSuppressionSystemChecklist::where('id', $id)->update(['description' => $request->input('description')]);
            }

            return ['icon'=>'success',
                    'title'=>'Success',
                    'message'=>"Question successfully updated!"];
        }
        else{
            if ($type == 'eer'){
                FireEmergencyExitRoutesChecklist::create(['description' => $request->input('description')]);
            }
            elseif ($type == 'fss'){
                FireSuppressionSystemChecklist::create(['description' => $request->input('description')]);
            }

            return ['icon'=>'success',
                    'title'=>'Success',
                    'message'=>"Question successfully created!"];
        }
    }

    function toggleQuestionStatus(Request $request){
        $id = $request->input('id');
        $status = $request->input('status');
        $type = $request->input('type');   

        if ($type == 'eer'){
            FireEmergencyExitRoutesChecklist::where('id', $id)->update(['status' => $status]);
        }
        elseif ($type == 'fss'){
            FireSuppressionSystemChecklist::where('id', $id)->update(['status' => $status]);
        }

        return ($status) ? ['icon'=>'success','title'=>'Success','message'=>"Question successfully re-activated!"] : ['icon'=>'success','title'=>'Success','message'=>"Question successfully deleted!"];
    }
}
