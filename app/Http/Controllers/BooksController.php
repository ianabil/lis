<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\book;
use App\publish;
use App\loca;
use App\subj;
use App\title;
use Auth;
use Carbon\Carbon;

class BooksController extends Controller
{
    
    public function store(Request $request) // To Add New Books
    {
        $this->validate ($request, [ 
            'library_no' => 'required|max:255|unique:books,LIBNO', 
            'title_code' => 'required', 
            'new_title' => 'nullable|max:100',
            'first_author_first_name' => 'max:50',
            'first_author_last_name' => 'max:50',
            'type' => 'required|max:255',
            'publisher' => 'nullable|exists:publishes,PUBCODE',
            'subject' => 'nullable|exists:subjs,SUBNO',
            'entry_date' => 'required|date',
            'purchase_date' => 'nullable|date',
            'edition_year_1' => 'nullable|integer',
            'edition_year_2' => 'nullable|integer',
            'edition_no' => 'nullable|integer',
            'total_page' => 'nullable|integer',
            'price' => 'nullable|between:0,999999.99',
            'copy_no' => 'nullable|integer'
        ]); 
        
            $accessno = 1+ book::max('ACCESSNO'); 
            $libno = strtoupper(trim($request->input('library_no'))); 
            $tit_code = $request->input('title_code');
            $new_title = strtoupper(trim($request->input('new_title')));
            $flag = $request->input('flag');
            $title = strtoupper(trim($request->input('title')));
            $type = $request->input('type'); 
            $volno = $request->input('volume_no');
            $partno = $request->input('part_no'); 
            $edeno = $request->input('edition_no');
            if($edeno=="")
                $edeno = null;
            $year = $request->input('edition_year_1'); 
            if($year=="")
                $year = null;
            $year1 = $request->input('edition_year_2');
            if($year1=="")
                $year1 = null;
            $page = $request->input('total_page');
            if($page=="")
                $page = null;
            $price = $request->input('price');
            if($price=="")
                $price = null;
            $ausname1 = trim(strtoupper($request->input('first_author_last_name')));
            $aufname1 = trim(strtoupper($request->input('first_author_first_name')));
            $ausname2 = trim(strtoupper($request->input('second_author_last_name')));
            $aufname2 = trim(strtoupper($request->input('second_author_first_name')));
            $pubcode = $request->input('publisher');
            $ediname = strtoupper($request->input('editor'));
            $dtpur = Carbon::parse($request->input('purchase_date'))->format('Y-m-d');
            $sub1 = $request->input('subject');
            $reference = $request->input('reference');
            $locno = $request->input('location');
            if($locno=="")
                $locno=null;
            $copy_no = $request->input('copy_no');
            if($copy_no=="")
                $copy_no = null;
            $content = strtoupper($request->input('content'));
            $entry_date = Carbon::parse($request->input('entry_date'))->format('Y-m-d');
            $update_date = Carbon::today();  
            $uploaded_date = Carbon::today();  
            $user_id = Auth::user()->user_id;
            $issue_flag = null;

            if($flag=='new_title'){
                $count = title::where('TIT_DESC','ilike',$new_title)->count(); 
                
                if($count<1)
                {                              
                    title::insert([
                        'TIT_DESC'=>$new_title, 
                        'UPLOAD_ON'=>$uploaded_date, 
                        'MODIFIED_ON'=>$update_date, 
                        'USR_ID'=>$user_id
                    ]); 

                    $tit_code = title::max('TIT_CODE');
                    $title = $new_title;
                }
                else{
                    $tit_code = title::where('TIT_DESC',$new_title)->max('TIT_CODE');
                    $title = $new_title;
                }
                
            }


            book::insert([
                'ACCESSNO'=>$accessno,
                 'LIBNO'=>$libno,
                 'TIT_CODE'=>$tit_code,
                 'TITLE'=>$title,
                 'TYPE'=>$type,
                 'VOLNO'=>$volno,
                 'PARTNO'=>$partno,
                 'EDENO'=>$edeno,
                 'YEAR'=>$year,
                 'YEAR1'=>$year1,
                 'PAGE'=>$page,
                 'PRICE'=>$price,
                 'AUSNAME1'=>$ausname1,
                 'AUFNAME1'=>$aufname1,
                 'AUSNAME2'=>$ausname2,
                 'AUFNAME2'=>$aufname2,
                 'PUBCODE'=>$pubcode,
                 'EDINAME'=>$ediname,
                 'DTPUR'=>$dtpur,
                 'SUB1'=>$sub1,
                 'SUB2'=>$reference,
                 'LOCNO'=>$locno,
                 'COPY_NO'=>$copy_no,
                 'CONTENT'=>$content,
                 'ISSUE_FLAG'=>$issue_flag,
                 'ENTRY_DATE'=>$entry_date,
                 'MODIFIED_ON'=>$update_date,
                 'UPLOAD_ON'=>$uploaded_date,
                 'USR_ID'=>$user_id
            ]);

            
        $data['accession_no'] = $accessno;
        $data['library_no'] = $libno;
        echo json_encode($data);
            
    }

    
    public function show($id)
    {        
        $data = array();
        
        $data['book'] = book::where('ACCESSNO',$id)->get();
        $data['book_count'] = count($data['book']);        
        
        echo json_encode($data);
    }

    
    
