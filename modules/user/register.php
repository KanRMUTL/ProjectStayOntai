<div class="block-page">
    <div class="container">
        <?PHP include 'include/header.php'; ?>


        <h1 class="title-page text-center">สมัครสมาชิก</h1>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="form_all">
                    <form role="form" action="process/register_process.php" method="post"
                          enctype="multipart/form-data">

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label>คำนำหน้า</label><span style="color:red;font-weight:bold">*</span>
                                    <select name="user_titlename" class="form-control" required>
                                        <option value="นาย">นาย</option>
                                        <option value="นาง">นาง</option>
                                        <option value="นางสาว">นางสาว</option>
                                    </select>
                                </div>

                                <div class="col-md-5">
                                    <label>ชื่อ</label><span style="color:red;font-weight:bold">*</span>
                                    <input type="text" class="form-control" name="name" value=""
                                           required>
                                </div>

                                <div class="col-md-5">
                                    <label>นามสกุล</label><span style="color:red;font-weight:bold">*</span>
                                    <input type="text" class="form-control" name="lastname"
                                           value="" required>
                                </div>
                            </div>


                        </div>


                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-6">
                                    <label>อีเมล์</label><span style="color:red;font-weight:bold">*</span>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                                <div class="col-md-6">
                                    <label>รหัสผ่าน</label><span style="color:red;font-weight:bold">*</span>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>วันเกิด</label><span style="color:red;font-weight:bold">*</span>
                                    <input type="date" class="form-control" name="birth" required>
                                </div>
                                <div class="col-md-6">
                                    <label>เบอร์โทร</label><span style="color:red;font-weight:bold">*</span>
                                    <input type="text" class="form-control numberOnly" name="tel"
                                           maxlength="10" required>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>ที่อยู่ (บ้านเลขที่ / หมู่ / อื่นๆ)</label>
                                    <textarea class="form-control" rows="2" name="address"
                                              required></textarea>
                                </div>
                            </div>

                        </div>


                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>จังหวัด</label><span style="color:red;font-weight:bold">*</span>
                                    <?PHP
                                    $sql = "SELECT * FROM tb_provinces";
                                    $list = result_array($sql);
                                    ?>

                                    <select name="provinces" class="form-control" required>
                                        <option disabled selected value="">เลือกจังหวัด</option>
                                        <?PHP foreach ($list as $_list) { ?>
                                            <option value="<?= $_list['province_id']; ?>"><?= $_list['name_in_thai']; ?></option>
                                        <?PHP } ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>อำเภอ</label><span style="color:red;font-weight:bold">*</span>
                                    <select name="districts" class="form-control" required>
                                        <option disabled selected value="">ไม่พบข้อมูล</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>ตำบล</label><span style="color:red;font-weight:bold">*</span>
                                    <select name="subdistricts" class="form-control" required>
                                        <option disabled selected value="">ไม่พบข้อมูล</option>
                                    </select>
                                </div>
                            </div>
                        </div>



                        <div class="form-group">
                            <label>รูปภาพประจำตัว</label>
                            <input type="file" class="form-control" accept="image/*" name="img">
                        </div>

                        <p align="center">
                            <button type="submit" class="btn btn-primary">ยืนยันการสมัครสมาชิก</button>
                            <a href="index.php?module=user&action=login" class="btn btn-warning">เข้าสู่ระบบ</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function () {
        $(document).ready(function () {

            $("select[name='provinces']").change(function () {
                var id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "ajax/get_districts.php",
                    cache: false,
                    data: {
                        id: id
                    },
                    success: function (list) {
                        $("select[name='districts']").empty();
                        $("select[name='districts']").append(list);

                    }
                });
            });

            $("select[name='districts']").change(function () {
                var id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "ajax/get_subdistricts.php",
                    cache: false,
                    data: {
                        id: id
                    },
                    success: function (list) {
                        $("select[name='subdistricts']").empty();
                        $("select[name='subdistricts']").append(list);

                    }
                });
            });
        });
    });
</script>
