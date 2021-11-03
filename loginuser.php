<?php
include 'classes/customer.php';
$login = new customer(); // Khai báo class
if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['login'])){
    //lấy dữ liệu từ ô input
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    //gọi hàm login để xử lý đăng nhập
    $checklogin = $login->login_user($email,$password);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Đăng nhập</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="admin/image/png" href="images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="admin/css/login/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="admin/css/login/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="admin/css/login/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="admin/css/login/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="admin/css/login/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="admin/css/login/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="admin/css/login/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="admin/css/login/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="admin/css/login/util.css">
    <link rel="stylesheet" type="text/css" href="admin/css/login/main.css">
    <!--===============================================================================================-->
</head>
<body style="background-color: #666666;">

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <form class="login100-form validate-form" method="POST" action="">
					<span class="login100-form-title p-b-43">
						Đăng nhập để tiếp tục
					</span>


                <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                    <input class="input100" type="text" name="email">
                    <span class="focus-input100"></span>
                    <span class="label-input100">Email</span>
                </div>


                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <input class="input100" type="password" name="password">
                    <span class="focus-input100"></span>
                    <span class="label-input100">Mật khẩu</span>
                </div>

                <div class="flex-sb-m w-full p-t-3 p-b-32">
                    <div class="contact100-form-checkbox">
                        <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                        <label class="label-checkbox100" for="ckb1">
                            Nhớ mật khẩu
                        </label>
                    </div>

                    <div>
                        <a href="#" class="txt1">
                            Quên mật khẩu?
                        </a>
                    </div>
                </div>


                <div class="container-login100-form-btn">
                    <input class="login100-form-btn" type="submit" name="login" value="Đăng nhập"/>
                </div>
                <div class="text-center p-t-46 p-b-20">
						<span class="txt2">
							Đăng nhập với
						</span>
                </div>
                <div class="login100-form-social flex-c-m">
                    <a href="#" class="login100-form-social-item flex-c-m bg1 m-r-5">
                        <i class="fa fa-facebook-f" aria-hidden="true"></i>
                    </a>
                    <a href="#" class="login100-form-social-item flex-c-m bg2 m-r-5">
                        <i class="fa fa-twitter" aria-hidden="true"></i>
                    </a>
                </div>
            </form>

            <div class="login100-more" style="background-image: url('admin/images/bg-02.jpg');">
            </div>
        </div>
    </div>
</div>





<!--===============================================================================================-->
<script src="admin/js/login/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="admin/js/login/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="admin/s/login/popper.js"></script>
<script src="admin/js/login/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="admin/js/login/select2.min.js"></script>
<!--===============================================================================================-->
<script src="admin/js/login/moment.min.js"></script>
<script src="admin/js/login/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="admin/js/login/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="admin/js/login/main.js"></script>

</body>
</html>