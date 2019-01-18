<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\book;
use App\ir;
use App\member;
use App\publish;
use Auth;

use Carbon\Carbon;

class ReturnBookController extends Controller
{
    public function get_data_to_return_book(Request $request)
    {
        $this->validate ( $request, [ 
            'accession_no' => 'required|max:7'
        ] ); 

        $accession_no = $request->input('accession_no');
        $flag="Y";
        $data['books'] = book::where('ACCESSNO',$accession_no)
                        ->get();

        //Convert dat to DD-MM-YYYY format
        $data['books']['0']['DTPUR']=Carbon::parse($data['books']['0']['DTPUR'])->format('d-m-Y');
        $data['books']['0']['ENTRY_DATE']=Carbon::parse($data['books']['0']['ENTRY_DATE'])->format('d-m-Y');


        if( count($data['books']) ==0 )
        {
            $data['value']="Invalid Accession No.";
            $data['result']="invald_accessno";
        }
        else if($data['books']['0']['ISSUE_FLAG'] == "D")
        {         
            $data['value']="Book is already Discarded";
            $data['result']="discarded";
            
        }
        else if($data['books']['0']['ISSUE_FLAG'] != $flag)
        {         
            $data['value']="Book is not Issued";
            $data['result']="not_issued";
            
        }        
        else 
        {
            $data['issued_to']= ir::
                             join('books','irs.ACCESSNO', '=', 'books.ACCESSNO')
                             -> join('members', 'irs.USERNO','=','members.USERNO')
                             ->where([
                                 ['irs.ACCESSNO',$accession_no],
                                 ['irs.REC_FLAG','<>',$flag]
                             ])                             
                             ->select('irs.USERNO','irs.DTISS', 'members.UFNAME','members.USNAME')
                             ->get();   

            $data['publisher'] = book::
                                 leftjoin('publishes','books.PUBCODE','=','publishes.PUBCODE')
                                 ->where('books.ACCESSNO', $accession_no)
                                 ->select('publishes.PUBNAME')
                                 ->get();    

            $data['location'] = book::
                                leftjoin('locas','books.LOCNO', '=', 'locas.LOCCD')
                                ->where('books.ACCESSNO', $accession_no)
                                ->select('locas.LOCNAME')
                                ->get();


            $data['result']="can_be_returned";

        }

        echo json_encode($data);
        
    }






    public function update_receive_book_record(Request $request)
    {
            $accession_no = $request->input('accession_no');
            $member_code= $request->input('member_code');                       
            $date_of_receipt= $request->input('date_of_receipt');              
            $update_date = Carbon::today();    
            $flag="Y";         
            $usr_id=Auth::user()->user_id;


//echo $accession_no.",".$member_code.",".$date_of_receipt  ;
                        
            ir::where([
                    ['irs.ACCESSNO',$accession_no],
                    ['irs.USERNO',$member_code],
                    ['irs.REC_FLAG','<>',$flag]
                ])  
                ->update([
                    'REC_FLAG'=> $flag,
                    'DTREC'=> $date_of_receipt,                    
                    'MODIFIED_ON'=>$update_date,
                    'USR_ID'=>$usr_id                 
                    ]
            );         
 
            book::where('ACCESSNO',$accession_no)
                  ->update([
                        'ISSUE_FLAG'=> "", // *** in prevois version value is " " now it is ""
                        'MODIFIED_ON'=>$update_date,
                        'USR_ID'=>$usr_id                 
                        ]
            );         

            return 1;
    }                




}
