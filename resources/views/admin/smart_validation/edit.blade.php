@extends('layouts.admin.index')
@section('content')
<!-- BEGIN Page Content -->
<!-- the #js-page-content id is needed for some plugins to initialize -->
<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb justify-content-between align-items-center">
        <div class="d-flex">
            <li class="breadcrumb-item"><a href="javascript:void(0);">SmartAdmin</a></li>
            <li class="breadcrumb-item">Smart Validation</li>
            <li class="breadcrumb-item">Edit</li>
        </div>
        <div><a href="{{url('admin/smart-validation')}}" class="btn btn-success">All Items</a></div>
    </ol>
    <div class="border-top">
        <form method="patch" id="formSubmit" enctype="multipart/form-data" novalidate>
            <div class="row my-5">
                <div class="col-6">
                    <div class="form-group mb-3">
                        <label for="host" id="host_label" class="form-label">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="form-control"
                            placeholder="Enter First Name" onkeyup="clearError(this)">
                        <span class="text-danger" id="first_name_error"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="host" id="host_label" class="form-label">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="form-control"
                            placeholder="Enter Last Name" onkeyup="clearError(this)">
                        <span class="text-danger" id="last_name_error"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="host" id="host_label" class="form-label"><sup class="required">*</sup>Phone</label>
                        <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter Phone"
                            onkeyup="clearError(this)">
                        <span class="text-danger" id="phone_error"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="host" id="host_label" class="form-label">Address</label>
                        <input type="text" id="address" name="address" class="form-control" placeholder="Enter Address"
                            onkeyup="clearError(this)">
                        <span class="text-danger" id="address_error"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="host" id="host_label" class="form-label"><sup class="required">*</sup>Email</label>
                        <input type="text" id="email" name="email" class="form-control" placeholder="Enter Email"
                            onkeyup="clearError(this)">
                        <span class="text-danger" id="email_error"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="host" id="host_label" class="form-label"><sup
                                class="required">*</sup>Password</label>
                        <div class="password-hide-show" style="position: relative;">
                            <iconify-icon icon="ion:eye" height="20" width="20" class="incon-on d-none"
                                onclick="iconChange()" style="position:absolute;right:10px;top:10px;cursor:pointer;">
                            </iconify-icon>
                            <iconify-icon icon="ion:eye-off" class="incon-off" onclick="iconChange()" height="20"
                                width="20" style="position:absolute;right:10px;top:10px;cursor:pointer;">
                            </iconify-icon>
                        </div>
                        <input type="password" id="password" name="password" class="form-control"
                            placeholder="Enter Password" onkeyup="clearError(this)">

                        <span class="text-danger" id="password_error"></span>
                    </div>

                    <div class="form-group mb-3">
                        <label for="host" id="host_label" class="form-label"><sup class="required">*</sup>Date time
                            Picker :
                        </label>
                        <input id="date_time" name="date_time" class="form-control" onkeyup="clearError(this)"
                            placeholder="Pick a date" />
                        <span class="text-danger" id="date_time_error"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="host" id="host_label" class="form-label"><sup class="required">*</sup>Date picker :
                        </label>
                        <input id="date" name="date" class="  form-control" onkeyup="clearError(this)"
                            placeholder="Pick a date" />
                        <span class="text-danger" id="date_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="host" id="host_label" class="form-label"><sup class="required">*</sup>Date time
                            hober picker :
                        </label>
                        <input type="text" onMouseOver="(this.type='datetime-local')" id="start_time" name="start_time"
                            onMouseOut="(this.type='text')" class="form-control" placeholder="Start Time">
                        <span class="text-danger text-capitalize" id="start_time_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="host" id="host_label" class="form-label"><sup class="required">*</sup>Descriptions :
                        </label>
                        <textarea class="form-control create-form" onkeyup="clearError(this)" id="content"
                            name="description" rows="10" placeholder="Write Here Description"></textarea>
                        <span class="text-danger text-capitalize" id="description_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="host" id="host_label" class="form-label"><sup class="required">*</sup>Descriptions 2
                            :
                        </label>
                        <textarea class="form-control create-form" onkeyup="clearError(this)" id="content2"
                            name="description2" rows="10" placeholder="Write Here Description2"></textarea>
                        <span class="text-danger text-capitalize" id="description2_error"></span>
                    </div>

                </div>
                <div class="col-6">
                    <div class="row align-items-center">
                        <div class="col-md-10">
                            <div class="form-group mb-3">
                                <label for="host" id="host_label" class="form-label">Add Single Item</label>
                                <input type="text" name="single_item[]" class="form-control single_item"
                                    placeholder="Add item" onkeyup="clearError(this)">
                                <span class="text-danger" id="single_item_error"></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <iconify-icon icon="carbon:add-filled" class="mt-3 cursor-pointer" height="20" width="20"
                                id="addItem">
                            </iconify-icon>
                        </div>
                    </div>
                    <div id="addSingleItem"></div>

                    <div class="row align-items-center justify-content-between">
                        <div class="col-md-3">
                            <label for="host" id="host_label" class="form-label">Add Multiple Item</label>
                            <div class="form-group mb-3">
                                <input type="text" name="multi_item[][one]" class="form-control multi_item_one"
                                    placeholder="Add item one" onkeyup="clearError(this)">
                                <span class="text-danger" id="multi_item_error"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="multi_item[][two]" class="form-control mt-2 multi_item_two"
                                placeholder="Add item two" onkeyup="clearError(this)">
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="multi_item[][three]" class="form-control mt-2 multi_item_three"
                                placeholder="Add item three" onkeyup="clearError(this)">
                        </div>
                        <div class="col-md-3 text-center">
                            <iconify-icon icon="carbon:add-filled" class="mt-3 cursor-pointer" height="20" width="20"
                                id="addItems">
                            </iconify-icon>
                        </div>
                    </div>

                    <div id="addMultipleItems"></div>
                    <div class="form-group mb-5">
                        <label for="host" id="host_label" class="form-label">
                            Chips <sup class="required">*</sup></label>
                        <select class="form-control js-example-tags" id="chips" name="chips[]" multiple="multiple">

                        </select>
                        <span class="text-danger" id="chips_error"></span>
                    </div>
                    <div class=" mb-3">
                        <label for="host" id="host_label" class="form-label my-1"><sup class="required">*</sup>Multiple
                            Chip Selector
                        </label>
                        <select class="js-example-basic-multiple  form-control" id="multi_chips_select"
                            name="multi_chips_select[]" multiple="multiple">
                        </select>
                        <span class="text-danger" id="multi_chips_select_error"></span>
                    </div>

                    <div class="form-group mb-5">
                        <label for="host" id="host_label" class="form-label">
                            Category <sup class="required">*</sup></label>
                        <br>
                        <!-- Dropdown -->
                        <select id='category_id' name="category_id" style='width: 200px;' class="form-control">
                            <option value='' selected disabled>Select Category</option>

                        </select>
                        <br>
                        <span class="text-danger" id="category_id_error"></span>
                    </div>

                    <div class="form-group mb-5">
                        <label for="host" id="host_label" class="form-label">
                            Multi category selector <sup class="required">*</sup></label> <br>
                        <select multiple="multiple" name="multi_category_selector[]" id="multi_category_selector"
                            class="select-product form-control  testselect2" tabindex="-1">

                        </select>
                        <span class="text-danger" id="multi_category_selector_error"></span>
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
                    <label for="">Image uploader</label>
                    <div class="d-flex justify-content-between align-items-center my-3">
                        <div class="file-upload-edit">
                            <div class="image-upload-wrap-edit">
                                <input type="hidden" name="image" id="imageUrl">
                                <input id="imageEdit" name="image" class="file-upload-input-edit file-uploader"
                                    type='file' onchange="readURLEdit(this);" accept="image/*" />
                                <div class="drag-text-edit text-center">
                                    <iconify-icon icon="ri:file-user-line" class="icon-property mt-3" height="40"
                                        width="40">
                                    </iconify-icon> <br>
                                    <span>Upload Image Or Drag Here</span>
                                </div>
                            </div>
                            <div class="file-upload-content-edit">
                                <img class="file-upload-image-edit" src="" alt="" />

                                <button type="button" onclick="removeUploadEdit()" class="remove-image-edit">
                                    <iconify-icon icon="clarity:remove-line" class="mt-1" height="20" width="20">
                                    </iconify-icon>
                                </button>

                            </div>
                        </div>
                        <div class="file-upload-edit-sec">
                            <div class="image-upload-wrap-edit-sec">
                                <input type="hidden" name="image_sec" id="imageUrlSec">
                                <input value="" name="image" class="file-upload-input-edit-sec file-uploader"
                                    type='file' onchange="readURLEditSec(this);" accept="image/*" />
                                <div class="drag-text-edit-sec text-center">
                                    <iconify-icon icon="ri:file-user-line" class="icon-property mt-3" height="40"
                                        width="40">
                                    </iconify-icon> <br>
                                    <span>Upload Image Or Drag Here</span>
                                </div>
                            </div>
                            <div class="file-upload-content-edit-sec">
                                <img class="file-upload-image-edit-sec" src="" alt="" />

                                <button type="button" onclick="removeUploadEditSec()" class="remove-image-edit-sec">
                                    <iconify-icon icon="clarity:remove-line" class="mt-1" height="20" width="20">
                                    </iconify-icon>
                                </button>

                            </div>
                        </div>
                    </div>


                    <div class="form-group mb-3 ">
                        <label for="host" id="host_label" class="form-label"><sup class="required">*</sup>Color :
                        </label>
                        <input type="color" id="color" name="color" class=" form-control" placeholder="Select color"
                            onkeyup="clearError(this)">
                        <span class="text-danger" id="color_error"></span>
                    </div>

                    <div class="">
                        <label for="host" id="host_label" class="form-label "><sup
                                class="required">*</sup>Checked/Unchecked :
                        </label>
                        <label class="switch mx-5">
                            <input type="checkbox" name="switch" class="switch">
                            <span class="slider round"></span>
                        </label>
                        <span class="text-danger" id="color_error"></span>
                    </div>
                </div>
            </div>
            <div class="text-end">
                <button id="submit-button" type="submit"
                    class="btn btn-success border d-flex align-item-center justify-contetn-bitween ">
                    Update <iconify-icon icon="eos-icons:bubble-loading" height="20" width="20"
                        class="mx-3 d-none submit-loader">
                    </iconify-icon>
                </button>
            </div>
        </form>
    </div>

