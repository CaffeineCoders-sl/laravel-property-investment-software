@extends('admin.admin_dashboard')
@section('admin') 

<header class="page-header">
    <h2> Investment Property Details</h2> 
    <div class="right-wrapper text-end">
        <ol class="breadcrumbs">
            <li>
                <a href="index.html">
                    <i class="bx bx-home-alt"></i>
                </a>
            </li> 
            <li><span>Investment Property Details</span></li>  
        </ol>  
    </div>
</header>

<div class="container-fluid">
    <div class="mb-4">
        <a href="{{ route('running.investment') }}" class="btn btn-outline-primary"><i class="fas fa-arrow-left me-2"></i> Back to Investments </a>
    </div>

<div class="row g-4">
    <!-- Property Details --->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100"> 
        <div class="card-header bg-primary text-white fw-semibold">
            Property Details
        </div>
    <div class="card-body">
<dl class="row mb-0">
    <dt class="col-sm-5 fw-semibold">Property Name: </dt>
    <dd class="col-sm-7">{{ $investment->property->title ?? 'N/A' }}</dd>

        <dt class="col-sm-5 fw-semibold">Investment Type: </dt>
    <dd class="col-sm-7">{{ $investment->property->investment_type ?? 'N/A' }}</dd>

        <dt class="col-sm-5 fw-semibold">Total Share: </dt>
    <dd class="col-sm-7">{{ $investment->property->total_share ?? 'N/A' }}</dd>


        <dt class="col-sm-5 fw-semibold">Per Share Amount: </dt>
    <dd class="col-sm-7">{{ $investment->per_share_price ?? 'N/A' }}</dd>


        <dt class="col-sm-5 fw-semibold">Capital Back: </dt>
    <dd class="col-sm-7">{{ $investment->property->capital_back ?? 'N/A' }}</dd>

        <dt class="col-sm-5 fw-semibold">Profit Type : </dt>
    <dd class="col-sm-7">{{ $investment->property->profit_type ?? 'N/A' }}</dd>

    <dt class="col-sm-5 fw-semibold">Profit Amount : </dt>
    <dd class="col-sm-7">${{ $investment->property->profit_amount ?? 'N/A' }}</dd>

<dt class="col-sm-5 fw-semibold">Profit Schedule : </dt>
    <dd class="col-sm-7">{{ $investment->property->profit_schedule ?? 'N/A' }}</dd>

    <dt class="col-sm-5 fw-semibold">Profit Repeted Time : </dt>
    <dd class="col-sm-7">{{ $investment->property->repeat_time ?? 'N/A' }}</dd>
 
</dl>

    </div> 
    </div> 
</div>


  <!-- Investment Details --->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100"> 
        <div class="card-header bg-primary text-white fw-semibold">
           Investment Details
        </div>
    <div class="card-body">
<dl class="row mb-0">
    <dt class="col-sm-5 fw-semibold">Invested Amount : </dt>
    <dd class="col-sm-7">${{ $investment->property->per_share_amount ?? 'N/A' }}</dd>

        <dt class="col-sm-5 fw-semibold">Per Installment Amount: </dt>
    <dd class="col-sm-7">${{ $investment->property->per_installment_amount ?? 'N/A' }}</dd>

        <dt class="col-sm-5 fw-semibold">Investement Status: </dt>
    <dd class="col-sm-7">Running</dd>
 
 
</dl>

    </div> 
    </div> 
</div>








</div> 
</div> 

@endsection
