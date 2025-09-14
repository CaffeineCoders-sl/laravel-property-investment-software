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
use Illuminate\Support\Facades\DB;

class InvestmentController extends Controller
{
    public function UserInvestProperty($slug){
        $property = Property::where('slug',$slug)
            ->withCount(['investments as sold_shares' => function($query){
                $query->select(DB::raw('SUM(share_count)'));
            }])
            ->firstOrFail();
        $availableShare = max(0, ($property->total_share - $property->sold_shares));

        return view('home.frontend.checkout.checkout_page',compact('property','availableShare'));
    }
    /// End Method 





}
