<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KadepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $doc = Document::where('disposisi_set', '>', 0)->latest()->get();

        return view('backend.kadep.index', compact('user', 'doc'));
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($kadep)
    {
        $user = Auth::user();
        $doc = Document::whereId(decrypt($kadep))->first();
        
        return view('backend.documents.show', compact('user', 'doc'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($kadep)
    {
        $user = Auth::user();
        $doc = Document::whereId(decrypt($kadep))->first();
        
        return view('backend.kadep.edit', compact('user', 'doc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kadep)
    {
        if($request->disposisi){
            $validatedData['disposisi_set'] = 2;
            $validatedData['disposisi'] = $request->disposisi;

            $hasil = Document::whereId($kadep)->update($validatedData);

            if($hasil){
                return redirect()->route('kadep.index')->with('success', 'Disposisi berhasil ditambahkan!');
            } else {
                return redirect()->route('kadep.index')->with('error', 'Disposisi gagal ditambahkan!');
            }
        } else {
            $validatedData['disposisi_set'] = 1;
            $validatedData['disposisi'] = null;

            $hasil = Document::whereId($kadep)->update($validatedData);

            if($hasil){
                return redirect()->route('kadep.index')->with('success', 'Disposisi berhasil dihapus!');
            } else {
                return redirect()->route('kadep.index')->with('error', 'Disposisi gagal dihapus!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function download($kadep)
    {
        $file = Document::findOrFail($kadep);

        if ($file->type == 'masuk') {
            return Storage::download($file->file, 'Surat Masuk_' . $file->letter_date);
        }
        elseif ($file->type == 'keluar') {
            return Storage::download($file->file, 'Surat Keluar_' . $file->letter_date);
        }
    }
}
