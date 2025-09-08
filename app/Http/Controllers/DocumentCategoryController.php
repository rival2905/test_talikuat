<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\DocumentCategory;

class DocumentCategoryController extends Controller
{
    //
    //
    public function index()
    {
        $categories = DocumentCategory::get();
        return view('document_category.index', compact('categories'));
    }

    public function create()
    {
        //
        $action = "store";
        $document_categories  = DocumentCategory::whereNull('parent_id')->get();

        return view('document_category.form',compact('action','document_categories'));

    }

    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'code'   => 'required|unique:document_categories',
            'name'   => 'required|unique:document_categories',
        ]);
      
        $data = [
            'code'       => $request->code,
            'name'       => $request->input('name'),
            'parent_id'  => $request->input('parent_id'),
            'slug'        => Str::slug($request->input('name'), '-')
        ];

        $save = DocumentCategory::Create($data);

        if($save){
            //redirect dengan pesan sukses
            return redirect()->route('admin.category.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.category.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }


    public function show(string $id)
    {
        
    }

    public function edit(string $id)
    {
        
        $action = "update";
        $document_categories  = DocumentCategory::whereNull('parent_id')->get();

        $data = DocumentCategory::find($id);
        return view('document_category.form',compact('data','action','document_categories'));


    }

    public function update(Request $request, string $id)
    {

        $temp = DocumentCategory::findOrFail($id);

        $this->validate($request,[
            'code'   => 'required|unique:document_categories,code,'.$temp->id,
            'name'   => 'required|unique:document_categories,name,'.$temp->id,
        ]);
      
        $data = [
            'code'       => $request->code,
            'name'       => $request->input('name'),
            'parent_id'  => $request->input('parent_id'),
            'slug'        => Str::slug($request->input('name'), '-')
        ];

        $save = $temp->update($data);

        if($save){
            //redirect dengan pesan sukses
            return redirect()->route('admin.category.index')->with(['success' => 'Data Berhasil Diperbaharui!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.category.index')->with(['error' => 'Data Gagal Diperbaharui!']);
        }
    }

    public function destroy(string $id)
    {
        
    }

    public function updateStatus($id)
    {
        $temp = DocumentCategory::findOrFail($id);
        if($temp->is_active){
            $temp->is_active = 0;
        }else{
            $temp->is_active = 1;
        }
        $save = $temp->save();
        if ($save) {
            return redirect()->back()->with(['success' => 'Status berhasil diperbarui!']);
        } else {
            return redirect()->back()->with(['error' => 'Gagal memperbarui Status!']);
        }
    }
}
