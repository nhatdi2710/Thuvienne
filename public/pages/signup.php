<?php
$name = $username =  $email = $date = $password = $confirm_password = "";
$name_err = $username_err = $email_err = $date_err = $password_err = $confirm_password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["fname"]))) {
        $name_err = "Please enter your name";
    } else {
        $name = trim($_POST["fname"]);
    }

    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter your username";
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
    }

    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm your password";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match! Please try again.";
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
                                <input class="input" type="text" id="name" name="fname" placeholder="Nhập họ và tên">
                                <span class="symbol-input">
                                    <img src="/imgs/icons/name.png" alt="Name-icon">
                                </span>
                                <p class='error'><?= $name_err?></p>
                            </div>

        
                            <div class="wrap-input validate-input mt-4">
                                <input class="input" type="email" id='email' name="email" placeholder="Nhập E-mail của bạn">
                                <span class="focus-input"></span>
                                <span class="symbol-input">
                                    <img src="/imgs/icons/email.png" alt="Email">
                                </span>
                                <p class='error'><?= $email_err?></p>
                            </div>

                            <div class="wrap-input validate-input mt-4">
                                    <input style="width: 276px;" class="input" type="date" id="date" name="date">
                                    <span class="focus-input"></span>
                            </div>

                            <div class="wrap-input validate-input mt-4">
                                    <input class="input" type="text" id="username" name="username" placeholder="Tài khoản">
                                    <span class="focus-input"></span>
                                    <span class="symbol-input">
                                        <img src="/imgs/icons/user.png" alt="Username">
                                    </span>
                                    <p class='error'><?php echo $username_err?></p>
                                </div>
        
                                <div class="wrap-input validate-input mt-4">
                                    <input class="input" type="password" id='password' name="password" placeholder="Mật khẩu">
                                    <span class="focus-input"></span>
                                    <span class="symbol-input">
                                        <img src="/imgs/icons/padlock.png" alt="Password">
                                    </span>
                                    <p class='error'><?php echo $password_err?></p>
                                </div>
        
                                <div class="wrap-input validate-input mt-4">
                                    <input class="input" type="password" id='confirm_password' name="confirm-password"
                                        placeholder="Xác nhận lại mật khẩu">
                                    <span class="focus-input"></span>
                                    <span class="symbol-input">
                                        <img src="/imgs/icons/padlock.png" alt="Confirm Password">
                                    </span>
                                    <p class='error'><?php echo $confirm_password_err?></p>
                                </div>

                                <div class="wrap-input validate-input mt-4">
                                        <span class="classify">Loại tài khoản bạn muốn Đăng Ký:</span>
                                        <span>
                                            <input type="radio" name="classify" id="patron"  value="nguoidung" checked>
                                            <label for="patron">
                                                Người dùng
                                            </label>
                                        </span>
                                        <br>
                                        <span>
                                            <input type="radio" name="classify" id="admin" value="quantrivien">
                                            <label for="admin">
                                                Quản trị viên
                                            </label>
                                        </span>
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