<div class="block-page">
    <div class="container">
        <?PHP include 'include/header.php'; ?>


        <h1 class="title-page text-center">สมัครสมาชิก</h1>

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="form_all">
                    <form role="form" action="process/employee_process.php" method="post"
                          enctype="multipart/form-data">

                        <input type="hidden" name="id" value="<?= $id; ?>">

                        <div class="form-group">
                            <label>ตำแหน่ง</label>
                            <select name="status" class="form-control" required>
                                <option selected disabled value="">เลือกตำแหน่ง</option>
                                <option <?= $status == 5 ? "selected" : ""; ?> value="5">ผู้ดูแลระบบ
                                </option>
                                <option <?= $status == 2 ? "selected" : ""; ?> value="2">พนักงาน
                                </option>
                                <option <?= $status == 3 ? "selected" : ""; ?> value="3">ช่าง</option>
                                <option <?= $status == 4 ? "selected" : ""; ?> value="4">บัญชี</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>ชื่อ</label>
                            <input type="text" class="form-control" name="name" value="<?= $name; ?>"
                                   required>
                        </div>
                        <div class="form-group">
                            <label>นามสกุล</label>
                            <input type="text" class="form-control" name="lastname"
                                   value="<?= $lastname; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>เลขบัตรประชำตัวประชาชน</label>
                            <input type="text" class="form-control numberOnly" pattern=".{0}|.{13,}"
                                   title="กรุณาใส่ให้ครบ 13 หลัก" maxlength="13" name="idcard" value="<?= $idcard; ?> "
                                   required>
                        </div>
                        <div class="form-group">
                            <label>เบอร์โทร</label>
                            <input type="text" class="form-control numberOnly" pattern=".{0}|.{10,}"
                                   title="กรุณาใส่อย่างน้อย 10 หลัก" maxlength="10" name="tel" value="<?= $tel; ?>"
                                   maxlength="10"
                                   required>
                        </div>

                        <div class="form-group">
                            <label>ชื่อผู้ใช้งาน</label>
                            <input type="text" class="form-control" name="username"
                                   value="<?= $username; ?>" required>
                        </div>

                        <div class="form-group">
                            <label>รหัสผ่าน</label>
                            <input type="password" class="form-control" name="password"
                                   value="<?= $password; ?>" required>
                        </div>

                        <div class="form-group">
                            <label>ยืนยันรหัสผ่าน</label>
                            <input type="password" class="form-control" name="repassword"
                                   value="<?= $password; ?>" required>
                        </div>

                        <div class="form-group">
                            <label>ที่อยู่</label>
                            <textarea class="form-control" rows="2" name="address"
                                      required><?= $address; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>จังหวัด</label>
                            <?PHP
                            $sql = "SELECT * FROM provinces";
                            $list = result_array($sql);
                            ?>

                            <select name="provinces" class="form-control" required>
                                <option disabled selected value="">เลือกจังหวัด</option>
                                <?PHP foreach ($list as $_list) { ?>
                                    <option <?= $row['PROVINCE_ID'] == $_list['PROVINCE_ID'] ? "selected" : ""; ?>
                                            value="<?= $_list['PROVINCE_ID']; ?>"><?= $_list['PROVINCE_NAME']; ?></option>
                                <?PHP } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>อำเภอ</label>
                            <select name="amphures" class="form-control" required>
                                <?PHP if ($id == "") { ?>
                                    <option disabled selected value="">ไม่พบข้อมูล</option>
                                <?PHP } else { ?>
                                    <?PHP
                                    $sql = "SELECT * FROM amphures WHERE PROVINCE_ID = '{$row['PROVINCE_ID']}'";
                                    $list = result_array($sql);
                                    ?>
                                    <?PHP foreach ($list as $_list) { ?>
                                        <option <?= $row['AMPHUR_ID'] == $_list['AMPHUR_ID'] ? "selected" : ""; ?>
                                                value="<?= $_list['AMPHUR_ID']; ?>"><?= $_list['AMPHUR_NAME']; ?></option>
                                    <?PHP } ?>
                                <?PHP } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>ตำบล</label>
                            <select name="districts" class="form-control" required>
                                <?PHP if ($id == "") { ?>
                                    <option disabled selected value="">ไม่พบข้อมูล</option>
                                <?PHP } else { ?>
                                    <?PHP
                                    $sql = "SELECT * FROM districts WHERE AMPHUR_ID = '{$row['AMPHUR_ID']}'";
                                    $list = result_array($sql);
                                    ?>
                                    <?PHP foreach ($list as $_list) { ?>
                                        <option <?= $row['DISTRICT_ID'] == $_list['DISTRICT_ID'] ? "selected" : ""; ?>
                                                value="<?= $_list['DISTRICT_ID']; ?>"><?= $_list['DISTRICT_NAME']; ?></option>
                                    <?PHP } ?>
                                <?PHP } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>รหัสไปรษณีย์</label>
                            <input type="text" name="zipcode" class="form-control numberOnly" value="<?= $zipcode; ?>"
                                   maxlength="5"
                                   required="">
                        </div>

                        <div class="form-group">
                            <label>รูปภาพประจำตัว</label>
                            <input type="file" name="img">
                        </div>

                        <p align="center">
                            <button type="submit" class="btn btn-success">บันทึก</button>
                            <button type="reset" class="btn btn-warning">ล้างข้อมูล</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>






