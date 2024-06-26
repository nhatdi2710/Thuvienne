<?php
session_start();
// Đưa vào tệp kết nối cơ sở dữ liệu
require __DIR__ . '/../../../src/db/db_connect.php';

try {
    $query_dg = "
    SELECT  tk_docgia.TEN_DG, 
            tk_docgia.USERNAME_DG, 
            the_thu_vien.STT_THETV
    FROM TK_DOCGIA
    JOIN the_thu_vien ON tk_docgia.STT_THETV = the_thu_vien.STT_THETV
    JOIN PHANLOAI_TAIKHOAN ON tk_docgia.TEN_LOAI = PHANLOAI_TAIKHOAN.TEN_LOAI;
    ";
    $stmt_dg = $pdo->query($query_dg);

    // Lấy tất cả các bản ghi
    $docgias = $stmt_dg->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
    exit();
}try {
    $stmt_dg = $pdo->prepare('SELECT  tk_docgia.TEN_DG, tk_docgia.USERNAME_DG
        FROM TK_DOCGIA, DANH_DAU
        WHERE tk_docgia.USERNAME_DG = DANH_DAU.USERNAME_DG;'
    );
    $stmt_dg->execute();

    // Lấy tất cả các bản ghi
    $docgias = $stmt_dg->fetchAll(PDO::FETCH_ASSOC);
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
    <h3>Chào, <?= $_SESSION['username_qtv']; ?></h3>
    <h2>Danh Sách Độc Giả Đang Yêu Cầu Mượn</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Username</th>
                <th>Tên độc giả</th>
                <th>Thao Tác</th>
            </tr>
        </thead>
        
        <tbody>
            <?php foreach ($docgias as $docgia) : ?>
                <tr>
                    <td><?= htmlspecialchars($docgia['USERNAME_DG']) ?></td>
                    <td><?= htmlspecialchars($docgia['TEN_DG']) ?></td>
                    <td><a class="nav-link" href="/pages/admin/phieumuon.php">Xuất phiếu</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<!-- Footer -->
<?php require __DIR__ . '/../../../src/partials/footer.php' ?>
</body>

</html>