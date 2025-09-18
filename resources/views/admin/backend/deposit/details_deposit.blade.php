@extends('admin.admin_dashboard')
@section('admin') 

<header class="page-header">
    <h2>Details Deposit </h2> 
    <div class="right-wrapper text-end">
        <ol class="breadcrumbs">
            <li>
                <a href="index.html">
                    <i class="bx bx-home-alt"></i>
                </a>
            </li> 
            <li><span>Details Deposit</span></li>  
        </ol>  
    </div>
</header>


<div class="row g-4">
    <!-- Left Column  -->

<div class="col-md-4">
    <div class="card shadow-sm">
        <div class="card-header">
    <h5 class="mb-0"><b> {{ ucfirst($details->payment_type) }} Deposit</b></h5>
        </div>

    <div class="card-body">
        <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between">
                <span><b> Date :</b> </span>
                <span> {{ $details->created_at->format('Y-m-d h:i A') }} </span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <span><b> Transaction Number :</b> </span>
                <span> {{ $details->trx }} </span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <span><b> User Name :</b></span>
                <span> {{ $details->user->name }} </span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <span><b> Payment Method :</b></span>
                <span> {{ ucfirst(str_replace('_',' ',$details->payment_type)) }} </span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <span><b> Amount : </b></span>
                <span> ${{ $details->amount }} </span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <span><b> Total Amount :</b> </span>
                <span> ${{ $details->total_amount }} </span>
            </li>

            <li class="list-group-item d-flex justify-content-between">
                <span><b> Property Name : </b></span>
                <span> {{ $details->property->title }} </span>
            </li>


             <li class="list-group-item d-flex justify-content-between">
                <span><b> Status : </b></span>
                <span class="badge bg-warning"> {{ ucfirst($details->status) }}  </span>
            </li>
    @if ($details->installment)
    @php
        $investment = $details->installment->investment;
        $property = $investment->property;

        $hasDownPayment = $property->down_payment > 0;

        // get installment position in collection
        $installmentIndex = $investment->installments->search(function($deposit) use ($details){
            return $deposit->id === $details->installment->id;
        });

        $effectiveIndex = $hasDownPayment ? $installmentIndex : $installmentIndex + 1;

    if ($installmentIndex === 0 && $hasDownPayment) {
        $installmentType = 'Down Payment';
    } else {
        if ($effectiveIndex % 10 == 1 && $effectiveIndex % 100 != 11) {
            $suffix = 'st';
        } elseif ($effectiveIndex % 10 == 2 && $effectiveIndex % 100 != 12) {
            $suffix = 'nd';
        }elseif ($effectiveIndex % 10 == 3 && $effectiveIndex % 100 != 13) {
            $suffix = 'rd';
        } else {
            $suffix = 'th';
        }

        $installmentType = $effectiveIndex . $suffix . ' Installment'; 
    }         
    @endphp 
    <li class="list-group-item d-flex justify-content-between">
        <span><b> Installment  :</b> </span>
        <span>  {{ $installmentType }} </span>
      </li>
    
    @endif
        </ul>

    </div> 
    </div> 
</div>

<div class="col-md-8">
    <div class="card shadow-sm">
        <table class="table table-bordered" id="installmentTable">
            <button id="download">Download PDF</button>
            <thead class="table-primary">
                <tr>
                    <th>Property</th>
                    <th>Installment Date</th>
                    <th>Installment Type </th>
                    <th>Payment Amount</th>
                    <th>Paid Date</th>
                    <th>Status</th>
                </tr> 
            </thead>
        <tbody>
 @php
$downPaymentAmount = $investment->property->down_payment *  $investment->share_count;
$totalInstallmentAmount = $investment->property->per_installment_amount * $investment->share_count;
$startDate = \Carbon\Carbon::parse($investment->created_at);
 @endphp

 @forelse ($investment->installments as $installment) 

    @php
    if ($downPaymentAmount  > 0) {
        $installmentNumber = $loop->index;
    }else {
        $installmentNumber = $loop->index + 1; 
    }
    $installmentDate = $startDate->copy()->addMonths($installmentNumber);
    if ($loop->first && $downPaymentAmount > 0){
        $type = 'Down Payment ';
    } else  {
        if ( $installmentNumber % 10 == 1 &&  $installmentNumber % 100 !== 11) {
      $suffix = 'st';
     } elseif ($installmentNumber % 10 == 2 &&  $installmentNumber % 100 !== 12) {
        $suffix = 'nd';
     }elseif ($installmentNumber % 10 == 3 &&  $installmentNumber % 100 !== 13) {
        $suffix = 'rd';
     } else {
       $suffix = 'th';
     }
     $type = $installmentNumber . $suffix . ' Installment';
    } 
    @endphp 
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>

@empty
<tr>
    <td colspan="6" class="text-center">No Installmets found</td>
</tr>

 @endforelse


        </tbody> 
        </table>

    </div>

</div>




 
</div>


@endsection
