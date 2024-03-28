<?php
// Đưa vào tệp kết nối cơ sở dữ liệu
require __DIR__ . '/../../../src/db/db_connect.php';

// Cố gắng truy vấn bảng cơ sở dữ liệu và lấy dữ liệu
try {
    $query = "
        SELECT SACH.MA_SACH, SACH.TEN_SACH, TAC_GIA.TEN_TG, THE_LOAI.TEN_TL, NHA_XUAT_BAN.TEN_NXB, SACH.TGXB
        FROM SACH
        JOIN TAC_GIA ON SACH.MA_TG = TAC_GIA.MA_TG
        JOIN THE_LOAI ON SACH.STT_THELOAI = THE_LOAI.STT_THELOAI
        JOIN NHA_XUAT_BAN ON SACH.MA_NXB = NHA_XUAT_BAN.MA_NXB
    ";
    $stmt = $pdo->query($query);

    // Lấy tất cả các bản ghi
    $sachs = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        <h2>Quản Lý Sách</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Sách</th>
                    <th>Tác Giả</th>
                    <th>Thể Loại</th>
                    <th>Nhà Xuất Bản</th>
                    <th>Ngày Xuất Bản</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sachs as $sach) : ?>
                    <tr>
                        <td><?= htmlspecialchars($sach['TEN_SACH']) ?></td>
                        <td><?= htmlspecialchars($sach['TEN_TG']) ?></td>
                        <td><?= htmlspecialchars($sach['TEN_TL']) ?></td>
                        <td><?= htmlspecialchars($sach['TEN_NXB']) ?></td>
                        <td><?= htmlspecialchars($sach['TGXB']) ?></td>
                        <td>
                            <a href="#">Sửa</a>
                        </td>
                        <td>
                            <a href="/admin/delete/?id=<?= $sach['MA_SACH'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?');">Xóa</a>

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