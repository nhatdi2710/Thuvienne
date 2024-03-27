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
    case '/admin/add':
        require __DIR__ . '/pages/admin/add.php';
        break;
    case '/admin/delete':
        require __DIR__ . '/pages/admin/add.php';
        break;
    case '/admin/edit':
        require __DIR__ . '/pages/admin/add.php';
        break;
    case '/admin/show':
        require __DIR__ . '/pages/admin/add.php';
        break;

    // Dành cho USER
    case '/user/show':
        require __DIR__ . '/pages/user/show.php';
    case '/user/muon':
        require __DIR__ . '/pages/user/muon.php';
    
    // Lỗi
    default:
        http_response_code(404);
        break;
}