<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $fsmr->establishment_name ?? '' }}</title>
    <link href="{{ asset('architectui/architectui/main.css') }}" rel="stylesheet">
    <style>
        @font-face {
            font-family: 'Banerton';
            font-style: italic;
            font-weight: 100;
            font-display: swap;
            src: url("asset('fonts/banerton-demo.ttf')") format('woff2');
        }

        @media print {
            @page {
                size: Letter;
                margin: 0;
            }

            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                margin: 0;
            }

            .print-page {
                width: 8.5in;
                height: 11in;
                page-break-after: always; 
            }

            .content {
                width: 100%;
                height: auto;
                box-sizing: border-box;
                padding: 5%;
                overflow: visible;
            }

            
            .content > * {
                page-break-inside: avoid;
                break-inside: avoid;
            }
            
        }

        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
        }

        .cover-page {
            width: 8.5in;
            height: 11in;
            background-size: cover;  
            background-position: center;
            background-repeat: no-repeat;
            font-family: 'Banerton';
        }

        .print-page {
            position: relative;
            width: 8.5in;
            height: 11in;
            background: url("{{ asset('images/print-bg.jpg') }}") no-repeat center center;
            background-size: cover;   
            /* background-position: center; 
            background-repeat: no-repeat; */
            font-family: 'Banerton';
            page-break-after: always;
            /* z-index: 1; */
        }

        .top-background {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 10%;
            background: url('{{ asset('files/attachments').'/'.($fsmr->attachments()->where('attachment_type_id', 4)->first()->url ?? '') }}') no-repeat center center;
            background-size: 70% 70%;
            box-shadow: 25px 25px 50px 0 white inset, -25px -25px 50px 0 white inset;
            -webkit-mask-image: radial-gradient(
                circle,
                rgba(0, 0, 0, 1) 40%, /* Inner circle (sharp cut-off) */
                rgba(0, 0, 0, 0) 50%  /* Outer area (transparent) */
            );
            mask-image: radial-gradient(
                circle,
                rgba(0, 0, 0, 1) 40%, /* Inner circle (sharp cut-off) */
                rgba(0, 0, 0, 0) 50%  /* Outer area (transparent) */
            );
            opacity: 0.2;
            z-index: 1;
        }
        
        .content {
            width: 100%;
            height: 100%;
            box-sizing: border-box;
            padding: 5%;
            overflow: visible;
            position: relative;
            z-index: 2;
        }

        .circle-number {
            width: 150px;               
            height: 150px;
            background-color: #FFC107; 
            color: white;              
            font-size: 90pt;           
            font-weight: bold;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;           
        }

        .img-display{
            max-width: 100%; 
            max-height: 80%; 
            object-fit: contain
        }

        .img-desc-container{
            height: 50%; 
            display: flex; 
            flex-direction: column; 
            align-items: center; 
            justify-content: center
        }

        .img-desc-container-100{
            height: 100%; 
            display: flex; 
            flex-direction: column; 
            align-items: center; 
            justify-content: center
        }

        .cover-background-div {
            position: relative;
            overflow: hidden; /* Ensures no content spills out */
            border-bottom: 3px solid #000
        }

        .cover-background-div::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset('files/attachments').'/'.($fsmr->attachments()->where('attachment_type_id', 4)->first()->url ?? '') }}');
            background-size: cover; /* Adjusts image to cover the div */
            background-position: center; /* Centers the image */
            opacity: 0.5; /* Sets the opacity of the background image */
            z-index: 0; /* Places it below the text */
        }

        .cover-header-text{
            color: #000 !important; 
            padding-left: 5%; 
            padding-top: 15%; 
            font-size: 50pt; 
            line-height: 1; 
            position: relative; 
            z-index: 1;
            color: #000; /* Text color */
            text-shadow: 
                -2px -2px 0 #fff, /* Top-left */
                2px -2px 0 #fff,  /* Top-right */
                -2px 2px 0 #fff,  /* Bottom-left */
                2px 2px 0 #fff;   /* Bottom-right */
        }

        .page-footer{
            position: absolute;
            bottom: 10px;
            right: 10px;
            font-size: 12px;
            color: #ff0000;
            z-index: 1000;
        }

    </style>
