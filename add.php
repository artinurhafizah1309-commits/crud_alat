<?php
// Cek apakah form sudah disubmit, lalu masukkan data ke database.
if(isset($_POST['Submit'])) {
    $nama_alat = $_POST['nama_alat'];
    $tahun = $_POST['tahun'];
    $merek = $_POST['merek'];
    $lokasi = $_POST['lokasi'];
    
    // Include file koneksi database
    include_once("config.php");
        
    // Insert data ke tabel alat
    $result = mysqli_query($mysqli, "INSERT INTO alat(nama_alat,tahun,merek,lokasi) VALUES('$nama_alat','$tahun','$merek','$lokasi')");
    
    // Tampilkan pesan sukses dan redirect
    echo "<script>alert('Data alat berhasil ditambahkan!'); window.location.href='index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sim Rs - Tambah Data Alat</title>
    <!-- Font Awesome untuk Ikon Medis -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            margin: 0;
            padding: 40px 20px;
            background-color: #f5f7fa; 
            color: #333333;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: #7f8c8d;
            font-size: 14px;
            margin-bottom: 20px;
            font-weight: 600;
            transition: color 0.2s;
        }
        .btn-back:hover {
            color: #e5b842;
        }
        .header-title {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 25px;
            border-bottom: 2px solid #f1f2f6;
            padding-bottom: 15px;
        }
        .header-title i {
            color: #e5b842;
            font-size: 24px;
        }
        .header-title h2 {
            margin: 0;
            color: #2c3e50;
            font-size: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 14px;
            color: #4b5563;
        }
        .input-wrapper {
            position: relative;
        }
        .input-wrapper i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }
        .form-control {
            width: 100%;
            padding: 12px 15px 12px 42px;
            box-sizing: border-box;
            border: 1.5px solid #dcdde1;
            border-radius: 6px;
            outline: none;
            font-size: 14px;
            transition: all 0.2s;
        }
        .form-control:focus {
            border-color: #e5b842;
            box-shadow: 0 0 0 3px rgba(229, 184, 66, 0.15);
        }
        .btn-submit {
            width: 100%;
            padding: 12px;
            background-color: #e5b842;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 2px 5px rgba(229, 184, 66, 0.3);
            transition: all 0.2s;
            margin-top: 10px;
        }
        .btn-submit:hover {
            background-color: #d4a731;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Tombol Kembali -->
        <a href="index.php" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
        </a>

        <!-- Judul Form -->
        <div class="header-title">
            <i class="fa-solid fa-square-plus"></i>
            <h2>Tambah Alat Elektomedis</h2>
        </div>

        <!-- Form Tambah -->
        <form action="add.php" method="post" name="form1">
            <div class="form-group">
                <label for="nama_alat">Nama Alat</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-stethoscope"></i>
                    <input type="text" name="nama_alat" id="nama_alat" class="form-control" placeholder="Contoh: Nebulizer" required>
                </div>
            </div>

            <div class="form-group">
                <label for="tahun">Tahun Pengadaan</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-calendar-days"></i>
                    <input type="number" name="tahun" id="tahun" class="form-control" placeholder="Contoh: 2026" required>
                </div>
            </div>

            <div class="form-group">
                <label for="merek">Merek Alat</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-copyright"></i>
                    <input type="text" name="merek" id="merek" class="form-control" placeholder="Contoh: Omron" required>
                </div>
            </div>

            <div class="form-group">
                <label for="lokasi">Lokasi Ruangan</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-hospital-user"></i>
                    <input type="text" name="lokasi" id="lokasi" class="form-control" placeholder="Contoh: IGD / ICU" required>
                </div>
            </div>

            <button type="submit" name="Submit" class="btn-submit">
                <i class="fa-solid fa-circle-check"></i> Simpan Alat
            </button>
        </form>
    </div>

</body>
</html>