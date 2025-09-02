<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataUmum;
use App\Models\DataUmumDocumentCategory;
use App\Models\DocumentCategory;
use App\Models\DuDcDetail;
use Illuminate\Support\Facades\Storage;
class DataUmumDocumentCategoryController extends Controller
{
    //
    public function show($data_umum_id)
    {
        $data_umum = DataUmum::with([
            'duDc.documentCategory',
            'duDc.details'
        ])->withCount('duDc_details_total_doc','duDc_details_total_pending','duDc_details_total_review','duDc_details_total_revision','duDc_details_total_complete')->findOrFail($data_umum_id);
    //    dd($data_umum);
        $document_categories = DocumentCategory::all();
        $parent_document_categories = DocumentCategory::whereNull('parent_id')->get();

        if($data_umum->duDc->count() == 0){
            $document_categoriess = DocumentCategory::whereNotNull('parent_id')->get();
            foreach($document_categoriess as $dc){
               
                $temp_data = [
                    'data_umum_id' => $data_umum_id,
                    'document_category_id' => $dc->id,
                    'parent_document_category_id' => $dc->parent_id,
                    'score' => 0,
                    'deskripsi' => $dc->deskripsi ?? null,
                    'is_active' => 1,
                ];
                DataUmumDocumentCategory::create($temp_data);

            }
        }
        return view('data-umum.doc-cat.show', compact('data_umum', 'document_categories','parent_document_categories'));
    }

    public function store(Request $request, $data_umum_id)
    {
        $this->validate($request, [
            'document_category_id' => 'required|exists:document_categories,id',
            'score' => 'nullable|integer',
            'deskripsi' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        $data = [
            'data_umum_id' => $data_umum_id,
            'document_category_id' => $request->document_category_id,
            'score' => $request->score ?? 0,
            'deskripsi' => $request->deskripsi ?? null,
             'is_active' => $request->is_active == '1' ? 1 : 0,
        ];

        $save = DataUmumDocumentCategory::create($data);

        if ($save) {
            return redirect()->back()->with(['success' => 'Relasi kategori berhasil ditambahkan!']);
        } else {
            return redirect()->back()->with(['error' => 'Gagal menambahkan relasi kategori!']);
        }
    }

    public function edit($id)
    {
        $data = DataUmumDocumentCategory::findOrFail($id);
        $document_categories = DocumentCategory::get();
        $action = 'update';

        return view('data-umum.doc-cat.form', compact('data', 'document_categories', 'action'));
    }

    public function update(Request $request, $id)
    {
        $temp = DataUmumDocumentCategory::findOrFail($id);

        $this->validate($request, [
            'document_category_id' => 'required|exists:document_categories,id',
            'score' => 'nullable|integer',
            'deskripsi' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        $data = [
            'document_category_id' => $request->document_category_id,
            'score' => $request->score ?? 0,
            'deskripsi' => $request->deskripsi ?? null,
            'is_active' => $request->is_active,
        ];

        $save = $temp->update($data);

        if ($save) {
            return redirect()->back()->with(['success' => 'Relasi kategori berhasil diperbarui!']);
        } else {
            return redirect()->back()->with(['error' => 'Gagal memperbarui relasi kategori!']);
        }
    }

    public function destroy($id)
    {
        $temp = DataUmumDocumentCategory::findOrFail($id);
        $delete = $temp->delete();

        if ($delete) {
            return redirect()->back()->with(['success' => 'Relasi kategori berhasil dihapus!']);
        } else {
            return redirect()->back()->with(['error' => 'Gagal menghapus relasi kategori!']);
        }
    }

    public function detailFiles($id)
    {
        $status =null;
        $du_dc = DataUmumDocumentCategory::with('details', 'documentCategory')->findOrFail($id);

        return view('data-umum.du-dc-detail.index', compact('du_dc','status'));
    }

    
    public function updateStatus($id)
    {
        $temp = DataUmumDocumentCategory::findOrFail($id);
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

    public function detail($du_dc_id)
    {
        $du_dc = DataUmumDocumentCategory::with('details', 'documentCategory')->findOrFail($du_dc_id);
        return view('data-umum.du-dc-detail.index', compact('du_dc'));
    }

    public function storeFile(Request $request, $du_dc_id)
    {
        $request->validate([
            'files' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:5120', // max 5MB misalnya
            'score' => 'integer|min:0|max:100',
        ]);

        $file = $request->file('files');
        $filename = time().'_'.$file->getClientOriginalName();
        $path = $file->storeAs('uploads/du_dc_details', $filename, 'public');

        DuDcDetail::create([
            'du_dc_id' => $du_dc_id,
            'name'     => $file->getClientOriginalName(),
            'files'    => $path,
            'score'    => $request->score,
        ]);

        $this->updateAverageScore($du_dc_id);

        return redirect()->back()->with('success', 'File berhasil ditambahkan.');
    }


    public function destroyFile($id)
    {
        $file = DuDcDetail::findOrFail($id);
        $du_dc_id = $file->du_dc_id;

        if ($file->files && Storage::disk('public')->exists($file->files)) {
            Storage::disk('public')->delete($file->files);
        }

        $file->delete();

        $this->updateAverageScore($du_dc_id);
        return redirect()->back()->with(['success' => 'File berhasil dihapus!']);

       
    }

    public function updateFileScore(Request $request, $du_dc_id)
    {
        // Validasi tetap sama, ini sudah bagus
        $validated = $request->validate([
            'score' => 'sometimes|required|integer|min:0|max:100',
            'description' => 'sometimes|nullable|string|max:255',
        ]);
        
        $du_dc = DuDcDetail::findOrFail($du_dc_id);

        // Hanya update 'score' jika ada di dalam request
        if ($request->has('score')) {
            // UBAH BAGIAN INI
            $du_dc->score = $request->score; // Gunakan nama kolom yang benar dari database
        }

        if ($request->has('description')) {
            $du_dc->deskripsi = $request->description;
        }

        $du_dc->save();
        
        return response()->json([
            'status' => 'success',
            // Samakan juga di sini untuk konsistensi
            'updated_data' => $du_dc->only(['score', 'deskripsi']) 
        ]);
    }

    private function updateAverageScore($du_dc_id)
    {
        $du_dc = DataUmumDocumentCategory::findOrFail($du_dc_id);
        $avgScore = $du_dc->details()->avg('score') ?? 0;
        $du_dc->update(['score' => round($avgScore)]);
    }

    public function downloadFile($filename)
    {
        $file = DuDcDetail::findOrFail($filename);
        if (Auth::user()->userDetail->role == 1 &&  $file->status =='pending'){
            $file->status = 'review';
            $file->save();
        }
        
        return Storage::disk('public')->download($file->files);
    }

    public function detailFilesbyStatus($id,$status)
    {
        $data_umum = DataUmum::findOrFail($id);
        
        if($status =='pending'){
            $du_dc = $data_umum->duDc_details_total_pending;
        }else if($status =='review'){
            $du_dc = $data_umum->duDc_details_total_review;
        }else if($status =='revision'){
            $du_dc = $data_umum->duDc_details_total_revision;
        }else if($status =='complete'){
            $du_dc = $data_umum->duDc_details_total_complete;
        }else{
            $du_dc = $data_umum->duDc_details_total_doc;
        }
        // dd($du_dc);
        return view('data-umum.du-dc-detail.showByStatus', compact('du_dc','status'));
    }
}
