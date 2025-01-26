<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\AttachmentTypes;
use App\Models\FSMRInfo;
use App\Models\FSMRAttachments;
use App\Models\User;
use App\Models\FireSystemDeviceCategories;
use App\Models\FireEmergencyExitRoutesChecklist;
use App\Models\FireSuppressionSystemChecklist;
use App\Models\FSMRFirePreventionSystem;
use App\Models\FSMREmergencyExitRoutes;
use App\Models\FSMRFireSuppressionSystem;
use App\Models\FSMRContent;
use App\Models\FSMRExtinguishersEquipment;
use App\Models\Signatory;
use App\Models\Settings;
use App\Models\Assessment;
use App\Models\FSMRAssessment;
use App\Models\FireSuppressionEquipments;
use App\Models\Recommendation;

class TransactionController extends Controller
{
    function fsmrApp(Request $request){
        $save = ($request->input('save')) ? 1 : 0;
        
        if ($save){
            
            $appno = $this->generateAppNo();
            $fsmrid = ($request->input('fsmr-id')) ? $request->input('fsmr-id') : null;
            $name = ($request->input('establishment-name')) ? $request->input('establishment-name') : null;
            $address = ($request->input('address')) ? $request->input('address') : null;
            $occupancy = ($request->input('occupancy')) ? $request->input('occupancy') : null;
            $floors = ($request->input('floors')) ? $request->input('floors') : null;
            $referenceno = ($request->input('reference-no')) ? $request->input('reference-no') : null;
            $buildinguse = ($request->input('building-used')) ? $request->input('building-used') : null;
            $service = ($request->input('service-availed')) ? $request->input('service-availed') : null;
            $requestedby = ($request->input('requested-by')) ? $request->input('requested-by') : Auth::id();

            if ($fsmrid){
                FSMRInfo::where('id', $fsmrid)->update([
                    'establishment_name' => $name,
                    'establishment_address' => $address,
                    'occupancy' => $occupancy,
                    'no_of_floors' => $floors,
                    'reference_no' => $referenceno,
                    'building_use' => $buildinguse,
                    'service_availed' => $service,
                    'client_id' => $requestedby
                ]);

                //Delete Attachments
                $attachments = FSMRAttachments::where('fsmr_id', $fsmrid)->get();
                foreach ($attachments as $attachment){
                    if (Storage::disk('attachments')->exists($attachment->url)){
                        Storage::disk('attachments')->delete($attachment->url);
                    }
                }
                FSMRAttachments::where('fsmr_id', $fsmrid)->delete();
                
                if ($request->hasFile('images')) {
                    $count = 0;
                    $types = ($request->input('types')) ? $request->input('types') : null;

                    foreach ($request->file('images') as $file) {
                        $filename = date('Y_m_d_H_i_s_'.substr((string)microtime(), 2, 4)).'.jpg';
                        Storage::disk('attachments')->putFileAs('/', $file, $filename);

                        FSMRAttachments::create([
                            'fsmr_id' => $fsmrid,
                            'attachment_type_id' => $types[$count++],
                            'url' => $filename
                        ]);
                    }
                }

                return [
                    "title" => "Success",
                    "message" => "Fire Safety Maintenance Report successfully updated!",
                    "icon" => "success",
                    "id" => $fsmrid
                ];
            }
            else{
                $fsmrid = FSMRInfo::create([
                            'app_no' => $appno,
                            'establishment_name' => $name,
                            'establishment_address' => $address,
                            'occupancy' => $occupancy,
                            'no_of_floors' => $floors,
                            'reference_no' => $referenceno,
                            'building_use' => $buildinguse,
                            'service_availed' => $service,
                            'client_id' => $requestedby,
                            'processed_by' => Auth::id(),
                            'date_processed' => date('Y-m-d H:i:s')
                        ])->id;

                if ($request->hasFile('images')) {
                    $count = 0;
                    $types = ($request->input('types')) ? $request->input('types') : null;

                    foreach ($request->file('images') as $file) {
                        $filename = date('Y_m_d_H_i_s_'.substr((string)microtime(), 2, 4)).'.jpg';
                        Storage::disk('attachments')->putFileAs('/', $file, $filename);

                        FSMRAttachments::create([
                            'fsmr_id' => $fsmrid,
                            'attachment_type_id' => $types[$count++],
                            'url' => $filename
                        ]);
                    }
                }

                return [
                        "title" => "Success",
                        "message" => "Fire Safety Maintenance Report successfully submitted!",
                        "icon" => "success",
                        "id" => $fsmrid
                ];
            }
            
        }
        else{
            if (! Gate::allows('New FSMR Application')) {
                abort(403);
            }
    
            $fsmrid = ($request->input('id')) ? $request->input('id') : '';
            $fsmr = FSMRInfo::with(['processor', 'attachments.attachmenttype'])->where('id', $fsmrid)->first();

            $attachment_types = AttachmentTypes::all();
            $clients = User::where('role', 2)->orderBy('lastname', 'asc')->orderBy('firstname', 'asc')->get();

            return view('transactions.fsmr.application', [
                    'attachment_types' => $attachment_types,
                    'app_no' => $this->generateAppNo(),
                    'clients' => $clients,
                    'fsmr' => $fsmr
                ]);
        }
    }

