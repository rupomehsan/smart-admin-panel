@extends('layouts.admin.index')
@section('content')
<!-- BEGIN Page Content -->
<!-- the #js-page-content id is needed for some plugins to initialize -->
<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">SmartAdmin</a></li>
        <li class="breadcrumb-item">Smart Validation</li>
    </ol>
    <div class="border-top">
        <form method="post" id="formSubmit" enctype="multipart/form-data" novalidate>
            <div class="row my-5">
                <div class="col-6">
                    <div class="form-group mb-3">
                        <label for="host" id="host_label" class="form-label">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="form-control" placeholder="Enter First Name" onkeyup="clearError(this)">
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
                    <div class="form-group mb-3">
                        <label for="host" id="host_label" class="form-label"><sup class="required">*</sup>Date time
                            Picker :
                        </label>
                        <input id="date_time" name="date_time" class=" form-control" placeholder="Pick a date" />
                        <span class="text-danger" id="date_time_error"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="host" id="host_label" class="form-label"><sup class="required">*</sup>Date picker :
                        </label>
                        <input id="date" name="date" class=" form-control" placeholder="Pick a date" />
                        <span class="text-danger" id="date_error"></span>
                    </div>
                    <div class="form-group">
                        <input type="text" onMouseOver="(this.type='datetime-local')" id="start_time" name="start_time" onMouseOut="(this.type='text')" class="form-control" placeholder="Start Time">
                        <span class="text-danger text-capitalize" id="start_time_error"></span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row align-items-center">
                        <div class="col-md-10">
                            <div class="form-group mb-3">
                                <label for="host" id="host_label" class="form-label">Add Single Item</label>
                                <input type="text" id="single_item" name="single_item[]" class="form-control" placeholder="Add item" onkeyup="clearError(this)">
                                <span class="text-danger" id="single_item_error"></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <iconify-icon icon="carbon:add-filled" class="mt-3 cursor-pointer" height="20" width="20" id="addItem">
                            </iconify-icon>
                        </div>
                    </div>
                    <div id="addSingleItem"></div>

                    <div class="row align-items-center justify-content-between">
                        <div class="col-md-3">
                            <label for="host" id="host_label" class="form-label">Add Multiple Item</label>
                            <div class="form-group mb-3">
                                <input type="text" id="multi_item" name="multi_item[]" class="form-control" placeholder="Add item" onkeyup="clearError(this)">
                                <span class="text-danger" id="multi_item_error"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <input type="text" id="first_name" name="multi_item[]" class="form-control mt-2" placeholder="Add item" onkeyup="clearError(this)">
                        </div>
                        <div class="col-md-3">
                            <input type="text" id="first_name" name="multi_item[]" class="form-control mt-2" placeholder="Add item" onkeyup="clearError(this)">
                        </div>
                        <div class="col-md-3 text-center">
                            <iconify-icon icon="carbon:add-filled" class="mt-3 cursor-pointer" height="20" width="20" id="addItems">
                            </iconify-icon>
                        </div>
                    </div>

                    <div id="addMultipleItems"></div>
                    <div class="form-group mb-3 ">
                        <label for="host" id="host_label" class="form-label"><sup class="required">*</sup>Color :
                        </label>
                        <input type="color" id="color" name="color" class="mx-5" placeholder="Select color" onkeyup="clearError(this)">
                        <span class="text-danger" id="color_error"></span>
                    </div>

                    <div class="">
                        <label for="host" id="host_label" class="form-label "><sup class="required">*</sup>Checked/Unchecked :
                        </label>
                        <label class="switch mx-5">
                            <input type="checkbox" id="switch" name="switch" checked>
                            <span class="slider round"></span>
                        </label>
                        <span class="text-danger" id="color_error"></span>
                    </div>
                    <div class=" mb-3">
                        <label for="host" id="host_label" class="form-label "><sup class="required">*</sup>Multiple
                            Select
                        </label>
                        <select class="js-example-basic-multiple  form-control" id="multi_select" name="multi_select[]" multiple="multiple">
                            <option value='' disabled>Select item</option>
                            <option value="AL">Alabama</option>
                            <option value="AL">Alabama</option>
                            <option value="AL">Alabama</option>
                            <option value="AL">Alabama</option>
                            <option value="AL">Alabama</option>

                        </select>
                        <span class="text-danger" id="multi_select_error"></span>
                    </div>

                    <div class="form-group mb-5">
                        <label for="host" id="host_label" class="form-label">
                            Category <sup class="required">*</sup></label>
                        <br>
                        <!-- Dropdown -->
                        <select id='category_id' name="category_id" style='width: 200px;' class="form-control">
                            <option value='' selected disabled>Select Category</option>
                            <option value="rupom">rupom</option>
                            <option value="ehsan">ehsan</option>
                            <option value="nira">nira</option>

                        </select>
                        <br>
                        <span class="text-danger" id="category_id_error"></span>
                    </div>
                    <div class="form-group mb-5">
                        <label for="host" id="host_label" class="form-label">
                            Chips <sup class="required">*</sup></label>
                        <select class="form-control js-example-tags" id="chips" name="chips[]" multiple="multiple">
                            <option selected="selected">orange</option>
                            <option>white</option>
                            <option selected="selected">purple</option>
                        </select>
                        <span class="text-danger" id="chips_error"></span>
                    </div>
                    <div class="form-group mb-5">
                        <label for="host" id="host_label" class="form-label">
                            Multi selector <sup class="required">*</sup></label> <br>
                        <select multiple="multiple" name="multi_selector[]" id="multi_selector" class="select-product form-control  testselect2" tabindex="-1">
                            <option value="22">Et recusandae enim provident soluta.</option>
                            <option value="50">Omnis officiis omnis asperiores ea ipsum quos ut m...</option>
                            <option value="40">Dignissimos iure non assumenda ad voluptates non.</option>
                            <option value="38">Unde unde consequatur exercitationem omnis beatae...</option>
                            <option value="38">Unde unde consequatur exercitationem omnis beatae...</option>
                            <option value="38">Unde unde consequatur exercitationem omnis beatae...</option>
                        </select>
                        <span class="text-danger" id="multi_selector_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Day :</label>
                        <div class="weekDays-selector">
                            <input type="checkbox" id="sunday" name="days[]" class="weekday" value="sunday" />
                            <label for="sunday">Sunday</label>
                            <input type="checkbox" id="monday" name="days[]" class="weekday" value="monday" />
                            <label for="monday">Monday</label>
                            <input type="checkbox" id="tuesday" name="days[]" class="weekday" value="tuesday" />
                            <label for="tuesday">Tuesday</label>
                            <input type="checkbox" id="wednesday" name="days[]" class="weekday" value="wednesday" />
                            <label for="wednesday">Wednesday</label>
                            <input type="checkbox" id="thursday" name="days[]" class="weekday" value="thursday" />
                            <label for="thursday">Thursday</label>
                            <input type="checkbox" id="friday" name="days[]" class="weekday" value="friday" />
                            <label for="friday">Friday</label>
                            <input type="checkbox" id="saturday" name="days[]" class="weekday" value="saturday" />
                            <label for="saturday">Saturday</label>
                        </div>
                        <span class="text-danger text-capitalize" id="days_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="image" class="mb-2">Image * </label> <br>
                        <div class="file-upload">
                            <div class="image-upload-wrap">
                                <input type="hidden" name="image" id="imageUrl">
                                <input id="image" class="file-upload-input file-uploader" type='file' onchange="readURL(this);" accept="image/*" />
                                <div class="drag-text text-center">
                                    <iconify-icon icon="ri:file-user-line" class="icon-property mt-3" height="40" width="40">
                                    </iconify-icon>
                                    <span>Upload Image Or Drag Here</span>
                                </div>
                            </div>
                            <div id="tounamentImage" style="position: relative">

                            </div>
                            <div class="file-upload-content">
                                <img class="file-upload-image" src="#" alt="your image" />
                                <div class="image-title-wrap">
                                    <button type="button" onclick="removeUpload()" class="remove-image">
                                        <iconify-icon icon="clarity:remove-line" class="mt-1" height="20" width="20">
                                        </iconify-icon>
                                    </button>
                                </div>
                            </div>

                        </div>
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
<script src="{{asset('validation/jquery.serializejson.min.js')}}"></script>
<script src="{{asset('assets/js/toastr.min.js')}}"></script>
<script src="{{asset('validation/apiUrl.js')}}"></script>
<!-- Datetime-picker -->
<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
<!-- multi selector -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{asset('assets/js/jquery.sumoselect.min.js')}}"></script>
<script>
    // Start:: image upload & drag
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(".image-upload-wrap").hide();
                $(".file-upload-image").attr("src", e.target.result);
                $(".file-upload-content").show();
                $(".image-title").html(input.files[0].name);
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            removeUpload();
        }
    }

    function removeUpload() {
        $(".file-upload-input").replaceWith($(".file-upload-input").clone());
        $(".file-upload-input").val(null);
        $(".file-upload-content").hide();
        $(".image-upload-wrap").show();
    }
    $(".image-upload-wrap").bind("dragover", function() {
        $(".image-upload-wrap").addClass("image-dropping");
    });
    $(".image-upload-wrap").bind("dragleave", function() {
        $(".image-upload-wrap").removeClass("image-dropping");
    });
    // End:: image upload & drag

    // Start:: Second image upload & drag
    function readURLSec(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(".image-upload-wrap-sec").hide();
                $(".file-upload-image-sec").attr("src", e.target.result);
                $(".file-upload-content-sec").show();
                $(".image-title-sec").html(input.files[0].name);
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            removeUpload();
        }
    }

    function removeUploadSec() {
        $(".file-upload-input-sec").replaceWith(
            $(".file-upload-input-sec").clone()
        );
        $(".file-upload-input-sec").val(null);
        $(".file-upload-content-sec").hide();
        $(".image-upload-wrap-sec").show();
    }
    $(".image-upload-wrap-sec").bind("dragover", function() {
        $(".image-upload-wrap-sec").addClass("image-dropping-sec");
    });
    $(".image-upload-wrap-sec").bind("dragleave", function() {
        $(".image-upload-wrap-sec").removeClass("image-dropping-sec");
    });
    // End:: Second image upload & drag

    // Start::Edit image upload & drag
    function readURLEdit(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(".image-upload-wrap-edit").hide();
                $(".file-upload-image-edit").attr("src", e.target.result);
                $(".file-upload-content-edit").show();
                $(".image-title-edit").html(input.files[0].name);
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            removeUpload();
        }
    }

    function removeUploadEdit() {
        $(".file-upload-input-edit").replaceWith(
            $(".file-upload-input-edit").clone()
        );
        $(".file-upload-input-edit").val(null);
        $(".file-upload-content-edit").hide();
        $(".image-upload-wrap-edit").show();
    }
    $(".image-upload-wrap-edit").bind("dragover", function() {
        $(".image-upload-wrap-edit").addClass("image-dropping-edit");
    });
    $(".image-upload-wrap-edit").bind("dragleave", function() {
        $(".image-upload-wrap-edit").removeClass("image-dropping-edit");
    });
    // End::Edit image upload & drag

    // Start:: Sec Edit image upload & drag
    function readURLEditSec(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(".image-upload-wrap-edit-sec").hide();
                $(".file-upload-image-edit-sec").attr("src", e.target.result);
                $(".file-upload-content-edit-sec").show();
                $(".image-title-edit-sec").html(input.files[0].name);
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            removeUpload();
        }
    }

    function removeUploadEditSec() {
        $(".file-upload-input-edit-sec").replaceWith(
            $(".file-upload-input-edit-sec").clone()
        );
        $(".file-upload-input-edit-sec").val(null);
        $(".file-upload-content-edit-sec").hide();
        $(".image-upload-wrap-edit-sec").show();
    }
    $(".image-upload-wrap-edit-sec").bind("dragover", function() {
        $(".image-upload-wrap-edit-sec").addClass("image-dropping-edit-sec");
    });
    $(".image-upload-wrap-edit-sec").bind("dragleave", function() {
        $(".image-upload-wrap-edit-sec").removeClass("image-dropping-edit-sec");
    });
    // End::Sec Edit image upload & drag
