<?php
include_once("config.php");
$result = mysqli_query($mysqli, "SELECT * FROM alat ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sim Rs - Data Alat Elektromedis</title>
    <!-- Memanggil Font Awesome untuk ikon nuansa Alkes/Medis -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Pengaturan Dasar Premium & Steril */
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            margin: 0;
            padding: 30px;
            background-color: #f5f7fa; /* Abu-abu terang khas aplikasi rumah sakit */
            color: #333333;
        }

        /* Container Utama */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        /* Header Nuansa Medis */
        .header-title {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 5px;
        }
        .header-title i {
            color: #e5b842; /* Ikon warna kuning doff */
            font-size: 28px;
        }
        .header-title h2 {
            margin: 0;
            color: #2c3e50;
            font-weight: 700;
            letter-spacing: -0.5px;
        }
        .subtitle {
            font-style: normal;
            color: #7f8c8d;
            font-size: 14px;
            margin-left: 43px;
            display: block;
            margin-bottom: 30px;
        }

        /* Panel Kontrol (Tombol & Kolom Cari) */
        .control-panel {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }

        /* Tombol Tambah Alat (Kuning Doff Medis) */
        .btn-tambah {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background-color: #e5b842; 
            color: #ffffff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 14px;
            box-shadow: 0 2px 5px rgba(229, 184, 66, 0.3);
            transition: all 0.2s ease;
        }
        .btn-tambah:hover {
            background-color: #d4a731;
            transform: translateY(-1px);
        }

        /* Kolom Pencarian dengan Ikon */
        .search-container {
            position: relative;
        }
        .search-container i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #95a5a6;
        }
        .search-input {
            padding: 11px 15px 11px 40px;
            width: 280px;
            border: 1.5px solid #dcdde1;
            border-radius: 6px;
            outline: none;
            font-size: 14px;
            transition: all 0.2s;
            background-color: #ffffff;
        }
        .search-input:focus {
            border-color: #e5b842;
            box-shadow: 0 0 0 3px rgba(229, 184, 66, 0.15);
        }

        /* Tabel Modern & Profesional */
        .table-responsive {
            overflow-x: auto;
            border-radius: 8px;
            border: 1px solid #e8ebd7;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            background-color: #ffffff;
        }

        /* Header Tabel */
        th { 
            background-color: #ebd082; /* Kuning Doff Lembut */
            color: #4a3b10; 
            padding: 16px 20px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Isi Tabel */
        td { 
            padding: 16px 20px; 
            text-align: left; 
            border-bottom: 1px solid #f1f2f6; 
            font-size: 14px;
            color: #4a4a4a;
        }

        /* Efek Baris */
        tr:nth-child(even) {
            background-color: #fafbfc; 
        }
        tr:hover {
            background-color: #fffbe6; /* Sorotan kuning sangat tipis saat hover */
        }

        /* Tag Badge untuk Lokasi/Ruangan */
        .badge-lokasi {
            background-color: #f1f2f6;
            color: #57606f;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
        }

        /* Desain Tombol Aksi */
        .action-buttons {
            display: flex;
            gap: 12px;
        }
        .btn-action {
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: color 0.2s;
        }
        .btn-edit {
            color: #c49625;
        }
        .btn-edit:hover {
            color: #946f13;
        }
        .btn-delete {
            color: #e74c3c;
        }
        .btn-delete:hover {
            color: #c0392b;
        }

        /* Notifikasi Kosong */
        .no-data {
            display: none;
            text-align: center;
            padding: 30px;
            color: #95a5a6;
            font-style: italic;
            border-top: 1px solid #f1f2f6;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Header Aplikasi -->
        <div class="header-title">
            <i class="fa-solid fa-heart-pulse"></i> <!-- Ikon Detak Jantung / Alkes -->
            <h2>Data Alat Elektromedis</h2>
        </div>
        <span class="subtitle"><i class="fa-solid fa-graduation-cap"></i> UAS Pemrograman Web ARTI NURHAFIZAH</span>
        
        <!-- Panel Kontrol -->
        <div class="control-panel">
            <a href="add.php" class="btn-tambah">
                <i class="fa-solid fa-plus"></i> Tambah Alat
            </a>
            <div class="search-container">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="searchInput" class="search-input" onkeyup="searchTable()" placeholder="Cari nama alat, merek, atau lokasi...">
            </div>
        </div>

        <!-- Tabel Data Responsive -->
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th style="width: 7%">No</th>
                        <th><i class="fa-solid fa-stethoscope"></i> Nama Alat</th>
                        <th><i class="fa-solid fa-calendar-days"></i> Tahun</th>
                        <th><i class="fa-solid fa-copyright"></i> Merek</th>
                        <th><i class="fa-solid fa-hospital-user"></i> Lokasi</th>
                        <th style="width: 15%">Aksi</th>
                    </tr>
                </thead>
                <tbody id="deviceTableBody">
                    <?php  
                    $i = 1;
                    while($user_data = mysqli_fetch_array($result)) {         
                        echo "<tr>";
                        echo "<td><strong>".$i."</strong></td>";
                        echo "<td><strong>".$user_data['nama_alat']."</strong></td>";
                        echo "<td>".$user_data['tahun']."</td>";
                        echo "<td>".$user_data['merek']."</td>";
                        echo "<td><span class='badge-lokasi'>".$user_data['lokasi']."</span></td>";    
                        echo "<td>
                                <div class='action-buttons'>
                                    <a href='edit.php?id=$user_data[id]' class='btn-action btn-edit'><i class='fa-regular fa-pen-to-square'></i> Edit</a>
                                    <a href='delete.php?id=$user_data[id]' class='btn-action btn-delete' onclick='return confirm(\"Yakin ingin menghapus data alat ini?\")'><i class='fa-regular fa-trash-can'></i> Delete</a>
                                </div>
                              </td>";
                        echo "</tr>";        
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
            
            <!-- Notifikasi Jika Hasil Pencarian Kosong -->
            <div id="noDataMessage" class="no-data">
                <i class="fa-solid fa-triangle-exclamation"></i> Data alat elektromedis tidak ditemukan.
            </div>
        </div>
    </div>

    <!-- Script JavaScript untuk Fitur Pencarian Real-time -->
    <script>
        function searchTable() {
            let input = document.getElementById("searchInput");
            let filter = input.value.toLowerCase();
            let tbody = document.getElementById("deviceTableBody");
            let tr = tbody.getElementsByTagName("tr");
            let noDataMessage = document.getElementById("noDataMessage");
            let hasData = false;

            for (let i = 0; i < tr.length; i++) {
                let rowText = tr[i].textContent.toLowerCase();
                if (rowText.includes(filter)) {
                    tr[i].style.display = "";
                    hasData = true;
                } else {
                    tr[i].style.display = "none";
                }
            }

            if (hasData) {
                noDataMessage.style.display = "none";
            } else {
                noDataMessage.style.display = "block";
            }
        }
    </script>
</body>
</html>