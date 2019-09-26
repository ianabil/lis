<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\book;
use App\title;
use App\publish;
use App\subj;
use App\member;
use App\ir;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function show(){
        $data['last_accession_no'] = book::max('ACCESSNO'); // Last Accession No.
        $data['issue_count'] = ir::where('DTISS', Carbon::now())->distinct('ACCESSNO')->count('ACCESSNO'); // Total No. of issued book on today
        $data['receive_count'] = ir::where('DTREC', Carbon::now())->distinct('ACCESSNO')->count('ACCESSNO');  // Total No. of returned book on today
        $data['recently_added_books'] = book::leftjoin('publishes','books.PUBCODE', '=', 'publishes.PUBCODE')
                                        ->where('TYPE','B')
                                        ->orderBy('books.ACCESSNO','DESC')
                                        ->limit(5)
                                        ->get(); // Recently added books
        $data['recently_added_journals'] = book::leftjoin('publishes','books.PUBCODE', '=', 'publishes.PUBCODE')
                                            ->where('TYPE','J')
                                            ->orderBy('books.ACCESSNO','DESC')
                                            ->limit(5)
                                            ->get(); // Recently added journals
        $data['recently_added_acts'] = book::leftjoin('publishes','books.PUBCODE', '=', 'publishes.PUBCODE')
                                            ->where('TYPE','A')
                                            ->orderBy('books.ACCESSNO','DESC')
                                            ->limit(5)
                                            ->get(); // Recently added acts

        return view('dashboard', compact('data'));
    }

    public function issue_today(){
        $data['issue_today'] = ir::join('books','irs.ACCESSNO', '=', 'books.ACCESSNO')
                                    ->join('members','irs.USERNO', '=', 'members.USERNO')
                                    ->leftjoin('publishes','books.PUBCODE', '=', 'publishes.PUBCODE')
                                    ->where('DTISS', Carbon::now())
                                    ->orderBy('UFNAME','books.ACCESSNO')
                                    ->distinct()
                                    ->get();

        foreach($data['issue_today'] as $data1){
            $data1['DTPUR'] = Carbon::parse($data1['DTPUR'])->format('d/m/Y');
        }

        return view('issue_today', compact('data'));
    }

    
    public function return_today(){
        $data['return_today'] = ir::join('books','irs.ACCESSNO', '=', 'books.ACCESSNO')
                                    ->join('members','irs.USERNO', '=', 'members.USERNO')
                                    ->leftjoin('publishes','books.PUBCODE', '=', 'publishes.PUBCODE')
                                    ->where('DTREC', Carbon::now())
                                    ->orderBy('UFNAME','books.ACCESSNO')
                                    ->distinct()
                                    ->select('books.ACCESSNO','UFNAME','USNAME','DTISS','LIBNO','TYPE','TITLE','PUBNAME','AUFNAME1','AUSNAME1','AUFNAME2','AUSNAME2','VOLNO','EDENO','YEAR','PRICE','DTPUR','COPY_NO','CONTENT')
                                    ->get();

        foreach($data['return_today'] as $data1){
            $data1['DTISS'] = Carbon::parse($data1['DTISS'])->format('d/m/Y');
            $data1['DTPUR'] = Carbon::parse($data1['DTPUR'])->format('d/m/Y');
        }

        return view('return_today', compact('data'));
        
    }
}
