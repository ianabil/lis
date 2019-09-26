<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use App\Supplier;
use App\book;

class SupplierMasterMaintenanceController extends Controller
{
    // Data Table Code Starts
    public function get_all_supplier_data(Request $request){
        $columns = array( 
            0 =>'SUPPLIER_CODE', 
            1 =>'SUPPLIER_NAME',
            2=>'action'
        );

        $totalData = Supplier::count();

        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value'))){
            $suppliers = Supplier::offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();
            $totalFiltered = Supplier::count();
        }
        else{
            $search = $request->input('search.value');
            $suppliers = Supplier::where('SUPPLIER_CODE','ilike',"%{$search}%")
                                ->orWhere('SUPPLIER_NAME','ilike',"%{$search}%")
                                ->offset($start)
                                ->limit($limit)
                                ->orderBy($order,$dir)
                                ->get();
            $totalFiltered = Supplier::where('SUPPLIER_CODE','ilike',"%{$search}%")
                            ->orWhere('SUPPLIER_CODE','ilike',"%{$search}%")
                            ->count();
        }

        
        $data = array();

        if($suppliers){
            foreach($suppliers as $supplier){
                $nestedData['SUPPLIER_CODE'] = $supplier->SUPPLIER_CODE;
                $nestedData['SUPPLIER_NAME'] = $supplier->SUPPLIER_NAME;
                if(Auth::user()->status == 'A')              
                    $nestedData['action'] = '<i class="fa fa-trash delete" aria-hidden="true"></i>';
                else
                    $nestedData['action'] = '<i class="fa fa-trash" aria-hidden="true" style="opacity: 0.6;cursor: not-allowed"></i>';

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
            'supplier' => 'required|max:255|unique:suppliers,SUPPLIER_NAME'         
        ] ); 

        $supplier = $request->input('supplier');
        $usr_id=Auth::user()->user_id;
        $update_date = Carbon::today();  
        $uploaded_date = Carbon::today(); 
        
        Supplier::insert([
            'SUPPLIER_NAME'=>$supplier, 
            'UPLOAD_ON'=>$uploaded_date, 
            'MODIFIED_ON'=>$update_date, 
            'USR_ID'=>$usr_id
        ]);

        return 1;

    }

    public function update_supplier(Request $request){
        $this->validate ( $request, [ 
            'supplier' => 'required|max:255|unique:suppliers,SUPPLIER_NAME'         
        ]); 
        
        $id = $request->input('id');
        $supplier = strtoupper($request->input('supplier'));
        $usr_id = Auth::user()->user_id;
        $update_date = Carbon::today();  

        supplier::where('SUPPLIER_CODE',$id)
                ->update([
                    'SUPPLIER_NAME' => $supplier, 
                    'MODIFIED_ON' => $update_date, 
                    'USR_ID'=>$usr_id
                ]);

        return 1;

    }

    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $book_count = book::where('SUPPLIER_CODE',$id)                
                            ->count();  
      
        if($book_count > 0){
            return 0;    
        }
        else{
            supplier::where('SUPPLIER_CODE',$id)->delete(); 
            return 1;
        }
    }
}
