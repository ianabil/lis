<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\book;
use App\title;
use App\publish;
use App\subj;
use App\member;
use App\ir;
use DB;
use Carbon\Carbon;

class SearchController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    
    //
    public function index(){
        $data = array();
        $data['first_author_name'] = book::select('AUFNAME1','AUSNAME1')->distinct()->get();        
        $data['second_author_name'] = book::select('AUFNAME2','AUSNAME2')->distinct()->get();
        $data['book_title'] = title::select('TIT_CODE','TIT_DESC')->get();
        $data['publisher'] = publish::select('PUBCODE','PUBNAME')->get();
        $data['subject'] = subj::select('SUBNO','SUBNAME')->get();
        $data['member'] = member::select('USERNO','UFNAME','USNAME')->get();
        

        return view('search',compact('data'));
    }

    public function search(Request $request){
        
        /* Fetching values from view :: STARTS */
        $accession_no = $request->input('accession_no');
        $author_name = $request->input('author_name');
        $title = $request->input('title');
        $lib_no = strtoupper($request->input('lib_no'));
        $pub_name = $request->input('pub_name'); 
        $subject = $request->input('subject');
        $edition_no = $request->input('edition_no');
        $edition_year = $request->input('edition_year');
        $content = trim(strtoupper($request->input('content')));
        $issue_to_member = $request->input('issue_to_member'); 
        $purchase_from_date = $request->input('purchase_from_date');
        $purchase_to_date = $request->input('purchase_to_date');
        $issue_from_date = $request->input('issue_from_date'); 
        $issue_to_date = $request->input('issue_to_date');
        $entry_from_date = $request->input('entry_from_date');
        $entry_to_date = $request->input('entry_to_date');
        $order_by = $request->input('order_by'); 
        $order_type = $request->input('order_type');        
        /* Fetching values from view :: ENDS */


        // Default SELECT query
        $select = 'SELECT DISTINCT "books"."ACCESSNO", "books"."TYPE", "books"."LIBNO", 
        "books"."TITLE", "publishes"."PUBNAME", "books"."AUFNAME1", "books"."AUFNAME2", 
        "books"."AUSNAME1", "books"."AUSNAME2", "books"."VOLNO", "books"."EDENO", 
        "books"."YEAR", "books"."PRICE", "books"."DTPUR", "books"."COPY_NO", "books"."CONTENT", "books"."ISSUE_FLAG"
        FROM books LEFT JOIN publishes ON "books"."PUBCODE" = "publishes"."PUBCODE"';

        // Default WHERE condition
        $where = ' WHERE "books"."ISSUE_FLAG" IS NOT NULL';

        // Default Order By query
        $orderBy = ' ORDER BY "books"."ACCESSNO"';
        $orderType = ' ASC';

        /* Building SELECT and WHERE part of the sql query based on the 
        selected different options in the view :: STARTS */
        if($order_by!="")
            $orderBy = ' ORDER BY "books"."'.$order_by.'"';
        if($order_type!="")
            $orderType = ' '.$order_type;

        if($accession_no!="")
            $where = $where.' AND "books"."ACCESSNO" ='.$accession_no;

        if($lib_no!="")
            $where = $where.' AND "books"."LIBNO" LIKE '."'$lib_no'";

        if($subject!="")
           $where = $where.' AND "books"."SUB1" LIKE '."'$subject'".' OR "SUB2" LIKE '."'$subject'";

        if($edition_no!="")
            $where = $where.' AND "books"."EDENO" = '.$edition_no;

        if($edition_year!="")
            $where = $where.' AND "books"."YEAR" = '.$edition_year;

        if($content!="")
            $where = $where.' AND "books"."CONTENT" LIKE '."'%$content%'";

        if($purchase_from_date!="" && $purchase_to_date!="")
            $where = $where.' AND "books"."DTPUR" BETWEEN '."'$purchase_from_date'".' AND '."'$purchase_to_date'";
        
        if($entry_from_date!="" && $entry_to_date!="")
            $where = $where.' AND "books"."ENTRY_DATE" BETWEEN '."'$entry_from_date'".' AND '."'$entry_to_date'";

        $join="";        

        if($pub_name!=""){
            $where = $where.' AND "publishes"."PUBCODE" = '."'$pub_name'";
        }

        if($title!=""){
            $where = $where.' AND "books"."TIT_CODE" ='.$title;
        }

        if($issue_from_date!="" && $issue_to_date!=""){
            $join = $join.' INNER JOIN irs ON "books"."ACCESSNO" = "irs"."ACCESSNO"';
            $where = $where.' AND "irs"."DTISS" BETWEEN '."'$issue_from_date'".' AND '."'$issue_to_date'".' AND "irs"."REC_FLAG"!='."'Y'";
        }  

        if($issue_to_member!=""){
            $join = $join.' INNER JOIN irs ON "books"."ACCESSNO" = "irs"."ACCESSNO" INNER JOIN members ON "irs"."USERNO" = "members"."USERNO"';
            $where = $where.' AND "irs"."USERNO" = '."'$issue_to_member'".' AND "books"."ISSUE_FLAG"='."'Y'".' AND "irs"."REC_FLAG"!='."'Y'";
            
        }

        if($author_name!=""){
            $name = explode('-',$author_name);
            $f_name = $name[0];
            $s_name = $name[1];

            $where = $where.' AND "books"."AUFNAME1" LIKE '."'$f_name'".' AND "books"."AUSNAME1" LIKE '."'$s_name'";
        }
       
        /* Building SELECT, WHERE, JOIN and ORDER BY clause of the sql query based on the 
        selected different options in the view :: ENDS */
          
        // For dataTable :: STARTS
        $columns = array( 
            0 =>'Book Status',
            1 =>'Accession No',
            2 =>'Library No',
            3 =>'Type',
            4 =>'Book Title',
            5=>'Publisher',
            6 =>'First Author Name',
            7 =>'Second Author Name',
            8 =>'Volume No.',
            9 =>'Edition No.',
            10 =>'Edition Year',
            11 =>'Price (INR)',
            12 =>'Purchase Date',
            13 =>'Copy No',
            14 =>'Issued To',
            15 =>'Issue Date',
            16 =>'Content'
        );

        $limit = $request->input('length'); // For No. of rows per page
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        /* Setting the no. of rows returned from every sql query execution and 
           by skipping the no. of rows already displayed
        */
        $limit_data =' LIMIT '.$limit. ' OFFSET '.$start;
        
        if($limit==-1)
            $limit_data='';

        // Data Fetched
        $data = DB::select($select.$join.$where.$orderBy.$orderType.$limit_data); 

        // For getting the total no. of data
        $select = 'SELECT COUNT(*) FROM books LEFT JOIN publishes ON "books"."PUBCODE" = "publishes"."PUBCODE"';
        
        // For getting the total no. of data
        $totalData = DB::select($select.$join.$where);

        // For getting the total no. of data which is in this case equal to the total no. of filtered data as here is no search option in the dataTable
        $totalFiltered = $totalData['0']->count;  
                
        $books = array();

        // Building the data to send to the view
        if($data){
            foreach($data as $data){                
                if($data->ISSUE_FLAG==''){
                    $nestedData['Book Status'] = '<span class="badge badge-success" style="background-color:#468847">AVAILABLE</span>';
                    $nestedData['Issued To'] = 'NA';
                    $nestedData['Issue Date'] = 'NA';
                }
                if($data->ISSUE_FLAG=='Y'){
                    $nestedData['Book Status'] = '<span class="badge badge-danger not_available" style="background-color:#953b39; cursor:pointer">NOT AVAILABLE</span>';                    
                    $issued_to_details = ir::join('members','irs.USERNO', '=', 'members.USERNO')
                                        ->where('irs.ACCESSNO',$data->ACCESSNO)
                                        ->orderBy('irs.DTISS','DESC')
                                        ->first();
                    $nestedData['Issued To'] = $issued_to_details['UFNAME'].' '.$issued_to_details['USNAME'];
                    $nestedData['Issue Date'] = Carbon::parse($issued_to_details['DTISS'])->format('d/m/Y');
                }
                if($data->ISSUE_FLAG=='D'){
                    $nestedData['Book Status'] = '<span class="badge badge-primary" style="background-color:#FF4500">DISCARDED</span>';
                    $nestedData['Issued To'] = 'NA';
                    $nestedData['Issue Date'] = 'NA';
                }

                $nestedData['Accession No'] = $data->ACCESSNO;
                $nestedData['Library No'] = $data->LIBNO;

                if($data->TYPE =='J')
                    $nestedData['Type'] = 'Journal';
                
                if($data->TYPE =='B')
                    $nestedData['Type'] = 'Book';
                    
                if($data->TYPE =='P')
                    $nestedData['Type'] = 'Periodicals';

                if($data->TYPE =='A')
                    $nestedData['Type'] = 'Bare Act';

                $nestedData['Book Title'] = $data->TITLE;
                $nestedData['Publisher'] = $data->PUBNAME;
                $nestedData['First Author Name'] = $data->AUFNAME1." ".$data->AUSNAME1;
                $nestedData['Second Author Name'] =$data->AUFNAME2." ".$data->AUSNAME2;
                $nestedData['Volume No'] = $data->VOLNO;
                $nestedData['Edition No'] = $data->EDENO;
                $nestedData['Edition Year'] = $data->YEAR;
                $nestedData['Price (INR)'] = $data->PRICE;
                $nestedData['Purchase Date'] = Carbon::parse($data->DTPUR)->format('d/m/Y');
                $nestedData['Copy No'] = $data->COPY_NO;
                $nestedData['Content'] = $data->CONTENT;

                $books[] = $nestedData;
            }

        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData['0']->count),
            "recordsFiltered" =>intval($totalFiltered),
            "data" => $books
        );

        echo json_encode($json_data);

    }

    public function issued_to(Request $request){
        $accessno = $request->input('accessno');
        $issued_to_details = ir::join('members','irs.USERNO', '=', 'members.USERNO')
                                ->where('irs.ACCESSNO',$accessno)
                                ->orderBy('irs.DTISS','DESC')
                                ->first();

        $issued_to_details['DTISS'] = Carbon::parse($issued_to_details['DTISS'])->format('d/m/Y');
        
        echo json_encode($issued_to_details);
        
    }
}
