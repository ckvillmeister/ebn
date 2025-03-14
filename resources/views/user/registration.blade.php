<html>
<title>{{ config('app.name') }}</title>
<link rel="icon" href="{{ asset('images/ebn.png') }}" type="image/x-icon">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/dist/sweetalert2.min.css') }}">
<head>
    <style>

        html {
        background-color: #ffffff;
        }

        body {
        font-family: "Poppins", sans-serif;
        height: 100vh;
        }

        a {
        color: #92badd;
        display:inline-block;
        text-decoration: none;
        font-weight: 400;
        }

        h2 {
        text-align: center;
        font-size: 16px;
        font-weight: 600;
        text-transform: uppercase;
        display:inline-block;
        margin: 40px 8px 10px 8px; 
        color: #cccccc;
        }



        /* STRUCTURE */

        .wrapper {
        display: flex;
        align-items: center;
        flex-direction: column; 
        justify-content: center;
        width: 100%;
        min-height: 100%;
        padding: 20px;
        }

        #formContent {
        -webkit-border-radius: 10px 10px 10px 10px;
        border-radius: 10px 10px 10px 10px;
        background: #fff;
        padding: 30px;
        width: 90%;
        max-width: 600px;
        position: relative;
        padding: 0px;
        -webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
        box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
        text-align: center;
        }

        #formFooter {
        background-color: #f6f6f6;
        border-top: 1px solid #dce8f1;
        padding: 25px;
        text-align: center;
        -webkit-border-radius: 0 0 10px 10px;
        border-radius: 0 0 10px 10px;
        }



        /* TABS */

        h2.inactive {
        color: #cccccc;
        }

        h2.active {
        color: #0d0d0d;
        border-bottom: 2px solid #5fbae9;
        }



        /* FORM TYPOGRAPHY*/

        input[type=button], input[type=submit], input[type=reset]  {
        background-color: #fdea24;
        border: none;
        color: white;
        padding: 15px 80px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        text-transform: uppercase;
        font-size: 13px;
        -webkit-box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
        box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
        -webkit-border-radius: 5px 5px 5px 5px;
        border-radius: 5px 5px 5px 5px;
        margin: 5px 20px 40px 20px;
        -webkit-transition: all 0.3s ease-in-out;
        -moz-transition: all 0.3s ease-in-out;
        -ms-transition: all 0.3s ease-in-out;
        -o-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
        }

        input[type=button]:hover, input[type=submit]:hover, input[type=reset]:hover  {
        background-color: #dbca16;
        }

        input[type=button]:active, input[type=submit]:active, input[type=reset]:active  {
        -moz-transform: scale(0.95);
        -webkit-transform: scale(0.95);
        -o-transform: scale(0.95);
        -ms-transform: scale(0.95);
        transform: scale(0.95);
        }

        input[type=text], input[type=password], select, input[type=email] {
        background-color: #f6f6f6;
        border: none;
        color: #0d0d0d;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 5px;
        width: 85%;
        border: 2px solid #f6f6f6;
        -webkit-transition: all 0.5s ease-in-out;
        -moz-transition: all 0.5s ease-in-out;
        -ms-transition: all 0.5s ease-in-out;
        -o-transition: all 0.5s ease-in-out;
        transition: all 0.5s ease-in-out;
        -webkit-border-radius: 5px 5px 5px 5px;
        border-radius: 5px 5px 5px 5px;
        }

        input[type=text]:focus, , input[type=password]:focus {
        background-color: #fff;
        border-bottom: 2px solid #fdea24;
        }

        input[type=text]:placeholder, , input[type=password]:placeholder {
        color: #cccccc;
        }



        /* ANIMATIONS */

        /* Simple CSS3 Fade-in-down Animation */
        .fadeInDown {
        -webkit-animation-name: fadeInDown;
        animation-name: fadeInDown;
        -webkit-animation-duration: 1s;
        animation-duration: 1s;
        -webkit-animation-fill-mode: both;
        animation-fill-mode: both;
        }

        @-webkit-keyframes fadeInDown {
        0% {
            opacity: 0;
            -webkit-transform: translate3d(0, -100%, 0);
            transform: translate3d(0, -100%, 0);
        }
        100% {
            opacity: 1;
            -webkit-transform: none;
            transform: none;
        }
        }

        @keyframes fadeInDown {
        0% {
            opacity: 0;
            -webkit-transform: translate3d(0, -100%, 0);
            transform: translate3d(0, -100%, 0);
        }
        100% {
            opacity: 1;
            -webkit-transform: none;
            transform: none;
        }
        }

        /* Simple CSS3 Fade-in Animation */
        @-webkit-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
        @-moz-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
        @keyframes fadeIn { from { opacity:0; } to { opacity:1; } }

        .fadeIn {
        opacity:0;
        -webkit-animation:fadeIn ease-in 1;
        -moz-animation:fadeIn ease-in 1;
        animation:fadeIn ease-in 1;

        -webkit-animation-fill-mode:forwards;
        -moz-animation-fill-mode:forwards;
        animation-fill-mode:forwards;

        -webkit-animation-duration:1s;
        -moz-animation-duration:1s;
        animation-duration:1s;
        }

        .fadeIn.first {
        -webkit-animation-delay: 0.4s;
        -moz-animation-delay: 0.4s;
        animation-delay: 0.4s;
        }

        .fadeIn.second {
        -webkit-animation-delay: 0.6s;
        -moz-animation-delay: 0.6s;
        animation-delay: 0.6s;
        }

        .fadeIn.third {
        -webkit-animation-delay: 0.8s;
        -moz-animation-delay: 0.8s;
        animation-delay: 0.8s;
        }

        .fadeIn.fourth {
        -webkit-animation-delay: 1s;
        -moz-animation-delay: 1s;
        animation-delay: 1s;
        }

        /* Simple CSS3 Fade-in Animation */
        .underlineHover:after {
        display: block;
        left: 0;
        bottom: -10px;
        width: 0;
        height: 2px;
        background-color: #56baed;
        content: "";
        transition: width 0.2s;
        }

        .underlineHover:hover {
        color: #0d0d0d;
        }

        .underlineHover:hover:after{
        width: 100%;
        }



        /* OTHERS */

        *:focus {
            outline: none;
        } 

        #icon {
        width:60%;
        }
        
        #loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

    </style>