</main>
@endsection
@push("custom-js")
<!-- form data serialization -->
<script src="{{asset('validation/jquery.serializejson.min.js')}}"></script>
<!--toast message -->
<script src="{{asset('assets/js/toastr.min.js')}}"></script>
<!-- all api url file -->
<script src="{{asset('validation/apiUrl.js')}}"></script>
<!-- Datetime-picker -->
<script src="{{asset('assets/js/gijgo.min.js')}}" type="text/javascript"></script>
<!-- multi selector -->
<script src="{{asset('assets/js/select2.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.sumoselect.min.js')}}"></script>
<!-- CKEditor -->
<script src="{{asset('assets/js/ckeditor.js')}}"></script>
<!-- validation root file -->
<script src="{{asset('validation/smartValidation.js')}}"></script>

<script>
/**
 * ClassicEditor  
 **/
let descriptionEditor;
ClassicEditor.create(document.querySelector('#content'))
    .then(editor => {
        window.editor = editor;
        descriptionEditor = editor;
    });
let description2Editor;
ClassicEditor.create(document.querySelector('#content2'))
    .then(editor => {
        window.editor = editor;
        description2Editor = editor;
    });
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



var pageId = "{{request()->segment(3)}}"
getEditContent(pageId)


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


/**
 * GET All category
 * **/
