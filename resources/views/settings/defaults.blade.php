@extends('index')
@section('content')

<style>
    textarea {
        width: 100%; /* Adjust width as needed */
        min-height: 50px; /* Set a minimum height */
        resize: none; /* Prevent users from manually resizing */
        overflow: hidden; /* Hide scrollbars */
        box-sizing: border-box; /* Include padding and border in the width and height */
    }
</style>

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-safe icon-gradient bg-amy-crisp">
                </i>
            </div>
            <div>System Defaults
                <div class="page-title-subheading">System default manager
                </div>
            </div>
        </div>
        <div class="page-title-actions">
            
        </div>  
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card p-3">
            <div class="body" id="content">

                <form id="frm">
                    @if (!blank($settings))
                        @foreach ($settings as $setting)
                        <div class="position-relative row form-group mt-3">
                            <label for="{{ $setting->code }}" class="col-sm-3 col-form-label">{{ $setting->name }}</label>
                            <div class="col-sm-9">
                                <textarea class="form-control form-control-sm input-border-bottom" id="{{ $setting->code }}" name="{{ $setting->code }}">{{ $setting->description }}</textarea>
                            </div>
                        </div>
                        @endforeach
                    @endif
                    <div class="row mt-5">
                        <div class="col-sm-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Save</button>
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
    document.addEventListener('DOMContentLoaded', () => {
        const textareas = document.querySelectorAll('textarea'); // Select all textareas

        // Function to adjust textarea height dynamically
        const adjustHeight = (element) => {
            element.style.height = 'auto';  // Resetting height to auto to shrink if needed
            element.style.height = element.scrollHeight + 'px';  // Setting height based on scrollHeight
        };

        // Loop through each textarea and add event listener
        textareas.forEach((textarea) => {
            adjustHeight(textarea); // Adjust height initially if needed

            // Adjust height on content change
            textarea.addEventListener('input', (event) => {
                adjustHeight(event.target);
            });
        });
    });

    $('#frm').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/settings/save',
            method: 'POST',
            data: $('#frm').serialize(),
            dataType: 'JSON',
            success: function(result) {
                swal.fire({
                    title: result['title'],
                    type: result['icon'],
                    text: result['message'],
                    confirmButtonText: "Okay",
                }).then((res) => {
                    // if (res.isConfirmed) {
                    //     if (result['icon'] == 'success'){
                            
                    //     }
                    // }
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

</script>
@endpush