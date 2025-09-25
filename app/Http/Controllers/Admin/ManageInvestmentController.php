<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Installment;
use App\Models\Investment;
use App\Models\Property;
use App\Models\Profit;
use App\Models\Diposit;
use App\Models\Time;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\CapitalReturn;

class ManageInvestmentController extends Controller
{
    public function RunningInvestment(){
   
    $properties = Property::whereHas('investments', function ($q) {
        $q->where('payment_status', '!=', 'failed')
        ->where('status','active');
    })
    ->with(['investments' => function($q) {
         $q->where('payment_status', '!=', 'failed')
          ->where('status','active')
          ->with(['user','installments']);
    }])
    ->get()
    ->filter(function ($property) {

        $soldShares = $property->investments->sum('share_count');

        // Return only if shares are still avaibable
        return $soldShares < $property->total_share;

    })
    ->sortByDesc('created_at')
    ->values();  

    return view('admin.backend.investment.running_investment',compact('properties'));

    }
    //End Method 


   public function CompleteInvestment(){
   
    $properties = Property::whereHas('investments', function ($q) {
        $q->where('payment_status', '!=', 'failed')
        ->where('status','active');
    })
    ->with(['investments' => function($q) {
         $q->where('payment_status', '!=', 'failed')
          ->where('status','active')
          ->with(['user','installments']);
    }])
    ->get()
    ->filter(function ($property) {

        $soldShares = $property->investments->sum('share_count');

        // Return only if shares are still avaibable
        return $soldShares >= $property->total_share;

    })
    ->sortByDesc('created_at')
    ->values();  

    return view('admin.backend.investment.complete_investment',compact('properties'));
    
    }
    //End Method 

   public function AllInvestment(){
   
    $properties = Property::whereHas('investments', function ($q) {
        $q->where('payment_status', '!=', 'failed')
        ->where('status','active');
    })
    ->with(['investments' => function($q) {
         $q->where('payment_status', '!=', 'failed')
          ->where('status','active')
          ->with(['user','installments']);
    }])
    ->get() 
    ->sortByDesc('created_at')
    ->values();  

    return view('admin.backend.investment.all_investment',compact('properties'));
    
    }
    //End Method


    public function AdminPropertyDetails($id){

        $investment = Investment::with(['user','property'])->findOrFail($id);
        $allInvestments = Investment::with(['user','installments'])
                    ->where('property_id',$investment->property_id )
                    ->where('payment_status', '!=','failed')
                    ->where('status','active')
                    ->get();
        return view('admin.backend.investment.details',compact('investment','allInvestments'));
    }
    //End Method

    public function UserPayHistory($id){
        $investment = Investment::with(['user','property','installments'])->findOrFail($id);
        return view('admin.backend.investment.user_pay_history',compact('investment'));

    } 
     //End Method

    public function AdminCapitalBack($investmentId){

        DB::beginTransaction();
        try {
     $investment = Investment::with('property')->findOrFail($investmentId);

     if ($investment->capitalReturn) {
        return back()->with('error','Capital already returned for this user');
     }

     $property = $investment->property;

     if (!$property->per_share_amount || $property->per_share_amount <= 0) {
        return back()->with('error','Per share amount is not defined for this property');
     }

     CapitalReturn::create([
        'investment_id' => $investment->id,
        'user_id' => $investment->user_id,
        'property_id' => $property->id,
        'amount' => $investment->share_count * $property->per_share_amount,
        'paid_date' => now(),
        'trx' => strtoupper(Str::random(10)),
        'status' => 'paid',
     ]);
     DB::commit();

     $notification = array(
            'message' => 'Capital return to the user Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

        } catch (\Exception $e) {
           DB::rollBack();
           return back()->with('error','Failed to reutn capital'.$e->getMessage());
        }

    }
     //End Method

    public function AdminInstallmentReport(){

        $installments = Installment::with(['investment.user','investment.property','investment.installments'])  
                    ->get()
                    ->groupBy(function($item){
                        return optional($item->investment->user)->id;
                    });
        return view('admin.backend.installment.installment_report',compact('installments'));
    }
    //End Method 




}
