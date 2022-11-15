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
    .penampil {
        margin-top: 10px;
        margin-bottom: 30px;
    }

    .card img {
        width: 200px;
        display: block;
        margin: auto;
        padding: 20px;
    }

    .jenis {
        position: absolute;
        background-color: #fec260;
        padding: 5px 10px;
        border-top-left-radius: 3px;
        border-bottom-right-radius: 3px;
    }

    .search {
        width: 50%;
        display: block;
        margin: auto;
        margin-bottom: 30px;
    }

    .cari {
        margin-left: 10px;
        width: 100px;

    }

    .status {
        padding: 5px 10px;
        border-radius: 5px;
    }
    </style>
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-body shadow sticky-top py-3 px-2">
        <div class="container-fluid">
            <a class="navbar-brand" href="http://localhost/OnlineShop/index.php/user">Admin</a>
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
                $query_result = mysqli_query($host, "SELECT* from tb_input_aspirasi where nama like '%$cari%' OR jenis_aspirasi like '%$cari%' OR id_penduduk ='$cari' ORDER BY id_pelaporan DESC");		
                }elseif (isset($_POST['clear'])){
                    $query_result = mysqli_query($host,"SELECT * from tb_input_aspirasi ORDER BY id_pelaporan DESC");		
                }else{
                    $query_result = mysqli_query($host,"SELECT * from tb_input_aspirasi ORDER BY id_pelaporan DESC");
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
                        <div class="status">
                            <!-- Status Bar -->
                            <?php 
                                    if($data['status'] == "DI BACA"){ ?>
                            <label class="py-2 px-3 rounded bg-primary text-white fw-semibold">
                                Status : <?= $data['status'];?>
                            </label>
                            <?php } elseif($data['status'] == "ON PROCESS") { ?>
                            <label class="py-2 px-3 rounded bg-warning fw-semibold">
                                Status : <?= $data['status'];?>
                            </label>
                            <?php } elseif($data['status'] == "SELESAI") { ?>
                            <label class="py-2 px-3 rounded bg-success text-white fw-semibold">
                                Status : <?= $data['status'];?>
                            </label>
                            <?php } ?>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="tanggapan my-1">
                                <!-- Tanggapan BTN -->
                                <?php 
                                if($data['tanggapan'] == null){ ?>
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#Tanggapan<?php echo $data['id_pelaporan']?>">
                                    Tanggapan
                                </button>
                                <?php } else { ?>
                                <button class="btn btn-primary " data-bs-toggle="modal"
                                    data-bs-target="#Tanggapan<?php echo $data['id_pelaporan']?>" disabled>
                                    Tanggapan
                                </button>
                                <?php } ?>
                            </div>
                            <div class="status">
                                <!-- Status BTN -->
                                <?php if($data['status'] == "SELESAI"){ ?>
                                <button class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#status<?php echo $data['id_pelaporan']?>" disabled> Status</button>
                                <?php } else { ?>
                                <button class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#status<?php echo $data['id_pelaporan']?>"> Status</button>
                                <?php } ?>
                            </div>
                            <div class="hapus my-1">
                                <!-- Hapus BTN -->
                                <form action="../Aksi/Aksi.php" method="post">
                                    <input type="hidden" name="no" value="<?php echo $data['id_pelaporan'] ?>">
                                    <input class="Hapus btn btn-danger" type="submit" value="Hapus" name="SubmitHapus">
                                </form>
                            </div>
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

            <!-- Pengaduan ID PENDUDUK -->
            <div class="modal fade" id="IDPenduduk" tabindex="-1" aria-labelledby="LoginAdminLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">ID Penduduk</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h6 class="text-center">Masukkan ID Penduduk</h6>
                            <form action="../Aksi/Aksi.php" method="post">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="ID Penduduk"
                                        name="id_penduduk">
                                    <label for="floatingInput">ID Penduduk</label>
                                </div>
                                <button type="submit" class="btn btn-primary" name="SubmitID">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Tanggapan -->
            <div class="Tanggapan modal fade" id="Tanggapan<?php echo $data['id_pelaporan']?>" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tanggapan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="../Aksi/Aksi.php" method="post">
                                <label for="Tanggapan">Tanggapan</label>
                                <br>
                                <input type="hidden" name="no" value="<?php echo $data['id_pelaporan'] ?>">
                                <textarea name="tanggapan" rows="3" class="w-75"></textarea>
                                <br>
                                <br>
                                <input class="btn btn-primary" type="submit" value="submit" name="SubmitTanggapan">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Status -->
            <div class="status Tanggapan modal fade" id="status<?php echo $data['id_pelaporan']?>" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Status</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="../Aksi/Aksi.php" method="post">
                                <input type="hidden" name="no" value="<?php echo $data['id_pelaporan'] ?>">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" value="DI BACA">
                                    <label class="form-check-label" for="gridRadios1">
                                        DI BACA
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="gridRadios2"
                                        value="ON PROCESS">
                                    <label class="form-check-label" for="gridRadios1">
                                        ON PROCESS
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="gridRadios3"
                                        value="SELESAI">
                                    <label class="form-check-label" for="gridRadios1">
                                        SELESAI
                                    </label>
                                </div>
                                <br>
                                <input class="btn btn-primary" type="submit" value="submit" name="SubmitStatus">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            }
            ?>
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