@extends('layouts.admin.index')
@section('content')
<!-- BEGIN Page Content -->
<!-- the #js-page-content id is needed for some plugins to initialize -->
<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb justify-content-between align-items-center">
        <div class="d-flex">
            <li class="breadcrumb-item"><a href="javascript:void(0);">SmartAdmin</a></li>
            <li class="breadcrumb-item">(Validation)</li>
            <li class="breadcrumb-item">(Custom crud operation)</li>
        </div>
        <div class="add-item-section"><a href="smart-validation-create" class="btn btn-success">Add New Item</a></div>

    </ol>
    <div class="index-menu border d-flex justify-content-between gap-3 my-3 p-2">

        <div class="search">
            <input type="search" class="form-control" id="search_data" name="search_data">
        </div>
        <div class="dropdown ml-2">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Actions <span class="iconify" data-icon="ic:baseline-arrow-circle-right" data-width="20"
                    data-height="20" data-rotate="90deg"></span>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" onclick="itemActions('active')">Active</a>
                <a class="dropdown-item" onclick="itemActions('deactive')">Deactive</a>
                <a class="dropdown-item" onclick="itemActions('delete')">Delete</a>
            </div>
        </div>
        <div class="dropdown mx-2">
            <!-- <button class="btn border border-dark dropdown-toggle d-flex align-items-center" type="button"
                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <iconify-icon icon="akar-icons:filter" style="color: black;margin-right: 5px;" width="20" height="20">
                </iconify-icon>
                Filter
            </button> -->
            <div class="dropdown-menu form-control" aria-labelledby="dropdownMenuButton">
                <li class="dropdown-item search-data" target="today" href="javascript:void(0)">Today</li>
                <li class="dropdown-item search-data" target="last_day" href="javascript:void(0)"
                    onclick="getSearchData('last_day')">Last
                    Day</li>
                <li class="dropdown-item search-data" target="last_week" href="javascript:void(0)"
                    onclick="getSearchData('last_week')">Last
                    Week</li>
                <li class="dropdown-item search-data" target="last_month" href="javascript:void(0)"
                    onclick="getSearchData('last_month')">Last
                    Month</li>
                <li class="dropdown-item search-data" target="last_year" href="javascript:void(0)"
                    onclick="getSearchData('last_year')">Last
                    Year</li>
            </div>

        </div>

        <div id="reportrange" class="d-flex align-items-center px-2"
            style="background: #fff; cursor: pointer; border: 1px solid #ccc; width: 30%">
            <iconify-icon icon="simple-line-icons:calender"></iconify-icon>
            <input type="datetime" class=" form-control border-0 " id="dateRangePicker" />
            <iconify-icon icon="material-symbols:arrow-drop-down-circle"></iconify-icon>
        </div>
    </div>
    <div id="containerBox">
        <div id="loader">
            <div class="ph-item">
                <div class="ph-col-12">
                    <div class="ph-row">
                        <div class="ph-col-12 big"></div>
                        <br><br>
                    </div>
                    <div class="ph-picture"></div>
                    <div class="ph-picture"></div>
                    <div class="ph-picture"></div>
                </div>
            </div>
        </div>
        <div class="border-top">
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th style="width:10%;"> <input type="checkbox" title="Select all" class="all-checker"> Sl</th>
                        <th style="width:10%;">Firstname</th>
                        <th style="width:10%;">Lastname</th>
                        <th style="width:10%;">Email</th>
                        <th style="width:10%;">Phone</th>
                        <th style="width:10%;">Image</th>
                        <th style="width:10%;">Status</th>
                        <th style="width:30%;">Action</th>
                    </tr>
                </thead>
                <tbody id='data_list'>


                </tbody>
            </table>
            <ul id="paginateNav" class="pagination justify-content-end"></ul>
        </div>
    </div>

</main>
@endsection
@push("custom-js")
<script src="{{asset('assets/js/toastr.min.js')}}"></script>
<script src="{{asset('validation/apiUrl.js')}}"></script>
<script src="{{asset('validation/smartValidation.js')}}"></script>
<script src="{{asset('assets/js/sweetalert2@11.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('assets/js/moment.min.js')}}"></script>
<script src="{{asset('assets/js/daterangepicker.js')}}"></script>
<script>
var checkLIstArray = []
$(document).on("click", ".all-checker", function() {
    if ($(this).prop("checked") === true) {
        $(".checkbox-item").prop('checked', true)
        UpdatecheckList()
    } else {
        $(".checkbox-item").prop('checked', false)
        checkLIstArray = []
    }
    // console.log(checkLIstArray)
})

$(document).on("click", ".checkbox-item", function() {
    if ($(this).prop("checked")) {
        checkLIstArray.push($(this).val())
    } else {
        const index = checkLIstArray.indexOf($(this).val());
        const x = checkLIstArray.splice(index, 1);
    }
    // console.log(checkLIstArray)
})