    public function update(Request $request, $id)
    {
        $this->validate ($request, [ 
            'library_no' => 'required|max:255',
            'new_title' => 'nullable|max:100',
            'first_author_first_name' => 'max:50',
            'first_author_last_name' => 'max:50',
            'type' => 'required|max:255',
            'publisher' => 'nullable|exists:publishes,PUBCODE',
            'subject' => 'nullable|exists:subjs,SUBNO',
            'entry_date' => 'required|date',
            'purchase_date' => 'nullable|date',
            'edition_year_1' => 'nullable|integer',
            'edition_year_2' => 'nullable|integer',
            'edition_no' => 'nullable|integer',
            'total_page' => 'nullable|integer',
            'price' => 'nullable|between:0,999999.99',
            'copy_no' => 'nullable|integer'
        ]); 

            $accession_no = $request->input('accession_no');
            $libno = strtoupper(trim($request->input('library_no'))); 
            $tit_code = $request->input('title_code');
            $title = strtoupper(trim($request->input('title')));
            $type = $request->input('type'); 
            $volno = $request->input('volume_no');
            $partno = $request->input('part_no'); 
            $edeno = $request->input('edition_no');
            if($edeno=="")
                $edeno = null;
            $year = $request->input('edition_year_1'); 
            if($year=="")
                $year = null;
            $year1 = $request->input('edition_year_2');
            if($year1=="")
                $year1 = null;
            $page = $request->input('total_page');
            if($page=="")
                $page = null;
            $price = $request->input('price');
            if($price=="")
                $price = null;
            $ausname1 = trim(strtoupper($request->input('first_author_last_name')));
            $aufname1 = trim(strtoupper($request->input('first_author_first_name')));
            $ausname2 = trim(strtoupper($request->input('second_author_last_name')));
            $aufname2 = trim(strtoupper($request->input('second_author_first_name')));
            $pubcode = $request->input('publisher');
            $ediname = strtoupper($request->input('editor'));
            $dtpur = Carbon::parse($request->input('purchase_date'))->format('Y-m-d');
            $sub1 = $request->input('subject');
            $reference = $request->input('reference');
            $locno = strtoupper($request->input('location'));
            if($locno=="")
                $locno=null;
            $copy_no = $request->input('copy_no');
            if($copy_no=="")
                $copy_no = null;
            $content = strtoupper($request->input('content'));
            $entry_date = Carbon::parse($request->input('entry_date'))->format('Y-m-d');
            $update_date = Carbon::today(); 
            $user_id = Auth::user()->user_id;


            if($tit_code==""){                                            
                title::insert([
                    'TIT_DESC'=>$title, 
                    'UPLOAD_ON'=>Carbon::today(), 
                    'MODIFIED_ON'=>$update_date, 
                    'USR_ID'=>$user_id
                ]); 

                $tit_code = title::max('TIT_CODE');
            }
                        

        book::where('ACCESSNO',$accession_no)
            ->update([
                'LIBNO'=>$libno,
                 'TIT_CODE'=>$tit_code,
                 'TITLE'=>$title,
                 'TYPE'=>$type,
                 'VOLNO'=>$volno,
                 'PARTNO'=>$partno,
                 'EDENO'=>$edeno,
                 'YEAR'=>$year,
                 'YEAR1'=>$year1,
                 'PAGE'=>$page,
                 'PRICE'=>$price,
                 'AUSNAME1'=>$ausname1,
                 'AUFNAME1'=>$aufname1,
                 'AUSNAME2'=>$ausname2,
                 'AUFNAME2'=>$aufname2,
                 'PUBCODE'=>$pubcode,
                 'EDINAME'=>$ediname,
                 'DTPUR'=>$dtpur,
                 'SUB1'=>$sub1,
                 'SUB2'=>$reference,
                 'LOCNO'=>$locno,
                 'COPY_NO'=>$copy_no,
                 'CONTENT'=>$content,
                 'ENTRY_DATE'=>$entry_date,
                 'MODIFIED_ON'=>$update_date,
                 'USR_ID'=>$user_id
            ]);
        
    }
    

    public function get_data()
    {
       
        $data = array();
        $data['publishers_data'] = publish::get();
        $data['location_data'] = loca::get();
        $data['subject_data'] = subj::get();
        $data['title_data'] = title::get();

        return view('entry_new_book',compact('data'));
        
    }

    public function get_data_for_update_book()
    {
        
        $data = array();
        $data['publishers_data'] = publish::get();
        $data['location_data'] = loca::get();
        $data['subject_data'] = subj::get();
        $data['title_data'] = title::get();
        
        return view('update_book',compact('data'));
        
    }
}
