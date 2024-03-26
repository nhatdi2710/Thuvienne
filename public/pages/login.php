<!DOCTYPE html>
<html lang="en">
<!-- Header -->
<?php require __DIR__ . '/../../src/partials/header.php' ?>


<body>

<!-- Main -->
<main id="top">    
    <article id="app" class="container">

        <div class="row justify-content-center sign-pages">
            <div class="col-lg-5 login-thumbnail">
                <img height="600px" src="/imgs/login-thumbnail--1.png" alt="">
            </div>

            <form class="col-lg-4" method="post">
                <div class="row login-form">
                    <div class="col">
                        <span class="sign-form__title">
                        - Chào bạn -
                        </span>
                    </div>

                    <div class="col login-form__input mt-4">
                        <div class="wrap-input validate-input mt-4">
                            <input class="input" type="text" name="username" placeholder="Tài khoản">
                            <span class="focus-input"></span>
                            <span class="symbol-input">
                                <img height="16px" src="/imgs/icons/user.png" alt="Username">
                            </span>
                        </div>

                        <div class="wrap-input validate-input mt-4">
                            <input class="input" type="password" name="pass" placeholder="Mật khẩu">
                            <span class="focus-input"></span>
                            <span class="symbol-input">
                                <img height="16px" src="/imgs/icons/padlock.png" alt="Password">
                            </span>
                        </div>

                        <div class="wrap-input mt-4">
                            <button type="submit" class="sign-form__btn">Đăng Nhập</button>
                        </div>

                        <div class="text-center mt-4">
                            <span>
                                Quên <a href="#">Tài khoản / Mật khẩu?</a>
                            </span>          
                        </div>
                    </div>

                    <div class="col-lg-5 login-form__nav-to-signup">
                        <a href="/pages/signup.php">Tạo tài khoản mới</a>
                    </div>
                </div>
            </form>              
        </div>
    </article>
</main>

    <!-- Footer -->
    <?php require __DIR__ . '/../../src/partials/footer.php' ?>
</body>

</html>