<?php
// Đưa vào tệp kết nối cơ sở dữ liệu PDO
require __DIR__ . '/../../../src/db/db_connect.php';

// Kiểm tra xem ID sách đã được cung cấp qua URL hay chưa
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Chuẩn bị truy vấn SQL để xóa sách
        $query = "DELETE FROM SACH WHERE MA_SACH = :id";
        $stmt = $pdo->prepare($query);

        // Ràng buộc giá trị vào với placeholder
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Thực thi truy vấn
        $stmt->execute();

        // Kiểm tra xem có sách nào được xóa không
        if ($stmt->rowCount() > 0) {
            echo "<p>Sách với ID $id đã được xóa thành công.</p>";
        } else {
            echo "<p>Không tìm thấy sách với ID $id để xóa.</p>";
            exit;
        }
    } catch (PDOException $e) {
        die("Có lỗi xảy ra khi xóa sách: " . $e->getMessage());
    }
} else {
    echo "<p>ID sách không được cung cấp hoặc không hợp lệ.</p>";
    exit;
}

// Đóng kết nối cơ sở dữ liệu
$pdo = null;

// Cung cấp một liên kết để quay lại trang quản lý sách
echo '<a class="nav-link" href="/admin/trangchu">Quay lại danh sách sách</a>';
