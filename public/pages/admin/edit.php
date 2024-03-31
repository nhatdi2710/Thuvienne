<?php


require __DIR__ . '/../../../src/db/db_connect.php';
require __DIR__ . '/../../../src/functions.php';
$id = $_GET['id'] ?? null; // Lấy ID từ GET request, nếu không có thì là chuỗi rỗng

if ($id === null) {
    // Xử lý trường hợp không có ID hoặc ID không hợp lệ
    echo "ID không được cung cấp hoặc không hợp lệ.";
    // Có thể chuyển hướng người dùng về một trang khác hoặc hiển thị thông báo lỗi
    exit;
}

// Hiển thị Thông Tin Sách cần Cập Nhật
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    try {
        $query = "SELECT * FROM SACH WHERE MA_SACH = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $sach = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$sach) {
            echo "Không tìm thấy sách với ID: " . htmlspecialchars($id);
            exit;
        }
    } catch (PDOException $e) {
        echo "Lỗi khi truy vấn cơ sở dữ liệu: " . $e->getMessage();
        exit;
    }
}

// Thực hiện Cập Nhật
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $edit = "UPDATE SACH SET TEN_SACH = ?, MA_TG = ?, STT_THELOAI = ?, MA_NXB = ?, TGXB = ? WHERE MA_SACH = ?";
    $result = $pdo->prepare($edit);
    $result->execute([
        $_POST['ten_sach'],
        $_POST['ten_tg'],
        $_POST['ten_theloai'],
        $_POST['ten_nxb'],
        $_POST['tgxb'],
        $_POST['ma_sach']
    ]);

    redirect("/admin/quanly_sach");
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
        <h2>Chỉnh Sửa Thông Tin Sách</h2>
        <form method="POST">
            <input type="hidden" name="ma_sach" value="<?= htmlspecialchars($sach['MA_SACH']) ?>">
            <div class="form-group">
                <label for="ten_sach">Tên Sách:</label>
                <input type="text" class="form-control" id="ten_sach" name="ten_sach" value="<?= htmlspecialchars($sach['TEN_SACH']) ?>">
            </div>
            <div class="form-group">
                <label for="ten_tg">Tác Giả:</label>
                <!-- Giả sử bạn thay đổi thành dropdown hoặc tương tự -->
                <input type="text" class="form-control" id="ten_tg" name="ten_tg" value="<?= htmlspecialchars($sach['MA_TG']) ?>">
            </div>
            <div class="form-group">
                <label for="ten_theloai">Thể Loại:</label>
                <!-- Giả sử bạn thay đổi thành dropdown hoặc tương tự -->
                <input type="text" class="form-control" id="ten_theloai" name="ten_theloai" value="<?= htmlspecialchars($sach['STT_THELOAI']) ?>">
            </div>
            <div class="form-group">
                <label for="ten_nxb">Nhà Xuất Bản:</label>
                <!-- Giả sử bạn thay đổi thành dropdown hoặc tương tự -->
                <input type="text" class="form-control" id="ten_nxb" name="ten_nxb" value="<?= htmlspecialchars($sach['MA_NXB']) ?>">
            </div>
            <div class="form-group">
                <label for="tgxb">Thời Gian Xuất Bản:</label>
                <input type="year(4)" class="form-control" id="tgxb" name="tgxb" value="<?= htmlspecialchars($sach['TGXB']??'') ?>">
            </div>

            <button type="submit" class="btn btn-secondary mt-4">Cập Nhật</button>
        </form>
    </main>

<!-- Đưa vào Footer -->
<?php require __DIR__ . '/../../../src/partials/footer.php'; ?>
</body>

</html>