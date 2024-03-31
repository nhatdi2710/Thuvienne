<?php
// Kết nối cơ sở dữ liệu
require __DIR__ . '/../../../src/db/db_connect.php';
$errorMessage = '';
$successMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $username = $_POST['username_qtv'];
    $tenqtv = $_POST['ten_qtv'];
    $emailqtv = $_POST['email_qtv'];
    $ngaysinhqtv = $_POST['ngaysinh_qtv'];
    $pass = $_POST['password'];
    // $tenloai=$_POST['ten_loai'];

    // Kiểm tra xem USERNAME_QTV đã tồn tại chưa
    $checkQuery = "SELECT COUNT(*) FROM tk_quantrivien WHERE USERNAME_QTV = ?";
    $stmtCheck = $pdo->prepare($checkQuery);
    $stmtCheck->execute([$username]);
    $exists = $stmtCheck->fetchColumn() > 0;

    if ($exists) {
        $errorMessage = "Tài khoản với Username: $username đã tồn tại. Vui lòng chọn tạo tài khoản khác.";
    } else {

        try {
            // Tạo và chuẩn bị câu lệnh SQL
            $query = "INSERT INTO tk_quantrivien (USERNAME_QTV,TEN_QTV,EMAIL_QTV,NGAY_SINH,PASSWORD_QTV,TEN_LOAI) VALUES (?, ?, ?, ?, ?,'quantv')";
            $stmt = $pdo->prepare($query);

            // Ràng buộc giá trị và thực thi câu lệnh
            if ($stmt->execute([$username, $tenqtv, $emailqtv, $ngaysinhqtv, $pass])) {
                $successMessage = "
                <p class='success-message'>Tài Khoản với Username: $username đã được thêm thành công!</p> ";
            } else {
                $successMessage = "Có lỗi xảy ra. Vui lòng thử lại.";
            }
        } catch (PDOException $e) {
            $successMessage = "Lỗi khi thêm sách mới: " . $e->getMessage();
        }
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

        <?php if ($errorMessage) : ?>

            <div class="alert alert-danger" role="alert">
                <?= $errorMessage; ?>
            </div>

        <?php endif; ?>

        <?php if ($successMessage) : ?>
            <p class="success-message"><?= $successMessage ?></p>
            <a href="/admin/quanly_admin" class="btn">Quay lại Trang Quản Lý</a>
        <?php else : ?>
            <form action="addadmin" method="post" class="form">
                <h2>Thêm Quản Tri Viên Mới</h2>
                <!-- Username -->
                <div class="form-group">
                    <label for="username_qtv">Username:</label>
                    <input class="form-control" type="text" id="username_qtv" name="username_qtv" required>
                </div>


                <!-- Tên qtv -->
                <div class="form-group">
                    <label for="ten_qtv">Tên Quản Tri Viên:</label>
                    <input class="form-control" type="text" id="ten_qtv" name="ten_qtv" required>
                </div>


                <!--email-->
                <div class="form-group">
                    <label for="email_qtv">Email:</label>
                    <input class="form-control" type="text" id="email_qtv" name="email_qtv" required>
                </div>
                <!-- ngày sinh -->
                <div class="form-group">
                    <label for="ngaysinh_qtv">Ngày Sinh:</label>
                    <input class="form-control" type="date" id="ngaysinh_qtv" name="ngaysinh_qtv" required>
                </div>
                <!-- mật khẩu -->
                <div class="form-group">
                    <label for="password">Mật Khẩu:</label>
                    <input class="form-control" type="text" id="password" name="password" required>
                </div>


                <button type="submit" class="btn btn-secondary mt-4">Thêm tài khoản</button>
            </form>

        <?php endif; ?>
    </div>


    <!-- Footer -->
    <?php require __DIR__ . '/../../../src/partials/footer.php' ?>
</body>

</html>