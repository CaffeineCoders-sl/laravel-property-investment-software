<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
     public function UserLogout(Request $request) {
        Auth::guard('web')->logout(); 
        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 
        return redirect('/login');
    }
     // End Method

     public function MyInvestment(){
        return view('home.dashboard.my_investment');
     }
     // End Method

      public function ProfitHistory(){
        return view('home.dashboard.profit_history');
     }
     // End Method

      public function DepositMoney(){
        return view('home.dashboard.deposit_money');
     }
     // End Method

      public function WithdrawMoney(){
        return view('home.dashboard.withdraw_money');
     }
     // End Method

      public function Transactions(){
        return view('home.dashboard.transactions');
     }
     // End Method

      public function ProfileSetting(){
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('home.dashboard.profile_setting',compact('profileData'));
     }
     // End Method

      public function UserChangePassword(){
        return view('home.dashboard.change_password');
     }
     // End Method


     public function UserProfileUpdate(Request $request){

        $id = Auth::user()->id;
        $data = User::find($id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->first_name = $request->first_name;
        $data->last_name = $request->last_name;
        $data->phone = $request->phone;
        $data->address = $request->address;

        $oldPhotoPath = $data->photo;

        if ($request->hasFile('photo')) {
           $file = $request->file('photo');
           $filename = time().'.'.$file->getClientOriginalExtension();
           $file->move(public_path('upload/profile_images'),$filename);
           $data->photo = $filename;

           if ($oldPhotoPath && $oldPhotoPath !== $filename) {
             $this->deleteOldImage($oldPhotoPath);
           } 
        }

        $data->save();

        $notification = array(
            'message' => 'Admin profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
             
    }
     // End Method

     private function deleteOldImage(string $oldPhotoPath): void {
        $fullPath = public_path('upload/profile_images/'.$oldPhotoPath );
        if (file_exists($fullPath)) {
           unlink($fullPath);
        }
     }
       // End Private Method



}
