@extends('index')
@section('content')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-user icon-gradient bg-amy-crisp">
                </i>
            </div>
            <div>User Profile
                <div class="page-title-subheading">

                </div>
            </div>
        </div>    
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">

            <div class="card-body">
                <ul class="tabs-animated-shadow tabs-animated nav" id="tab-menu">
                    <li class="nav-item">
                        <a role="tab" class="nav-link show active" id="tab-c-0" data-toggle="tab" href="#tab-profile" aria-selected="false">
                            <span>User Profile</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a role="tab" class="nav-link" id="tab-c-1" data-toggle="tab" href="#tab-change-pass" aria-selected="true">
                            <span>Change Password</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane show active" id="tab-profile" role="tabpanel">
                        <div class="divider"></div>
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <h1 class="text-info"><b>User Profile</b></h1>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-sm-4">
                                <h4><b>Basic Information</b></h4><br>
                                <h6><b><i class="fas fa-signature mr-2"></i>Name</b></h6>
                                {{ ($user) ? strtoupper($user->firstname.' '.$user->middlename.' '.$user->lastname) : '' }}<br><br>
                                <h6><b><i class="fas fa-map-marker-alt mr-2"></i>Address</b></h6>
                                {{ ($user) ? strtoupper($user->addr_barangay->description.', '.$user->addr_town->description.', '.$user->addr_province->description) : '' }}<br><br>
                                <h6><b><i class="fas fa-venus-mars mr-2"></i>Sex</b></h6>
                                {{ ($user->sex == 'M') ? 'MALE' : 'FEMALE' }}
                            </div>
                            <div class="col-sm-4">
                                <h4><b>Contacts</b></h4><br>
                                <h6><b><i class="fas fa-phone mr-2"></i>Contact Number</b></h6>
                                {{ $user->contact_number ?? '' }}<br><br>
                                <h6><b><i class="fas fa-envelope mr-2"></i>Email</b></h6>
                                {{ $user->email }}<br><br>
                            </div>
                        </div>
                        
                    </div>
                    <div class="tab-pane" id="tab-change-pass" role="tabpanel">
                        <div class="divider"></div>
                        <form id="frm" method="POST" action="{{ route('change-password') }}">
                            @csrf
                            <div class="position-relative row form-group">
                                <label for="opassword" class="col-sm-2 col-form-label">Old Password</label>
                                <div class="col-sm-4">
                                    <input type="password" class="form-control form-control-sm input-border-bottom" id="opassword" name="opassword" required>
                                    @error('opassword')<p class="text-danger mt-2"><em>{{ $message }}</em></p>@enderror
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="password" class="col-sm-2 col-form-label">New Password</label>
                                <div class="col-sm-4">
                                    <input type="password" class="form-control form-control-sm input-border-bottom" id="password" name="password" required>
                                    @error('npassword')<p class="text-danger mt-2"><em>{{ strtr($message, ['npassword' => 'new password']) }}</em></p>@enderror
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <label for="password_confirmation" class="col-sm-2 col-form-label">Confirm Password</label>
                                <div class="col-sm-4">
                                    <input type="password" class="form-control form-control-sm input-border-bottom" id="password_confirmation" name="password_confirmation" required> 
                                    @error('cpassword')<p class="text-danger mt-2"><em>{{ strtr($message, ['cpassword_confirmation' => 'confirm password']) }}</em></p>@enderror
                                </div>
                            </div>
                            <div class="position-relative row form-group">
                                <div class="col-sm-12 float-right">
                                    <div class="btn-group">
                                        <button type="submit" class="btn btn-sm btn-primary waves-effect btn-save">
                                            <i class="fas fa-save mr-2"></i>
                                            <span>Save</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                        </form>
                    </div>
                </div>
            </div>
                
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
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




