<?php

use Master\Menu;
use Master\data_pegawai;
use Master\data_jabatan;
use Master\hak_akses;

include 'autoload.php';
include 'Config/Database.php';

$menu = new Menu();
$data_pegawai = new data_pegawai($dataKoneksi);
$data_jabatan = new data_jabatan($dataKoneksi);
$hak_akses = new hak_akses($dataKoneksi);
// $mahasiswa->tambah();
$target = @$_GET['target'];
$act = @$_GET['act'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UTS</title>
    <link href="assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-info">
            <div class="container-fluid">
                <a class="navbar-brand" href="">CRUD OOP</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#MyMenu" aria- controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="MyMenu">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php
foreach ($menu->topMenu() as $r) {
    ?>
                            <li class="nav-item">
                                <a href="<?php echo $r['Link']; ?>" class="nav-link">
                                    <?php echo $r['Text']; ?>
                                </a>
                            </li>
                        <?php
}
?>
                    </ul>
                </div>
            </div>
        </nav>
        <br>
        <div class="content">
            <h5>Content <?php echo strtoupper($target); ?></h5>
            <?php
if (!isset($target) or $target == "home") {
    echo "Hai, Selamat Datang Di Beranda";
    // =========== start kontent data_pegawai ======================
} elseif ($target == "data_pegawai") {
    if ($act == "tambah_data_pegawai") {
        echo $data_pegawai->tambah();
    } elseif ($act == "simpan_data_pegawai") {
        if ($data_pegawai->simpan()) {
            echo "<script>
                            alert('data sukses disimpan');
                            window.location.href='?target=data_pegawai';
                        </script>";
        } else {
            echo "<script>
                            alert('data gagal disimpan');
                            window.location.href='?target=data_pegawai';
                        </script>";
        }
    } elseif ($act == "edit_data_pegawai") {
        $id = $_GET['id'];
        echo $data_pegawai->edit($id);
    } elseif ($act == "update_data_pegawai") {
        if ($data_pegawai->update()) {
            echo "<script>
                            alert('data sukses diubah');
                            window.location.href='?target=data_pegawai';
                        </script>";
        } else {
            echo "<script>
                            alert('data gagal diubah');
                            window.location.href='?target=data_pegawai';
                        </script>";
        }
    } elseif ($act == "delete_data_pegawai") {
        $id = $_GET['id'];
        if ($data_pegawai->delete($id)) {
            echo "<script>
                            alert('data sukses dihapus');
                            window.location.href='?target=data_pegawai';
                        </script>";
        } else {
            echo "<script>
                        alert('data gagal dihapus');
                        window.location.href='?target=data_pegawai';
                    </script>";
        }
    } else {
        echo $data_pegawai->index();
    }

    // data_jabatan
} elseif ($target == "data_jabatan") {
    if ($act == "tambah_data_jabatan") {
        echo $data_jabatan->tambah();
    } elseif ($act == "simpan_data_jabatan") {
        if ($data_jabatan->simpan()) {
            echo "<script>
                        alert('data sukses disimpan');
                        window.location.href='?target=data_jabatan';
                    </script>";
        } else {
            echo "<script>
                        alert('data gagal disimpan');
                        window.location.href='?target=data_jabatan';
                    </script>";
        }
    } elseif ($act == "edit_data_jabatan") {
        $id = $_GET['id'];
        echo $data_jabatan->edit($id);
    } elseif ($act == "update_data_jabatan") {
        if ($data_jabatan->update()) {
            echo "<script>
                        alert('data sukses diubah');
                        window.location.href='?target=data_jabatan';
                    </script>";
        } else {
            echo "<script>
                        alert('data gagal diubah');
                        window.location.href='?target=data_jabatan';
                    </script>";
        }
    } elseif ($act == "delete_data_jabatan") {
        $id = $_GET['id'];
        if ($data_jabatan->delete($id)) {
            echo "<script>
                        alert('data sukses dihapus');
                        window.location.href='?target=data_jabatan';
                    </script>";
        } else {
            echo "<script>
                    alert('data gagal dihapus');
                    window.location.href='?target=data_jabatan';
                </script>";
        }
    } else {
        echo $data_jabatan->index();
    }

    // hak_akses
} elseif ($target == "hak_akses") {
    if ($act == "tambah_hak_akses") {
        echo $hak_akses->tambah();
    } elseif ($act == "simpan_hak_akses") {
        if ($hak_akses->simpan()) {
            echo "<script>
                        alert('data sukses disimpan');
                        window.location.href='?target=hak_akses';
                    </script>";
        } else {
            echo "<script>
                        alert('data gagal disimpan');
                        window.location.href='?target=hak_akses';
                    </script>";
        }
    } elseif ($act == "edit_hak_akses") {
        $id = $_GET['id'];
        echo $hak_akses->edit($id);
    } elseif ($act == "update_hak_akses") {
        if ($hak_akses->update()) {
            echo "<script>
                        alert('data sukses diubah');
                        window.location.href='?target=hak_akses';
                    </script>";
        } else {
            echo "<script>
                        alert('data gagal diubah');
                        window.location.href='?target=hak_akses';
                    </script>";
        }
    } elseif ($act == "delete_hak_akses") {
        $id = $_GET['id'];
        if ($hak_akses->delete($id)) {
            echo "<script>
                        alert('data sukses dihapus');
                        window.location.href='?target=hak_akses';
                    </script>";
        } else {
            echo "<script>
                    alert('data gagal dihapus');
                    window.location.href='?target=hak_akses';
                </script>";
        }
    } else {
        echo $hak_akses->index();
    }

    // no pengguna
} elseif ($target == 'pengguna') {

    echo "selamat datang di pengguna";
}
?>
    </div>
</div>
</body>
</html>