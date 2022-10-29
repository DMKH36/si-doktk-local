<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Sender;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $people = User::all();
        $sender = Sender::latest()->get();
        return view('backend.senders.index', compact('user', 'people', 'sender'));
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
        // dd($request);
        $validatedData = $request->validate([
            'user_id'   => '',
            'name'      => 'required',
            'lembaga'   => 'required',
            'address'   => '',
            'email'     => '',
            'phone'     => '',
        ]);

        if($request->phone == 'null')
        {
            $validatedData['phone'] = '';
        }

        $hasil = Sender::create($validatedData);

        if($hasil) {
            return redirect()->route('sender.index')->with('success', 'Data Pengirim surat berhasil ditambahkan!');
        } else {
            return redirect()->route('sender.index')->with('error', 'Data Pengirim surat gagal ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $sender)
    {
        $validatedData = $request->validate([
            'name'      => 'required',
            'lembaga'   => 'required',
            'address'   => '',
            'email'     => '',
            'phone'     => '',
        ]);

        $cek_document = Document::where('sender_id', '=', $sender);
        if($cek_document){
            $cek_document->update([
                'sender_name'   => $validatedData['name'],
                'sender_email'  => $validatedData['email'],
            ]);
        }

        $hasil = Sender::whereId($sender)->update($validatedData);

        if($hasil) {
            return redirect()->route('sender.index')->with('success', 'Data Pengirim surat berhasil diperbaru!');
        } else {
            return redirect()->route('sender.index')->with('error', 'Data Pengirim surat gagal diperbarui!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($sender)
    {
        $cek_document = Document::where('sender_id', '=', $sender);
        if($cek_document){
            $cek_document->update([
                'sender_id'     => 0,
                'sender_name'   => 'Tidak Diketahui',
                'sender_email'  => null,
            ]);
        }

        $hapus = Sender::whereId($sender)->first();

        $hasil = Sender::destroy($hapus->id);

        if($hasil) {
            return redirect()->route('sender.index')->with('success', 'Data Pengirim surat berhasil dihapus!');
        } else {
            return redirect()->route('sender.index')->with('error', 'Data Pengirim surat gagal dihapus!');
        }
    }

    public function getdata($user_id)
    {
        $people = User::whereId($user_id)->first();
        
        return response()->json(['people'=>$people]);
    }
}
