@extends('layouts.admin.index')
@section('content')
<!-- BEGIN Page Content -->
<!-- the #js-page-content id is needed for some plugins to initialize -->
<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">SmartAdmin</a></li>
        <li class="breadcrumb-item">Samrt Validation</li>
    </ol>
    <div class="border-top">
        <form action="{{url('api/smart_validation')}}" id="form" name="form" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="row mt-5">
                <div class="col-6">
                    <div class="form-group mb-3">
                        <label for="host" id="host_label" class="form-label">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name" onkeyup="clearError(this)">
                        <span class="text-danger" id="first_name_error"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="host" id="host_label" class="form-label">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Enter Last Name" onkeyup="clearError(this)">
                        <span class="text-danger" id="last_name_error"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="host" id="host_label" class="form-label"><sup class="required">*</sup>Phone</label>
                        <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter Phone" onkeyup="clearError(this)">
                        <span class="text-danger" id="phone_error"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="host" id="host_label" class="form-label">Address</label>
                        <input type="text" id="address" name="address" class="form-control" placeholder="Enter Address" onkeyup="clearError(this)">
                        <span class="text-danger" id="address_error"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="host" id="host_label" class="form-label"><sup class="required">*</sup>Email</label>
                        <input type="text" id="email" name="email" class="form-control" placeholder="Enter Email" onkeyup="clearError(this)">
                        <span class="text-danger" id="email_error"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="host" id="host_label" class="form-label"><sup class="required">*</sup>Password</label>
                        <div class="password-hide-show" style="position: relative;">
                            <iconify-icon icon="ion:eye" height="20" width="20" class="incon-on d-none" onclick="iconChange()" style="position:absolute;right:10px;top:10px;cursor:pointer;">
                            </iconify-icon>
                            <iconify-icon icon="ion:eye-off" class="incon-off" onclick="iconChange()" height="20" width="20" style="position:absolute;right:10px;top:10px;cursor:pointer;">
                            </iconify-icon>
                        </div>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter Password" onkeyup="clearError(this)">

                        <span class="text-danger" id="password_error"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="host" id="host_label" class="form-label"><sup class="required">*</sup>Confirm
                            Password</label>
                        <div class="password-hide-show" style="position: relative;">
                            <iconify-icon icon="ion:eye" height="20" width="20" class="con-pass-icon-on d-none" style="position:absolute;right:10px;top:10px;cursor:pointer;">
                            </iconify-icon>
                            <iconify-icon icon="ion:eye-off" class="con-pass-icon-off" height="20" width="20" style="position:absolute;right:10px;top:10px;cursor:pointer;">
                            </iconify-icon>
                        </div>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Enter Password" onkeyup="clearError(this)">

                        <span class="text-danger" id="password_error"></span>
                    </div>
                </div>

            </div>
            <div class="text-end">

                <button id="submit-button" type="submit" class="btn btn-success border d-flex align-item-center justify-contetn-bitween ">
                    Create <iconify-icon icon="eos-icons:bubble-loading" height="20" width="20" class="mx-3 d-none submit-loader">
                    </iconify-icon>
                </button>
            </div>

        </form>
    </div>

</main>
@endsection
@push("custom-js")
<!-- validaton form -->
<!-- validaton form -->
<script src="{{asset('validation/jquery.serializejson.min.js')}}"></script>
<script>
    /**
     * Submit Form Data  
     * Submit Form Data  
     **/

    $('#form').submit(function(e) {
        e.preventDefault();
        let form = $(this);
        formSubmit("post", "submit-button", form);
    })

    function formSubmit(type, btn, form, headers = null) {
        let url = form.attr('action');
        let form_data = JSON.stringify(form.serializeJSON());
        // form_data.append('_token',"{{csrf_token()}}")
        formData = JSON.parse(form_data);


        $.ajax({
            type: type,
            url: url,
            data: formData,
            beforeSend: function() {
                $('#' + btn).prop('disabled', true);
                $(".submit-loader").removeClass('d-none')
                $('#preloader').removeClass('d-none')
            },
            success: function(response) {
                if (response.status === 'success') {
                    toastr.success(response.message);
                    form[0].reset();
                    setTimeout(redirectPage, 1000);

                } else if (response.status == "error") {
                    toastr.warning(response.message)
                }
            },
            error: function(xhr, resp, text) {
                // console.log(xhr)
                // on error, tell the failed
                if (xhr && xhr.responseText) {
                    // $('#preloader').addClass('d-none')
                    let response = JSON.parse(xhr.responseText);
                    if (response.status === 'validate_error') {
                        $('#preloader').addClass('d-none')
                        $(".fa-spin").removeClass('fa-spinner')
                        $.each(response.message, function(index, message) {
                            if (message.field && message.field !== 'global') {
                                $('#' + message.field).addClass('is-invalid');
                                $('#' + message.field + '_label').addClass('text-danger');
                                $('#' + message.field + '_error').html(message.error);
                            } else if (message.error) {
                                // toastr.error(message.error);
                                console.log("err 0")
                            } else {
                                // toastr.error('Something went wrong', 'Please try again after sometime.');
                                console.log("err 1")
                            }
                        });
                    } else if (response.status === 'error') {
                        toastr.error(response.message);
                        console.log("err 2")
                    }
                } else {
                    $('#preloader').addClass('d-none')
                    // toastr.error('Something went wrong', 'Please try again after sometime.');
                    console.log("err 3")
                }
            },
            complete: function(xhr, status) {
                $('#' + btn).prop('disabled', false);
                $('#preloader').addClass('d-none')
                $(".submit-loader").addClass('d-none')
            }
        });

    }

    /**
     * Clear Form Data Error  
     * Clear Form Data Error  
     **/

    function clearError(input) {
        $('#' + input.id).removeClass('is-invalid');
        $('#' + input.id + '_label').removeClass('text-danger');
        $('#' + input.id + '_icon').removeClass('text-danger');
        $('#' + input.id + '_icon_border').removeClass('field-error');
        $('#' + input.id + '_error').html('');
    }

    /**
     * Password Icon Change
     * Password Icon Change
     **/

    $('.incon-off').click(function() {
        $(this).addClass('d-none')
        $('.incon-on').removeClass('d-none')
        $("#password").attr("type", "text")
    })
    $('.incon-on').click(function() {
        $(this).addClass('d-none')
        $('.incon-off').removeClass('d-none')
        $("#password").attr("type", "password")
    })

    /**
     *confirm password Icon Change
     *confirm password Icon Change
     **/

    $('.con-pass-icon-off').click(function() {
        $(this).addClass('d-none')
        $('.con-pass-icon-on').removeClass('d-none')
        $("#confirm_password").attr("type", "text")
    })
    $('.con-pass-icon-on').click(function() {
        $(this).addClass('d-none')
        $('.con-pass-icon-off').removeClass('d-none')
        $("#confirm_password").attr("type", "password")
    })
</script>
@endpush