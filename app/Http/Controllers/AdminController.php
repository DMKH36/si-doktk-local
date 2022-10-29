<?php

namespace App\Http\Controllers;

use App\Models\Frontend;
use App\Models\FrontendContact;
use App\Models\FrontendPicture;
use App\Models\FrontendService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $user       =   Auth::user();
        $frontend   = Frontend::where('id', '1')->first();
        $picture    =  FrontendPicture::all();
        $contact    =  FrontendContact::all();
        $service    =  FrontendService::all();
        return view('backend.settfrontend', compact('user', 'frontend', 'picture', 'contact', 'service'));
    }

    public function header(Request $request, Frontend $frontend)
    {
        $rules = [
            'telephone' =>  'required',
            'email'     =>  'required|email',
            'facebook'  =>  'required',
            'twitter'   =>    'required',
            'instagram' =>  'required',
            'wanumber'  =>   'required',
        ];

        $validatedData = $request->validate($rules);

        Frontend::where('id', '1')->update($validatedData);

        return redirect('dashboard/setfrontend')->with('success', 'Data Header berhasil diperbarui!');
    }

    public function paragraf(Request $request, Frontend $frontend)
    {
        $rules = [
            'title1'    =>  'required',
            'subtitle1' =>  'required',
            'picture1'  =>  'image|file',
            'body1'     =>  'required',

            'title2'    =>  'required',
            'subtitle2' =>  'required',
            'picture2'  =>  'image|file',
            'body2'     =>  'required',
        ];

        $validatedData = $request->validate($rules);

        if($request->file('picture1')) {
            if($request->oldPicture1) {
                Storage::delete($request->oldPicture1);
            }
            $validatedData['picture1'] = $request->file('picture1')->store('fe-paragraf');
        }
        if($request->file('picture2')) {
            if($request->oldPicture2) {
                Storage::delete($request->oldPicture2);
            }
            $validatedData['picture2'] = $request->file('picture2')->store('fe-paragraf');
        }

        Frontend::where('id', '1')->update($validatedData);

        return redirect('dashboard/setfrontend')->with('success', 'Data Paragraf berhasil diperbarui!');
    }

    public function pictureAdd(Request $request)
    {
        $validatedData = $request->validate([
            'picture'   =>  'required|image|file'
        ]);

        $validatedData['picture'] = $request->file('picture')->store('hero-carousel');

        FrontendPicture::create($validatedData);

        return redirect('dashboard/setfrontend')->with('success', 'Gambar Hero berhasil ditambahkan!');
    }

    public function pictureDelete(FrontendPicture $id)
    {
        if($id->picture) {
            Storage::delete($id->picture);
        }

        FrontendPicture::destroy($id->id);

        return redirect('dashboard/setfrontend')->with('success', 'Gambar Hero berhasil dihapus!');
    }

}
