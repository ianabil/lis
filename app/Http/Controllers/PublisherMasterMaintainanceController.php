<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\publish;
use App\book;
use DB;
use Auth;
use Carbon\Carbon;

class PublisherMasterMaintainanceController extends Controller
{
    //
    // Data Table Code Starts
    public function get_all_publisher_data(Request $request){
        $columns = array( 
            0 =>'PUBCODE', 
            1 =>'PUBNAME',
            2 =>'PUBADD',
            2=>'action'
        );

        $totalData = publish::count();

        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value'))){
            $publisher = publish::offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();
            $totalFiltered = publish::count();
        }
        else{
            $search = strtoupper($request->input('search.value'));
            $publisher = publish::where('PUBCODE','like',"%{$search}%")
                                ->orWhere('PUBNAME','like',"%{$search}%")
                                ->orWhere('PUBADD','like',"%{$search}%")
                                ->offset($start)
                                ->limit($limit)
                                ->orderBy($order,$dir)
                                ->get();
            $totalFiltered = publish::where('PUBCODE','like',"%{$search}%")
                                    ->orWhere('PUBNAME','like',"%{$search}%")
                                    ->orWhere('PUBADD','like',"%{$search}%")
                                    ->count();
        }

        
        $data = array();

        if($publisher){
            foreach($publisher as $publisher){
                $nestedData['PUBCODE'] = $publisher->PUBCODE;
                $nestedData['PUBNAME'] = $publisher->PUBNAME;
                $nestedData['PUBADD'] = $publisher->PUBADD;
                $nestedData['action'] = "<i class='fa fa-trash' aria-hidden='true'></i>";

                $data[] = $nestedData;
            }



        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordFiltered" =>intval($totalFiltered),
            "data" => $data
        );

        echo json_encode($json_data);
    }


    public function store(Request $request){

        $this->validate ( $request, [ 
            'publisher_name' => 'required|max:255|unique:publishes,PUBNAME',
            'publisher_address' => 'max:255'         
        ] ); 

        $pub_name = strtoupper($request->input('publisher_name'));
        $pub_add = $request->input('publisher_address');
        $usr_id=Auth::user()->user_id;
        $update_date = Carbon::today();  
        $uploaded_date = Carbon::today(); 

        // splitting the $pub_name character wise into an array
        $first_letter = str_split($pub_name);

        // searching the maximum publication code that starts with the first character of the $pub_name
        $max_id = publish::where('PUBCODE','like',$first_letter['0'].'%')->max('PUBCODE'); 
        
        // extracting only the numeric part of that maximum PUBCODE
        $max_integer_part = substr($max_id,1);

        // incrementing that numeric part fetched above
        $max_int =  (int)$max_integer_part +1 ;
        
        /*creating the new PUBCODE by concatenating the first letter of the given
        publisher's name and the $max_int */
        $pub_code = $first_letter['0'].$max_int;

                
        $data = [
            'PUBCODE'=>$pub_code,
            'PUBNAME'=>$pub_name,
            'PUBADD'=>$pub_add,
            'MODIFIED_ON'=>$update_date,
            'UPLOAD_ON'=>$uploaded_date,
            'USR_ID'=>$usr_id
        ];

        publish::insert($data);

        return 1;
       
    }


    public function update_publisher(Request $request){
        $this->validate ( $request, [ 
            'id' => 'required',
            'publisher_name' => 'required|max:255',
            'publisher_address' => 'max:255'          
        ] ); 

        $id = $request->input('id');
        $pub_name = strtoupper($request->input('publisher_name'));
        $pub_address = $request->input('publisher_address');
        $usr_id=Auth::user()->user_id;

        $data = [
            'PUBNAME'=>$pub_name,
            'PUBADD'=>$pub_address,
            'MODIFIED_ON'=>Carbon::today(),
            'USR_ID'=>$usr_id
        ];
        
        DB::enableQueryLog();
        publish::where('PUBCODE',$id)->update($data);
        $query = DB::getQueryLog();
        return $query;

    }


    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $count = book::where('PUBCODE',$id)->count();

        if($count>=1)
            return 0;
        else{
            publish::where('PUBCODE',$id)->delete();
            return 1;
        }
    }
}
