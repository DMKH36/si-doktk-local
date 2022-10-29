<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sender;
use App\Models\Document;
use App\Models\Receiver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class OperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $operator = User::where('id', '!=', $user->id)
                            ->where('role', '=', 'admin')
                            ->orWhere('role', '=', 'kadep')
                            ->orWhere('role', '=', 'koor')
                            ->latest()
                            ->get();
        
        return view('backend.operators.index', compact('user', 'operator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('backend.operators.create', compact('user'));
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
            'name'          =>  'required',
            'nim'           =>  'required|unique:users',
            'gender'        =>  '',
            'email'         =>  'required|email:dns|unique:users',
            'mobile_number' =>  'max:15',
            'role'          =>  'required',
            'status'        =>  'required|in:0,1',
            'picture'       =>  'image|file|max:1024',
        ]);

        $validatedData['password'] = bcrypt('password');

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


        return redirect()->route('operator.index')->with('success', 'Pengurus berhasil ditambahkan!');
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
    public function edit($operator)
    {
        $user = Auth::user();
        $operator = User::whereId(decrypt($operator))->first();
        return view('backend.operators.edit', compact('user', 'operator'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $operator)
    {
        $validatedData = $request->validate([
            'name'          =>  'required',
            'nim'           =>  'required',
            'gender'        =>  '',
            'email'         =>  'required|email:dns',
            'mobile_number' =>  'max:15',
            'role'          =>  'required',
            'status'        =>  'required|in:0,1',
            'picture'       =>  'image|file|max:1024',
        ]);
        
        $cek_sender = Sender::where('user_id', '=', $operator)->first();
        if($cek_sender){
            $cek_sender->update([
                'name'  => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['mobile_number'],
            ]);

            $sender_id = $cek_sender->id;
            if($sender_id != 0){
                $cek_document = Document::where('sender_id', "=", $sender_id);
                if($cek_document){
                    $cek_document->update([
                        'sender_name'   => $validatedData['name'],
                        'sender_email'  => $validatedData['email'],
                    ]);
                }
            }
        }

        $cek_receiver = Receiver::where('user_id', '=', $operator)->first();
        if($cek_receiver){
            $cek_receiver->update([
                'name'  => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['mobile_number'],
            ]);

            $receiver_id = $cek_receiver->id;
            if($receiver_id != 0) {
                $cek_document = Document::where('receiver_id', "=", $receiver_id);
                if($cek_document){
                    $cek_document->update([
                        'receiver_name'   => $validatedData['name'],
                        'receiver_email'  => $validatedData['email'],
                    ]);
                }
            }
        }

        if($request->file('picture')) {
            if($request->oldPicture) {
                Storage::delete($request->oldPicture);
            }
            $validatedData['picture'] = $request->file('picture')->store('profile-picture');
        }

        User::whereId($operator)->update($validatedData);

        return redirect()->route('operator.index')->with('success', 'Data Pengurus berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($operator)
    {
        $cek_sender = Sender::where('user_id', '=', $operator);
        if($cek_sender){
            $cek_sender->update([
                'user_id' => 0
            ]);
        }
        $cek_receiver = Receiver::where('user_id', '=', $operator);
        if($cek_receiver){
            $cek_receiver->update([
                'user_id' => 0
            ]);
        }

        $operatorhapus = User::whereId($operator)->first();

        if($operatorhapus->picture) {
            Storage::delete($operatorhapus->picture);
        }

        User::destroy($operatorhapus->id);

        return redirect()->route('operator.index')->with('success', 'Pengurus berhasil dihapus!');
    }

    public function updateStatus($user_id, $status)
    {
        Validator::make([
            'user_id'   =>  $user_id,
            'status'    =>  $status,
        ], [
            'user_id'   =>  'required|exists:user,id',
            'status'    =>  'required|in:0,1',
        ]);

        $user_id = decrypt($user_id);

        // Proses Update Status
        $operator = User::whereId($user_id)->update(['status' => $status]);

        // Pesan Session
        if ($operator) {
            if ($status == 0) {
                return redirect()->route('operator.index')->with('info', 'Status Pengurus menjadi Inactive!');
            }
            return redirect()->route('operator.index')->with('info', 'Status Pengurus menjadi Active!');
        } else {
            return redirect()->route('operator.index')->with('error', 'Status Pengurus gagal diperbarui!');
        }
    }

    public function reset($operator)
    {
        $operator = User::whereId($operator)->update(['password' => bcrypt('password')]);
        
        return redirect()->route('operator.index')->with('success', 'Password berhasil direset!');
    }

    public function delpicture($operator)
    {
        $delpicture = User::whereId($operator)->first();

        if($delpicture->picture) {
            Storage::delete($delpicture->picture);
        }

        User::whereId($operator)->update(['picture' => '']);

        return redirect()->route('operator.index')->with('success', 'Foto Profil Pengurus berhasil dihapus!');
    }
}
