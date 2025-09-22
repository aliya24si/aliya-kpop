<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Input Data Pegawai</title>
</head>
<body>
    <h1>Input Data Pegawai</h1>
    <form action="{{ url('/pegawai') }}" method="POST">
        @csrf
        <p>
            Nama: <br>
            <input type="text" name="name" required>
        </p>
        <p>
            Tanggal Lahir: <br>
            <input type="date" name="dob" required>
        </p>
        <p>
            Cita-cita: <br>
            <input type="text" name="future_goal" required>
        </p>
        <p>
            Tanggal Harus Wisuda: <br>
            <input type="date" name="tgl_harus_wisuda" required>
        </p>
        <p>
            Semester Saat Ini: <br>
            <input type="number" name="current_semester" min="1" required>
        </p>
        <p>
            Pilih Hobi (boleh lebih dari satu): <br>
            <label><input type="checkbox" name="hobbies[]" value="Berenang"> Berenang</label><br>
            <label><input type="checkbox" name="hobbies[]" value="Futsal"> Futsal</label><br>
            <label><input type="checkbox" name="hobbies[]" value="Main Game"> Main Game</label><br>
            <label><input type="checkbox" name="hobbies[]" value="Nonton Film"> Nonton Film</label><br>
            <label><input type="checkbox" name="hobbies[]" value="Photography"> Photography</label>
        </p>
        <button type="submit">Kirim</button>
    </form>
</body>
</html>