</head>
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="{{ asset('images/ebn.png') }}" style="width: 100px; margin-top: 30px" id="icon" alt="User Icon" /><br>
      <h4>Client Registration Form</h4>
    </div>

    <!-- Login Form -->
    <form id="frm">
      @csrf
      <input type="text" value="{{ old('firstname') }}" class="fadeIn second" name="firstname" placeholder="First Name" required>
      <input type="text" value="{{ old('middlename') }}" class="fadeIn second" name="middlename" placeholder="Middle Name">
      <input type="text" value="{{ old('lastname') }}" class="fadeIn second" name="lastname" placeholder="Last Name" required>

      <select class="fadeIn second" name="province" id="province" required>
          <option value="">Select Province</option>
          @foreach ($provinces as $province)
          <option value="{{ $province->code }}" {{ (($province->code == '0712') ? 'selected' : '') }}>{{ $province->description }}</option>
          @endforeach
      </select>

      <select class="fadeIn second" name="municipality" id="municipality" required>
          <option value="">Select Municipality</option>
          @foreach ($towns as $town)
          <option value="{{ $town->code }}" {{ (($town->code == '071244') ? 'selected' : '') }}>{{ $town->description }}</option>
          @endforeach
      </select>

      <select class="fadeIn second" name="barangay" id="barangay" required>
          <option value="">Select Barangay</option>
          @foreach ($brgys as $brgy)
          <option value="{{ $brgy->code }}">{{ strtoupper($brgy->description) }}</option>
          @endforeach
      </select>

      <input type="email" id="login" value="{{ old('username') }}" class="fadeIn second" name="username" placeholder="E-mail" required>
      <br><br>
      <p style="text-align: justify; padding: 7%; font-size: 10pt; background-color: #dbdbd9">
        By registering, you agree to provide your personal information, which will be collected, 
        processed, and stored in accordance with our Data Privacy Policy. We are committed to 
        protecting your privacy and ensuring that your data is used only for legitimate purposes, 
        such as account creation, communication, and service improvements. <br><br>Your information will not be 
        shared with third parties without your consent, except as required by law. You have the right 
        to access, correct, or request the deletion of your data by contacting our support team. 
        By checking the box below, you confirm that you have read and understood this disclaimer and 
        agree to our Data Privacy Policy.<br><br>
      </p>
      <div style="display: flex; align-items: center; padding-left: 7%; padding-right: 7%; font-size: 10pt;">
        <input type="checkbox" id="agree" style="width: 20px; height: 20px; margin-right: 10px; margin-bottom: 20px">
        <label for="agree">
            <b>I agree to the collection and processing of my personal 
            data as stated in the Data Privacy Policy.</b>
        </label>
      </div>
      
      <div id="loading-overlay" style="display: none;">
          <div class="spinner-border text-primary" role="status">
              <span class="visually-hidden"></span>
          </div>
      </div>
      
      <input type="submit" class="fadeIn fourth text-dark" id="register-btn" value="Submit Registration">
      <br>
      <div class="text-danger">
        {{ $errors->first('firstname') }}
        {{ $errors->first('lastname') }}
        {{ $errors->first('province') }}
        {{ $errors->first('municipality') }}
        {{ $errors->first('barangay') }}
      </div>
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="{{ route('landing') }}">Return Home</a>
    </div>

  </div>
