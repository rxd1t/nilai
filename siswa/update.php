<?php
if (isset($_POST['update'])) {
    include_once('config.php');
    $id = $_POST['id'];
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $gender = $_POST['gender'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $kelas_id = $_POST['kelas_id'];
    $foto = $_POST['foto'];


    $acak = rand();
    $namafile = $_Files['foto'] ['name'];
    $ukuran = $_FILES['foto'] ['size'];
    $akhiran = pathinfo($namafile, PATHINFO_EXTENSION);
    $ekstensi = array('png', 'jpg', 'jpeg', 'gif', 'svg');

    if (!file_exist($_FILES['foto']['tmp_name']) OR !is_uploaded_file($_FILES
    ['foto'] ['tmp_name'])) {
        $sql = "UPDATE kelas SET nis='$nis', nama='$nama', gender='$gender', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', 
    kelas_id='$kelas_id' WHERE id='$id'";
    } else {
        if (!in_array($akhiran, $ekstensi)) {
            header("location: index.php?m=siswa");
            echo '<script languange="JavaScript">';
            echo 'alert'("Tipe file anda, tidak diizinkan.");
            echo '</script>';
    } else {
        if ($ukuran < 1000000) {
            $nmfile = $acak . '_' . $namafile;
            $sql = "UPDATE kelas SET nis='$nis', nama='$nama', gender='$terisi', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', 
    kelas_id='$kelas_id', foto='$namafile' WHERE id='$id'";
            move_uploaded_file($_FILES['foto']['tmp_name'], 'siswa/foto/'.
            $nmfile);
            
        } else {
            include("index.php?m=siswa");
            echo '<script languange="JavaScript">';
            echo 'alert'("Ukuran file anda terlalu besar.");
            echo '</script>';
        }
    }
    }

    $result = mysqli_query($con, $sql);
    if ($result) {
        header('location: index.php?m=siswa&s=view');
    } else {
        include "index.php?m=siswa&s=view";
        echo '<script language="JavaScript">';
            echo 'alert("Data Gagal Ditambahkan.")';
        echo '</script>';
    }
}