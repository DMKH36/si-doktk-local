<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sender;
use App\Models\Receiver;
use App\Models\Document;
use App\Imports\UserImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $pengguna = User::where('role', '=', 'mahasiswa')
                            ->orWhere('role', '=', 'alumni')
                            ->latest()
                            ->get();

        return view('backend.users.index', compact('user', 'pengguna'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('backend.users.create', compact('user'));
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
            'name'          => 'required',
            'nim'           => 'required|unique:users',
            'gender'        => '',
            'email'         => 'required|email:dns|unique:users',
            'mobile_number' => 'max:15',
            'role'          => 'required',
            'status'        => 'required|in:0,1',
            'ktm'           => 'image|file|max:1024',
            'picture'       => 'image|file|max:1024',
        ]);

        $validatedData['password'] = bcrypt('password');

        if($request->file('ktm')) {
            $validatedData['ktm'] = $request->file('ktm')->store('ktm');
        }

        if($request->file('picture')) {
            $validatedData['picture'] = $request->file('picture')->store('profile-picture');
        }

        User::create($validatedData);
        $user = User::where('email', '=', $validatedData['email'])->first();

        $cek_sender = Sender::where('email', '=', $user->email)->first();
        if ($cek_sender) {
            $cek_sender->update([
                'user_id'   => $user->id,
                'name'      => $user->name,
                'phone'     => $user->mobile_number,
            ]);
        }
        $cek_receiver = Receiver::where('email', '=', $user->email)->first();
        if ($cek_receiver) {
            $cek_receiver->update([
                'user_id'   => $user->id,
                'name'      => $user->name,
                'phone'     => $user->mobile_number,
            ]);
        }

        return redirect()->route('user.index')->with('success', 'Pengguna berhasil ditambahkan!');
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
    public function edit($user_id)
    {
        $user = Auth::user();
        $pengguna = User::whereId(decrypt($user_id))->first();
        return view('backend.users.edit', compact('user', 'pengguna'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id)
    {
        $validatedData = $request->validate([
            'name'          => 'required',
            'nim'           => 'required',
            'gender'        => '',
            'email'         => 'required|email:dns',
            'mobile_number' => 'max:15',
            'role'          => 'required',
            'status'        => 'required|in:0,1',
            'ktm'           => 'image|file|max:1024',
            'picture'       => 'image|file|max:1024',
        ]);

        $cek_sender = Sender::where('user_id', '=', $user_id)->first();
        if($cek_sender){
            $cek_sender->update([
                'name'  => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['mobile_number'],
            ]);
            
            $sender_id = $cek_sender->id;
            if($sender_id != 0) {
                $cek_document = Document::where('sender_id', '=', $sender_id);
                if($cek_document){
                    $cek_document->update([
                        'sender_name'   => $validatedData['name'],
                        'sender_email'  => $validatedData['email'],
                    ]);
                }
            }
        }

        $cek_receiver = Receiver::where('user_id', '=', $user_id)->first();
        if($cek_receiver){
            $cek_receiver->update([
                'name'  => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['mobile_number'],
            ]);

            $receiver_id = $cek_receiver->id;
            if($receiver_id != 0) {
                $cek_document = Document::where('receiver_id', '=', $receiver_id);
                if($cek_document){
                    $cek_document->update([
                        'receiver_name'   => $validatedData['name'],
                        'receiver_email'  => $validatedData['email'],
                    ]);
                }
            }
        }

        if($request->file('ktm')) {
            if($request->oldKtm) {
                Storage::delete($request->oldKtm);
            }
            $validatedData['ktm'] = $request->file('ktm')->store('ktm');
        }

        if($request->file('picture')) {
            if($request->oldPicture) {
                Storage::delete($request->oldPicture);
            }
            $validatedData['picture'] = $request->file('picture')->store('profile-picture');
        }

        User::whereId($user_id)->update($validatedData);

        return redirect()->route('user.index')->with('success', 'Data Pengguna berhasil diperbarui!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id)
    {
        $cek_sender = Sender::where('user_id', '=', $user_id)->first();
        if($cek_sender){
            $cek_sender->update([
                'user_id' => 0
            ]);
        }
        $cek_receiver = Receiver::where('user_id', '=', $user_id)->first();
        if($cek_receiver){
            $cek_receiver->update([
                'user_id' => 0
            ]);
        }

        $hapuspengguna = User::whereId($user_id)->first();

        if($hapuspengguna->ktm) {
            Storage::delete($hapuspengguna->ktm);
        }

        if($hapuspengguna->picture) {
            Storage::delete($hapuspengguna->picture);
        }

        User::destroy($hapuspengguna->id);

        return redirect()->route('user.index')->with('success', 'Pengguna berhasil dihapus!');
    }

    public function updateStatus($user_id, $status)
    {
        Validator::make([
            'user_id'   =>  $user_id,
            'status'    =>  $status,
        ], [
            'user_id'   =>  'required|exists:users,id',
            'status'    =>  'required|in:0,1',
        ]);

        $user_id = decrypt($user_id);

        // Proses Update Status
        $pengguna = User::whereId($user_id)->update(['status' => $status]);

        // Pesan Session
        if ($pengguna) {
            if ($status == 0) {
                return redirect()->route('user.index')->with('info', 'Status Pengguna menjadi Inactive!');
            }
            return redirect()->route('user.index')->with('info', 'Status Pengguna menjadi Active!');
        } else {
            return redirect()->route('user.index')->with('error', 'Status Pengguna gagal diperbarui!');
        }
    }

    public function reset($user_id)
    {
        $user_id = User::whereId($user_id)->update(['password' => bcrypt('password')]);
        
        return redirect()->route('user.index')->with('success', 'Password berhasil direset!');
    }

    public function delpicture($user_id)
    {
        $delpicture = User::whereId($user_id)->first();

        if($delpicture->picture) {
            Storage::delete($delpicture->picture);
        }

        User::whereId($user_id)->update(['picture' => '']);

        return redirect()->route('user.index')->with('success', 'Foto Profil Pengguna berhasil dihapus!');
    }

    public function import()
    {
        $this->validate(request(), [
            'file'  => 'mimes:csv,xls,xlsx'
        ]);

        if (request()->file('file') == null) {
            return redirect()->route('user.index')->with('info', 'Masukkan file terlebih dahulu!');
        }

        $filename = date('y-m-d') . '_' . 'Import User' . '.xlsx';
        request()->file('file')->storeAs('import-user', $filename, 'public');

        $hasil = Excel::import(new UserImport, request()->file('file'));
        if ($hasil) {
            return redirect()->route('user.index')->with('success', 'Data Pengguna berhasil ditambahkan!');
        }
        return redirect()->route('user.index')->with('error', 'Data Pengguna gagal ditambahkan!');
    }
}
