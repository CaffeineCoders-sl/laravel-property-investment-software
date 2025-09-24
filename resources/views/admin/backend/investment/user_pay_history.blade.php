@extends('admin.admin_dashboard')
@section('admin') 

<header class="page-header">
    <h2> Invested User Payment History </h2> 
    <div class="right-wrapper text-end">
        <ol class="breadcrumbs">
            <li>
                <a href="index.html">
                    <i class="bx bx-home-alt"></i>
                </a>
            </li> 
            <li><span>Invested User Payment History</span></li>  
        </ol>  
    </div>
</header>

<div class="container-fluid">
    <div class="mb-4">
        <a href="{{ route('running.investment') }}" class="btn btn-outline-primary"><i class="fas fa-arrow-left me-2"></i> Back to Investments </a>
    </div>

<div class="mb-5">
    <h4 class="fw-bold text-dark mb-3">User History - <span class="text-primary">{{ $investment->user->first_name }}  {{ $investment->user->last_name }}</span> </h4>


<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-bordered mb-0">
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
     $installmentNumber = $downPaymentAmount > 0 ? 
     $loop->index : $loop->index + 1; 

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
        <td>{{ $investment->property->title ?? 'N/A' }}</td>
        <td>{{ $installmentDate->format('Y-m-d') }}</td>
        <td>{{ $type }}</td>
        <td>
            @if ($loop->first && $investment->property->down_payment > 0)
            {{ (int) $investment->property->down_payment }} %
            (${{ $investment->total_amount * ($investment->property->down_payment / 100) }}) 
            @else 
                ${{ $totalInstallmentAmount }}
            @endif 
        </td>
        <td>
            @if ($installment->paid_time)
                {{ \Carbon\Carbon::parse($installment->paid_time)->format('Y-m-d') }}
            @else 
            <span class="text-muted">Not Paid</span>
            @endif
        </td> 
        <td>
          @if ($installment->status == 'paid')
         <span class="badge badge-success">Paid</span> 
         @elseif ($installment->status == 'due')
             <span class="badge badge-primary">Due</span> 
         @elseif ($installment->status == 'processing')
             <span class="badge badge-warning">Processing</span>
         @else 
          <span class="badge badge-danger">Failed</span> 
        @endif 
        </td>
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
</div>

 <!--- Profilt History --->

 <div class="mb-5">
    <h5 class="fw-bold text-dark mb-3">Profit History</h5>
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
<table class="table table-hover table-bordered mb-0">
    <thead>
        <tr>
            <th scope="col">Date</th>
            <th scope="col">Amount Per Share</th>
            <th scope="col">Status</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($investment->profits as $profit)
        @php
            $perShareAmont = $profit->profit_amount;
        @endphp
        <tr>
            <td> {{ \Carbon\Carbon::parse($profit->paid_date)->format('d M, Y') }}</td>
            <td> ${{ $perShareAmont}}</td>
            <td>
                @if ($profit->status === 'paid')
           <span class="badge bg-success">Paid</span>
               @else
           <span class="badge bg-danger">Unpaid</span>
                @endif 
            </td>
        </tr> 
        @empty
        <tr>
            <td colspan="3" class="text-center text-muted py-4">No Profit data found</td>
        </tr>
            
        @endforelse
    </tbody>

</table>

            </div> 
        </div> 
    </div> 
 </div>


 <!--- Capital Return  --->

 <div class="mb-5">
    <h5 class="fw-bold text-danger mb-3">Capital Return</h5>
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
<table class="table table-hover table-bordered mb-0">
    <thead>
        <tr>
            <th scope="col">Capital Return</th> 
        </tr>
    </thead>

    <tbody>
         <tr>
            <td>
                @if ($investment->capitalReturn )
                  <div class="text-success">
    Capital Back: $ {{ $investment->capitalReturn->amount }} on Date 
    {{ \Carbon\Carbon::parse($investment->capitalReturn->paid_date)->format('d M, Y') }}
   ( TRX ID : {{$investment->capitalReturn->trx}} ) 
                  </div>
                @else  
            <span class="text-muted">No Capital Return data available</span>
                @endif
            </td>
         </tr>
    </tbody>

</table>

            </div> 
        </div> 
    </div> 
 </div>



  <!--- Capital Back Section --->

 <div class="mb-5">
    <h5 class="fw-bold text-dark mb-3">Capital Back</h5>
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
<table class="table table-hover table-bordered mb-0">
    <thead>
        <tr>
            <th scope="col">Capital Back Type</th>
            <th scope="col">Profit Back After Days</th>
            <th scope="col">Amount</th>
            <th scope="col">Action</th>
        </tr>
    </thead>

    <tbody>
      
        <tr>
            <td> {{ $investment->property->capital_back ?? 'N/A' }}</td>
            <td> {{ $investment->property->profit_back ?? 'N/A' }} Days</td>
            <td> {{ $investment->property->per_share_amount ?? 'N/A' }}</td>
           <td> 
            @php
                $alreadyCapitalBack = $investment->capitalReturn()->exists()
            @endphp
            @if (($investment->property->per_share_amount ?? 0) > 0 && !$alreadyCapitalBack)
            <a href="" class="btn btn-sm btn-primary" onclick="return confirm('Are you sure to retun capital back to this user')">Capital Back</a>
             @else 
            <span class="btn btn-sm btn-secondary disabled" >Back Capital</span>   
            @endif
           </td>
        </tr> 
       
    </tbody>

</table>

            </div> 
        </div> 
    </div> 
 </div>




</div>


@endsection