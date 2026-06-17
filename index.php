<?php
include_once("config.php");
$result = mysqli_query($mysqli, "SELECT * FROM alat ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sim Rs - Data Alat</title>
    <style>
        .header { background-color: orange; color: white; }
        table { width: 80%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <b>Data Alat Elektromedis</b><br><br>
    <a href="add.php">Tambah Alat</a><br><br>

    <table>
        <tr class="header">
            <th>No</th>
            <th>Nama Alat</th>
            <th>Tahun</th>
            <th>Merek</th>
            <th>Lokasi</th>
            <th>Aksi</th>
        </tr>
        <?php  
        $i = 1;
        while($user_data = mysqli_fetch_array($result)) {         
            echo "<tr>";
            echo "<td>".$i."</td>";
            echo "<td>".$user_data['nama_alat']."</td>";
            echo "<td>".$user_data['tahun']."</td>";
            echo "<td>".$user_data['merek']."</td>";
            echo "<td>".$user_data['lokasi']."</td>";    
            echo "<td><a href='edit.php?id=$user_data[id]'>Edit</a> | <a href='delete.php?id=$user_data[id]' onclick='return confirm(\"Yakin ingin menghapus?\")'>Delete</a></td></tr>";        
            $i++;
        }
        ?>
    </table>
</body>
</html>