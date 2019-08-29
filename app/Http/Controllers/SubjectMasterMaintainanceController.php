<?php

namespace App\Http\Controllers;

use App\subj;

use App\book;

use Auth;

use Illuminate\Http\Request;

class SubjectMasterMaintainanceController extends Controller
{

    public function get_all_subject_data(Request $request){
        $columns = array( 
            0 =>'SUBNO', 
            1 =>'SUBNAME',
            2=>'action'
        );

        $totalData = subj::count();

        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value'))){
            $subjects = subj::offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();
            $totalFiltered = subj::count();
        }
        else{
            $search = strtoupper($request->input('search.value'));
            $subjects = subj::where('SUBNO','like',"%{$search}%")
                                ->orWhere('SUBNAME','like',"%{$search}%")
                                ->offset($start)
                                ->limit($limit)
                                ->orderBy($order,$dir)
                                ->get();
            $totalFiltered = subj::where('SUBNO','like',"%{$search}%")
                            ->orWhere('SUBNAME','like',"%{$search}%")
                            ->count();
        }

        
        $data = array();

        if($subjects){
            foreach($subjects as $sub){
                $nestedData['SUBNO'] = $sub->SUBNO;
                $nestedData['SUBNAME'] = $sub->SUBNAME;
                $nestedData['action'] = "<i class='fa fa-trash' aria-hidden='true'></i>";

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


    public function insert_subject(Request $request) //To Add New Subject
    {
       $this->validate( $request, [ 
            'subject' => 'required|max:255|unique:subjs,SUBNAME'
        ]); 
        
        $s_desc = $request->input('subject');
        $firstCharacter = strtoupper(substr($s_desc, 0, 1));
        $result = subj::where('SUBNO','like',$firstCharacter.'%')->orderBy('SUBNO', 'desc')->pluck('SUBNO')->first();
        $restChar = (integer)substr($result, 1);
        $newsubcode= $firstCharacter.(string)++$restChar;
        $newsub=strtoupper($s_desc);
        $usr_id=Auth::user()->user_id;

         subj::insert(
            ['SUBNO'=>$newsubcode,
             'SUBNAME'=>$newsub,
             'MODIFIED_ON'=>date("d/m/Y"),
             'UPLOAD_ON'=>date("d/m/Y"),
             'USR_ID'=>$usr_id
             ]
        );
        return 1;
    
    }

    public function update_subj_table(Request $request)  //To update Subject table
    {
        $subcode = $request->input('id');
        $subdesc = strtoupper($request->input('subject'));        
        $usr_id=Auth::user()->user_id;

        $this->validate ( $request, [ 
            'subject' => 'required|max:255|unique:subjs,SUBNAME'         
        ] ); 
        
       
        subj::where('SUBNO',$subcode)
                ->update(['SUBNAME'=>$subdesc,
                'MODIFIED_ON'=>date('d/m/Y'),
                'USR_ID'=>$usr_id 
                ]        
            );

            return 1;
    }
    
    public function delete_from_subj_table(Request $request)  //To delete from Subject table
    {
       $subcode = $request->input('id'); 
       $count = book::where('SUB1',$subcode)
                    ->orWhere('SUB2',$subcode)
                    ->count();
       if($count>=1){
              return 0;
       }
      else{
            subj::where('SUBNO',$subcode)->delete();
            return 1;
       }
    }
    



}
