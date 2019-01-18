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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) // To Add New Books
    {
        $this->validate ($request, [ 
            'library_no' => 'required|max:255', 
            'title_code' => 'required|max:10', 
            'type' => 'required|max:255',
            'publisher' => 'required|max:255',
            'subject' => 'required|max:255',
            'entry_date' => 'required|max:255'
        ]); 
        
            $accessno = 1+ book::max('ACCESSNO'); 
            $libno = $request->input('library_no'); 
            $tit_code = $request->input('title_code');
            $new_title = $request->input('new_title');
            $flag = $request->input('flag');
            $title = $request->input('title');
            $type = $request->input('type'); 
            $volno = $request->input('volume_no');
            $partno = $request->input('part_no'); 
            $edeno = $request->input('edition_no');
            $year = $request->input('edition_year_1'); 
            $year1 = $request->input('edition_year_2');
            $page = $request->input('total_page');
            $price = $request->input('price');
            $ausname1 = $request->input('last_name_1');
            $aufname1 = $request->input('first_name_1');
            $pubcode = $request->input('publisher');
            $ediname = $request->input('editor');
            $dtpur = Carbon::parse($request->input('purchase_date'))->format('Y-m-d');
            $sub1 = $request->input('subject');
            $reference = $request->input('reference');
            $locno = $request->input('location');
            $copy_no = $request->input('copy_no');
            $content = $request->input('content');
            $entry_date = Carbon::parse($request->input('entry_date'))->format('Y-m-d');
            $update_date = Carbon::today();  
            $uploaded_date = Carbon::today();  
            $user_id = Auth::user()->user_id;
            $issue_flag ='';

            if($flag=='new_title'){
                $count = title::where('TIT_DESC',$new_title)->count('TIT_CODE'); 
                
                if($count<1)
                {                              
                    title::insert(['TIT_DESC'=>$new_title, 'UPLOAD_ON'=>$uploaded_date, 'MODIFIED_ON'=>$update_date, 'USR_ID'=>$user_id]); 
                    $tit_code = title::max('TIT_CODE');
                    $title = $new_title;
                }
                else{
                    $tit_code = title::where('TIT_DESC',$new_title)->max('TIT_CODE');
                    $title = $new_title;
                }
                
            }


            book::insert(
                ['ACCESSNO'=>$accessno,
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
                 ]
            );

            if($flag=='new_title'){
                $data = array();
                $data['title_code'] = $tit_code;
                $data['accession_no'] = $accessno;
                echo json_encode($data);
            }
            else{
                $data = array();
                $data['title_code'] ='NA';
                $data['accession_no'] = $accessno;
                echo json_encode($data);
            }
       

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {        
        $data = array();
        
        $data['book'] = book::where('ACCESSNO',$id)->get();
        $data['book_count'] = count($data['book']);
        
        $data['publisher'] = book::
                            join('publishes','books.PUBCODE', '=', 'publishes.PUBCODE')
                            ->where('ACCESSNO',$id)
                            ->get();
        $data['publisher_count'] = count($data['publisher']);

        $data['location'] = book::
                            join('locas','books.LOCNO', '=', 'locas.LOCCD')
                            ->where('ACCESSNO',$id)
                            ->get();
        $data['location_count'] = count($data['location']);

        $data['subject'] =  book::
                            join('subjs','books.SUB1', '=', 'subjs.SUBNO')
                            ->where('ACCESSNO',$id)
                            ->get();

        $data['subject_count'] = count($data['subject']);

        $data['reference'] =  book::
                            join('subjs','books.SUB2', '=', 'subjs.SUBNO')
                            ->where('ACCESSNO',$id)
                            ->get();

        $data['reference_count'] = count($data['reference']);

        echo json_encode($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate ($request, [ 
            'accession_no' => 'required|max:7',
            'library_no' => 'required|max:255', 
            'title_code' => 'required', 
            'type' => 'required|max:255',
            'publisher' => 'required|max:255',
            'subject' => 'required|max:255',
            'entry_date' => 'required|max:255'    
        ]); 

            $accession_no = $request->input('accession_no');
            $library_no = $request->input('library_no');
            $title_code = $request->input('title_code');
            $title = $request->input('title');
            $type = $request->input('type');
            $volume_no = $request->input('volume_no');
            $part_no = $request->input('part_no');
            $edition_no = $request->input('edition_no');
            $edition_year_1 = $request->input('edition_year_1');
            $edition_year_2 = $request->input('edition_year_2');
            $total_page = $request->input('total_page');
            $price = $request->input('price');
            $last_name = $request->input('last_name');
            $first_name = $request->input('first_name');
            $publisher = $request->input('publisher');
            $editor = $request->input('editor');
            $purchase_date = Carbon::parse($request->input('purchase_date'))->format('Y-m-d');
            $subject = $request->input('subject');
            $reference = $request->input('reference');
            $location = $request->input('location');
            $copy_no = $request->input('copy_no');
            $content = $request->input('content');
            $entry_date = $request->input('entry_date');
            $update_date = Carbon::today();  
            $user_id = Auth::user()->user_id;
    
        
        //echo json_encode($data);
        book::where('ACCESSNO',$accession_no)
            ->update(['LIBNO'=>$library_no,
                     'TIT_CODE'=>$title_code,
                     'TITLE'=>$title,
                     'CONTENT'=>$content,
                     'TYPE'=>$type,
                     'VOLNO'=>$volume_no,
                     'PARTNO'=>$part_no,
                     'EDENO'=>$edition_no,
                     'YEAR'=>$edition_year_1,
                     'YEAR1'=>$edition_year_2,
                     'PAGE'=>$total_page,
                     'PRICE'=>$price,
                     'AUSNAME1'=>$last_name,
                     'AUFNAME1'=>$first_name,
                     'PUBCODE'=>$publisher,
                     'EDINAME'=>$editor,
                     'DTPUR'=>$purchase_date,
                     'SUB1'=>$subject,
                     'SUB2'=>$reference,
                     'LOCNO'=>$location,
                     'COPY_NO'=>$copy_no,
                     'ENTRY_DATE'=>$entry_date,
                     'MODIFIED_ON'=>$update_date,
                     'USR_ID'=>$user_id
                     ]);

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function get_data()
    {
        //
        $data = array();
        $data['publishers_data'] = publish::get();
        $data['location_data'] = loca::get();
        $data['subject_data'] = subj::get();
        $data['title_data'] = title::get();

        return view('entry_new_book',compact('data'));
        
    }

    public function get_data_for_update_book()
    {
        //
        $data = array();
        $data['publishers_data'] = publish::get();
        $data['location_data'] = loca::get();
        $data['subject_data'] = subj::get();
        $data['title_data'] = title::get();
        
        return view('update_book',compact('data'));
        
    }
}
