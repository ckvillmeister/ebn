<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
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
use App\Models\Products;
use App\Models\ProductInventory;
use App\Models\Province;
use App\Models\Town;
use App\Models\InventoryLogs;
use App\Models\DeliveryTransaction;
use App\Models\DeliveredItems;
use App\Models\SalesTransaction;
use App\Models\SoldProducts;

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
            $referenceno = $this->generateReferenceNo();
            $buildinguse = ($request->input('building-used')) ? $request->input('building-used') : null;
            $service = ($request->input('service-availed')) ? $request->input('service-availed') : null;
            $province = $request->input('addr_province', null);
            $town = $request->input('addr_town', null);
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
                    'client_id' => $requestedby,
                    'addr_province' => $province,
                    'addr_town' => $town,
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
                            'date_processed' => date('Y-m-d H:i:s'),
                            'addr_province' => $province,
                            'addr_town' => $town,
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

            $provinces = Province::all()->sortBy("description");
            $province = ($fsmr) ? $fsmr->addr_province : null;
            $towns = ($province) ? Town::where('province_code', $province)->orderBy('description', 'ASC')->get() : null;

            return view('transactions.fsmr.application', [
                    'attachment_types' => $attachment_types,
                    'app_no' => $this->generateAppNo(),
                    'reference_no' => $this->generateReferenceNo(),
                    'clients' => $clients,
                    'fsmr' => $fsmr,
                    'provinces' => $provinces,
                    'towns' => $towns
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
        $fsmr = FSMRInfo::with(['attachments.attachmenttype', 'fps', 'eer', 'fss', 'assessments.question.category', 'fee', 'client.addr_town', 'town'])->where('id', $id)->first();
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
        $town = $fsmr->town->description ?? '';

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

    public function generateReferenceNo()
    {
        $prefix = "TACF";
        $suffix = "SP";

        // Retrieve the last reference number from the FSMRInfo model
        $lastRefNo = FSMRInfo::query()
            ->orderBy('reference_no', 'desc')
            ->value('reference_no');

        if ($lastRefNo) {
            // Extract the middle number (6-digit counter)
            $lastCounter = (int) substr($lastRefNo, 5, 6);
            $nextCounter = $lastCounter + 1;
        } else {
            $nextCounter = 1;
        }

        // Format the counter to ensure it has 6 digits (leading zeros)
        $formattedCounter = str_pad($nextCounter, 6, '0', STR_PAD_LEFT);

        // Generate the new reference number
        $newRefNo = "{$prefix}-{$formattedCounter}-{$suffix}";

        return $newRefNo;
    }

    function inventory(Request $request){
        $towns = Town::where('province_code', '0712')->orderBy('description', 'ASC')->get();
        return view('transactions.sales.inventory', compact('towns'));
    }

    function productForm(Request $request){
        $id = $request->input('id', null);
        $product = Products::where('id', $id)->first();
        $code = $this->generateProductCode();

        return view('transactions.sales.product-form', compact('product', 'code'));
    }

    function productList(Request $request){
        $status = ($request->has('status')) ? ($request->input('status') ? 1 : 0) : 1;
        $viewAll = $request->input('viewall', 0);
        $location = $request->input('location', 0);

        if ($viewAll) {
            $products = ProductInventory::with(['location', 'productInfo' => function ($query) use ($status) {
                                        $query->where('status', 1);
                                    }]);

            if ($location){
                $products = $products->where('location_id', $location);
            }

            $products = $products->orderBy('location_id', 'ASC');
            
            return DataTables::eloquent($products)
                ->addColumn('code', function ($inventory) {
                    return optional($inventory->productInfo)->code ?? '-';
                })
                ->addColumn('name', function ($inventory) {
                    return optional($inventory->productInfo)->name ?? '-';
                })
                ->addColumn('description', function ($inventory) {
                    return optional($inventory->productInfo)->description ?? '-';
                })
                ->addColumn('uom', function ($inventory) {
                    return optional($inventory->productInfo)->uom ?? '-';
                })
                ->addColumn('brand', function ($inventory) {
                    return optional($inventory->productInfo)->brand ?? '-';
                })
                ->addColumn('price', function ($inventory) {
                    return number_format(optional($inventory->productInfo)->price, 2) ?? '0.00';
                })
                ->addColumn('stocks', function ($inventory) {
                    return $inventory->stocks ?? 0;
                })
                ->addColumn('location', function ($inventory) {
                    return optional($inventory->location)->description ?? '-';
                })
                ->addColumn('action', function ($inventory) {
                    $buttons = '<a href="'.route("transaction-view-product")."?id=".$inventory->id.'" class="btn btn-sm btn-success waves-effect mr-2 mb-1" title="View Product Record" style="width: 80px">
                                    <i class="fas fa-eye mr-2"></i>View
                                </a>';
                    return $buttons;
                })
                ->rawColumns(['action'])
                ->make(true);
        }        
        else{
            $products = Products::with(['inventory'])
                                ->where('status', $status)
                                ->orderBy('id', 'DESC');

            return DataTables::eloquent($products)
                ->addColumn('price', function ($product) {
                return number_format($product->price, 2) ?? '0.0';
            })
            ->addColumn('stocks', function ($product) {
                $qty = 0;

                foreach ($product->inventory as $inv){
                    $qty += $inv->stocks;
                }

                return $qty;
            })
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && $request->search['value']) {
                    $search = $request->search['value'];

                    $query->where(function ($q) use ($search) {
                        $q->where(function ($q) use ($search) {
                            $q->where('code', 'like', "%{$search}%")
                            ->orWhere('name', 'like', "%{$search}%")
                            ->orWhere('description', 'like', "%{$search}%");
                        });
                    });
                }
            })
            ->addColumn('action', function ($product) {
                $buttons = '<a href="'.route("transaction-view-product")."?id=".$product->id.'" class="btn btn-sm btn-success waves-effect mr-2 mb-1" title="View Product Record" style="width: 80px">
                                <i class="fas fa-eye mr-2"></i>View
                            </a>';

                $buttons .= '<a href="'.route("transaction-product-update")."?id=".$product->id.'" class="btn btn-sm btn-warning waves-effect mr-2 mb-1" title="Edit Product Record" style="width: 80px">
                                <i class="fas fa-edit mr-2"></i>Edit
                            </a><br>';

                if ($product->status) {
                    $buttons .= '<button type="button" class="btn btn-sm btn-primary waves-effect mr-2 mb-1" title="Deactivate Product Record" value="' . $product->id . '" onclick="manageProductStocks(event, this)" style="width: 80px">
                                    <i class="fas fa-boxes mr-2"></i>Stocks
                                </button>';
                    $buttons .= '<button type="button" class="btn btn-sm btn-danger waves-effect mr-2 mb-1" title="Deactivate Product Record" value="' . $product->id . '" onclick="deleteProduct(event, this)" style="width: 80px">
                                    <i class="fas fa-trash-alt mr-2"></i>Delete
                                </button>';
                } else {
                    $buttons .= '<button type="button" class="btn btn-sm btn-success waves-effect mr-2 mb-1" title="Re-activate Product Record" value="' . $product->id . '" onclick="restoreProduct(event, this)" style="width: 80px">
                                    <i class="fas fa-undo-alt mr-2"></i>Re-activate
                                </button>';
                }
                return $buttons;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }

    function storeProduct(Request $request){
        $productid = $request->input('id') ?? '';
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
        ]);
        
        if ($validator->fails()){
            return ['icon'=>'error',
                    'title'=>'Error',
                    'message'=> $validator->errors()->first()
                ];
        }

        try {

            if ($productid){
                Products::where('id', $productid)->update([
                    'name' => $request->input('name'),
                    'description' => $request->input('description'),
                    'brand' => $request->input('brand'),
                    'uom' => $request->input('uom'),
                    'price' => $request->input('price')
                ]);

                return ['icon'=>'success',
                        'title'=>'Success',
                        'message'=>"Product info successfully updated!"];
            }
            else{
                Products::create([
                    'code' => $this->generateProductCode(),
                    'name' => $request->input('name'),
                    'description' => $request->input('description'),
                    'brand' => $request->input('brand'),
                    'uom' => $request->input('uom'),
                    'price' => $request->input('price')
                ]);

                return ['icon'=>'success',
                        'title'=>'Success',
                        'message'=>"New product info successfully stored!"];
            }
            
        } catch (\Exception $e) {
            return ['icon'=>'error',
                    'title'=>'Error',
                    'message'=> $e->getMessage()];
        }
    }

    function toggleProductStatus(Request $request){
        $id = $request->input('id');
        $status = $request->input('status');
        Products::where('id', $id)->update(['status' => $status]);
    }

    function manageStocks(Request $request){
        $productid = $request->input('product-id', null);
        $locationid = $request->input('location', null);
        $action = $request->input('action', null);
        $quantity = $request->input('quantity', null);

        $validator = Validator::make($request->all(), [
            'location' => 'required',
            'action' => 'required',
            'quantity' => 'required'
        ]);
        
        if ($validator->fails()){
            return ['icon'=>'error',
                    'title'=>'Error',
                    'message'=> $validator->errors()->first()
                ];
        }

        try {
            $product = ProductInventory::where('product_id', $productid)->where('location_id', $locationid)->first();

            if ($product){
                $newQty = 0;

                if (strtolower($action) == 'add'){
                    $newQty = $product->stocks + $quantity;
                }
                elseif (strtolower($action) == 'deduct'){
                    $newQty = $product->stocks - $quantity;
                    $quantity = $quantity * -1;
                }

                ProductInventory::where('product_id', $productid)->where('location_id', $locationid)->update([
                    'stocks' => $newQty
                ]);
            }
            else{
                ProductInventory::create([
                    'product_id' => $productid,
                    'location_id' => $locationid,
                    'stocks' => $quantity
                ]);
            }

            InventoryLogs::create([
                'product_id' => $productid,
                'action' => $action,
                'quantity' => $quantity,
                'processed_by' => Auth::id(),
                'date_processed' => date('Y-m-d H:i:s')
            ]);

            return ['icon'=>'success',
                        'title'=>'Success',
                        'message'=>"Product quantity successfully ".strtolower($action)."ed!"];
            
        } catch (\Exception $e) {
            return ['icon'=>'error',
                    'title'=>'Error',
                    'message'=> $e->getMessage()];
        }
    }

    function viewProduct(Request $request){
        $productid = $request->input('id', null);
        $product = Products::with(['inventory', 'inventory_logs.processed_by'])->where('id', $productid)->first();

        foreach ($product->inventory as $inv){
            $product->stocks += $inv->stocks;
        }

        return view('transactions.sales.product', compact('product'));
    }

    function delivery(Request $request){
        $products = Products::where('status', 1)->get();
        $towns = Town::where('province_code', '0712')->orderBy('description', 'ASC')->get();
        $code = $this->generateDeliveryCode();
        
        return view('transactions.sales.delivery', compact('products', 'towns', 'code'));
    }

    function saveDelivery(Request $request){
        $del_date = $request->input('delivery_date', null);
        $products = $request->input('products', []);
        $code = $this->generateDeliveryCode();

        $del_trans_id = DeliveryTransaction::create([
                                                        'code' => $code,
                                                        'delivery_date' => $del_date,
                                                        'processed_by' => Auth::id(),
                                                        'date_processed' => date('Y-m-d H:i:s'),
                                                        'status' => 1
                                                    ])->id;

        foreach ($products as $product){
            DeliveredItems::create([
                'delivery_transaction_id' => $del_trans_id,
                'product_id' => $product[0],
                'location' => $product[1],
                'quantity' => $product[2]
            ]);

            $prod = ProductInventory::where('product_id', $product[0])->where('location_id', $product[1])->first();

            if ($prod){
                $quantity = $prod->stocks + $product[2];

                ProductInventory::where('product_id', $product[0])->where('location_id', $product[1])->update([
                    'stocks' => $quantity
                ]);
            }
            else{
                ProductInventory::create([
                    'product_id' => $product[0],
                    'location_id' => $product[1],
                    'stocks' => $product[2],
                ]);
            }

            InventoryLogs::create([
                'product_id' => $product[0],
                'action' => 'Delivery',
                'quantity' => $product[2],
                'processed_by' => Auth::id(),
                'date_processed' => date('Y-m-d H:i:s')
            ]);
        }

        

        return ['icon'=>'success',
                        'title'=>'Success',
                        'message'=>"Delivery transaction successfully saved!"];
    }

    function deliveryList(Request $request){
        return view('transactions.sales.delivery-list');
    }

    function deliveryTransList(Request $request){
        $status = ($request->has('status')) ? ($request->input('status') ? 1 : 0) : 1;
        $transactions = DeliveryTransaction::with(['products.productInfo', 'processedBy'])
            ->where('status', $status)
            ->orderBy('id', 'DESC');

        return DataTables::eloquent($transactions)
            ->addColumn('delivery_date', function ($transaction) {
                return date('F d, Y', strtotime($transaction->delivery_date));
            })
            ->addColumn('processed_by', function ($transaction) {
                $fullname = $transaction->processedBy->firstname.' '.$transaction->processedBy->lastname;
                return '<label class="badge badge-primary">'.$fullname.'</label>';
            })
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && $request->search['value']) {
                    $search = $request->search['value'];

                    $query->where(function ($q) use ($search) {
                        $q->where(function ($q) use ($search) {
                            $q->where('code', 'like', "%{$search}%")
                            ->orWhere('delivery_date', 'like', "%{$search}%");
                        });
                    });
                }
            })
            ->addColumn('action', function ($transaction) {
                $buttons = '<button type="button" class="btn btn-sm btn-warning waves-effect mr-2" title="View Delivery Transaction Record" value="' . $transaction->id . '" onclick="viewDeliveryTransaction(event, this)" style="width: 80px" data-toggle="modal" data-target="#view-del-trans-modal">
                                    <i class="fas fa-eye mr-2"></i>View
                                </button>';
                $buttons .= '<button type="button" class="btn btn-sm btn-danger waves-effect mr-2" title="Delete Delivery Transaction Record" value="' . $transaction->id . '" onclick="deleteDeliveryTransaction(event, this)" style="width: 80px">
                                    <i class="fas fa-trash-alt mr-2"></i>Void
                                </button>';
                return $buttons;
            })
            ->rawColumns(['processed_by', 'action'])
            ->make(true);
    }

    function viewDeliveryTransaction(Request $request){
        $id = $request->input('id', null);
        $transaction = DeliveryTransaction::with(['products', 'processedBy'])->where('id', $id)->first();

        if ($transaction){
            $fullname = $transaction->processedBy->firstname.' '.$transaction->processedBy->lastname;
            $transaction->fullname = $fullname;
        }

        return view('transactions.sales.delivery-trans-detail', compact('transaction'));
    } 

    function deleteDeliveryTransaction(Request $request){
        $id = $request->input('id', null);
        DeliveryTransaction::where('id', $id)->update(['status' => 0]);

        $transaction = DeliveryTransaction::with(['products'])->where('id', $id)->first();

        foreach ($transaction->products as $product){
            $prod_id = $product->product_id;
            $location = $product->location;
            $quantity = $product->quantity;

            $prodInvInfo = ProductInventory::where('product_id', $prod_id)->where('location_id', $location)->first();

            if ($prodInvInfo){
                $stocks = $prodInvInfo->stocks;
                $new_quantity = $stocks - $quantity;

                ProductInventory::where('product_id', $prod_id)->where('location_id', $location)->update(['stocks' => $new_quantity]);

                InventoryLogs::create([
                    'product_id' => $prod_id,
                    'action' => 'Voided / Deducted',
                    'quantity' => $quantity * -1,
                    'processed_by' => Auth::id(),
                    'date_processed' => date('Y-m-d H:i:s')
                ]);
            }
        }

    }

    function getProductsByLocation(Request $request){
        $code = $request->input('code', null);

        $products = ProductInventory::with(['productInfo'])->where('location_id', $code)->get();

        foreach ($products as $product){
            $product->code = $product->productInfo->code;
            $product->name = $product->productInfo->name;
            $product->description = $product->productInfo->description;
            $product->brand = $product->productInfo->brand;
            $product->price = $product->productInfo->price;
        }

        return $products->toJson();
    }

    function sales(Request $request){
        $towns = Town::where('province_code', '0712')->orderBy('description', 'ASC')->get();
        $code = $this->generateSalesCode();
        
        return view('transactions.sales.sales-entry', compact('towns', 'code'));
    }

    function saveSalesTransaction(Request $request){
        $trans_date = $request->input('trans_date', null);
        $products = $request->input('products', []);
        $code = $this->generateSalesCode();

        $sale_trans_id = SalesTransaction::create([
                                                        'code' => $code,
                                                        'transaction_date' => $trans_date,
                                                        'processed_by' => Auth::id(),
                                                        'date_processed' => date('Y-m-d H:i:s'),
                                                        'status' => 1
                                                    ])->id;

        foreach ($products as $product){
            SoldProducts::create([
                'sale_transaction_id' => $sale_trans_id,
                'product_id' => $product[3],
                'location' => $product[2],
                'quantity' => $product[1],
                'price' => $product[0]
            ]);

            $prod = ProductInventory::where('product_id', $product[3])->where('location_id', $product[2])->first();

            if ($prod){
                $quantity = $prod->stocks - $product[1];

                ProductInventory::where('product_id', $product[3])->where('location_id', $product[2])->update([
                    'stocks' => $quantity
                ]);
            }

            InventoryLogs::create([
                'product_id' => $product[3],
                'action' => 'Sold',
                'quantity' => $product[1] * -1,
                'processed_by' => Auth::id(),
                'date_processed' => date('Y-m-d H:i:s')
            ]);
        }

        return ['icon'=>'success',
                        'title'=>'Success',
                        'message'=>"Sales transaction successfully saved!"];
    }

    function salesList(Request $request){
        return view('transactions.sales.sales-list');
    }

    function salesTransList(Request $request){
        $status = ($request->has('status')) ? ($request->input('status') ? 1 : 0) : 1;
        $transactions = SalesTransaction::with(['products.productInfo', 'processedBy'])
            ->where('status', $status)
            ->orderBy('id', 'DESC');

        return DataTables::eloquent($transactions)
            ->addColumn('transaction_date', function ($transaction) {
                return date('F d, Y', strtotime($transaction->transaction_date));
            })
            ->addColumn('processed_by', function ($transaction) {
                $fullname = $transaction->processedBy->firstname.' '.$transaction->processedBy->lastname;
                return '<label class="badge badge-primary">'.$fullname.'</label>';
            })
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && $request->search['value']) {
                    $search = $request->search['value'];

                    $query->where(function ($q) use ($search) {
                        $q->where(function ($q) use ($search) {
                            $q->where('code', 'like', "%{$search}%")
                            ->orWhere('transaction_date', 'like', "%{$search}%");
                        });
                    });
                }
            })
            ->addColumn('action', function ($transaction) {
                $buttons = '<button type="button" class="btn btn-sm btn-warning waves-effect mr-2" title="View Sales Transaction Record" value="' . $transaction->id . '" onclick="viewSalesTransaction(event, this)" style="width: 80px" data-toggle="modal" data-target="#view-sales-trans-modal">
                                    <i class="fas fa-eye mr-2"></i>View
                                </button>';
                $buttons .= '<button type="button" class="btn btn-sm btn-danger waves-effect mr-2" title="Void Sales Transaction Record" value="' . $transaction->id . '" onclick="voidSalesTransaction(event, this)" style="width: 80px">
                                    <i class="fas fa-trash-alt mr-2"></i>Void
                                </button>';
                return $buttons;
            })
            ->rawColumns(['processed_by', 'action'])
            ->make(true);
    }

    function voidSalesTransaction(Request $request){
        $id = $request->input('id', null);
        SalesTransaction::where('id', $id)->update(['status' => 0]);

        $transaction = SalesTransaction::with(['products'])->where('id', $id)->first();

        foreach ($transaction->products as $product){
            $prod_id = $product->product_id;
            $location = $product->location;
            $quantity = $product->quantity;

            $prodInvInfo = ProductInventory::where('product_id', $prod_id)->where('location_id', $location)->first();

            if ($prodInvInfo){
                $stocks = $prodInvInfo->stocks;
                $new_quantity = $stocks + $quantity;

                ProductInventory::where('product_id', $prod_id)->where('location_id', $location)->update(['stocks' => $new_quantity]);

                InventoryLogs::create([
                    'product_id' => $prod_id,
                    'action' => 'Voided / Returned',
                    'quantity' => $quantity * -1,
                    'processed_by' => Auth::id(),
                    'date_processed' => date('Y-m-d H:i:s')
                ]);
            }
        }

    }

    function viewSalesTransaction(Request $request){
        $id = $request->input('id', null);
        $transaction = SalesTransaction::with(['products', 'processedBy'])->where('id', $id)->first();

        if ($transaction){
            $fullname = $transaction->processedBy->firstname.' '.$transaction->processedBy->lastname;
            $transaction->fullname = $fullname;
        }

        return view('transactions.sales.sales-trans-detail', compact('transaction'));
    } 

    function generateProductCode(){
        $lastCode = Products::latest('code')->first();
        $lastNumber = 0;

        if ($lastCode) {
            $lastNumber = (int) substr($lastCode->code, 4);
        }

        $newNumber = $lastNumber + 1;
        $newCode = 'PROD' . str_pad($newNumber, 7, '0', STR_PAD_LEFT);

        return $newCode;
    }

    function generateDeliveryCode(){
        $lastCode = DeliveryTransaction::latest('code')->first();
        $lastNumber = 0;

        if ($lastCode) {
            $lastNumber = (int) substr($lastCode->code, 3);
        }

        $newNumber = $lastNumber + 1;
        $newCode = 'DEL' . str_pad($newNumber, 8, '0', STR_PAD_LEFT);

        return $newCode;
    }

    function generateSalesCode(){
        $lastCode = SalesTransaction::latest('code')->first();
        $lastNumber = 0;

        if ($lastCode) {
            $lastNumber = (int) substr($lastCode->code, 5);
        }

        $newNumber = $lastNumber + 1;
        $newCode = 'SALES' . str_pad($newNumber, 8, '0', STR_PAD_LEFT);

        return $newCode;
    }

}
