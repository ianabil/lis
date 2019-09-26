<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Carbon\Carbon;

class UserMasterMaintenanceController extends Controller
{

    public function get_data()
    {
        $data = array();        
        $data['login_users'] = User::get();
       
        return view('user_master_maintenance',compact('data'));
        
    }

    public function get_data_of_selected_user(Request $request)
    {
        $user_id = $request ->input('user_id');        
        $data = User::where('user_id',$user_id)->get();

        echo json_encode($data);
        
    }

     public function store(Request $request) // To Add New User
     {
        $user_id = $request->input('user_id'); 
        $name = $request->input('name'); 
        $email = $request->input('email_id'); 
        $password = Hash::make($request->input('password'));
        $status= $request->input('user_type');
        
        
        User::insert([
                        'user_id'=>$user_id,
                        'name'=>$name,
                        'email'=>$email,
                        'password'=>$password,
                        'status'=>$status,
                        'created_at'=>Carbon::today(),
                        'updated_at'=>Carbon::today()
                    ]);
        return 1;       
               
    }

    public function update_login_user_details(Request $request)
    {
        $this->validate ( $request, [ 
            'edit_password' => 'required|max:255',
            'edit_re_password' => 'required|max:255'            
        ]); 

        $user_id_select=$request->input('user_id_select');  
        $edit_password= $request->input('edit_password');  
        $edit_re_password=  $request->input('edit_re_password');
        $edit_type=  $request->input('edit_type');
        $edit_name=$request->input('edit_name');
        $edit_email=$request->input('edit_email');
        
        $data['user'] =  User::where('user_id',$user_id_select)
                             ->select()
                            ->get();
        
        $data['user'][0]['password'] = Hash::make($data['user'][0]['password']);
        
        if($edit_password ==  $data['user'][0]['password'])
            return 1;             

        else if($edit_password !=  $edit_re_password)  
            return 2;

        else
        {
            User::where('user_id',$user_id_select)
                        ->update([
                            'name'=>$edit_name,
                            'email'=>$edit_email,
                            'password'=>Hash::make($edit_password),
                            'status'=>$edit_type,
                            'updated_at'=>Carbon::today()
                        ]);
                                            
            return 0;
        }
    }

}
    