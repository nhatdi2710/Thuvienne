<?php
// Kết nối cơ sở dữ liệu
require __DIR__ . '/../../../src/db/db_connect.php';

$successMessage = '';
$theLoaiStmt = $pdo->query("SELECT STT_THELOAI, TEN_TL FROM THE_LOAI");
$theLoais = $theLoaiStmt->fetchAll(PDO::FETCH_ASSOC);

$nxbStmt = $pdo->query("SELECT MA_NXB, TEN_NXB FROM NHA_XUAT_BAN");
$nxbs = $nxbStmt->fetchAll(PDO::FETCH_ASSOC);

$tgStmt = $pdo->query("SELECT MA_TG, TEN_TG FROM TAC_GIA");
$tgs = $tgStmt->fetchAll(PDO::FETCH_ASSOC);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $masach = $_POST['ma_sach'];
    $tenSach = $_POST['ten_sach'];
    $maTG = $_POST['ma_tg'];
    $sttTheLoai = $_POST['stt_theloai'];
    $maNXB = $_POST['ma_nxb'];
    $tgxb = $_POST['tgxb'];

    try {
        // Tạo và chuẩn bị câu lệnh SQL
        $query = "INSERT INTO SACH (MA_SACH, TEN_SACH, MA_TG, STT_THELOAI, MA_NXB, TGXB) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($query);

        // Ràng buộc giá trị và thực thi câu lệnh
        if ($stmt->execute([$masach, $tenSach, $maTG, $sttTheLoai, $maNXB, $tgxb])) {
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

    <main class="container mt-4">
        <?php if ($successMessage) : ?>
            <p class="success-message"><?= $successMessage ?></p>
            <a href="/admin/quanly_sach" class="btn">Quay lại Trang Quan Lý</a>
        <?php else : ?>
            <form action="add" method="post" class="form">
                <h2>Thêm Sách Mới</h2>
                <!-- Mã Sách -->
                <div class="form-group">
                    <label for="ma_sach">Mã Sách:</label>
                    <input class="form-control" type="text" id="ma_sach" name="ma_sach" required>
                </div>

                <!-- STT Thể Loại -->
                <div class="form-group">
                    <label for="stt_theloai">STT Thể Loại:</label>
                    <select class="form-control" id="stt_theloai" name="stt_theloai" required>
                        <?php foreach ($theLoais as $theLoai) : ?>
                            <option value="<?= $theLoai['STT_THELOAI'] ?>"><?= $theLoai['TEN_TL'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Mã NXB -->
                <div class="form-group">
                    <label for="ma_nxb">Mã Nhà Xuất Bản:</label>
                    <select class="form-control" id="ma_nxb" name="ma_nxb" required>
                        <?php foreach ($nxbs as $nxb) : ?>
                            <option value="<?= $nxb['MA_NXB'] ?>"><?= $nxb['TEN_NXB'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Mã Tác Giả -->
                <div class="form-group">
                    <label for="ma_tg">Mã Tác Giả:</label>
                    <select class="form-control" id="ma_tg" name="ma_tg" required>
                        <?php foreach ($tgs as $tg) : ?>
                            <option value="<?= $tg['MA_TG'] ?>"><?= $tg['TEN_TG'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Tên Sách -->
                <div class="form-group">
                    <label for="ten_sach">Tên Sách:</label>
                    <input class="form-control" type="text" id="ten_sach" name="ten_sach" required>
                </div>

                <!-- Thời Gian Xuất Bản -->
                <div class="form-group">
                    <label for="tgxb">Thời Gian Xuất Bản:</label>
                    <input class="form-control" type="number" id="tgxb" name="tgxb" required>
                </div>

                <button type="submit" class="btn btn-secondary mt-4">Thêm Sách</button>
            </form>

        <?php endif; ?>
    </main>

    <!-- Footer -->
    <?php require __DIR__ . '/../../../src/partials/footer.php' ?>
</body>

</html>