<?php
// Kết nối cơ sở dữ liệu
require __DIR__ . '/../../../src/db/db_connect.php';

$successMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $tenSach = $_POST['ten_sach'];
    $maTG = $_POST['ma_tg'];
    $sttTheLoai = $_POST['stt_theloai'];
    $maNXB = $_POST['ma_nxb'];
    $tgxb = $_POST['tgxb'];

    try {
        // Tạo và chuẩn bị câu lệnh SQL
        $query = "INSERT INTO SACH (TEN_SACH, MA_TG, STT_THELOAI, MA_NXB, TGXB) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($query);

        // Ràng buộc giá trị và thực thi câu lệnh
        if ($stmt->execute([$tenSach, $maTG, $sttTheLoai, $maNXB, $tgxb])) {
            $successMessage = "Sách đã được thêm thành công!";
        } else {
            $successMessage = "Có lỗi xảy ra. Vui lòng thử lại.";
        }
    } catch (PDOException $e) {
        $successMessage = "Lỗi khi thêm sách mới: " . $e->getMessage();
    }
}

// Đóng kết nối
$pdo = null;
?>

<!DOCTYPE html>
<html lang="en">

<!-- Header -->
<?php require __DIR__ . '/../../../src/partials/header.php' ?>

<body>
<!-- Sub-Header -->
<?php require __DIR__ . '/../../../src/partials/sub-header--admin.php' ?>

    <div class="container mt-4">
        <?php if ($successMessage) : ?>
            <p class="success-message"><?= $successMessage ?></p>
            <a href="../admin/add.php" class="btn">Quay lại Trang Chủ</a>
        <?php else : ?>
            <form action="add.php" method="post" class="form">
                <h2>Thêm Sách Mới</h2>
                <div class="form-group">
                    <label for="ma_sach">Mã Sách:</label>
                    <input class="form-control" type="text" id="ma_sach" name="ma_sach" required>
                </div>
                <div class="form-group">
                    <label for="stt_theloai">STT Thể Loại:</label>
                    <input class="form-control" type="text" id="stt_theloai" name="stt_theloai" required>
                </div>
                <div class="form-group">
                    <label for="ma_nxb">Mã Nhà Xuất Bản:</label>
                    <input class="form-control" type="text" id="ma_nxb" name="ma_nxb" required>
                </div>
                <div class="form-group">
                    <label for="ma_tg">Mã Tác Giả:</label>
                    <input class="form-control" type="text" id="ma_tg" name="ma_tg" required>
                </div>
                <div class="form-group">
                    <label for="ten_sach">Tên Sách:</label>
                    <input class="form-control" type="text" id="ten_sach" name="ten_sach" required>
                </div>
                <div class="form-group">
                    <label for="tgxb">Thời Gian Xuất Bản:</label>
                    <input class="form-control" type="date" id="tgxb" name="tgxb" required>
                </div>
                <button type="submit" class="btn btn-secondary mt-4">Thêm Sách</button>
            </form>
        <?php endif; ?>
    </div>

<!-- Footer -->
<?php require __DIR__ . '/../../../src/partials/footer.php' ?>
</body>

</html>