    function fsmrMyApp(Request $request){
        $retrieve = ($request->input('retrieve')) ? 1 : 0;
        $userid = Auth::id();
        $fsmrs = FSMRInfo::with(['processor'])->where('client_id', $userid)->where('status', 1)->get();
        
        if ($retrieve){
            return view('transactions.fsmr.list.table', ['fsmrs' => $fsmrs]);
        }
        else{
            if (! Gate::allows('My FSMR Applications')) {
                abort(403);
            }

            return view('transactions.fsmr.myapplications.index');
        }
    }

    function fsmrList(Request $request){
        $retrieve = ($request->input('retrieve')) ? 1 : 0;
        $fsmrs = FSMRInfo::with(['processor', 'client'])->where('status', 1)->get();
        
        if ($retrieve){
            return view('transactions.fsmr.list.table', ['fsmrs' => $fsmrs]);
        }
        else{
            if (! Gate::allows('List of FSMRs')) {
                abort(403);
            }

            return view('transactions.fsmr.list.index');
        }
    }

    function viewFSMR(Request $request){
        $id = ($request->input('id')) ? $request->input('id') : null;
        $fsmr = FSMRInfo::with(['attachments', 'attachments.attachmenttype', 'fps', 'eer', 'fss'])->where('id', $id)->first();
        $firesystems = FireSystemDeviceCategories::with(['devices'])->get();
        $eerChecklist = FireEmergencyExitRoutesChecklist::where('status', 1)->get();
        $fssChecklist = FireSuppressionSystemChecklist::where('status', 1)->get();
        $signatories = Signatory::where('status', 1)->get();
        $assessments = Assessment::with(['category', 'response_types'])->where('status', 1)->get();
        $fire_equipments = FireSuppressionEquipments::where('status', 1)->get();

        return view('transactions.fsmr.fsmr-view', [
            'fsmr' => $fsmr,
            'firesystems' => $firesystems,
            'eerChecklist' => $eerChecklist,
            'fssChecklist' => $fssChecklist,
            'signatories' => $signatories,
            'assessments' => $assessments,
            'fire_equipments' => $fire_equipments
        ]);
    }

    function saveFPS(Request $request){
        $fps = ($request->input('fps')) ? json_decode($request->input('fps'), true) : [];
        $fsmrid = ($request->input('fsmr-id')) ? $request->input('fsmr-id') : null;
        $manufacturer = ($request->input('manufacturer')) ? $request->input('manufacturer') : null;
        $model = ($request->input('model')) ? $request->input('model') : null;
        $circuit = ($request->input('circuit-style')) ? $request->input('circuit-style') : null;

        FSMRInfo::where('id', $fsmrid)->update([
            'fps_manufacturer' => $manufacturer,
            'fps_model' => $model,
            'fps_circuit' => $circuit,
        ]);

        if (!blank($fps)){
            FSMRFirePreventionSystem::where('fsmr_id', $fsmrid)->delete();
            foreach ($fps as $fp){
                FSMRFirePreventionSystem::create([
                    'fsmr_id' => $fsmrid,
                    'item_id' => ($fp[1]) ? $fp[1] : NULL,
                    'item_count' => ($fp[2]) ? $fp[2] : '',
                    'circuit' => ($fp[3]) ? $fp[3] : NULL,
                    'item_tested_count' => ($fp[4]) ? $fp[4] : ''
                ]);
            }
        }

        return [
            "title" => "Success",
            "message" => "Fire prevention system information successfully stored!",
            "icon" => "success"
        ];
    }

