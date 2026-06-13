<?php

namespace App\Http\Controllers;

use App\Models\BidTblDefaultUpload;
use App\Models\BidTblDefaultUploadType;
use App\Models\BidTblDetailedEstimate;
use App\Models\BidTblEquipments;
use App\Models\BidTblTERequirements;
use App\Models\BidTblManPowerRequirement;
use App\Models\BidTblManPowerType;
use App\Models\BidTblNetFinancialContractingCapacity;
use App\Models\BidTblProject;
use App\Models\BidTblPages;
use App\Models\BidTblProjectDeliverySchedule;
use App\Models\BidTblDocumentAttachments;
use App\Models\Settings;
use App\Models\Signatory;
use App\Models\BidTblAllOngoingProjects;
use App\Models\BidTblSingleLargestContracts;
use App\Models\ProjectTemplate;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DataTables;

class BidTransactionController extends Controller
{
    //Start of Default Documents and Uploads Section
    public function defDocumentIndex(Request $request)
    {
        $status = $request->status ?? 1; // default active

        $data = BidTblDefaultUploadType::where('status', $status)
            ->latest()
            ->get();

        return view('transactions.bid.upload-types.index', compact('data', 'status'));
    }

    public function defDocumentStore(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255'
        ]);

        BidTblDefaultUploadType::create($request->all());

        return response()->json(['success' => true]);
    }

    public function defDocumentUpdate(Request $request, $id)
    {
        $data = BidTblDefaultUploadType::findOrFail($id);
        $data->update($request->all());

        return response()->json(['success' => true]);
    }

    public function defDocumentToggle($id)
    {
        $data = BidTblDefaultUploadType::findOrFail($id);
        $data->status = $data->status == 1 ? 0 : 1;
        $data->save();

        return redirect()->back()->with('success', 'Status updated.');
    }

    public function defDocumentUploadPage($id)
    {
        $document = BidTblDefaultUploadType::findOrFail($id);
        $uploads = BidTblDefaultUpload::where('upload_type_id', $id)
            ->latest()
            ->get();

        return view('transactions.bid.upload-types.upload', compact('document', 'uploads'));
    }

    // public function defDocumentUploadStore(Request $request, $id)
    // {
    //     $request->validate([
    //         'image' => 'required'
    //     ]);

    //     // Decode base64 image
    //     $image = $request->image;

    //     $image = str_replace('data:image/jpeg;base64,', '', $image);
    //     $image = str_replace(' ', '+', $image);

    //     $imageName = time() . '.jpg';

    //     \File::put(public_path('uploads/default-docs/') . $imageName, base64_decode($image));

    //     // Deactivate old
    //     // BidTblDefaultUpload::where('upload_type_id', $id)
    //     //     ->update(['is_active' => 0]);

    //     // Save new
    //     BidTblDefaultUpload::create([
    //         'upload_type_id' => $id,
    //         'image_url' => 'uploads/default-docs/' . $imageName,
    //         'is_active' => 1,
    //         'status' => 1
    //     ]);

    //     return response()->json(['success' => true]);
    // }

    public function defDocumentUploadStore(Request $request, $id)
    {
        $request->validate([
            'image' => 'required'
        ]);

        $image = $request->image;

        // Get mime type
        preg_match('/^data:image\/(\w+);base64,/', $image, $type);

        $extension = strtolower($type[1]); // jpg, png, jpeg, webp

        // Allowed extensions
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];

        if (!in_array($extension, $allowed)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid image type.'
            ], 422);
        }

        // Remove base64 header
        $image = preg_replace('/^data:image\/\w+;base64,/', '', $image);

        $image = str_replace(' ', '+', $image);

        $imageName = time() . '.' . $extension;

        \File::put(
            public_path('uploads/default-docs/') . $imageName,
            base64_decode($image)
        );

        BidTblDefaultUpload::create([
            'upload_type_id' => $id,
            'image_url' => 'uploads/default-docs/' . $imageName,
            'is_active' => 1,
            'status' => 1
        ]);

        return response()->json(['success' => true]);
    }

    public function defDocumentUploadSetActive($id)
    {
        $record = BidTblDefaultUpload::findOrFail($id);

        // Deactivate all
        // BidTblDefaultUpload::where('upload_type_id', $record->upload_type_id)
        //     ->update(['is_active' => 0]);

        // Activate selected
        $record->update(['is_active' => 1]);

        return back()->with('success', 'Set as active.');
    }

    public function defDocumentUploadSetInactive($id)
    {
        $record = BidTblDefaultUpload::findOrFail($id);

        // Deactivate all
        // BidTblDefaultUpload::where('upload_type_id', $record->upload_type_id)
        //     ->update(['is_active' => 1]);

        // Activate selected
        $record->update(['is_active' => 0]);

        return back()->with('success', 'Set as inactive.');
    }
    //End of Default Documents and Uploads Section

    public function manPowerTypeIndex(Request $request)
    {
        $status = $request->status ?? 1;

        $data = BidTblManPowerType::where('status', $status)
            ->latest()
            ->get();

        return view('transactions.bid.man-power-types.index', compact('data', 'status'));
    }

    public function manPowerTypeStore(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255'
        ]);

        BidTblManPowerType::create([
            'name' => $request->name,
            'status' => 1
        ]);

        return response()->json(['success' => true]);
    }

    public function manPowerTypeUpdate(Request $request, $id)
    {
        $data = BidTblManPowerType::findOrFail($id);

        $data->update([
            'name' => $request->name
        ]);

        return response()->json(['success' => true]);
    }

    public function manPowerTypeToggle(Request $request, $id)
    {
        $data = BidTblManPowerType::findOrFail($id);

        $data->status = $data->status == 1 ? 0 : 1;
        $data->save();

        return redirect()->back()->with('success', 'Status updated.');
    }

    public function equipmentIndex(Request $request)
    {
        $status = $request->status ?? 1;

        $data = BidTblEquipments::where('status', $status)
            ->latest()
            ->get();

        return view('transactions.bid.tools-equipments.index', compact('data', 'status'));
    }

    public function equipmentStore(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'type' => 'required|in:Tool,Equipment'
        ]);

        BidTblEquipments::create([
            'name' => $request->name,
            'description' => $request->description,
            'type' => $request->type,
            'status' => 1
        ]);

        return response()->json(['success' => true]);
    }

    public function equipmentUpdate(Request $request, $id)
    {
        $data = BidTblEquipments::findOrFail($id);

        $data->update([
            'name' => $request->name,
            'description' => $request->description,
            'type' => $request->type
        ]);

        return response()->json(['success' => true]);
    }

    public function equipmentToggle(Request $request, $id)
    {
        $data = BidTblEquipments::findOrFail($id);

        $data->status = $data->status == 1 ? 0 : 1;
        $data->save();

        return redirect()->back()->with('success', 'Status updated.');
    }

    //Start of Projects Module
    public function projectIndex(Request $request)
    {
        if ($request->ajax()) {

            $projects = BidTblProject::query();

            if ($request->status == 'trash') {
                $projects->where('status', 0);
            } else {
                $projects->where('status', 1);
            }

            return DataTables::of($projects)
                ->addColumn('status', function ($row) {
                    return $row->status == 1
                        ? '<span class="badge badge-success">Active</span>'
                        : '<span class="badge badge-danger">Trashed</span>';
                })
                ->addColumn('action', function ($row) {

                    if ($row->status == 0) {
                        return '<button class="btn btn-success btn-sm restoreBtn" data-id="'.$row->id.'">
                                    Restore
                                </button>';
                    } else {
                        return '<a href="/transaction/bids/projects/view/'.$row->id.'" class="btn btn-primary btn-sm">View</a>
                                <a href="/transaction/bids/projects/edit/'.$row->id.'" class="btn btn-warning btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm trashBtn" data-id="'.$row->id.'">
                                    Delete
                                </button>
                                ';
                    }

                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('transactions.bid.projects.index');
    }

    public function projectCreate()
    {
        $templates = ProjectTemplate::orderBy('template_name')->get();
        return view('transactions.bid.projects.form', compact('templates'));
    }

    public function projectStore(Request $request)
    {
        $request->merge([
            'project_cost' => str_replace(',', '', $request->project_cost)
        ]);

        $request->validate([
            'project_cost' => 'required',
            'agency_logo_url' => 'nullable|image'
        ]);

        $data = $request->all();

        // Remove commas from project_cost
        //$data['project_cost'] = str_replace(',', '', $request->project_cost);

        if ($request->hasFile('agency_logo_url')) {
            $file = $request->file('agency_logo_url');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/project-logos'), $filename);
            $data['agency_logo_url'] = 'uploads/project-logos/'.$filename;
        }

        $project = BidTblProject::create($data);

        return redirect()->route('projects.view', $project->id)
            ->with('success', 'Project created successfully');

    }

    public function projectEdit($id)
    {
        $data = BidTblProject::findOrFail($id);
        $templates = ProjectTemplate::orderBy('template_name')->get();
        return view('transactions.bid.projects.form', compact('data', 'templates'));
    }

    public function projectUpdate(Request $request, $id)
    {
        $project = BidTblProject::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('agency_logo_url')) {

            // optional: delete old file
            if ($project->agency_logo_url && file_exists(public_path($project->agency_logo_url))) {
                unlink(public_path($project->agency_logo_url));
            }

            $file = $request->file('agency_logo_url');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/project-logos'), $filename);

            $data['agency_logo_url'] = 'uploads/project-logos/'.$filename;
        }

        $project->update($data);

        return redirect()->route('projects.view', $project->id)
            ->with('success', 'Project updated successfully');
    }

    public function trash($id)
    {
        BidTblProject::findOrFail($id)->update([
            'status' => 0
        ]);

        return response()->json(['success' => true]);
    }

    public function restore($id)
    {
        BidTblProject::findOrFail($id)->update([
            'status' => 1
        ]);

        return response()->json(['success' => true]);
    }

    public function projectToggle($id)
    {
        $data = BidTblProject::findOrFail($id);

        $data->status = 0;
        $data->save();

        return back()->with('success', 'Project moved to trash');
    }

    public function projectView($id)
    {
        $data = BidTblProject::findOrFail($id);
        $manPowerTypes = BidTblManPowerType::where('status', 1)->get();
        $equipments = BidTblEquipments::where('status', 1)->get();
        $attachments = BidTblDocumentAttachments::where('project_id', $id)
        ->orderBy('id', 'desc')
        ->get();

        return view('transactions.bid.projects.view', compact('data', 'manPowerTypes', 'equipments', 'attachments'));
    }
    //End of Projects Module

    //Start Delivery Schedule Module
    public function deliveryScheduleIndex(Request $request, $projectId)
    {
        if ($request->ajax()) {

            $data = BidTblProjectDeliverySchedule::where('project_id', $projectId);

            return datatables($data)
                ->addColumn('action', function ($row) {

                    return '
                        <button class="btn btn-info btn-sm editBtn"
                            data-id="'.$row->id.'"
                            data-description="'.$row->description.'"
                            data-schedule="'.$row->schedule.'"
                            data-amount="'.$row->amount.'"
                            data-remarks="'.$row->remarks.'">
                            Edit
                        </button>

                        <button class="btn btn-danger btn-sm deleteBtn"
                            data-id="'.$row->id.'">
                            Delete
                        </button>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function deliveryScheduleStore(Request $request, $projectId)
    {
        BidTblProjectDeliverySchedule::create([
            'project_id' => $projectId,
            'description' => $request->description,
            'schedule' => $request->schedule,
            'amount' => $request->amount,
            'remarks' => $request->remarks
        ]);

        return response()->json(['success' => true]);
    }

    public function deliveryScheduleUpdate(Request $request, $id)
    {
        $data = BidTblProjectDeliverySchedule::findOrFail($id);

        $data->update([
            'description' => $request->description,
            'schedule' => $request->schedule,
            'amount' => $request->amount,
            'remarks' => $request->remarks
        ]);

        return response()->json(['success' => true]);
    }

    public function deliveryScheduleDelete($id)
    {
        BidTblProjectDeliverySchedule::findOrFail($id)->delete();

        return response()->json(['success' => true]);
    }
    //End Delivery Schedule Module

    //Start Detailed Estimate Module
    public function detailedEstimateIndex(Request $request, $projectId)
    {
        if ($request->ajax()) {

            $data = BidTblDetailedEstimate::where('project_id', $projectId);

            return datatables($data)
                ->addColumn('action', function ($row) {

                    return '
                        <button class="btn btn-info btn-sm editPowBtn"
                            data-id="'.$row->id.'"
                            data-description="'.$row->description.'"
                            data-quantity="'.$row->quantity.'"
                            data-unit="'.$row->unit.'"
                            data-unit_cost="'.$row->unit_cost.'"
                            data-total_cost="'.$row->total_cost.'">
                            Edit
                        </button>

                        <button class="btn btn-danger btn-sm deletePowBtn"
                            data-id="'.$row->id.'">
                            Delete
                        </button>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function detailedEstimateStore(Request $request, $projectId)
    {
        BidTblDetailedEstimate::create([
            'project_id' => $projectId,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'unit_cost' => $request->unit_cost,
            'total_cost' => $request->total_cost
        ]);

        return response()->json(['success' => true]);
    }

    public function detailedEstimateUpdate(Request $request, $id)
    {
        $data = BidTblDetailedEstimate::findOrFail($id);

        $data->update([
            'description' => $request->description,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'unit_cost' => $request->unit_cost,
            'total_cost' => $request->total_cost
        ]);

        return response()->json(['success' => true]);
    }

    public function detailedEstimateDelete($id)
    {
        BidTblDetailedEstimate::findOrFail($id)->delete();

        return response()->json(['success' => true]);
    }
    //End Detailed Estimate Module

    //Start Man-Power Requirements Module
    public function manpowerIndex(Request $request, $projectId)
    {
        if ($request->ajax()) {

            $data = BidTblManPowerRequirement::with('type')
                        ->where('project_id', $projectId);

            return datatables($data)
                ->addColumn('type_name', function ($row) {
                    return $row->type->name ?? '';
                })
                ->addColumn('action', function ($row) {

                    return '
                        <button class="btn btn-info btn-sm editManBtn"
                            data-id="'.$row->id.'"
                            data-type="'.$row->man_power_type_id.'"
                            data-quantity="'.$row->quantity.'"
                            data-task="'.$row->task.'">
                            Edit
                        </button>

                        <button class="btn btn-danger btn-sm deleteManBtn"
                            data-id="'.$row->id.'">
                            Delete
                        </button>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function manpowerStore(Request $request, $projectId)
    {
        BidTblManPowerRequirement::create([
            'project_id' => $projectId,
            'man_power_type_id' => $request->man_power_type_id,
            'quantity' => $request->quantity,
            'task' => $request->task
        ]);

        return response()->json(['success' => true]);
    }

    public function manpowerUpdate(Request $request, $id)
    {
        $data = BidTblManPowerRequirement::findOrFail($id);

        $data->update([
            'man_power_type_id' => $request->man_power_type_id,
            'quantity' => $request->quantity,
            'task' => $request->task
        ]);

        return response()->json(['success' => true]);
    }

    public function manpowerDelete($id)
    {
        BidTblManPowerRequirement::findOrFail($id)->delete();

        return response()->json(['success' => true]);
    }

    public function manPowerAutoAdd($projectid, Request $request)
    {
        $solar_mp = [['man_power_type_id' => 1, 'quantity' => 1, 'task' => "Oversee timeline and compliance"],
        ['man_power_type_id' => 2, 'quantity' => 1, 'task' => "System Design"],
        ['man_power_type_id' => 3, 'quantity' => 3, 'task' => "Installation, wiring and commissioning"],
        ['man_power_type_id' => 4, 'quantity' => 3, 'task' => "Pole foundation, concrete works"],
        ['man_power_type_id' => 5, 'quantity' => 1, 'task' => "Inspect materials and final installation"]];

        $firesup_mp = [['man_power_type_id' => 1, 'quantity' => 1, 'task' => "Overall supervision and coordination of project activities"],
        ['man_power_type_id' => 6, 'quantity' => 1, 'task' => "Procurement, supplier coordination and documentation"],
        ['man_power_type_id' => 7, 'quantity' => 2, 'task' => "Receiving, inspection, storage, and preparation of units"],
        ['man_power_type_id' => 8, 'quantity' => 1, 'task' => "Inspection and verification of product specifications"],
        ['man_power_type_id' => 9, 'quantity' => 1, 'task' => "Transportation and delivery of fire extinguishers"],
        ['man_power_type_id' => 10, 'quantity' => 2, 'task' => "Loading, unloading and installation assistance"],
        ['man_power_type_id' => 11, 'quantity' => 1, 'task' => "Documentation, reports and turnover requirements"]];

        if ($request->project_type == 'solar'){
            foreach ($solar_mp as $item){
                $item['project_id'] = $projectid;
                $item['created_at'] = now();
                BidTblManPowerRequirement::create($item);
            }
        }
        else{
            foreach ($firesup_mp as $item){
                $item['project_id'] = $projectid;
                $item['created_at'] = now();
                BidTblManPowerRequirement::create($item);
            }
        }
    }
    //End Man-Power Requirements Module

    //Start Tools & Equipment Module
    public function teIndex(Request $request, $projectId)
    {
        if ($request->ajax()) {

            $data = BidTblTERequirements::with('equipment')
                        ->where('project_id', $projectId);

            return datatables($data)
                ->addColumn('name', function ($row) {
                    return $row->equipment->name ?? '';
                })
                ->addColumn('type', function ($row) {
                    return $row->equipment->type ?? '';
                })
                ->addColumn('action', function ($row) {

                    return '
                        <button class="btn btn-info btn-sm editTeBtn"
                            data-id="'.$row->id.'"
                            data-equipment="'.$row->tool_equipment_id.'"
                            data-quantity="'.$row->quantity.'">
                            Edit
                        </button>

                        <button class="btn btn-danger btn-sm deleteTeBtn"
                            data-id="'.$row->id.'">
                            Delete
                        </button>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function teStore(Request $request, $projectId)
    {
        BidTblTERequirements::create([
            'project_id' => $projectId,
            'tool_equipment_id' => $request->tool_equipment_id,
            'quantity' => $request->quantity
        ]);

        return response()->json(['success' => true]);
    }

    public function teUpdate(Request $request, $id)
    {
        $data = BidTblTERequirements::findOrFail($id);

        $data->update([
            'tool_equipment_id' => $request->tool_equipment_id,
            'quantity' => $request->quantity
        ]);

        return response()->json(['success' => true]);
    }

    public function teDelete($id)
    {
        BidTblTERequirements::findOrFail($id)->delete();

        return response()->json(['success' => true]);
    }
    //End Tools & Equipment Module

    //Start NFCC Module
    public function nfccIndex(Request $request, $projectId)
    {
        if ($request->ajax()) {

            $data = BidTblNetFinancialContractingCapacity::where('project_id', $projectId);

            return datatables($data)
                ->addColumn('action', function ($row) {

                    return '
                        <button class="btn btn-info btn-sm editNfccBtn"
                            data-id="'.$row->id.'"
                            data-name="'.$row->name.'"
                            data-year="'.$row->year.'"
                            data-amount="'.$row->amount.'">
                            Edit
                        </button>

                        <button class="btn btn-danger btn-sm deleteNfccBtn"
                            data-id="'.$row->id.'">
                            Delete
                        </button>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function nfccStore(Request $request, $projectId)
    {
        BidTblNetFinancialContractingCapacity::create([
            'project_id' => $projectId,
            'name' => $request->name,
            'year' => $request->year,
            'amount' => $request->amount,
            'status' => 1
        ]);

        return response()->json(['success' => true]);
    }

    public function nfccUpdate(Request $request, $id)
    {
        $data = BidTblNetFinancialContractingCapacity::findOrFail($id);

        $data->update([
            'name' => $request->name,
            'year' => $request->year,
            'amount' => $request->amount
        ]);

        return response()->json(['success' => true]);
    }

    public function nfccDelete($id)
    {
        BidTblNetFinancialContractingCapacity::findOrFail($id)->delete();

        return response()->json(['success' => true]);
    }
    //End NFCC Module

    //Start Project Attachments
    public function attachmentStore(Request $request, $id)
    {
        $request->validate([
            'image' => 'required',
            'attachment_type' => 'required'
        ]);

        $image = $request->image;

        preg_match('/^data:image\/(\w+);base64,/', $image, $type);

        $extension = strtolower($type[1]);

        $image = substr($image, strpos($image, ',') + 1);

        $image = str_replace(' ', '+', $image);

        $imageName = time() . '.' . $extension;

        \File::put(
            public_path('uploads/project-attachments/') . $imageName,
            base64_decode($image)
        );

        BidTblDocumentAttachments::create([
            'project_id' => $id,
            'attachment_type' => $request->attachment_type,
            'image_url' => 'uploads/project-attachments/' . $imageName
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    public function attachmentDelete($id)
    {
        $attachment = BidTblDocumentAttachments::findOrFail($id);

        if (\File::exists(public_path($attachment->image_url))) {
            \File::delete(public_path($attachment->image_url));
        }

        $attachment->delete();

        return response()->json([
            'success' => true
        ]);
    }
    //End Project Attachments

    //Start Ongoing Projects
    public function ongoingList($projectId)
    {
        $data = BidTblAllOngoingProjects::where('project_id', $projectId);

        return DataTables::of($data)
            ->addColumn('action', function ($row) {

                return '
                    <button class="btn btn-sm btn-info editOngoing" data-id="'.$row->id.'">Edit</button>
                    <button class="btn btn-sm btn-danger deleteOngoing" data-id="'.$row->id.'">Delete</button>
                ';

            })
            ->make(true);
    }

    public function storeOrUpdateOngoing(Request $request)
    {
        $request->validate([
            'name_of_contract' => 'required'
        ]);

        // If existing record is selected → UPDATE
        if ($request->id) {

            $record = BidTblAllOngoingProjects::findOrFail($request->id);

            $record->update([
                'name_of_contract' => $request->name_of_contract,
                'project_cost' => $request->project_cost,
                'owner_name' => $request->owner_name,
                'project_type' => $request->project_type,
                'address' => $request->address,
                'telephone_no' => $request->telephone_no,
                'nature_of_work' => $request->nature_of_work,
                'bidder_role_description' => $request->bidder_role_description,
                'bidder_role_percentage' => $request->bidder_role_percentage,
                'date_awarded' => $request->date_awarded,
                'date_started' => $request->date_started,
                'date_of_completion' => $request->date_of_completion,
                'planned_percentage' => $request->planned_percentage,
                'actual_percentage' => $request->actual_percentage,
                'outstanding_works' => $request->outstanding_works,
                'date_signed' => $request->date_signed
            ]);

        } else {

            // CREATE NEW
            $record = BidTblAllOngoingProjects::create([
                'project_id' => $request->project_id,
                'name_of_contract' => $request->name_of_contract,
                'project_cost' => $request->project_cost,
                'owner_name' => $request->owner_name,
                'project_type' => $request->project_type,
                'address' => $request->address,
                'telephone_no' => $request->telephone_no,
                'nature_of_work' => $request->nature_of_work,
                'bidder_role_description' => $request->bidder_role_description,
                'bidder_role_percentage' => $request->bidder_role_percentage,
                'date_awarded' => $request->date_awarded,
                'date_started' => $request->date_started,
                'date_of_completion' => $request->date_of_completion,
                'planned_percentage' => $request->planned_percentage,
                'actual_percentage' => $request->actual_percentage,
                'outstanding_works' => $request->outstanding_works,
                'date_signed' => $request->date_signed
            ]);
        }

        // Always attach to project (if not already linked logic exists)
        $record->update([
            'project_id' => $request->project_id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Saved successfully'
        ]);
    }

    public function ongoingUpdate(Request $request, $projectId, $id)
    {
        $data = BidTblAllOngoingProjects::findOrFail($id);
        $data->update($request->all());
        return response()->json(['success' => true]);
    }

    public function ongoingDelete($id)
    {
        BidTblAllOngoingProjects::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }

    public function searchAllOngoing()
    {
        $records = BidTblAllOngoingProjects::select(
            'id',
            'name_of_contract',
            'owner_name'
        )
        ->orderBy('name_of_contract', 'asc')
        ->get();

        return response()->json($records);
    }

    public function showOngoing($id)
    {
        $record = BidTblAllOngoingProjects::findOrFail($id);

        return response()->json($record);
    }

    //End Ongoing Projects

    //Start Single largest Contract
    public function slccList($projectId)
    {
        $data = BidTblSingleLargestContracts::where(
            'project_id',
            $projectId
        );

        return DataTables::of($data)

            ->addColumn('action', function ($row) {

                return '
                    <button class="btn btn-info btn-sm editSlcc"
                        data-id="'.$row->id.'">
                        Edit
                    </button>

                    <button class="btn btn-danger btn-sm deleteSlcc"
                        data-id="'.$row->id.'">
                        Delete
                    </button>
                ';
            })

            ->make(true);
    }

    public function storeOrUpdateSlcc(Request $request)
    {
        $request->validate([
            'name_of_contract' => 'required'
        ]);

        if ($request->id) {

            $record = BidTblSingleLargestContracts::findOrFail(
                $request->id
            );

            $record->update([

                'name_of_contract' => $request->name_of_contract,
                'project_cost' => $request->project_cost,
                'project_type' => $request->project_type,
                'owner_name' => $request->owner_name,
                'address' => $request->address,
                'telephone_no' => $request->telephone_no,
                'nature_of_work' => $request->nature_of_work,
                'bidder_role_description' => $request->bidder_role_description,
                'bidder_role_percentage' => $request->bidder_role_percentage,
                'amount_of_award' => $request->amount_of_award,
                'amount_of_completion' => $request->amount_of_completion,
                'duration' => $request->duration,
                'date_awarded' => $request->date_awarded,
                'contract_effectivity' => $request->contract_effectivity,
                'date_completed' => $request->date_completed,
                'date_signed' => $request->date_signed
            ]);

        } else {

            $record = BidTblSingleLargestContracts::create([

                'project_id' => $request->project_id,
                'name_of_contract' => $request->name_of_contract,
                'project_cost' => $request->project_cost,
                'project_type' => $request->project_type,
                'owner_name' => $request->owner_name,
                'address' => $request->address,
                'telephone_no' => $request->telephone_no,
                'nature_of_work' => $request->nature_of_work,
                'bidder_role_description' => $request->bidder_role_description,
                'bidder_role_percentage' => $request->bidder_role_percentage,
                'amount_of_award' => $request->amount_of_award,
                'amount_of_completion' => $request->amount_of_completion,
                'duration' => $request->duration,
                'date_awarded' => $request->date_awarded,
                'contract_effectivity' => $request->contract_effectivity,
                'date_completed' => $request->date_completed,
                'date_signed' => $request->date_signed
            ]);
        }

        return response()->json([
            'success' => true
        ]);
    }

    public function slccDelete($id)
    {
        BidTblSingleLargestContracts::findOrFail($id)
            ->delete();

        return response()->json([
            'success' => true
        ]);
    }

    public function searchAllSlcc()
    {
        $records = BidTblSingleLargestContracts::select(
            'id',
            'name_of_contract',
            'owner_name'
        )
        ->orderBy('name_of_contract', 'asc')
        ->get();

        return response()->json($records);
    }

    public function showSlcc($id)
    {
        $record = BidTblSingleLargestContracts::findOrFail($id);

        return response()->json($record);
    }
    //End Single Largest Contract

    //Start Page Sequencing
    public function pagesSequencing(Request $request)
    {
        $componentType = $request->component_type ?? 'Technical Components';

        $pages = BidTblPages::where('component_type', $componentType)
            ->where('status', 1)
            ->orderBy('order', 'asc')
            ->get();

        return view(
            'transactions.bid.pages.sequence',
            compact('pages', 'componentType')
        );
    }

    public function pagesSequencingUpdate(Request $request)
    {
        foreach ($request->pages as $index => $id) {

            BidTblPages::where('id', $id)
                ->update([
                    'order' => $index + 1
                ]);
        }

        return response()->json([
            'success' => true
        ]);
    }
    //End Page Sequencing

    //Start Project Template Module
    public function projectTemplateIndex()
    {
        $templates = ProjectTemplate::orderBy('template_name')->get();

        return view('transactions.bid.project-template.index', compact('templates'));
    }

    public function projectTemplateCreate()
    {
        return view('transactions.bid.project-template.create');
    }

    public function projectTemplateStore(Request $request)
    {
        $request->validate([
            'template_name' => 'required|max:255'
        ]);

        ProjectTemplate::create($request->all());

        return redirect()
            ->route('project-template.index')
            ->with('success', 'Template created successfully.');
    }

    public function projectTemplateEdit($id)
    {
        $projectTemplate = ProjectTemplate::findOrFail($id);
        return view(
            'transactions.bid.project-template.edit',
            compact('projectTemplate')
        );
    }

    public function projectTemplateUpdate(Request $request, ProjectTemplate $projectTemplate)
    {
        $request->validate([
            'template_name' => 'required|max:255'
        ]);

        $projectTemplate->update($request->all());

        return redirect()
            ->route('project-template.index')
            ->with('success', 'Template updated successfully.');
    }

    public function projectTemplateDestroy(ProjectTemplate $projectTemplate)
    {
        $projectTemplate->delete();

        return back()
            ->with('success', 'Template deleted successfully.');
    }
    //End Project Template Module

    //Print Bid Docs
    public function printBidDocs($id, $component)
    {
        $settings = Settings::all();
        $business_name = $settings->where('code', 'business_name')->first()->description;
        $business_address = $settings->where('code', 'business_address')->first()->description;
        $signatories = Signatory::where('status', 1)->get();
        $business_location = $settings->where('code', 'location')->first()->description;
        $business_number = $settings->where('code', 'number')->first()->description;
        $business_dti = $settings->where('code', 'dti')->first()->description;
        $business_bir = $settings->where('code', 'bir')->first()->description;
        $business_permit = $settings->where('code', 'mo_permit')->first()->description;

        $nfcc = BidTblNetFinancialContractingCapacity::where('project_id', $id)->get();
        $delivery = BidTblProjectDeliverySchedule::where('project_id', $id)->get();
        $manpower = $data = BidTblManPowerRequirement::with('type')->where('project_id', $id)->get();
        $tools_and_equipments = BidTblTERequirements::with('equipment')->where('project_id', $id)->get();

        $project = BidTblProject::with([
            'aogpc',
            'slcc'
        ])->findOrFail($id);
        $projects = BidTblProject::where('status', 1)->whereNot('id', $id)->orderBy('project_type', 'ASC')->get();
        $project_attachments = BidTblDocumentAttachments::where('project_id', $id)->get();
        $default_attachments = BidTblDefaultUploadType::with(['defaultUploads' => function ($query) {
            $query->where('is_active', 1);
        }])->get();
        $bill_of_materials = BidTblDetailedEstimate::where('project_id', $id)->get();

        $component = ($component == 'technical') ? 'Technical Components' : 'Financial Components';
        $tc_pages = BidTblPages::where('status', 1)
            ->where('component_type', $component)
            ->orderBy('order', 'ASC')
            ->get();

        return view(
            'transactions.bid.projects.print',
            [
                'project' => $project,
                'tc_pages' => $tc_pages,
                'business' => (object) [
                    'name' => $business_name,
                    'address' => $business_address,
                    'location' => $business_location,
                    'number' => $business_number,
                    'dti' => $business_dti,
                    'bir' => $business_bir,
                    'mo_permit' => $business_permit
                ],
                'project_attachments' => $project_attachments,
                'attachments' => $default_attachments,
                'signatories' => $signatories,
                'nfcc' => $nfcc,
                'delivery' => $delivery,
                'manpower' => $manpower,
                'tools_and_equipments' => $tools_and_equipments,
                'bill_of_materials' => $bill_of_materials,
                'component' => $component

            ]
        );
    }
}
