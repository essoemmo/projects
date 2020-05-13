<?php 

namespace App\Http\Controllers;
use App\Front\Gallery;
use App\Help\HasFiles;
use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class GalleryController extends Controller
{

  public function all()
  {
       $langs = Language::all();
        $translation = \App\Models\Translation::where('table_name','galleries')->first();
    return view('admin.gallery.all', compact('translation','langs'));
  }

  // make datatable for Roles
  public function  getDatatableGallery()
  {
    $gallery = Gallery::select(['id', 'title', 'href', 'published','lang_id', 'source_id']);

    return DataTables::of($gallery)
        ->editColumn('lang_id', function($query) {
            $language = Language::select(['title'])->where('id' , $query->lang_id)->first();
            return _i($language->title) ;
        })
        ->addColumn('action', function ($gallery) {
          return'<a href="'.$gallery->id.'/edit" class="btn btn-icon waves-effect waves-light btn-info" title="'._i("Edit").'"><i class="fa fa-edit"></i> </a>' ."&nbsp;&nbsp;&nbsp;".
          '<a href="'.$gallery->id.'/delete" class="btn btn-icon waves-effect waves-light btn-danger" title="'._i("Delete").'"><i class="fa fa-trash"></i> </a>';
        })
        ->editColumn('published', function($gallery) {
          return $gallery->published == 1 ? _i('Published') : _i('Not Published');
        })

        ->make(true);
  }

  public function create()
  {
      $languages = Language::all();
    return view('admin.gallery.add' ,compact('languages'));
  }


  public function store(Request $request)
  {
//    dd($request);
    $rules = [
        'title' =>  ['required', 'max:100', 'unique:galleries'],
        'href' =>  ['required', 'max:150','url'],
        'file' =>  ['required','mimes:jpeg,bmp,png,jpg'],
    ];

    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails())
      return redirect()->back()->withErrors($validator);

    $gallery = Gallery::create([
        'title' => $request->title,
        'href' => $request->href,
        'lang_id' => $request->lang_id,
//        'published' => $request->published,
    ]);
    if($request->has('published')){
      $gallery->published = $request->published;
    }

    $gallery->save();

    //    // Save File
//    /* Attachments */
//      if (!empty($request->file())) {
//      $file = $request->file('file');
//      $path = $file->storeAs('Gallery/'.$gallery->id, $file->getClientOriginalName());
//      Setting::storeModelAttachments($request->file('file'),$gallery ,$path);
//
//      }
    $gallery->setAttachments($request->file('file'));
//    return redirect('/admin/gallery/'.$gallery->id.'/edit')->withFlashMessage('Added Successfully !');
    return redirect('/admin/gallery/create')->withFlashMessage(_i('Added Successfully !'));
  }

  public function edit($id)
  {
     $languages = Language::all();
    $gallery = Gallery::findOrFail($id);
    return view('admin.gallery.edit' , compact('gallery' ,'languages'));
  }

  public function update($id, Request $request)
  {
    $gallery = Gallery::findOrFail($id);
    $rules = [
        'title' =>  ['required', 'max:100', Rule::unique('galleries')->ignore($gallery->id)],
        'href' =>  ['required', 'max:150','url'],
        'file' =>  ['mimes:jpeg,bmp,png,jpg'],
    ];

    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails())
      return redirect()->back()->withErrors($validator);

    $gallery->title = $request->title;
    $gallery->href = $request->href;
    $gallery->lang_id = $request->lang_id;

    if($request->has('published')){
      $gallery->published = $request->published;
    }else{
        $gallery->published = 0;
    }

    $gallery->save();
//    if(!empty($request->file())){
//      $this->deleteAttachments($gallery->id);
//      $file = $request->file('file');
//      $file->storeAs('Gallery/' . $gallery->id, $file->getClientOriginalName());
//    }
//    $gallery->destroyAttachments();
    $gallery->setAttachments($request->file('file'));
    return redirect('/admin/gallery/'.$gallery->id.'/edit')->withFlashMessage(_i('Updated Successfully !'));

  }

  public function delete($id)
  {
    $gallery = Gallery::findOrFail($id);
    $gallery->destroyAttachments();
    $gallery->delete();
    return redirect('/admin/gallery/all')->withFlashMessage(_i('Deleted Successfully !'));
  }

  public function downloadAttachments(Request $request)
  {
    $gallery = Gallery::findOrFail($request->id);
    return $gallery->getAttachments();
  }
  //Delete Attachments By Id
  public function deleteAttachments($id)
  {
    $gallery = Gallery::findOrFail($id);
    $gallery->destroyAttachments();
  }




  
}

?>