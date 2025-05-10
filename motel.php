<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết phòng trọ</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #4CAF50;
            margin-bottom: 15px;
        }
        img {
            max-width: 100%;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        p {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        include 'db.php'; 

        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $query = "SELECT title, description, price, area, address, images, utilities FROM motel WHERE ID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<h1>" . htmlspecialchars($row['title']) . "</h1>";
            echo "<img src='" . htmlspecialchars($row['images']) . "' alt='Ảnh phòng trọ'>";
            echo "<p><strong>Giá:</strong> " . number_format($row['price']) . " VND</p>";
            echo "<p><strong>Diện tích:</strong> " . htmlspecialchars($row['area']) . " m²</p>";
            echo "<p><strong>Địa chỉ:</strong> " . htmlspecialchars($row['address']) . "</p>";
            echo "<p><strong>Mô tả:</strong> " . nl2br(htmlspecialchars($row['description'])) . "</p>";
            echo "<p><strong>Tiện ích:</strong> " . htmlspecialchars($row['utilities']) . "</p>";
        } else {
            echo "<p>Không tìm thấy thông tin phòng trọ.</p>";
        }

        $stmt->close();
        ?>
    </div>
</body>
</html>