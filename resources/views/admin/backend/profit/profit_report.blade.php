@extends('admin.admin_dashboard')
@section('admin') 

<header class="page-header">
    <h2>Profit History Report </h2> 
    <div class="right-wrapper text-end">
        <ol class="breadcrumbs">
            <li>
                <a href="index.html">
                    <i class="bx bx-home-alt"></i>
                </a>
            </li> 
            <li><span>Profit History Report</span></li>  
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
            $addedProperties = [];
        @endphp

        @foreach ($profits as $userProfits)
         @foreach ($userProfits as $profit)
            @php
                $property = optional($profit->property);
            @endphp
            @if ($property && !in_array($property->id,$addedProperties))
                <option value="{{ $property->id }}"> {{ $property->title }} </option>
                @php
                    $addedProperties[] = $property->id;
                @endphp
            @endif 
         @endforeach 
        @endforeach 

       </select> 
      </div>

    <!--- User List --->

    <div class="col-md-6" id="userFilterWrapper" style="display: none">
        <label for="userFilter" class="fw-bold">Select Investor/User:</label>
        <select id="userFilter"  class="form-control">
            <option value=""> -- Select User --</option> 
        </select>
    </div>  
       </div>
       
       
    <table class="table table-bordered table-striped mb-0">
        <thead>
            <tr>
                <th>User</th>
                <th>Property  </th>
                <th>Invest Id</th> 
                <th>Invest Amount</th>
                <th>Profit Amount </th>
                <th>Paid Date </th> 
            </tr>
        </thead>

    <tbody>
    @foreach ($profits as $userId => $userProfits )
    @php
        $user = optional($userProfits->first()->user);
    @endphp 
    
     
    @endforeach
 
    </tbody> 
    </table> 

    </div>

</section>



<script>
   document.addEventListener("DOMContentLoaded", function () {
      const propertyFilter = document.getElementById("propertyFilter");
      const userFilterWrapper = document.getElementById("userFilterWrapper");
      const userFilter = document.getElementById("userFilter");
      const rows = document.querySelectorAll(".installment-row");

      // Default rows hide
      rows.forEach(row => row.style.display = "none");

      propertyFilter.addEventListener("change", function () {
         let propertyId = this.value;

         // Reset user filter
         userFilter.innerHTML = '<option value="">-- Select User --</option>';
         userFilterWrapper.style.display = "none";

         rows.forEach(row => row.style.display = "none");

         if (propertyId) {
            rows.forEach(row => {
               if (row.dataset.property === propertyId) {
                  row.style.display = "";
                  let userId = row.dataset.user;
                  let userName = row.querySelector("td").innerText.trim().split("\n")[0];
                  if (!userFilter.querySelector(`option[value='${userId}']`)) {
                     let opt = document.createElement("option");
                     opt.value = userId;
                     opt.textContent = userName + " (ID: " + userId + ")";
                     userFilter.appendChild(opt);
                  }
               }
            });
            userFilterWrapper.style.display = "block";
         }
      });

      userFilter.addEventListener("change", function () {
         let userId = this.value;
         let propertyId = propertyFilter.value;

         rows.forEach(row => {
            if (
               (!userId && row.dataset.property === propertyId) || 
               (userId && row.dataset.user === userId && row.dataset.property === propertyId)
            ) {
               row.style.display = "";
            } else {
               row.style.display = "none";
            }
         });
      });
   });
</script>




@endsection
