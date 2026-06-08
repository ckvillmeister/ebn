@use('Illuminate\Support\Number')
<!DOCTYPE html>
<html>
    <title>{{ $component ?? '' }}</title>
    <link href="{{ asset('architectui/architectui/main.css') }}" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: #f1f1f1;
        }

        .print-page {
            width: 210mm;
            min-height: 297mm;
            background: white;
            margin: 5mm auto;
            padding: 10mm;
            box-sizing: border-box;
            page-break-after: always;
            position: relative; /* IMPORTANT */
            overflow: hidden;
        }

        .page-content-85 {
            max-height: 170mm;
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.08;
            width: 120mm;
            z-index: 0;
        }

        .page-content {
            position: relative;
            z-index: 2;
        }

        /* FOOTER */
        .print-footer {
            position: absolute;
            top: 98%;
            bottom: 0;
            left: 0;
            width: 100%;
        }

        /* BLACK LINE */
        .footer-line-black {
            width: 85%;
            border-top: 2mm solid #000 !important;

            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        /* YELLOW LINE */
        .footer-line-yellow {
            width: 85%;
            border-top: 2mm solid #FFD700 !important;

            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        /* BLACK LINE */
        .footer-line-black-landscape {
            width: 90%;
            left: 10mm;
            border-top: 2mm solid #000 !important;

            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        /* YELLOW LINE */
        .footer-line-yellow-landscape {
            width: 90%;
            left: 10mm;
            border-top: 2mm solid #FFD700 !important;

            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        /* LOGO */
        .footer-logo {
            position: absolute;
            right: 10mm;
            bottom: 0mm;
            width: 18mm;
            height: auto;
            mix-blend-mode: multiply;
        }

        .page-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table td,
        table th {
            border: 1px solid #000;
            padding: 8px;
        }

        .attachments{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .landscape-page {
            width: 297mm;
            min-height: 210mm;
            background: white;
            margin: 5mm auto;
            padding: 10mm;
            box-sizing: border-box;
            page-break-after: always;
            position: relative;
            overflow: hidden;

            page: landscape;
        }

        .landscape-page {
            page: landscape;
        }

        @media print {

            body {
                background: white;
            }

            .print-page {
                margin: 0;
                box-shadow: none;
            }

            .print-footer {
                position: absolute;
                top: 98%;
                bottom: 0;
                left: 0;
                width: 100%;
                z-index: 9999;
            }

            .footer-line-black {
                width: 85%;
                border-top: 2mm solid #000 !important;

                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            /* YELLOW LINE */
            .footer-line-yellow {
                width: 85%;
                border-top: 2mm solid #FFD700 !important;

                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            /* BLACK LINE */
            .footer-line-black-landscape {
                width: 90%;
                left: 10mm;
                border-top: 2mm solid #000 !important;

                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            /* YELLOW LINE */
            .footer-line-yellow-landscape {
                width: 90%;
                left: 10mm;
                border-top: 2mm solid #FFD700 !important;

                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .footer-logo {
                position: absolute;
                right: 10mm;
                bottom: 0mm;
                width: 18mm;
                height: auto;
            }

            .landscape-page {
                width: 297mm;
                min-height: 210mm;
                margin: 0;
                padding: 10mm;
                box-sizing: border-box;
                page-break-after: always;
                position: relative;
                overflow: hidden;
            }

        }

        @page {
            size: A4;
            margin: 5mm;
        }

        @page landscape {
            size: A4 landscape;
            margin: 5mm;
        }
    </style>
</head>
<body>

@foreach($tc_pages as $page)

        {{-- DYNAMIC PAGE CONTENT --}}
            @if($page->page_name == 'Front Page')
                @if ($page->component_type == 'Technical Components')
                    <div class="landscape-page">
                        <div class="row mt-5">
                            <div class="col-9">
                                <div class="col-md-12">
                                    <h4><b>{{ strtoupper($business->name) ?? '' }}</b></h4>
                                </div>
                                <div class="col-md-12">
                                    <h4><b>{{ strtoupper($business->address) ?? '' }}</b></h4>
                                </div>
                                <div class="col-md-12">
                                    <h4><b>{{ strtoupper($business->number) ?? '' }}</b></h4>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="col-md-12">
                                    <img src="{{ asset($project->agency_logo_url) }}" style="height: 200px;">
                                </div>
                                <div class="col-md-12 mt-5 text-center">
                                    <h4><b>Main Folder</b></h4>
                                </div>
                            </div>
                        </div>
                        <div style="height: 150px"></div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <h1><b>{{ strtoupper($project->project_name) ?? '' }}</b></h1>
                            </div>
                        </div>
                    </div>
                    <div class="landscape-page">
                        <div class="row mt-5">
                            <div class="col-9">
                                <div class="col-md-12">
                                    <h4><b>{{ strtoupper($business->name) ?? '' }}</b></h4>
                                </div>
                                <div class="col-md-12">
                                    <h4><b>{{ strtoupper($business->address) ?? '' }}</b></h4>
                                </div>
                                <div class="col-md-12">
                                    <h4><b>{{ strtoupper($business->number) ?? '' }}</b></h4>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="col-md-12">
                                    <img src="{{ asset($project->agency_logo_url) }}" style="height: 200px;">
                                </div>
                                <div class="col-md-12 mt-5 text-center">
                                    <h4><b>Technical Documents</b></h4>
                                </div>
                            </div>
                        </div>
                        <div style="height: 150px"></div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <h1><b>{{ strtoupper($project->project_name) ?? '' }}</b></h1>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="landscape-page">
                        <div class="row mt-5">
                            <div class="col-9">
                                <div class="col-md-12">
                                    <h4><b>{{ strtoupper($business->name) ?? '' }}</b></h4>
                                </div>
                                <div class="col-md-12">
                                    <h4><b>{{ strtoupper($business->address) ?? '' }}</b></h4>
                                </div>
                                <div class="col-md-12">
                                    <h4><b>{{ strtoupper($business->number) ?? '' }}</b></h4>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="col-md-12">
                                    <img src="{{ asset($project->agency_logo_url) }}" style="height: 200px;">
                                </div>
                                <div class="col-md-12 mt-5 text-center">
                                    <h4><b>Financial Documents</b></h4>
                                </div>
                            </div>
                        </div>
                        <div style="height: 150px"></div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <h1><b>{{ strtoupper($project->project_name) ?? '' }}</b></h1>
                            </div>
                        </div>
                    </div>
                @endif
            @elseif($page->page_name == 'Cover Page')
                <div class="print-page">
                    <img src="{{ asset($project->agency_logo_url) }}" class="watermark">
                    <div class="row text-center">
                        <div class="col-md-12">
                            <h1><b>{{ strtoupper($business->name) ?? '' }}</b></h1>
                        </div>
                        <div class="col-md-12">
                            <h1><b>{{ strtoupper($business->address) ?? '' }}</b></h1>
                        </div>
                        <div style="height: 275px"></div>
                        <div class="col-md-12">
                            <h1><b>{{ strtoupper($project->project_name) ?? '' }}</b></h1>
                        </div>
                        <div style="height: 275px"></div>
                        <div class="col-md-12">
                            <h1><b>{{ strtoupper($page->component_type) ?? '' }}</b></h1>
                        </div>
                        <div style="height: 180px"></div>

                    </div>
                    <table class="table table-borderless text-center">
                        <tr>
                            <td>
                            <img src="{{ asset('images/ebn.png') }}" style="height: 185px;">
                            </td>
                            <td>
                            <img src="{{ asset('images/bagong_pilipinas.png') }}" style="height: 175px;">
                            </td>
                            <td>
                            <img src="{{ asset($project->agency_logo_url) }}" style="height: 175px;">
                            </td>
                        </tr>
                    </table>
                </div>
            @elseif($page->page_name == 'DTI')
                @foreach ($attachments as $attachment)
                    @if ($attachment->name == 'DTI Permit')
                        @php ($ctr = 1)
                        @foreach ($attachment->defaultUploads as $upload)
                            <div class="print-page">
                                <img class="attachments" src="{{ asset($upload->image_url) }}" style="page-break-after: always; {{ ($ctr == 1) ? '' : 'margin-top: 10mm;' }}">
                                <div class="print-footer">
                                    <div class="footer-line-black"></div>
                                    <div class="footer-line-yellow"></div>
                                    <img src="{{ asset($project->agency_logo_url) }}" class="footer-logo">
                                </div>
                            </div>
                            @php ($ctr += 1)
                        @endforeach
                    @endif
                @endforeach
            @elseif($page->page_name == 'PhilGEPS')
                @foreach ($attachments as $attachment)
                    @if ($attachment->name == 'PhilGEPS Certificate')
                        @foreach ($attachment->defaultUploads as $upload)
                            <div class="print-page">
                                <img class="attachments" src="{{ asset($upload->image_url) }}">
                                <div class="print-footer">
                                    <div class="footer-line-black"></div>
                                    <div class="footer-line-yellow"></div>
                                    <img src="{{ asset($project->agency_logo_url) }}" class="footer-logo">
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endforeach
            @elseif($page->page_name == "Mayor's Permit")
                @foreach ($attachments as $attachment)
                    @if ($attachment->name == "Mayor's Permit")
                        @foreach ($attachment->defaultUploads as $upload)
                            <div class="print-page">
                                <img class="attachments" src="{{ asset($upload->image_url) }}">
                                <div class="print-footer">
                                    <div class="footer-line-black"></div>
                                    <div class="footer-line-yellow"></div>
                                    <img src="{{ asset($project->agency_logo_url) }}" class="footer-logo">
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endforeach
            @elseif($page->page_name == "BIR Certificate of Registration")
                @foreach ($attachments as $attachment)
                    @if ($attachment->name == "BIR Certificate of Registration")
                        @foreach ($attachment->defaultUploads as $upload)
                            <div class="print-page">
                                <img class="attachments" src="{{ asset($upload->image_url) }}">
                                <div class="print-footer">
                                    <div class="footer-line-black"></div>
                                    <div class="footer-line-yellow"></div>
                                    <img src="{{ asset($project->agency_logo_url) }}" class="footer-logo">
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endforeach
            @elseif($page->page_name == "Statement of All Ongoing Government and Private Contracts")
                <div class="landscape-page">
                    <div style="font-size: 8pt !important">
                        <div class="row">
                            <div class="col-7">
                                Standard Form Number: <b>SF-GOOD-13a</b>
                            </div>
                            <div class="col-2">
                                Project Reference No.:
                            </div>
                            <div class="col-3 border-bottom">
                                <b>{{ $project->project_reference_no ?? '' }}</b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-7">
                                Revised on: <b>July 28, 2004</b>
                            </div>
                            <div class="col-2">
                                Name of the Project:
                            </div>
                            <div class="col-3 border-bottom">
                                <b>{{ $project->project_name }}</b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-7">

                            </div>
                            <div class="col-2">
                                Location of the Project:
                            </div>
                            <div class="col-3 border-bottom">
                                <b>{{ $project->address }}</b>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <b>STATEMENT OF ALL ONGOING GOVERNMENT & PRIVATE CONTRACTS including contracts awarded but not yet started, if any (whether similar or not similar in nature)</b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-7">
                                Business Name: <b>{{ strtoupper($business->name) }}</b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-7">
                                Business Address: <b>{{ strtoupper($business->address) }}</b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <style>
                                    .ogpc {
                                        border-collapse: collapse;
                                    }

                                    .ogpc th, td {
                                        padding-top: 0 !important;
                                        padding-bottom: 0 !important;
                                    }
                                </style>
                                <table class="ogpc" style="font-size: 8pt !important; border-collapse: collapse !important;">
                                    <thead>
                                        <tr>
                                            <th class="text-center" rowspan="2">NAME OF CONTRACT / PROJECT COST</th>
                                            <th rowspan="2">
                                                a. Owners Name<br>
                                                b. Address <br>
                                                c. Telephone No. <br>
                                            </th>
                                            <th class="text-center" rowspan="2">Nature of Work</th>
                                            <th class="text-center" colspan="2">Bidder's Role</th>
                                            <th rowspan="2">
                                                a. Date Awarded<br>
                                                b. Date Started <br>
                                                c. Date of Completion <br>
                                            </th>
                                            <th class="text-center" colspan="2">% of Accomplishment</th>
                                            <th class="text-center" rowspan="2">
                                                Value of Outstanding Works / Undelivered Portion
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Description</th>
                                            <th class="text-center">%</th>
                                            <th class="text-center">Planned</th>
                                            <th class="text-center">Actual</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="9"><b>Government</b></td>
                                        </tr>
                                        @foreach ($project->aogpc as $proj)
                                            @if($proj->project_type == 'Government')
                                                <tr>
                                                    <td>
                                                        Name of Contract: <b>{{ $proj->name_of_contract ?? '' }}</b><br>
                                                        Project Cost: <b>{{ $proj->project_cost ?? '' }}</b><br>
                                                    </td>
                                                    <td>
                                                        a. <b>{{ $proj->owner_name ?? '' }}</b><br>
                                                        b. <b>{{ $proj->address ?? '' }}</b><br>
                                                        c. <b>{{ $proj->telephone_no ?? '' }}</b><br>
                                                    </td>
                                                    <td>
                                                        {{ $proj->nature_of_work ?? '' }}
                                                    </td>
                                                    <td>
                                                        {{ $proj->bidder_role_description ?? '' }}
                                                    </td>
                                                    <td>
                                                        {{ $proj->bidder_role_percentage ?? '' }}
                                                    </td>
                                                    <td>
                                                        a. <b>{{ date('F d, Y', strtotime($proj->date_awarded)) ?? '' }}</b><br>
                                                        b. <b>{{ date('F d, Y', strtotime($proj->date_started)) ?? '' }}</b><br>
                                                        c. <b>{{ date('F d, Y', strtotime($proj->date_of_completion)) ?? '' }}</b><br>
                                                    </td>
                                                    <td>
                                                        {{ $proj->planned_percentage ?? '' }}
                                                    </td>
                                                    <td>
                                                        {{ $proj->actualt_percentage ?? '' }}
                                                    </td>
                                                    <td>
                                                        {{ $proj->outstanding_works ?? '' }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        <tr>
                                            <td colspan="9"><b>Private</b></td>
                                        </tr>
                                        @foreach ($project->aogpc as $proj)
                                            @if($proj->project_type == 'Private')
                                            <tr>
                                                    <td>
                                                        Name of Contract: <b>{{ $proj->name_of_contract ?? '' }}</b><br>
                                                        Project Cost: <b>{{ $proj->project_cost ?? '' }}</b><br>
                                                    </td>
                                                    <td>
                                                        a. <b>{{ $proj->owner_name ?? '' }}</b><br>
                                                        b. <b>{{ $proj->address ?? '' }}</b><br>
                                                        c. <b>{{ $proj->telephone_no ?? '' }}</b><br>
                                                    </td>
                                                    <td>
                                                        {{ $proj->nature_of_work ?? '' }}
                                                    </td>
                                                    <td>
                                                        {{ $proj->bidder_role_description ?? '' }}
                                                    </td>
                                                    <td>
                                                        {{ $proj->bidder_role_percentage ?? '' }}
                                                    </td>
                                                    <td>
                                                        a. <b>{{ date('F d, Y', strtotime($proj->date_awarded)) ?? '' }}</b><br>
                                                        b. <b>{{ date('F d, Y', strtotime($proj->date_started)) ?? '' }}</b><br>
                                                        c. <b>{{ date('F d, Y', strtotime($proj->date_of_completion)) ?? '' }}</b><br>
                                                    </td>
                                                    <td>
                                                        {{ $proj->planned_percentage ?? '' }}
                                                    </td>
                                                    <td>
                                                        {{ $proj->actualt_percentage ?? '' }}
                                                    </td>
                                                    <td>
                                                        {{ $proj->outstanding_works ?? '' }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6">
                                Note: This statement shall be supported with <b>CLEAR COPIES</b> of:<br>
                                1. Notice of Award of Notice to Proceed; <b>OR</b><br>
                                2. Copy of Purchase Order or actual contract or its equivalent;<br><br>
                                <b>***** Please use Government Issued ID for notarial</b><br><br>
                                <div class="row">
                                    <div class="col-4">Submitted by:</div>
                                    <div class="col-5 border-bottom text-center">{{ strtoupper($signatories->where('position', 'Chief Operating Executive')->first()->name) ?? '' }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-4"></div>
                                    <div class="col-5 text-center" style="font-size: 6pt !important"><em>(Printed Name & Signature)</em></div>
                                </div>
                                <div class="row">
                                    <div class="col-4">Designation:</div>
                                    <div class="col-5 border-bottom text-center">CHIEF EXECUTIVE OFFICER (CEO)</div>
                                </div>
                                <div class="row">
                                    <div class="col-4">Date:</div>
                                    <div class="col-5 border-bottom text-center">{{ date('F d, Y', strtotime($project->aogpc_date_signed)) }}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <p style="text-align: justify;">
                                    SUBSCRIBED AND SWORN before me this ______________ day of ____________________
                                    in __________________. Affiant exhibited his/her ID ___________________ number
                                    _________ issued on _____________________, at __________________________.
                                </p><br><br>
                                Doc No.: _______________<br>
                                Page No.: ______________<br>
                                Book No.: ______________<br>
                                Series of.: ____________<br>
                            </div>
                        </div>
                    </div>
                    <div class="print-footer">
                        <div class="footer-line-black-landscape"></div>
                        <div class="footer-line-yellow-landscape"></div>
                        <img src="{{ asset($project->agency_logo_url) }}" class="footer-logo">
                    </div>
                </div>
            @elseif($page->page_name == "Statement of Single Largest Completed Contract")
                <div class="landscape-page">
                    <div style="font-size: 8pt !important">
                        <div class="row">
                            <div class="col-7">
                                Standard Form Number: <b>SF-GOOD-13</b>
                            </div>
                            <div class="col-2">
                                Project Reference No.:
                            </div>
                            <div class="col-3 border-bottom">
                                <b>{{ $project->project_reference_no ?? '' }}</b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-7">
                                Revised on: <b>July 28, 2004</b>
                            </div>
                            <div class="col-2">
                                Name of the Project:
                            </div>
                            <div class="col-3 border-bottom">
                                <b>{{ $project->project_name }}</b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-7">

                            </div>
                            <div class="col-2">
                                Location of the Project:
                            </div>
                            <div class="col-3 border-bottom">
                                <b>{{ $project->address }}</b>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <b>STATEMENT OF SINGLE LARGEST COMPLETED CONTRACT similar the contract to be bid</b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-7">
                                Business Name: <b>{{ strtoupper($business->name) }}</b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-7">
                                Business Address: <b>{{ strtoupper($business->address) }}</b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table style="font-size: 8pt !important">
                                    <thead>
                                        <tr>
                                            <th class="text-center" rowspan="2">NAME OF CONTRACT / PROJECT COST</th>
                                            <th rowspan="2">
                                                a. Owners Name<br>
                                                b. Address <br>
                                                c. Telephone No. <br>
                                            </th>
                                            <th class="text-center" rowspan="2">Nature of Work</th>
                                            <th class="text-center" colspan="2">Bidder's Role</th>
                                            <th rowspan="2">
                                                a. Amount of Award<br>
                                                b. Amount of Completion <br>
                                                c. Duration <br>
                                            </th>
                                            <th rowspan="2">
                                                a. Date Awarded<br>
                                                b. Contract Effectivity<br>
                                                c. Date Completed<br>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Description</th>
                                            <th class="text-center">%</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="7"><b>Government</b></td>
                                        </tr>
                                        @foreach ($project->slcc as $proj)
                                            @if($proj->project_type == 'Government')
                                                <tr>
                                                    <td>
                                                        Name of Contract: <b>{{ $proj->name_of_contract ?? '' }}</b>
                                                    </td>
                                                    <td>
                                                        a. <b>{{ $proj->owner_name ?? '' }}</b><br>
                                                        b. <b>{{ $proj->address ?? '' }}</b><br>
                                                        c. <b>{{ $proj->telephone_no ?? '' }}</b><br>
                                                    </td>
                                                    <td>
                                                        {{ $proj->nature_of_work ?? '' }}
                                                    </td>
                                                    <td>
                                                        {{ $proj->bidder_role_description ?? '' }}
                                                    </td>
                                                    <td>
                                                        {{ $proj->bidder_role_percentage ?? '' }}
                                                    </td>
                                                    <td>
                                                        a. <b>{{ number_format($proj->amount_of_award, 2) ?? '' }}</b><br>
                                                        b. <b>{{ number_format($proj->amount_of_completion, 2) ?? '' }}</b><br>
                                                        c. <b>{{ $proj->duration }} Days</b><br>
                                                    </td>
                                                    <td>
                                                        a. <b>{{ date('F d, Y', strtotime($proj->date_awarded)) ?? '' }}</b><br>
                                                        b. <b>{{ date('F d, Y', strtotime($proj->contract_effectivity)) ?? '' }}</b><br>
                                                        c. <b>{{ date('F d, Y', strtotime($proj->date_completed)) ?? '' }}</b><br>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        <tr>
                                            <td colspan="7"><b>Private</b></td>
                                        </tr>
                                        @foreach ($project->slcc as $proj)
                                            @if($proj->project_type == 'Private')
                                                <tr>
                                                    <td>
                                                        Name of Contract: <b>{{ $proj->name_of_contract ?? '' }}</b>
                                                    </td>
                                                    <td>
                                                        a. <b>{{ $proj->owner_name ?? '' }}</b><br>
                                                        b. <b>{{ $proj->address ?? '' }}</b><br>
                                                        c. <b>{{ $proj->telephone_no ?? '' }}</b><br>
                                                    </td>
                                                    <td>
                                                        {{ $proj->nature_of_work ?? '' }}
                                                    </td>
                                                    <td>
                                                        {{ $proj->bidder_role_description ?? '' }}
                                                    </td>
                                                    <td>
                                                        {{ $proj->bidder_role_percentage ?? '' }}
                                                    </td>
                                                    <td>
                                                        a. <b>{{ number_format($proj->amount_of_award, 2) ?? '' }}</b><br>
                                                        b. <b>{{ number_format($proj->amount_of_completion, 2) ?? '' }}</b><br>
                                                        c. <b>{{ $proj->duration }} Days</b><br>
                                                    </td>
                                                    <td>
                                                        a. <b>{{ date('F d, Y', strtotime($proj->date_awarded)) ?? '' }}</b><br>
                                                        b. <b>{{ date('F d, Y', strtotime($proj->contract_effectivity)) ?? '' }}</b><br>
                                                        c. <b>{{ date('F d, Y', strtotime($proj->date_completed)) ?? '' }}</b><br>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6">
                                Note: This statement shall be supported with <b>CLEAR COPIES</b> of:<br>
                                1. Notice of Award of Notice to Proceed; <b>OR</b><br>
                                2. Copy of Purchase Order or actual contract or its equivalent;<br><br>
                                <b>***** Please use Government Issued ID for notarial</b><br><br>
                                <div class="row">
                                    <div class="col-4">Submitted by:</div>
                                    <div class="col-5 border-bottom text-center">{{ strtoupper($signatories->where('position', 'Chief Operating Executive')->first()->name) ?? '' }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-4"></div>
                                    <div class="col-5 text-center" style="font-size: 6pt !important"><em>(Printed Name & Signature)</em></div>
                                </div>
                                <div class="row">
                                    <div class="col-4">Designation:</div>
                                    <div class="col-5 border-bottom text-center">CHIEF EXECUTIVE OFFICER (CEO)</div>
                                </div>
                                <div class="row">
                                    <div class="col-4">Date:</div>
                                    <div class="col-5 border-bottom text-center">{{ date('F d, Y', strtotime($project->slcc_date_signed)) }}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <p style="text-align: justify;">
                                    SUBSCRIBED AND SWORN before me this ______________ day of ____________________
                                    in __________________. Affiant exhibited his/her ID ___________________ number
                                    _________ issued on _____________________, at __________________________.
                                </p><br><br>
                                Doc No.: _______________<br>
                                Page No.: ______________<br>
                                Book No.: ______________<br>
                                Series of.: ____________<br>
                            </div>
                        </div>
                    </div>
                    <div class="print-footer">
                        <div class="footer-line-black-landscape"></div>
                        <div class="footer-line-yellow-landscape"></div>
                        <img src="{{ asset($project->agency_logo_url) }}" class="footer-logo">
                    </div>
                </div>
            @elseif($page->page_name == "Notice to Proceed")
                @foreach ($project_attachments as $attachment)
                    @if ($attachment->attachment_type == 1)
                        <div class="print-page">
                            <img class="attachments" src="{{ asset($attachment->image_url) }}">
                            <div class="print-footer">
                                <div class="footer-line-black"></div>
                                <div class="footer-line-yellow"></div>
                                <img src="{{ asset($project->agency_logo_url) }}" class="footer-logo">
                            </div>
                        </div>
                    @endif
                @endforeach
            @elseif($page->page_name == "Notice of Awards")
                @foreach ($project_attachments as $attachment)
                    @if ($attachment->attachment_type == 2)
                        <div class="print-page">
                            <img class="attachments" src="{{ asset($attachment->image_url) }}">
                            <div class="print-footer">
                                <div class="footer-line-black"></div>
                                <div class="footer-line-yellow"></div>
                                <img src="{{ asset($project->agency_logo_url) }}" class="footer-logo">
                            </div>
                        </div>
                    @endif
                @endforeach
            @elseif($page->page_name == "Certificate from Project Proponent")
                @foreach ($project_attachments as $attachment)
                    @if ($attachment->attachment_type == 4)
                        <div class="print-page">
                            <img class="attachments" src="{{ asset($attachment->image_url) }}">
                            <div class="print-footer">
                                <div class="footer-line-black"></div>
                                <div class="footer-line-yellow"></div>
                                <img src="{{ asset($project->agency_logo_url) }}" class="footer-logo">
                            </div>
                        </div>
                    @endif
                @endforeach
            @elseif($page->page_name == "Audited Financial Statement")
                @foreach ($attachments as $attachment)
                    @if ($attachment->name == "Audited Financial Statement")
                        @foreach ($attachment->defaultUploads as $upload)
                            <div class="print-page">
                                <img class="attachments" src="{{ asset($upload->image_url) }}">
                                <div class="print-footer">
                                    <div class="footer-line-black"></div>
                                    <div class="footer-line-yellow"></div>
                                    <img src="{{ asset($project->agency_logo_url) }}" class="footer-logo">
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endforeach
            @elseif($page->page_name == "Net Financial Contracting Capacity")
                @foreach ($attachments as $attachment)
                    @if ($attachment->name == "NFCC")
                        @foreach ($attachment->defaultUploads as $upload)
                            <div class="print-page">
                                <img class="attachments" src="{{ asset($upload->image_url) }}">
                                <div class="print-footer">
                                    <div class="footer-line-black"></div>
                                    <div class="footer-line-yellow"></div>
                                    <img src="{{ asset($project->agency_logo_url) }}" class="footer-logo">
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endforeach
                    <!-- <h5>A.</h5>
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th style="width:15%" class="text-center"></th>
                                <th style="width:50%" class="text-center"></th>
                                <th style="width:35%" class="text-center">Year</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php ($ctr = 1)
                            @foreach ($nfcc as $n)
                            <tr>
                                <td class="text-center">{{ $ctr++ }}</td>
                                <td>{{ $n->name }}</td>
                                <td>{{ number_format($n->amount, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table><br><br>
                    <h5><p>B. The Net Financial Contracting Capacity (NFCC) based on the above data is computed as follows:</p></h5>
                    <br><br>
                    <h5>NFCC = 15 x</h5>
                    <h5>NFCC =</h5>
                    <br><br><br>
                    <h5><p>Herewith attached are certified true copies of the Income Tax Return and Audited Financial Statement</p></h5>
                    <br><br><br><br><br><br>
                    <h5>Submitted by:</h5>
                    <br><br><br><br>
                    <h5><b>{{ strtoupper($signatories->where('position', 'Chief Operating Executive')->first()->name) ?? '' }}</b></h5>
                    <h5>Date:</h5>
                    <div class="print-footer">
                        <div class="footer-line-black"></div>
                        <div class="footer-line-yellow"></div>
                        <img src="{{ asset($project->agency_logo_url) }}" class="footer-logo">
                    </div> -->
            @elseif($page->page_name == "Tax Clearance Certificate")
                @foreach ($attachments as $attachment)
                    @if ($attachment->name == "Tax Clearance Certificate")
                        @foreach ($attachment->defaultUploads as $upload)
                            <div class="print-page">
                                <img class="attachments" src="{{ asset($upload->image_url) }}">
                                <div class="print-footer">
                                    <div class="footer-line-black"></div>
                                    <div class="footer-line-yellow"></div>
                                    <img src="{{ asset($project->agency_logo_url) }}" class="footer-logo">
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endforeach
            @elseif($page->page_name == "Bid Securing Declaration")
                <div class="print-page">
                    <div class="row text-center">
                        <div class="col-md-12">
                            <h4><b>Bid Securing Declaration Form</b></h4>
                            [shall be submitted with the Bid if bidder opts to provide this form of bid security]
                        </div>
                    </div>
                    <hr>
                    REPUBLIC OF THE PHILIPPINES)<br>
                    CITY/MUNICIPALITY OF TALIBON) S.S.<br><br>
                    <div class="row text-center">
                        <div class="col-md-12">
                        <b>BID SECURING DECLARATION</b><br>
                        Project Identification No.: <b>{{ $project->project_identification_no ?? '' }}</b><br><br>
                        CONTRACT NAME: <b>{{ $project->project_name ?? '' }}</b>
                        </div>
                    </div>
                    To: Bids and Awards Committee <b>{{ $project->agency_name ?? '' }}, {{ $project->address ?? '' }}</b><br><br>
                    I, the undersigned, declare that:<br><br>
                    <p style="text-align: justify;">1. I understand that, according to your conditions, bids must be supported by a Bid Security, which may be in the form of a Bid Securing Declaration.</p>
                    <p style="text-align: justify;">2. I/We accept that: (a) I/we will be automatically disqualified from bidding for any procurement
                        contract with any procuring entity for a period of two (2) years upon receipt of your Blacklisting Order; and, (b) I/we will
                        pay the applicable fine provided under Section 6 of the Guidelines on the Use of Bid Securing Declaration, within fifteen (15)
                        days from receipt of the written demand by the procuring entity for the commission of acts resulting to the enforcement of the bid
                        securing declaration under Sections 23.1(b), 34.2, 40.1 and 69.1, except 69.1(f), of the IRR of RA No. 9184; without prejudice to other
                        legal action the government may undertake.
                    </p>
                    <p style="text-align: justify;">3. I/We understand that this Bid Securing Declaration shall cease to be valid on the following circumstances:<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a. Upon expiration of the bid validity period, or any extension thereof pursuant to your request;<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;b. I am/we declared ineligble or post-disqualified upon receipt of your notice to such effect, and (i) I/we failed to timely file
                    a request for reconsideration or (ii) I/we filed a waiver to avail of said right; and<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;c. I am/we are declared the bidder with the Lowest Calculated Responsive Bid, and I/we have furnished the performance security and signed the Contract.
                    </p>
                    IN WITNESS WHEREOF, I/We have hereunto set my/our hand/s this <b>{{ $project->bid_securing_declaration_date ? (date('jS', strtotime($project->bid_securing_declaration_date))) : date('jS') }}</b> day of <b>{{ $project->bid_securing_declaration_date ? (date('F Y', strtotime($project->bid_securing_declaration_date))) : date('F Y') }}</b> at Talibon, Bohol.
                    <br><br><br><br>
                    <div class="row d-print-flex">
                        <div class="col-6"></div>
                        <div class="col-6 text-center">
                            <b>{{ strtoupper($signatories->where('position', 'Chief Operating Executive')->first()->name) ?? '' }}</b><br>
                            EBN ENTERPRISES PROPRIETOR<br>
                            LTO DRIVERS LICENSE NO. G53-22-300571<br>
                            Affiant
                        </div>
                    </div>
                    <p style="text-align: justify;">
                        SUBSCRIBED AND SWORN to before me this ________ day of _____________, <b>{{ date('Y') }}</b> at ____________________________ Bohol, Philippines.
                    </p>
                    <br>
                    DOC No.    _______;<br>
                    PAGE No.  _______;<br>
                    BOOK No. _______;<br>
                    SERIES OF <b>{{ date('Y') }}</b>
                    <div class="print-footer">
                        <div class="footer-line-black"></div>
                        <div class="footer-line-yellow"></div>
                        <img src="{{ asset($project->agency_logo_url) }}" class="footer-logo">
                    </div>
                </div>
            @elseif($page->page_name == "Omnibus Sworn Statement")
                <div class="print-page">
                    <div class="row text-center">
                        <div class="col-md-12">
                            <h4><b>Omnibus Sworn Statement</b></h4>
                        </div>
                    </div>
                    <hr>
                    REPUBLIC OF THE PHILIPPINES)<br>
                    CITY/MUNICIPALITY OF TALIBON) S.S.<br><br>
                    <div class="row text-center">
                        <div class="col-md-12">
                        <h5><b>AFFIDAVIT</b></h5>
                        </div>
                    </div><br>
                    <p style="text-align: justify;">I, Elmer B. Nuez, of legal age, Married, Filipino, and residing at Kinan-oan, Trinidad, Bohol after having been duly sworn in accordance with law, do hereby depose and state that:</p><br>
                    <p style="text-align: justify;">1. I am the sole proprietor or authorized representative of EBN Enterprises with office address at Poblacion, Trinidad, Bohol;</p><br>
                    <p style="text-align: justify;">2. As the owner and sole proprietor, or authorized representative of EBN Enterprises, I have full power and authority to do, execute and perform any and all acts necessary to participate, submit the bid, and to sign and execute the ensuing contract for <b><u>{{ $project->project_name ?? '' }}</u></b>. as shown in the attached duly notarized Special Power of Attorney;</p><br>
                    <p style="text-align: justify;">3. EBN Enterprises is not “blacklisted” or barred from bidding by the Government of the Philippines or any of its agencies, offices, corporations, or Local Government Units, foreign government/foreign or international financing institution whose blacklisting rules have been recognized by the Government Procurement Policy Board, <b><u>by itself or by relation, membership, association, affiliation, or controlling interest with another blacklisted person or entity as defined and provided for in the Uniform Guidelines on Blacklisting;</u></b></p><br>
                    <p style="text-align: justify;">4. Each of the documents submitted in satisfaction of the bidding requirements is an authentic copy of the original, complete, and all statements and information provided therein are true and correct;</p><br>
                    <p style="text-align: justify;">5. EBN Enterprises is authorizing the Head of the Procuring Entity or its duly authorized representative(s) to verify all the documents submitted;</p><br>
                    <p style="text-align: justify;">6. The owner or sole proprietor is not related to the Head of the Procuring Entity, members of the Bids and Awards Committee (BAC), the Technical Working Group, and the BAC Secretariat, the head of the Project Management Office or the end-user unit, and the project consultants by consanguinity or affinity up to the third civil degree;</p><br>
                    <p style="text-align: justify;">7. EBN Enterprises complies with existing labor laws and standards; and</p><br>
                    <p style="text-align: justify;">8. EBN Enterprises is aware of and has undertaken the responsibilities as a Bidder in compliance with the Philippine Bidding Documents, which includes:<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;a. Carefully examining all of the Bidding Documents;<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;b. Acknowledging all conditions, local or otherwise, affecting the implementation of the Contract;
                    <div class="print-footer">
                        <div class="footer-line-black"></div>
                        <div class="footer-line-yellow"></div>
                        <img src="{{ asset($project->agency_logo_url) }}" class="footer-logo">
                    </div>
                </div>
                <div class="print-page">
                        &nbsp;&nbsp;&nbsp;&nbsp;c. Making an estimate of the facilities available and needed for the contract to be bid, if any; and<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;d. Inquiring or securing Supplemental/Bid Bulletin(s) issued for the <b><u>{{ $project->project_name ?? '' }}</u></b>.
                    </p><br>
                    <p style="text-align: justify;">9. <em>EBN Enterprises</em> did not give or pay directly or indirectly, any commission, amount, fee, or any form of consideration, pecuniary or otherwise, to any person or official, personnel or representative of the government in relation to any procurement project or activity.</p><br>
                    <p style="text-align: justify;">10.	<u>In case advance payment was made or given, failure to perform or deliver any of the obligations and undertakings in the contract shall be sufficient grounds to constitute criminal liability for Swindling (Estafa) or the commission of fraud with unfaithfulness or abuse of confidence through misappropriating or converting any payment received by a person or entity under an obligation involving the duty to deliver certain goods or services, to the prejudice of the public and the government of the Philippines pursuant to Article 315 of Act No. 3815 s. 1930, as amended, or the Revised Penal Code.</u></p><br>

                    IN WITNESS WHEREOF, I/We have hereunto set my/our hand/s this <b>{{ $project->omnibus_sworn_statement_date ? (date('jS', strtotime($project->omnibus_sworn_statement_date))) : date('jS') }}</b> day of <b>{{ $project->omnibus_sworn_statement_date ? (date('F Y', strtotime($project->omnibus_sworn_statement_date))) : date('F Y') }}</b> at Talibon, Bohol.
                    <br><br><br><br><br><br>
                    <div class="row d-print-flex">
                        <div class="col-6"></div>
                        <div class="col-6 text-center">
                            <b>{{ strtoupper($signatories->where('position', 'Chief Operating Executive')->first()->name) ?? '' }}</b><br>
                            EBN ENTERPRISES PROPRIETOR<br>
                            LTO DRIVERS LICENSE NO. G53-22-300571<br>
                            Affiant
                        </div>
                    </div><br><br>
                    <p style="text-align: justify;">
                        SUBSCRIBED AND SWORN to before me this ________ day of _____________, <b>{{ date('Y') }}</b> at ____________________________ Bohol, Philippines.
                    </p>
                    <br>
                    DOC No. &nbsp;&nbsp;_______;<br>
                    PAGE No. &nbsp;_______;<br>
                    BOOK No. _______;<br>
                    SERIES OF <b>{{ date('Y') }}</b>
                    <div class="print-footer">
                        <div class="footer-line-black"></div>
                        <div class="footer-line-yellow"></div>
                        <img src="{{ asset($project->agency_logo_url) }}" class="footer-logo">
                    </div>
                </div>
            @elseif($page->page_name == "Letter of Intent")
                <div class="print-page">
                    <div class="row d-print-flex">
                        <div class="col-1">
                            <br><br><br><br><br>
                            <img src="{{ asset('images/ebn.png') }}" style="margin-left: 30%; height: 100px">
                        </div>
                        <div class="col-10">
                            <div class="text-center">
                                <p style="font-size: 8pt">
                                    <h2 style="color: red"><b>{{ strtoupper($business->name) }}</b></h2>
                                    {{ $business->address }}<br>
                                    Location: {{ $business->location }}<br>
                                    Authorized Distributor: {{ strtoupper($signatories->where('position', 'Chief Operating Executive')->first()->name) ?? '' }}<br>
                                    Contact No. {{ $business->number }}<br>
                                    DTI Permit No. {{ $business->dti }}<br>
                                    BIR COR No. {{ $business->bir }}<br>
                                    Mayor's Permit No. {{ $business->mo_permit }}<br>
                                    Philippine Standard Quality Certified ISO Registered<br>
                                    Platinum Philgeps Registered
                                </p>
                            </div>
                        </div>
                        <div class="col-1"></div>
                    </div><br><br>
                    <h2 class="text-center"><b>LETTER OF INTENT</b></h2><br><br>
                    <b>To:</b><br>
                    The Bids and Awards Committee<br><br>
                    <b>Subject:</b>Letter of Intent to Participate in Bidding<br><br>
                    Dear Members of the Bids and Awards Committee,<br><br>
                    Good day.<br><br>
                    <p style="text-align: justify;">
                        We, <b>{{ strtoupper($business->name) }}</b>, would like to express our intent to participate in the upcoming bidding as announced by your office.<br><br>
                        Our company is duly registered and qualified to undertake the said project, and we are interested in obtaining the bidding documents and participating in the process.<br><br>
                        Please provide us with the necessary information and requirements for registration, submission , and other relevant details pertaining to the bidding.<br><br>
                        We look forward to your favorable response and to the opportunity to participate in this bidding. Thank you and more power.<br><br>
                        Respectfully yours,
                    </p><br><br><br>
                    <div class="row d-print-flex">
                        <div class="col-8"></div>
                        <div class="col-4 text-center">
                            <b>{{ strtoupper($signatories->where('position', 'Chief Operating Executive')->first()->name) ?? '' }}</b><br>
                            EBN ENTERPRISES CEO
                        </div>
                    </div>
                    <div class="print-footer">
                        <div class="footer-line-black"></div>
                        <div class="footer-line-yellow"></div>
                        <img src="{{ asset($project->agency_logo_url) }}" class="footer-logo">
                    </div>
                </div>
            @elseif($page->page_name == "Technical Specifications")
                <div class="print-page">
                    <div class="page-content-85">
                        <div class="row text-center">
                            <div class="col-md-12">
                                <h4><b>{{ strtoupper($page->page_name) }}</b></h4>
                            </div>
                        </div>
                        <hr>
                        <div>
                            <h6><b>I. SYSTEM COMPONENTS</b></h6><br>
                            <div style="font-size: 8pt !important">{!! $project->system_components ?? '' !!}</div>
                        </div>
                        <div class="print-footer">
                            <div class="footer-line-black"></div>
                            <div class="footer-line-yellow"></div>
                            <img src="{{ asset($project->agency_logo_url) }}" class="footer-logo">
                        </div>
                    </div>
                </div>
                <div class="print-page">
                    <div class="page-content-85">
                        <h6><b>II. PRODUCTION & DELIVERY SCHEDULE</b></h6><br>

                        <h6><ul>
                        @foreach ($delivery as $dl)
                            <li><b>{{ $dl->description }}:</b>&nbsp;{{ $dl->schedule }}&nbsp;({{ $dl->remarks }})</li>
                        @endforeach</ul></h6><br>

                        <h6><b>III. MAN-POWER REQUIREMENTS</b></h6><br>
                        <h6><ul>
                        @php ($ctr = 1)
                        @foreach ($manpower as $mp)
                            <li><b>{{ strtoupper($mp->type->name) }}:</b>&nbsp;{{ $mp->quantity }}M/P&nbsp;({{ $mp->task }})</li>
                        @endforeach</ul></h6><br>
                        <div class="print-footer">
                            <div class="footer-line-black"></div>
                            <div class="footer-line-yellow"></div>
                            <img src="{{ asset($project->agency_logo_url) }}" class="footer-logo">
                        </div>
                    </div>
                </div>
                <div class="print-page">
                    <div class="page-content-85">
                        <h6><b>IV. AFTER SALES SERVICE & PARTS</b></h6><br>
                        @php ($service_parts = strtr(($project->service_parts ?? ''), ['{warranty}' => $project->fc_warranty]))
                        <h6>{!! $service_parts !!}</h6>
                        <h6><b>V. COMPLIANCE & CERTIFICATIONS</b></h6><br>
                        <h6>{!! $project->certifications ?? '' !!}</h6>
                        <br>
                        <table class="mt-2">
                            <tr>
                                <td style="width:25%; border: none; padding: 0">Name:</td>
                                <td style="border: none; padding: 0"><b>{{ strtoupper($signatories->where('position', 'Chief Operating Executive')->first()->name) ?? '' }}</b></td>
                            </tr>
                            <tr>
                                <td style="width:25%; border: none; padding: 0">Legal Capacity:</td>
                                <td style="border: none; padding: 0"><b>CHIEF EXECUTIVE OFFICER (CEO)</b></td>
                            </tr>
                            <tr>
                                <td style="width:25%; border: none; padding: 0">Signature:</td>
                                <td style="border: none; padding: 0"></td>
                            </tr>
                            <tr>
                                <td style="width:25%; border: none; padding: 0">Duly authorized to sign the Bid for and behalf of:</td>
                                <td style="border: none; padding: 0"><b>EBN ENTERPRISES</b></td>
                            </tr>
                            <tr>
                                <td style="width:25%; border: none; padding: 0">Date:</td>
                                <td style="border: none; padding: 0">{{ date('F d, Y') ?? '' }}</td>
                            </tr>
                        </table>
                        <div class="print-footer">
                            <div class="footer-line-black"></div>
                            <div class="footer-line-yellow"></div>
                            <img src="{{ asset($project->agency_logo_url) }}" class="footer-logo">
                        </div>
                    </div>
                </div>
            @elseif($page->page_name == "Organizational Chart")
                <div class="print-page text-center">
                    <div class="row text-center">
                        <div class="col-md-12">
                            <h4><b>I. EBN ORGANIZATIONAL CHART</b></h4>
                        </div>
                    </div>
                    @foreach ($attachments as $attachment)
                        @if ($attachment->name == "Organizational Chart")
                            @foreach ($attachment->defaultUploads as $upload)
                                <img class="attachments" src="{{ asset($upload->image_url) }}" style="width: 95%">
                            @endforeach
                        @endif
                    @endforeach
                    <div class="print-footer">
                        <div class="footer-line-black"></div>
                        <div class="footer-line-yellow"></div>
                        <img src="{{ asset($project->agency_logo_url) }}" class="footer-logo">
                    </div>
                </div>
            @elseif($page->page_name == "Production and Delivery Schedule")
                <div class="print-page">
                    <style>
                        .tbl-delivery thead th{
                            background-color: #0d6efd !important;
                            -webkit-print-color-adjust: exact !important; /* For Chrome, Safari, and Edge */
                            print-color-adjust: exact !important;
                            border: 1px solid #2B2A2A;
                            color: white;
                        }

                        .tbl-delivery tbody td{
                            border: 1px solid #2B2A2A;
                        }
                    </style>
                    <div class="row text-center">
                        <div class="col-md-12">
                            <h4><b>II. PRODUCTION & DELIVERY SCHEDULE</b></h4>
                        </div>
                    </div><br><br><br>
                    <div class="row">
                        <div class="col-md-12">
                            <h5><b>PHASE TIMELINE DETAILS:</b></h5>
                        </div>
                    </div><br>
                    <table class="table table-striped tbl-delivery">
                        <thead class="thead-primary">
                            <tr>
                                <th class="text-center">DESCRIPTION</th>
                                <th class="text-center">SCHEDULE</th>
                                <th class="text-center  ">REMARKS</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($delivery as $del)
                            <tr>
                                <td>{{ $del->description ?? '' }}</td>
                                <td>{{ $del->schedule ?? '' }}</td>
                                <td>{{ $del->remarks ?? '' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="print-footer">
                        <div class="footer-line-black"></div>
                        <div class="footer-line-yellow"></div>
                        <img src="{{ asset($project->agency_logo_url) }}" class="footer-logo">
                    </div>
                </div>
            @elseif($page->page_name == "Man-Power Requirements")
                <div class="print-page">
                    <div class="row text-center">
                        <div class="col-md-12">
                            <h4><b>III. MAN-POWER REQUIREMENTS</b></h4>
                        </div>
                    </div><br><br><br>
                    @php ($ctr = 1)
                    @foreach ($manpower as $mp)
                    <h5>{{ $ctr++ }}.&nbsp;<b>{{ strtoupper($mp->type->name) }}:</b>&nbsp;{{ $mp->quantity }}M/P&nbsp;({{ $mp->task }})</h5><br>
                    @endforeach
                    <div class="print-footer">
                        <div class="footer-line-black"></div>
                        <div class="footer-line-yellow"></div>
                        <img src="{{ asset($project->agency_logo_url) }}" class="footer-logo">
                    </div>
                    <div class="print-footer">
                        <div class="footer-line-black"></div>
                        <div class="footer-line-yellow"></div>
                        <img src="{{ asset($project->agency_logo_url) }}" class="footer-logo">
                    </div>
                </div>
            @elseif($page->page_name == "Equipment Requirements")
                <div class="print-page">
                    <style>
                        .tbl-ter thead th{
                            background-color: #2B2A2A !important;
                            -webkit-print-color-adjust: exact !important; /* For Chrome, Safari, and Edge */
                            print-color-adjust: exact !important;
                            border: 1px solid #2B2A2A;
                            color: white;
                        }
                    </style>
                    <div class="row text-center">
                        <div class="col-md-12">
                            <h4><b>IV. EQUIPMENT REQUIREMENTS</b></h4>
                        </div>
                    </div><br><br><br>
                    <div class="row">
                        <div class="col-md-12">
                            <h5><b>EQUIPMENT:</b></h5>
                        </div>
                    </div><br>
                    <table class="table table-striped tbl-ter">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">DESCRIPTION</th>
                                <th class="text-center">QUANTITY</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($tools_and_equipments as $te)
                            @if ($te->equipment->type == 'Equipment')
                            <tr>
                                <td>{{ $te->equipment->name ?? '' }}</td>
                                <td class="text-center">{{ $te->quantity ?? '' }}</td>
                            </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                    <br><br>
                    <div class="row">
                        <div class="col-md-12">
                            <h5><b>TOOLS:</b></h5>
                        </div>
                    </div><br>
                    <table class="table table-striped tbl-ter">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">DESCRIPTION</th>
                                <th class="text-center">QUANTITY</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($tools_and_equipments as $te)
                            @if ($te->equipment->type == 'Tool')
                            <tr>
                                <td>{{ $te->equipment->name ?? '' }}</td>
                                <td class="text-center">{{ $te->quantity ?? '' }}</td>
                            </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                    <div class="print-footer">
                        <div class="footer-line-black"></div>
                        <div class="footer-line-yellow"></div>
                        <img src="{{ asset($project->agency_logo_url) }}" class="footer-logo">
                    </div>
                </div>
                @foreach ($attachments as $attachment)
                    @if ($attachment->name == "Tools and Equipments Requirement")
                        @php ($ctr = 1)
                        @foreach ($attachment->defaultUploads as $upload)
                            <div class="print-page">
                                <div class="text-center">
                                    <img class="attachments" src="{{ asset($upload->image_url) }}" style="{{ ($ctr == count($attachment->defaultUploads)) ? 'width: 90%; !important' : '' }}">
                                </div>
                                @if (($ctr != count($attachment->defaultUploads)))
                                    <div class="print-footer">
                                        <div class="footer-line-black"></div>
                                        <div class="footer-line-yellow"></div>
                                        <img src="{{ asset($project->agency_logo_url) }}" class="footer-logo">
                                    </div>
                                @else
                                    <table class="mt-2">
                                        <tr>
                                            <td style="width:25%; border: none; padding: 0">Name:</td>
                                            <td style="border: none; padding: 0"><b>{{ strtoupper($signatories->where('position', 'Chief Operating Executive')->first()->name) ?? '' }}</b></td>
                                        </tr>
                                        <tr>
                                            <td style="width:25%; border: none; padding: 0">Legal Capacity:</td>
                                            <td style="border: none; padding: 0"><b>CHIEF EXECUTIVE OFFICER (CEO)</b></td>
                                        </tr>
                                        <tr>
                                            <td style="width:25%; border: none; padding: 0">Signature:</td>
                                            <td style="border: none; padding: 0"></td>
                                        </tr>
                                        <tr>
                                            <td style="width:25%; border: none; padding: 0">Duly authorized to sign the Bid for and behalf of:</td>
                                            <td style="border: none; padding: 0"><b>EBN ENTERPRISES</b></td>
                                        </tr>
                                        <tr>
                                            <td style="width:25%; border: none; padding: 0">Date:</td>
                                            <td style="border: none; padding: 0"></td>
                                        </tr>
                                    </table>
                                    <div class="print-footer">
                                        <div class="footer-line-black"></div>
                                        <div class="footer-line-yellow"></div>
                                        <img src="{{ asset($project->agency_logo_url) }}" class="footer-logo">
                                    </div>
                                @endif
                            </div>
                            @php ($ctr += 1)
                        @endforeach
                    @endif
                @endforeach
            @elseif($page->page_name == "Notice to Bidders")
                @foreach ($project_attachments as $attachment)
                    @if ($attachment->attachment_type == 3)
                        <div class="print-page">
                            <img class="attachments" src="{{ asset($attachment->image_url) }}">
                            <div class="print-footer">
                                <div class="footer-line-black"></div>
                                <div class="footer-line-yellow"></div>
                                <img src="{{ asset($project->agency_logo_url) }}" class="footer-logo">
                            </div>
                        </div>
                    @endif
                @endforeach
            @elseif($page->page_name == "Detailed Estimate")
                <div class="print-page">
                    <div class="row d-print-flex">
                        <div class="col-1">
                            <br><br><br><br><br>
                            <img src="{{ asset('images/ebn.png') }}" style="margin-left: 30%; height: 100px">
                        </div>
                        <div class="col-10">
                            <div class="text-center">
                                <p style="font-size: 8pt">
                                    <h2 style="color: red"><b>{{ strtoupper($business->name) }}</b></h2>
                                    {{ $business->address }}<br>
                                    Location: {{ $business->location }}<br>
                                    Authorized Distributor: {{ strtoupper($signatories->where('position', 'Chief Operating Executive')->first()->name) ?? '' }}<br>
                                    Contact No. {{ $business->number }}<br>
                                    DTI Permit No. {{ $business->dti }}<br>
                                    BIR COR No. {{ $business->bir }}<br>
                                    Mayor's Permit No. {{ $business->mo_permit }}<br>
                                    Philippine Standard Quality Certified ISO Registered<br>
                                    Platinum Philgeps Registered
                                </p>
                            </div>
                        </div>
                        <div class="col-1"></div>
                        </div><br><br>
                        Project: <b>{{ strtoupper($project->project_name) ?? '' }}</b><br>
                        Location: <b>{{ strtoupper($project->address) ?? '' }}</b>
                        <br><br>
                        <div class="text-center">
                            <h5><b>DETAILED ESTIMATE</b></h5>
                        </div><br>
                        BILL OF MATERIALS
                        <br>
                        <table class="table table-sm table-bordered w-100" id="powTable">
                            <thead>
                                <tr>
                                    <th class="text-center">Item No.</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">Unit</th>
                                    <th class="text-center">Unit Cost</th>
                                    <th class="text-center">Total Cost</th>
                                    <th class="text-center">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php ($ctr = 1)
                            @php ($total = 0.0)
                            @foreach ($bill_of_materials as $bm)
                                <tr>
                                    <td class="text-center">{{ $ctr++ }}</td>
                                    <td>{{ $bm->description }}</td>
                                    <td class="text-center">{{ $bm->quantity }}</td>
                                    <td class="text-center">{{ $bm->unit }}</td>
                                    <td class="text-right">{{ number_format($bm->unit_cost, 2) }}</td>
                                    <td class="text-right">{{ number_format($bm->total_cost, 2) }}</td>
                                    <td class="text-right">{{ number_format($bm->total_cost, 2) }}</td>
                                    @php ($total += $bm->total_cost)
                                </tr>
                            @endforeach
                            </tbody>
                            <tfooter>
                                <tr>
                                    <td colspan = "6" class="text-right">Total Project Cost</td>
                                    <td class="text-right">{{ number_format($total, 2) }}</td>
                                </tr>
                            </tfooter>
                        </table>
                        <br><br>
                        Approved By:<br><br><br>
                        <b>{{ strtoupper($signatories->where('position', 'Chief Operating Executive')->first()->name) ?? '' }}</b><br>
                        <p style="text-size: 8pt">
                        EBN Enterprises CEO/OWNER<br>
                        FIRE SAFETY EQUIPMENT SUPPLIER AND INSTALLER<br>
                        {{ strtoupper($business->address) }}<br>
                        <b>CONTACT NO.: {{ strtoupper($business->number) }}</b><br>
                        <b>EMAIL ADDRESS: elnuez2003@gmail.com</b><br>
                        </p>
                        <div class="print-footer">
                            <div class="footer-line-black"></div>
                            <div class="footer-line-yellow"></div>
                            <img src="{{ asset($project->agency_logo_url) }}" class="footer-logo">
                        </div>
                    </div>
                </div>
            @elseif($page->page_name == "Bid Forms for the Procurement of Goods")
                <div class="print-page">
                    <div class="row text-center">
                        <div class="col-md-12">
                            <h4><b>{{ strtoupper($page->page_name) }}</b></h4>
                        </div>
                    </div>
                    <hr>
                    <div class="text-center"><h4><b>BID FORM</b></h4></div>
                    <div class="row">
                        <div class="col-6"></div>
                        <div class="col-6">
                            Date: <b>{{ date('F d, Y') }}</b><br>
                            Project Identification No: <b>{{ $project->project_identification_no ?? '' }}</b>
                        </div>
                    </div><br>
                    <div>
                        <p><b><em>
                            To: {{ $project->project_name }} @ {{ $project->address }}
                        </em></b></p>
                    </div>
                    <div>
                        <p style="text-align: justify;">
                            Having examined the Philippine Bidding Documents (PBDs) including the
                            Supplemental or Bid Bulletin Numbers, the receipt of which is hereby duly acknowledged, we,
                            the undersigned, offer to supply and deliver the following with the details below
                        </p>
                    </div>
                        <table class="table table-sm table-bordered w-100" id="powTable" style="font-size: 8pt !important">
                            <thead>
                                <tr>
                                    <th class="text-center">Item No.</th>
                                    <th class="text-center">Description of Articles</th>
                                    <th class="text-center">Brand Offered / <br>Country of Origin</th>
                                    <th class="text-center">Qty / Units</th>
                                    <th class="text-center">Unit Price</th>
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php ($ctr = 1)
                            @php ($total = 0.0)
                            @foreach ($bill_of_materials as $bm)
                                <tr>
                                    <td class="text-center">{{ $ctr++ }}</td>
                                    <td>{{ $bm->description }}</td>
                                    <td class="text-center">Philippines</td>
                                    <td class="text-center">{{ $bm->quantity }} / {{ $bm->unit }}</td>
                                    <td class="text-right">{{ number_format($bm->unit_cost, 2) }}</td>
                                    <td class="text-right">{{ number_format(($bm->unit_cost * $bm->quantity), 2) }}</td>
                                    @php ($total += ($bm->unit_cost * $bm->quantity))
                                </tr>
                            @endforeach
                            </tbody>
                            <tfooter>
                                <tr>
                                    <td colspan = "5" class="text-right">Grand Total Cost</td>
                                    <td class="text-right">{{ number_format($total, 2) }}</td>
                                </tr>
                            </tfooter>
                        </table>
                        <div class="print-footer">
                            <div class="footer-line-black"></div>
                            <div class="footer-line-yellow"></div>
                            <img src="{{ asset($project->agency_logo_url) }}" class="footer-logo">
                        </div>
                    </div>
                    <div class="print-page">
                        <p style="text-align: justify;">
                            @php ($formatter = new \NumberFormatter('en', \NumberFormatter::SPELLOUT))
                            In conformity with the said PBDs for the sum of <b>{{ ucwords($formatter->format($total ?? 0)) }}</b> or the
                            total calculated bid price, as evaluated and corrected for computational errors, and other bid
                            modifications in accordance with the Price Schedules attached herewith and made part of this
                            Bid. The total bid price includes the cost of all taxes, such as, but not limited to: (i) value added
                            tax (VAT), (ii) income tax, (iii) local taxes, and (iv) other fiscal levies and duties, which are
                            itemized herein or in the Price Schedules,
                        </p>
                        <p style="text-align: justify;">
                            If our Bid is accepted, we undertake:
                            <ol type="a">
                                <li>to deliver the goods in accordance with the delivery schedule specified in the Schedule of Requirements of the Philippine Bidding Documents (PBDs);</li>
                                <li>to provide a performance security in the form, amounts, and within the times prescribed in the PBDs;</li>
                                <li>to abide by the Bid Validity Period specified in the PBDs and it shall remain binding upon us at any time before the expiration of that period.</li>
                            </ol>
                        </p>
                        <p style="text-align: justify;">
                            Until a formal Contract is prepared and executed, this Bid, together with your written acceptance thereof and your Notice of Award, shall be binding upon us.<br><br>
                            We understand that you are not bound to accept the Lowest Calculated Bid or any Bid you may receive.<br><br>
                            We certify/confirm that we comply with the eligibility requirements pursuant to the PBDs.<br><br>
                            The undersigned is authorized to submit the bid on behalf of EBN ENTERPRISES as evidenced by the attached.<br><br>
                            We acknowledge that failure to sign each and every page of this Bid Form, including the attached Schedule of Prices, shall be a ground for the rejection of our bid.<br>
                        </p>
                        <br><br><br>

                        Name: <b>{{ strtoupper($signatories->where('position', 'Chief Operating Executive')->first()->name) ?? '' }}</b><br>
                        Legal Capacity: <b>PROPRIETOR</b><br>
                        Signature: __________________________<br>
                        Duly authorized to sign the Bid for and behalf of: <b>{{ $business->name ?? '' }}</b><br>
                        Date: <b>{{ date('F d, Y') }}</b>
                        <div class="print-footer">
                            <div class="footer-line-black"></div>
                            <div class="footer-line-yellow"></div>
                            <img src="{{ asset($project->agency_logo_url) }}" class="footer-logo">
                        </div>
                    </div>
                </div>
            @elseif($page->page_name == "Cash Flow")
                <div class="print-page">
                    <div class="row text-center">
                        <div class="col-md-12">
                            <h4><b>PROJECT CASH FLOW</b></h4>
                        </div>
                        <div class="col-md-12">
                            <h4><b>SUPPLY AND DELIVERY OF SOLAR LIGHT PROJECT OF</b></h4>
                        </div>
                        <div class="col-md-12">
                            <h4><b>{{ strtoupper($project->project_name) }}</b></h4>
                        </div>
                        <div class="col-md-12">
                            <br><br><br>
                            <h6><b>{{ strtoupper($project->agency_name) }}</b></h6>
                            <h6><b>Project: {{ strtoupper($project->project_name) }}</b></h6><br>
                            <canvas id="deliveryChart" height="120"></canvas><br><br>
                            <h6><b>PROJECT CASH FLOW (BY WEEK)</b></h6>
                        </div>
                    </div><br><br>
                    <table>
                        <tr>
                            <td style="width:25%; border: none; padding: 0">Name:</td>
                            <td style="border: none; padding: 0"><b>{{ strtoupper($signatories->where('position', 'Chief Operating Executive')->first()->name) ?? '' }}</b></td>
                        </tr>
                        <tr>
                            <td style="width:25%; border: none; padding: 0">Legal Capacity:</td>
                            <td style="border: none; padding: 0"><b>CHIEF EXECUTIVE OFFICER (CEO)</b></td>
                        </tr>
                        <tr>
                            <td style="width:25%; border: none; padding: 0">Signature:</td>
                            <td style="border: none; padding: 0"></td>
                        </tr>
                        <tr>
                            <td style="width:25%; border: none; padding: 0">Duly authorized to sign the Bid for and behalf of:</td>
                            <td style="border: none; padding: 0"><b>EBN ENTERPRISES</b></td>
                        </tr>
                        <tr>
                            <td style="width:25%; border: none; padding: 0">Date:</td>
                            <td style="border: none; padding: 0"></td>
                        </tr>
                    </table>
                    <div class="print-footer">
                        <div class="footer-line-black"></div>
                        <div class="footer-line-yellow"></div>
                        <img src="{{ asset($project->agency_logo_url) }}" class="footer-logo">
                    </div>
                </div>
            @elseif($page->page_name == "Warranty and Price Validity")
                <div class="print-page">
                    <div class="row d-print-flex">
                        <div class="col-1">
                            <br><br><br><br><br>
                            <img src="{{ asset('images/ebn.png') }}" style="margin-left: 30%; height: 100px">
                        </div>
                        <div class="col-10">
                            <div class="text-center">
                                <p style="font-size: 8pt">
                                    <h2 style="color: red"><b>{{ strtoupper($business->name) }}</b></h2>
                                    {{ $business->address }}<br>
                                    Location: {{ $business->location }}<br>
                                    Authorized Distributor: {{ strtoupper($signatories->where('position', 'Chief Operating Executive')->first()->name) ?? '' }}<br>
                                    Contact No. {{ $business->number }}<br>
                                    DTI Permit No. {{ $business->dti }}<br>
                                    BIR COR No. {{ $business->bir }}<br>
                                    Mayor's Permit No. {{ $business->mo_permit }}<br>
                                    Philippine Standard Quality Certified ISO Registered<br>
                                    Platinum Philgeps Registered
                                </p>
                            </div>
                        </div>
                        <div class="col-1"></div>
                    </div><br>
                    <div class="row text-center">
                        <div class="col-md-12">
                            <h6><b>WARRANTY AND PRICE VALIDITY DECLARATION</b></h6>
                        </div>
                    </div>
                    @php ($formatter = new \NumberFormatter('en', \NumberFormatter::SPELLOUT))
                    <p style="text-align: justify;">To Whom It May Concern:<br><br>
                    In connection with our submitted bid for the <b>{{ $project->project_name ?? '' }}, {{ $project->agency_name ?? '' }}, {{ $project->address ?? '' }}</b>,
                    we hereby declare and certify the following:<br><br>
                    1. <b>Price Validity</b><br><br>
                    We hereby confirm that the prices indicated in our submitted quotation/bid proposal shall
                    remain valid and binding for a period of <b>{{ ucwords($formatter->format($project->fc_warranty_calendar_days ?? 0)) }} ({{ $project->fc_warranty_calendar_days ?? '' }})</b> calendar days from the date of bid
                    opening or submission, unless otherwise specified in the bidding documents. During this period,
                    the quoted prices shall not be subject to any adjustment or escalation.<br><br>
                    2. <b>Product Condition and Compliance</b><br><br>
                    We further certify that all <b>{{ $project->fc_product_to_be_supplied ?? '' }}</b> to be supplied are brand new, unused, and
                    manufactured in accordance with applicable safety and quality standards. The units comply
                    with the required specifications and are suitable for their intended purpose in fire protection and safety.<br><br>
                    3. <b>Warranty</b><br><br>
                    We hereby guarantee that all supplied <b>{{ $project->fc_product_to_be_supplied ?? '' }}</b> are covered by a minimum warranty
                    period of <b>{{ ucwords($formatter->format($project->fc_warranty ?? 0)) }} ({{ $project->fc_warranty ?? '' }})</b> Months from the date of delivery and acceptance by the procuring entity.
                    The warranty shall cover any defects in materials or workmanship under normal use and service.<br><br>

                    Should any defect arise within the warranty period that is not due to misuse, negligence, or
                    unauthorized modification, we undertake to repair or replace the defective unit at no additional
                    cost to the procuring entity within a reasonable period.<br><br>

                    This declaration is issued to support our bid submission and to affirm our commitment to provide
                    quality products and reliable service.<br><br>
                    Respectfully submitted,<br><br><br>
                    <b>EBN ENTERPRISES</b>
                    </p>
                    <div class="print-footer">
                        <div class="footer-line-black"></div>
                        <div class="footer-line-yellow"></div>
                        <img src="{{ asset($project->agency_logo_url) }}" class="footer-logo">
                    </div>
                </div>
            @elseif($page->page_name == "Brochure")
                @foreach ($attachments as $attachment)
                    @if ($attachment->name == "Brochure")
                        @foreach ($attachment->defaultUploads as $upload)
                            <div class="print-page">
                            <img class="attachments" src="{{ asset($upload->image_url) }}">
                                <div class="print-footer">
                                    <div class="footer-line-black"></div>
                                    <div class="footer-line-yellow"></div>
                                    <img src="{{ asset($project->agency_logo_url) }}" class="footer-logo">
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endforeach
            @else
                @if ($component == 'Technical Components')
                    <?php
                        $defaults = [
                            'DTI Permit',
                            'PhilGEPS Certificate',
                            "Mayor's Permit",
                            'BIR Certificate of Registration',
                            'Audited Financial Statement',
                            'Net Financial Contracting Capacity (NFCC)',
                            'Tax Clearance Certificate',
                            'Organizational Chart',
                            'Tools and Equipments Requirement',
                            'Brochure'
                        ];
                    ?>
                    @foreach ($attachments as $attachment)
                        @if (!in_array($attachment->name, $defaults))
                            @foreach ($attachment->defaultUploads as $upload)
                                <div class="print-page">
                                <img class="attachments" src="{{ asset($upload->image_url) }}">
                                    <div class="print-footer">
                                        <div class="footer-line-black"></div>
                                        <div class="footer-line-yellow"></div>
                                        <img src="{{ asset($project->agency_logo_url) }}" class="footer-logo">
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endforeach
                @endif
            @endif


            <!-- <div class="print-footer">
                <div class="footer-line-black"></div>
                <div class="footer-line-yellow"></div>

                <img src="{{ asset($project->agency_logo_url) }}" class="footer-logo">
            </div> -->

    <!-- </div> -->
@endforeach
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const schedules = [
        @foreach($delivery as $d)
            "{{ $d->schedule }}",
        @endforeach
    ];

    const amounts = [
        @foreach($delivery as $d)
            {{ $d->amount }},
        @endforeach
    ];

    const ctx = document.getElementById('deliveryChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: schedules,
            datasets: [{
                label: "",
                data: amounts,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    window.onload = function () {
        window.print();
    }

    window.onafterprint = function () {
        window.close();
    };
</script>

</body>
</html>
