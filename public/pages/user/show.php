<?php
    session_start();
    // Đưa vào tệp kết nối cơ sở dữ liệu
    require __DIR__ . '/../../../src/db/db_connect.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['keyword'])) {
        $keyword = $_POST['keyword'];
        $sql = "CALL timKiemSach(?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$keyword]);
       
    } 
    else {
        // Nếu không có yêu cầu sắp xếp, hiển thị thông tin sách bình thường
        $sql = "CALL hthiSach()";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    }

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <div class="row mb-3">
        <div class="col d-flex justify-content-center ">
            <form class="input-group mb-3" method="post">
                <input class="form-control" type="text" id="keyword" placeholder="Nhập tên sách" name="keyword">
                <button class="btn btn-secondary" type="submit">Tìm kiếm</button>
            </form>
        </div>
    </div>
    <!-- <div class="row mb-3">
        <div class="col d-flex justify-content-end">
            <form method="post">
                <button class="btn btn-secondary" type="submit" name="sort">
                    Sắp xếp
                </button>
            </form>
        </div>
    </div> -->
    <div class="row">
        <div class="col">


            <table class="table">
                <thead>
                    <tr>
                        <th>Mã sách</th>
                        <th>Tên sách</th>
                        <th>Tác giả</th>
                        <th>Thể loại</th>
                        <th>Nhà xuất bản</th>
                        <th>Năm xuất bản</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row) : ?>

                        <tr>
                            <td><?= htmlspecialchars($row['MA_SACH']) ?></td>
                            <td><?= htmlspecialchars($row['TEN_SACH']) ?></td>
                            <td><?= htmlspecialchars($row['TacGia']) ?></td>
                           
                            <td><?= htmlspecialchars($row['TheLoai']) ?></td>
                            <td><?= htmlspecialchars($row['NhaXuatBan']) ?></td>
                            <td><?= htmlspecialchars($row['NamXuatBan']) ?></td>

                        </tr>


                    <?php endforeach ?>
                </tbody>
            </table>


        </div>
    </div>
</main>

<!-- Footer -->
<?php require __DIR__ . '/../../../src/partials/footer.php' ?>
</body>

</html>