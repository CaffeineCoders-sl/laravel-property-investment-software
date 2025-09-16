@extends('home.home_master')
@section('home')

<section class="breadcrumb bg-img"
    data-background-image="{{ asset('frontend/assets/images/65c469d3e22771707370963.png') }}">
    <div class="container ">
        <div class="breadcrumb__wrapper">
            <h3 class="breadcrumb__title">All Installment </h3>
        </div>
    </div>
</section>

 
    <div class="dashboard py-60 position-relative">
        <div class="container ">
            <div class="dashboard__wrapper">
 
        @include('home.body.dashboard_sidebar')

  <div class="dashboard-body">
                    <div class="flex-between breadcrumb-dashboard">
                        <div class="show-sidebar-btn mb-4">
                            <i class="fas fa-bars"></i>
                        </div>
                </div>
                        <div class="flex-end mb-4 breadcrumb-dashboard">
        <h6 class="page-title">Property: {{ $investment->property->title }}</h6>
    @php
        $perInstallment = $investment->property->per_installment_amount;
        $totalInstallmentAmount = $perInstallment * $investment->share_count;
    @endphp

        <p class="mt-2 page-title-note">Per installment amount: ${{ $totalInstallmentAmount }}
        </p>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
  <div class="table-responsive table--responsive--xl">
<table class="table custom--table">
    <thead>
        <tr>
            <th>Installment Date</th>
            <th>Paid Date</th>
            <th>Late Fee</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
<tbody>                                                           
    <tr>
    <td>
        <div>
            2025-06-25<br>
            <span class="small">3 weeks from now</span>
        </div>
    </td>
    <td>
        <div>N/a </div>
    </td>
    <td>$0.00</td>
    <td><span class="badge badge--warning">Due</span>   </td>
    <td>
    <a href="" class="action--btn btn btn-outline--primary" title="Pay Installment"><i class="las la-coins"></i></a>     
    </td>

    </tr>
                                                                                                                                         
          </tbody>
                    </table>
                </div>
                    </div>
    </div>

    <div id="installmentModal" class="modal fade custom--modal installment-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header  mb-2">
                <div>
                    <h6 class="modal-title">Installment to  - <span
                            class="text--base"></span>
                        property                    </h6>
                </div>
                <button class="close-btn" type="button" data-bs-dismiss="modal">
                    <i class="las fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST"
                    action="//realvest/user/invest/installment/pay/eyJpdiI6IlFGSUxmUnJMdTJzNU52dVFMQm1mWkE9PSIsInZhbHVlIjoiRnhOMTRveVZDcEEzMTV1UUtIMUpYQT09IiwibWFjIjoiZjJlZGU0ODJmN2JkNzE1YjYxODAyM2RkZjQ5MjM1MjM4Njc3NmVmMTQ5NjEzNjJkOGQwNTgxMjNkY2U5ZTI4NyIsInRhZyI6IiJ9/eyJpdiI6InRtYi9aZ25QRDdoK001eUVsdmdQYkE9PSIsInZhbHVlIjoiK2RpZyt6bUF3eG0vbzlmTTI3U3kxdz09IiwibWFjIjoiYzU4NGFmNzE5MWU2NTVkODMwOTE2NWVlYjAxOWEzMDJhYjdkOTU3MDFmOTkzNzg2NTU0OGFkNjlmZThhZDBjNiIsInRhZyI6IiJ9"
                    class="modal-form" id="installmentForm">
                    <input type="hidden" name="_token" value="AgrQteztDPUt9ULMougURIKUlrFDk0lPkode5Rzl" autocomplete="off">                    <input type="hidden" name="method" id="paymentMethod" value="gateway">
                    <input name="currency" type="hidden">

                    <div class="modal-form__body">
                        <div class="form-group">
                            <label class="form--label">Installment Amount</label>
                            <div class="input-group--custom">
                                <input class="form--control" type="number" name="installment_amount"
                                    value="0"
                                    readonly required>
                                <span class="input-group-text p-0 border-0">
                                    <small class="px-3">USD</small>
                                </span>
                            </div>
                            <div class="mt-2 preview-details d-none">
                                <span>
                                    <span>Charge:</span>
                                    <span class="text--base">$<span class="charge ">0</span></span>,
                                </span>
                                <span>
                                    <span>Total Amount: </span> <span class="text--base">$<span
                                            class="payable ">
                                            0</span></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-form__footer flex-row   flex-wrap form-group">
                        <button type="button" class="flex-fill btn btn-outline--base active" id="payGatewayButton">
                            <span class="active-badge"> <i class="las la-check"></i> </span>
                            Pay via Gateway                        </button>
                        <button type="button" class="flex-fill btn btn-outline--base" id="payBalanceButton">
                            <span class="active-badge"> <i class="las la-check"></i> </span>
                            Pay via Balance                        </button>
                    </div>
                    <button type="submit" class="flex-fill btn btn--base w-100">
                        Paid Now                    </button>
                </form>
            </div>
        </div>
    </div>
</div>



                </div>




            </div>
        </div>
    </div> 


@endsection