</div>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{ asset('plugins/sweetalert2/dist/sweetalert2.min.js') }}"></script>
<script>
  // $(document).ready(function () {
  //     $('#agree').change(function () {
  //         if ($(this).is(':checked')) {
  //             $('#register-btn').prop('disabled', false);
  //         } else {
  //             $('#register-btn').prop('disabled', true);
  //         }
  //     });
  // });

$('#frm').on('submit', function(e){
    e.preventDefault();

    if (!($('#agree').is(':checked'))){
      swal.fire({
          title: "Empty fields!",
          type: "error",
          text: "Fill-up the registration form first and check 'I agree'",
          confirmButtonText: "Got it!",
      })

      return;
    }

    $.ajax({
        headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        url: "{{ route('register-client') }}",
        method: 'POST',
        data: $('#frm').serialize(),
        dataType: 'JSON',
        beforeSend: function() {
            $('#loading-overlay').fadeIn();
        },
        complete: function(){
            $('#loading-overlay').fadeOut();
        },
        success: function(result) {
            swal.fire({
                title: result['title'],
                type: result['icon'],
                text: result['message'],
                confirmButtonText: "Okay",
            }).then((res) => {
                if (res.isConfirmed) {
                    if (result['icon'] == 'success'){
                      window.location.href = "{{ route('login') }}";
                    }
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

$('select[name="province"]').on('change', function() {
    var code = $(this).val();

    $.ajax({
        headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        url: '/address/towns/'+code,
        method: 'POST',
        dataType: 'JSON',
        success: function(result) {
            $('#municipality').html('');
            $('#municipality').append('<option value="">Select Municipality</option>');
            $.each(result, function (key, value) {
                $('#municipality').append('<option value="'+value['code']+'">'+value['description']+'</option>');
            });
        }
    })
});

$('select[name="municipality"]').on('change', function() {
    var code = $(this).val();

    $.ajax({
        headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        url: '/address/barangays/'+code,
        method: 'POST',
        dataType: 'JSON',
        success: function(result) {
            $('#barangay').html('');
            $('#barangay').append('<option value="">Select Barangay</option>');
            $.each(result, function (key, value) {
                $('#barangay').append('<option value="'+value['code']+'">'+value['description'].toUpperCase()+'</option>');
            });
        }
    })
});
</script>
</html>