$(document).ready(function() {
    $.ajax({
        url: "https://ecommerce.ccninfotech.com/api/v1/get_all_category",
        type: 'GET',
        dataType: "json",

        success: function(res) {
            if (res.data.length > 0) {
                $('#category_id').empty()
                $('#category_id').append(`
                          <option value='' selected disabled>Select Category</option>
                        `)
                res.data.forEach(function(item) {
                    $('#category_id').append(`
                          <option ${(item.id === Number(editDataCategoryId) ? 'selected' : '')} value='${item.id}'>${item.name}</option>
                        `)
                })
            }
            // setTimeout(location.reload.bind(location), 1000);
        },
        error: function(xhr, resp, text) {
            console.log(xhr);
            // on error, tell the failed
        },
    });

    $.ajax({
        url: "https://ecommerce.ccninfotech.com/api/v1/get_all_category",
        type: 'GET',
        dataType: "json",
        success: function(res) {
            if (res.data.length > 0) {
                res.data.forEach(function(item) {
                    $('#chips').append(`
                          <option value='${item.name}'>${item.name}</option>
                        `)
                })
            }
            // setTimeout(location.reload.bind(location), 1000);
        },
        error: function(xhr, resp, text) {
            console.log(xhr);
            // on error, tell the failed
        },
    });



    $.ajax({
        url: "https://ecommerce.ccninfotech.com/api/v1/get_all_category",
        type: 'GET',
        dataType: "json",
        success: function(res) {
            if (res.data.length > 0) {
                res.data.forEach(function(item) {
                    $('#multi_chips_select').append(`
                          <option value='${item.id}'>${item.name}</option>
                        `)
                })

            }
            // setTimeout(location.reload.bind(location), 1000);
        },
        error: function(xhr, resp, text) {
            console.log(xhr);
            // on error, tell the failed
        },
    });


    $.ajax({
        url: "https://ecommerce.ccninfotech.com/api/v1/get_all_category",
        type: 'GET',
        dataType: "json",
        success: function(res) {
            if (res.data.length > 0) {

                // console.log(editDataCategoryArray)
                res.data.forEach(function(item) {
                    let selected = false
                    editDataCategoryArray.forEach((pItem) => {
                        if (pItem === item.id.toString()) {
                            selected = true
                        }
                    })
                    $('#multi_category_selector').append(`
                          <option ${selected ? 'selected': ''} value='${item.id}'>${item.name}</option>
                        `)
                })
                $('.testselect2').SumoSelect({
                    placeholder: 'This is a placeholder'
                });
            }
            // setTimeout(location.reload.bind(location), 1000);
        },
        error: function(xhr, resp, text) {
            console.log(xhr);
            // on error, tell the failed
        },
    });
})




