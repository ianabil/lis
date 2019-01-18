<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\book;

use App\loca;

use App\ir;

use Carbon\Carbon;

use Auth;

class DiscardBookManagementController extends Controller
{
   

    public function get_data()
    {
        $data = array();        
        $data['location_data'] = loca::get();
       
        return view('marked_for_discarded_book',compact('data'));
        
    }


    public function get_book_data_to_discard(Request $request)
    {

        $this->validate ( $request, [ 
            'accession_no' => 'required|max:7'         
        ] ); 

        $data = array();  
        $accession_no = $request->input('accession_no');      
        
        $data['book'] = book::where('ACCESSNO',$accession_no)
                        ->get();


        
            if( count($data['book']) ==0 )
            {
                $data['value']="Invalid Accession No.";
                $data['result']="invald_accessno";
            }
            else if($data['book']['0']['ISSUE_FLAG'] == "Y")
            {
                $flag="Y";

                $data['issued_to']= ir::
                             join('books','irs.ACCESSNO', '=', 'books.ACCESSNO')
                             -> join('members', 'irs.USERNO','=','members.USERNO')
                             ->where([
                                 ['irs.ACCESSNO',$accession_no],
                                 ['irs.REC_FLAG','<>',$flag]
                             ])                             
                             ->select('members.UFNAME','members.USNAME')
                             ->get();   
                
                $data['value']="Book is already issued to ".trim($data['issued_to']['0']['UFNAME'])." ".trim($data['issued_to']['0']['USNAME']);
                $data['result']="issued";
                
            }
            else if($data['book']['0']['ISSUE_FLAG'] == "D" )
            {
                $data['value']="Book is already discarded";
                $data['result']="discarded";                
            }
            else
            {          
                if($data['book']['0']['LOCNO'] !="")
                {
                    $data['location'] = book::
                                        join('locas','books.LOCNO', '=', 'locas.LOCCD')
                                        ->where('ACCESSNO',$accession_no)
                                        ->select('locas.LOCNAME')
                                        ->get();
                    $data['result']="success_with_locname";
                }
                else
                {
                    $data['result']="success_without_location";
                }          
                
               
                
            }

            
        echo json_encode($data);   
        
    }




    public function update_book_to_discard(Request $request)
    {
            $accession_no = $request->input('accession_no');
            $location_change = $request->input('location_change');
            $update_date = Carbon::today();  
            $discard_flag="D";
            $usr_id=Auth::user()->user_id;

            //To Check whether book already issued or discarded 
            $data = array();  
            $data['book'] = book::where('ACCESSNO',$accession_no)
                            ->select('ISSUE_FLAG')
                            ->get();
  

            if($data['book']['0']['ISSUE_FLAG'] == "D")
            {
                return 0;
            }
            else if($data['book']['0']['ISSUE_FLAG'] == "Y" )
            {
                return 1;
            }
            else
            {                
                book::where('ACCESSNO',$accession_no)
                    ->update([
                        'LOCNO'=>$location_change,
                        'ISSUE_FLAG'=> $discard_flag,
                        'MODIFIED_ON'=>$update_date,
                        'USR_ID'=>$usr_id                 
                        ]
                );         
                return 2;
            }

    }                
}
