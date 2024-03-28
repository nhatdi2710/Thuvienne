<?php 
$req = $_SERVER['REQUEST_URI'];
    
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
    case '/admin/delete/?id=' . $_GET['id']:
        require __DIR__ . '/pages/admin/delete.php';
        break;

    // Dành cho USER
    case '/user/trangchu':
        require __DIR__ . '/pages/user/show.php';
    case '/user/muon':
        require __DIR__ . '/pages/user/muon.php';
    
    // Lỗi
    default:
        http_response_code(404);
        break;
}