/**
 * Submit Form Data  
 * Submit Form Data  
 **/
$('#formSubmit').submit(function(e) {
    e.preventDefault();
    let form = $(this);
    let method = form.attr("method")
    let url = apiUrl + "smart_validation/" + pageId;
    let headers = {
        "Authorization": localStorage.getItem("token") || ""
    }
    let button = {
        "submitButton": "#submit-button",
        // "loaderButton": ".submit-loader",
    }
    formSubmit(url, method, form, button, headers);
})


/**
 *add Single Item
 *add Single Item
 **/


$(document).on("click", "#addItem", function() {

    $("#addSingleItem").append(`
        <div class="row">
            <div class="col-md-10">
            <input type="text"  name="single_item[]" class="form-control mb-1"
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
        <div class="row align-items-center item-wrapper">
            <div class="col-md-3">
            <input type="text" name="multi_item[][one]" class="form-control"
                        placeholder="Add item one" onkeyup="clearError(this)">
            </div>
            <div class="col-md-3">
                <input type="text"  name="multi_item[][two]" class="form-control"
                    placeholder="Add item two" onkeyup="clearError(this)">
            </div>
            <div class="col-md-3">
                <input type="text"  name="multi_item[][three]" class="form-control"
                    placeholder="Add item three" onkeyup="clearError(this)">
            </div>
            <div class="col-md-3 text-center">
                <iconify-icon icon="ep:remove-filled" class="mt-3 cursor-pointer remove-item" height="20" width="20"
                    >
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
</script>
@endpush