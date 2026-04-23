<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>PerSeko</title>
<link rel="icon" href="assets/PerSeko.png" type="image/png">
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;

    /* DARK BACKGROUND */
    background: #121212;
}

.container {
    background: #1e1e1e;
    padding: 55px 65px;
    border-radius: 20px;
    text-align: center;
    width: 420px;

    box-shadow: 0 10px 30px rgba(0,0,0,0.6);
}

.logo {
    font-size: 60px;
    margin-bottom: 10px;

    /* NEON GREEN */
    background: linear-gradient(145deg, #00ff88, #00cc6a);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

h2 {
    margin-bottom: 25px;
    color: #ffffff;
    font-weight: 600;
}

/* tombol */
.btn {
    display: block;
    text-decoration: none;
    margin: 12px 0;
    padding: 14px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 16px;

    color: #000;

    background: linear-gradient(135deg, #00ff88, #00cc6a);

    transition: 0.3s;
    box-shadow: 0 0 12px rgba(0,255,136,0.6);
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,255,136,0.8);
    color: #fff;
}

/* tombol kedua */
.btn.secondary {
    background: #2a2a2a;
    color: #00ff88;
    border: 1px solid #00ff88;
}

.btn.secondary:hover {
    background: #00ff88;
    color: #000;
}
</style>
</head>

<body>

<div class="container">

    <div class="logo">📚</div>
    <h2>PerSeko</h2>

    <a href="siswa/login.php" class="btn">Login Siswa</a>
    <a href="auth/register.php" class="btn secondary">Register</a>
    <a href="admin/login.php" class="btn">Login Admin</a>

</div>

</body>
</html>