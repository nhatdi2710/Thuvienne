<?php
// Đưa vào tệp kết nối cơ sở dữ liệu PDO
require __DIR__ . '/../../../src/db/db_connect.php';
$thongbao = '';
// Kiểm tra xem ID sách đã được cung cấp qua URL hay chưa
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $tendg = '';
    try {
        // lấy tên docgia trước khi xóa.
        $stmt = $pdo->prepare("SELECT TEN_DG FROM tk_docgia WHERE USERNAME_DG = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $tendg = $stmt->fetch(PDO::FETCH_ASSOC)['TEN_DG'];
        } else {
            $thongbao = "<p>Không tìm thấy tên Độc giả với USERNAME_DG $id.</p>";
            echo $thongbao;
            exit;
        }

        // Chuẩn bị truy vấn SQL để xóa sách
        $query = "DELETE FROM tk_docgia WHERE USERNAME_DG = :id";
        $stmt = $pdo->prepare($query);

        // Ràng buộc giá trị vào với placeholder
        $stmt->bindParam(':id', $id);

        // Thực thi truy vấn
        $stmt->execute();

        // Kiểm tra xem có sách nào được xóa không
        if ($stmt->rowCount() > 0) {
            $thongbao = "<p class='success-message'>Tài Khoản: $tendg đã được xóa thành công.</p>";
        } else {
            $thongbao =  "<p>Không tìm thấy sách với username $id để xóa.</p>";
            echo $thongbao;
            exit;
        }
    } catch (PDOException $e) {

        $thongbao = "Có lỗi xảy ra khi xóa sách: " . $e->getMessage();
        die($thongbao);
    }
} else {
    $thongbao = "<p>Username độc giả không được cung cấp hoặc không hợp lệ.</p>";
    echo $thongbao;
    exit;
}

// Đóng kết nối cơ sở dữ liệu
$pdo = null;

?>
<!DOCTYPE html>
<html lang="en">
<!-- Header -->
<?php require __DIR__ . '/../../../src/partials/header.php' ?>

<body>
    <!-- Sub-Header -->
    <?php require __DIR__ . '/../../../src/partials/sub-header--admin.php' ?>

    <main id="delete-page" class="container text-center mt-4">
        <h3 style="color: #86A789;"><?= $thongbao; ?></h3>
        <a class="nav-link" href="/admin/quanly_docgia">Quay lại danh sách quản trị viên</a>
    </main>
</body>

</html>