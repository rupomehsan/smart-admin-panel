@extends('layouts.admin.index')
@section('content')
<!-- BEGIN Page Content -->
<!-- the #js-page-content id is needed for some plugins to initialize -->
<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb justify-content-between align-items-center">
        <div class="d-flex">
            <li class="breadcrumb-item"><a href="javascript:void(0);">SmartAdmin</a></li>
            <li class="breadcrumb-item">Smart Validation</li>
        </div>
    </ol>
    <div class="index-menu border my-3 p-2 d-flex justify-content-between mx-2">

        <div class="search">
            <input type="search" class="form-control" id="search_data" name="search_data">
        </div>
        <div class="dropdown mx-2">
            <button class="btn border border-dark dropdown-toggle d-flex align-items-center" type="button"
                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <iconify-icon icon="akar-icons:filter" style="color: black;margin-right: 5px;" width="20" height="20">
                </iconify-icon>
                Filter
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
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
        <div class="add-item-section"><a href="smart-validation-create" class="btn btn-success">Add New Item</a></div>
    </div>
    <div class="border-top">
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th style="width:10%;">Sl</th>
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

</main>
@endsection
@push("custom-js")
<script src="{{asset('assets/js/toastr.min.js')}}"></script>
<script src="{{asset('validation/apiUrl.js')}}"></script>
<script src="{{asset('validation/smartValidation.js')}}"></script>
<script src="{{asset('assets/js/sweetalert2@11.js')}}"></script>

<script>
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

$(document).on("click", ".search-data", function() {
    let data = $(this).attr("target");
    let url = apiUrl + "get_date_wise_data"
    getDateSearchData(url, data, "data_list", headers, actions)
})
$(document).on("keyup", "#search_data", function() {
    let data = $(this).val();
    let url = apiUrl + "get_search_data"
    getSearchData(url, data, "data_list", headers, actions)
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
</script>
@endpush