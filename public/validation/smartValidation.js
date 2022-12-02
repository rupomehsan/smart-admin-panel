//Global Variable section
//Global Variable section
var editDataCategoryId = ''
var editDataCategoryArray = []
//Global Variable section
//Global Variable section




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
            // $(button.submitButton).prop('disabled', true);
            // $(".submit-loader").removeClass('d-none')
            // $('#preloader').removeClass('d-none')
        },
        success: function(response) {
            if (response.status === 'success') {
                toastr.success(response.message);
                // form[0].reset();
                setTimeout(pageRedirect, 1000);

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
            // $(button.submitButton).prop('disabled', false);
            // $(button.loaderButton).addClass('d-none')
            // $("#preloader").addClass('d-none')
        }
    });

}

function getEditContent(pageId) {
    $.ajax({
        url: apiUrl + "smart_validation/" + pageId,
        dataType: "json",
        method: "get",
        success: function(res) {
            if(res.status==="success"){
                editDataCategoryId = res.data.category_id || '';


                console.log("mydata",editDataCategoryId)
          
                Object.entries(res.data).forEach(function(item){
                    // console.log(item)
                    $("#"+item[0]).val(item[1])
                    //image 
                    //image
                    if (item[0] === "image" && item[1]!=="null") {
                        $('.file-upload-image-edit').attr('src', item[1])
                        $('.file-upload-image').attr('src', item[1])
                         $(".file-upload-content-edit").removeClass("d-none")
                    }
                    if (item[0] === "image_sec" && item[1]!=="null") {
                        $('.file-upload-image-edit-sec').attr('src', item[1])
                        $('.file-upload-image-sec').attr('src', item[1])
                         $(".file-upload-content-edit-sec").removeClass("d-none")
                    }
                    //for editor
                    //for editor
                    if (item[0] === 'description' && item[1]!=="null") {
                        descriptionEditor.setData(item[1])
                    }
                    if (item[0] === 'description2' && item[1]!=="null") {
                        description2Editor.setData(item[1])
                    }

                    //single item
                    //single item
                    if (item[0] === 'single_item' && item[1].length>0) {
                       item[1].forEach(function(data,index){
                          if(index===0){
                            $("."+item[0]).val(data)
                          }else{
                            $("#addSingleItem").append(`
                            <div class="row">
                                <div class="col-md-10">
                                <input type="text"  name="single_item[]" class="form-control mb-1"
                                            placeholder="Add item" onkeyup="clearError(this)" value="${data}">
                                </div>
                                <div class="col-md-2">
                                    <iconify-icon icon="ep:remove-filled" class="mt-2 cursor-pointer remove-item" height="20" width="20">
                                    </iconify-icon>
                                </div>
                            </div>
                        `)
                          }
                       })
                    }

                    //multi item
                    //multi item
                    if (item[0] === 'multi_item' && item[1].length>0) {
                        item[1].forEach(function(data,index){
                           if(index===0){
                             $("."+item[0]+"_one").val(data.one)
                             $("."+item[0]+"_two").val(data.two)
                             $("."+item[0]+"_three").val(data.three)
                           }else{
                                $("#addMultipleItems").append(`
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                    <input type="text" name="multi_item[][one]" class="form-control"
                                                placeholder="Add item one" onkeyup="clearError(this)" value="${data.one}">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text"  name="multi_item[][two]" class="form-control"
                                            placeholder="Add item two" onkeyup="clearError(this)" value="${data.two}">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text"  name="multi_item[][three]" class="form-control"
                                            placeholder="Add item three" onkeyup="clearError(this)" value="${data.three}">
                                    </div>
                                    <div class="col-md-3 text-center">
                                    <iconify-icon icon="ep:remove-filled" class="mt-3 cursor-pointer remove-item" height="20" width="20"
                                        >
                                    </iconify-icon>
                                </div>
                                </div>
                            `)
                           }
                        })
                     }

                    //chips item
                    //chips item

                    if (item[0] === 'chips' && item[1].length>0) {
                        // $("#chips").empty()
                        item[1].forEach(function(data){
                            console.log("chipts",data)
                            $("#chips").append(`
                            <option selected>${data}</option>
                          
                          `)
                        })
                    }
                    //multi select chips item
                    //multi select chips item

                    if (item[0] === 'multi_chips_select' && item[1].length>0) {
                        // $("#chips").empty()
                        item[1].forEach(function(data){
                            $("#multi_chips_select").append(`
                            <option selected>${data}</option>
                          
                          `)
                        })
                    }

                    //multi category selector item
                    //multi category selector item

                    if (item[0] === 'multi_category_selector' && item[1].length>0) {
                       
                        item[1].forEach(function(data){
                            editDataCategoryArray.push(data)
                        })
                     }
                    //multi days item
                    //multi days item
                    if(item[0]==="days" && item[1] !==null){
                        item[1].forEach(function (day){
                            $("#"+day).prop("checked","true")
                        })
                    }
                    //switch  
                    //switch
                    if(item[0]==="switch" && item[1] !==null){
                        if (item[1] === "on") {
                            $(".switch").attr('checked', 'checked');
                        } else {
                            $(".switch").prop('checked', false);
                        }
                    }


                 })
            }
           
        },
        error: function(err) {
            console.log(err)
        }
    })
}


