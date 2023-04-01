<?php

namespace App\Http\Controllers;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PengaduanController extends Controller
{
    public function index()
    {
        $tanggapan = User::join('pengaduan', 'pengaduan.id', '=', 'users.id')
        ->join('tanggapan', 'tanggapan.id_pengaduan', '=', 'pengaduan.id_pengaduan')
        ->get();

        return view('userAction.laporan',[
            'pengaduan' => Pengaduan::get(),
            'tanggapan' => $tanggapan
        ]);
    }
    public function laporanGagal()
    {
        $tanggapan = User::join('pengaduan', 'pengaduan.id', '=', 'users.id')
        ->join('tanggapan', 'tanggapan.id_pengaduan', '=', 'pengaduan.id_pengaduan')
        ->get()
        ->where('status', 'cancelled');

        return view('userAction.laporanGagal',[
            'pengaduan' => Pengaduan::get(),
            'tanggapan' => $tanggapan
        ]);
    }

    public function tambahLaporan(Request $request)
    {
        // $post = new Post();
        // $post->title = $request->title;
        // $post->excerpt = $request->excerpt;
        // $post->body = $request->body;
        // $post->image_path = 'temporary';
        // $post->is_published = $request->is_published === 'on';
        // $post->min_to_read = $request->min_to_read;
        // $post->save();
        $newImageName = $request->imageName . '_' . $request->jenis . '.' .
        $request->image->extension();

        $request->validate([
            'jenis' => 'required',
            'lokasi' => 'required',
            'judul' => 'required',
            'isi_laporan' => 'required',
            'image' => ['required', 'mimes:jpg,png,jpeg', 'max:5048'],
        ]);




        Pengaduan::create([
            'id' => $request->id,
            'jenis' => $request->jenis,
            'lokasi' => $request->lokasi,
            'judul' => $request->judul,
            'isi_laporan' => $request->isi_laporan,
            'foto' => $newImageName,
            'path' => $this->storeImage($request),
            'bln_pengaduan' => now()->month,
            'tgl_pengaduan' => Carbon::now()->toDateString(),
            'waktu_pengaduan' => Carbon::now()->toTimeString(),
            ]);

        return redirect(route('laporan.user'))->with('message', 'Laporan Berhasil di Buat!');

    }
    private function storeImage($request)
    {
        $newImageName = $request->imageName . '_' . $request->jenis . '.' .
        $request->image->extension();

        return $request->image->move(public_path('images'), $newImageName);

    }
    public function ajukan(Request $request, $id_pengaduan)
    {

        Pengaduan::where('id_pengaduan', $id_pengaduan)->update([
            'status' => $request->status
        ]);
        return redirect(route('laporan.admin'))->with('message', 'Laporan Berhasil di Ajukan!');
    }

    public function hapusValidasi(Request $request, $id_pengaduan)
    {
        $request->validate([
            'isi_laporan' => 'required',
        ]);
        $image_path = public_path().'/images/'.$request->foto;
        if(File::exists($image_path)) {
            File::delete($image_path);
        }

        Pengaduan::where('id_pengaduan', $id_pengaduan)->update([
            'status' => $request->status,
            'isi_laporan' => $request->isi_laporan
        ]);
        return redirect(route('laporan.admin'))->with('message', 'Laporan Berhasil di Hapus!');
    }

