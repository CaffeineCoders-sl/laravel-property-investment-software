@extends('home.home_master')
@section('home')

<section class="breadcrumb bg-img"
    data-background-image="{{ asset('frontend/assets/images/65c469d3e22771707370963.png') }}">
    <div class="container ">
        <div class="breadcrumb__wrapper">
            <h3 class="breadcrumb__title">Property Details</h3>
        </div>
    </div>
</section>
  <section class="property-details py-60 bg-pattern">
        <div class="container ">
            <div class="row gy-4 gy-lg-0 row--one">
                <div class="col-lg-7 col-xxl-8">
<div class="mb-4">
    <h4 class="property-details__title mb-0">{{ $property->title }}</h4>
    <ul class="property-details-metan">
        <li class="property-details-meta__item">
            <span class="icon"><i class="fas fa-map-marker-alt"></i></span>
            <span class="text">{{ $property->location->name }}</span>
        </li>
    </ul>
</div>
                    <div class="property-details__block mb-4">
                        <div class="property-details__slider">
   
    <img class="property-details__slider-img"
    src="{{ asset($property->image) }}"
    alt="property-image">
  
    @foreach ($property->galleryImages as $img) 
   <img class="property-details__slider-img"
    src="{{ asset($img->image) }}"
    alt="property-image">
   @endforeach
                       
                </div>

    <div class="property-details__thumb">

   <img class="property-details__slider-img"
    src="{{ asset($property->image) }}"
    alt="property-image">
   @foreach ($property->galleryImages as $img) 
    <img class="property-details__slider-img"
    src="{{ asset($img->image) }}"
    alt="property-image">
     @endforeach
                         
                </div>
                    </div>
<div class="property-details__block mb-4">
    <div class="mb-3">
        <h5 class="title">Property Description</h5>
        <div class="property-details__desc">
            {!! $property->details !!}
     </div>
    </div>
    <div class="mb-3">
        <h5 class="title">Location</h5>
        <iframe class="property-details__map" src="{{ $property->location_map }}" style="border:0;"
            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</div>
                    <div class="property-details__block">
    <h5 class="title">Share now</h5>
    <div class="mb-3">
@php
    $propertUrl = urlencode(route('property.details',$property->slug));
    $propertyTitle = urlencode($property->title);
@endphp
        <ul class="social-list social-list--soft">
            <li class="social-list__item">
                <a class="social-list__link" href="https://www.facebook.com/sharer/sharer.php?u={{$propertUrl}} " target="_blank">
                    <i class="fab fa-facebook"></i>
                </a>
            </li>
            <li class="social-list__item">
                <a class="social-list__link"
                    href="https://twitter.com/intent/tweet?text=Luxury Condominiums&amp;url={{$propertUrl}}" target="_blank">
                    <i class="fab fa-twitter"></i>
                </a>
            </li>
            <li class="social-list__item">
                <a class="social-list__link"
                    href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{$propertUrl}};title={{$propertyTitle}}"
                    target="_blank">
                    <i class="fab fa-linkedin"></i>
                </a>
            </li>
            <li class="social-list__item">
                <a class="social-list__link" href="https://www.instagram.com/sharer.php?u={{$propertUrl}}" target="_blank">
                    <i class="fab fa-instagram"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="input-group input-group--copy">
        <input class="form--control" type="text" value="{{ route('property.details',$property->slug) }}" readonly>
        <button class="btn btn-soft--base" type="button" onclick="navigator.clipboard.writeText({{ route('property.details',$property->slug) }})">
            <i class="las la-copy"></i>
            <span>Copy</span>
        </button>
    </div>
</div>
                </div>




<div class="col-lg-5 col-xxl-4">
<div class="property-details__price mb-4">
    <h3 class="mb-0">
        ${{ $property->per_share_amount }}
    </h3>
    <span class="text">Per Share Amount</span>
</div>

<div class="property-details__buttons mb-md-4 mb-0">
   <a href="login" type="button" class="btn btn--lg btn--base">
            Invest Now                            </a>
  <button type="button" class="btn btn--lg btn-outline--base d-lg-none" data-toggle="sidebar" data-target="#property-details-sidebar">
        <i class="fas fa-info-circle"></i>
        <span>Details</span>
    </button>
</div>

<div id="property-details-sidebar" class="property-details-sidebar">
    <button type="button" class="close-btn">
        <i class="fas fa-times"></i>
    </button>
    <div class="property-details-sidebar__block mb-4">
        <div class="block-heading">
            <p class="block-heading__subtitle">Available:
                0 Share                               </p>
        </div>
        <div class="card-progress mt-2">
            <div class="card-progress__bar">
                <div class="card-progress__thumb" style="width: 100%;">
                </div>
            </div>
            <span class="card-progress__label fs-12">
                2 Investors |
                $45,000.00
                (100%)
            </span>
        </div>
