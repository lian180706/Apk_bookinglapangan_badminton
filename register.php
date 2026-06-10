<?php
require_once __DIR__ . '/../koneksi.php';

if(isset($_POST['daftar'])){

$nama = $_POST['nama'];
$email = $_POST['email'];
$password =
password_hash($_POST['password'], PASSWORD_DEFAULT);
$no_hp = $_POST['no_hp'];

/* SIMPAN KE DATABASE */

mysqli_query($conn,

"INSERT INTO users
(nama,email,password,no_hp)

VALUES
('$nama','$email','$password','$no_hp')");

/* ALERT */

echo "<script>
alert('Registrasi Berhasil');
window.location='login.php';
</script>";

}
?>

<!DOCTYPE html>
<html lang="id">

<head>
<meta charset="UTF-8">
<title>Badminton Register</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Segoe UI',sans-serif;
}

body{
height:100vh;
display:flex;
}

/* KIRI */

.left{
width:40%;
background:#f5f7fa;
display:flex;
justify-content:center;
align-items:center;
}

.form-box{
width:80%;
background:white;
padding:50px;
border-radius:15px;
box-shadow:0 10px 25px rgba(0,0,0,0.2);
}

.form-box h2{
text-align:center;
margin-bottom:20px;
color:#1b5e20;
}

.form-box label{
display:block;
margin-top:10px;
font-weight:bold;
}

.form-box input{
width:100%;
padding:10px;
margin-top:5px;
border-radius:8px;
border:1px solid #ccc;
}

.btn{
width:100%;
margin-top:20px;
padding:12px;
border:none;

background:
linear-gradient(90deg,#7cb342,#8bc34a);

color:white;
font-size:16px;

border-radius:10px;
cursor:pointer;
}

.btn:hover{
background:
linear-gradient(90deg,#689f38,#7cb342);
}

/* KANAN */

.right{
width:60%;
background: url('bg4.jpg') no-repeat center;
background-size:cover;
position:relative;
}

.overlay{
position:absolute;
width:100%;
height:100%;

background:
rgba(0,30,60,0.7);
}

.text{
position:absolute;
top:30px;
left:40px;
color:white;
}

.text h1{
font-size:30px;
}

.text span{
color:#8bc34a;
}

</style>

</head>

<body>

<!-- FORM REGISTER -->
<div class="left">

<div class="form-box">

<h2>REGISTRASI</h2>

<form method="POST">

<label>Nama</label>
<input type="text"
name="nama"
required>

<label>Email</label>
<input type="email"
name="email"
required>

<label>Password</label>
<input type="password"
name="password"
required>

<label>No HP</label>
<input type="text"
name="no_hp"
required>

<button
type="submit"
name="daftar"
class="btn">

DAFTAR SEKARANG

</button>

</form>

</div>

</div>

<!-- GAMBAR -->
<div class="right">

<div class="overlay"></div>

<div class="text">

<h1>
Badminton <span>Tabek</span>
</h1>

<p>
Net adalah batas,
mentalitas tanpa batas
</p>

</div>

</div>

</body>
</html>