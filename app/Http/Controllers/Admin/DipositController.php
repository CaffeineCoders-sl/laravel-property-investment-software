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

class DipositController extends Controller
{
    public function PendingDeposit(){

        $pendingDeposits = Diposit::with(['user','property','installment.investment.property'])->where('status','pending')->latest()->get();

        return view('admin.backend.deposit.pending_deposit',compact('pendingDeposits'));

    }
    // End Method 

    public function DepositDetails($id){
        $details = Diposit::with(['user','property','installment.investment.property'])->findOrFail($id);

        $investmentId = optional($details->installment)->investment_id;

        if (!$investmentId) {
           return back()->with('error','NO investment linked with this deposit');
        }

        $investment = Investment::with(['user','property','installments'])->findOrFail($investmentId);

        return view('admin.backend.deposit.details_deposit',compact('details','investment'));
    }
    // End Method 

    public function AdminDepositeStatusUpdate(Request $request , $id){

        $deposit = Diposit::findOrFail($id);
        $action = $request->input('action');

        if ($action === 'approved') {
            $deposit->status = 'approved';

            if ($deposit->installment_id) {
               $installment = Installment::find($deposit->installment_id);
               if ($installment) {
                 $installment->status = 'paid';
                 $installment->paid_time = now();
                 $installment->save();
               }
            } 

        } elseif ($action === 'rejected') {
           $deposit->status = 'rejected';

            if ($deposit->installment_id) {
               $installment = Installment::find($deposit->installment_id);
               if ($installment) {
                 $installment->status = 'due';
                 $installment->paid_time = null;
                 $installment->save();
               }
            } 
        }

        $deposit->save();

        $notification = array(
            'message' => 'Deposti Status updated Successfully',
            'alert-type' => 'success'
        ); 
        return redirect()->route('pending.deposit')->with($notification); 
    }
     // End Method 


     public function AapprovedDeposit(){

        $approvedDeposits = Diposit::with(['user','property','installment.investment.property'])->where('status','approved')->latest()->get();

        return view('admin.backend.deposit.approved_deposit',compact('approvedDeposits'));

    }
    // End Method 

   
    

}
