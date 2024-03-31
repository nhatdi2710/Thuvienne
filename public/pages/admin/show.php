<?php
// Đưa vào tệp kết nối cơ sở dữ liệu
require __DIR__ . '/../../../src/db/db_connect.php';
session_start();

// Cố gắng truy vấn bảng cơ sở dữ liệu và lấy dữ liệu
try {
    $query_sach = "
        SELECT SACH.TEN_SACH, TAC_GIA.TEN_TG, THE_LOAI.TEN_TL, NHA_XUAT_BAN.TEN_NXB, SACH.TGXB, SACH.TINHTRANG
        FROM SACH
        JOIN TAC_GIA ON SACH.MA_TG = TAC_GIA.MA_TG
        JOIN THE_LOAI ON SACH.STT_THELOAI = THE_LOAI.STT_THELOAI
        JOIN NHA_XUAT_BAN ON SACH.MA_NXB = NHA_XUAT_BAN.MA_NXB
    ";
    $stmt_sach = $pdo->query($query_sach);

    // Lấy tất cả các bản ghi
    $sachs = $stmt_sach->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
    exit();
}

try {
    $query_qtv = "
        SELECT *
        FROM tk_quantrivien
        join   phanloai_taikhoan on tk_quantrivien.TEN_LOAI= phanloai_taikhoan.TEN_LOAI

    ";
    $stmt_qtv = $pdo->query($query_qtv);

    // Lấy tất cả các bản ghi
    $qtvs = $stmt_qtv->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
    exit();
}

try {
    $query_dg = "
    SELECT  tk_docgia.TEN_DG, 
            tk_docgia.EMAIL_DG, 
            tk_docgia.USERNAME_DG, 
            the_thu_vien.STT_THETV, 
            tk_docgia.NGAYSINH_DG, 
            tk_docgia.PASSWORD_DG 
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
    <h3>Chào, <?= $_SESSION['username_qtv']; ?></h3>
    <h2>Danh Sách Tất Cả Sách</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Sách - Tác giả</th>
                <th>Thể loại</th>
                <th>Nhà xuất bản</th>
                <th>Năm xuất bản</th>
                <th>Tình trạng</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sachs as $sach) : ?>
                <tr>
                    <td><?= htmlspecialchars($sach['TEN_SACH']) ?> - <?= htmlspecialchars($sach['TEN_TG']) ?></td>
                    <td><?= htmlspecialchars($sach['TEN_TL']) ?></td>
                    <td><?= htmlspecialchars($sach['TEN_NXB']) ?></td>
                    <td><?= htmlspecialchars($sach['TGXB']) ?></td>
                    <td>
                        <?php
                            if ($sach['TINHTRANG'] == 1)
                                echo "Trên kệ";
                            else
                                echo "Đang cho mượn";
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2 style="margin-top: 60px;">Danh Sách Các Quản Trị Viên</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Tên Quản Trị Viên</th>
                    <th>Tên Đăng Nhập</th>
                    <th>Mật Khẩu</th>
                    <th>Email</th>
                    <th>Ngày Sinh</th>
                    

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
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    
    <h2 style="margin-top: 60px;">Danh Sách Các Độc Giả</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Tên độc giả</th>
                <th>Email</th>
                <th>Username</th>
                <th>Số thẻ</th>
                <th>Ngày sinh</th>
                <th>mật khẩu</th>
            </tr>
        </thead>
        
        <tbody>
            <?php foreach ($docgias as $docgia) : ?>
                <tr>
                    <td><?= htmlspecialchars($docgia['TEN_DG']) ?></td>
                    <td><?= htmlspecialchars($docgia['EMAIL_DG']) ?></td>
                    <td><?= htmlspecialchars($docgia['USERNAME_DG']) ?></td>
                    <td><?= htmlspecialchars($docgia['STT_THETV']) ?></td>
                    <td><?= htmlspecialchars($docgia['NGAYSINH_DG']) ?></td>
                    <td><?= htmlspecialchars($docgia['PASSWORD_DG']) ?></td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<!-- Footer -->
<?php require __DIR__ . '/../../../src/partials/footer.php' ?>
</body>

</html>