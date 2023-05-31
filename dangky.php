<?php include './inc/handle.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/dangnhap.css">
    <link rel="stylesheet" href="assets/css/base.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/grid.css">
    <link rel="stylesheet" href="assets/font/themify-icons/themify-icons.css">
    <link rel="shortcut icon" href="assets/img/favicon_created_by_logaster.ico" type="image/x-icon">
    <title>ลงทะเบียน</title>
</head>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $insertProduct = $user->insert_user($_POST);
}
?>

<body>
    <!-- Phần header -->
    <?php include 'inc/header.php' ?>
    <div class="app">
        <div class="grid wide">
            <div class="app_content-all">
                <div class="row">
                    <div class="auth__form-header">
                        <h2>ลงทะเบียน</h2>
                    </div>
                </div>
                <form action="" method="post" class="auth__form-form">
                    <div class="row">
                        <div class="col c-6">
                            <div class="auth__form">
                                <div class="auth__form-container">
                                    <div class="auth__form-container-title"> </div>
                                    <div class="row">
                                        <div class="auth__form-group col c-6 ">
                                            <div class="auth__form-group-title">
                                                <span>ชื่อ - นามสกุล</span>
                                                <span style="color: red;">*</span>
                                            </div>
                                            <input type="text" name="name" class="auth__form-input" placeholder="">
                                        </div>
                                        <div class="auth__form-group col c-6">
                                            <div class="auth__form-group-title">
                                                <span>อีเมล</span>
                                                <span style="color: red;">*</span>
                                            </div>
                                            <input type="text" name="email" class="auth__form-input" placeholder="">
                                        </div>
                                        <div class="auth__form-group col c-6">
                                            <div class="auth__form-group-title">
                                                <span>เบอร์โทรศัพท์</span>
                                                <span style="color: red;">*</span>
                                            </div>
                                            <input type="text" name="phone" maxlength="10" class="auth__form-input" placeholder="">
                                        </div>
                                        <div class="auth__form-group col c-6">
                                            <div class="auth__form-group-title">
                                                <span>เพศ</span>
                                                <span style="color: red;">*</span>
                                            </div>
                                            <input type="text" name="sex" class="auth__form-input" placeholder="">
                                        </div>
                                        <div class="auth__form-group col c-6">
                                            <div class="auth__form-group-title">
                                                <span>วันเกิด</span>
                                                <span style="color: red;">*</span>
                                            </div>
                                            <input type="text" name="date" class="auth__form-input" placeholder="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="auth__form-group col c-12">
                                            <div class="auth__form-group-title">
                                                <span>ที่อยู่</span>
                                                <span style="color: red;">*</span>
                                            </div>
                                            <textarea name="address" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col c-6">
                            <div class="auth__form-container-title"> </div>
                            <div class="row">
                                <div class="auth__form-group col c-12 ">
                                    <div class="auth__form-group-title">
                                        <span>ชื่อผู้ใช้งาน</span>
                                        <span style="color: red;">*</span>
                                    </div>
                                    <input type="text" name="username" class="auth__form-input" placeholder="">
                                </div>
                                <div class="auth__form-group col c-12 ">
                                    <div class="auth__form-group-title">
                                        <span>รหัสผ่าน</span>
                                        <span style="color: red;">*</span>
                                    </div>
                                    <input type="password" name="password" class="auth__form-input" placeholder="">
                                </div>
                                <div class="auth__form-group col c-12 ">
                                    <div class="auth__form-group-title">
                                        <span>ยืนยันรหัสผ่าน</span>
                                        <span style="color: red;">*</span>
                                    </div>
                                    <input type="password" name="relyPassword" class="auth__form-input" placeholder="">
                                </div>
                                <div class="auth__form-group col c-12 ">
                                    <select class="auth__form-input" id="select" name="category">
                                        <option>คำถามยืนยันตัวตน</option>
                                        <option>คุณแอบชอบใคร ?</option>
                                        <option>ชื่อบิดาของคุณ ?</option>
                                        <option>หมายเลขบัญชีของคุณ ?</option>
                                        <option>อาหารที่คุณชอบ ?</option>
                                    </select>
                                    <input type="" name="cauHoiBiMat" class="auth__form-input" placeholder="คำตอบของคุณ">
                                </div>
                            </div>
                            <div class="baoloi">
                                <?php
                                if (isset($insertProduct)) {
                                    echo $insertProduct;
                                }
                                ?>
                            </div>
                            <input type="submit" name="submit" value="สมัครสมาชิก" class="btn btn-login mt-16">
                            <div style="text-align: right ; padding: 15px 0;">
                                <a href="login.php" style="color: #221f20;font-family: var(--font-family-sans-serif);margin: 24px;">เข้าสู่ระบบ</a>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php include './inc/footer.php' ?>
    </div>
</body>

</html>