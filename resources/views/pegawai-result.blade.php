<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Data Pegawai</title>
</head>
<body>
    <h1>Data Pegawai</h1>
    <p><strong>Nama:</strong> {{ $name }}</p>
    <p><strong>Umur:</strong> {{ $my_age }} tahun</p>
    <p><strong>Hobi:</strong>
        @foreach($hobbies as $h)
            {{ $h }}@if(!$loop->last), @endif
        @endforeach
    </p>
    <p><strong>Tanggal Harus Wisuda:</strong> {{ $tgl_harus_wisuda }}</p>
    <p><strong>Jarak Hari ke Wisuda:</strong> {{ $time_to_study_left }} hari</p>
    <p><strong>Semester Saat Ini:</strong> {{ $current_semester }}</p>
    <p><strong>Info Semester:</strong> {{ $semester_info }}</p>
    <p><strong>Cita-cita:</strong> {{ $future_goal }}</p>

    <p><a href="{{ url('/pegawai') }}">← Kembali ke Form</a></p>
</body>
</html>
