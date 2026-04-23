<?php
session_start();
include('../config/db.php');

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $nama  = $_POST['nama'];

    $q = $conn->query("SELECT * FROM users WHERE email='$email' AND nama='$nama'");

    if($q->num_rows > 0){
        $_SESSION['user'] = $email;
        $_SESSION['level'] = 'user';
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Login gagal!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login Siswa</title>
<link rel="icon" href="assets/PerSeko.png" type="image/png">
<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:#121212;
}

/* CARD */
.container{
    width:420px;
    background:#1e1e1e;
    padding:40px;
    border-radius:20px;
    text-align:center;
    box-shadow:0 10px 25px rgba(0,0,0,0.6);
}

/* LOGO */
.logo{
    width:70px;
    height:70px;
    margin:auto;
    margin-bottom:10px;
}

.logo svg{
    width:100%;
    height:100%;
    filter:drop-shadow(0 0 6px #00ff88);
}

/* TITLE */
h2{
    color:#fff;
    margin-bottom:20px;
}

/* INPUT */
.input-group{
    text-align:left;
    margin-bottom:15px;
}

.input-group label{
    font-size:14px;
    color:#aaa;
}

.input-group input{
    width:100%;
    padding:12px;
    margin-top:6px;
    border-radius:10px;
    border:1px solid #333;
    background:#121212;
    color:#fff;
    outline:none;
    transition:0.3s;
}

.input-group input:focus{
    border-color:#00ff88;
    box-shadow:0 0 8px rgba(0,255,136,0.4);
}

/* BUTTON */
.btn{
    width:100%;
    padding:12px;
    background:#00ff88;
    color:#000;
    border:none;
    border-radius:10px;
    font-weight:600;
    cursor:pointer;
    transition:0.3s;
}

.btn:hover{
    background:#00cc6a;
    color:#fff;
    box-shadow:0 0 12px rgba(0,255,136,0.5);
}

/* ERROR */
.error{
    color:#ff4d4d;
    margin-bottom:10px;
    font-size:14px;
}

/* BACK */
.back{
    display:block;
    margin-top:15px;
    text-decoration:none;
    color:#00ff88;
    font-size:14px;
}

.back:hover{
    text-decoration:underline;
}
</style>
</head>

<body>

<div class="container">

    <!-- LOGO BUKU NEON (BEDA DARI ADMIN) -->
    <div class="logo">
        <svg viewBox="0 0 24 24" fill="none">
            <path d="M4 5C4 4 5 3 6 3H16C17 3 18 4 18 5V19C18 20 17 21 16 21H6C5 21 4 20 4 19V5Z"
                  stroke="#00ff88" stroke-width="2"/>
            <line x1="8" y1="3" x2="8" y2="21" stroke="#00ff88"/>
            <line x1="10" y1="8" x2="16" y2="8" stroke="#00ff88"/>
            <line x1="10" y1="12" x2="16" y2="12" stroke="#00ff88"/>
            <line x1="10" y1="16" x2="16" y2="16" stroke="#00ff88"/>
        </svg>
    </div>

    <h2>Login Siswa</h2>

    <?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>

    <form method="POST">

        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>

        <div class="input-group">
            <label>Nama</label>
            <input type="text" name="nama" required>
        </div>

        <button class="btn" name="login">Masuk</button>

    </form>

    <a href="../index.php" class="back">← Kembali</a>

</div>

</body>
</html>