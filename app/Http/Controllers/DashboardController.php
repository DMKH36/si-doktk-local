<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\User;
use App\Models\Sender;
use App\Models\Receiver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if($user->role == 'admin') {
            $masuk = Document::where('type', '=', 'masuk')->latest()->paginate(10);
            $keluar = Document::where('type', '=', 'keluar')->latest()->paginate(10);
            $total_masuk = Document::where('type', '=', 'masuk')->count();
            $total_keluar = Document::where('type', '=', 'keluar')->count();
            $disposisi = Document::where('disposisi_set', '=', 1)->count();
            
            return view('backend.dashboard', compact('user', 'masuk', 'keluar', 'total_masuk', 'total_keluar', 'disposisi'));
        } elseif($user->role == 'kadep') {
            $masuk = Document::where('type', '=', 'masuk')->latest()->paginate(10);
            $keluar = Document::where('type', '=', 'keluar')->latest()->paginate(10);
            $total_masuk = Document::where('type', '=', 'masuk')->count();
            $total_keluar = Document::where('type', '=', 'keluar')->count();
            $disposisi = Document::where('disposisi_set', '=', 1)->count();
            
            return view('backend.dashboard', compact('user', 'masuk', 'keluar', 'total_masuk', 'total_keluar', 'disposisi'));
        } elseif($user->role == 'koor') {
            $masuk = Document::where('type', '=', 'masuk')->latest()->paginate(10);
            $keluar = Document::where('type', '=', 'keluar')->latest()->paginate(10);
            $total_masuk = Document::where('type', '=', 'masuk')->count();
            $total_keluar = Document::where('type', '=', 'keluar')->count();
            $disposisi = Document::where('disposisi_set', '=', 1)->count();
            
            return view('backend.dashboard', compact('user', 'masuk', 'keluar', 'total_masuk', 'total_keluar', 'disposisi'));
        } elseif($user->role == 'mahasiswa') {
            return redirect('/');
        } elseif($user->role == 'alumni') {
            return redirect('/');
        }
        
    }

    public function profile()
    {
        $user = Auth::user();
        return view('backend.myprofile', compact('user'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name'          => 'required',
            'nim'           => 'required',
            'email'         => 'required|email:dns',
            'mobile_number' => '',
            'gender'        => '',
            'picture'       => 'image|file|max:1024',
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

        if($request->file('picture')) {
            if($request->oldPicture) {
                Storage::delete($request->oldPicture);
            }
            $validatedData['picture'] = $request->file('picture')->store('profile-picture');
        }

        User::whereId(Auth::user()->id)->update($validatedData);

        return redirect()->route('dashboard.profile')->with('success', 'Profilmu berhasil diperbarui!');
    }

    public function delpicture()
    {
        $delpicture = User::whereId(Auth::user()->id)->first();

        if($delpicture->picture) {
            Storage::delete($delpicture->picture);
        }

        User::whereId(Auth::user()->id)->update(['picture' => '']);

        return redirect()->route('dashboard.profile')->with('success', 'Foto Profil Anda berhasil dihapus!');
    }

    public function changepassword(Request $request)
    {
        $validatedData = $request->validate([
            'password_old'      => 'required',
            'password_new'      => 'required',
            'password_confirm'  => 'required',
        ]);

        if (Hash::check($validatedData['password_new'], Auth::user()->password)) {
            return redirect()->route('dashboard.profile')->with('warning', 'Password baru anda sama dengan password lama!');
        }

        if (!Hash::check($validatedData['password_old'], Auth::user()->password)) {
            return redirect()->route('dashboard.profile')->with('error', 'Password lama anda salah!');
        }

        if ($validatedData['password_new'] != $validatedData['password_confirm']) {
            return redirect()->route('dashboard.profile')->with('error', 'Konfirmasi Password anda berbeda!');
        }
        
        User::whereId(Auth::user()->id)->update(['password' => Hash::make($validatedData['password_new'])]);

        return redirect()->route('dashboard.profile')->with('success', 'Password Anda berhasil diperbarui!');
    }
}
