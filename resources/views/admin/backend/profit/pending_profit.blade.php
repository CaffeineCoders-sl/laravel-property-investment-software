@extends('admin.admin_dashboard')
@section('admin') 

<header class="page-header">
    <h2>Pending Profits </h2> 
    <div class="right-wrapper text-end">
        <ol class="breadcrumbs">
            <li>
                <a href="index.html">
                    <i class="bx bx-home-alt"></i>
                </a>
            </li> 
            <li><span>Pending Profits</span></li>  
        </ol>  
    </div>
</header>


<div class="row">
<div class="col">
    <section class="card">
        <header class="card-header"> 

  <h2 class="card-title">Pending Profits</h2>
        </header>
        <div class="card-body">
            <div class="table-responsive">
<table class="table table-responsive-lg table-bordered table-striped table-lg mb-0">
    <thead>
        <tr>
            <th>Property Name </th>
            <th>Total Profit Amount </th>
            <th>Total Investor </th>
            <th>Schedule </th>
            <th>Repeat Time </th>
            <th>Action</th> 
        </tr>
    </thead>
    <tbody>
      @foreach ($profits as $item) 
        <tr>
            <td>{{ $item->property->title }}</td>
            <td>${{ $item->monthly_profit }}</td>
            <td>{{ $item->investor_count }}</td>
            <td>{{ $item->schedule }}</td>
            <td>{{ $item->repeat_time }}</td>
            
            <td>
    <button class="btn btn-primary">Discharge</button>    
             </td>  
        </tr>
      @endforeach  
            
    </tbody>
</table>
            </div>
        </div>
    </section>
</div>
</div>


@endsection
