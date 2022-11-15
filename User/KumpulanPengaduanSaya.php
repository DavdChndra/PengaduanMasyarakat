<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- css -->
    <link rel="stylesheet" href="style.css">
    <title>Pengaduan Masyarakat</title>
    <style>
    .cari {
        margin-left: 10px;
        width: 100px;

    }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-body shadow sticky-top py-3 px-2">
        <div class="container-fluid">
            <a class="navbar-brand" href="http://localhost/OnlineShop/index.php/user">Pengaduan Saya</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Pengaduan Masyarakat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link fw-bold text-black" aria-current="page"
                                href="../User/KumpulanPengaduan.php">
                                <div class="d-flex justify-content-start">
                                    <img src="https://cdn-icons-png.flaticon.com/512/1972/1972461.png" width="15px"
                                        height="15px" class="my-1 me-2">
                                    Kumpulan Pengaduan Masyarakat
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold text-black" aria-current="page" data-bs-toggle="modal"
                                data-bs-target="#exampleModal" style="cursor: pointer;">
                                <div class="d-flex justify-content-start">
                                    <img src="https://cdn-icons-png.flaticon.com/512/1972/1972461.png" width="15px"
                                        height="15px" class="my-1 me-2">
                                    Form Pengaduan
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold text-danger" href="../index.php">
                                <div class="d-flex justify-content-start">
                                    <img src="https://cdn-icons-png.flaticon.com/512/4400/4400828.png" width="15px"
                                        height="15px" class="my-1 me-2">
                                    Back
                                </div>
                            </a>
                        </li>
                    </ul>
                    <form class="d-flex" method="post" action="">
                        <?php 
                        $id_penduduk = $_GET['id_penduduk'];
                        ?>
                        <input type="hidden" name="id_penduduk" value="<?= $id_penduduk ?>">
                        <input class="form-control " type="search" placeholder="search" aria-label="Search" name="cari">
                        <button class="cari btn btn-outline-success" type="submit" name="search">Cari</button>
                        <button class="cari btn btn-outline-success" type="submit" name="clear">Clear</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="mt-5">
            <!-- CARD PENGADUAN -->
            <?php
            $host = mysqli_connect('localhost', 'root', '', 'db_pengaduan');
            if (isset($_POST['search'])){
                $cari = $_POST['cari'];
                $id_penduduk_search = $_GET ['id_penduduk'];
                $query_result = mysqli_query($host, "SELECT* from tb_input_aspirasi where  id_penduduk=$id_penduduk_search AND (jenis_aspirasi like '%$cari%' or rating like '%$cari%' or lokasi like '%$cari%' or tanggal like '%$cari%') ORDER BY id_pelaporan DESC");		
                }elseif (isset($_POST['clear'])){
                    $id_penduduk = $_GET ['id_penduduk'];
                    $query_result = mysqli_query($host,"SELECT * from tb_input_aspirasi where id_penduduk=$id_penduduk ORDER BY id_pelaporan DESC");		
                }else{
                    $id_penduduk = $_GET ['id_penduduk'];
                    $query_result = mysqli_query($host,"SELECT * from tb_input_aspirasi where id_penduduk=$id_penduduk ORDER BY id_pelaporan DESC");
                }
            while($data = mysqli_fetch_assoc($query_result)){
            ?>

            <div class="card text-center mb-4">
                <div class="card-header">
                    Jenis
                    <div class="fw-bold text-uppercase">
                        <?php echo $data['jenis_aspirasi']?>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <div class="gambar mx-5 my-2">
                            <img src="../image/<?php echo $data['nama_file'] ?>" class="card-img-top"
                                style="width: 200px; height: 200px;">
                        </div>
                        <div class="des mx-5 my-5 text-start">
                            <h5 class="card-title"><?php echo $data['nama']?></h5>
                            <p class="card-text">
                                <b>Deskripsi : </b><?php echo $data['deskripsi'] ?>
                                <br>
                                <b>Lokasi : </b><?php echo $data['lokasi'] ?>
                            </p>
                            <!-- Detail -->
                            <div class="detail">
                                <a class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#detail<?php echo $data['id_pelaporan']?>">
                                    Detail
                                </a>
                            </div>
                        </div>
                        <div class="TanggapanAdmin mx-5 my-5 text-start bg-light shadow p-3 rounded w-25">
                            <h5 class="card-title">Tanggapan Admin</h5>
                            <p class="card-text">
                                <?php if($data["tanggapan"] == null){?>
                                <b class="text-danger">Belum ada tanggapan</b>
                                <?php }else{ ?>
                                <b><?php echo $data['tanggapan'] ?></b>
                                <?php } ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <div class="d-flex justify-content-between">
                        <div class="status my-1">
                            <!-- Status Bar -->
                            <?php 
                                    if($data['status'] == "DI BACA"){ ?>
                            <label class="py-2 px-3 rounded bg-primary text-white fw-semibold">
                                Status : <?= $data['status'];?>
                            </label>
                            <?php } elseif($data['status'] == "ON PROCESS") { ?>
                            <label class="py-2 px-3 rounded bg-warning fw-semibold text-black">
                                Status : <?= $data['status'];?>
                            </label>
                            <?php } elseif($data['status'] == "SELESAI") { ?>
                            <label class="py-2 px-3 rounded bg-success text-white fw-semibold">
                                Status : <?= $data['status'];?>
                            </label>
                            <?php } ?>
                        </div>

                        <div class="rating my-1">
                            <!-- Rating -->
                            <?php
                                if($data['status'] == "SELESAI"){ 
                                // Jika User Belum Memberikan Rating
                                if($data['rating'] == null) {?>
                            <form action="../Aksi/Aksi.php" method="post" class="my-1">
                                <input type="hidden" name="no" value="<?php echo $data['id_pelaporan'] ?>">
                                <input type="radio" class="btn-check" name="rating" id="rating1" autocomplete="off"
                                    value="1">
                                <label class="btn btn-outline-secondary" for="rating1"
                                    style="font-size: 10px;">BURUK</label>

                                <input type="radio" class="btn-check" name="rating" id="rating2" autocomplete="off"
                                    value="2">
                                <label class="btn btn-outline-secondary" for="rating2"
                                    style="font-size: 10px;">KURANG</label>

                                <input type="radio" class="btn-check" name="rating" id="rating3" autocomplete="off"
                                    value="3">
                                <label class="btn btn-outline-secondary" for="rating3"
                                    style="font-size: 10px;">CUKUP</label>

                                <input type="radio" class="btn-check" name="rating" id="rating4" autocomplete="off"
                                    value="4">
                                <label class="btn btn-outline-secondary" for="rating4"
                                    style="font-size: 10px;">BAIK</label>

                                <input type="radio" class="btn-check" name="rating" id="rating5" autocomplete="off"
                                    value="5">
                                <label class="btn btn-outline-secondary me-3" for="rating5"
                                    style="font-size: 10px;">SANGAT
                                    BAIK</label>

                                <input type="submit" class="btn-check" name="submitRating" id="submit">
                                <label class="btn btn-outline-primary" for="submit"
                                    style="font-size: 10px;">SUBMIT</label>
                            </form>
                            <!-- Jika User Sudah Memberikan Rating -->
                            <?php } else { ?>
                            <label class="py-2 px-3 rounded bg-warning text-dark fw-semibold">
                                Penilaian pengadu : <?php echo $data['rating'] ?>
                            </label>
                            <?php } ?>
                            <?php } ?>
                        </div>
                        <div class="tanggal my-1">
                            <label class="py-2 px-3 rounded bg-secondary text-white fw-semibold">
                                Tanggal : <?php echo $data['tanggal']?>
                            </label>
                        </div>
                    </div>
                </div>
            </div>


            <!-- MODAL DETAIL PENGADUAN -->
            <div class="modal fade" id="detail<?php echo $data['id_pelaporan']?>" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12">
                                <label for="Nama" class="form-label fw-bold">Nama</label>
                                <h5><?php echo $data['nama']?></h5>
                            </div>
                            <div class="col-12">
                                <label for="id_penduduk" class="form-label fw-bold">ID Penduduk</label>
                                <h5><?php echo $data['id_penduduk']?></h5>
                            </div>
                            <div class="col-12">
                                <label for="tanggal" class="form-label fw-bold">Tanggal</label>
                                <h5><?php echo $data['tanggal']?></h5>
                            </div>
                            <div class="col-12">
                                <label for="lokasi" class="form-label fw-bold">Lokasi</label>
                                <h5><?php echo $data['lokasi']?></h5>
                            </div>
                            <div class="col-12">
                                <label for="JenisAspirasi" class="form-label fw-bold">Jenis Aspirasi</label>
                                <h5><?php echo $data['jenis_aspirasi']?></h5>
                            </div>
                            <div class="col-12">
                                <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                                <h5><?php echo $data['deskripsi']?></h5>
                            </div>
                            <div class="col-12">
                                <label for="gambar" class="form-label fw-bold">Gambar Bukti</label>
                                <br>
                                <img src="../image/<?php echo $data['nama_file'] ?>"
                                    style="width:200px; display:block; margin:auto;">
                            </div>
                            <hr class="w-auto mx-auto">
                            <div class="col-12">
                                <label for="tanggapan" class="form-label fw-bold">Tanggapan</label>
                                <h5><?php echo $data['tanggapan']?></h5>
                            </div>
                            <div class="col-12">
                                <label for="status" class="form-label fw-bold">Status</label>
                                <h5><?php echo $data['status']?></h5>
                            </div>
                        </div>
                        <div class=" modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>

            <!-- MODAL FORM PENGADUAN-->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Form Pengaduan</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="pengaduan">
                                <form action="../Aksi/Aksi.php" method="post" enctype="multipart/form-data"
                                    class="row g-3">
                                    <div class="col-md-6">
                                        <label for="inputIDPenduduk4" class="form-label fw-bold">ID Penduduk</label>
                                        <input type="text" name="id_penduduk" class="form-control" id="inputIDPenduduk4"
                                            placeholder="Masukkan ID Penduduk" required value="<?= $id_penduduk ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputnama4" class="form-label fw-bold">Nama</label>
                                        <input type="text" class="form-control" id="inputnama4"
                                            placeholder="Masukkan Nama Lengkap" name="nama" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputalamat2" class="form-label fw-bold">Alamat</label>
                                        <input type="text" class="form-control" id="inputalamat2"
                                            placeholder="Masukkan Alamat Lengkap" name="lokasi" required>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="Tanggal" class="form-label fw-bold">Tanggal Pengaduan</label>
                                        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="inputjenis" class="form-label fw-bold">Jenis Aspirasi</label>
                                        <select id="inputjenis" class="form-select" name="jenis_aspirasi" required>
                                            <option selected disabled>Choose...</option>
                                            <option value="Kebersihan">Kebersihan</option>
                                            <option value="Kenyamanan">Kenyamanan</option>
                                            <option value="Keramahan">Keramahan</option>
                                            <option value="Fasilitas">Fasilitas</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputpengaduan" class="form-label fw-bold">Deskripsikan
                                            Aspirasi</label>
                                        <textarea name="deskripsi" id="textareadeskripsi" class="form-control" rows="3"
                                            placeholder="Deskripsi aspirasi anda" required></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label for="gambar" class="form-label fw-bold">Upload Gambar</label>
                                        <input type="file" class="form-control" id="file" name="file" required>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="submit btn btn-primary mt-3"
                                            name="SubmitInput">SUBMIT</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
</body>

</html>