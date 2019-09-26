<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\book;
use App\title;
use App\publish;
use App\subj;
use App\member;
use App\ir;
use App\loca;
use App\Supplier;
use DB;
use Carbon\Carbon;

class SearchController extends Controller
{
    
    public function index(){
        $data = array();

        $data['publisher'] = publish::select('PUBCODE','PUBNAME')
                                            ->orderBy('PUBNAME')
                                            ->get();
        $data['subject'] = subj::select('SUBNO','SUBNAME')        
                                            ->orderBy('SUBNAME')
                                            ->get();
        $data['location'] = loca::select('LOCCD','LOCNAME')
                                        ->orderBy('LOCNAME')
                                        ->get();

        $data['suppliers_data'] = Supplier::get();
        

        return view('search',compact('data'));
    }

    public function search(Request $request){
        
        /* Fetching values from view :: STARTS */
        $accession_no = $request->input('accession_no');
        $type = trim($request->input('type'));
        $discard = $request->input('discard');
        $author_name = trim($request->input('author_name'));
        $title = trim($request->input('title'));
        $lib_no = strtoupper(trim($request->input('lib_no')));
        $editor = trim($request->input('editor'));
        $pub_name = $request->input('pub_name'); 
        $supplier = $request->input('supplier'); 
        $subject = $request->input('subject');
        $edition_no = $request->input('edition_no');
        $edition_year = $request->input('edition_year');
        $content = trim(strtoupper($request->input('content')));
        $loc_name = $request->input('loc_name');         
        $purchase_from_date = $request->input('purchase_from_date'); 
        $purchase_to_date = $request->input('purchase_to_date'); 
        $entry_from_date = $request->input('entry_from_date'); 
        $entry_to_date = $request->input('entry_to_date'); 
        $order_by = $request->input('order_by'); 
        $order_type = $request->input('order_type');        
        /* Fetching values from view :: ENDS */


        // Default SELECT query
        $select = 'SELECT DISTINCT "books"."ACCESSNO", "books"."TYPE", "books"."LIBNO", 
        "books"."TITLE", "publishes"."PUBNAME", "suppliers"."SUPPLIER_NAME", "books"."SUB1", "books"."AUFNAME1", "books"."AUFNAME2", 
        "books"."AUSNAME1", "books"."AUSNAME2", "books"."VOLNO", "books"."EDENO", "books"."EDINAME", 
        "books"."YEAR", "books"."PRICE", "books"."DTPUR", "books"."COPY_NO", "books"."CONTENT", "books"."ISSUE_FLAG"
        FROM books LEFT JOIN publishes ON "books"."PUBCODE" = "publishes"."PUBCODE"
        LEFT JOIN suppliers ON "books"."SUPPLIER_CODE" = "suppliers"."SUPPLIER_CODE"';

        // Default WHERE condition
        $where = ' WHERE ("books"."ISSUE_FLAG" IS NOT NULL OR "books"."ISSUE_FLAG" IS NULL) ';

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

        if($type!="")            
            $where = $where.' AND "books"."TYPE" ILIKE '."'%$type%'";

        if($discard=="true")
            $where = $where.' AND "books"."ISSUE_FLAG" ILIKE '."'%D%'";

        if($lib_no!="")
            $where = $where.' AND "books"."LIBNO" ILIKE '."'%$lib_no%'";

        if($subject!="")
           $where = $where.' AND ("books"."SUB1" = '."'$subject'".' OR "SUB2" = '."'$subject')";

        if($edition_no!="")
            $where = $where.' AND "books"."EDENO" = '.$edition_no;

        if($edition_year!="")
            $where = $where.' AND "books"."YEAR" = '.$edition_year;

        if($content!="")
            $where = $where.' AND "books"."CONTENT" ILIKE '."'%$content%'";

        if($purchase_from_date!="" && $purchase_to_date!="")
            $where = $where.' AND "books"."DTPUR" BETWEEN '."'$purchase_from_date'".' AND '."'$purchase_to_date'";
        
        if($entry_from_date!="" && $entry_to_date!="")
            $where = $where.' AND "books"."ENTRY_DATE" BETWEEN '."'$entry_from_date'".' AND '."'$entry_to_date'";

        $join="";        

        if($pub_name!=""){
            $where = $where.' AND "publishes"."PUBCODE" = '."'$pub_name'";
        }

        if($supplier!=""){
            $where = $where.' AND "books"."SUPPLIER_CODE" = '."'$supplier'";
        }

        if($title!=""){
            $where = $where.' AND "books"."TITLE" ilike'."'%$title%'";
        }

        if($loc_name!=""){
            $where = $where.' AND "books"."LOCNO" ='.$loc_name;
        }

        if($editor!=""){
            $where = $where.' AND "books"."EDINAME" ilike'."'%$editor%'";
        }

        
        if($author_name!=""){
            $where = $where.' AND (("books"."AUFNAME1" ILIKE '."'%$author_name%'".' OR "books"."AUSNAME1" ILIKE '."'%$author_name%')";
            $where = $where.' OR ("books"."AUFNAME2" ILIKE '."'%$author_name%'".' OR "books"."AUSNAME2" ILIKE '."'%$author_name%'))";
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
            16 =>'Content',
            17 => 'Previously Issued To',
            18 => 'Editor',
            19 => 'Subject',
            20 => 'Supplier',
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
        $select = 'SELECT COUNT(DISTINCT "books".*) FROM books LEFT JOIN publishes ON "books"."PUBCODE" = "publishes"."PUBCODE"';
        
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

                    $issued_to_details_1 = ir::join('members','irs.USERNO', '=', 'members.USERNO')
                                        ->where('irs.ACCESSNO',$data->ACCESSNO)
                                        ->orderBy('irs.DTISS','DESC')
                                        ->limit(1)
                                        ->get();

                    if(sizeof($issued_to_details_1)>0)
                        $nestedData['Previously Issued To'] = $issued_to_details_1[0]['UFNAME'].' '.$issued_to_details_1[0]['USNAME'];
                    else
                        $nestedData['Previously Issued To'] = 'NA';

                    $nestedData['Issue Date'] = 'NA';
                }
                if($data->ISSUE_FLAG=='Y'){
                    $nestedData['Book Status'] = '<span class="badge badge-danger not_available" style="background-color:#953b39; cursor:pointer">ISSUED</span>';                    
                    $issued_to_details_2 = ir::join('members','irs.USERNO', '=', 'members.USERNO')
                                        ->where('irs.ACCESSNO',$data->ACCESSNO)
                                        ->orderBy('irs.DTISS','DESC')
                                        ->limit(2)
                                        ->get();
                    $nestedData['Issued To'] = $issued_to_details_2[0]['UFNAME'].' '.$issued_to_details_2[0]['USNAME'];
                    
                    if(sizeof($issued_to_details_2)>1)
                        $nestedData['Previously Issued To'] = $issued_to_details_2[1]['UFNAME'].' '.$issued_to_details_2[1]['USNAME'];
                    else
                        $nestedData['Previously Issued To'] = 'NA';
                    
                    $nestedData['Issue Date'] = Carbon::parse($issued_to_details_2[0]['DTISS'])->format('d/m/Y');
                }
                if($data->ISSUE_FLAG=='D'){
                    $nestedData['Book Status'] = '<span class="badge badge-primary" style="background-color:#FF4500">DISCARDED</span>';
                    $nestedData['Issued To'] = 'NA';
                    $nestedData['Issue Date'] = 'NA';

                    $issued_to_details_3 = ir::join('members','irs.USERNO', '=', 'members.USERNO')
                                        ->where('irs.ACCESSNO',$data->ACCESSNO)
                                        ->orderBy('irs.DTISS','DESC')
                                        ->limit(1)
                                        ->get();

                    if(sizeof($issued_to_details_3)>0)
                        $nestedData['Previously Issued To'] = $issued_to_details_3[0]['UFNAME'].' '.$issued_to_details_3[0]['USNAME'];
                    else
                        $nestedData['Previously Issued To'] = 'NA';
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
                $nestedData['Editor'] = $data->EDINAME;
                $nestedData['Subject'] = $data->SUB1;
                $nestedData['Publisher'] = $data->PUBNAME;
                $nestedData['Supplier'] = $data->SUPPLIER_NAME;
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

    public function issue_return_search_index(){
        $data = array();
        
        $data['member'] = member::select('USERNO','UFNAME','USNAME')
                                            ->orderBy('UFNAME')
                                            ->get();        

        return view('issue_return_search',compact('data'));
    }

    public function issue_search(Request $request){
        $issue_to = $request->input('issue_to');
        $issue_from_date = $request->input('issue_from_date');
        $issue_to_date = $request->input('issue_to_date');
        $limit = $request->input('length'); // For No. of rows per page
        $start = $request->input('start');

        $columns = array( 
            0 =>'Accession No', 
            1 =>'Type',
            2 =>'Book Title',
            3 =>'Issued To',
            4 =>'Issue Date',
            5 =>'Return Status',
            6 =>'Library No',
        );

       // Default SELECT query
       $select = 'SELECT DISTINCT "books"."ACCESSNO", "books"."LIBNO", "books"."TYPE", "books"."TITLE", 
       "irs"."DTISS", "irs"."DTREC", "irs"."REC_FLAG" , "members"."UFNAME", "members"."USNAME"
       FROM books INNER JOIN irs ON "books"."ACCESSNO" = "irs"."ACCESSNO"
       INNER JOIN members ON "irs"."USERNO" = "members"."USERNO"';

       // Default WHERE condition
       $where = ' WHERE 1=1 ';

        // Default Order By query
        $orderBy = ' ORDER BY "irs"."DTISS", "members"."UFNAME", "books"."ACCESSNO"';
        $orderType = ' ASC';

        if($issue_from_date!="" && $issue_to_date!=""){            
            $where = $where.' AND "irs"."DTISS" BETWEEN '."'$issue_from_date'".' AND '."'$issue_to_date'";
        }  

        if($issue_to!=""){  
            $where = $where.' AND "irs"."USERNO" = '."'$issue_to'".' AND "books"."ISSUE_FLAG"='."'Y'".' AND ("irs"."REC_FLAG" IS NULL OR "irs"."REC_FLAG" <>'."'Y')";            
        }

        $limit_data =' LIMIT '.$limit. ' OFFSET '.$start;
        
        if($limit==-1)
            $limit_data='';

        // Data Fetched
        $data = DB::select($select.$where.$orderBy.$orderType.$limit_data); 

               
        // For getting the total no. of data
        $totalData = DB::select($select.$where);

        // For getting the total no. of data which is in this case equal to the total no. of filtered data as here is no search option in the dataTable
        $totalFiltered = sizeof($totalData);  
        $totalData = $totalFiltered;
                
        $books = array();

        if($data){
            foreach($data as $data1){ 
                $nestedData['Accession No'] = $data1->ACCESSNO;

                $nestedData['Library No'] = $data1->LIBNO;

                if($data1->TYPE =='J')
                    $nestedData['Type'] = 'Journal';
                
                if($data1->TYPE =='B')
                    $nestedData['Type'] = 'Book';
                    
                if($data1->TYPE =='P')
                    $nestedData['Type'] = 'Periodicals';

                if($data1->TYPE =='A')
                    $nestedData['Type'] = 'Bare Act';

                $nestedData['Book Title'] = $data1->TITLE;

                $nestedData['Issue Date'] = Carbon::parse($data1->DTISS)->format('d/m/Y');

                $nestedData['Issued To'] = $data1->UFNAME.' '.$data1->USNAME;

                if($data1->REC_FLAG=='Y')
                    $nestedData['Return Status'] = 'Returned';
                if($data1->REC_FLAG==null)
                    $nestedData['Return Status'] = 'Not Returned';

                $books[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" =>intval($totalFiltered),
            "data" => $books
        );

        echo json_encode($json_data);
    }


    public function return_search(Request $request){
        $return_from = $request->input('return_from');
        $return_from_date = $request->input('return_from_date');
        $return_to_date = $request->input('return_to_date');
        $limit = $request->input('length'); // For No. of rows per page
        $start = $request->input('start');

        $columns = array( 
            0 =>'Accession No', 
            1 =>'Type',
            2 =>'Book Title',
            3 =>'Return From',
            4 =>'Return Date',
            5 =>'Library No'
        );

       // Default SELECT query
       $select = 'SELECT DISTINCT "books"."ACCESSNO", "books"."LIBNO", "books"."TYPE", "books"."TITLE", "irs"."DTISS",
       "irs"."DTREC", "irs"."DTREC", "irs"."REC_FLAG" , "members"."UFNAME", "members"."USNAME"
       FROM books INNER JOIN irs ON "books"."ACCESSNO" = "irs"."ACCESSNO"
       INNER JOIN members ON "irs"."USERNO" = "members"."USERNO"';

       // Default WHERE condition
       $where = ' WHERE 1=1 ';

        // Default Order By query
        $orderBy = ' ORDER BY "irs"."DTREC", "members"."UFNAME", "books"."ACCESSNO"';
        $orderType = ' ASC';

        if($return_from_date!="" && $return_to_date!=""){            
            $where = $where.' AND "irs"."DTREC" BETWEEN '."'$return_from_date'".' AND '."'$return_to_date'";
        }  

        if($return_from!=""){  
            $where = $where.' AND "irs"."USERNO" = '."'$return_from'".' AND "irs"."REC_FLAG" ='."'Y'";            
        }

        $limit_data =' LIMIT '.$limit. ' OFFSET '.$start;
        
        if($limit==-1)
            $limit_data='';

        // Data Fetched
        $data = DB::select($select.$where.$orderBy.$orderType.$limit_data); 

        // For getting the total no. of data
        $select = 'SELECT  COUNT(DISTINCT "books".*)
        FROM books INNER JOIN irs ON "books"."ACCESSNO" = "irs"."ACCESSNO"
        INNER JOIN members ON "irs"."USERNO" = "members"."USERNO"';
        
        // For getting the total no. of data
        $totalData = DB::select($select.$where);

        // For getting the total no. of data which is in this case equal to the total no. of filtered data as here is no search option in the dataTable
        $totalFiltered = $totalData['0']->count;  
                
        $books = array();

        if($data){
            foreach($data as $data1){ 
                $nestedData['Accession No'] = $data1->ACCESSNO;

                $nestedData['Library No'] = $data1->LIBNO;

                if($data1->TYPE =='J')
                    $nestedData['Type'] = 'Journal';
                
                if($data1->TYPE =='B')
                    $nestedData['Type'] = 'Book';
                    
                if($data1->TYPE =='P')
                    $nestedData['Type'] = 'Periodicals';

                if($data1->TYPE =='A')
                    $nestedData['Type'] = 'Bare Act';

                $nestedData['Book Title'] = $data1->TITLE;

                $nestedData['Issue Date'] = Carbon::parse($data1->DTISS)->format('d/m/Y');

                $nestedData['Return Date'] = Carbon::parse($data1->DTREC)->format('d/m/Y');

                $nestedData['Return From'] = $data1->UFNAME.' '.$data1->USNAME;

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
}
