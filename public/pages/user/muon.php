<!-- Thực hiện gửi yêu cầu Mượn Sách -->
<?php
    session_start();
    // Đưa vào tệp kết nối cơ sở dữ liệu
    require __DIR__ . '/../../../src/db/db_connect.php';

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
        $_SESSION['ngay_muon'] = $_POST['ngay_muon'];
        $_SESSION['ngay_hentra'] = $_POST['ngay_hentra'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<!-- Header -->
<?php require __DIR__ . '/../../../src/partials/header.php' ?>

<body>
<!-- Sub-Header -->
<?php require __DIR__ . '/../../../src/partials/sub-header--user.php' ?>

<main class="container mt-4">
    <h3>Chào, <?= $_SESSION['username_dg']; ?></h3>
    <h2>Sách Đã Được Bạn Đánh Dấu:</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Sách</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sachs as $sach) : ?>
                <tr>
                    <td><?= htmlspecialchars($sach['TEN_SACH']) ?></td>
                    <td><a href="/user/thaotac/delete" class="nav-link">Xóa</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <form method="post">
        <div class="row">
            <div class="form-group col">
                <label for="ngay_muon">Ngày mượn:</label>
                <input type="date" class="form-control" id="ngay_muon" name="ngay_muon" required>
            </div>

            <div class="form-group col">
                <label for="ngay_hentra">Ngày hẹn trả:</label>
                <input type="date" class="form-control" id="ngay_hentra" name="ngay_hentra" required>
            </div>
        </div>

        <button type="submit" class="btn btn-secondary mt-4">Gửi yêu cầu mượn</button>
    </form>

</main>

<!-- Footer -->
<?php require __DIR__ . '/../../../src/partials/footer.php' ?>

</body>

</html>