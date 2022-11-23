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
            <input type="search" class="form-control" id="gsearch" name="gsearch">
        </div>
        <div class="dropdown mx-2">
            <button class="btn border border-dark dropdown-toggle d-flex align-items-center" type="button"
                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <iconify-icon icon="akar-icons:filter" style="color: black;margin-right: 5px;" width="20" height="20">
                </iconify-icon>
                Filter
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="javascript:void(0)"
                    onclick="if (!window.__cfRLUnblockHandlers) return false; getSearchData('today')">Today</a>
                <a class="dropdown-item" href="javascript:void(0)"
                    onclick="if (!window.__cfRLUnblockHandlers) return false; getSearchData('last_day')">Last
                    Day</a>
                <a class="dropdown-item" href="javascript:void(0)"
                    onclick="if (!window.__cfRLUnblockHandlers) return false; getSearchData('last_week')">Last
                    Week</a>
                <a class="dropdown-item" href="javascript:void(0)"
                    onclick="if (!window.__cfRLUnblockHandlers) return false; getSearchData('last_month')">Last
                    Month</a>
                <a class="dropdown-item" href="javascript:void(0)"
                    onclick="if (!window.__cfRLUnblockHandlers) return false; getSearchData('last_year')">Last
                    Year</a>
            </div>
        </div>
        <div class="add-item-section"><a href="smart-validation-create" class="btn btn-success">Add New Item</a></div>
    </div>
    <div class="border-top">
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th style="width:10%;">Firstname</th>
                    <th style="width:10%;">Lastname</th>
                    <th style="width:10%;">Email</th>
                    <th style="width:10%;">Phone</th>
                    <th style="width:10%;">Image</th>
                    <th style="width:10%;">Status</th>
                    <th style="width:40%;">Action</th>
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
let url = apiUrl + "smart_validation";;
let headers = [{
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

getTableData(url, "data_list", headers, actions);
</script>
@endpush