function UpdatecheckList() {
    var checkItem = document.querySelectorAll('.checkbox-item');
    checkItem.forEach(function(item) {
        if (item.checked) {
            var value = item.value
            checkLIstArray.push(value)
        }
    })
}

function pageRedirect() {
    window.location.href = window.origin + "admin/smart-validation"
}
/**
 *daterangepicker; 
 **/
$(function() {
    var start = moment();
    var end = moment();

    function cb(start, end) {
        $('#dateRangePicker').val(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                    'month')
                .endOf('month')
            ],
            'This Year': [moment().startOf('year'), moment().endOf('year')],
            'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1,
                    'year')
                .endOf('year')
            ],
        }
    }, cb);

    cb(start, end);


});

/**
 * table generator; 
 **/
let url = apiUrl + "smart_validation";
let headers = [{
        title: 'Sl No',
        field: 'id'
    },
    {
        title: 'First Name',
        field: 'first_name'
    },
    {
        title: 'Last Name',
        field: 'last_name'
    },
    {
        title: 'Email',
        field: 'email'
    },
    {
        title: 'Phone',
        field: 'phone'
    },

    {
        title: 'Image',
        field: 'image'
    },
    {
        title: 'Status',
        field: 'status'
    },
    {
        title: 'Action',
        field: 'action'
    },
];

let actions = [{
        label: 'View',
        url: "{{url('/admin/smart-validation-edit/:id')}}"
    },
    {
        label: 'Edit',
        url: "{{url('/admin/smart-validation-edit/:id')}}"
    },
    {
        label: 'Delete',
        url: "{{url('/api/smart_validation/:id')}}"
    }
]

getAllData(url, "data_list", headers, actions);
/**
 *get_date_wise_data; 
 **/
$(document).on("click", ".search-data", function() {
    let data = $(this).attr("target");
    let url = apiUrl + "get_date_wise_data"
    getDateSearchData(url, data, "data_list", headers, actions)
})
/**
 *get_search_data; 
 **/
$(document).on("keyup", "#search_data", function() {
    let data = $(this).val();
    let url = apiUrl + "get_search_data"
    getSearchData(url, data, "data_list", headers, actions)
})
/**
 *get_date_range_wise_data; 
 **/
$(document).on("click", ".ranges ul li", function() {
    let data = $("#dateRangePicker").val();
    let url = apiUrl + "get_date_range_wise_data"
    getDateRangeSearchData(url, data, "data_list", headers, actions)
})
/**
 *get_custom_date_range_wise_data; 
 **/
$(document).on("click", ".applyBtn", function() {
    let data = $("#dateRangePicker").val();
    let url = apiUrl + "get_date_range_wise_data"
    getDateRangeSearchData(url, data, "data_list", headers, actions)
})
/**
 * status controll; 
 **/
$(document).on("change", "#approval", function(e) {
    e.preventDefault();
    var options = {
        closeButton: true,
        debug: false,
        positionClass: "toast-bottom-right",
        onclick: null
    };
    var id = $(this).data('id');
    // alert(id);
    if ($(this).prop('checked')) {
        var properties = 'active'
        // alert(properties)
    } else {
        var properties = 'inactive'
        //  alert(properties)
    }

    $.ajax({
        url: apiUrl + "manage_status_approval",
        type: "POST",
        dataType: "json",
        beforeSend: function() {
            $("#preloader").removeClass('d-none');
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id,
            status: properties,
        },
        success: function(res) {
            if (res.status === "success") {
                toastr.success(res.message);
            }
        },
        error: function(jqXhr, ajaxOptions, thrownError) {
            if (jqXhr.status == 422 && jqXhr.responseJSON.status == "error") {
                toastr.error(jqXhr.responseJSON.message)
            }
        },
        complete: function() {
            $("#preloader").addClass('d-none');
        }
    }); //ajax
});


function itemActions(action) {
    if (checkLIstArray.length === 0) {
        toastr.warning("Please select a item first")
    } else {
        // alert(checkLIstArray.length)
        $.ajax({
            url: apiUrl + "manage_item_actions",
            type: "post",
            dataType: "json",
            beforeSend: function() {
                $("#preloader").removeClass('d-none');
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                actions: action,
                itemList: checkLIstArray
            },
            success: function(res) {
                if (res.status === "success") {
                    toastr.success(res.message);
                    getAllData(url, "data_list", headers, actions);
                }
            },
            error: function(jqXhr, ajaxOptions, thrownError) {
                if (jqXhr.status == 422 && jqXhr.responseJSON.status == "error") {
                    toastr.error(jqXhr.responseJSON.message)
                }
            },
            complete: function() {
                $("#preloader").addClass('d-none');
            }
        }); //ajax
    }
}
</script>
@endpush