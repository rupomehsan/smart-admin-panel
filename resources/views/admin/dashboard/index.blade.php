@extends('layouts.admin.index')
@section('content')



<!-- BEGIN Page Content -->
<!-- the #js-page-content id is needed for some plugins to initialize -->
<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">SmartAdmin</a></li>
        <li class="breadcrumb-item">Application Intel</li>
        <li class="breadcrumb-item active">Analytics Dashboard</li>
    </ol>
    <div class="row">
        <div class="col-md-4">
            <button>Form Validation One</button>
        </div>
        <div class="col-md-4">
            <button>Form Validation One</button>
        </div>
        <div class="col-md-4">
            <button>Form Validation One</button>
        </div>
    </div>

</main>

@endsection

@push("custom-js")
<script>

</script>
@endpush