<!DOCTYPE html>
<html>
<head>
    <title>To Do List Tugas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <?php

    //Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";

    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada nilai yang dikirim menggunakan methos GET dengan nama id_peserta
    if (isset($_GET['no_id'])) {
        $no_id=input($_GET["no_id"]);

        $sql="select * from tugas where no_id=$no_id";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_assoc($hasil);


    }

    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $no_id=input($_POST["n0_id"]);
        $namaTugas=input($_POST["namaTugas"]);
        $status=input($_POST["status"]);
        $prioritas=input($_POST["prioritas"]);
        $tanggal=input($_POST["tanggal"]);

        //Query input menginput data kedalam tabel anggota
        $sql="insert into tugas (no_id,namaTugas,status,prioritas,tanggal) values
		('$no_id','$namaTugas','$status','$prioritas','$tanggal')";

        //Mengeksekusi/menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:index.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";

        }}
        ?>
    <h2>Update Data</h2>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="form-group">
            <label>No:</label>
            <input type="text" name="no_id" class="form-control" placeholder="Masukan Nomor" required />

        </div>
        <div class="form-group">
            <label>Nama Tugas:</label>
            <input type="text" name="namaTugas" class="form-control" placeholder="Masukan Nama Tugas" required/>
        </div>

        <div class="form-group">
        <label>Status:</label>
        <select name="status" class="form-control" required>
            <option value="Belum Selesai">Belum Selesai</option>
            <option value="Sedang Dikerjakan">Sedang Dikerjakan</option>
            <option value="Selesai">Selesai</option>
        </select> 
    </div>
    
    <div class="form-group">
        <label>Prioritas:</label>
        <select name="prioritas" class="form-control" required>
            <option value="Rendah">Rendah</option>
            <option value="Sedang">Sedang</option>
            <option value="Tinggi">Tinggi</option>
        </select> 
    </div>
    
    <div class="form-group">
        <label>Tanggal:</label>
        <input type="date" name="tanggal" class="form-control" required />
    </div>


        <input type="hidden" name="no-id" value="<?php echo $data['no_id']; ?>" />

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>