/**
 * Generate Table Data
 */
 function generateTable(id, headers, data, actions = []) {
    let container = document.getElementById(id)
    container.innerHTML = "";
    // console.log("my data",headers)
    data.data.forEach(function (item,index) {
        
        let tableRow = document.createElement('tr')

        headers.forEach((header) => {
            Object.keys(item).forEach((key) => {
                if (key === header.field) {

                    let tableData = document.createElement('td')
                    tableData.innerHTML = item[key]
                    if (key === 'image') {
                        if (item[key] !== null) {
                            console.log("yes")
                            let image = item[key]
                            // console.log("iamgeeeeee", image)
                            let imageDiv = `<div class="sidebar-logo"><img src="${image}" class="" alt="logo.png" height="40" width="70"></div>`
                            let imageTag = document.createElement('div')
                            imageTag.innerHTML = imageDiv
                            tableData.innerHTML=''
                            tableData.appendChild(imageTag)
                        } else {
                            console.log("no")
                            let imageDiv = `<div class="sidebar-logo"><img src="" class="logo-lg" alt="logo.png"></div>`
                            let imageTag = document.createElement('div')
                            imageTag.innerHTML = imageDiv
                            tableData.appendChild(imageTag)
                        }
                    }
                    if (key === 'status') {
                        let div = `<div class="switch"> <label class=""> <input class="form-check-input" ${item[key] === "active" ? 'checked' : ''}  id="approval" data-id="${item.id}" type="checkbox"  > <div class="slider round"></div></label></div>`
                        let status = document.createElement('div')
                        status.innerHTML = div
                        tableData.innerHTML=''
                        tableData.appendChild(status)
                    }
                    if(key==="id"){
                        let sl = index+1
                        let cehkbox = `<input type="checkbox" class="checkbox-item" name="" value="${item.id}"/> ${sl}`
                        tableData.innerHTML=cehkbox
                       
                    }
                    tableRow.appendChild(tableData)
                }
            })

            if (header.field === 'action' && actions.length) {
                let tableData = document.createElement('td')

                actions.forEach((actionItem) => {
                    let actionBtn = document.createElement('button')
                    actionBtn.textContent = actionItem.label

                    if (actionItem.label.toLowerCase() === 'edit') {
                        actionBtn.setAttribute('class', 'btn btn-success mx-1')

                        actionBtn.addEventListener('click', function () {
                            window.location.href = actionItem.url.replace(':id', item.id)
                            // console.log(item.id)
                            // actionItem.url.replace(':id', item.id)
                            // getEditData(actionItem.url.replace(':id', item.id))
                        })
                    } else if (actionItem.label.toLowerCase() === 'delete') {
                        actionBtn.setAttribute('class', 'btn btn-danger')

                        actionBtn.addEventListener('click', function () {
                            deleteItem(actionItem.url.replace(':id', item.id))
                            // console.log(item.id)
                        })
                    }else if (actionItem.label.toLowerCase() === 'view') {
                        actionBtn.setAttribute('class', 'btn btn-primary me-1')
                    }

                    tableData.appendChild(actionBtn)
                })

                tableRow.appendChild(tableData)
            }
        })

        container.appendChild(tableRow)
    })


}

