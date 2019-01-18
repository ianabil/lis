<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\loca;

use App\book;

use Auth;

use Carbon\Carbon;

class LocationMasterMaintenanceController extends Controller
{

    public function insert_new_location(Request $request)
    {

        $this->validate ( $request, [ 
            'location_details' => 'required|max:255|unique:locas,LOCNAME'
        ] ); 


        $location_code = 1+ loca::max('LOCCD'); 
        $location_details =  strtoupper($request->input('location_details'));
        $alm_rack =  strtoupper($request->input('alm_rack'));
        $usr_id=Auth::user()->user_id;

        $data= array();

        loca::insert(
            ['LOCCD'=>$location_code,
             'LOCNAME'=>$location_details,
             'ALM_RACK'=>$alm_rack,
             'MODIFIED_ON'=> Carbon::today(),
             'UPLOAD_ON'=> Carbon::today(),
             'USR_ID'=> $usr_id
             ]
        );
        
        $data['value']=$location_details;
        $data['result']="success";
        
        echo json_encode($data);
    }


    public function get_all_location_data(Request $request){
        $columns = array( 
            0 =>'LOCCD', 
            1 =>'LOCNAME',
            2 =>'ALM_RACK',            
            3=>'action'
        );

        $totalData = loca::count();

        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value'))){
            $location = loca::offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();
            $totalFiltered = loca::count();
        }
        else{
            $search = strtoupper($request->input('search.value'));
            $location = loca::where('LOCCD','like',"%{$search}%")
                                ->orWhere('LOCNAME','like',"%{$search}%")
                                ->orWhere('ALM_RACK','like',"%{$search}%")                                
                                ->offset($start)
                                ->limit($limit)
                                ->orderBy($order,$dir)
                                ->get();
            $totalFiltered = loca::where('LOCCD','like',"%{$search}%")
                            ->orWhere('LOCNAME','like',"%{$search}%")
                            ->orWhere('ALM_RACK','like',"%{$search}%")                              
                            ->count();
        }

        
        $data = array();

        if($location){
            foreach($location as $loc){
                $nestedData['LOCCD'] = $loc->LOCCD;
                $nestedData['LOCNAME'] = $loc->LOCNAME;
                $nestedData['ALM_RACK'] = $loc->ALM_RACK;                
                $nestedData['action'] = '<i class="fa fa-trash" aria-hidden="true"></i>';

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



    public function update_location(Request $request){

        $this->validate ( $request, [ 
            'location_details' => 'required|max:255'
        ] ); 

        $location_code = $request->input('location_code');
        $location_details = $request->input('location_details');
        $alm_rack = $request->input('alm_rack');
        $usr_id = Auth::user()->user_id;

        $data=array();

        loca::where('LOCCD',$location_code)
            ->update([
                'LOCNAME'=> $location_details,
                'ALM_RACK'=>$alm_rack,
                'MODIFIED_ON'=> Carbon::today(),
                'USR_ID'=>$usr_id                             
                 ]);

        return 1;

    }    


    public function destroy(Request $request)
    {
        $location_code = $request->input('location_code');

        $book_count = book::where('LOCNO',$location_code)                
                      ->count();                    
        
        $data=array();

        if($book_count>=1){

            return 0;
    
        }
        else{
            loca::where('LOCCD',$location_code)->delete(); // parent table

           return 1;
    
        }        
        

        return 0;
    }
}
