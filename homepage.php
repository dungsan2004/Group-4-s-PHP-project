<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }
        h1 {
            text-align: center;
            background-color: #4CAF50;
            color: white;
            padding: 20px 0;
            margin: 0;
        }
        section {
            margin: 20px auto;
            padding: 20px;
            max-width: 800px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #4CAF50;
            margin-bottom: 15px;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        li:last-child {
            border-bottom: none;
        }
        img {
            margin-right: 15px;
            border-radius: 8px;
        }
        p {
            margin: 0;
        }
    </style>
</head>
<body>
    <h1>Danh sách thông tin phòng trọ</h1>

    <section>
        <h2>Các phòng trọ xem nhiều nhất</h2>
        <ul>
            <?php
            include 'db.php'; // Kết nối cơ sở dữ liệu
            $query = "SELECT title, price, images FROM motel ORDER BY count_view DESC LIMIT 3";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<li>";
                echo "<img src='" . $row['images'] . "' alt='Ảnh phòng trọ' style='width:100px;height:100px;'>";
                echo "<p>" . $row['title'] . "</p>";
                echo "<p>Giá: " . number_format($row['price']) . " VND</p>";
                echo "</li>";
            }
            ?>
        </ul>
    </section>

    <section>
        <h2>Các phòng trọ mới được đăng tải</h2>
        <ul>
            <?php
            $query = "SELECT title, price, images FROM motel ORDER BY created_at DESC LIMIT 3";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<li>";
                echo "<img src='" . $row['images'] . "' alt='Ảnh phòng trọ' style='width:100px;height:100px;'>";
                echo "<p>" . $row['title'] . "</p>";
                echo "<p>Giá: " . number_format($row['price']) . " VND</p>";
                echo "</li>";
            }
            ?>
        </ul>
    </section>

    <section>
        <h2>Các phòng trọ gần trường ĐH Vinh nhất</h2>
        <ul>
            <?php
            $query = "SELECT title, price, images FROM motel WHERE address LIKE '%ĐH Vinh%' LIMIT 3";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<li>";
                echo "<img src='" . $row['images'] . "' alt='Ảnh phòng trọ' style='width:100px;height:100px;'>";
                echo "<p>" . $row['title'] . "</p>";
                echo "<p>Giá: " . number_format($row['price']) . " VND</p>";
                echo "</li>";
            }
            ?>
        </ul>
    </section>
</body>
</html>