/**
 * GET all Data
 */
function getAllData(url, id, headers, actions = [], searchData = null,) {
    $.ajax({
        type: 'GET',
         url: url, 
        dataType: 'json', 
        success: function (response) {
            if (response.status === 'success') {
                let data = response.data
                generateTable(id, headers, data, actions)
                setPagination(
                    response.data.total,
                    response.data.per_page,
                    response.data.current_page,
                    response.data.next_page_url,
                    response.data.prev_page_url
                );
          
                paginateItemClick(url,id, headers, actions,searchData,'','getall');
            }
        }, error: function (xhr, resp, text) {
            console.log(xhr, resp)
        },
        complete:function(){
            setTimeout(()=>{
                endLoading()
            },1000)
        }
    });
}
/**
 * skelytone loader
 */
function endLoading() {
    $('#loader').fadeOut()
    $('#loader').remove()
}
/**
 * GET date search Data
 */
function getDateSearchData(url,value,id, headers, actions = [], searchData = null,) {

    $.ajax({
        method: "post",
        url: url,
        dataType: "json",
        data: {"value": value},
        success: function (response) {
            if (response.status === 'success') {
                let res = response.data
                generateTable(id, headers, res, actions)
                setPagination(
                    response.data.total,
                    response.data.per_page,
                    response.data.current_page,
                    response.data.next_page_url,
                    response.data.prev_page_url
                );
                paginateItemClick(url,id, headers, actions,searchData,value,'searchDate');
            }
        },
        error: function (err) {
            console.log(err)
        },
    
    });
    }
/**
 * GET date search Data
 */
function getDateRangeSearchData(url,value,id, headers, actions = [], searchData = null,) {

    $.ajax({
        method: "post",
        url: url,
        dataType: "json",
        data: {"value": value},
        success: function (response) {
            if (response.status === 'success') {
                let res = response.data
                generateTable(id, headers, res, actions)
                setPagination(
                    response.data.total,
                    response.data.per_page,
                    response.data.current_page,
                    response.data.next_page_url,
                    response.data.prev_page_url
                );
                paginateItemClick(url,id, headers, actions,searchData,value,'searchDateRange');
            }
        },
        error: function (err) {
            console.log(err)
        },
    
    });
    }
  /**
 * GET  search Data
 */  
