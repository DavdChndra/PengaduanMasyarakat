<?php
include "../Koneksi/koneksi.php";

// Submit Id Penduduk Pengaduan
if(isset($_POST['SubmitID'])){
    $id_penduduk = $_POST['id_penduduk'];
    header("location:../User/KumpulanPengaduanSaya.php?id_penduduk=$id_penduduk");
}

// InputPengaduan
if(isset($_POST['SubmitInput'])){
    $id_penduduk = $_POST['id_penduduk'];
    $nama = $_POST['nama'];
    $lokasi = $_POST['lokasi'];
    $tanggal = $_POST['tanggal'];
    $jenis_aspirasi = $_POST['jenis_aspirasi'];
    $deskripsi = $_POST['deskripsi'];

    $ekstensi_diperbolehkan	= array('png','jpg','jpeg');
			$foto = $_FILES['file']['name'];
			$x = explode('.', $foto);
			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['file']['size'];
			$file_tmp = $_FILES['file']['tmp_name'];	
 
			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
				if($ukuran < 1044070){			
					move_uploaded_file($file_tmp, "../image/".$foto);
					$query = mysqli_query($host, "INSERT INTO tb_input_aspirasi(id_penduduk, nama, tanggal, jenis_aspirasi, lokasi, nama_file, deskripsi) VALUES ('$id_penduduk', '$nama','$tanggal', '$jenis_aspirasi','$lokasi', '$foto', '$deskripsi')");
					if($query){
						header("Location:../index.php#pesan=berhasil");
					}else{
						header("Location:../index.php#pesan=gagal");
					}
				}else{
					header("Location:../index.php#pesan=FileBesar");
				}
			}else{
				header("Location:../index.php#pesan=ExstensTidakTersedia");
			}
}

// LoginAdmin
if(isset($_POST['login'])){
    
    $cek = mysqli_query($host, "SELECT * FROM tb_admin WHERE username = '".$_POST['username']."' AND
        password = '".$_POST['password']."'");
    $row = mysqli_fetch_array($cek);
    $count = mysqli_num_rows($cek); 

    if($count>0){
        session_start();
        $_SESSION['username'] = $row['username'];
        $_SESSION['password'] = $row['password'];

        header('location:../Admin/adminDashboard.php');
    }else{
        header('location:../index.php#pesan=GagalLogin');
    }
}

// HapusPengaduan (Admin)
if(isset($_POST["SubmitHapus"])){
    $no = $_POST['no'];
    $query = mysqli_query($host, "DELETE FROM tb_input_aspirasi WHERE id_pelaporan = '$no'");
    header("location:../Admin/adminDashboard.php");
}

// TanggapanPengaduan (Admin)
if(isset($_POST["SubmitTanggapan"])){
    $no = $_POST['no'];
    $tanggapan = $_POST['tanggapan'];
    $query = mysqli_query($host, "UPDATE tb_input_aspirasi SET tanggapan = '$tanggapan' where id_pelaporan='$no'");
    header("Location: ../Admin/adminDashboard.php");
}

// StatusPengaduan (Admin)
if(isset($_POST["SubmitStatus"])){
    $no = $_POST['no'];
    $status = $_POST['status'];
    
    $query = mysqli_query($host, "UPDATE tb_input_aspirasi SET status = '$status' where id_pelaporan='$no'");
    header("Location: ../Admin/adminDashboard.php");
}

if(isset($_POST['submitRating'])){
    $no = $_POST['no'];
    $rating = $_POST['rating'];

    $query = mysqli_query($host, "UPDATE tb_input_aspirasi SET rating = '$rating' WHERE id_pelaporan='$no'");
    header("Location: ../index.php");
}