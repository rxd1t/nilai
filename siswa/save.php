<?php
if (isset($_POST['simpan'])) {
    include_once('config.php');
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $gender = $_POST['gender'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $kelas_id = $_POST['kelas_id'];

    $acak = rand();
    $namafile = $_Files['foto'] ['name'];
    $ukuran = $_FILES['foto'] ['size'];
    $akhiran = pathinfo($namafile, PATHINFO_EXTENSION);
    $ekstensi = array('png', 'jpg', 'jpeg', 'gif', 'svg');

    if (!file_exist($_FILES['foto']['tmp_name']) OR !is_uploaded_file($_FILES
    ['foto'] ['tmp_name'])) {
        $sql = "INSERT INTO kelas SET nis='$nis', nama='$nama', gender='$terisi', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', 
    kelas_id='$kelas_id'";
    } else {
        if (!in_array($akhiran, $ekstensi)) {
            header("location: index.php?m=siswa");
            echo '<script languange="JavaScript">';
            echo 'alert'("Akhiran file anda, tidak diizinkan.");
            echo '</script>';
    } else {
        if ($ukuran < 1000000) {
            $nmfile = $acak . '_' . $namafile;
            $sql = "INSERT INTO kelas SET nis='$nis', nama='$nama', gender='$terisi', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', 
    kelas_id='$kelas_id', foto='$namafile'";
            move_uploaded_file($_FILES['foto']['tmp_name'], 'siswa/foto/'.
            $nmfile);
            
        } else {
            header("location: index.php?m=siswa");
            echo '<script languange="JavaScript">';
            echo 'alert'("Ukuran file anda terlalu besar.");
            echo '</script>';
        }
    }
    }

    $sql = "INSERT INTO siswa SET nis='$nis', nama='$nama', gender='$terisi', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', 
    kelas_id='$kelas_id'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        header('location: index.php?m=siswa&s=view');
    } else {
        include "index.php";
        echo '<script language="JavaScript">';
            echo 'alert("Data Gagal Ditambahkan.")';
        echo '</script>';
    }
}