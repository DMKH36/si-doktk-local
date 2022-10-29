<?php

namespace App\Http\Controllers;

use ZipArchive;
use App\Models\Sender;
use App\Models\Document;
use App\Models\Receiver;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\DocumentinExport;
use App\Imports\DocumentInImport;
use App\Exports\DocumentoutExport;
use App\Imports\DocumentOutImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('document.create');
    }

    public function incoming()
    {
        $user = Auth::user();
        $masuk = Document::where('type', '=', 'masuk')->latest()->get();
        
        return view('backend.documents.incoming', compact('user', 'masuk'));
    }

    public function outgoing()
    {
        $user = Auth::user();
        $keluar = Document::where('type', '=', 'keluar')->latest()->get();
        
        return view('backend.documents.outgoing', compact('user', 'keluar'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user       = Auth::user();
        $senders     = Sender::all();
        $receivers   = Receiver::all();
        
        return view('backend.documents.create', compact('user', 'senders', 'receivers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type'              => 'required',
            'letter_number'     => 'required',
            'letter_date'       => 'required',
            'date_received'     => '',
            'sender_id'         => 'required',
            'receiver_id'       => 'required',
            'regarding'         => 'required',
            'file'              => 'required|mimes:pdf|file',
            'viewer'            => 'required',
            'disposisi_set'     => 'required',
            'description'       => '',
        ]);

        if($request->type == 'keluar') {
            $validatedData['date_received'] = null;
        }

        $sender = Sender::whereId($request->sender_id)->first();
        $validatedData['sender_name'] = $sender->name;

        $receiver = Receiver::whereId($request->receiver_id)->first();
        $validatedData['receiver_name'] = $receiver->name;
        
        $validatedData['file'] = $request->file('file')->store('document');

        if($request->viewer == 'private'){
            $validatedData['sender_email'] = $sender->email;
            $validatedData['receiver_email'] = $receiver->email;
        }

        $hasil = Document::create($validatedData);

        if($hasil) {
            if($request->type == 'masuk') {
                return redirect()->route('doc.incoming')->with('success', 'Dokumen Surat Masuk berhasil ditambahkan!');
            } else {
                return redirect()->route('doc.outgoing')->with('success', 'Dokumen Surat Keluar berhasil ditambahkan!');
            }
        } else {
            return redirect()->route('doc.create')->with('error', 'Dokumen Surat gagal ditambahkan!');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($document)
    {
        $user = Auth::user();
        $doc = Document::whereId(decrypt($document))->first();
        
        return view('backend.documents.show', compact('user', 'doc'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($document)
    {
        $user       = Auth::user();
        $doc        = Document::whereId(decrypt($document))->first();
        $senders    = Sender::all();
        $receivers  = Receiver::all();
        
        return view('backend.documents.edit', compact('user', 'doc', 'senders', 'receivers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $document)
    {
        $validatedData = $request->validate([
            'type'          => 'required',
            'letter_number' => 'required',
            'letter_date'   => 'required',
            'date_received' => '',
            'sender_id'     => 'required',
            'receiver_id'   => 'required',
            'regarding'     => 'required',
            'file'          => 'mimes:pdf|file',
            'viewer'        => 'required',
            'disposisi_set' => 'required',
            'description'   => '',
        ]);

        if($request->type == 'keluar') {
            $validatedData['date_received'] = null;
        }

        $sender = Sender::whereId($request->sender_id)->first();
        if($sender) {
            $validatedData['sender_name'] = $sender->name;
            if($request->viewer == 'private'){
                $validatedData['sender_email'] = $sender->email;
            }
        } else {
            $validatedData['sender_name'] = 'Tidak Diketahui';
            if($request->viewer == 'private'){
                $validatedData['sender_email'] = null;
            }
        }
        
        $receiver = Receiver::whereId($request->receiver_id)->first();
        if($receiver) {
            $validatedData['receiver_name'] = $receiver->name;
            if($request->viewer == 'private'){
                $validatedData['receiver_email'] = $receiver->email;
            }
        } else {
            $validatedData['receiver_name'] = 'Tidak Diketahui';
            if($request->viewer == 'private') {
                $validatedData['receiver_email'] = null;
            }
        }
        

        if($request->file('file')) {
            if($request->oldFile) {
                Storage::delete($request->oldFile);
            }
            $validatedData['file'] = $request->file('file')->store('document');
        }

        $hasil = Document::whereId($document)->update($validatedData);

        if($hasil) {
            if($request->type == 'masuk') {
                return redirect()->route('doc.incoming')->with('success', 'Dokumen Surat Masuk berhasil diperbarui!');
            } else {
                return redirect()->route('doc.outgoing')->with('success', 'Dokumen Surat Keluar berhasil diperbarui!');
            }
        } else {
            if($request->type == 'masuk') {
                return redirect()->route('doc.incoming')->with('error', 'Dokumen Surat Masuk gagal diperbarui!');
            } else {
                return redirect()->route('doc.outgoing')->with('error', 'Dokumen Surat Keluar gagal diperbarui!');
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($document)
    {
        $deldoc = Document::findorFail($document);

        if ($deldoc->type == 'masuk') {
            $redirect = 'doc.incoming';
            $pesan = 'Surat Masuk berhasil dihapus!';
        } else {
            $redirect = 'doc.outgoing';
            $pesan = 'Surat Keluar berhasil dihapus!';
        }

        Storage::delete($deldoc->file);

        $deldoc->delete();

        return redirect()->route($redirect)->with('success', $pesan);
    }

    public function deleteCheckbox(Request $request)
    {
        $ids = $request->ids;
        
        $data = Document::whereIn('id',explode(",",$ids))->get();

        foreach ($data as $hapus) {
            Storage::delete($hapus->file);
            $hapus->delete();
        }
        
        return response()->json(['success'=>"Beberapa Dokumen Berhasil Dihapus!"]);
    }

    public function change($doc_id, $type)
    {
        Validator::make([
            'id'    => $doc_id,
            'type'  => $type,
        ], [
            'id'    => 'required|exists:documents,id',
            'type'  => 'required'
        ]);

        $doc_id = decrypt($doc_id);

        $document = Document::whereId($doc_id)->update(['type' => $type]);

        if($document) {
            if ($type == 'masuk') {
                return redirect()->route('doc.incoming')->with('success', 'Jenis Surat berhasil diubah menjadi Surat Masuk');
            }
            return redirect()->route('doc.outgoing')->with('success', 'Jenis Surat berhasil diubah menjadi Surat Keluar');
        } else {
            if ($type == 'masuk') {
                return redirect()->route('doc.outgoing')->with('error', 'Jenis Surat gagal diubah menjadi Surat Masuk');
            }
            return redirect()->route('doc.incoming')->with('error', 'Jenis Surat gagal diubah menjadi Surat Keluar');
        }

    }

    public function download($doc_id)
    {
        $file = Document::findOrFail($doc_id);
        if ($file->type == 'masuk') {
            return Storage::download($file->file, 'Surat Masuk_' . $file->letter_date);
        }
        elseif ($file->type == 'keluar') {
            return Storage::download($file->file, 'Surat Keluar_' . $file->letter_date);
        }
        else {
            return view('backend.dashboard');
        }
    }

    public function inpdf($type)
    {
        $document = Document::where('type', $type)->get();
        $awal = null;
        $akhir = null;

        $pdf = Pdf::loadView('backend.documents.print-in', compact('document', 'awal', 'akhir'))->setPaper('a4', 'landscape');

        return $pdf->download("Data Surat Masuk Tekkom" . "_" . date('d-m-y') . '.pdf');
    }

    public function indate($startdate, $enddate)
    {
        // dd(["Tanggal Awal : ".$startdate, "Tanggal Akhir : ".$enddate]);
        $document = Document::where('type', '=', 'masuk')->whereBetween('letter_date', [$startdate, $enddate])->get();
        $awal = $startdate;
        $akhir = $enddate;

        $pdf = Pdf::loadView('backend.documents.print-in', compact('document', 'awal', 'akhir'))->setpaper('a4', 'landscape');

        return $pdf->download("Data Surat Masuk Tekkom - Range" . "_" . date('d-m-y') . '.pdf');
    }

    public function outpdf($type)
    {
        $document = Document::where('type', $type)->get();
        $awal = null;
        $akhir = null;

        $pdf = Pdf::loadView('backend.documents.print-out', compact('document', 'awal', 'akhir'))->setpaper('a4', 'landscape');

        return $pdf->download("Data Surat Keluar Tekkom" . "_" . date('d-m-y') . '.pdf');
    }

    public function outdate($startdate, $enddate)
    {
        // dd(["Tanggal Awal : ".$startdate, "Tanggal Akhir : ".$enddate]);
        $document = Document::where('type', '=', 'keluar')->whereBetween('letter_date', [$startdate, $enddate])->get();
        $awal = $startdate;
        $akhir = $enddate;

        $pdf = Pdf::loadView('backend.documents.print-out', compact('document', 'awal', 'akhir'))->setpaper('a4', 'landscape');

        return $pdf->download("Data Surat Keluar Tekkom - Range" . "_" . date('d-m-y') . '.pdf');
    }

    public function inimport(Request $request)
    {
        $request->validate([
            'excel'     => 'required|file|mimes:csv,xls,xlsx',
            'zip'       => 'required|file|mimes:zip'
        ]);

        if ($request->excel == null && $request->zip == null) {
            return redirect()->route('doc.incoming')->with('info', 'Masukkan file excel dan zip terlebih dahulu!');
        } elseif ($request->excel == null) {
            return redirect()->route('doc.incoming')->with('info', 'Masukkan file excel terlebih dahulu!');
        } elseif ($request->zip == null) {
            return redirect()->route('doc.incoming')->with('info', 'Masukkan file zip terlebih dahulu!');
        }

        // Excel
        $excelname = date('y-m-d') . " - Import Data Surat Masuk" . ".xlsx";
        
        $request->file('excel')->storeAs('import-surat-masuk', $excelname, 'public');

        $exceldone = Excel::import(new DocumentInImport, request()->file('excel'));

        if ($exceldone){
            // Zip
            $zip = new ZipArchive();
            $zipname = date('y-m-d') . "- File Import Surat Masuk" . ".zip";
            $request->file('zip')->storeAs('import-zip-masuk', $zipname, 'public');
            $zip->open(Storage::path('import-zip-masuk/'.$zipname));
            $zip->extractTo(Storage::path('document/'));
            $zip->close();

            return redirect()->route('doc.incoming')->with('success', 'Data Surat Masuk berhasil ditambahkan!');
        }
        return redirect()->route('doc.incoming')->with('error', 'Data Excel Anda terdapat kesalahan!');
    }

    public function inexport()
    {
        return Excel::download(new DocumentinExport, "Data Surat Masuk Tekkom - " .  date('d-m-y') .  ".xlsx");
    }

    public function outimport(Request $request)
    {
        $request->validate([
            'excel'     => 'required|file|mimes:csv,xls,xlsx',
            'zip'       => 'required|file|mimes:zip'
        ]);

        if ($request->excel == null && $request->zip == null) {
            return redirect()->route('doc.outgoing')->with('info', 'Masukkan file excel dan zip terlebih dahulu!');
        } elseif ($request->excel == null) {
            return redirect()->route('doc.outgoing')->with('info', 'Masukkan file excel terlebih dahulu!');
        } elseif ($request->zip == null) {
            return redirect()->route('doc.outgoing')->with('info', 'Masukkan file zip terlebih dahulu!');
        }
        
        // Excel
        $excelname = date('y-m-d') . " - Import Data Surat Keluar" . ".xlsx";
        $request->file('excel')->storeAs('import-surat-keluar', $excelname, 'public');
        $exceldone = Excel::import(new DocumentOutImport, request()->file('excel'));

        if ($exceldone){
            // Zip
            $zip = new ZipArchive();
            $zipname = date('y-m-d') . "- File Import Surat Keluar" . ".zip";
            $request->file('zip')->storeAs('import-zip-keluar', $zipname, 'public');
            $zip->open(Storage::path('import-zip-keluar/'.$zipname));
            $zip->extractTo(Storage::path('document/'));
            $zip->close();

            return redirect()->route('doc.outgoing')->with('success', 'Data Surat Keluar berhasil ditambahkan!');
        }
        return redirect()->route('doc.outgoing')->with('error', 'Data Excel Anda terdapat kesalahan!');

    }

    public function outexport()
    {
        return Excel::download(new DocumentoutExport, "Data Surat Keluar Tekkom - " .  date('d-m-y') .  ".xlsx");
    }
}
