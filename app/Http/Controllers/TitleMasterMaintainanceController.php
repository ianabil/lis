<?php

namespace App\Http\Controllers;

use App\book;
use App\title;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

class TitleMasterMaintainanceController extends Controller
{
    
    // Data Table Code Starts
    public function get_all_title_data(Request $request){
        $columns = array( 
            0 =>'TIT_CODE', 
            1 =>'TIT_DESC',
            2=>'action'
        );

        $totalData = title::count();

        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value'))){
            $titles = title::offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();
            $totalFiltered = title::count();
        }
        else{
            $search = strtoupper($request->input('search.value'));
            $titles = title::where('TIT_CODE','like',"%{$search}%")
                                ->orWhere('TIT_DESC','like',"%{$search}%")
                                ->offset($start)
                                ->limit($limit)
                                ->orderBy($order,$dir)
                                ->get();
            $totalFiltered = title::where('TIT_CODE','like',"%{$search}%")
                            ->orWhere('TIT_DESC','like',"%{$search}%")
                            ->count();
        }

        
        $data = array();

        if($titles){
            foreach($titles as $titles){
                $nestedData['TIT_CODE'] = $titles->TIT_CODE;
                $nestedData['TIT_DESC'] = $titles->TIT_DESC;
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

    public function store(Request $request){
        $this->validate ( $request, [ 
            'title' => 'required|max:255|unique:titles,TIT_DESC'         
        ] ); 

        $title = $request->input('title');
        $usr_id=Auth::user()->user_id;
        $update_date = Carbon::today();  
        $uploaded_date = Carbon::today(); 
        
        title::insert(['TIT_DESC'=>$title, 'UPLOAD_ON'=>$uploaded_date, 'MODIFIED_ON'=>$update_date, 'USR_ID'=>$usr_id]);

        return 1;

    }



    public function update_title(Request $request){
        $this->validate ( $request, [ 
            'title' => 'required|max:255|unique:titles,TIT_DESC'         
        ] ); 
        
        $id = $request->input('id');
        $title = $request->input('title');
        $usr_id=Auth::user()->user_id;
        $update_date = Carbon::today();  

        title::where('TIT_CODE',$id)->update(['TIT_DESC'=>$title, 'MODIFIED_ON'=>$update_date, 'USR_ID'=>$usr_id]);

        return 1;

    }

    public function destroy(Request $request)
    {
        $id = $request->input('id');
        title::where('TIT_CODE',$id)->delete(); 

        return 1;
    }
}