</script>
<script>
    /**
     * datetimepicker  
     **/
    $('#date_time').datetimepicker({
        footer: true,
        modal: true
    });
    $('#date').datepicker({
        footer: true,
        modal: true
    });
    /**
     * selector  
     **/
    $(document).ready(function() {
        /**
         * Multiple Select  Chips
         **/
        $('.js-example-basic-multiple').select2();
        /**
         * Single Select  
         **/
        $("#category_id").select2();
        /**
         * Chips  Select  
         **/
        $(".js-example-tags").select2({
            tags: true
        });
        /**
         * Multiple Selector
         **/
        $('.testselect2').SumoSelect({
            placeholder: 'This is a placeholder'
        });
    });

    /**
     * Submit Form Data  
     * Submit Form Data  
     **/
    $('#formSubmit').submit(function(e) {
        e.preventDefault();
        let form = $(this);
        let method = form.attr("method")
        let url = apiUrl + "smart_validation";
        let headers = {
            "Authorization": localStorage.getItem("token") || ""
        }
        let button = {
            "submitButton": "#submit-button",
            "loaderButton": ".submit-loader",
        }
        formSubmit(url, method, form, button, headers);
    })

    function formSubmit(url, method, form, button, headers = null) {
        let form_data = JSON.stringify(form.serializeJSON());
        let formData = JSON.parse(form_data);
        $.ajax({
            method: method,
            url: url,
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $(button.submitButton).prop('disabled', true);
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
                console.log(xhr)
                if (xhr && xhr.responseText) {

                    let response = JSON.parse(xhr.responseText);
                    if (response.status === 'validate_error') {
                        $.each(response.message, function(index, message) {
                            $('#' + message.field).addClass('is-invalid');
                            $('#' + message.field + '_label').addClass('text-danger');
                            $('#' + message.field + '_error').html(message.error);
                        });
                    } else if (response.status === 'error') {
                        toastr.error(response.message);
                    }
                } else {
                    toastr.error('Something went wrong', 'Please try again after sometime.');
                    console.log("err 3")
                }
            },
            complete: function(xhr, status) {
                $(button.submitButton).prop('disabled', false);
                $(button.loaderButton).addClass('d-none')
                $("#preloader").addClass('d-none')
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


    /**
     *add Single Item
     *add Single Item
     **/


    $(document).on("click", "#addItem", function() {

        $("#addSingleItem").append(`
        <div class="row">
            <div class="col-md-10">
            <input type="text"  name="sigle_item[]" class="form-control mb-1"
                        placeholder="Add item" onkeyup="clearError(this)">
            </div>
            <div class="col-md-2">
                <iconify-icon icon="ep:remove-filled" class="mt-2 cursor-pointer remove-item" height="20" width="20">
                </iconify-icon>
            </div>
        </div>
    `)

    })

    /**
     *add Multiple Items
     *add Multiple Items
     **/


    $(document).on("click", "#addItems", function() {

        $("#addMultipleItems").append(`
        <div class="row align-items-center">
            <div class="col-md-3">
            <input type="text" id="first_name" name="first_name" class="form-control"
                        placeholder="Add item" onkeyup="clearError(this)">
            </div>
            <div class="col-md-3">
                <input type="text" id="first_name" name="first_name" class="form-control"
                    placeholder="Add item" onkeyup="clearError(this)">
            </div>
            <div class="col-md-3">
                <input type="text" id="first_name" name="first_name" class="form-control"
                    placeholder="Add item" onkeyup="clearError(this)">
            </div>
            <div class="col-md-3 text-center">
                <iconify-icon icon="ep:remove-filled" class="mt-3 cursor-pointer" height="20" width="20"
                    id="addItems">
                </iconify-icon>
            </div>
        </div>
    `)

    })
    /**
     *remove-item
     *remove-item
     **/
    $(document).on("click", ".remove-item", function() {
        $(this).parent().parent().remove()
    })

    /**
     *file-uploader
     *file-uploader
     **/

    $(document).on("change", ".file-uploader", function(e) {
        e.preventDefault();
        var file = e.target.files[0];
        let formData = new FormData()
        formData.append('file', file);
        formData.append('folder', 'validation');
        var showurl = apiUrl + 'file-upload';
        var options = {
            closeButton: true,
            debug: false,
            positionClass: "toast-bottom-right",
            onclick: null
        };


        $("#preloader").removeClass('d-none');
        $.ajax({
            url: showurl,
            type: 'POST',
            dataType: "json",
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Authorization': localStorage.getItem('token'),
            },
            data: formData,
            success: function(res) {
                toastr.success('File Upload successfully');
                $("#imageUrl").val(res.data);
                $("#preloader").addClass('d-none');
            },
            error: function(jqXhr, ajaxOptions, thrownError) {
                if (jqXhr.status == 422) {
                    $("#preloader").addClass('d-none');
                    var errorsHtml = '';
                    var errors = jqXhr.responseJSON.message;
                    $.each(errors, function(key, value) {
                        errorsHtml += '<li>' + value + '</li>';
                    });
                    toastr.error(errorsHtml, jqXhr.responseJSON.heading, options);
                } else if (jqXhr.status == 404) {
                    toastr.error(jqXhr.responseJSON.message, '', options);
                    $("#preloader").addClass('d-none');
                } else {
                    toastr.error('Error', 'Something went wrong', options);
                    $("#preloader").addClass('d-none');
                }
            }
        });
    });
</script>
@endpush