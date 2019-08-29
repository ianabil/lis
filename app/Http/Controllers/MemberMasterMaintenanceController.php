<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\member;

use App\book;

use Auth;

use App\ir;


use Carbon\Carbon;

class MemberMasterMaintenanceController extends Controller
{
    
    public function insert_new_member(Request $request)
    {
        $this->validate ( $request, [ 
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'valid_from' => 'required'            
        ] ); 

        $member_code = 1+ member::max('USERNO');
        $first_name = strtoupper($request->input('first_name'));
        $last_name = strtoupper($request->input('last_name'));
        $designation = strtoupper($request->input('designation'));
        $present_address = strtoupper($request->input('present_address'));
        $permanent_address = strtoupper($request->input('permanent_address'));
        $valid_from = $request->input('valid_from');
        $valid_upto = $request->input('valid_upto');        
        $usr_id=Auth::user()->user_id;

        member::insert(
            ['USERNO'=>$member_code,
             'UFNAME'=>$first_name,
             'USNAME'=>$last_name,
             'UDESIG'=>$designation,
             'UPRADD1'=>$present_address,
             'UPRADD2'=>$permanent_address,
             'VALIDFR'=>$valid_from,
             'VALIDTO'=>$valid_upto,
             'MODIFIED_ON'=> Carbon::today(),
             'UPLOAD_ON'=> Carbon::today(),
             'USR_ID'=> $usr_id
             ]
        );        

        $data['value']=$member_code;
        $data['result']="success";

        echo json_encode($data);
    }


    public function get_all_member_data(Request $request){
        $columns = array( 
            0 =>'USERNO', 
            1 =>'UFNAME',
            2 =>'USNAME',     
            3 =>'UDESIG',  
            4 =>'UPRADD1',  
            5 =>'UPRADD2',  
            6 =>'VALIDFR',  
            7 =>'VALIDTO',                                                              
            8=>'action'
        );

        $totalData = member::count();

        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value'))){
            $member = member::offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();
            $totalFiltered = member::count();
        }
        else{
            $search = strtoupper($request->input('search.value'));
            $member = member::where('USERNO','like',"%{$search}%")
                                ->orWhere('UFNAME','like',"%{$search}%")
                                ->orWhere('USNAME','like',"%{$search}%")     
                                ->orWhere('UDESIG','like',"%{$search}%")
                                ->orWhere('UPRADD1','like',"%{$search}%") 
                                ->orWhere('UPRADD2','like',"%{$search}%")
                                ->orWhere('VALIDFR','like',"%{$search}%") 
                                ->orWhere('VALIDTO','like',"%{$search}%")                                 
                                ->offset($start)
                                ->limit($limit)
                                ->orderBy($order,$dir)
                                ->get();
            $totalFiltered = member::where('USERNO','like',"%{$search}%")
                                    ->orWhere('UFNAME','like',"%{$search}%")
                                    ->orWhere('USNAME','like',"%{$search}%")     
                                    ->orWhere('UDESIG','like',"%{$search}%")
                                    ->orWhere('UPRADD1','like',"%{$search}%") 
                                    ->orWhere('UPRADD2','like',"%{$search}%")
                                    ->orWhere('VALIDFR','like',"%{$search}%") 
                                    ->orWhere('VALIDTO','like',"%{$search}%")                                  
                                    ->count();
        }

        
        $data = array();

        if($member){
            foreach($member as $m){
                $nestedData['USERNO'] = $m->USERNO;
                $nestedData['UFNAME'] = $m->UFNAME;
                $nestedData['USNAME'] = $m->USNAME;   
                $nestedData['UDESIG'] = $m->UDESIG;
                $nestedData['UPRADD1'] = $m->UPRADD1;                   
                $nestedData['UPRADD2'] = $m->UPRADD2;
                $nestedData['VALIDFR'] = $m->VALIDFR;   
                $nestedData['VALIDTO'] = $m->VALIDTO;
                $nestedData['action'] = '<i class="fa fa-trash" aria-hidden="true"></i>';                
                $data[] = $nestedData;
            }
        }

            $json_data = array(
                "draw" => intval($request->input('draw')),
                "recordsTotal" => intval($totalData),
                "recordsFiltered" =>intval($totalFiltered),
                "data" => $data
            );

        echo json_encode($json_data);
        
    }    



    public function update_member(Request $request){

        $this->validate ( $request, [ 
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255'            
        ] ); 



        $member_code = strtoupper($request->input('member_code')); 
        $first_name = strtoupper($request->input('first_name'));
        $last_name = strtoupper($request->input('last_name'));
        $designation = strtoupper($request->input('designation'));
        $present_address = strtoupper($request->input('present_address'));
        $permanent_address = strtoupper($request->input('permanent_address'));
        $valid_from = $request->input('valid_from');
        $valid_upto = $request->input('valid_upto');        
        $usr_id=Auth::user()->user_id;


        member::where('USERNO',$member_code)
                ->update([
                    'USERNO'=>$member_code,
                    'UFNAME'=>$first_name,
                    'USNAME'=>$last_name,
                    'UDESIG'=>$designation,
                    'UPRADD1'=>$present_address,
                    'UPRADD2'=>$permanent_address,
                    'VALIDFR'=>$valid_from,
                    'VALIDTO'=>$valid_upto,
                    'MODIFIED_ON'=> Carbon::today(),
                    'USR_ID'=> $usr_id                           
                    ]);

       return 1;


    }    


    public function destroy(Request $request)
    {
        $member_code = $request->input('member_code');
        $irs_count = ir::where('USERNO',$member_code)->count();
                    

        if($irs_count>=1){
           return 0;    
        }
        else{
            member::where('USERNO',$member_code)->delete(); // parent table
            return 1;
        }

        return 0;
    }

}
