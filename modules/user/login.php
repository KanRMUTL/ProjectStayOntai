<div class="block-page">
    <div class="container">
        <?PHP include 'include/header.php'; ?>


        <h1 class="title-page text-center">เข้าสู่ระบบ</h1>

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="form_all">
                    <form role="form" action="process/check_login.php" method="post"
                          enctype="multipart/form-data">




                        <div class="form-group">
                            <label>อีเมล์</label>
                            <input type="email" class="form-control" name="email"
                                   value="" required>
                        </div>

                        <div class="form-group">
                            <label>รหัสผ่าน</label>
                            <input type="password" class="form-control" name="password"
                                   value="" required>
                        </div>



                        <p align="center">
                            <button type="submit" class="btn btn-primary">ยืนยันการเข้าสู่ระบบ</button>
                            <a href="index.php?module=user&action=register" class="btn btn-warning">สมัครสมาชิก</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