<ul class="property-details-amount-info">
    <li class="property-details-amount-info__item">
        <span class="label">
            <img src="{{ asset('frontend/assets/images/icons/invest_type.png') }}" alt="img"> Investment Type </span>
        <span class="value fw-bold"> {{ $property->investment_type }}  </span>
    </li>
    <li class="property-details-amount-info__item">
        <span class="label">
            <img src="{{ asset('frontend/assets/images/icons/profit.png') }}" alt="img">
            Profit  </span>
       @if ($property->profit_type === 'fixed')
         <span class="value fw-bold">
            ${{ $property->profit_amount }} Fixed
        </span>
        @else 
        <span class="value fw-bold">
            ${{ $property->minimum_profit_amount }} %
        </span>
       @endif  
    </li>

@php
    $downPaymentAmount = ($property->per_share_amount * $property->down_payment) / 100;
    $initialAmount = $property->per_share_amount - $downPaymentAmount;
@endphp
  <li class="property-details-amount-info__item">
            <span class="label">
<img src="{{ asset('frontend/assets/images/icons/down_payment.png') }}" alt="img"> Down Payment  </span>  <span class="value fw-bold">{{ $property->down_payment }}% (${{$downPaymentAmount}})</span>
        </li>
        <li class="property-details-amount-info__item">
            <span class="label">
                <img src="{{ asset('frontend/assets/images/icons/init_amount.png') }}" alt="img">
                Initial Invest Amount                                        </span>
            <span class="value fw-bold">
                ${{ $initialAmount }}
            </span>
        </li>
<li class="property-details-amount-info__item">
    <span class="label">
        <img src="{{ asset('frontend/assets/images/icons/total_installment.png') }}" alt="img">
        Total Installments </span>
    <span class="value fw-bold">{{ $property->total_installment }}</span>
</li>
    <li class="property-details-amount-info__item">
        <span class="label">
            <img src="{{ asset('frontend/assets/images/icons/per_installment.png') }}" alt="img">
            Per Installment Amount  </span>
        <span class="value fw-bold">
            ${{ $property->per_installment_amount }}
        </span>
    </li>
    <li class="property-details-amount-info__item">
        <span class="label">
            <img src="{{ asset('frontend/assets/images/icons/installment_schedule.png') }}" alt="img">
            Installment Schedule </span>
        <span class="value fw-bold">
           {{ $property->time->time_name }}
        </span>
    </li>
    <li class="property-details-amount-info__item">
        <span class="label">
            <img src="{{ asset('frontend/assets/images/icons/late_fee.png') }}" alt="img">
            Installment Late Fee   </span>
        <span class="value fw-bold">
            ${{ $property->installment_late_fee }}
        </span>
    </li>
  <li class="property-details-amount-info__item">
    <span class="label">
        <img src="{{ asset('frontend/assets/images/icons/profit_schedule.png') }}" alt="img">
        Profit Schedule   </span>
    <span class="value fw-bold">
       {{ $property->profit_schedule }}
    </span>
</li>

   <li class="property-details-amount-info__item">
        <span class="label">
            <img src="{{ asset('frontend/assets/images/icons/profit_repeat.png') }}" alt="img">
            Profit Repeat  </span>
        <span class="value fw-bold">
            {{ $property->repeat_time }} Times  </span>
    </li>
  <li class="property-details-amount-info__item">
    <span class="label">
        <img src="{{ asset('frontend/assets/images/icons/capital_back.png') }}" alt="img">
        Capital Back  </span>
    <span class="value fw-bold">
        {{ $property->capital_back }}
    </span>
</li>
<li class="property-details-amount-info__item">
    <span class="label">
        <img src="{{ asset('frontend/assets/images/icons/profit_back.png') }}" alt="img">
        Profit Return  </span>
    <span class="value fw-bold">After {{ rtrim(rtrim(number_format($property->profit_back, 10), '0'), '.') }} Days </span>