    function saveEER(Request $request){
        $eers = ($request->input('eer')) ? json_decode($request->input('eer'), true) : [];
        $fsmrid = ($request->input('fsmr-id')) ? $request->input('fsmr-id') : null;
        $manufacturer = ($request->input('eer-manufacturer')) ? $request->input('eer-manufacturer') : null;
        $hardware = ($request->input('eer-hardware')) ? $request->input('eer-hardware') : null;
        $remarks = ($request->input('eer-remarks')) ? $request->input('eer-remarks') : null;

        FSMRInfo::where('id', $fsmrid)->update([
            'eer_manufacturer' => $manufacturer,
            'eer_hardware' => $hardware,
            'eer_remarks' => $remarks,
        ]);

        if (!blank($eers)){
            FSMREmergencyExitRoutes::where('fsmr_id', $fsmrid)->delete();
            foreach ($eers as $eer){
                FSMREmergencyExitRoutes::create([
                    'fsmr_id' => $fsmrid,
                    'checklist_id' => ($eer[0]) ? $eer[0] : 0,
                    'status' => ($eer[1]) ? $eer[1] : 0,
                    'remarks' => ($eer[2]) ? $eer[2] : ''
                ]);
            }
        }

        return [
            "title" => "Success",
            "message" => "Emergency exit and routes information succesfully saved!",
            "icon" => "success"
        ];
    }

    function saveFSS(Request $request){
        $fss = ($request->input('fss')) ? json_decode($request->input('fss'), true) : [];
        $fsmrid = ($request->input('fsmr-id')) ? $request->input('fsmr-id') : null;
        $inspection_date = ($request->input('fss-inspection-date')) ? $request->input('fss-inspection-date') : null;
        $unit = ($request->input('fss-unit')) ? $request->input('fss-unit') : null;
        $frequency = ($request->input('fss-frequency')) ? $request->input('fss-frequency') : null;
        $report = ($request->input('fss-report')) ? $request->input('fss-report') : null;
        $remarks = ($request->input('fss-remarks')) ? $request->input('fss-remarks') : null;

        FSMRInfo::where('id', $fsmrid)->update([
            'fss_inspection_date' => $inspection_date,
            'fss_unit' => $unit,
            'fss_frequency' => $frequency,
            'fss_report' => $report,
            'fss_remarks' => $remarks
        ]);

        if (!blank($fss)){
            FSMRFireSuppressionSystem::where('fsmr_id', $fsmrid)->delete();
            foreach ($fss as $fs){
                FSMRFireSuppressionSystem::create([
                    'fsmr_id' => $fsmrid,
                    'checklist_id' => ($fs[0]) ? $fs[0] : 0,
                    'status' => ($fs[1]) ? $fs[1] : 0,
                    'remarks' => ($fs[2]) ? $fs[2] : ''
                ]);
            }
        }

        return [
            "title" => "Success",
            "message" => "Fire suppression system information succesfully saved!",
            "icon" => "success"
        ];
    }

    function saveAssessment(Request $request){
        $assessments = ($request->input('assess')) ? json_decode($request->input('assess'), true) : [];
        $fees = ($request->input('fee')) ? json_decode($request->input('fee'), true) : [];

        $formDataString = $request->input('formData');
        parse_str($formDataString, $formData);

        $fsmrid = ($formData['fsmr-id']) ? $formData['fsmr-id'] : null;
        $fe_required = ($formData['no-fe-bfp']) ? $formData['no-fe-bfp'] : null;
        $fe_available = ($formData['no-fe-available']) ? $formData['no-fe-available'] : null;
        $fe_refill = ($formData['no-fe-refill']) ? $formData['no-fe-refill'] : 0;
        $conductor = ($formData['conductor']) ? $formData['conductor'] : null;
        $inspector = ($formData['inspector']) ? $formData['inspector'] : null;
        $proprietor = ($formData['proprietor']) ? $formData['proprietor'] : null;

        FSMRInfo::where('id', $fsmrid)->update([
            'technician' => $conductor,
            'inspector' => $inspector,
            'contractor' => $proprietor,
            'assessment_fe_required' => $fe_required,
            'assessment_fe_available' => $fe_available,
            'assessment_fe_refilled' => $fe_refill
        ]);

        if (!blank($assessments)){
            FSMRAssessment::where('fsmr_id', $fsmrid)->delete();
            foreach ($assessments as $assessment){
                FSMRAssessment::create([
                    'fsmr_id' => $fsmrid,
                    'assessment_id' => $assessment[0],
                    'response_type' => $assessment[1]
                ]);
            }
        }

        if (!blank($fees)){
            FSMRExtinguishersEquipment::where('fsmr_id', $fsmrid)->delete();
            foreach ($fees as $fee){
                FSMRExtinguishersEquipment::create([
                    'fsmr_id' => $fsmrid,
                    'item' => $fee[1],
                    'quantity' => $fee[2],
                    'available' => $fee[3],
                    'required' => $fee[4],
                ]);
            }
        }

        return [
            "title" => "Success",
            "message" => "Assessment information succesfully saved!",
            "icon" => "success"
        ];
    }