    public function tanggapan(Request $request, $id_pengaduan)
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
            'tanggapan' => 'required',
        ]);




        Tanggapan::create([
            'tanggapan' => $request->tanggapan,
            'id_pengaduan' => $request->id_pengaduan,
            'id_petugas' => $request->id_pengaduan,
            'selesai' => $this->selesai($request, $id_pengaduan),
        ]);
        return redirect(route('laporan.petugas'))->with('message', 'Tanggapan Berhasil di Buat!');

    }
    private function selesai($request, $id_pengaduan)
    {
        Pengaduan::where('id_pengaduan', $id_pengaduan)->update([
            'status' => $request->status
        ]);

    }
    public function hapusLaporan($id_pengaduan, $foto)
    {
            $image_path = public_path().'/images/'.$foto;
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            Pengaduan::where('id_pengaduan', $id_pengaduan)
                ->delete();


            return redirect(route('laporan.user'))->with('message', 'Laporan Berhasil di Hapus!');
    }
    public function update(Request $request, $id_pengaduan)
    {


        $request->validate([
            'lokasi' => 'required',
            'judul' => 'required',
            'isi_laporan' => 'required',
            'image' => ['mimes:jpg,png,jpeg', 'max:5048'],
        ]);
        if($request->file('image')){
            $newImageName = $request->imageName . '_' . $request->jenis . '.' .
        $request->image->extension();

        Pengaduan::where('id_pengaduan', $id_pengaduan)->update([
            'foto' => $newImageName

        ]);

            $image_path = public_path().'/images/'.$request->oldImage;

        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        $this->storeImage($request);
        }


        Pengaduan::where('id_pengaduan', $id_pengaduan)->update([
            'isi_laporan' => $request->isi_laporan,
            'judul' => $request->judul,
            'lokasi' => $request->lokasi,

        ]);
        return redirect(route('laporan.user'))->with('message', 'Laporan Berhasil di Update!');
    }
    public function exportPDF(Request $request)
    {
        $agama = $request->input('agama');
        $ekonomi = $request->input('ekonomi');
        $bencana = $request->input('bencana');
        $politik = $request->input('politik');
        $count = count($request->input());

        if($count == 3){
            $laporan = DB::table('users')
        ->join('pengaduan', 'users.id', '=', 'pengaduan.id')
        ->select('users.*', 'pengaduan.*')
        ->where('status', '!=', 'cancelled')
        ->whereBetween('tgl_pengaduan', [$request->from, $request->to])
        ->get();
        $pdf = Pdf::loadView('pdf.export-pdf',[
            'lapor' => $laporan,
            'from' => $request->from,
            'to' => $request->to
           ]);
        }else{
            $laporan = DB::table('users')
        ->join('pengaduan', 'users.id', '=', 'pengaduan.id')
        ->select('users.*', 'pengaduan.*')
        ->where('status', '!=', 'cancelled')
        ->whereBetween('tgl_pengaduan', [$request->from, $request->to])
        ->whereIn('pengaduan.jenis', [$agama, $politik, $ekonomi, $bencana])
        ->get();
        $pdf = Pdf::loadView('pdf.export-pdf',[
            'lapor' => $laporan,
            'from' => $request->from,
            'to' => $request->to
           ]);
        }

    return $pdf->download('laporan'.'('.Carbon::now()->toDateString().')'.Carbon::now()->toTimeString().'.pdf');
    }

    public function exportPDF2(Request $request)
    {
        $agama = $request->input('agama');
        $ekonomi = $request->input('ekonomi');
        $bencana = $request->input('bencana');
        $politik = $request->input('politik');
        $count = count($request->input());

        if($count == 3){
            $tanggapan = User::join('pengaduan', 'pengaduan.id', '=', 'users.id')
        ->join('tanggapan', 'tanggapan.id_pengaduan', '=', 'pengaduan.id_pengaduan')
        ->whereBetween('tgl_pengaduan', [$request->from, $request->to])
        ->get();
        $pdf = Pdf::loadView('pdf.export-pdf2',[
            'tanggapan' => $tanggapan,
            'from' => $request->from,
            'to' => $request->to
           ]);
        }else{
            $tanggapan = User::join('pengaduan', 'pengaduan.id', '=', 'users.id')
        ->join('tanggapan', 'tanggapan.id_pengaduan', '=', 'pengaduan.id_pengaduan')
        ->whereIn('pengaduan.jenis', [$agama, $politik, $ekonomi, $bencana])
        ->whereBetween('tgl_pengaduan', [$request->from, $request->to])
        ->get();
        $pdf = Pdf::loadView('pdf.export-pdf2',[
            'tanggapan' => $tanggapan,
            'from' => $request->from,
            'to' => $request->to
           ]);
        }

        return $pdf->download('laporan'.'('.Carbon::now()->toDateString().')'.Carbon::now()->toTimeString().'.pdf');
    }
}
