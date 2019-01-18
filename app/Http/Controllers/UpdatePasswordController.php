<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Carbon\Carbon;

class UpdatePasswordController extends Controller
{
    //
    public function check(Request $request)
    {
        $cur_password = Hash::make($request->input('curr_password')); 
        $u_id=$request->input('u_id');  
        $pass= Hash::make($request->input('new_password')); 
        $data['user'] =  User::where('user_id',$u_id)
                            ->get();

  
     if(Hash::check($cur_password, $data['user'][0]['password']))
        return 1;
            
     else{
            User::where('user_id',$u_id)
                ->update(['password'=>$pass, 'updated_at'=>Carbon::today()]);
                
            return 0;
        }
    }
}
       