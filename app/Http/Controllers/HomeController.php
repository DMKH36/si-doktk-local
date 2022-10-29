<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sender;
use App\Models\Document;
use App\Models\Frontend;
use App\Models\Receiver;
use Illuminate\Http\Request;
use App\Models\FrontendContact;
use App\Models\FrontendPicture;
use App\Models\FrontendService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function author() {
        return view ('author');
    }

    public function index()
    {
        $user = Auth::user();
        $frontend = Frontend::where('id', '1')->first();
        $picture = FrontendPicture::all();
        $contact = FrontendContact::all();
        $service = FrontendService::all();
        return view('frontend.home', compact('user', 'frontend', 'picture', 'contact', 'service'));
    }

    public function incoming(Request $request)
    {
        $frontend = Frontend::where('id', '1')->first();
        $picture = FrontendPicture::all();
        $contact = FrontendContact::all();
        $service = FrontendService::all();
        $keyword = $request->keyword;
        
        if($user = Auth::user()) {
            if ($user->role == 'mahasiswa'){
                $documents = Document::where('type', '=', 'masuk')
                                        ->where(function ($query) use ($keyword) {
                                            $query  ->orwhere('letter_number', 'LIKE', '%'.$keyword.'%')
                                                    ->orwhere('letter_date', 'LIKE', '%'.$keyword.'%')
                                                    ->orwhere('sender_name', 'LIKE', '%'.$keyword.'%')
                                                    ->orwhere('regarding', 'LIKE', '%'.$keyword.'%');
                                        })
                                        ->where(function ($query) use ($user) {
                                            $query  ->orwhere('viewer', '=', 'public')
                                                    ->orwhere('viewer', '=', 'mahasiswa')
                                                    ->orwhere('viewer', '=', 'mahasiswa-alumni')
                                                    ->orwhere('sender_email', '=', $user->email);
                                        })
                                        ->latest()
                                        ->paginate(6);
            } elseif ($user->role == 'alumni'){
                $documents = Document::where('type', '=', 'masuk')
                                        ->where(function ($query) use ($keyword) {
                                            $query  ->orwhere('letter_number', 'LIKE', '%'.$keyword.'%')
                                                    ->orwhere('letter_date', 'LIKE', '%'.$keyword.'%')
                                                    ->orwhere('sender_name', 'LIKE', '%'.$keyword.'%')
                                                    ->orwhere('regarding', 'LIKE', '%'.$keyword.'%');
                                        })
                                        ->where(function ($query) use ($user) {
                                            $query  ->orwhere('viewer', '=', 'public')
                                                    ->orwhere('viewer', '=', 'alumni')
                                                    ->orwhere('viewer', '=', 'mahasiswa-alumni')
                                                    ->orwhere('sender_email', '=', $user->email);
                                        })
                                        ->latest()
                                        ->paginate(6);
            } elseif ($user->role == "admin" || $user->role == "kadep" || $user->role == "koor"){
                $documents = Document::where('type', '=', 'masuk')
                                        ->where(function ($query) use ($keyword) {
                                            $query  ->orwhere('letter_number', 'LIKE', '%'.$keyword.'%')
                                                    ->orwhere('letter_date', 'LIKE', '%'.$keyword.'%')
                                                    ->orwhere('sender_name', 'LIKE', '%'.$keyword.'%')
                                                    ->orwhere('regarding', 'LIKE', '%'.$keyword.'%');
                                        })
                                        ->latest()
                                        ->paginate(6);
            }
        } else {
            $documents = Document::where('type', '=', 'masuk')
                                    ->where('viewer', '=', 'public')
                                    ->where(function ($query) use ($keyword) {
                                        $query  ->orwhere('letter_number', 'LIKE', '%'.$keyword.'%')
                                                ->orwhere('letter_date', 'LIKE', '%'.$keyword.'%')
                                                ->orwhere('sender_name', 'LIKE', '%'.$keyword.'%')
                                                ->orwhere('regarding', 'LIKE', '%'.$keyword.'%');
                                    })
                                    ->latest()
                                    ->paginate(6);            
        }   

        return view('frontend.docs.incoming', compact('user', 'frontend', 'picture', 'contact', 'service', 'documents', 'keyword'));
    }

    public function outgoing(Request $request)
    {
        $frontend = Frontend::where('id', '1')->first();
        $picture = FrontendPicture::all();
        $contact = FrontendContact::all();
        $service = FrontendService::all();
        $keyword = $request->keyword;

        if($user = Auth::user()) {
            if ($user->role == 'mahasiswa'){
                $documents = Document::where('type', '=', 'keluar')
                                        ->where(function ($query) use ($keyword) {
                                            $query  ->orwhere('letter_number', 'LIKE', '%'.$keyword.'%')
                                                    ->orwhere('letter_date', 'LIKE', '%'.$keyword.'%')
                                                    ->orwhere('receiver_name', 'LIKE', '%'.$keyword.'%')
                                                    ->orwhere('regarding', 'LIKE', '%'.$keyword.'%');
                                        })
                                        ->where(function ($query) use ($user) {
                                            $query  ->orwhere('viewer', '=', 'public')
                                                    ->orwhere('viewer', '=', 'mahasiswa')
                                                    ->orwhere('viewer', '=', 'mahasiswa-alumni')
                                                    ->orwhere('receiver_email', '=', $user->email);
                                        })
                                        ->latest()
                                        ->paginate(6);
            } elseif ($user->role == 'alumni') {
                $documents = Document::where('type', '=', 'keluar')
                                        ->where(function ($query) use ($keyword) {
                                            $query  ->orwhere('letter_number', 'LIKE', '%'.$keyword.'%')
                                                    ->orwhere('letter_date', 'LIKE', '%'.$keyword.'%')
                                                    ->orwhere('receiver_name', 'LIKE', '%'.$keyword.'%')
                                                    ->orwhere('regarding', 'LIKE', '%'.$keyword.'%');
                                        })
                                        ->where(function ($query) use ($user) {
                                            $query  ->orwhere('viewer', '=', 'public')
                                                    ->orwhere('viewer', '=', 'alumni')
                                                    ->orwhere('viewer', '=', 'mahasiswa-alumni')
                                                    ->orwhere('receiver_email', '=', $user->email);
                                        })
                                        ->latest()
                                        ->paginate(6);          
            } elseif ($user->role == "admin" || $user->role == "kadep" || $user->role == "koor"){
                $documents = Document::where('type', '=', 'keluar')
                                        ->where(function ($query) use ($keyword) {
                                            $query  ->orwhere('letter_number', 'LIKE', '%'.$keyword.'%')
                                                    ->orwhere('letter_date', 'LIKE', '%'.$keyword.'%')
                                                    ->orwhere('receiver_name', 'LIKE', '%'.$keyword.'%')
                                                    ->orwhere('regarding', 'LIKE', '%'.$keyword.'%');
                                        })
                                        ->latest()
                                        ->paginate(6);
            }
        } else {
            $documents = Document::where('type', '=', 'keluar')
                                        ->where('viewer', '=', 'public')
                                        ->where(function ($query) use ($keyword) {
                                            $query  ->orwhere('letter_number', 'LIKE', '%'.$keyword.'%')
                                                    ->orwhere('letter_date', 'LIKE', '%'.$keyword.'%')
                                                    ->orwhere('receiver_name', 'LIKE', '%'.$keyword.'%')
                                                    ->orwhere('regarding', 'LIKE', '%'.$keyword.'%');
                                        })
                                        ->latest()
                                        ->paginate(6);
        }

        return view('frontend.docs.outgoing', compact('user', 'frontend', 'picture', 'contact', 'service', 'documents', 'keyword'));
    }

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
    public function show($id)
    {
        $user = Auth::user();
        $documents = Document::whereId(decrypt($id))->first();
        $frontend = Frontend::where('id', '1')->first();
        $picture = FrontendPicture::all();
        $contact = FrontendContact::all();
        $service = FrontendService::all();

        return view('frontend.docs.show', compact('user', 'documents', 'frontend', 'picture', 'contact', 'service'));
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

    public function download($id)
    {
        $file = Document::findOrFail($id);
        
        if ($file->type == 'masuk') {
            return Storage::download($file->file, 'Surat Masuk_' . $file->letter_date);
        }
        elseif ($file->type == 'keluar') {
            return Storage::download($file->file, 'Surat Keluar_' . $file->letter_date);
        }
    }

    public function profile()
    {
        $user = Auth::user();
        $frontend = Frontend::where('id', '1')->first();
        $picture = FrontendPicture::all();
        $contact = FrontendContact::all();
        $service = FrontendService::all();

        return view('auth.profile', compact('user', 'frontend', 'picture', 'contact', 'service'));
    }

    public function update_profile(Request $request)
    {
        $validatedData = $request->validate([
            'name'          => 'required',
            'nim'           => 'required',
            'email'         => 'required|email:dns',
            'gender'        => 'required',
            'mobile_number' => '',
        ]);

        $cek_sender = Sender::where('user_id', '=', Auth::user()->id)->first();
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

        $cek_receiver = Receiver::where('user_id', '=', Auth::user()->id)->first();
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

        User::whereId(Auth::user()->id)->update($validatedData);

        return redirect()->route('profile')->with('success', 'Data Akun anda telah diperbarui!');
    }

    public function update_picture(Request $request)
    {
        $validatedData = $request->validate([
            'picture' => 'image|file|max:1024',
        ]);

        if($request->file('picture')) {
            if($request->oldPicture) {
                Storage::delete($request->oldPicture);
            }
            $validatedData['picture'] = $request->file('picture')->store('profile-picture');
        }

        User::whereId(Auth::user()->id)->update($validatedData);
        
        return redirect()->route('profile')->with('success', 'Foto Profile anda telah diperbarui!');
    }

    public function update_ktm(Request $request)
    {
        $validatedData = $request->validate([
            'ktm' => 'image|file|max:1024',
        ]);

        if($request->file('ktm')) {
            if($request->oldKtm) {
                Storage::delete($request->oldKtm);
            }
            $validatedData['ktm'] = $request->file('ktm')->store('ktm');
        }

        User::whereId(Auth::user()->id)->update($validatedData);
        
        return redirect()->route('profile')->with('success', 'KTM anda telah diperbarui!');
    }

    public function update_password(Request $request)
    {
        $validatedData = $request->validate([
            'password_old'      => 'required',
            'password_new'      => 'required',
            'password_confirm'  => 'required',
        ]);

        if (Hash::check($validatedData['password_new'], Auth::user()->password)) {
            return redirect()->route('profile')->with('warning', 'Password baru anda sama dengan password lama!');
        }

        if (!Hash::check($validatedData['password_old'], Auth::user()->password)) {
            return redirect()->route('profile')->with('error', 'Password lama anda salah!');
        }

        if ($validatedData['password_new'] != $validatedData['password_confirm']) {
            return redirect()->route('profile')->with('error', 'Konfirmasi Password anda berbeda!');
        }
        
        User::whereId(Auth::user()->id)->update(['password' => Hash::make($validatedData['password_new'])]);

        return redirect()->route('profile')->with('success', 'Password anda telah diperbarui!');
    }
}
