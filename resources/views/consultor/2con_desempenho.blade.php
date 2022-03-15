@extends('layouts.base')

@section('conteudo')
<div class="az-content-left az-content-left-components">
    <div class="component-item">
        <label>UI Elements</label>
        <nav class="nav flex-column">
            <a href="elem-buttons.html" class="nav-link">Buttons</a>
            <a href="elem-dropdown.html" class="nav-link">Dropdown</a>
            <a href="elem-icons.html" class="nav-link">Icons</a>
        </nav>

        <label>Forms</label>
        <nav class="nav flex-column">
            <a href="form-elements.html" class="nav-link">Form Elements</a>
        </nav>

        <label>Charts</label>
        <nav class="nav flex-column">
            <a href="chart-chartjs.html" class="nav-link active">ChartJS</a>
        </nav>

        <label>Tables</label>
        <nav class="nav flex-column">
            <a href="table-basic.html" class="nav-link">Basic Tables</a>
        </nav>
    </div><!-- component-item -->

</div><!-- content-left -->
<div class="az-content-body pd-lg-l-40 d-flex flex-column">
    <div class="az-content-breadcrumb">
        <span>Components</span>
        <span>Charts</span>
        <span>ChartJS Charts</span>
    </div>
    <h2 class="az-content-title">ChartJS Charts</h2>

<div class="row row-sm mg-b-20">
    <div class="col-lg-4">
        <p class="mg-b-10">Selecione o Consultor</p>
        <select class="form-control select2-no-search"  multiple="multiple" >
            <option label="Choose one"></option>
            <option value="Firefox">Firefox</option>
            <option value="Chrome">Chrome</option>
            <option value="Safari">Safari</option>
            <option value="Opera">Opera</option>
            <option value="Internet Explorer">Internet Explorer</option>
        </select>
    </div><!-- col-4 -->
    <div class="col-lg-4 mg-t-20 mg-lg-t-0">
        <p class="mg-b-10">Single Select with Search</p>
        <select class="form-control select2">
            <option label="Choose one"></option>
            <option value="Firefox">Firefox</option>
            <option value="Chrome">Chrome</option>
            <option value="Safari">Safari</option>
            <option value="Opera">Opera</option>
            <option value="Internet Explorer">Internet Explorer</option>
        </select>
    </div><!-- col-4 -->
    <div class="col-lg-4 mg-t-20 mg-lg-t-0">
        <p class="mg-b-10">Single Select (Disabled)</p>
        <select class="form-control select2" disabled>
            <option label="Choose one"></option>
            <option value="Firefox">Firefox</option>
            <option value="Chrome">Chrome</option>
            <option value="Safari">Safari</option>
            <option value="Opera">Opera</option>
            <option value="Internet Explorer">Internet Explorer</option>
        </select>
    </div><!-- col-4 -->
    <div class="col-lg-4">
        <p class="mg-b-10">Multiple Select with Pre-Filled Input</p>
        <select class="form-control select2" multiple="multiple">
            <option value="Firefox" selected>Firefox</option>
            <option value="Chrome">Chrome</option>
            <option value="Safari">Safari</option>
            <option value="Opera">Opera</option>
            <option value="Internet Explorer">Internet Explorer</option>
        </select>
    </div><!-- col -->
</div><!-- row -->

<div class="row row-xs wd-xl-80p">
    <div class="col-sm-6 col-md-3"><button class="btn btn-az-primary btn-block">Primary</button></div>
    <div class="col-sm-6 col-md-3 mg-t-10 mg-sm-t-0"><button class="btn btn-az-secondary btn-block">Secondary</button></div>
    <div class="col-sm-6 col-md-3 mg-t-10 mg-md-t-0"><button class="btn btn-gray-500 btn-block">Light</button></div>
</div><!-- row -->

</div><!-- content-body -->
<div class="content">
    <h2 class="text-center">Multi-Select #5</h2>
    <div class="container text-left">
        <div class="row justify-content-center">
            <div class="col-md-5">



                <select name="basic[]" multiple="multiple" class="3col active form-control">
                    <option value="AL">Alabama</option>
                    <option value="AK">Alaska</option>
                    <option value="AZ">Arizona</option>
                    <option value="AR">Arkansas</option>
                    <option value="CA">California</option>
                    <option value="CO">Colorado</option>
                    <option value="CT">Connecticut</option>
                    <option value="DE">Delaware</option>
                    <option value="FL">Florida</option>
                    <option value="GA">Georgia</option>
                    <option value="HI">Hawaii</option>
                    <option value="ID">Idaho</option>
                    <option value="IL">Illinois</option>
                    <option value="IN">Indiana</option>
                    <option value="IA">Iowa</option>
                    <option value="KS">Kansas</option>
                    <option value="KY">Kentucky</option>
                    <option value="LA">Louisiana</option>
                    <option value="ME">Maine</option>
                    <option value="MD">Maryland</option>
                    <option value="MA">Massachusetts</option>
                    <option value="MI">Michigan</option>
                    <option value="MN">Minnesota</option>
                    <option value="MS">Mississippi</option>
                    <option value="MO">Missouri</option>
                    <option value="MT">Montana</option>
                    <option value="NE">Nebraska</option>
                    <option value="NV">Nevada</option>
                    <option value="NH">New Hampshire</option>
                    <option value="NJ">New Jersey</option>
                    <option value="NM">New Mexico</option>
                    <option value="NY">New York</option>
                    <option value="NC">North Carolina</option>
                    <option value="ND">North Dakota</option>
                    <option value="OH">Ohio</option>
                    <option value="OK">Oklahoma</option>
                    <option value="OR">Oregon</option>
                    <option value="PA">Pennsylvania</option>
                    <option value="RI">Rhode Island</option>
                    <option value="SC">South Carolina</option>
                    <option value="SD">South Dakota</option>
                    <option value="TN">Tennessee</option>
                    <option value="TX">Texas</option>
                    <option value="UT">Utah</option>
                    <option value="VT">Vermont</option>
                    <option value="VA">Virginia</option>
                    <option value="WA">Washington</option>
                    <option value="WV">West Virginia</option>
                    <option value="WI">Wisconsin</option>
                    <option value="WY">Wyoming</option>
                </select>


            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="{{ asset('extra/fonts/icomoon/style.css') }}">

<link rel="stylesheet" href="{{ asset('extra/css/jquery.multiselect.css') }}">
<!-- Style -->
<link rel="stylesheet" href="{{ asset('extra/css/style.css') }}">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{ asset('extra/css/bootstrap.min.css') }}">


<script src="{{ asset('extra/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('extra/js/popper.min.js') }}"></script>
<script src="{{ asset('extra/js/jquery.multiselect.js') }}"></script>
<script src="{{ asset('extra/js/main.js') }}"></script>

<script src="{{ asset('extra/js/bootstrap.min.js') }}"></script>
@endsection
