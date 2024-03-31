<?php
// Đưa vào tệp kết nối cơ sở dữ liệu
require __DIR__ . '/../../../src/db/db_connect.php';

// Cố gắng truy vấn bảng cơ sở dữ liệu và lấy dữ liệu
try {
    $query = "
        SELECT *
        FROM tk_quantrivien
        join   phanloai_taikhoan on tk_quantrivien.TEN_LOAI= phanloai_taikhoan.TEN_LOAI
    ";
    $stmt = $pdo->query($query);

    // Lấy tất cả các bản ghi
    $qtvs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<!-- Header -->
<?php require __DIR__ . '/../../../src/partials/header.php' ?>

<body>
    <!-- Sub-Header -->
    <?php require __DIR__ . '/../../../src/partials/sub-header--admin.php' ?>

    <main class="container mt-4">
        <h2>Quản Lý Quản Trị Viên</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Tên Quản Trị Viên</th>
                    <th>Tên Đăng Nhập</th>
                    <th>Mật Khẩu</th>
                    <th>Email</th>
                    <th>Ngày Sinh</th>
                    <th>Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($qtvs as $qtv) : ?>
                    <tr>
                        <td><?= htmlspecialchars($qtv['TEN_QTV']) ?></td>
                        <td><?= htmlspecialchars($qtv['USERNAME_QTV']) ?></td>
                        <td><?= htmlspecialchars($qtv['PASSWORD_QTV']) ?></td>
                        <td><?= htmlspecialchars($qtv['EMAIL_QTV']) ?></td>
                        <td><?= htmlspecialchars($qtv['NGAY_SINH']) ?></td>
                        <td>
                            <a style="float: left;" class="nav-link col" href="/admin/thaotac/edit_admin/?id=<?= $qtv['USERNAME_QTV'] ?>">Sửa</a>
                            <a style="float: left;" class="nav-link col" href="/admin/thaotac/delete_admin/?id=<?= $qtv['USERNAME_QTV'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?');">Xóa</a>
                        </td>
                    </tr>

                <?php endforeach; ?>

            </tbody>
        </table>

        <div class="row mt-4">
            <button type="button" class="btn btn-secondary col-lg-1">Làm mới</button>
            <a href="/admin/thaotac/addadmin" class="nav-link col-lg-1">Thêm mới</a>
        </div>
    </main>

    <!-- Footer -->
    <?php require __DIR__ . '/../../../src/partials/footer.php' ?>
</body>

</body>

</html>