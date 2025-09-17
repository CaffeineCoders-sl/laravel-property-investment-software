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


}
