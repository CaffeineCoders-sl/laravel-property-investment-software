@extends('admin.admin_dashboard')
@section('admin') 

<header class="page-header">
    <h2>Installment Report </h2> 
    <div class="right-wrapper text-end">
        <ol class="breadcrumbs">
            <li>
                <a href="index.html">
                    <i class="bx bx-home-alt"></i>
                </a>
            </li> 
            <li><span>Installment Report</span></li>  
        </ol>  
    </div>
</header>

<section class="card">
    <div class="card-body">
        <div class="row mb-4">
            
      <div class="col-md-6">
       <label for="propertyFilter" class="fw-bold">Select Property:</label>
       <select id="propertyFilter" class="form-control">
        <option value=""> -- All Properties -- </option>
        @php
            $properties = collect($installments)
            ->flatten() // Nested groupBy Remove
            ->map(fn($i) => $i->investment->property)
            ->filter() 
            ->unique('id'); // unique property id
        @endphp

        @foreach ($properties as $property)
        <option value="{{ $property->id }}"> {{ $property->title }} </option>
        @endforeach 

       </select> 
      </div>

    <!--- User List --->

    <div class="col-md-6" id="userFilterWrapper" style="display: none">
        <label for="userFilter" class="fw-bold">Select Investor/User:</label>
        <select id="userFilter">
            <option value=""> -- Select User --</option> 
        </select>
    </div>





        </div> 
    </div>

</section>







@endsection
