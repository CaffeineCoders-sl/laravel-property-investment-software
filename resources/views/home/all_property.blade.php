@extends('home.home_master')
@section('home')

 <section class="breadcrumb bg-img"
    data-background-image="{{ asset('frontend/assets/images/65c469d3e22771707370963.png') }}">
    <div class="container ">
        <div class="breadcrumb__wrapper">
            <h3 class="breadcrumb__title">Properties</h3>
        </div>
    </div>
</section>
    <div class="property-page py-120 bg-pattern">
        <div class="container ">
            <div class="property-page-inner">
                <aside id="property-page-sidebar" class="property-page-sidebar">
                    <button class="close-btn" type="button">
                        <i class="fas fa-times"></i>
                    </button>
                    <form action="//realvest/properties" class="filter-form">
                        <div class="filter-form__block">
                            <h6 class="title">Search Property</h6>
                            <div class="form-group">
                                <input class="form--control" type="text" name="search" value=""
                                    placeholder="What are you looking for?">
                            </div>
                            <div class="form-group">
                                <select name="location_id" class="form-control form--control select2 on-change-submit"
                                    required>
             <option value="">Select Location</option>   New York, USA</option>
          <option value="2" >
    London, England</option>
                                    <option value="3" >
    Paris, France</option>
                                    <option value="4" >
    Berlin, Germany</option>
                                    <option value="5" >
    Tokyo, Japan</option>
                                    <option value="6" >
    San Francisco, USA</option>
                            </select>
                            </div>
    <div class="form-group">
        <select name="invest_type" class="form-control form--control select2 on-change-submit"
            data-minimum-results-for-search="-1" required>
            <option value="">Investment Type</option>
        <option value="1" >
                Onetime Investment                                    </option>
            <option value="2" >
                Investment By Installment                                    </option>
        </select>
    </div>
                            <div class="form-group">
                                <select name="profit_schedule" class="form-control form--control select2 on-change-submit"
                                    data-minimum-results-for-search="-1" required>
      <option value="">Profit Schedule</option>
       <option value="3" >
        One Time      </option>
    <option value="1" >
        Lifetime      </option>
    <option value="2" >
        Repeated Time        </option>
    </select>
                            </div>
    <div class="form-group">
        <label for="" class="form--label">Capital Back</label>
        <div class="form-check">
            <input class="form-check-input on-change-submit" name="is_capital_back" type="radio"
                value="" id="capital-all" checked>
            <label class="form-check-label" for="capital-all">
                All                                    </label>
        </div>
        <div class="form-check">
            <input class="form-check-input on-change-submit" name="is_capital_back" type="radio"
                value="1" id="capital-yes"
                >
            <label class="form-check-label" for="capital-yes">
                Yes                                    </label>
        </div>
        <div class="form-check">
            <input class="form-check-input on-change-submit" type="radio"
                value="2" name="is_capital_back" id="capital-no"
                >
            <label class="form-check-label" for="capital-no">
                No                                    </label>
        </div>
    </div>
    <div class="form-group">
        <div class="filter-form__block">
            <label class="form--label">Investment Range</label>
            <div class="range-slider">
                <div class="range-slider__inputs">
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input id="min-range" class="form--control" type="number"
                            name="minimum_invest" value="">
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input id="max-range" class="form--control" type="number"
                            name="maximum_invest" value="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

                        <button type="submit" class="btn--sm btn btn-outline--base w-100">
                            <i class="las la-filter"></i> Filter Now                        </button>
                    </form>
                </aside>



                <div class="property-page-content">
                    <div class="text-end d-lg-none mb-4">
                        <button class="btn btn--sm btn-outline--base btn--sidebar-open" type="button" data-toggle="sidebar"
                            data-target="#property-page-sidebar">
                            <i class="las la-filter"></i>
                        </button>
                    </div>
                    <div class="row gy-4 g-sm-3 g-md-4 justify-content-center">
           
  @foreach ($allproperty as $item) 
   <div class="col-sm-6 col-lg-6">
<article class="card property--card border-0">
<a class="card-img-top " href="{{ route('property.details',$item->slug) }}">
    <img src="{{ asset($item->image) }}"
        alt="property-image">
</a>
<div class="card-body px-2 py-3 p-md-3 p-xl-4">
    <div class="card-body-top">
        <h5 class="card-title mb-2">
            <a href="{{ route('property.details',$item->slug) }}"> {{ $item->title }}</a>
        </h5>
        <ul class="card-meta card-meta--one">
            <li class="card-meta__item card-meta__item__location">
                <i class="fas fa-map-marker-alt"></i>
                <span class="text">{{ $item->location->name }}</span>
            </li>
        </ul>
    </div>
    <div class="card-body-middle">
        <div class="card-progress mb-4">
            <div class="card-progress__bar">
                <div class="card-progress__thumb" style="width: 100%;"></div>
            </div>
            <span class="card-progress__label fs-12">
                {{ $item->total_share }} Investors |
                ${{ $item->per_share_amount }}
                ({{ $item->down_payment }}%)
            </span>
        </div>
        <ul class="card-meta card-meta--two">
            <li class="card-meta__item">
                <div class="text">
                    {{ $item->profit_amount }}
                </div>
                <span class="subtext">Profit</span>
            </li>
            <li class="card-meta__item">
                <div class="text">
                    Repeat ({{ $item->repeat_time }})
                </div>
                <span class="subtext">Profit Schedule</span>
            </li>
            <li class="card-meta__item">
                <div class="text">
                     {{ $item->capital_back }}
                </div>
                <span class="subtext">Capital Back</span>
            </li>
        </ul>
    </div>
    <div class="card-body-bottom mb-4">
        <a class="btn btn--sm btn--base" href="{{ route('property.details',$item->slug) }}"
            role="button">Details</a>
        <span class="card-price">$ ${{ $item->per_share_amount }}</span>
    </div>
</div>
</article>
</div>
@endforeach        
 


     
         </div>
                </div>
            </div>
        </div>
    </div>




@endsection