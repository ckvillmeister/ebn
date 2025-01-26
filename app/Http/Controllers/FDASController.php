<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Models\FireSystemDeviceCategories;
use App\Models\FireSystemDevices;

class FDASController extends Controller
{
    function index(Request $request){
        if (! Gate::allows('Fire Detection Alarm System Manager')) {
            abort(403);
        }

        return view('setup.fdas.index');
    }

    function retrieveCategories(Request $request){
        $status = $request->input('status');
        $categories = FireSystemDeviceCategories::where('status', $status)->get();
        return view('setup.fdas.category.list', compact('categories'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    function createCategory(Request $request){
        $id = $request->input('id');
        $category = isset($id) ? FireSystemDeviceCategories::where('id', $id)->first() : null;
        return view('setup.fdas.category.create', ['category' => $category]);
    }

    public function storeCategory(Request $request)
    {   
        $id = $request->input('id');
        
        if ($id){
            $validator = Validator::make($request->all(), [
                'category' => 'required|unique:fire_system_device_categories'
            ]);

            if ($validator->fails()){
                return ['icon'=>'error',
                    'title'=>'Error',
                    'message'=> $validator->errors()->first()];
            }

            FireSystemDeviceCategories::where('id', $id)->update(['category' => $request->input('category')]);
            return ['icon'=>'success',
                    'title'=>'Success',
                    'message'=>"FDAS category successfully updated!"];
        }
        else{
            $validator = Validator::make($request->all(), [
                'category' => 'required|unique:fire_system_device_categories'
            ]);

            if ($validator->fails()){
                return ['icon'=>'error',
                    'title'=>'Error',
                    'message'=> $validator->errors()->first()];
            }
    
            FireSystemDeviceCategories::create($request->all());
            return ['icon'=>'success',
                    'title'=>'Success',
                    'message'=>"FDAS category successfully created!"];
        }
    }

    function toggleCategoryStatus(Request $request){
        $id = $request->input('id');
        $status = $request->input('status');
        FireSystemDeviceCategories::where('id', $id)->update(['status' => $status]);
        return ($status) ? ['icon'=>'success',
                            'title'=>'Success',
                            'message'=>"FDAS category successfully re-activated!"] : ['icon'=>'success','title'=>'Success','message'=>"FDAS category successfully deleted!"];
    }

    function fdasDevices(Request $request){
        $id = $request->input('id');
        $status = $request->input('status') ? $request->input('status') : 0;
        $category = FireSystemDeviceCategories::with(['devices'])->where('id', $id)->first();

        return view('setup.fdas.devices.list', [
            'category' => $category,
            'status' => $status
        ]);
    }

    function createDevice(Request $request){
        $id = $request->input('id');
        $category = $request->input('category');

        $device = isset($id) ? FireSystemDevices::where('id', $id)->first() : null;
        return view('setup.fdas.devices.create', ['device' => $device, 'category' => $category]);
    }

    public function storeDevice(Request $request)
    {   
        $category = $request->input('category-id');
        $device = $request->input('device-id');
        
        if ($device){
            FireSystemDevices::where('id', $device)->update(['name' => $request->input('name')]);
            return ['icon'=>'success',
                    'title'=>'Success',
                    'message'=>"Device / appliance info successfully updated!"];
        }
        else{
            FireSystemDevices::create([
                'category_id' => $category,
                'name' => $request->input('name'),
                'status' => 1
            ]);

            return ['icon'=>'success',
                    'title'=>'Success',
                    'message'=>"Device / appliance successfully added!"];
        }
    }

    function toggleDeviceStatus(Request $request){
        $id = $request->input('id');
        $status = $request->input('status');
        FireSystemDevices::where('id', $id)->update(['status' => $status]);
        return ($status) ? ['icon'=>'success',
                            'title'=>'Success',
                            'message'=>"Device / appliance successfully re-activated!"] : ['icon'=>'success','title'=>'Success','message'=>"Device / appliance successfully deleted!"];
    }
}
