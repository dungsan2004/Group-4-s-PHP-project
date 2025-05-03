<?php include 'db.php'; ?>
<?php
session_start();
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Truy vấn theo Username
    $stmt = $conn->prepare("SELECT * FROM user WHERE Username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        // Kiểm tra mật khẩu
        if (password_verify($password, $row['Password'])) {
            // Đăng nhập thành công, lưu thông tin vào session
            $_SESSION['user_id'] = $row['ID'];
            $_SESSION['username'] = $row['Username'];
            $_SESSION['role'] = $row['Role'];

            $message = "✅ Đăng nhập thành công!";
        } else {
            $message = "❌ Sai mật khẩu!";
        }
    } else {
        $message = "❌ Tên đăng nhập không tồn tại!";
    }

    $stmt->close();
}
?>

<link rel="stylesheet" href="style.css">
<div class="form-container">
    <h2>Đăng nhập</h2>
    <form method="POST">
        <input type="text" name="username" placeholder="Tên đăng nhập" required>
        <input type="password" name="password" placeholder="Mật khẩu" required>
        <button type="submit">Đăng nhập</button>
        <p>Chưa có tài khoản? <a href="register.php">Đăng ký</a></p>
    </form>
</div>

<?php if ($message): ?>
<div class="dialog">
    <?= $message ?>
</div>
<?php endif; ?>
