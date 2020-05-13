<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\newletterDataTable;
use App\Exports\newLetterExport;
use App\Models\Newletters;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class NewsLetters extends Controller
{
    public function index(newletterDataTable $newletterDataTable)
    {
        $title = _i('new title');
        return $newletterDataTable->render('admin.newletter.index',compact('title'));
    }



    public function delete($id){

        $del = Newletters::findOrFail($id);
        $del->delete();

        session()->flash('success','deleted suceesffly');
            return redirect()->back();

    }


    public function importExportView()
    {
        return view('import');
    }


    public function export()
    {
        return Excel::download(new newLetterExport, 'newsletter.xlsx');
    }

}
