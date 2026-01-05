<?php
if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); // Gunakan password_verify jika dipassword_hash

    $sql = "SELECT * FROM users WHERE username='{$username}' AND password='{$password}'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['isLogin'] = true;
        $_SESSION['username'] = $row['username'];
        $_SESSION['nama_lengkap'] = $row['nama_lengkap'];
        
        echo "<script>alert('Login Berhasil!'); window.location='index.php?page=dashboard';</script>";
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<div class="login-wrapper" style="display: flex; justify-content: center; align-items: center; min-height: 60vh;">
    <div class="login-box" style="width: 100%; max-width: 350px; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background: white;">
        <h3 style="text-align: center;">Login Admin</h3>
        
        <?php if(isset($error)): ?>
            <p style="color: red; text-align: center;"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="post" action="">
            <div class="input" style="margin-bottom: 10px;">
                <label>Username</label>
                <input type="text" name="username" style="width: 100%; padding: 8px;" required />
            </div>
            <div class="input" style="margin-bottom: 20px;">
                <label>Password</label>
                <input type="password" name="password" style="width: 100%; padding: 8px;" required />
            </div>
            <input type="submit" name="submit" value="Login" class="btn" style="width: 100%; cursor: pointer;" />
        </form>
    </div>
</div>