function getSearchData(url,value,id, headers, actions = [], searchData = null,) {
    $.ajax({
        method: "post",
        url: url,
        dataType: "json",
        data: {"value": value},
        success: function (response) {
            if (response.status === 'success') {
                let res = response.data
                generateTable(id, headers, res, actions)
                setPagination(
                    response.data.total,
                    response.data.per_page,
                    response.data.current_page,
                    response.data.next_page_url,
                    response.data.prev_page_url
                );
                paginateItemClick(url,id, headers, actions,searchData,value,'searchData');
            }
        },
        error: function (err) {
            console.log(err)
        },
    
    });
    }

        // start
        // pagination
        // start
        function setPagination(totalItem, perPageItem, currentPage,nextPage,prevPage) {
            let pages = Math.ceil(totalItem / perPageItem);
            let nextPageId = nextPage
            let prevPageId = prevPage
            if(prevPageId!==null){
               prevPageId = prevPage.split("=")
                prevPageId= prevPageId[1]
            }
            if(nextPageId!==null){
                nextPageId = nextPage.split("=")
                nextPageId= nextPageId[1]
            }
            $("#paginateNav").empty();
            $("#paginateNav").append(`
               <li class="page-item ${prevPageId===null?"disabled":""}" data-id=${prevPageId}><a class="page-link "  href="javascript:void(0)">Previous</a></li>
            `);
            for (let i = 0; i < pages; i++) {
                $("#paginateNav").append(`
            <li data-id="${i + 1}" class="page-item ${
                    i + 1 === currentPage ? "active" : ""
                }"><a class="page-link" href="javascript:void(0)">${i + 1}</a></li>
             `);
            }
            $("#paginateNav").append(`
               <li class="page-item ${nextPageId===null?"disabled":""}" data-id=${nextPageId}><a class="page-link next-page " href="javascript:void(0)" >Next</a></li>
            `);
        }

        function paginateItemClick(url,id, headers, actions,searchData,value=null,setfunct) {
            let selectPage = 1;
            $(".page-item").click(function () {
                selectPage = "?page="+$(this).attr("data-id");
                var pageUrl = url+selectPage
                var mainpage=  pageUrl.split('?')[0]
                if(selectPage!=="null"){
                    if(setfunct==="getall"){
                        getAllData(mainpage+selectPage,id, headers, actions,searchData)
                    }else if(setfunct==="searchDate"){
                        getDateSearchData(mainpage+selectPage,value,id, headers, actions,searchData)
                    }else if(setfunct==="searchData"){
                        getSearchData(mainpage+selectPage,value,id, headers, actions,searchData)
                    }else if(setfunct==="searchDateRange"){
                        getDateRangeSearchData(mainpage+selectPage,value,id, headers, actions,searchData)
                    }
                   
                }
            });
        }

        // end
        // pagination
        // end


function deleteItem(url) {
    var adminInformation = JSON.parse(localStorage.getItem('adminInfo')) || null
    if (adminInformation && adminInformation.email === "demoadmin@ecommerce.com") {
        toastr.error('Sorry You Are Demo Use')
    } else {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url, type: 'DELETE', dataType: "json", headers: {
                        'Authorization': JSON.parse(localStorage.getItem('adminToken')) || null
                    }, success: function (res) {
                        console.log(res);
                        if(res.status==="success"){
                            Swal.fire('Deleted!', 'Your file has been deleted.', 'success')
                           setTimeout(()=>{
                            pageRedirect()
                           },1000)
                          
                        }
                       

                    }, error: function (xhr, resp, text) {
                        console.log(xhr);
                        // on error, tell the failed
                    },
                });
            }
        })
    }
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
 *file-uploader
 *file-uploader
 **/

$(document).on("change", ".file-uploader", function(e) {
    e.preventDefault();
    var putUrl = ''
    if ($(this).attr("id") === "image") {
        putUrl = "imageUrl"
    }else if($(this).attr("id") === "imageEdit") {
        putUrl = "imageUrl"
    }
    else {
        putUrl = "imageUrlSec"
    }
    // console.log("put", putUrl)
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
            // console.log("rupo", $(this).attr("id"))
            $("#" + putUrl).val(res.data);

        },
        error: function(jqXhr, ajaxOptions, thrownError) {
            if (jqXhr.status == 422) {
                var errorsHtml = '';
                var errors = jqXhr.responseJSON.message;
                $.each(errors, function(key, value) {
                    errorsHtml += '<li>' + value + '</li>';
                });
                toastr.error(errorsHtml, jqXhr.responseJSON.heading, options);
            } else if (jqXhr.status == 404) {
                toastr.error(jqXhr.responseJSON.message, '', options);
            } else {
                toastr.error('Error', 'Something went wrong', options);
            }
        }
    });
});

// Start:: 1 image upload & drag
// Start:: 1 image upload & drag
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
// End:: 1 image upload & drag
// End:: 1 image upload & drag

// Start:: 1 Edit image upload & drag
// Start:: 1 Edit image upload & drag
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
// End::1 Edit image upload & drag
// End::1 Edit image upload & drag

// Start::  Second image upload & drag
// Start::  Second image upload & drag
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
// End:: Second image upload & drag

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
