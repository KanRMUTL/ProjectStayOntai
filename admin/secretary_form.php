<!doctype html>
<html>
<head>
    <?PHP include "include/script.php"; ?>
    <style>
        .form-group {
            overflow: hidden;
        }
    </style>
</head>
<body>


<?PHP include "include/header.php"; ?>

<div class="container main">

    <?PHP include "include/right.php"; ?>


    <?PHP
    $id = "";
    $title = "นาย";
    $check_input = true;
    $disabled = "";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $disabled = "disabled";
    }
    $my = check_secretary($id);

    $country = check_province($my['subdistrict_id']);


    if ($my) {
        $check_input = false;
    }


    if ($my['user_titlename'] != "") {
        $title =  $my['user_titlename'];
    }

    ?>


    <div class="col-sm-9 col-lg-9">
        <div id="register-wraper">
            <div class="form_all">

                <legend>จัดการเลขานุการ</legend>

                <form role="form" action="process/secretary_process.php" method="post"
                      enctype="multipart/form-data">

                    <input type="hidden" name="id" value="<?= $my['user_id']; ?>">

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label>คำนำหน้า</label>
                                <select name="user_titlename" class="form-control" required>
                                    <option <?=$title == 'นาย' ? "นาย":"";?> value="นาย">นาย</option>
                                    <option <?=$title == 'นาง' ? "นาง":"";?> value="นาง">นาง</option>
                                    <option <?=$title == 'นางสาว' ? "นางสาว":"";?> value="นางสาว">นางสาว</option>
                                </select>
                            </div>

                            <div class="col-md-5">
                                <label>ชื่อ</label>
                                <input type="text" class="form-control" name="name" value="<?= $my['user_name']; ?>"
                                       required>
                            </div>

                            <div class="col-md-5">
                                <label>นามสกุล</label>
                                <input type="text" class="form-control" name="lastname"
                                       value="<?= $my['user_lastname']; ?>" required>
                            </div>
                        </div>


                    </div>


                    <div class="form-group">

                        <div class="row">
                            <div class="col-md-6">
                                <label>อีเมล์</label>
                                <input type="email" class="form-control" name="email"
                                       value="<?= $my['user_email']; ?>" <?=$disabled;?> required>
                            </div>
                            <div class="col-md-6">
                                <label>รหัสผ่าน</label>
                                <input type="password" class="form-control" name="password"
                                       value="<?= $my['user_password']; ?>" required>
                            </div>
                        </div>

                    </div>


                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>วันเกิด</label>
                                <input type="date" class="form-control" name="birth" value="<?= $my['user_birth']; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label>เบอร์โทร</label>
                                <input type="text" class="form-control numberOnly" name="tel" value="<?= $my['user_tel']; ?>"
                                       maxlength="10" required>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label>ที่อยู่ (บ้านเลขที่ / หมู่ / อื่นๆ)</label>
                                <textarea class="form-control" rows="2" name="address"
                                          required><?= $my['user_address']; ?></textarea>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>จังหวัด</label>
                                <?PHP
                                $sql = "SELECT * FROM tb_provinces";
                                $list = result_array($sql);
                                ?>

                                <select name="provinces" class="form-control" required>
                                    <option disabled selected value="">เลือกจังหวัด</option>
                                    <?PHP foreach ($list as $_list) { ?>
                                        <option <?= $country['province_id'] == $_list['province_id'] ? "selected" : ""; ?>
                                                value="<?= $_list['province_id']; ?>"><?= $_list['name_in_thai']; ?></option>
                                    <?PHP } ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>อำเภอ</label>

                                <?PHP
                                $sql = "SELECT * FROM tb_districts WHERE province_id = '{$country['province_id']}'";
                                $list = result_array($sql);
                                ?>

                                <select name="districts" class="form-control" required>

                                    <?PHP if ($check_input) { ?>
                                        <option disabled selected value="">ไม่พบข้อมูล</option>
                                    <?PHP } else { ?>
                                        <?PHP foreach ($list as $_list) { ?>
                                            <option <?= $country['district_id'] == $_list['district_id'] ? "selected" : ""; ?>
                                                    value="<?= $_list['district_id']; ?>"><?= $_list['name_in_thai']; ?></option>
                                        <?PHP } ?>
                                    <?PHP } ?>


                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>ตำบล</label>

                                <?PHP
                                $sql = "SELECT * FROM tb_subdistricts WHERE district_id = '{$country['district_id']}'";
                                $list = result_array($sql);
                                ?>

                                <select name="subdistricts" class="form-control" required>

                                    <?PHP if ($check_input) { ?>
                                        <option disabled selected value="">ไม่พบข้อมูล</option>
                                    <?PHP } else { ?>
                                        <?PHP foreach ($list as $_list) { ?>
                                            <option <?= $country['subdistrict_id'] == $_list['subdistrict_id'] ? "selected" : ""; ?>
                                                    value="<?= $_list['subdistrict_id']; ?>"><?= $_list['name_in_thai']; ?>
                                                [ <?= $_list['zip_code']; ?> ]
                                            </option>
                                        <?PHP } ?>
                                    <?PHP } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>รูปภาพประจำตัว</label>
                        <input type="file" accept="image/*" name="img">
                    </div>

                    <p align="center">
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                        <a href="secretary.php" class="btn btn-warning">ย้อนกลับ</a>
                    </p>
                </form>
            </div>
        </div>
    </div>


</div>

<?PHP include "include/footer.php"; ?>


<script>
    $(document).ready(function () {
        $(document).ready(function () {

            $("select[name='provinces']").change(function () {
                var id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "../ajax/get_districts.php",
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
                    url: "../ajax/get_subdistricts.php",
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


</body>
</html>