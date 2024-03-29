<?php
// Đưa vào tệp kết nối cơ sở dữ liệu
require __DIR__ . '/../../../src/db/db_connect.php';

// Cố gắng truy vấn bảng cơ sở dữ liệu và lấy dữ liệu
try {
    $query = "
        SELECT SACH.TEN_SACH, TAC_GIA.TEN_TG, THE_LOAI.TEN_TL, NHA_XUAT_BAN.TEN_NXB, SACH.TGXB
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

<!-- Hiển thị tất cả Sách -->
<!DOCTYPE html>
<html lang="en">
<!-- Header -->
<?php require __DIR__ . '/../../../src/partials/header.php' ?>

<body>
<!-- Sub-Header -->
<?php require __DIR__ . '/../../../src/partials/sub-header--admin.php' ?>

<!-- MAIN -->
<main class="container mt-4">
    <h2>Chào, ...</h2>
    <h2>Danh Sách Các Sách</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Sách</th>
                <th>Tác Giả</th>
                <th>Thể loại</th>
                <th>Nhà xuất bản</th>
                <th>Ngày Xuất Bản</th>
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
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2 class="mt-4">Danh Sách Các Độc Giả</h2>
</main>

<!-- Footer -->
<?php require __DIR__ . '/../../../src/partials/footer.php' ?>
</body>

</html>