    function printFSMR(Request $request){
        $id = ($request->input('fsmrid')) ?? null;
        $contents = FSMRContent::with(['subcontents.attachment_type'])->where('status', 1)->get();
        $fsmr = FSMRInfo::with(['attachments.attachmenttype', 'fps', 'eer', 'fss', 'assessments.question.category', 'fee', 'client.addr_town'])->where('id', $id)->first();
        $fdas = FireSystemDeviceCategories::with(['devices' => function ($query) {
                $query->where('status', 1);
            }])->where('status', 1)->get();
        $fss = FireSuppressionSystemChecklist::where('status', 1)->get();
        $eer = FireEmergencyExitRoutesChecklist::where('status', 1)->get();
        $fse = FireSuppressionEquipments::where('status', 1)->get();
        $fsmr_fse = FSMRExtinguishersEquipment::where('fsmr_id', $id)->get();
        $signatories = Signatory::where('status', 1)->get();
        $assessments = Assessment::with(['category', 'responses'])->where('status', 1)->get();
        $recommendations = Recommendation::with(['category'])->where('status', 1)->get();
        $settings = Settings::all();
        
        $business_name = $settings->where('code', 'business_name')->first()->description;
        $business_address = $settings->where('code', 'business_address')->first()->description;
        $business_location = $settings->where('code', 'location')->first()->description;
        $business_number = $settings->where('code', 'number')->first()->description;
        $business_dti = $settings->where('code', 'dti')->first()->description;
        $business_bir = $settings->where('code', 'bir')->first()->description;
        $business_permit = $settings->where('code', 'mo_permit')->first()->description;
        $town = $fsmr->client->addr_town->description ?? '';

        $labels = [];
        $available = [];
        $required = [];
        foreach ($fse as $f) {
            $found = 0;
            $label = $f->quantity.'-'.$f->item;
            $labels[] = $label;
        
            foreach ($fsmr_fse as $fsmr_f) {
                if ($f->item == $fsmr_f->item && $f->quantity == $fsmr_f->quantity) {
                    $available[] = $fsmr_f->available;
                    $required[] = $fsmr_f->required;
                    $found = 1;
                    break;
                }
            }

            if (!$found){
                $available[] = 0;
                $required[] = 0; 
            }
        }
        
        return view('transactions.fsmr.fsmr', [
            'contents' => $contents,
            'fsmr' => $fsmr,
            'fdas' => $fdas,
            'fss' => $fss,
            'eer' => $eer,
            'signatories' => $signatories,
            'settings' => $settings,
            'assessments' => $assessments,
            'recommendations' => $recommendations,
            'chart' => [
                    'label' => json_encode($labels, JSON_UNESCAPED_UNICODE),
                    'available' => json_encode($available, JSON_UNESCAPED_UNICODE),
                    'required' => json_encode($required, JSON_UNESCAPED_UNICODE)
            ],
            'business' => (object) [
                                    'name' => $business_name ?? '',
                                    'address' => $business_address ?? '',
                                    'location' => $business_location ?? '',
                                    'number' => $business_number ?? '',
                                    'dti' => $business_dti ?? '',
                                    'bir' => $business_bir ?? '',
                                    'mo_permit' => $business_permit ?? ''
                                    ],
            'params' =>    [
                                    '{establishment_name}' => $fsmr->establishment_name,
                                    '{establishment_address}' => $fsmr->establishment_address,
                                    '{year}' => (date('Y')-1).'-'.date('Y'),
                                    '{date_issued}' => date("jS \\d\\a\\y \\o\\f F Y"),
                                    '{name}' => $business_name,
                                    '{address}' => $business_address,
                                    '{bfp}' => ($town) ? 'BFP-'.$town : 'BFP'
                                    ],

        ]);
    }

    public function generateAppNo()
    {
        $year = date('y');

        $lastAppNo = FSMRInfo::query()
            ->orderBy('app_no', 'desc')
            ->value('app_no');

        if ($lastAppNo) {
            $lastCounter = (int) substr($lastAppNo, strpos($lastAppNo, '-') + 1);
            $nextCounter = $lastCounter + 1;
        } else {
            $nextCounter = 1;
        }

        $formattedCounter = str_pad($nextCounter, 10, '0', STR_PAD_LEFT);
        $newAppNo = "{$year}-{$formattedCounter}";

        return $newAppNo;
    }
}
