<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\book;
use App\loca;
use App\ir;
use App\publish;

use App\member;

use Carbon\Carbon;


class IssueBookController extends Controller
{
    //

    public function get_data_on_load()
    {
        //
        $data = array();
        $data['members_data'] = member::get();
        
       return view('issue_books',compact('data'));
      // return view('test',compact('data'));
        
    }



    public function get_data_for_issue_book(Request $request)
    {
        $this->validate ( $request, [ 
            'id' => 'required|max:7'
        ] ); 

        $id = $request->input('id');
        
        $data['book'] = book::where('ACCESSNO',$id)
                        ->get();
        
        //Convert dat to DD-MM-YYYY format
         $data['book']['0']['DTPUR']=Carbon::parse($data['book']['0']['DTPUR'])->format('d-m-Y');
         $data['book']['0']['ENTRY_DATE']=Carbon::parse($data['book']['0']['ENTRY_DATE'])->format('d-m-Y');


        if( count($data['book']) ==0 )
        {
            $data['value']="Invalid Accession No.";
            $data['result']="invald_accessno";
        }
        else if($data['book']['0']['ISSUE_FLAG'] == "Y")
        {
            $data['value']="Book already issued";
            $data['result']="already_issued";
        } 
        else if($data['book']['0']['ISSUE_FLAG'] == "D")
        {
            $data['value']="Book already discarded";
            $data['result']="already_discarded";
        }                    
                  
        else
        {

        
            $data['publisher'] = book::
                                    leftjoin('publishes','books.PUBCODE','=','publishes.PUBCODE')
                                   ->where('books.ACCESSNO',$id)
                                   ->select('publishes.PUBNAME')
                                   ->get();                            
                   
            $data['location'] = book::
                                    leftjoin('locas','books.LOCNO', '=', 'locas.LOCCD')
                                    ->where('books.ACCESSNO',$id)
                                    ->select('locas.LOCNAME')
                                    ->get();


            $data['result']="success";
        }
        
        echo json_encode($data);
    }





    public function insert_data_issue_book(Request $request)
    {

            $accessno = $request->input('id'); 
            $member_name = $request->input('member_name');
            $date_of_issue = Carbon::parse($request->input('date_of_issue'))->format('Y-m-d');            
            $issue_flag="Y";


            $data= array();

            ir::insert(
                ['ACCESSNO'=>$accessno,
                 'USERNO'=>$member_name,
                 'REC_FLAG'=>"",
                 'DTISS'=>$date_of_issue
                 ]
            );

            book::where('ACCESSNO',$accessno)
                ->update(['ISSUE_FLAG'=>$issue_flag 
                ]        
            );

            $data['value']=$accessno;
            $data['result']="success";

            echo json_encode($data);
            //return $data;

    }


}
