<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sender;
use App\Models\Frontend;
use App\Models\Receiver;
use Illuminate\Http\Request;
use App\Models\FrontendContact;
use App\Models\FrontendPicture;
use App\Models\FrontendService;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        $frontend = Frontend::where('id', '1')->first();
        $picture = FrontendPicture::all();
        $contact = FrontendContact::all();
        $service = FrontendService::all();
        return view('auth.register', compact('frontend', 'picture', 'contact', 'service'));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'              =>  'required',
            'gender'            =>  'required',
            'nim'               =>  'required|unique:users',
            'email'             =>  'required|email:dns|unique:users',
            'role'              =>  'required',
            'mobile_number'     =>  'required|max:15|unique:users',
            'ktm'               =>  'required|image|file|max:1024',
            'password'          =>  'required|min:5|max:255',
            'password-confirm'  =>  'required|same:password',
        ]);

        $validatedData['ktm'] = $request->file('ktm')->store('ktm');
        $validatedData['password'] = Hash::make($validatedData['password']);

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

        return redirect()->route('login')->with('success', 'Registrasi Berhasil, silahkan tunggu hingga akun anda diaktivasi oleh Admin!');
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
    public function update(Request $request, $id)
    {
        //
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
}
