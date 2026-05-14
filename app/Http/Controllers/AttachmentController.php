<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AttachmentController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,jpg,png,doc,docx|max:10240',
            'attachable_type' => 'required|string',
            'attachable_id' => 'required|integer',
        ]);

        $file = $request->file('file');
        
        // Simpan dengan nama acak di disk private
        $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('attachments', $filename, 'private');

        $attachment = Attachment::create([
            'attachable_type' => $request->attachable_type,
            'attachable_id' => $request->attachable_id,
            'uploaded_by' => Auth::id(),
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $path,
            'file_type' => $file->getClientOriginalMimeType(),
            'file_size' => $file->getSize(),
        ]);

        return response()->json([
            'message' => 'File berhasil diupload!',
            'attachment' => $attachment,
        ], 201);
    }

    public function download($id)
    {
        $attachment = Attachment::findOrFail($id);
        $user = Auth::user();

        // Otorisasi: Hanya pengupload atau orang yang berhak (bisa ditambah logic sesuai kebutuhan)
        // Misalnya: Jika attachable_type adalah TaskSubmission, maka tutor pemilik kelas juga boleh download.
        if ($attachment->uploaded_by !== $user->id) {
             // Cek tambahan jika diperlukan, untuk sekarang batasi pengupload saja
             abort(403, 'Anda tidak memiliki akses ke file ini.');
        }

        if (!Storage::disk('private')->exists($attachment->file_path)) {
            abort(404, 'File tidak ditemukan di storage.');
        }

        return Storage::disk('private')->download($attachment->file_path, $attachment->file_name);
    }

    public function delete($id)
    {
        $attachment = Attachment::findOrFail($id);
        if ($attachment->uploaded_by !== Auth::id()) {
            abort(403);
        }

        Storage::disk('private')->delete($attachment->file_path);
        $attachment->delete();

        return response()->json(['message' => 'File berhasil dihapus.']);
    }
}
