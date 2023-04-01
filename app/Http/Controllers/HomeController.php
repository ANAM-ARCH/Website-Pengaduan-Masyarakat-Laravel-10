<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function laporanAdmin()
    {
        $laporan = DB::table('users')
        ->join('pengaduan', 'users.id', '=', 'pengaduan.id')
        ->select('users.*', 'pengaduan.*')
        ->get();
        $tanggapan = User::join('pengaduan', 'pengaduan.id', '=', 'users.id')
        ->join('tanggapan', 'tanggapan.id_pengaduan', '=', 'pengaduan.id_pengaduan')
        ->get();
       return view('adminAction.laporan',[
        'lapor' => $laporan,
        'tanggapan' => $tanggapan
       ]


    );


    }
    public function laporanAdminValidasi()
    {
        $laporan = DB::table('users')
        ->join('pengaduan', 'users.id', '=', 'pengaduan.id')
        ->select('users.*', 'pengaduan.*')
        ->get();
       return view('adminAction.laporanValidasi',[
        'lapor' => $laporan
       ]


    );


    }
    public function laporanAdminSelesai()
    {
        $laporan = DB::table('users')
        ->join('pengaduan', 'users.id', '=', 'pengaduan.id')
        ->select('users.*', 'pengaduan.*')
        ->get();
        $tanggapan = User::join('pengaduan', 'pengaduan.id', '=', 'users.id')
        ->join('tanggapan', 'tanggapan.id_pengaduan', '=', 'pengaduan.id_pengaduan')
        ->get();
       return view('adminAction.laporanSelesai',[
        'lapor' => $laporan,
        'tanggapan' => $tanggapan
       ]


    );


    }
    public function laporanPetugas()
    {
        $laporan = DB::table('users')
        ->join('pengaduan', 'users.id', '=', 'pengaduan.id')
        ->select('users.*', 'pengaduan.*')
        ->get();
       return view('petugasAction.laporan',[
        'lapor' => $laporan
       ]
    );

    }
    public function laporanPetugasSelesai()
    {
        $laporan = DB::table('users')
        ->join('pengaduan', 'users.id', '=', 'pengaduan.id')
        ->select('users.*', 'pengaduan.*')
        ->get();
        $tanggapan = User::join('pengaduan', 'pengaduan.id', '=', 'users.id')
        ->join('tanggapan', 'tanggapan.id_pengaduan', '=', 'pengaduan.id_pengaduan')
        ->get();
       return view('petugasAction.tanggapan',[
        'lapor' => $laporan,
        'tanggapan' => $tanggapan
       ]


    );
}

    public function adminRegister()
    {
       return view('adminAction.adminRegister',[
        'users' => User::get()
       ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
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
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        return view('adminHome', [
            'users' => User::get()->where('type', '=', 'user'),
            'pengaduan' => Pengaduan::get(),
            'tanggapan' => Tanggapan::get()
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function petugasHome()
    {
        return view('petugasHome', [
            'users' => User::get()->where('type', '=', 'user'),
            'pengaduan' => Pengaduan::get(),
            'tanggapan' => Tanggapan::get()
        ]);
    }

    public function detail($id_pengaduan)
    {
        $laporan = DB::table('users')
        ->join('pengaduan', 'users.id', '=', 'pengaduan.id')
        ->select('users.*', 'pengaduan.*')
        ->get();
       return view('adminAction.laporanDetail',[
        'pengaduan' => $laporan->where('id_pengaduan', $id_pengaduan)
       ]
    );

    }
    public function laporanDetailPetugas($id_pengaduan)
    {
        $laporan = DB::table('users')
        ->join('pengaduan', 'users.id', '=', 'pengaduan.id')
        ->select('users.*', 'pengaduan.*')
        ->get();
       return view('petugasAction.laporanDetail',[
        'pengaduan' => $laporan->where('id_pengaduan', $id_pengaduan)
       ]
    );

    }
    public function laporanUser()
    {
        $laporan = DB::table('users', 'users.id', '=', 'pengaduan.id')
              ->join('pengaduan', 'pengaduan.id_pengaduan', '=', 'tanggapan.id_pengaduan')
              ->get();
    }


}
