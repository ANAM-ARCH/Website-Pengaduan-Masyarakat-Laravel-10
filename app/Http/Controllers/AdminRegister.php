<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminRegister extends Controller
{
    public function register(Request $request)
    {
        // $post = new Post();
        // $post->title = $request->title;
        // $post->excerpt = $request->excerpt;
        // $post->body = $request->body;
        // $post->image_path = 'temporary';
        // $post->is_published = $request->is_published === 'on';
        // $post->min_to_read = $request->min_to_read;
        // $post->save();


        $request->validate([
            'id_petugas' => [''],
            'type' => [''],
            'jenis' => ['required'],
            'nama' => ['required', 'string', 'max:35'],
            'username' => ['required', 'string', 'max:25', 'unique:users'],
            'telp' => ['string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'max:32']
        ]);




        User::create([
            'id_petugas' =>$request['id_petugas'],
            'type' =>$request['type'],
            'jenis' =>$request['jenis'],
            'nama' =>$request['nama'],
            'username' =>$request['username'],
            'telp' =>$request['telp'],
            'password' => Hash::make($request['password']),
        ]);

        return redirect(route('admin.tambah'))->with('message', 'Akun Petugas Behasil diTambahkan!');

    }
    public function ban($id)
    {

        User::where('id', $id)->update([
            'type' => 3
        ]);
        return redirect(route('admin.tambah'))->with('message', 'Pengguna Berhasil diBan!');
    }
    public function pulihkan($id)
    {

        User::where('id', $id)->update([
            'type' => 0
        ]);
        return redirect(route('admin.tambah'))->with('message', 'Pengguna Berhasil diPulihkan!');
    }
    public function banned()
    {

        return view('banned',[
           ]);
    }
    public function hapusPetugas($id)
    {
            User::where('id', $id)
                ->delete();


                return redirect(route('admin.tambah'))->with('message', 'Petugas Berhasil di Hapus!');
    }
}
