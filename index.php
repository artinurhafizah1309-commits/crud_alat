<?php
include_once("config.php");
$result = mysqli_query($mysqli, "SELECT * FROM alat ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sim Rs - Data Alat</title>
    <style>
        /* Pengaturan Dasar & Font */
        body { 
            font-family: 'Segoe UI', Arial, sans-serif; 
            margin: 30px;
            background-color: #faf8f2; 
            color: #333333;
        }

        h2 {
            margin-bottom: 5px;
            color: #2c2c2c;
        }

        .subtitle {
            font-style: italic;
            color: #777777;
            margin-bottom: 25px;
            display: block;
        }

        /* Container untuk Kontrol (Tombol Tambah & Kolom Cari) */
        .control-panel {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 90%;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        /* Tombol Tambah Alat (Kuning Doff) */
        .btn-tambah {
            display: inline-block;
            padding: 10px 20px;
            background-color: #e5b842; /* Kuning Doff / Matte */
            color: #ffffff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            box-shadow: 0 2px 4px rgba(0,0,0,0.08);
            transition: all 0.2s ease;
        }
        .btn-tambah:hover {
            background-color: #d4a731;
            box-shadow: 0 4px 6px rgba(0,0,0,0.12);
        }

        /* Kolom Pencarian */
        .search-container {
            position: relative;
        }
        .search-input {
            padding: 10px 15px;
            width: 25px;
            min-width: 250px;
            border: 2px solid #e2ded5;
            border-radius: 6px;
            outline: none;
            font-size: 14px;
            transition: border-color 0.2s;
            background-color: #ffffff;
        }
        .search-input:focus {
            border-color: #e5b842; /* Fokus warna kuning doff */
        }

        /* Desain Tabel Keren & Rapi */
        table { 
            width: 90%; 
            border-collapse: collapse; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
        }

        /* Header Tabel */
        th { 
            background-color: #ebd082; /* Kuning Matte Lembut */
            color: #4a3b10; 
            padding: 14px 18px;
            text-align: left;
            font-weight: 600;
            border-bottom: 3px solid #dcc06f;
        }

        /* Isi Tabel */
        td { 
            padding: 14px 18px; 
            text-align: left; 
            border-bottom: 1px solid #f0ede4; 
            font-size: 14px;
            color: #4f4f4f;
        }

        /* Efek Baris Zebra & Hover */
        tr:nth-child(even) {
            background-color: #fdfcf9; 
        }
        tr:hover {
            background-color: #f8f3e3; /* Highlight kuning doff tipis */
        }

        /* Desain Link Aksi */
        .action-link {
            text-decoration: none;
            color: #c49625;
            font-weight: 600;
            transition: color 0.2s;
        }
        .action-link:hover {
            color: #946f13;
            text-decoration: underline;
        }
        .delete-link {
            color: #d9454f;
            margin-left: 5px;
        }
        .delete-link:hover {
            color: #a82c35;
        }

        /* Pesan Jika Data Tidak Ditemukan */
        .no-data {
            display: none;
            text-align: center;
            padding: 20px;
            color: #888;
            font-style: italic;
        }
    </style>
</head>
<body>

    <h2>Data Alat Elektromedis</h2>
    <span class="subtitle">UAS Pemrograman Web ARTI NURHAFIZAH</span>
    
    <!-- Panel Kontrol: Tombol & Kolom Cari -->
    <div class="control-panel">
        <a href="add.php" class="btn-tambah">Tambah Alat</a>
        <div class="search-container">
            <input type="text" id="searchInput" class="search-input" onkeyup="searchTable()" placeholder="Cari nama alat, merek, atau lokasi...">
        </div>
    </div>

    <!-- Tabel Data -->
    <table>
        <thead>
            <tr>
                <th style="width: 7%">No</th>
                <th>Nama Alat</th>
                <th>Tahun</th>
                <th>Merek</th>
                <th>Lokasi</th>
                <th style="width: 15%">Aksi</th>
            </tr>
        </thead>
        <tbody id="deviceTableBody">
            <?php  
            $i = 1;
            while($user_data = mysqli_fetch_array($result)) {         
                echo "<tr>";
                echo "<td>".$i."</td>";
                echo "<td>".$user_data['nama_alat']."</td>";
                echo "<td>".$user_data['tahun']."</td>";
                echo "<td>".$user_data['merek']."</td>";
                echo "<td>".$user_data['lokasi']."</td>";    
                echo "<td>
                        <a href='edit.php?id=$user_data[id]' class='action-link'>Edit</a> | 
                        <a href='delete.php?id=$user_data[id]' class='action-link delete-link' onclick='return confirm(\"Yakin ingin menghapus?\")'>Delete</a>
                      </td>";
                echo "</tr>";        
                $i++;
            }
            ?>
        </tbody>
    </table>
    
    <!-- Notifikasi Jika Hasil Pencarian Kosong -->
    <div id="noDataMessage" class="no-data">Data alat tidak ditemukan.</div>

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
                // Mengecek apakah teks pencarian ada di dalam baris tersebut
                if (rowText.includes(filter)) {
                    tr[i].style.display = "";
                    hasData = true;
                } else {
                    tr[i].style.display = "none";
                }
            }

            // Tampilkan pesan jika data yang dicari tidak ada
            if (hasData) {
                noDataMessage.style.display = "none";
            } else {
                noDataMessage.style.display = "block";
            }
        }
    </script>
</body>
</html>