</head>
<body>

    <div class="cover-page">
        <div class="cover-background-div" style="height: 40%; position: relative;">
            <div class="cover-header-text" style="">
                <img src="{{ asset('images/ebn.png') }}" style="height: 150px;"><br>
                <b>Fire Safety Maintenance Report (FSMR)</b>
            </div>
        </div>
        <div style="height: 10%">
            <br><br><br>
            <div style="padding-left: 3%; font-size: 30pt; line-height: 1;"><b>{{ date('F d, Y') }}</b></div>
        </div>
        <div class="text-center" style="height: 40%;">
            <br><br><br><br><br>
            <div style="font-size: 45pt; line-height: 1;">
                <b>{{ ($fsmr) ? $fsmr->establishment_name : '' }}</b>
            </div>
            <div style="font-size: 34pt; line-height: 1;">
                {{ ($fsmr) ? $fsmr->establishment_address : '' }}
            </div>
        </div>
        <div style="height: 10%;">
            <div style="padding-left: 3%; font-size: 24pt; line-height: 1;">
                <b>{{ $business->name }}</b><br>
                {{ $business->address }}
            </div>      
        </div>
    </div>
    <div class="print-page">
        <div class="top-background"></div>
        <div class="content">
            <br><br><br><br><br>
            <div class="row">
                <div class="col-sm-12">
                    <div style="font-size: 36pt"><b>Index</b></div>
                </div>
            </div>
            @php ($ctr = 1)
            @foreach ($contents as $content)
            <div class="row">
                <div class="col-sm-12">
                    <div style="font-size: 26pt">{{ $ctr++.'.'.' '.$content->description }}</div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="page-footer">
            <h3><em>{{ $fsmr->establishment_name }}</em></h3>
        </div>
    </div>
    @php ($ctr = 1)
    @php ($figure = 1)
    @foreach ($contents as $content)
        <div class="print-page">
            <div class="top-background"></div>
            <div class="content">
                <br><br><br><br><br>
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4 text-center">
                        <div class="circle-number"><b>{{ $ctr++ }}</b></div>
                    </div>
                    <div class="col-sm-4"></div>
                </div><br>
                <div class="row text-center">
                    <div class="col-sm-12">
                        <h1 style="font-size: 70pt"><b>{{ $content->description }}</b></h1>
                    </div>
                </div>
            </div>
            <div class="page-footer">
                <h3><em>{{ $fsmr->establishment_name }}</em></h3>
            </div>
        </div>
        @if ($content->id == 1)
            <div class="print-page">
                <div class="top-background"></div>
                <div class="content">
                    <div class="img-desc-container">
                        @if (!blank($fsmr->attachments()->where('attachment_type_id', 4)->first()))
                        <img  style="width: 80%" src="{{ asset('files/attachments').'/'.($fsmr->attachments()->where('attachment_type_id', 4)->first()->url ?? '') }}">
                        @endif
                    </div>
                    <div class="img-desc-container">

                        <table>
                            <tr>
                                <td colspan="2" class="text-center">
                                    <h2>Facility Description</h2>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 50%">
                                    <h2>Name of Building:</h2>
                                </td>
                                <td style="width: 50%">
                                <h2><b>{{ $fsmr->establishment_name }}</b></h2>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 50%">
                                    <h2>Address:</h2>
                                </td>
                                <td style="width: 50%">
                                <h2><b>{{ $fsmr->establishment_address }}</b></h2>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 50%">
                                    <h2>Occupancy:</h2>
                                </td>
                                <td style="width: 50%">
                                <h2><b>{{ $fsmr->occupancy }}</b></h2>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 50%">
                                    <h2>Number of Floors:</h2>
                                </td>
                                <td style="width: 50%">
                                <h2><b>{{ $fsmr->no_of_floors }}</b></h2>
                                </td>
                            </tr>
                        </table>

                    </div>
                </div>
                <div class="page-footer">
                    <h3><em>{{ $fsmr->establishment_name }}</em></h3>
                </div>
            </div>
        @elseif ($content->id == 2)

        @elseif ($content->id == 3)
            <div class="print-page">
                <div class="top-background"></div>
                <div class="content">
                    <p style="font-size: 16pt; margin-top: 50px; text-align: justify;">
                    {!! $settings->where('code', 'fdas_reminder')->first()->description ?? '' !!}
                    </p>
                </div>
                <div class="page-footer">
                    <h3><em>{{ $fsmr->establishment_name }}</em></h3>
                </div>
            </div>
        @elseif ($content->id == 4)
            <div class="print-page">
                <div class="top-background"></div>
                <div class="content">
                    <p style="font-size: 20pt; margin-top: 50px; text-align: justify;">
                    {!! $settings->where('code', 'fss_maintenance_reminder')->first()->description ?? '' !!}
                    </p>
                </div>
                <div class="page-footer">
                    <h3><em>{{ $fsmr->establishment_name }}</em></h3>
                </div>
            </div>
        @elseif ($content->id == 5)
            <!-- FPS -->
            <div class="print-page">
                <div class="content">
                    <table style="width: 100%; border-collapse: collapse; font-size: 11.5pt">
                        <tr>
                           <td colspan="2" style="width: 50%; border-top: 1px solid black; border-left: 1px solid black"></td> 
                           <td colspan="2" style="width: 50%; border-top: 1px solid black; border-right: 1px solid black; text-align: center">
                                OSPF-17<br>
                                <b>COMPLIANCE & COMMISSIONING FORM</b><br><br>
                                Eff. Date: 5/7/24 Rev. 0
                           </td>
                        </tr>
                        <tr>
                            <td colspan="4" style="height: 14pt; border: 1px solid black"></td>
                        </tr>
                        <tr>
                            <td colspan="4" style="padding: 1%; border: 1px solid black;">
                                Project: {{ $fsmr->establishment_name }}<br>
                                Location: {{ $fsmr->establishment_address }}<br>
                                Reference No.: {{ $fsmr->reference_no }}<br>
                                Date: {{ $fsmr->date_processed }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" style="height: 14pt; border: 1px solid black"></td>
                        </tr>
                        <tr>
                           <td colspan="2" style="padding: 1%; width: 50%; border-top: 1px solid black; border-left: 1px solid black">
                                SERVICE ORGANIZATION:<br>
                                NAME: <u><b>{{ $business->name }}</b></u><br>
                                ADDRESS: <u><b>{{ $business->address }}</b></u><br>
                                SERVICE PROVIDED: <u><b>Fire Safety</b></u>
                           </td> 
                           <td colspan="2" style="padding: 1%; width: 50%; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black">
                                PROPERTY NAME:<br>
                                NAME: <u><b>{{ $fsmr->establishment_name }}</b></u><br>
                                ADDRESS: <u><b>{{ $fsmr->establishment_address }}</b></u><br>
                                SERVICE PROVIDED: <u><b>{{ $fsmr->building_use }}</b></u>
                           </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding: 1%; width: 50%; border-top: 1px solid black; border-left: 1px solid black;">
                                CONTROL UNIT MANUFACTURER: <u><b>{{ $fsmr->fps_manufacturer }}</b></u><br>
                                CIRCUIT STYLES: <u><b>{{ $fsmr->fps_circuit }}</b></u>
                            </td>
                            <td colspan="2" style="padding: 1%; width: 50%; border-top: 1px solid black; border-right: 1px solid black; vertical-align: top; text-align: left;">
                                MODEL: <u><b>{{ $fsmr->fps_model }}</b></u>
                            </td>
                        </tr>
                        @if (!blank($fdas))
                            @foreach ($fdas as $fd)
                                @php ($col_1_header = ($fd->category == 'Alarm Initiating Devices and Circuit Information') ? 'Quantity of Devices' : 'Quantity of Appliances')
                                @php ($col_3_header = ($fd->category == 'Alarm Notifications Appliances and Circuit Information') ? 'Device Compliance' : 'Appliances Compliance')

                                <tr>
                                    <td colspan="4" style="border: 1px solid black; text-align: center">{{ $fd->category ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid black; text-align: center">{{ $col_1_header }}</td>
                                    <td style="border: 1px solid black; text-align: center">Circuit Style</td>
                                    <td style="border: 1px solid black; text-align: center">{{ $col_3_header }}</td>
                                    <td style="border: 1px solid black; text-align: center"></td>
                                </tr>
                                @foreach ($fd->devices as $device)
                                <tr>
                                    <td style="border: 1px solid black; text-align: center">
                                        {{ $fsmr->fps()->where('item_id', $device->id)->first()->item_count ?? 'N/A' }}
                                    </td>
                                    <td style="border: 1px solid black; text-align: center">
                                        {{ $fsmr->fps()->where('item_id', $device->id)->first()->cicuit ?? 'N/A' }}
                                    </td>
                                    <td style="border: 1px solid black; text-align: center">
                                        {{ $fsmr->fps()->where('item_id', $device->id)->first()->item_tested_count ?? 'N/A' }}
                                    </td>
                                    <td style="border: 1px solid black; padding-left: 1%">{{ $device->name }}</td>
                                </tr>
                                @endforeach
                            @endforeach
                        @endif
                        <tr>
                            <td colspan="2" style="padding: 1%; width: 50%;">
                                Conducted By:<br><br>
                                <div class="text-center">
                                    <u><b>{{ strtoupper($signatories->where('id', $fsmr->technician)->first()->name ?? '') }}</b></u><br>
                                    {{ $signatories->where('id', $fsmr->technician)->first()->position ?? '' }}
                                </div>
                            </td>
                            <td colspan="2" style="padding: 1%; width: 50%;">
                                Noted By:<br><br>
                                <div class="text-center">
                                    <u><b>{{ strtoupper($signatories->where('id', $fsmr->contractor)->first()->name ?? '') }}</b></u><br>
                                    {{ $signatories->where('id', $fsmr->contractor)->first()->position ?? '' }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding: 1%; width: 50%;">
                                Inspected By:<br><br>
                                <div class="text-center">
                                    <u><b>{{ strtoupper($signatories->where('id', $fsmr->inspector)->first()->name ?? '') }}</b></u><br>
                                    {{ $signatories->where('id', $fsmr->inspector)->first()->position ?? '' }}
                                </div>
                            </td>
                            <td colspan="2" style="padding: 1%; width: 50%;">
                                Conforme By:<br>
                                <div class="text-center">
                                    <u><b>{{ strtoupper($fsmr->establishment_name) }}</b></u>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="page-footer">
                    <h3><em>{{ $fsmr->establishment_name }}</em></h3>
                </div>
            </div>
            <!-- FPS End -->

            <!-- FSS -->
            <div class="print-page">
                <div class="content">
                    <table style="width: 100%; border-collapse: collapse; font-size: 11pt">
                        <tr>
                           <td style="width: 50%; border-top: 1px solid black; border-left: 1px solid black"></td> 
                           <td style="width: 50%; border-top: 1px solid black; border-right: 1px solid black; text-align: center">
                                OSPF-17<br>
                                <b>FIRE RATED DOOR COMPLIANCE & COMMISSIONING</b><br>
                                Eff. Date: 5/7/24 Rev. 0
                           </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding: 1%; border: 1px solid black;">
                                Project: {{ $fsmr->establishment_name }}<br>
                                Location: {{ $fsmr->establishment_address }}<br>
                                Reference No.: {{ $fsmr->reference_no }}<br>
                                Date: {{ $fsmr->date_processed }}
                            </td>
                        </tr>
                        <tr>
                           <td style="padding: 1%; width: 50%; border-top: 1px solid black; border-left: 1px solid black">
                                SERVICE ORGANIZATION:<br>
                                NAME: <u><b>{{ $business->name }}</b></u><br>
                                ADDRESS: <u><b>{{ $business->address }}</b></u><br>
                                SERVICE PROVIDED: <u><b>Fire Safety</b></u>
                           </td> 
                           <td style="padding: 1%; width: 50%; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black">
                                PROPERTY NAME:<br>
                                NAME: <u><b>{{ $fsmr->establishment_name }}</b></u><br>
                                ADDRESS: <u><b>{{ $fsmr->establishment_address }}</b></u><br>
                                SERVICE PROVIDED: <u><b>{{ $fsmr->building_use }}</b></u>
                           </td>
                        </tr>
                        <tr>
                            <td style="padding: 1%; width: 50%; border-top: 1px solid black; border-left: 1px solid black;">
                                MANUFACTURER: <u><b>{{ $fsmr->eer_manufacturer }}</b></u><br>
                                HARDWARE: <u><b>{{ $fsmr->eer_hardware }}</b></u>
                            </td>
                            <td style="padding: 1%; width: 50%; border-top: 1px solid black; border-right: 1px solid black; vertical-align: top; text-align: left;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="border: 1px solid black; border-left: 1px solid black; text-align: center">
                                FIRE EXTINGUISHER COMPLIANCE REPORT
                            </td>
                        </tr>
                    </table>
                    <table style="width: 100%; border-collapse: collapse">
                        @if (!blank($fss))
                        <tr>
                            <td style="border: 1px solid black; text-align: center; width: 52%">Description</td>
                            <td style="border: 1px solid black; text-align: center; width: 6%">Yes</td>
                            <td style="border: 1px solid black; text-align: center; width: 6%">No</td>
                            <td style="border: 1px solid black; text-align: center; width: 6%">N/A</td>
                            <td style="border: 1px solid black; text-align: center; width: 30%">Remarks</td>
                        </tr>
                            @foreach ($fss as $fs)
                                
                                <tr style="height: 8pt">
                                    <td style="padding-left: 1%; border: 1px solid black; font-size: 8pt">
                                        {{ $fs->description ?? '' }}
                                    </td>
                                    <td style="padding-left: 1%; border: 1px solid black; text-align: center">
                                        @php ($yes = $fsmr->fss()->where('checklist_id', $fs->id)->first()->status ?? '')
                                        {{ ($yes == 1) ? "✓" : '' }}
                                    </td>
                                    <td style="padding-left: 1%; border: 1px solid black; text-align: center">
                                        @php ($no = $fsmr->fss()->where('checklist_id', $fs->id)->first()->status ?? '')
                                        {{ ($no == 2) ? "✓" : '' }}
                                    </td>
                                    <td style="padding-left: 1%; border: 1px solid black; text-align: center">
                                        @php ($na = $fsmr->fss()->where('checklist_id', $fs->id)->first()->status ?? '')
                                        {{ ($na == 3) ? "✓" : '' }}
                                    </td>
                                    <td style="padding-left: 1%; border: 1px solid black;">
                                        {{ $fsmr->fss()->where('checklist_id', $fs->id)->first()->remarks ?? '' }}
                                    </td>
                                </tr>

                            @endforeach
                        @endif
                        <tr>
                            <td colspan="5" style="padding-left: 1%; border: 1px solid black;">
                                Remarks and Proposal:<br>
                                <u>{{ $fsmr->fss_remarks }}</u>
                            </td>
                        </tr>
                    </table>
                    <table style="width: 100%; border-collapse: collapse">
                        <tr>
                            <td style="padding: 1%; width: 50%;">
                                Conducted By:<br><br>
                                <div class="text-center">
                                    <u><b>{{ strtoupper($signatories->where('id', $fsmr->technician)->first()->name ?? '') }}</b></u><br>
                                    {{ $signatories->where('id', $fsmr->technician)->first()->position ?? '' }}
                                </div>
                            </td>
                            <td style="padding: 1%; width: 50%;">
                                Noted By:<br><br>
                                <div class="text-center">
                                    <u><b>{{ strtoupper($signatories->where('id', $fsmr->contractor)->first()->name ?? '') }}</b></u><br>
                                    {{ $signatories->where('id', $fsmr->contractor)->first()->position ?? '' }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 1%; width: 50%;">
                                Inspected By:<br><br>
                                <div class="text-center">
                                    <u><b>{{ strtoupper($signatories->where('id', $fsmr->inspector)->first()->name ?? '') }}</b></u><br>
                                    {{ $signatories->where('id', $fsmr->inspector)->first()->position ?? '' }}
                                </div>
                            </td>
                            <td style="padding: 1%; width: 50%;">
                                Conforme By:<br>
                                <div class="text-center">
                                    <u><b>{{ strtoupper($fsmr->establishment_name) }}</b></u>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="page-footer">
                    <h3><em>{{ $fsmr->establishment_name }}</em></h3>
                </div>
            </div>
            <!-- FSS End -->

            <!-- EER -->
            <div class="print-page">
                <div class="content">
                    <table style="width: 100%; border-collapse: collapse; font-size: 11pt">
                        <tr>
                           <td style="width: 50%; border-top: 1px solid black; border-left: 1px solid black"></td> 
                           <td style="width: 50%; border-top: 1px solid black; border-right: 1px solid black; text-align: center">
                                OSPF-17<br>
                                <b>FIRE DOOR MAINTENANCE & INSPECTION REPORT</b><br>
                                Eff. Date: 5/7/24 Rev. 0
                           </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding: 1%; border: 1px solid black;">
                                Project: {{ $fsmr->establishment_name }}<br>
                                Location: {{ $fsmr->establishment_address }}<br>
                                Reference No.: {{ $fsmr->reference_no }}<br>
                                Date: {{ $fsmr->date_processed }}
                            </td>
                        </tr>
                        <tr>
                           <td style="padding: 1%; width: 50%; border-top: 1px solid black; border-left: 1px solid black">
                                SERVICE ORGANIZATION:<br>
                                NAME: <u><b>{{ $business->name }}</b></u><br>
                                ADDRESS: <u><b>{{ $business->address }}</b></u><br>
                                SERVICE PROVIDED: <u><b>Fire Safety</b></u>
                           </td> 
                           <td style="padding: 1%; width: 50%; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black">
                                PROPERTY NAME:<br>
                                NAME: <u><b>{{ $fsmr->establishment_name }}</b></u><br>
                                ADDRESS: <u><b>{{ $fsmr->establishment_address }}</b></u><br>
                                SERVICE PROVIDED: <u><b>{{ $fsmr->building_use }}</b></u>
                           </td>
                        </tr>
                        <tr>
                            <td style="padding: 1%; width: 50%; border-top: 1px solid black; border-left: 1px solid black;">
                                MANUFACTURER: <u><b>{{ $fsmr->eer_manufacturer }}</b></u><br>
                                HARDWARE: <u><b>{{ $fsmr->eer_hardware }}</b></u>
                            </td>
                            <td style="padding: 1%; width: 50%; border-top: 1px solid black; border-right: 1px solid black; vertical-align: top; text-align: left;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="border: 1px solid black; border-left: 1px solid black; text-align: center">
                                FIRE DOOR MAINTENANCE & INSPECTION REPORT
                            </td>
                        </tr>
                    </table>
                    <table style="width: 100%; border-collapse: collapse">
                        @if (!blank($eer))
                        <tr>
                            <td style="border: 1px solid black; text-align: center; width: 52%">Description</td>
                            <td style="border: 1px solid black; text-align: center; width: 6%">Yes</td>
                            <td style="border: 1px solid black; text-align: center; width: 6%">No</td>
                            <td style="border: 1px solid black; text-align: center; width: 6%">N/A</td>
                            <td style="border: 1px solid black; text-align: center; width: 30%">Remarks</td>
                        </tr>
                            @foreach ($eer as $er)
                                
                                <tr style="height: 8pt">
                                    <td style="padding-left: 1%; border: 1px solid black; font-size: 8pt">
                                        {{ $er->description ?? '' }}
                                    </td>
                                    <td style="padding-left: 1%; border: 1px solid black; text-align: center">
                                        @php ($yes = $fsmr->eer()->where('checklist_id', $er->id)->first()->status ?? '')
                                        {{ ($yes == 1) ? "✓" : '' }}
                                    </td>
                                    <td style="padding-left: 1%; border: 1px solid black; text-align: center">
                                        @php ($no = $fsmr->eer()->where('checklist_id', $er->id)->first()->status ?? '')
                                        {{ ($no == 2) ? "✓" : '' }}
                                    </td>
                                    <td style="padding-left: 1%; border: 1px solid black; text-align: center">
                                        @php ($na = $fsmr->eer()->where('checklist_id', $er->id)->first()->status ?? '')
                                        {{ ($na == 3) ? "✓" : '' }}
                                    </td>
                                    <td style="padding-left: 1%; border: 1px solid black;">
                                        {{ $fsmr->eer()->where('checklist_id', $er->id)->first()->remarks ?? '' }}
                                    </td>
                                </tr>

                            @endforeach
                        @endif
                        <tr>
                            <td colspan="5" style="padding-left: 1%; border: 1px solid black;">
                                Remarks and Proposal:<br>
                                <u>{{ $fsmr->eer_remarks }}</u>
                            </td>
                        </tr>
                    </table>
                    <table style="width: 100%; border-collapse: collapse">
                        <tr>
                            <td style="padding: 1%; width: 50%;">
                                Conducted By:<br><br>
                                <div class="text-center">
                                    <u><b>{{ strtoupper($signatories->where('id', $fsmr->technician)->first()->name ?? '') }}</b></u><br>
                                    {{ $signatories->where('id', $fsmr->technician)->first()->position ?? '' }}
                                </div>
                            </td>
                            <td style="padding: 1%; width: 50%;">
                                Noted By:<br><br>
                                <div class="text-center">
                                    <u><b>{{ strtoupper($signatories->where('id', $fsmr->contractor)->first()->name ?? '') }}</b></u><br>
                                    {{ $signatories->where('id', $fsmr->contractor)->first()->position ?? '' }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 1%; width: 50%;">
                                Inspected By:<br><br>
                                <div class="text-center">
                                    <u><b>{{ strtoupper($signatories->where('id', $fsmr->inspector)->first()->name ?? '') }}</b></u><br>
                                    {{ $signatories->where('id', $fsmr->inspector)->first()->position ?? '' }}
                                </div>
                            </td>
                            <td style="padding: 1%; width: 50%;">
                                Conforme By:<br><br>
                                <div class="text-center">
                                    <u><b>{{ strtoupper($fsmr->establishment_name) }}</b></u>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="page-footer">
                    <h3><em>{{ $fsmr->establishment_name }}</em></h3>
                </div>
            </div>
            <!-- EER End -->
             
        @elseif ($content->id == 6)
            <div class="print-page">
                <div class="top-background"></div>
                <div class="content">
                    <div class="text-center">
                        <h2 class="text-danger"><b>{{ strtoupper($business->name) }}</b></h2>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="{{ asset('images/ebn.png') }}" style="margin-left: 30%; height: 150px">
                        </div>
                        <div class="col-sm-6">
                            <div class="text-center">
                                <p style="font-size: 8pt">
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
                        <div class="col-sm-3"></div>
                    </div>
                    <div class="divider"></div>
                    <div class="text-center">
                        <h2><b>CERTIFICATE OF COMPLIANCE</b></h2>
                    </div>
                    <br>
                    <div style="padding-left: 5%; padding-right: 5%; font-size: 14pt">
                        <p style="text-align: justify;">
                            @php ($certificate_wordings = $settings->where('code', 'certification')->first()->description ?? '')
                            @php ($new_certificate_wordings = strtr($certificate_wordings, $params))
                            {!! $new_certificate_wordings !!}
                            <div class="row" style="margin-top: 40px;">
                                <div class="col-sm-6">
                                Prepared:
                                    <div style="margin-top: 50px;">
                                        <b>{{ strtoupper($signatories->where('position', 'Operation Manager')->first()->name) }}</b><br>
                                        Operation Manager<br>
                                        {{ $business->name }}
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 25px;">
                                <div class="col-sm-6">
                                </div>
                                <div class="col-sm-6">
                                Approved by:
                                    <div style="margin-top: 60px;">
                                        <div style="border-bottom: 1px solid black; width: 250px; margin-bottom: 5px"></div>
                                        Building Administrator
                                    </div>
                                </div>
                            </div>
                        </p>
                    </div>
                </div>
                <div class="page-footer">
                    <h3><em>{{ $fsmr->establishment_name }}</em></h3>
                </div>
            </div>
        @elseif ($content->id == 7)
            <div class="print-page">
                <div class="top-background"></div>
                <div class="content">
                    <div class="text-center">
                        <h2><b>Fire Safety Maintenance Report Summary</b></h2>
                    </div>
                    <br><br>
                    <table style="width: 100%; border-collapse: collapse">
                        <tr>
                            <td style="width:30%">Establishment Name:</td>
                            <td><b>{{ strtoupper($fsmr->establishment_name) }}</b></td>
                        </tr>
                        <tr>
                            <td>Location:</td>
                            <td><b>{{ $fsmr->establishment_address }}</b></td>
                        </tr>
                        <tr>
                            <td>Date of Assessment:</td>
                            <td><b>{{ date('F d, Y') }}</b></td>
                        </tr>
                        <tr>
                            <td>Assessment Conducted By:</td>
                            <td><b>{{ strtoupper($business->name).' PERSONNEL' }}</b></td>
                        </tr>
                        <tr>
                            <td>Company:</td>
                            <td><b>{{ strtoupper($business->name) }}</b></td>
                        </tr>
                    </table>
                    <p style="font-size: 13pt; margin-top: 45px; text-align: justify;">
                        <b>Executive Summary</b><br><br>
                        @php ($executive_summary_wordings = $settings->where('code', 'executive_summary')->first()->description ?? '')
                        @php ($new_executive_summary_wordings = strtr($executive_summary_wordings, $params))
                        {!! $new_executive_summary_wordings !!}<br><br>
                        <b>Assessment Findings</b>
                    </p>

                    
                    @if (!blank($assessments))

                        @php ($findings_ctr = 0)
                        @php ($stop = 0)
                        @php ($categ = '')
                        @php ($ctr = 0)
                        @foreach ($assessments as $assessment)
                            @if ($findings_ctr == 3 && $stop == 0)
                                    </div>
                                    <div class="page-footer">
                                        <h3><em>{{ $fsmr->establishment_name }}</em></h3>
                                    </div>
                                </div>
                                <div class="print-page">
                                    <div class="top-background"></div>
                                    <div class="content">
                                @php ($stop = 1)
                            @endif

                            <p style="font-size: 13pt; margin-top: 30px; text-align: justify;">

                                @if ($categ == '' || $categ != $assessment->category->category)
                                    <b>{{ $assessment->category->category }}</b><br>
                                    @php ($categ = $assessment->category->category)
                                    @php ($ctr = 1)
                                @else
                                    @php ($ctr++)
                                @endif

                                {{ $ctr.'. ' }} Assessment Question: <b>{{ $assessment->question }}</b><br>
                                @php ($fsmr_response_type = $fsmr->assessments->where('assessment_id', $assessment->id)->first()->response_type ?? '')
                                @php ($response = $assessment->responses->where('question_id', $assessment->id)->where('response_type', $fsmr_response_type)->first()->response ?? '')
                                
                                Findings: <b>{{ $response }}</b><br>
                            </p>

                            @php ($findings_ctr++)
                        @endforeach
                        <div style="width: 100%; max-width: 500px; height: 500px; margin: auto; text-align: center">
                            <canvas id="chart" style="margin-right: auto;
                                                        margin-left: auto;
                                                        height: 100%;
                                                        width: 100%;
                                                        display: block;"></canvas>
                        </div>
                    @endif
                </div>
                <div class="page-footer">
                    <h3><em>{{ $fsmr->establishment_name }}</em></h3>
                </div>
            </div>
            <div class="print-page">
                <div class="top-background"></div>
                <div class="content">
                    <div class="text-center">
                        <h2><b>Recommendations</b></h2>
                    </div>
                    <p style="font-size: 13pt; margin-top: 45px; text-align: justify;">
                        @php ($recommendation_wordings = $settings->where('code', 'recommendation')->first()->description ?? '')
                        @php ($new_recommendation_wordings = strtr($recommendation_wordings, $params))
                        {!! $new_recommendation_wordings !!}
                    </p>
                    @if (!blank($assessments))

                        @php ($recommendations_ctr = 0)
                        @php ($stop = 0)
                        @php ($categ = '')
                        @php ($ctr = 0)
                        @foreach ($recommendations as $recommendation)
                            @php ($categ_id = $recommendation->assessment_category_id)
                            @if ($recommendations_ctr == 2 && $stop == 0)
                                    </div>
                                    <div class="page-footer">
                                        <h3><em>{{ $fsmr->establishment_name }}</em></h3>
                                    </div>
                                </div>
                                <div class="print-page">
                                    <div class="top-background"></div>
                                    <div class="content">
                                @php ($stop = 1)
                            @endif

                            <p style="font-size: 13pt; margin-top: 30px; text-align: justify;">

                                @if ($categ == '' || $categ != $recommendation->assessment_category_id)
                                    @php ($categ = $recommendation->assessment_category_id)
                                    @php ($ctr = 1)
                                @else
                                    @php ($ctr++)
                                @endif

                                @php ($negative = 0)
                                @if (!blank($fsmr->assessments))
                                    @foreach($fsmr->assessments as $assessment)
                                        @php ($ass_categ = $assessment->question->category->id ?? '')

                                        @if ($ass_categ == $categ_id)
                                            @if ($assessment->response_type == 2)
                                                @php ($negative = 1)
                                                @break
                                            @endif
                                        @endif

                                    @endforeach
                                @endif

                                @if ($negative)
                                    @php ($recommendation_wordings = $recommendations->where('assessment_category_id', $categ_id)->first()->recommendation ?? '')
                                    @php ($recommendation_wordings = strtr($recommendation_wordings, $params))
                                    <b>{{ $recommendation->category->category }}</b><br>
                                    {!! $recommendation_wordings !!}
                                    @php ($recommendations_ctr++)
                                @endif
                            </p>
                        @endforeach
                        <p style="font-size: 13pt; margin-top: 30px; text-align: justify;">

                        </p>
                    @endif
                </div>
                <div class="page-footer">
                    <h3><em>{{ $fsmr->establishment_name }}</em></h3>
                </div>
            </div>
            <div class="print-page">
                <div class="top-background"></div>
                <div class="content">
                    <br>
                    <div class="text-center">
                        <h2><b>Conclusion</b></h2>
                    </div>
                    <p style="font-size: 13pt; margin-top: 45px; text-align: justify;">
                        @php ($conclusion_wordings = $settings->where('code', 'conclusion')->first()->description ?? '')
                        @php ($new_conclusion_wordings = strtr($conclusion_wordings, $params))
                        {!! $new_conclusion_wordings !!}
                    </p>
                    <div class="row" style="margin-top: 50px; font-size: 13pt;">
                        <div class="col-sm-6">
                        Prepared:
                            <div style="margin-top: 50px;">
                                <b>{{ strtoupper($signatories->where('position', 'Chief Operating Executive')->first()->name) }}</b><br>
                                {{ $business->name.' Proprietor' }}<br>
                                FSMR/FSCCR/AFSS/FDAS/KHS Contractor
                                Fire Extinguisher Supplier
                            </div>
                        </div>
                        <div class="col-sm-6 text-center">
                            <br><br><br>
                            NOT VALID WITHOUT <br>
                            {{ strtoupper($business-> name) }} OFFICIAL DRY SEAL
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px; font-size: 13pt;">
                        <div class="col-sm-12">
                            <em style="color: red">Note: This report is confidential and intended for the use of the establishment management and relevant safety authorities.</em>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12" style="font-size: 10pt; margin-top: 15px; color: red; text-align: justify">
                            Copyright © 2025. <b>{{ strtoupper($business->name) }}</b>. All rights reserved. No part of this document may be reproduced or transmitted in any form or by any means, whether electronic, mechanical, photocopying, or otherwise, without the prior written permission of <b>{{ strtoupper($business->name) }}</b>. Unauthorized copying, distribution, or modification of this work is strictly prohibited and may result in legal action. <b>{{ strtoupper($business->name) }}</b> retains all rights not expressly granted herein. For permissions inquiries, please contact the CEO.
                        </div>
                    </div>
                </div>
                <div class="page-footer">
                    <h3><em>{{ $fsmr->establishment_name }}</em></h3>
                </div>
            </div>
        @endif

        @if (!blank($content->subcontents))
            @php ($img_ctr = 0) 
            @php ($page_open = false) <!-- Track if a page is open -->

            @foreach ($content->subcontents as $cont)
                @php ($atts = $fsmr->attachments()->where('attachment_type_id', $cont->attachment_type_id)->get())
                @php ($hasAttachments = $atts->isNotEmpty())

                @if ($hasAttachments)
                    @foreach ($atts as $att)
                        @php ($desc = $att->attachmenttype->description)
                        @php ($att_counter_desc = '')

                        @if (count($atts) > 1)
                            @php ($att_counter_desc = ' ('.($loop->iteration).')')
                        @endif

                        <!-- Open a new page if img_ctr is 0 -->
                        @if ($img_ctr == 0 && !$page_open)
                            <div class="print-page">
                                <div class="top-background"></div>
                                <div class="content">
                                @php ($page_open = true)
                        @endif

                        <!-- Add the image -->
                        @php ($img_cont = 'img-desc-container')
                        @if ($desc == 'Fire Safety Inspection Certificate')
                            @php ($img_cont = 'img-desc-container-100')
                            @php ($img_ctr += 2)
                        @else
                            @php ($img_ctr++)
                        @endif
                        <div class="{{ $img_cont }}">
                            <img class="img-display" src="{{ asset('files/attachments').'/'.$att->url }}">
                            <br><h3 style="text-align: justify">Figure {{ $figure++.". ".$fsmr->establishment_name." ".$desc.$att_counter_desc }}</h3>
                        </div>
                        

                        <!-- Close the page after 2 images -->
                        @if ($img_ctr >= 2)
                                </div>
                                <div class="page-footer">
                                    <h3><em>{{ $fsmr->establishment_name }}</em></h3>
                                </div>
                            </div>
                            @php ($img_ctr = 0)
                            @php ($page_open = false)
                        @endif
                    @endforeach
                @endif
            @endforeach

            <!-- Close any remaining open page -->
            @if ($page_open)
                    </div>
                    <div class="page-footer">
                        <h3><em>{{ $fsmr->establishment_name }}</em></h3>
                    </div>
                </div>
            @endif
        @endif

        
    @endforeach

</body>
</html>

<script src="{{ asset('plugins/chartjs/chart.js') }}"></script>
<script>
    const label = {!! $chart['label'] !!};
    const radarChart = document.getElementById('chart');
    const CHART_COLORS = {
        red: 'rgb(255, 99, 132)',
        blue: 'rgb(54, 162, 235)',
    };

    const transparentize = (color, opacity) => {
        const alpha = 1 - opacity;
        return color.replace('rgb', 'rgba').replace(')', `, ${alpha})`);
    };

    const formatLabel = (label) => {
        const maxLength = 15; // Adjust as needed
        return label.length > maxLength ? label.substring(0, maxLength) + '...' : label;
    };

    const data = {
        labels: label.map(formatLabel),
        datasets: [
            {
                label: 'BFP FE Requireds',
                data: {!! $chart['required'] !!},
                borderColor: CHART_COLORS.red,
                backgroundColor: transparentize(CHART_COLORS.red, 0.5),
            },
            {
                label: 'FE Available',
                data: {!! $chart['available'] !!},
                borderColor: CHART_COLORS.blue,
                backgroundColor: transparentize(CHART_COLORS.blue, 0.5),
            }
        ]
    };

    const config = {
        type: 'radar',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Fire Extinguishers and Equipment'
                }
            }
        },
    };

    new Chart(radarChart, config);
</script>

