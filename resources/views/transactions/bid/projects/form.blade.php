@extends('index')

@section('content')

<div class="app-page-title">
    <div>
        <h4>{{ isset($data) ? 'Edit Project' : 'Create Project' }}</h4>
    </div>
</div>

<div class="card p-3">
<form method="POST" enctype="multipart/form-data"
      action="{{ isset($data) ? route('projects.update', $data->id) : route('projects.store') }}">

    @csrf

    <div class="row">

        <!-- BASIC INFO -->

        <div class="col-md-12 mb-3">
            <h4>Basic Project Information</h4>
        </div>

        <div class="col-md-6">
            <label>Project Reference No</label>
            <input type="text" name="project_reference_no"
                   value="{{ $data->project_reference_no ?? '' }}"
                   class="form-control" required>
        </div>

        <div class="col-md-6">
            <label>Project Identification No</label>
            <input type="text" name="project_identification_no"
                   value="{{ $data->project_identification_no ?? '' }}"
                   class="form-control" required>
        </div>

        <div class="col-md-6 mt-2">
            <label>Project Name</label>
            <input type="text" name="project_name"
                   value="{{ $data->project_name ?? '' }}"
                   class="form-control" required>
        </div>

        <div class="col-md-6 mt-2">
            <label>Project Cost</label>
            <input type="text"
                    id="project_cost"
                    name="project_cost"
                    value="{{ isset($data->project_cost) ? number_format($data->project_cost, 2, '.', ',') : '' }}"
                    class="form-control"
                    required>
        </div>

        <div class="col-md-6 mt-2">
            <label>Project Type</label>
            <select name="project_type" class="form-control" required>
                <option value="Government" {{ (isset($data) && $data->project_type == 'Government') ? 'selected' : '' }}>
                    Government
                </option>
                <option value="Private" {{ (isset($data) && $data->project_type == 'Private') ? 'selected' : '' }}>
                    Private
                </option>
            </select>
        </div>

        <div class="col-md-12 mt-3"><hr></div>

        <!-- AGENCY INFO -->
        <div class="col-md-12 mb-3">
            <h4>Agency Information (Project Proponent)</h4>
        </div>

        <div class="col-md-6">
            <label>Agency Name</label>
            <input type="text" name="agency_name"
                   value="{{ $data->agency_name ?? '' }}"
                   class="form-control">
        </div>

        <div class="col-md-6">
            <label>Contact No</label>
            <input type="text" name="contact_no"
                   value="{{ $data->contact_no ?? '' }}"
                   class="form-control">
        </div>

        <div class="col-md-6 mt-2">
            <label>Address</label>
            <input type="text" name="address"
                   value="{{ $data->address ?? '' }}"
                   class="form-control">
        </div>

        <div class="col-md-6 mt-2">
            <label>Agency Logo</label>
            <input type="file" name="agency_logo_url" class="form-control">

            @if(isset($data) && $data->agency_logo_url)
                <div class="mt-2">
                    <img src="{{ asset($data->agency_logo_url) }}" width="120">
                </div>
            @endif
        </div>

        <div class="col-md-12 mt-3"><hr></div>
        <div class="col-md-12 mb-3">
            <h4>Technical Specifications</h4>
        </div>

        <div class="col-md-6 mb-3">
            <label>Project Template</label>
            <select id="project_template" class="form-control">
                <option value=""></option>
                @foreach($templates as $template)
                    <option value="{{ $template->id }}">
                        {{ $template->template_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-12 mb-2">
            <label>System Components</label>
            <textarea id="system_components" name="system_components">{{ $data->system_components ?? '' }}</textarea>
        </div>

        <div class="col-md-12 mb-2">
            <label>After Sales Service & Parts</label>
            <textarea id="service_parts" name="service_parts">{{ $data->service_parts ?? '' }}</textarea>
        </div>

        <div class="col-md-12 mb-2">
            <label>Compliance and Certifications</label>
            <textarea id="certifications" name="certifications">{{ $data->certifications ?? '' }}</textarea>
        </div>

        <div class="col-md-12 mt-3"><hr></div>
        <div class="col-md-12 mb-3">
            <h4>Other Details</h4>
        </div>
        <!-- COMPLIANCE DATES -->
        <div class="col-md-6 mt-2">
            <label>All Ongoing Projects Document Sign Date</label>
            <input type="date" class="form-control" name="aogpc_date_signed" value="{{ $data->aogpc_date_signed ?? date('Y-m-d') }}">
        </div>

        <div class="col-md-6 mt-2">
            <label>Single Largest Completed Contract Document Sign Daste</label>
            <input type="date" class="form-control" name="slcc_date_signed" value="{{ $data->slcc_date_signed ?? date('Y-m-d') }}">
        </div>

        <div class="col-md-6 mb-2">
            <label>Bid Securing Declaration Date</label>
            <input type="date" name="bid_securing_declaration_date"
                   value="{{ $data->bid_securing_declaration_date ?? '' }}"
                   class="form-control">
        </div>

        <div class="col-md-6 mb-2">
            <label>Omnibus Sworn Statement Date</label>
            <input type="date" name="omnibus_sworn_statement_date"
                   value="{{ $data->omnibus_sworn_statement_date ?? '' }}"
                   class="form-control">
        </div>

        <!-- FINAL CONTRACT FIELDS -->
        <!-- <div class="col-md-6">
            <label>Proponent <b><em>For Financial Component</em></b></label>
            <input type="text" name="fc_proponent"
                   value="{{ $data->fc_proponent ?? '' }}"
                   class="form-control" required>
        </div> -->

        <div class="col-md-6 mt-2">
            <label>Warranty Calendar Days <b><em>For Financial Component</em></b></label>
            <input type="number" name="fc_warranty_calendar_days"
                   value="{{ $data->fc_warranty_calendar_days ?? '' }}"
                   class="form-control">
        </div>

        <div class="col-md-6 mt-2">
            <label>Warranty (in Months) <b><em>For Financial Component</em></b></label>
            <input type="number" name="fc_warranty"
                   value="{{ $data->fc_warranty ?? '' }}"
                   class="form-control">
        </div>

        <div class="col-md-6 mt-2">
            <label>Project Cash Flow Date of Signing <b><em>For Financial Component</em></b></label>
            <input type="date" name="fc_cash_flow_date"
                   value="{{ $data->fc_cash_flow_date ?? '' }}"
                   class="form-control">
        </div>

        <div class="col-md-12 mt-2">
            <label>Product to be Supplied <b><em>For Financial Component</em></b></label>
            <textarea name="fc_product_to_be_supplied"
                      class="form-control">{{ $data->fc_product_to_be_supplied ?? '' }}</textarea>
        </div>
    </div>

    <div class="mt-3">
        <button class="btn btn-primary">
            Save Project
        </button>
    </div>

</form>
</div>

@endsection
@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    $('#project_template').change(function(){
    let id = $(this).val();
    if(id == '') return;
    $.get('/transaction/bids/project-template/load/' + id, function(data){

        systemEditor.setData(
            data.system_components ?? ''
        );

        serviceEditor.setData(
            data.service_parts ?? ''
        );

        certEditor.setData(
            data.certifications ?? ''
        );

    });

    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('project_cost');

        input.addEventListener('input', function () {
            let value = this.value.replace(/,/g, '');

            // Allow only numbers and one decimal point
            value = value.replace(/[^\d.]/g, '');
            value = value.replace(/(\..*)\./g, '$1');

            if (value !== '') {
                const parts = value.split('.');
                parts[0] = Number(parts[0]).toLocaleString('en-US');

                this.value = parts.length > 1
                    ? parts[0] + '.' + parts[1]
                    : parts[0];
            }
    });

    // Remove commas before form submission
    input.form.addEventListener('submit', function () {
        input.value = input.value.replace(/,/g, '');
    });
});
</script>
<script>
    const solarSystemComponents = `
    <p><strong>Solar Panels:</strong></p>
    <ul>
        <li>Max Wattage: 600W</li>
        <li>Luminous Flux: 6200/8200LM</li>
        <li>Charging Hours: 4-5 hours charge peak sunlight</li>
        <li>Working Hours: 12 hours (sustain 2-3 days)</li>
        <li>Battery Type: Lithium Phosphate</li>
        <li>Battery Voltage: 3.2V</li>
        <li>Battery Ampere Hour: 60AH</li>
        <li>Ingress Protection: IP65</li>
    </ul>

    <p><strong>Steel Post:</strong></p>
    <ul>
        <li>Steel Post: 3” diameter</li>
        <li>Height: 20ft</li>
    </ul>
    `;

    const solarServiceParts = `
    <ul>
        <li><strong>WARRANTY: {warranty} Months</strong></li>
        <li><strong>SPARE PARTS:</strong> Guaranteed availability of LED, controllers and batteries within 7-14 days</li>
        <li><strong>SUPPORT:</strong> 24/7 technical helpline and onsite assistance within 48 hours</li>
    </ul>
    `;

    const solarCertifications = `
    <ul>
        <li>Certificate of Completion</li>
        <li>Testing and Commissioning</li>
    </ul>
    `;

    const fireSystemComponents = `
    <ul>
        <li><strong>Extinguishing Agent:</strong> HFC-236fa (Hexafluoropropane) Clean Agent</li>
        <li><strong>Agent Characteristics</strong></li>
        <ul>
            <li>Colorless</li>
            <li>Odorless</li>
            <li>Electrically Non-Conductive</li>
            <li>Non-Corrosive</li>
            <li>Residue-Free</li>
            <li>Zero Ozone Depletion Potential (ODP)</li>
        </ul>
    </ul>

    <p><strong>1. Fire Classification</strong></p>
    <p>Suitable for:</p>
    <ul>
        <li>Class A – Ordinary Combustible Materials</li>
        <li>Class B – Flammable Liquids</li>
        <li>Class C – Energized Electrical Equipment</li>
    </ul>

    <p><strong>2. Construction</strong></p>
    <ul>
        <li>Cylinder Material: Seamless Steel Cylinder</li>
        <li>Valve Material: Brass with Safety Relief Device</li>
        <li>Finish: Green Polyester Powder Coating</li>
        <li>Pressure Gauge: Included</li>
        <li>Discharge Hose: Flexible Hose with Nozzle</li>
        <li>Mounting Bracket: Included</li>
        <li>Operating Temperature: -20°C to +60°C</li>
    </ul>

    <p><strong>3. Performance Requirements</strong></p>
    <ul>
        <li>Extinguishing Agent Capacity: 5 lbs (2.27 kg) minimum</li>
        <li>Discharge Time: Minimum 8 seconds</li>
        <li>Effective Discharge Range: Minimum 2 meters</li>
        <li>Stored Pressure Type</li>
        <li>Rechargeable and Serviceable</li>
    </ul>

    <p><strong>4. Compliance Requirements</strong></p>
    <ul>
        <li>NFPA 10 – Standard for Portable Fire Extinguishers</li>
        <li>ISO / EN3 Standards or Equivalent</li>
        <li>Bureau of Fire Protection (BFP) Requirements</li>
        <li>Manufacturer's Certification and Test Reports</li>
    </ul>

    <p><strong>5. Applications</strong></p>
    <ul>
        <li>Server Rooms</li>
        <li>Data Centers</li>
        <li>Computer Rooms</li>
        <li>Control Rooms</li>
        <li>Telecommunication Facilities</li>
        <li>Laboratories</li>
        <li>Medical Diagnostic Rooms</li>
        <li>Archives and Records Storage</li>
        <li>Electrical Panels and Switchgear Rooms</li>
    </ul>

    <p><strong>6. Accessories</strong></p>
    <ul>
        <li>Wall Mounting Bracket</li>
        <li>Inspection Tag</li>
        <li>User Instruction Label</li>
        <li>Manufacturer's Warranty Certificate</li>
    </ul>
    `;

    const fireServiceParts = `
    <p>The supplier shall provide comprehensive after-sales support for all delivered HFC-236fa Clean Agent Fire Extinguishers, including:</p>

    <ol>
        <li>Product warranty of at least one (1) year against manufacturing defects.</li>
        <li>Technical assistance and customer support during the warranty period.</li>
        <li>Inspection and maintenance guidance for proper operation and storage.</li>
        <li>Response to service requests within three (3) working days from receipt of notice.</li>
        <li>Replacement of defective parts due to manufacturing defects at no additional cost during the warranty period.</li>
        <li>Availability of trained service personnel to perform inspection, maintenance, recharging, and repair services.</li>
        <li>Provision of operating manuals, maintenance instructions, and warranty certificates upon delivery.</li>
    </ol>
    `;

    const fireCertifications = `
    <ul>
        <li>Certificate of Completion</li>
        <li>Testing and Commissioning</li>
    </ul>
    `;

    let systemEditor;
    let serviceEditor;
    let certEditor;

    ClassicEditor.create(document.querySelector('#system_components'))
        .then(editor => {
            systemEditor = editor;
        });

    ClassicEditor.create(document.querySelector('#service_parts'))
        .then(editor => {
            serviceEditor = editor;
        });

    ClassicEditor.create(document.querySelector('#certifications'))
        .then(editor => {
            certEditor = editor;
        });

    document.getElementById('project_template').addEventListener('change', function () {

        if (!systemEditor || !serviceEditor || !certEditor) {
            return;
        }

        switch (this.value) {

            case 'solar':
                systemEditor.setData(solarSystemComponents);
                serviceEditor.setData(solarServiceParts);
                certEditor.setData(solarCertifications);
                break;

            case 'fire':
                systemEditor.setData(fireSystemComponents);
                serviceEditor.setData(fireServiceParts);
                certEditor.setData(fireCertifications);
                break;

            default:
                systemEditor.setData('');
                serviceEditor.setData('');
                certEditor.setData('');
        }
    });
</script>
@endpush
