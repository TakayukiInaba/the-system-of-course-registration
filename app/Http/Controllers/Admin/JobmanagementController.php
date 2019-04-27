<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Exports\canceledEntriesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\Entry;
use PDF;

class JobmanagementController extends Controller
{
    //
    public function cancelList(){
        $ghostEntries = Entry::with(['student','course'])->onlyTrashed()
            ->orderBy("student_id")->orderBy("term_id")->orderBy("time_id")->get();
        return view('shingaku.canceled_list',['ghostEntries'=>$ghostEntries]); 
    }

    public function cancelListExportPdf(){
        $ghostEntries = Entry::with(['student','course'])->onlyTrashed()
            ->orderBy("student_id")->orderBy("term_id")->orderBy("time_id")->get(); 
        $pdf = \PDF::loadView('shingaku..exports.pdfCanceledList',compact('ghostEntries'));
        return $pdf->stream('canceled_list.pdf');
    }

    public function cancelListExportExcel(){
       // return Excel::download(new CanceledEntriesExport, 'canceledEntries.csv');
        return (new CanceledEntriesExport)->download('canceledEntries.csv');
    }

    //
    public function feeList(){
        $feeEntries = Entry::with(['student','course']) 
           ->orderBy("student_id")->orderBy("term_id")->orderBy("time_id")->get();;
        
        $filtered = $feeEntries->where('fee','>',0)->get();
        
        //$filtered = $feeEntries;
       
           // ->orderBy("student_id")->orderBy("term_id")->orderBy("time_id")->get();
        return view('shingaku.fee_list',['ghostEntries'=>$filtered]); 
        //return view('shingaku.canceled_list',['ghostEntries'=>$$filtered]); 
    }




}



