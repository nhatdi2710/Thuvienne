<?php 
$req = $_SERVER['REQUEST_URI'];

// Hiển thị Trang
switch ($req) {
    // Đăng Nhập và Đăng Ký
    case '/':
        require __DIR__ . '/pages/login.php';
        break;
    case '/login.php':
        require __DIR__ . '/pages/login.php';
        break;
    case '/signup.php':
        require __DIR__ . '/pages/signup.php';
        break;

    // Dành cho ADMIN
    case '/admin/trangchu':
        require __DIR__ . '/pages/admin/show.php';
        break;
    case '/admin/quanly':
        require __DIR__ . '/pages/admin/manage_books.php';
        break;
    case '/admin/quanly_admin':
        require __DIR__ . '/pages/admin/manage_admin.php';
        break;
    case '/admin/dsyeucau':
        require __DIR__ . '/pages/admin/dsyeucau.php';
        break;
    // Dành cho USER
    case '/user/trangchu':
        require __DIR__ . '/pages/user/show.php';
        break;
    case '/user/muon':
        require __DIR__ . '/pages/user/muon.php';
        break;
    // Lỗi
    default:
        http_response_code(404);
        break;
}

// Thao Tác trên Trang

    // ADMIN -- Thực hiện Xóa và Sửa Sách
    if (isset($_GET['id']) && $req == '/admin/thaotac/delete/?id=' . $_GET['id']) {
        require __DIR__ . '/pages/admin/delete.php';
    }

    if (isset($_GET['id']) && $req == '/admin/thaotac/edit/?id=' . $_GET['id']) {
        require __DIR__ . '/pages/admin/edit.php';
    }

    // ADMIN -- Thực hiện Thêm Sách
    if ($req == '/admin/thaotac/add')
        require __DIR__ . '/pages/admin/add.php';
    if ($req == '/admin/thaotac/edit')
        require __DIR__ . '/pages/admin/edit.php';
    // admin sửa thông tin các admin
    if (isset($_GET['id']) && $req == '/admin/thaotac/edit_admin/?id=' . $_GET['id']) {
        require __DIR__ . '/pages/admin/edit_admin.php';
    }

    // admin xóa tài khoản admin
    if (isset($_GET['id']) && $req == '/admin/thaotac/delete_admin/?id=' . $_GET['id']) {
        require __DIR__ . '/pages/admin/delete_admin.php';
    }


    // ADMIN -- Thực hiện Thêm Sách
    if ($req == '/admin/thaotac/add')
        require __DIR__ . '/pages/admin/add.php';
    if ($req == '/admin/thaotac/edit')
        require __DIR__ . '/pages/admin/edit.php';

    // admin -- thêm tài khoản qtv
    if ($req == '/admin/thaotac/addadmin')
        require __DIR__ . '/pages/admin/add_admin.php';
    // ---
    
    // USER -- Đánh Dấu Sách muốn Mượn
    if (isset($_GET['id']) && $req == '/user/thaotac/danhdau/?id=' . $_GET['id'] ) {
        require __DIR__ . '/pages/user/danhdau.php';
    }