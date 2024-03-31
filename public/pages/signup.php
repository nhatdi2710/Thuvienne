<?php
require 'D:/hệ quan tri co sơ dư liệu/Thuvienne/src/db/db_connect.php';

$name = $username =  $email = $date = $password = $confirm_password = "";
$name_err = $username_err = $email_err = $date_err = $password_err = $confirm_password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["fname"]))) {
        $name_err = "Hãy điền Họ và Tên vào";
    } else {
        $name = trim($_POST["fname"]);
    }

    if (empty(trim($_POST["username"]))) {
        $username_err = "Hãy điền Tài Khoản vào";
    } else {
        $username = trim($_POST["username"]);
    }

    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email address.";
    } else {
        if (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
            $email_err = "Invalid email! Please enter a valid email address";
        } else {
            $email = trim($_POST["email"]);
        }
    }

    if (empty(trim($_POST["date"]))) {
        $date_err = "Please choose your birthday.";
    } else {
        $date = trim($_POST["date"]);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } elseif (strlen(trim($_POST["password"])) < 8) {
        $password_err = "Password length must be greater than 8 characters";
    } else {
        $password = trim($_POST["password"]);
        // Đổi dòng này để tránh lỗi nếu không có biến này được gửi từ form
        $confirm_password = isset($_POST["confirm_password"]) ? trim($_POST["confirm_password"]) : null;
        if ($password != $confirm_password) {
            $confirm_password_err = "Mật khẩu không khớp.";
        }
    }

    // if (empty(trim($_POST["confirm_password"]))) {
    //     $confirm_password_err = "Please confirm your password";
    // } else {
    //     $confirm_password = trim($_POST["confirm_password"]);
    //     if (empty($password_err) && ($password != $confirm_password)) {
    //         $confirm_password_err = "Mật khẩu không khớp.";
    //     }
    // }




    // Điều kiện kiểm tra tất cả dữ liệu đầu vào đã hợp lệ
    if (
        empty($name_err) &&
        empty($username_err) &&
        empty($email_err) &&
        empty($date_err) &&
        empty($password_err) &&
        empty($confirm_password_err)
    ) {
        if ($username !== null && $name !== null && $email !== null && $date !== null && $password !== null && $account_type !== null) {



            // Đoạn mã kiểm tra và chèn dữ liệu vào cơ sở dữ liệu ở đây

            $username = isset($_POST['username']) ? trim($_POST['username']) : null;
            $name = isset($_POST['fname']) ? trim($_POST['fname']) : null;
            $email = isset($_POST['email']) ? trim($_POST['email']) : null;
            $date = isset($_POST['date']) ? trim($_POST['date']) : null;
            $password = isset($_POST['password']) ? trim($_POST['password']) : null;
            $account_type = isset($_POST['classify']) ? $_POST['classify'] : null;


            //$hashed_password = password_hash($password, PASSWORD_DEFAULT); // Mã hóa mật khẩu
            // Kiểm tra xem username đã tồn tại trong cơ sở dữ liệu chưa
            try {
                $pdo->beginTransaction();

                // Kiểm tra trong cả hai bảng tài khoản
                $sql_check_user = "SELECT USERNAME_DG FROM tk_docgia WHERE USERNAME_DG = :username UNION SELECT USERNAME_QTV FROM tk_quantrivien WHERE USERNAME_QTV = :username";
                $stmt_check_user = $pdo->prepare($sql_check_user);
                $stmt_check_user->bindParam(':username', $username, PDO::PARAM_STR);

                $stmt_check_user->execute();

                if ($stmt_check_user->rowCount() > 0) {
                    // Nếu username đã tồn tại
                    echo "Tên đăng nhập này đã được sử dụng. Vui lòng chọn tên khác.";
                } else {
                    // Nếu username chưa tồn tại, chèn vào bảng phù hợp
                    $sql_insert = "INSERT INTO tk_docgia (USERNAME_DG, TEN_LOAI, TEN_DG, EMAIL_DG, NGAYSINH_DG, PASSWORD_DG) VALUES (:username, :account_type, :name, :email, :date, :password)";
                    $stmt_insert = $pdo->prepare($sql_insert);
                    $stmt_insert->bindParam(':username', $username);
                    $stmt_insert->bindParam(':account_type', $account_type);
                    $stmt_insert->bindParam(':name', $name);
                    $stmt_insert->bindParam(':email', $email);
                    $stmt_insert->bindParam(':date', $date);
                    $stmt_insert->bindParam(':password', $password);
                    //$stmt_insert->bindParam(':hashed_password', $hashed_password);
                    $stmt_insert->execute();

                    // Thêm vào bảng the_thu_vien sau khi tài khoản nguoidung được tạo
                    $sql_insert_card = "INSERT INTO the_thu_vien (USERNAME_DG, STT_THETV) VALUES (:username, NULL)"; // Giả sử STT_THETHUVIEN được tự động tạo
                    $stmt_insert_card = $pdo->prepare($sql_insert_card);
                    $stmt_insert_card->bindParam(':username', $username);
                    $stmt_insert_card->execute();

                    echo "Đăng ký thành công!";
                }

                $pdo->commit();
            } catch (Exception $e) {
                $pdo->rollBack();
                echo "Đã xảy ra lỗi: " . $e->getMessage();
            }
        } else {
            echo "Vui lòng nhâp đầy đủ thông tin";
        }
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<!-- Header -->
<?php require __DIR__ . '/../../src/partials/header.php' ?>

<body>

    <!-- Main -->
    <main id="top">
        <article id="app" class="container">
            <div class="sign-pages">
                <center>
                    <form id="signup-form" method="post">
                        <img height="36px" src="/imgs/icons/main-logo.png" alt="">
                        <h2 class="sign-form__title">Thuvienne.</h2>

                        <p class="signup-form__subtitle mt-4">Tạo tài khoản tại đây</p>

                        <div class="signup-form__content">
                            <div class="wrap-input validate-input mt-4">
                                <input class="input" type="text" id="fname" name="fname" placeholder="Nhập họ và tên">
                                <span class="symbol-input">
                                    <img src="/imgs/icons/name.png" alt="Name-icon">
                                </span>
                                <p class='error'><?= $name_err ?></p>
                            </div>


                            <div class="wrap-input validate-input mt-4">
                                <input class="input" type="email" id='email' name="email" placeholder="Nhập E-mail của bạn">
                                <span class="focus-input"></span>
                                <span class="symbol-input">
                                    <img src="/imgs/icons/email.png" alt="Email">
                                </span>
                                <p class='error'><?= $email_err ?></p>
                            </div>

                            <div class="wrap-input validate-input mt-4">
                                <span class="focus-input"></span>
                                <input style="width: 276px;" class="input" type="date" id="date" name="date">
                            </div>

                            <div class="wrap-input validate-input mt-4">
                                <input class="input" type="text" id="username" name="username" placeholder="Tài khoản">
                                <span class="focus-input"></span>
                                <span class="symbol-input">
                                    <img src="/imgs/icons/user.png" alt="Username">
                                </span>
                                <p class='error'><?php echo $username_err ?></p>
                            </div>

                            <div class="wrap-input validate-input mt-4">
                                <input class="input" type="password" id='password' name="password" placeholder="Mật khẩu">
                                <span class="focus-input"></span>
                                <span class="symbol-input">
                                    <img src="/imgs/icons/padlock.png" alt="Password">
                                </span>
                                <p class='error'><?php echo $password_err ?></p>
                            </div>

                            <div class="wrap-input validate-input mt-4">
                                <input class="input" type="password" id='confirm_password' name="confirm_password" placeholder="Xác nhận lại mật khẩu" required>
                                <span class="focus-input"></span>
                                <span class="symbol-input">
                                    <img src="/imgs/icons/padlock.png" alt="Confirm Password">
                                </span>
                                <p class='error'><?php echo $confirm_password_err ?></p>
                            </div>

                            <button class="sign-form__btn mt-4" type="submit">Đăng Ký</button>
                            <div class="container-login-form-btn mt-4">
                            </div>

                            <div class="text-center mt-4">
                                <span>
                                    Bạn đã có tài khoản? <a class="txt2" href="/pages/login.php"><b>Đăng nhập</b></a>
                                </span>
                            </div>

                    </form>
                </center>
            </div>
        </article>
    </main>
    <!-- Footer -->
    <?php require __DIR__ . '/../../src/partials/footer.php' ?>
</body>

</html>