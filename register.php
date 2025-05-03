<?php include 'db.php'; ?>
<?php
session_start();
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 0;
    $phone = $_POST['phone'];
    $avatar = $_POST['avatar'];

    $stmt = $conn->prepare("INSERT INTO user (Name, Username, Email, Password, Role, Phone, Avatar)
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssiss", $name, $username, $email, $password, $role, $phone, $avatar);

    if ($stmt->execute()) {
        $message = "✅ Đăng ký thành công! <a href='login.php'>Đăng nhập</a>";
    } else {
        $message = "❌ Lỗi: " . $stmt->error;
    }

    $stmt->close();
}
?>

<link rel="stylesheet" href="style.css">
<div class="form-container">
    <h2>Đăng ký tài khoản</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Họ tên" required>
        <input type="text" name="username" placeholder="Tên đăng nhập" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Mật khẩu" required>
        <input type="text" name="phone" placeholder="Số điện thoại">
        <input type="text" name="avatar" placeholder="Avatar URL (có thể bỏ trống)">
        <button type="submit">Đăng ký</button>
        <p>Đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
    </form>
</div>

<?php if ($message): ?>
<div class="dialog">
    <?= $message ?>
</div>
<?php endif; ?>
