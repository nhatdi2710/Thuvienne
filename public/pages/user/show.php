<?php
    session_start();
    // Đưa vào tệp kết nối cơ sở dữ liệu
    require __DIR__ . '/../../../src/db/db_connect.php';

    // Cố gắng truy vấn bảng cơ sở dữ liệu và lấy dữ liệu
    try {
        $query_sach = "
            SELECT SACH.MA_SACH, SACH.TEN_SACH, TAC_GIA.TEN_TG, THE_LOAI.TEN_TL, NHA_XUAT_BAN.TEN_NXB, SACH.TINHTRANG
            FROM SACH
            JOIN TAC_GIA ON SACH.MA_TG = TAC_GIA.MA_TG
            JOIN THE_LOAI ON SACH.STT_THELOAI = THE_LOAI.STT_THELOAI
            JOIN NHA_XUAT_BAN ON SACH.MA_NXB = NHA_XUAT_BAN.MA_NXB
            WHERE SACH.TINHTRANG = 1
        ";
        $stmt_sach = $pdo->query($query_sach);

        // Lấy tất cả các bản ghi
        $sachs = $stmt_sach->fetchAll(PDO::FETCH_ASSOC);
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
<?php require __DIR__ . '/../../../src/partials/sub-header--user.php' ?>

<main class="container mt-4">
    <h3>Chào, <?= $_SESSION['username_dg']; ?></h3>

    <form id="search-box" method="GET" class="mt-4">
        <div class="input-group mb-3">
            <input type="text" name="q" class="form-control" placeholder="Nhập vào tên sách cần tìm..." aria-describedby="button-addon2">
            <button class="btn btn-secondary" type="submit" id="button-addon2"><img height="16px" src="/imgs/icons/loupe.png" alt="search-icon"></button>
        </div>

    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Sách - Tác giả</th>
                <th>Thể loại</th>
                <th>Nhà xuất bản</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sachs as $sach) : ?>
                <tr>
                    <td><?= htmlspecialchars($sach['TEN_SACH']) ?> - <?= htmlspecialchars($sach['TEN_TG']) ?></td>
                    <td><?= htmlspecialchars($sach['TEN_TL']) ?></td>
                    <td><?= htmlspecialchars($sach['TEN_NXB']) ?></td>
                    <td><a href="/user/thaotac/danhdau/?id=<?= $sach['MA_SACH']; ?>" class="nav-link" onclick="return alert('Đã được đánh dấu');">Đánh dấu</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</main>

<!-- Footer -->
<?php require __DIR__ . '/../../../src/partials/footer.php' ?>
</body>

</html>