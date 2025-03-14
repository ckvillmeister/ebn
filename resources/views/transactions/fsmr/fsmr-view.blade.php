@extends('index')
@section('content')
<style>
    .eer-tbl input[type="radio"], #table-fss-list input[type="radio"], #table-assessment-list input[type="radio"] { 
        width: 20px; height: 20px;
    }
</style>
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-safe icon-gradient bg-amy-crisp">
                </i>
            </div>
            <div>Fire Safety Maintenance Report Application Overview
                <div class="page-title-subheading">Individual FSMR Application Overview of client
                </div>
            </div>
        </div>    
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card p-3">
            <div class="body" id="content">

                <div class="row">
                    <div class="col-sm-3">
                        @php ($url = "")

                        @if (!blank($fsmr->attachments))
                            @foreach($fsmr->attachments as $attachment)
                                @if ($attachment->attachmenttype->description == 'Exterior Details')
                                    @php ($url = $attachment->url)
                                @endif
                            @endforeach
                        @endif

                        @if ($url)
                            <img class="col-sm-12" src="{{ asset('files/attachments/'.$url) }}">
                        @else
                            <img class="col-sm-12" src="{{ asset('images/empty.gif') }}">
                        @endif
                        <div class="col-sm-12 text-center mt-2">
                            <a href="{{ route('transaction-fsmr-application').'?id='.request('id') }}" class="btn btn-warning"><i class="fas fa-edit mr-2"></i>Edit FSMR</a>
                            <button class="btn btn-success btn-print-fsmr"><i class="fas fa-print mr-2"></i>Print FSMR</button>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <h3>{{ ($fsmr) ? $fsmr->establishment_name : '' }}</h3>
                        <h6 class="text-primary"><i class="fas fa-map-marker mr-2"></i>{{ ($fsmr) ? $fsmr->establishment_address : '' }}</h6>
                        <div class="divider"></div>
                        <p class="text-secondary">OTHER INFORMATION</p>
                        <h6 class="text-secondary"><i class="fas fa-building mr-2"></i><em>Occupancy:</em> <b>{{ ($fsmr) ? $fsmr->occupancy : '' }}</b></h6>
                        <h6 class="text-secondary"><i class="fas fa-list-ol mr-2"></i><em>Number of Floors:</em> <b>{{ ($fsmr) ? $fsmr->no_of_floors : '' }}</b></h6>
                        <h6 class="text-secondary"><i class="fas fa-asterisk mr-2"></i><em>Reference No:</em> <b>{{ ($fsmr) ? $fsmr->reference_no : '' }}</b></h6>
                        <h6 class="text-secondary"><i class="fas fa-building mr-2"></i><em>Building Use:</em> <b>{{ ($fsmr) ? $fsmr->building_use : '' }}</b></h6>
                        <h6 class="text-secondary"><i class="fas fa-server mr-2"></i><em>Service Availed:</em> <b>{{ ($fsmr) ? $fsmr->service_availed : '' }}</b></h6>
                    </div>
                </div>
                <div class="row mt-5 mb-2">
                    <div class="col-sm-12 text-center">
                        <h3><em>Kindly fill-up the necessary information below found on each tab</em></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="">
                            <div class="card-header-tab card-header">
                                <div class="card-header-title">
                                    <i class="header-icon lnr-bicycle icon-gradient bg-love-kiss"> </i>
                                </div>
                                <ul class="nav">
                                    <li class="nav-item"><a data-toggle="tab" href="#fps" class="nav-link active show"><i class="fas fa-vial mr-2"></i>Fire Prevention Systems</a></li>
                                    <li class="nav-item"><a data-toggle="tab" href="#eer" class="nav-link show"><i class="fas fa-door-open mr-2"></i>Emergency Exits & Routes</a></li>
                                    <li class="nav-item"><a data-toggle="tab" href="#fss" class="nav-link show"><i class="fas fa-fire-extinguisher mr-2"></i>Fire Suppression System</a></li>
                                    <li class="nav-item"><a data-toggle="tab" href="#assessment" class="nav-link show"><i class="fas fa-stamp mr-2"></i>Assessment</a></li>
                                    <li class="nav-item"><a data-toggle="tab" href="#attachments" class="nav-link show"><i class="fas fa-image mr-2"></i>Attachments</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active show" id="fps" role="tabpanel">
                                        <!-- Fire Prevention Systems -->
                                        <div class="position-relative row form-group mt-2">
                                            <div class="col-sm-12 text-center">
                                                <h2>Fire Prevention Systems</h2>
                                            </div>
                                        </div>
                                        <div class="divider"></div>
                                        <form id="frmFPS">
                                        <input type="hidden" name="fsmr-id" value="{{ request('id') ? request('id') : '' }}">
                                        <div class="position-relative row form-group mt-4">
                                            <label for="manufacturer" class="col-sm-3 col-form-label">Control Unit Manufacturer:</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control form-control-sm input-border-bottom" id="manufacturer" name="manufacturer" value="{{ ($fsmr) ? $fsmr->fps_manufacturer : '' }}">
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group mt-3">
                                            <label for="model" class="col-sm-3 col-form-label">Model:</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control form-control-sm input-border-bottom" id="model" name="model" value="{{ ($fsmr) ? $fsmr->fps_model : '' }}">
                                            </div>
                                        </div>
                                        <div class="position-relative row form-group mt-3">
                                            <label for="model" class="col-sm-3 col-form-label">Circuit Style:</label>
                                            <div class="col-sm-4">
                                                <select class="form-control form-control-sm col-md-12" name="circuit-style">
                                                    <option value="" {{ ($fsmr) ? (($fsmr->fps_circuit == '' || $fsmr->fps_circuit == NULL) ? 'selected="selected"' : '') : '' }}>N/A</option>
                                                    @foreach(\App\Enums\CircuitStyle::$circuits as $key => $circuit)
                                                    <option value="{{ $key }}" {{ ($fsmr) ? ($fsmr->fps_circuit == 1 ? 'selected="selected"' : '') : (($circuit == 'Conventional' ? 'selected="selected"' : '')) }}>{{ $circuit }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        </form>
                                        <div class="row">
                                            <div class="col-sm-12" id="fps-table">
                                                @foreach($firesystems as $firesystem)
                                                <br>
                                                <h6>{{ $firesystem->category }}</h6>
                                                <table class="display table table-striped table-hover dataTable" id="table-list">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">No</th>
                                                            <th class="text-center" style="width: 23%">Device / Appliance</th>
                                                            <th class="text-center" style="width: 23%">Quantity of Device / Appliance</th>
                                                            <th class="text-center" style="width: 23%">Circuit Style</th>
                                                            <th class="text-center" style="width: 23%">Quantity Tested</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php ($ctr = 1)
                                                        @foreach($firesystem->devices as $device)
                                                        <tr data-category="{{ $firesystem->id }}" data-device="{{ $device->id }}">
                                                            <td class="text-center">{{ $ctr++ }}</td>
                                                            <td>{{ $device->name }}</td>
                                                            <td>
                                                                <input type="text" class="form-control form-control-sm input-border-bottom" value="{{ $fsmr->fps()->where('item_id', $device->id)->first()->item_count ?? '' }}">
                                                            </td>
                                                            <td>
                                                                @php ($c = $fsmr->fps()->where('item_id', $device->id)->first()->circuit ?? '')
                                                                <select class="form-control form-control-sm" id="requested-by">
                                                                    <option value="N/A">N/A</option>
                                                                    @foreach(\App\Enums\CircuitStyle::$circuits as $key => $circuit)
                                                                    <option value="{{ $key }}" {{ ($c == $key) ? 'selected="selected"' : '' }}>{{ $circuit }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control form-control-sm input-border-bottom" value="{{ $fsmr->fps()->where('item_id', $device->id)->first()->item_tested_count ?? '' }}">
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <br>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary btn-save-fps"><i class="fas fa-save mr-2"></i>Save</button>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="tab-pane show" id="eer" role="tabpanel">
                                        <!-- Emergency Exits & Routes -->
                                        <div class="position-relative row form-group mt-2">
                                            <div class="col-sm-12 text-center">
                                                <h2>Emergency Exits & Routes</h2>
                                            </div>
                                        </div>
                                        <div class="divider"></div>
                                        <form id="frmEER">
                                            <input type="hidden" name="fsmr-id" value="{{ request('id') ? request('id') : '' }}">
                                            <div class="position-relative row form-group mt-4">
                                                <label for="eer-manufacturer" class="col-sm-3 col-form-label">Manufacturer:</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control form-control-sm input-border-bottom" id="eer-manufacturer" name="eer-manufacturer" value="{{ ($fsmr) ? $fsmr->eer_manufacturer : '' }}">
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group mt-3">
                                                <label for="eer-hardware" class="col-sm-3 col-form-label">Hardware:</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control form-control-sm input-border-bottom" id="eer-hardware" name="eer-hardware" value="{{ ($fsmr) ? $fsmr->eer_hardware : '' }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12" id="eer-div">
                                                    <br>
                                                    <table class="display table table-striped table-hover eer-tbl" id="table-list">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center" style="width: 8%">No</th>
                                                                <th class="text-center" style="width: 34%">Description</th>
                                                                <th class="text-center" style="width: 8%">Yes</th>
                                                                <th class="text-center" style="width: 8%">No</th>
                                                                <th class="text-center" style="width: 8%">N/A</th>
                                                                <th class="text-center" style="width: 34%">Remarks</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if (!blank($eerChecklist))
                                                            @php ($ctr = 1)
                                                            @foreach ($eerChecklist as $item)
                                                            @php ($stat = $fsmr->eer()->where('checklist_id', $item->id)->first()->status ?? null)
                                                            <tr data-cl="{{ $item->id }}">
                                                                <td class="text-center">{{ $ctr++ }}</td>
                                                                <td>{{ $item->description }}</td>
                                                                <td class="text-center">
                                                                    <input type="radio" name="{{ 'option-'.$item->id }}" value="1" {{ ($stat) ? (($stat == 1) ? 'checked="checked"' : '') : '' }}>
                                                                </td>
                                                                <td class="text-center">
                                                                    <input type="radio" name="{{ 'option-'.$item->id }}" value="2" {{ ($stat) ? (($stat == 2) ? 'checked="checked"' : '') : '' }}>
                                                                </td>
                                                                <td class="text-center">
                                                                    <input type="radio" name="{{ 'option-'.$item->id }}" value="3" {{ ($stat) ? (($stat == 3) ? 'checked="checked"' : '') : '' }}>
                                                                </td>
                                                                <td class="text-center">
                                                                    <input type="text" class="form-control form-control-sm input-border-bottom" id="{{ 'remarks-'.$item->id }}" name="{{ 'remarks-'.$item->id }}" value="{{ $fsmr->eer()->where('checklist_id', $item->id)->first()->remarks ?? '' }}">
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="eer-remarks" class="col-sm-3 col-form-label">Remarks and Proposal:</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control form-control-sm input-border-bottom col-sm-12" cols="12" rows="5" id="eer-remarks" name="eer-remarks">{{ ($fsmr) ? $fsmr->eer_remarks : '' }}</textarea>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-sm-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary btn-save-eer"><i class="fas fa-save mr-2"></i>Save</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane show" id="fss" role="tabpanel">
                                        <!-- Fire Extinguishers and Equipment -->
                                        <div class="position-relative row form-group mt-2">
                                            <div class="col-sm-12 text-center">
                                                <h2>Fire Suppression System</h2>
                                            </div>
                                        </div>
                                        <div class="divider"></div>
                                        <form id="frmFSS">
                                            <input type="hidden" name="fsmr-id" value="{{ request('id') ? request('id') : '' }}">
                                            <div class="position-relative row form-group mt-4">
                                                <label for="fss-inspection-date" class="col-sm-3 col-form-label">Inspection Date:</label>
                                                <div class="col-sm-4">
                                                    <input type="date" class="form-control form-control-sm input-border-bottom" id="fss-inspection-date" name="fss-inspection-date" value="{{ ($fsmr) ? $fsmr->fss_inspection_date : '' }}">
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group mt-3">
                                                <label for="fss-unit" class="col-sm-3 col-form-label">Unit:</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control form-control-sm input-border-bottom" id="fss-unit" name="fss-unit" value="{{ ($fsmr) ? $fsmr->fss_unit : '' }}">
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group mt-3">
                                                <label for="fss-frequency" class="col-sm-3 col-form-label">Inspection Frequency:</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control form-control-sm input-border-bottom" id="fss-frequency" name="fss-frequency" value="{{ ($fsmr) ? $fsmr->fss_frequency : '' }}">
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group mt-3">
                                                <label for="fss-report" class="col-sm-3 col-form-label">Report:</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control form-control-sm input-border-bottom" id="fss-report" name="fss-report" value="{{ ($fsmr) ? $fsmr->fss_report : '' }}">
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-sm-12" id="fss-div">
                                                    <table class="display table table-striped table-hover fire-door-tbl" id="table-fss-list">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center" style="width: 8%">No</th>
                                                                <th class="text-center" style="width: 34%">Description</th>
                                                                <th class="text-center" style="width: 8%">Yes</th>
                                                                <th class="text-center" style="width: 8%">No</th>
                                                                <th class="text-center" style="width: 8%">N/A</th>
                                                                <th class="text-center" style="width: 34%">Remarks</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if (!blank($fssChecklist))
                                                            @php ($ctr = 1)
                                                            @foreach ($fssChecklist as $item)
                                                            @php ($stat = $fsmr->fss()->where('checklist_id', $item->id)->first()->status ?? null)
                                                            <tr data-cl="{{ $item->id }}">
                                                                <td class="text-center">{{ $ctr++ }}</td>
                                                                <td>{{ $item->description }}</td>
                                                                <td class="text-center">
                                                                    <input type="radio" name="{{ 'option-'.$item->id }}" value="1" {{ ($stat) ? (($stat == 1) ? 'checked="checked"' : '') : '' }}>
                                                                </td>
                                                                <td class="text-center">
                                                                    <input type="radio" name="{{ 'option-'.$item->id }}" value="2" {{ ($stat) ? (($stat == 2) ? 'checked="checked"' : '') : '' }}>
                                                                </td>
                                                                <td class="text-center">
                                                                    <input type="radio" name="{{ 'option-'.$item->id }}" value="3" {{ ($stat) ? (($stat == 3) ? 'checked="checked"' : '') : '' }}>
                                                                </td>
                                                                <td class="text-center">
                                                                    <input type="text" class="form-control form-control-sm input-border-bottom" id="{{ 'remarks-'.$item->id }}" name="{{ 'remarks-'.$item->id }}" value="{{ $fsmr->fss()->where('checklist_id', $item->id)->first()->remarks ?? '' }}">
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        @endif
                                                        
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="fss-remarks" class="col-sm-3 col-form-label">Remarks and Proposal:</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control form-control-sm input-border-bottom col-sm-12" cols="12" rows="5" id="fss-remarks" name="fss-remarks">{{ ($fsmr) ? $fsmr->fss_remarks : '' }}</textarea>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-sm-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary btn-save-fss"><i class="fas fa-save mr-2"></i>Save</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane show" id="assessment" role="tabpanel">
                                        <form id="frmAssessment">
                                            <input type="hidden" name="fsmr-id" value="{{ request('id') ? request('id') : '' }}">
                                            <div class="position-relative row form-group mt-2">
                                                <div class="col-sm-12 text-center">
                                                    <h2>Assessment</h2>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-sm-12">
                                                    <table class="display table table-striped table-hover fire-door-tbl" id="table-assessment-list">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center" style="width: 8%">No</th>
                                                                <th class="text-center" style="width: 20%">Category</th>
                                                                <th class="text-center" style="width: 48%">Question</th>
                                                                @foreach (\App\Enums\AssessmentResponseType::$responseType as $resType)
                                                                    <th class="text-center" style="width: 8%">{{ $resType }}</th>
                                                                @endforeach
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if (!blank($assessments))
                                                            @php ($ctr = 1)
                                                            @foreach ($assessments as $assessment)
                                                                <tr data-assessment-id="{{ $assessment->id }}">
                                                                    <td class="text-center">{{ $ctr++ }}</td>
                                                                    <td>{{ $assessment->category->category }}</td>
                                                                    <td>{{ $assessment->question }}</td>
                                                                    @php ($responseKeys = $assessment->response_types()->pluck('response_type')->toArray())
                                                                    @php ($fsmr_res_type = $fsmr->assessments()->where('assessment_id', $assessment->id)->first()->response_type ?? '')
                                                                    @foreach (\App\Enums\AssessmentResponseType::$responseType as $key => $resType)
                                                                        <td class="text-center"> 
                                                                        @if (in_array($key, $responseKeys))        
                                                                            <input type="radio" name="option-{{ $assessment->id }}" value="{{ $key }}" {{ ($fsmr_res_type == $key) ? 'checked="checked"' : '' }}>
                                                                        @endif
                                                                        </td>
                                                                    @endforeach
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                        
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="position-relative row form-group">
                                                <label for="no-fe-bfp" class="col-sm-3 col-form-label">Required Number of Fire Extinguishers by the BFP:</label>
                                                <div class="col-sm-4">
                                                <input type="number" class="form-control form-control-sm input-border-bottom" id="no-fe-bfp" name="no-fe-bfp" value="{{ ($fsmr) ? $fsmr->assessment_fe_required : '' }}">
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label for="no-fe-available" class="col-sm-3 col-form-label">Number of Fire Extinguishers in the Vicinity:</label>
                                                <div class="col-sm-4">
                                                <input type="number" class="form-control form-control-sm input-border-bottom" id="no-fe-available" name="no-fe-available" value="{{ ($fsmr) ? $fsmr->assessment_fe_available : '' }}">
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label for="no-fe-refill" class="col-sm-3 col-form-label">Number of Fire Extinguishers need to be Re-filled:</label>
                                                <div class="col-sm-4">
                                                <input type="number" class="form-control form-control-sm input-border-bottom" id="no-fe-refill" name="no-fe-refill" value="{{ ($fsmr) ? $fsmr->assessment_fe_refilled : '' }}">
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group mt-2">
                                                <div class="col-sm-12 text-center">
                                                    <h2>Fire Extinguishers and Equipment</h2>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-sm-12">
                                                    <table class="display table table-striped table-hover fire-door-tbl" id="table-fire-equipment-list">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center" style="width: 8%">No</th>
                                                                <th class="text-center" style="width: 50%">Item</th>
                                                                <th class="text-center" style="width: 15%">Quantity</th>
                                                                <th class="text-center" style="width: 15%">Available Units in the Establishment</th>
                                                                <th class="text-center" style="width: 15%">No. of Fire Extinguishers Required byBFP</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if (!blank($fire_equipments))
                                                            @php ($ctr = 1)
                                                            @php ($existingItems = $fsmr->fee->map(fn($fe) => $fe->item . '|' . $fe->quantity)->toArray())

                                                            @foreach ($fsmr->fee as $fe)
                                                                <tr>
                                                                    <td class="text-center">{{ $ctr++ }}</td>
                                                                    <td>
                                                                        <input type="text" class="form-control form-control-sm input-border-bottom" value="{{ $fe->item }}">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control form-control-sm input-border-bottom" value="{{ $fe->quantity }}">
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" class="form-control form-control-sm input-border-bottom" value="{{ $fe->available }}">
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" class="form-control form-control-sm input-border-bottom" value="{{ $fe->required }}">
                                                                    </td>
                                                                </tr>
                                                            @endforeach

                                                            @foreach ($fire_equipments as $fire_equipment)
                                                                @php ($isDuplicate = in_array($fire_equipment->item . '|' . $fire_equipment->quantity, $existingItems))

                                                                @if (!$isDuplicate)
                                                                    <tr data-fe-id="{{ $fire_equipment->id }}">
                                                                        <td class="text-center">{{ $ctr++ }}</td>
                                                                        <td>
                                                                            <input type="text" class="form-control form-control-sm input-border-bottom" value="{{ $fire_equipment->item }}">
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" class="form-control form-control-sm input-border-bottom" value="{{ $fire_equipment->quantity }}">
                                                                        </td>
                                                                        <td>
                                                                            <input type="number" class="form-control form-control-sm input-border-bottom">
                                                                        </td>
                                                                        <td>
                                                                            <input type="number" class="form-control form-control-sm input-border-bottom">
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        @endif

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="position-relative row form-group">
                                                <label for="conductor" class="col-sm-3 col-form-label">Conducted By:</label>
                                                <div class="col-sm-4">
                                                    <select class="form-control form-control-sm col-md-12" id="conductor" name="conductor">
                                                        <option value=""></option>
                                                        @foreach ($signatories as $signatory)
                                                        <option value="{{ $signatory->id }}" {{ (($fsmr->technician == $signatory->id) ? 'selected="selected"' : '')}}>{{ $signatory->name." (".$signatory->position.")" }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label for="inspector" class="col-sm-3 col-form-label">Inspected By:</label>
                                                <div class="col-sm-4">
                                                    <select class="form-control form-control-sm col-md-12" id="inspector" name="inspector">
                                                        <option value=""></option>
                                                        @foreach ($signatories as $signatory)
                                                        <option value="{{ $signatory->id }}" {{ (($fsmr->inspector == $signatory->id) ? 'selected="selected"' : '')}}>{{ $signatory->name." (".$signatory->position.")" }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group">
                                                <label for="proprietor" class="col-sm-3 col-form-label">Noted By:</label>
                                                <div class="col-sm-4">
                                                    <select class="form-control form-control-sm col-md-12" id="proprietor" name="proprietor">
                                                        <option value=""></option>
                                                        @foreach ($signatories as $signatory)
                                                        <option value="{{ $signatory->id }}" {{ (($fsmr->contractor == $signatory->id) ? 'selected="selected"' : '')}}>{{ $signatory->name." (".$signatory->position.")" }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                           
                                            <div class="row mt-4">
                                                <div class="col-sm-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary btn-save-assessment"><i class="fas fa-save mr-2"></i>Save</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane show" id="attachments" role="tabpanel">

                                        <table class="table table-sm table-striped table-hover">
                                            @if (!blank($fsmr))
                                                @if (!blank($fsmr->attachments))
                                                    @php ($count = 1)
                                                    @foreach ($fsmr->attachments as $attachment)
                                                    <tr>
                                                        <td class="text-center" style="width: 10%">{{ $count++ }}</td>
                                                        <td class="text-center" style="width: 20%">{{ $attachment->attachmenttype->description }}</td>
                                                        <td class="text-center" style="width: 20%">
                                                            <img src="{{ asset('files/attachments/'.$attachment->url) }}" style="height: 80%; max-width: 100px">
                                                        </td>
                                                        <td class="text-center" style="width: 50%"></td>
                                                    </tr>
                                                    @endforeach
                                                @endif
                                            @endif
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="d-block text-right card-footer">
                                <!-- <a href="javascript:void(0);" class="btn-wide btn-shadow btn btn-danger">Delete</a> -->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



@endsection

@push('scripts')
<script>
    var est_name = "{{ $fsmr->establishment_name ?? '' }}";

    $('.btn-save-fps').on('click', function(){
        var fps = [];
        
        $('#fps-table table tbody tr').each(function() {
            var category = $(this).data('category');
            var device = $(this).data('device');
            var device_count = $(this).find('td:eq(2) input[type="text"]').val();
            var circuit = $(this).find('td:eq(3) select').val();
            var device_tested_count = $(this).find('td:eq(4) input[type="text"]').val();

            fps.push([category, device, device_count, circuit, device_tested_count]);
        });

        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/transaction/fsmr/save-fps?fps='+encodeURIComponent(JSON.stringify(fps)),
            method: 'POST',
            data: $('#frmFPS').serialize(),
            beforeSend: function() {
                $('#loading-overlay').fadeIn();
            },
            complete: function(){
                $('#loading-overlay').fadeOut();
            },
            success: function(result) {
                Swal.fire({
                    title: result['title'],
                    text: result['message'],
                    icon: result['icon'],
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });
            },
            error: function(obj, err, ex){
                Swal.fire({
                    title: 'Server Error',
                    text: err + ": " + obj.toString() + " " + ex,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        })

    });

    $('.btn-save-eer').on('click', function(e){
        e.preventDefault();
        var eer = [];

        $('#eer-div table tbody tr').each(function() {
            var checklist_item = $(this).data('cl');
            var remarks = $(this).find('td:eq(5) input[type="text"]').val();
            var stat = $(this).find('td input[type="radio"]:checked').val();
            
            eer.push([checklist_item, stat, remarks]);
        });

        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/transaction/fsmr/save-eer?eer='+encodeURIComponent(JSON.stringify(eer)),
            method: 'POST',
            data: $('#frmEER').serialize(),
            beforeSend: function() {
                $('#loading-overlay').fadeIn();
            },
            complete: function(){
                $('#loading-overlay').fadeOut();
            },
            success: function(result) {
                Swal.fire({
                    title: result['title'],
                    text: result['message'],
                    icon: result['icon'],
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });
            },
            error: function(obj, err, ex){
                Swal.fire({
                    title: 'Server Error',
                    text: err + ": " + obj.toString() + " " + ex,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        })

    });

    $('.btn-save-fss').on('click', function(e){
        e.preventDefault();
        var fss = [];

        $('#fss-div table tbody tr').each(function() {
            var checklist_item = $(this).data('cl');
            var remarks = $(this).find('td:eq(5) input[type="text"]').val();
            var stat = $(this).find('td input[type="radio"]:checked').val();
            
            fss.push([checklist_item, stat, remarks]);
        });

        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/transaction/fsmr/save-fss?fss='+encodeURIComponent(JSON.stringify(fss)),
            method: 'POST',
            data: $('#frmFSS').serialize(),
            beforeSend: function() {
                $('#loading-overlay').fadeIn();
            },
            complete: function(){
                $('#loading-overlay').fadeOut();
            },
            success: function(result) {
                Swal.fire({
                    title: result['title'],
                    text: result['message'],
                    icon: result['icon'],
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });
            },
            error: function(obj, err, ex){
                Swal.fire({
                    title: 'Server Error',
                    text: err + ": " + obj.toString() + " " + ex,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        })

    });

    $('.btn-save-assessment').on('click', function(e){
        e.preventDefault();
        var assessments = [],
            equipments = [];

        $('#table-assessment-list tbody tr').each(function() {
            var assessment_id = $(this).data('assessment-id');
            var answer = $(this).find('td input[type="radio"]:checked').val();
            
            if (answer !== undefined) {
                assessments.push([assessment_id, answer]);
            }
        });

        $('#table-fire-equipment-list tbody tr').each(function() {
            var fe_id = $(this).data('fe-id');
            var item = $(this).find('td:eq(1) input[type="text"]').val();
            var quantity = $(this).find('td:eq(2) input[type="text"]').val();
            var num_available = $(this).find('td:eq(3) input[type="number"]').val();
            var num_required = $(this).find('td:eq(4) input[type="number"]').val();
            
            if (item && quantity && num_available && num_required) {
                equipments.push([fe_id, item, quantity, num_available, num_required]);
            }
        });

        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/transaction/fsmr/save-assessment',
            method: 'POST',
            data: {
                assess: JSON.stringify(assessments), // Pass assessments as part of the data object
                fee: JSON.stringify(equipments),    // Pass equipments as part of the data object
                formData: $('#frmAssessment').serialize()
            },
            beforeSend: function() {
                $('#loading-overlay').fadeIn();
            },
            complete: function(){
                $('#loading-overlay').fadeOut();
            },
            success: function(result) {
                Swal.fire({
                    title: result['title'],
                    text: result['message'],
                    icon: result['icon'],
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });
            },
            error: function(obj, err, ex){
                Swal.fire({
                    title: 'Server Error',
                    text: err + ": " + obj.toString() + " " + ex,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        })
    });

    $('.btn-add-row').on('click', function(e){
        e.preventDefault();

        let newRow = `<tr>
                        <td><input type="text" class="form-control form-control-sm input-border-bottom" /></td>
                        <td><input type="text" class="form-control form-control-sm input-border-bottom" /></td>
                        <td><input type="text" class="form-control form-control-sm input-border-bottom" /></td>
                        <td><input type="text" class="form-control form-control-sm input-border-bottom" /></td>
                        <td><input type="date" class="form-control form-control-sm input-border-bottom" /></td>
                        <td><input type="text" class="form-control form-control-sm input-border-bottom" /></td>
                        <td><input type="text" class="form-control form-control-sm input-border-bottom" /></td>
                        <td class="text-center"><button type="button" class="btn btn-sm btn-danger" onclick="removeRow(event, this)"><i class="fas fa-trash"></i></button></td>
                    </tr>`;

        $('#table-fss-list tbody').append(newRow);
    });

    $('.btn-print-fsmr').on('click', function(e){
        e.preventDefault();
        var url = "{{ request('id') }}";

        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('transaction-fsmr-print') }}",
            method: 'POST',
            data: {
                'fsmrid': url
            },
            dataType: 'HTML',
            beforeSend: function() {
                $('#loading-overlay').fadeIn();
            },
            complete: function(){
                $('#loading-overlay').fadeOut();
            },
            success: function(result) {
                var mywindow = window.open('', '_blank', 'height=800,width=1020,scrollbars=yes');
                mywindow.document.write('<title>'+est_name+'</title>');
                mywindow.document.write(result)
                mywindow.document.close();

                mywindow.onload = function () {
                    mywindow.focus();
                    mywindow.print();
                };
            },
            error: function(obj, err, ex){
                Swal.fire({
                    title: 'Server Error',
                    text: err + ": " + obj.toString() + " " + ex,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        })
    });

    function removeRow(ev, el){
        ev.preventDefault();
        const row = $(el).closest('tr');
        row.remove();
    }

    document.addEventListener("DOMContentLoaded", function () {
        // Retrieve the last active tab from localStorage
        const activeTab = localStorage.getItem("activeTab");
        if (activeTab) {
            // Open the previously active tab
            const tabElement = document.querySelector(`[href="${activeTab}"]`);
            if (tabElement) {
                tabElement.click();
            }
        }

        // Add a click event listener to all tabs
        const tabs = document.querySelectorAll('.nav-item .nav-link');
        tabs.forEach(tab => {
            tab.addEventListener('click', function () {
                // Save the active tab to localStorage
                localStorage.setItem("activeTab", this.getAttribute('href'));
            });
        });
    });
</script>
@endpush