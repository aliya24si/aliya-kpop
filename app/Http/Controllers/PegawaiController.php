<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        // Jika form sudah di-submit
        if ($request->isMethod('post')) {

            $name      = $request->input('name');
            $dob       = $request->input('dob');
            $goal      = $request->input('future_goal');
            $wisuda    = $request->input('tgl_harus_wisuda');
            $semester  = (int) $request->input('current_semester');
            $hobbies   = $request->input('hobbies', []); // array

            // Hitung umur
            $age = Carbon::parse($dob)->age;

            // Hitung jarak hari ke tgl wisuda
            $time_left = Carbon::now()->diffInDays(Carbon::parse($wisuda), false);

            // Pesan semester
            $info = ($semester < 3)
                ? "Masih Awal, Kejar TAK"
                : "Jangan main-main, kurang-kurangi main game!";

            $data = [
                'name'             => $name,
                'my_age'           => $age,
                'hobbies'          => $hobbies,
                'tgl_harus_wisuda' => $wisuda,
                'time_to_study_left' => $time_left,
                'current_semester' => $semester,
                'semester_info'    => $info,
                'future_goal'      => $goal
            ];

            return view('pegawai-result', $data);
        }

        // Jika belum submit, tampilkan form
        return view('pegawai-form');
    }
}
