@extends('index')
@section('content')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-safe icon-gradient bg-amy-crisp">
                </i>
            </div>
            <div>FSMR Application
                <div class="page-title-subheading">Fire Safety Maintenance Report Application
                </div>
            </div>
        </div>    
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card p-3">
            <div class="body" id="content">

                <form id="frm">
                    <input type="hidden" name="fsmr-id" value="{{ (request('id')) ?? '' }}">
                    <div class="position-relative row form-group mt-3">
                        <label for="application-number" class="col-sm-3 col-form-label">Application Number:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control form-control-sm input-border-bottom" id="application-number" name="application-number" value="{{ $fsmr->app_no ?? (($app_no) ?? '') }}" readonly>
                        </div>
                    </div>
                    <div class="position-relative row form-group mt-3">
                        <label for="establishment-name" class="col-sm-3 col-form-label">Establishment Name:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm input-border-bottom" id="establishment-name" name="establishment-name" value="{{ $fsmr->establishment_name ?? '' }}" required>
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="address" class="col-sm-3 col-form-label">Address of the Establishment:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm input-border-bottom" id="address" name="address" value="{{ $fsmr->establishment_address ?? '' }}" required>
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="address" class="col-sm-3 col-form-label">Address of the Establishment (for BFP):</label>
                        <div class="col-sm-3">
                            <select class="form-control form-control-sm show-tick" name="addr_province" id="addr_province">
                                <option value="">Select Province</option>
                                @foreach ($provinces as $province)
                                <option value="{{ $province->code }}" {{ (!blank($fsmr)) ? (($province->code == $fsmr->addr_province) ? 'selected="selected"' : '') : (($province->code == '0712') ? 'selected="selected"' : '') }}>{{ $province->description }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <select class="form-control form-control-sm show-tick" name="addr_town" id="addr_town">
                                <option value="">Select Municipality</option>
                                @if (!blank($towns))
                                    @foreach ($towns as $town)
                                    <option value="{{ $town->code }}" {{ (!blank($fsmr)) ? (($town->code == $fsmr->addr_town) ? 'selected="selected"' : '') : '' }}>{{ $town->description }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>  
                    </div>
                    <div class="position-relative row form-group">
                        <label for="occupancy" class="col-sm-3 col-form-label">Occupancy:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control form-control-sm input-border-bottom" id="occupancy" name="occupancy" value="{{ $fsmr->occupancy ?? '' }}" required>
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="floors" class="col-sm-3 col-form-label">No. of Floors:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control form-control-sm input-border-bottom" id="floors" name="floors" value="{{ $fsmr->no_of_floors ?? '' }}" required>
                        </div>
                    </div>
                    <div class="position-relative row form-group mt-4">
                        <label for="reference-no" class="col-sm-3 col-form-label">Reference No:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control form-control-sm input-border-bottom" id="reference-no" name="reference-no" value="{{ $fsmr->reference_no ?? (($reference_no) ?? '') }}" readonly>
                        </div>
                    </div>
                    <div class="position-relative row form-group mt-4">
                        <label for="building-used" class="col-sm-3 col-form-label">Building Used:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control form-control-sm input-border-bottom" id="building-used" name="building-used" value="{{ ($fsmr) ? $fsmr->building_use : '' }}">
                        </div>
                    </div>
                    <div class="position-relative row form-group mt-4">
                        <label for="building-used" class="col-sm-3 col-form-label">Service Availed:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control form-control-sm input-border-bottom" id="service-availed" name="service-availed" value="{{ ($fsmr) ? $fsmr->service_availed : '' }}">
                        </div>
                    </div>
                    @if(Auth::user()->role != 2)
                    <div class="position-relative row form-group">
                        <label for="floors" class="col-sm-3 col-form-label">Requested by:</label>
                        <div class="col-sm-4">
                            <select class="form-control form-control-sm col-md-12" id="requested-by" name="requested-by">
                                <option value=""></option>
                                @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ ($fsmr) ? (($fsmr->client_id == $client->id) ? 'selected="selected"' : '') : '' }}>{{ $client->firstname.' '.$client->lastname }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif
                    <div class="divider"></div>
                    <div class="position-relative row form-group">
                        <label for="occupancy" class="col-sm-12 col-form-label"><i>* Please upload the necessary attachments by selecting attachment type and uploading a photo</i></label>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="occupancy" class="col-sm-3 col-form-label">Select Attachment Type:</label>
                        <div class="col-sm-4">
                            <select class="form-control form-control-sm col-md-12" id="attachment-type">
                                <option value=""></option>
                            @foreach($attachment_types as $type)
                                <option value="{{ $type->id }}">{{ $type->description }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="position-relative row form-group">
                        <label for="occupancy" class="col-sm-3 col-form-label">Upload Attachments:</label>
                        <div class="col-sm-6 uploader">
                            
                            <div id="buttons-container">
                                <div class="custom-file-upload">
                                    <label for="file-uploader">Choose File</label>
                                    <input type="file" id="file-uploader" accept="image/*">
                                </div>
                            </div>
                            <div class="mt-2" id="image-preview"></div>
                            <div class="row mt-2" id="image-queue"></div>

                        </div>
                    </div>

                    <div class="position-relative row form-group">
                        <div class="table-responsive">
                            <table class="display table table-sm table-striped table-hover dataTable" id="table-list">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Attachment Type</th>
                                        <th class="text-center">Attached Photo</th>
                                        <th class="text-center">Controls</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!blank($fsmr))
                                        @if (!blank($fsmr->attachments))
                                            @php ($count = 1)
                                            @foreach ($fsmr->attachments as $attachment)
                                            <tr>
                                                <td class="text-center">{{ $count++ }}</td>
                                                <td class="text-center">{{ $attachment->attachmenttype->description }}</td>
                                                <td class="text-center">
                                                    <img src="{{ asset('files/attachments/'.$attachment->url) }}" style="height: auto; max-width: 100px">
                                                </td>
                                                <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-danger" value="{{ $attachment->attachment_type_id }}" onclick="removeAttachment(event, this)"><i class="fas fa-trash mr-2"></i>Remove</button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-sm-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Submit</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>



@endsection

@push('scripts')
<script>
    var cropper = null, croppedImages = null, ctr = 1;

    $('#file-uploader').on('change', function(e){
        const files = e.target.files
        if (!files.length) return;

        Array.from(files).forEach((file) => {
            const reader = new FileReader();
            reader.onload = () => {
                showPreview(reader.result, file);
            };
            reader.readAsDataURL(file);
        });

        $('#buttons-container button').each(function () {
            if ($(this).text().trim() === "Add to List") {
                $(this).remove();
            }
        });
    });
    
    $('select[name="addr_province"]').on('change', function() {
        var code = $(this).val();

        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/address/towns/'+code,
            method: 'POST',
            dataType: 'JSON',
            success: function(result) {
                $('#addr_town').html('');
                $('#addr_town').append('<option value="">Select Municipality</option>');
                $.each(result, function (key, value) {
                    $('#addr_town').append('<option value="'+value['code']+'">'+value['description']+'</option>');
                });
            }
        })
    });

    $('#frm').on('submit', async function(e){
        e.preventDefault();

        const formData = new FormData();

        const form = $('#frm')[0];
        const formFields = new FormData(form);
        formFields.forEach((value, key) => {
            formData.append(key, value);
        });

        const rows = $('#table-list tbody tr');
        for (let i = 0; i < rows.length; i++) {
            const imgElement = $(rows[i]).find('td:nth-child(3) img')[0];
            const type = $(rows[i]).find('td:last-child button').val();
            
            if (imgElement && imgElement.src) { //.startsWith('blob:')
                const file = await getFileFromBlob(imgElement.src, `image_${i + 1}.png`);
                if (file) {
                    formData.append('images[]', file);
                    formData.append('types[]', type);
                }
            }
        }
        
        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/transaction/fsmr/saveFSMR?save=1',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
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
                }).then((rs) => {
                    if (rs.isConfirmed) {
                        window.location.href = "{{ route('transaction-fsmr-view').'?id=' }}" + result['id'];
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

    async function getFileFromBlob(blobUrl, filename) {
        try {
            const res = await fetch(blobUrl);
            const blob = await res.blob();
            return new File([blob], filename, { type: blob.type });
        } catch (err) {
            console.error('Error converting blob URL to File:', err);
            return null;
        }
    }

    async function convertImageToFile(imageId, filename) {
        const image = document.getElementById(imageId);
        const blobUrl = image.src;

        const file = await getFileFromBlob(blobUrl, filename);

        if (file) {
            console.log('File created:', file);
        } else {
            console.error('Failed to create file');
        }
    }

    function showPreview(imageSrc, file) {
        const image = document.createElement("img");
        image.src = imageSrc;
        image.style.maxWidth = "100%";

        $('#image-preview').html('');
        $('#image-preview').append(image);

        if (cropper) cropper.destroy();
            cropper = new Cropper(image, {
            // aspectRatio: 1,
            viewMode: 2,
        });
        
        const uploaderContainer = $('#file-uploader').closest('.uploader');
        const buttonsContainer = $('#buttons-container');
        
        const addToQueueButton = document.createElement("button");
        addToQueueButton.textContent = "Add to List";
        addToQueueButton.classList.add('btn', 'btn-primary');
        addToQueueButton.style.marginBottom = "2px";
        buttonsContainer.append(addToQueueButton);

        addToQueueButton.addEventListener("click", (e) => {
            e.preventDefault();
            addToList(file, buttonsContainer);
        });
    }

    function addToList(file, buttonsContainer) {
        if (!cropper) return;

        // Get cropped image data
        cropper.getCroppedCanvas().toBlob((blob) => {
            const url = URL.createObjectURL(blob);

            const type = $('#attachment-type').val();
            const type_text = $('#attachment-type option:selected').text();
            const img = document.createElement('img');
            
            $('#table-list tbody').append(
                '<tr>' +
                '<td class="text-center">' + ctr++ + '</td>' +
                '<td class="text-center">' + type_text + '</td>' +
                '<td class="text-center"><img src="'+url+'" style="height: auto; max-width: 100px"></td>' +
                '<td class="text-center"><button class="btn btn-sm btn-danger" value="' + type + '" onclick="removeAttachment(event, this)"><i class="fas fa-trash mr-2"></i>Remove</button></td>' +
                '</tr>'
            );

            //croppedImages.push(blob); // Save blob for uploading

            cropper.destroy();
            cropper = null;
            $('#image-preview').html('');

            $('#buttons-container button').each(function () {
                if ($(this).text().trim() === "Add to List") {
                    $(this).remove();
                }
            });

        });
    }

    function removeAttachment(ev, el){
    // $(document).on('click', '#btn-remove-attachment', function(e) {
        ev.preventDefault();
        // e.stopPropagation();
        const row = $(el).closest('tr');

        Swal.fire({
            title: 'Remove Attachment?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, remove it!'
        }).then((result) => {
            if (result.isConfirmed) {
                row.remove();
            }
        });
    }
</script>
@endpush