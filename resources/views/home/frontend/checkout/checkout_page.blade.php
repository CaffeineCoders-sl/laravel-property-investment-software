@extends('home.home_master')
@section('home')

<div class="min-vh-100 d-flex flex-column">
    <main class="flex-grow-1 py-5">
        <div class="container">
            <h3>{{ $property->title }}</h3>
   
   <form action="">

 <div class="row g-4 mb-4">
   <div class="col-md-6">
     <label class="form-lable fw-medium text-dark">Number of Shares</label>
     <div class="input-group">
        <input type="number" name="share_count" min="1" max="{{ $property->total_share }}" value="1" class="form-control form-control-lg input-field" required>
    <span class="input-group-text bg-transparent">Max: {{ $property->total_share - $property->investments->sum('share_count') }}</span>
     </div>
    <div class="from-text mt-2"> Each Share represted as ownership</div> 
    </div>



    <div class="col-md-6">
    <label class="form-lable fw-medium text-dark">Price Per Share</label>
    <div class="input-group">
        <span class="input-group-text">$</span>
        <input type="text" value="{{ $property->per_share_amount }}" disabled class="form-control form-control-lg bg-light"> 
    </div>
     <div class="from-text mt-2">Fixed price per investment unit</div>  
    </div>  

 </div> 

 <div class="mb-4">
    <h3 class="h5 fw-semibold text-dark mb-3">Payment Methods </h3>

 </div>







    </form>

        </div>

    </main>

</div>









@endsection