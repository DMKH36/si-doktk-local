<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Receiver;
use App\Models\Document;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceiverController extends Controller
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
        $receiver = Receiver::latest()->get();
        return view('backend.receivers.index', compact('user', 'people', 'receiver'));
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

        $hasil = Receiver::create($validatedData);

        if($hasil) {
            return redirect()->route('receiver.index')->with('success', 'Data Penerima surat berhasil ditambahkan!');
        } else {
            return redirect()->route('receiver.index')->with('error', 'Data Penerima surat gagal ditambahkan!');
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
    public function update(Request $request, $receiver)
    {
        $validatedData = $request->validate([
            'name'      => 'required',
            'lembaga'   => 'required',
            'address'   => '',
            'email'     => '',
            'phone'     => '',
        ]);

        $cek_document = Document::where('receiver_id', '=', $receiver);
        if($cek_document){
            $cek_document->update([
                'receiver_name'     => $validatedData['name'],
                'receiver_email'    => $validatedData['email'],
            ]);
        }

        $hasil = Receiver::whereId($receiver)->update($validatedData);

        if($hasil) {
            return redirect()->route('receiver.index')->with('success', 'Data Penerima surat berhasil diperbaru!');
        } else {
            return redirect()->route('receiver.index')->with('error', 'Data Penerima surat gagal diperbarui!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($receiver)
    {
        $cek_document = Document::where('receiver_id', '=', $receiver);
        if($cek_document){
            $cek_document->update([
                'receiver_id'     => 0,
                'receiver_name'   => 'Tidak Diketahui',
                'receiver_email'  => null,
            ]);
        }

        $hapus = Receiver::whereId($receiver)->first();

        $hasil = Receiver::destroy($hapus->id);

        if($hasil) {
            return redirect()->route('receiver.index')->with('success', 'Data Penerima surat berhasil dihapus!');
        } else {
            return redirect()->route('receiver.index')->with('error', 'Data Penerima surat gagal dihapus!');
        }
    }

    public function getdata($user_id)
    {
        $people = User::whereId($user_id)->first();
        
        return response()->json(['people'=>$people]);
    }
}
