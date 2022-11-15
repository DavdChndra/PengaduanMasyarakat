<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- css -->
    <link rel="stylesheet" href="style.css">
    <title>Pengaduan Masyarakat</title>
</head>

<body>
    <section style="height: 100vh;" class="d-flex justify-content-center align-items-center">
        <a href="../PengaduanMasyarakat/User/KumpulanPengaduan.php"
            class="btn btn-outline-secondary text-decoration-none mx-2 w-25">
            <h4 class="my-4">Kumpulan Pengaduan</h4>
        </a>
        <a class="btn btn-outline-secondary text-decoration-none mx-2 w-25" data-bs-toggle="modal"
            data-bs-target="#IDPenduduk">
            <h4 class="my-4">Pengaduan</h4>
        </a>
        <a class="btn btn-outline-secondary text-decoration-none mx-2 w-25" data-bs-toggle="modal"
            data-bs-target="#LoginAdmin">
            <h4 class="my-4">admin</h4>
        </a>
    </section>

    <!-- Login Admin -->
    <div class="Admin">
        <div class="modal fade" id="LoginAdmin" tabindex="-1" aria-labelledby="LoginAdminLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Login Admin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php 
                        include "Admin/LoginAdmin.php";
                        ?>
                    </div>
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
                    <form action="../PengaduanMasyarakat/Aksi/Aksi.php" method="post">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>