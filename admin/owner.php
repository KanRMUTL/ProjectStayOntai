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


    <div class="col-sm-9 col-lg-9">
        <div id="register-wraper">
            <div id="register-form" style="position: relative;">
                <a href="owner_form.php" style="position: absolute; top: 10px; right: 10px;">
                    <button type="button" class="btn btn-primary btn-md"><i class="fa fa-plus"></i>
                        เพิ่มข้อมูล
                    </button>
                </a>
                <legend>จัดการเจ้าของโฮมสเตย์</legend>

                <?PHP
                $sql = "SELECT * FROM tb_user WHERE user_type = 1";
                $list = result_array($sql);
                ?>

                <div class="tb_all">
                    <table class="table table-striped table-bordered table-hover" id="table-js">
                        <thead>
                        <tr>
                            <th width="50">ลำดับ</th>
                            <th width="50">รูปภาพ</th>
                            <th>ชื่อ - นามสกุล</th>
                            <th>เบอร์โทร</th>
                            <th width="80">สถานะ</th>
                            <th width="80">จัดการ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?PHP foreach ($list as $key => $row) { ?>
                            <tr>
                                <td class="center"><?= $key + 1; ?></td>
                                <td class="center"><img src="../uploads/<?= $row['user_picture']; ?>" style="width: auto; height: 50px;" alt=""></td>
                                <td class="center"><?= $row['user_titlename']; ?><?= $row['user_name']; ?> <?= $row['user_lastname']; ?></td>
                                <td class="center"><?= $row['user_tel']; ?></td>
                                <td class="center">
                                    <?PHP if ($row['user_status'] == 1) { ?>
                                        <a href="process/user_update.php?status=0&id=<?= $row['user_id']; ?>" class="btn btn-success btn-xs">
                                            สถานะ : <?= status($row['user_status']); ?>
                                        </a>

                                    <?PHP } else { ?>
                                        <a href="process/user_update.php?status=1&id=<?= $row['user_id']; ?>" class="btn btn-danger btn-xs">
                                            สถานะ : <?= status($row['user_status']); ?>
                                        </a>
                                    <?PHP } ?>

                                </td>
                                <td class="center">
                                    <a href="owner_form.php?id=<?= $row['user_id']; ?>"
                                       class="btn btn-xs btn-warning btn-rounded">
                                        แก้ไข
                                    </a>

                                    <a
                                            href="process/delete.php?table=tb_user&ff=user_id&id=<?= $row['user_id']; ?>"
                                            class="btn btn-xs btn-danger"
                                            onclick="return confirm_custom(this.href,'ต้องการลบข้อมูลนี้?');">
                                        ลบ
                                    </a>
                                </td>
                            </tr>
                        <?PHP } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</div>

<?PHP include "include/footer.php"; ?>



</body>
</html>