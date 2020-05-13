<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

use File;
use ZipArchive;

class ReportController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:read_reports')->only(['index']);
    }
    public function index(Request $request){
        if ($request->ajax()) {


            $day = (!empty($request->day)) ? ($request->day) : ('');
            $month = (!empty($request->month)) ? ($request->month) : ('');
            $year = (!empty($request->year)) ? ($request->year) : ('');



                if($day && $month && $year) {
                    $data = Upload::
                    whereDay('created_at', '=', $request->day)
                    ->whereMonth('created_at', '=', $request->month)
                    ->whereYear('created_at', '=', $request->year)
                        ->get();
                } elseif($day && $month) {
                    $data = Upload::
                    whereDay('created_at', '=', $request->day)
                        ->whereMonth('created_at', '=', $request->month)
                        ->get();
                }elseif($day && $year) {
                    $data = Upload::
                    whereDay('created_at', '=', $request->day)
                        ->whereYear('created_at', '=', $request->year)
                        ->get();
                } elseif($month && $year) {
                    $data = Upload::
                        whereMonth('created_at', '=', $request->month)
                        ->whereYear('created_at', '=', $request->year)
                        ->get();
                } elseif ($day){
                    $data = Upload::
                    whereDay('created_at', '=', $request->day)
                        ->get();
                }elseif($month) {
                    $data = Upload::
                    whereMonth('created_at', '=', $request->month)
                        ->get();
                } elseif($year) {
                    $data = Upload::
                    whereYear('created_at', '=', $request->year)
                        ->get();
                } else {
                    $data = Upload::get();
                }


            return Datatables::of($data)

                ->addIndexColumn()

                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('download-zip',$row->id).'" class="btn btn-success btn-sm"><i class="fa fa-download"></i></a>';
                    $btn .= '<a href="'.route('reports.show',$row->id).'" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i></a>';

                    return $btn;

                })
                ->rawColumns(['action'])
                ->make(true);

        }

        return view('admin.reports.index');
    }



    public function show(Request $request,$id){



        if ($request->ajax()) {

            $data = \App\models\File::where('fileable_id',$id)->get();

            return Datatables::of($data)

                ->addIndexColumn()

                ->addColumn('action', function($row){

                    $path = asset(str_replace(" ", "%20", $row->files));

                    $btn = '<a   class="btn btn-success btn-sm print" data-file="'.$path.'" data-id="'.$row->id.'"><i class="fa fa-download"></i></a>';
//                    $btn = '<a href="'.route('reports.print',['id'=>$row->id,'file' => $row->files]).'" class="btn btn-success btn-sm" data-file="'.$path.'" data-id="'.$row->id.'"><i class="fa fa-download"></i></a>';
//                    $btn .= '<a href="'.route('reports.show',$row->id).'" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i></a>';

                    return $btn;

                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('admin.reports.files',compact('id'));

    }


    public function downloadZip($id){

//        dd($id);
        $name = Upload::findOrFail($id);
        $zip = new \ZipArchive();

        $fileName = $name->name.'.zip';
//    dd($fileName);
        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE)
        {
            $files = File::files(public_path('uploads/files/'.$id));

            foreach ($files as $key => $value) {
                $relativeNameInZipFile = basename($value);
                $zip->addFile($value, $relativeNameInZipFile);
            }

            $zip->close();
        }

        return response()->download(public_path($fileName));
    }


    public function printdata(Request $request){

        $url = asset($request->file);
        return view('admin.reports.print',compact('url'));


    }


}
