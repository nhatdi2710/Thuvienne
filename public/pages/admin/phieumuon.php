<?php
    session_start();

    // Ngày lập phiếu - hiện tại
    $t = time();

    // Đưa vào tệp kết nối cơ sở dữ liệu
    require __DIR__ . '/../../../src/db/db_connect.php';
    require __DIR__ . '/../../../src/functions.php';

    try {
        $stmt_sach = $pdo->prepare('SELECT SACH.TEN_SACH FROM SACH, DANH_DAU WHERE SACH.MA_SACH = DANH_DAU.MA_SACH AND DANH_DAU.USERNAME_DG like ?');
        $stmt_sach->execute([$_SESSION['username_dg']]);
        // Lấy tất cả các bản ghi
        $sachs = $stmt_sach->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $stmt = $pdo->prepare('DELETE FROM DANH_DAU WHERE USERNAME_DG = ?');
        $stmt->execute([$_SESSION['username_dg']]);

        redirect('/admin/trangchu');
    }
?>
<!DOCTYPE html>
<html lang="en">

<!-- Header -->
<?php require __DIR__ . '/../../../src/partials/header.php' ?>

<body>
    <main class="container mt-4">
        <h2 class="text-center">
            <img height="36px" src="/imgs/icons/main-logo.png" alt="">
            <br>
            PHIẾU MƯỢN
        </h2>

        <form method="POST">
            <div class="row mt-4">
                <div class="col text-center">
                    Số phiếu: <input type="number" id="so_phieu">
                </div>

                <div class="col text-center">
                    <p>Ngày lập: <?= date("d-m-Y",$t) ?></p>
                </div>
            </div>

            <h4 class="mt-4">Chi tiết phiếu:</h4>
            <p>Tài khoản mượn: <?= $_SESSION['username_dg']; ?></p>
            <p>Ngày mượn: <?= $_SESSION['ngay_muon'] ?></p>
            <p>Ngày hẹn trả: <?= $_SESSION['ngay_hentra'] ?> </p>

            <h4 class="mt-4">Danh sách mượn:</h4>
            <table style="min-height: 120px;" class="table">
                <thead>
                    <tr>
                        <th>Sách</th>
                        <th>Ngày trả</th>
                        <th>Tình trạng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sachs as $sach) : ?>
                    <tr>
                        <td><?= htmlspecialchars($sach['TEN_SACH']) ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="row">
                <div class="col text-center">
                    <p style="min-height: 120px;"><b>Người mượn</b></p>
                    <p>Ký và ghi rõ họ tên</p>
                </div>

                <div class="col text-center">
                    <p style="min-height: 120px;"><b>Người lập phiếu</b></p>
                    <p>Ký và ghi rõ họ tên</p>
                </div>
            </div>

            <div class="text-center">
                <button class="btn btn-light">In</button>
            </div>
        </form>
        
    </main>

    <!-- Footer -->
    <?php require __DIR__ . '/../../../src/partials/footer.php' ?>
</body>
</html>