</li>
      </ul>
    </div>
 
    <div class="property-details-sidebar__block">
            <div class="block-heading">
                <h6 class="block-heading__title">Latest Properties</h6>
            </div>
            <div class="property-details__cards">
                                                        <div class="property-details-card">
                        <div class="property-details-card__thumb">
                            <a href="property/opaloasis-estates">
                                <img src="assets/images/thumb_65f9782e5eeea1710848046.png" alt="Property-image">
                            </a>
                        </div>
                        <div class="property-details-card__content">
                            <h6 class="title">
                                <a href="/opaloasis-estates">
                                    OpalOasis Estates
                                </a>
                            </h6>
                            <div class="location">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Berlin, Germany</span>
                            </div>
                            <span class="price">
                                $50,000.00
                            </span>
                        </div>
                    </div>
                                                        <div class="property-details-card">
                        <div class="property-details-card__thumb">
                            <a href="property/iconic-victorian">
                                <img src="assets/images/thumb_65f29e67172461710399079.png" alt="Property-image">
                            </a>
                        </div>
                        <div class="property-details-card__content">
                            <h6 class="title">
                                <a href=" /iconic-victorian">
                                    Iconic Victorian
                                </a>
                            </h6>
                            <div class="location">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Paris, France</span>
                            </div>
                            <span class="price">
                                $4,000.00
                            </span>
                        </div>
                    </div>
                                                  
                                                        <div class="property-details-card">
                        <div class="property-details-card__thumb">
                            <a href="/property/stylish-apartment">
                                <img src="assets/images/thumb_65f97bcae25001710848970.png" alt="Property-image">
                            </a>
                        </div>
                        <div class="property-details-card__content">
                            <h6 class="title">
                                <a href="/stylish-apartment">
                                    Stylish Apartment
                                </a>
                            </h6>
                            <div class="location">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>London, England</span>
                            </div>
                            <span class="price">
                                $20,000.00
                            </span>
                        </div>
                    </div>
                                                </div>
        </div>
                        </div>
                </div>
            </div>
        </div>
    </section>

    <div id="investModal" class="modal fade custom--modal invest-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 mb-2">
                <div>
                    <h6 class="modal-title">Invest to  - <span class="text--base">Luxury Condominiums</span>
                    </h6>
                </div>
                <button class="close-btn" type="button" data-bs-dismiss="modal">
                    <i class="las fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="//realvest/user/invest/store/eyJpdiI6IjZuMGxma002dzJ5RlhZb0xjeTFsWFE9PSIsInZhbHVlIjoiQ3ViZEl4VEdLQW1naWhhdTVscDdlUT09IiwibWFjIjoiMDRiMzliMDZiNDg1NTY4MWE0NTk4MzRjNDhkNTY0MWMyMTRlZmFhMjAyMjk3NTE3OGQyMmIyNzc3MzQzZTM5OSIsInRhZyI6IiJ9"
                    class="modal-form" id="investForm">
                    <input type="hidden" name="_token" value="PEASqKgrAKN6rF181e43U0uM8W45aBENiwb3ALoy" autocomplete="off">                    <input type="hidden" name="method" id="paymentMethod" value="gateway">
                    <div class="modal-form__body">
                        <div class="mb-4">
                            <ul class="modal-form__info">
                                                                    <li class="modal-form__info-item">
                                        <span class="label">Down Payment</span>
                                        <span class="value">40%</span>
                                    </li>
                                    <li class="modal-form__info-item">
                                        <span class="label">Initial Invest Amount</span>
                                        <span class="value">
                                            $4,800.00
                                        </span>
                                    </li>
                                                                <li class="modal-form__info-item">
                                    <span class="label">Profit</span>
                                    <span class="value">
                                        25 - 40%
                                    </span>
                                </li>
                                <li class="modal-form__info-item">
                                    <span class="label">Profit Schedule</span>
                                    <span class="value">
                                        Repeat (Monthly)
                                    </span>
                                </li>
                                <li class="modal-form__info-item">
                                    <span class="label">Profit Back</span>
                                    <span class="value">
                                        7 days after investment completed                                    </span>
                                </li>
                            </ul>
                        </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-between flex-wrap">
                                <label class="form-label">Invest Amount</label>
                                                                    <div class="form-check mb-0">
                                        <input class="form-check-input" name="invest_full_amount" type="checkbox"
                                            value="true" id="invest_full_amount">
                                        <label class="form-check-label form-label" for="invest_full_amount">
                                            Invest Full Amount                                        </label>
                                    </div>
                                                            </div>
                            <div class="input-group--custom style-two">
                                                                    <input class="form--control" type="number" name="invest_amount"
                                        value="4800" readonly>
                                                                <span class="input-group-text">USD</span>

                            </div>
                            <div class="mt-2 preview-details d-none">
                                <span>
                                    <span>Charge:</span>
                                    <span class="text--base"><span class="charge ">0</span></span>,
                                </span>
                                <span>
                                    <span>Total Amount: </span> <span class="text--base"><span class="payable ">
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
                        Invest Now                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

 

@endsection

