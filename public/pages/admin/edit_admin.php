<?php


require __DIR__ . '/../../../src/db/db_connect.php';

$id = $_GET['id'] ?? null; // Lấy ID từ GET request, nếu không có thì là chuỗi rỗng

if ($id === null) {
    // Xử lý trường hợp không có ID hoặc ID không hợp lệ
    echo "Username không được cung cấp hoặc không hợp lệ.";
    // Có thể chuyển hướng người dùng về một trang khác hoặc hiển thị thông báo lỗi
    exit;
}

// Hiển thị Thông Tin Sách cần Cập Nhật
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    try {
        $query = "SELECT * FROM tk_quantrivien WHERE USERNAME_QTV = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $qtv = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$qtv) {
            echo "Không tìm thấy quản trị viên với Username: " . htmlspecialchars($id);
            exit;
        }
    } catch (PDOException $e) {
        echo "Lỗi khi truy vấn cơ sở dữ liệu: " . $e->getMessage();
        exit;
    }
}

// Thực hiện Cập Nhật
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $edit_admin = "UPDATE tk_quantrivien SET TEN_QTV = ?, EMAIL_QTV = ?, NGAY_SINH = ?, PASSWORD_QTV = ?  WHERE USERNAME_QTV = ?";
    $result = $pdo->prepare($edit_admin);
    $result->execute([
        $_POST['ten_qtv'],
        $_POST['email_qtv'],
        $_POST['ngaysinh_qtv'],
        $_POST['password'],
        $_POST['username_qtv']
    ]);

    header("Location: /admin/quanly_admin");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Metadata, title, links to CSS etc. -->
    <?php require __DIR__ . '/../../../src/partials/header.php'; ?>
</head>

<body>
    <!-- Sub-Header -->
    <?php require __DIR__ . '/../../../src/partials/sub-header--admin.php' ?>


    <main class="container mt-4">
        <h2>Chỉnh Sửa Thông Tin Quản Trị Viên</h2>
        <form method="POST">
            <input type="hidden" name="username_qtv" value="<?= htmlspecialchars($qtv['USERNAME_QTV']) ?>">
            <div class="form-group">
                <label for="ten_qtv">Tên Quản Trị Viên:</label>
                <input type="text" class="form-control" id="ten_qtv" name="ten_qtv" value="<?= htmlspecialchars($qtv['TEN_QTV']) ?>">
            </div>


            <div class="form-group">
                <label for="email_qtv">Email:</label>
                <!-- Giả sử bạn thay đổi thành dropdown hoặc tương tự -->
                <input type="text" class="form-control" id="email_qtv" name="email_qtv" value="<?= htmlspecialchars($qtv['EMAIL_QTV']) ?>">
            </div>
            <div class="form-group">
                <label for="ngaysinh_qtv">Ngày Sinh:</label>
                <!-- Giả sử bạn thay đổi thành dropdown hoặc tương tự -->
                <input type="date" class="form-control" id="ngaysinh_qtv" name="ngaysinh_qtv" value="<?= htmlspecialchars($qtv['NGAY_SINH']) ?>">
            </div>
            <div class="form-group">
                <label for="password">Mật Khẩu:</label>
                <input type="password" class="form-control" id="password" name="password" value="<?= htmlspecialchars($qtv['PASSWORD_QTV'] ?? '') ?>">
            </div>

            <button type="submit" class="btn btn-secondary mt-4">Cập Nhật</button>
        </form>
    </main>

    <!-- Đưa vào Footer -->
    <?php require __DIR__ . '/../../../src/partials/footer.php'; ?>
</body>

</html>