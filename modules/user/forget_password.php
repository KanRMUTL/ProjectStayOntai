<div class="block-page">
    <div class="container">
        <?PHP include 'include/header.php'; ?>


        <h1 class="title-page text-center">ลืมรหัสผ่าน</h1>

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="form_all">
                    <form role="form" action="process/forget.php" method="post"
                          enctype="multipart/form-data">




                        <div class="form-group">
                            <label>อีเมล์</label>
                            <input type="email" class="form-control" name="email"
                                   value="" required>
                        </div>

                        <div class="form-group">
                            <label>เบอร์โทรศัพท์</label>
                            <input type="text" class="form-control numberOnly" name="tel"
                                   value="" required>
                        </div>



                        <p align="center">
                            <button type="submit" class="btn btn-primary">ส่งคำขอ</button>
                            <a href="index.php?module=user&action=login" class="btn btn-warning">เข้าสู่ระบบ</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



