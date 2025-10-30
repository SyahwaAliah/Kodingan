<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Mahasiswa</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

</head>
<body>

    <?php
    include("includes/config.php");

    if(isset($_POST['Simpan']))
    {
        if(isset($_REQUEST['nidnDosen']))
        {
            $dosen_NIDN = $_REQUEST['nidnDosen'];
        }

        if(!empty($dosen_NIDN))
        {
            // ambil semua data dari form
            $dosen_NIDN   = mysqli_real_escape_string($conn, $_POST['nidnDosen']);
            $dosen_NIK = mysqli_real_escape_string($conn, $_POST['nikDosen']);
            $dosen_Nama = mysqli_real_escape_string($conn, $_POST['namaDosen']);
            $dosen_Ket   = mysqli_real_escape_string($conn, $_POST['ketDosen']);

            // query insert
            mysqli_query($conn, "INSERT INTO dosen (dosen_nidn, dosen_nik, dosen_Nama, dosen_Ket) 
                                 VALUES('$dosen_NIDN', '$dosen_NIK', '$dosen_Nama', '$dosen_Ket')")
                                 or die(mysqli_error($conn));

            header("Location: dosen.php");
            exit;
        } 
        else 
        {
            echo "<h1>Maaf anda salah input</h1>";
            die("anda harus mengisi NIDN");
        }
    }

    // ambil data buat ditampilkan di tabel
    $query = mysqli_query($conn, "SELECT * FROM dosen");
    ?>

<form method="POST">
    <div class="row mb-3 mt-5">
    <div class="row mb-3">

        <label for="nidnDosen" class="col-sm-2 col-form-label">NIDN Dosen</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="nidnDosen" name="nidnDosen" placeholder="Masukan NIDN Dosen">
        </div>
    </div>

    <div class="row mb-3">
        <label for="nikDosen" class="col-sm-2 col-form-label">NIK Dosen</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="nikDosen" name="nikDosen" placeholder="Masukan NIK Dosen">
        </div>
    </div>

    <div class="row mb-3">
        <label for="namaMHS" class="col-sm-2 col-form-label">Nama Dosen</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="namaDosen" name="namaDosen" placeholder="Masukan Nama Dosen">
        </div>
    </div>
    

    <div class="row mb-3">
        <label for="ketMHS" class="col-sm-2 col-form-label">Keterangan Mahasiswa</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="ketDosen" name="ketDosen" placeholder="Keterangan Dosen">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-2"></div>
        <div class="col-10">
            <input type="submit" class="btn btn-success" value="Simpan" name="Simpan">
            <input type="reset" class="btn btn-danger" value="Batal" name="Batal">
        </div>
    </div>
</form>

<div class="row">
    <div class="col-1"></div>
    <div class="col-10">
        <div class="jumbotron mt-5 mb-3">
            <h1 class="display-5">Daftar Mahasiswa</h1>

            <table class="table table-striped table-success">
                <tr class="info"> 
                    <th>NIDN</th>
                    <th>NIK Dosen</th>
                    <th>Nama Dosen</th>
                    <th>Keterangan</th>
                </tr>

                <?php 
                while ($row = mysqli_fetch_array($query))
                { ?>
                    <tr class="danger"> 
                        <td><?php echo $row['dosen_NIDN']; ?></td>
                        <td><?php echo $row['dosen_NIK']; ?></td>
                        <td><?php echo $row['dosen_Nama']; ?></td>
                        <td><?php echo $row['dosen_Ket']; ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>

</body>
</html>
