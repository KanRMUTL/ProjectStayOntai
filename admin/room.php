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
    extract($_GET);
    $uid = check_session("id");
    $sql = "SELECT * FROM tb_homestay WHERE user_id = '{$uid}' AND homestay_id = '{$id}'";
    $head = row_array($sql);

    $sql = "SELECT * FROM tb_room WHERE homestay_id = '{$head['homestay_id']}'";
    $list = result_array($sql);
    ?>


    <div class="col-sm-9 col-lg-9">
        <div id="register-wraper">
            <div id="register-form" style="position: relative;">
                <a href="room_form.php?homestay_id=<?= $head['homestay_id']; ?>"
                   style="position: absolute; top: 10px; right: 10px;">
                    <button type="button" class="btn btn-primary btn-md"><i class="fa fa-plus"></i>
                        เพิ่มข้อมูล
                    </button>
                </a>
                <legend>จัดการห้องพัก : <?= $head['homestay_name']; ?></legend>

                <div class="tb_all">
                    <table class="table table-striped table-bordered table-hover" id="table-js">
                        <thead>
                        <tr>
                            <th width="50">ลำดับ</th>
                            <th>รายการ</th>
                            <th>ที่นอน</th>
                            <th>ประเภท</th>
                            <th width="130">จัดการ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?PHP foreach ($list as $key => $row) { ?>
                            <tr>
                                <td class="center"><?= $key + 1; ?></td>
                                <td class="center"><?= $row['room_name']; ?></td>
                                <td class="center"><?= $row['room_beds']; ?></td>
                                <td class="center"><?= $row['room_type']; ?></td>
                                <td class="center">
                                    <a href="room_picture.php?id=<?= $row['room_id']; ?>"
                                       class="btn btn-xs btn-primary btn-rounded">
                                        จัดการอัลบั้ม
                                    </a>

                                    <a href="room_form.php?homestay_id=<?= $head['homestay_id']; ?>&id=<?= $row['room_id']; ?>"
                                       class="btn btn-xs btn-warning btn-rounded">
                                        แก้ไข
                                    </a>

                                  <a
                                            href="process/delete.php?table=tb_room&ff=room_id&id=<?= $row['room_id']; ?>"
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