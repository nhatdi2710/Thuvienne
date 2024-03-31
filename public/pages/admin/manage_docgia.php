<?php
// Đưa vào tệp kết nối cơ sở dữ liệu
require __DIR__ . '/../../../src/db/db_connect.php';

// Cố gắng truy vấn bảng cơ sở dữ liệu và lấy dữ liệu
try {
    $query = "
        SELECT *
        FROM tk_docgia
        join   the_thu_vien on tk_docgia.USERNAME_DG= the_thu_vien.USERNAME_DG
    ";
    $stmt = $pdo->query($query);

    // Lấy tất cả các bản ghi
    $dgs = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        <h2>Quản Lý Độc Giả</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Tên Độc Giả</th>
                    <th>Tên Đăng Nhập</th>
                    <th>Mật Khẩu</th>
                    <th>Email</th>
                    <th>Số thẻ thư viện</th>
                    <th>Ngày Sinh</th>
                    <th>Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dgs as $dg) : ?>
                    <tr>
                        <td><?= htmlspecialchars($dg['TEN_DG']) ?></td>
                        <td><?= htmlspecialchars($dg['USERNAME_DG']) ?></td>
                        <td><?= htmlspecialchars($dg['PASSWORD_DG']) ?></td>
                        <td><?= htmlspecialchars($dg['EMAIL_DG']) ?></td>
                        <td><?= htmlspecialchars($dg['STT_THETV']) ?></td>
                        <td><?= htmlspecialchars($dg['NGAYSINH_DG']) ?></td>
                        <td>
                            <a style="float: left;" class="nav-link col" href="/admin/thaotac/delete_docgia/?id=<?= $dg['USERNAME_DG'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?');">Xóa</a>
                        </td>
                    </tr>

                <?php endforeach; ?>

            </tbody>
        </table>


    </main>

    <!-- Footer -->
    <?php require __DIR__ . '/../../../src/partials/footer.php' ?>
</body>

</body>

</html>