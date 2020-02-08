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
    $room_type = "ห้องส่วนตัว";
    $homestay_id = $_GET['homestay_id'];

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }

    $uid = check_session("id");
    $sql = "SELECT * FROM tb_homestay WHERE user_id = '{$uid}' AND homestay_id = '{$homestay_id}'";
    $head = row_array($sql);

    $sql = "SELECT * FROM tb_room WHERE room_id = '{$id}'";
    $row = row_array($sql);

    if ($row['room_type'] != "") {
        $room_type =  $row['room_type'];
    }

    ?>


    <div class="col-sm-9 col-lg-9">
        <div id="register-wraper">
            <div class="form_all">

                <legend>จัดการห้องพัก : <?= $head['homestay_name']; ?></legend>

                <form role="form" action="process/room_process.php" method="post"
                      enctype="multipart/form-data">

                    <input type="hidden" name="id" value="<?= $row['room_id']; ?>">
                    <input type="hidden" name="homestay_id" value="<?= $head['homestay_id']; ?>">


                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>ประเภท</label>
                                <select name="room_type" class="form-control" required>
                                    <option <?=$room_type == 'ห้องส่วนตัว' ? "selected":"";?> value="ห้องส่วนตัว">ห้องส่วนตัว</option>
                                    <option <?=$room_type == 'ห้องรวม' ? "selected":"";?> value="ห้องรวม">ห้องรวม</option>
                                </select>
                            </div>
                            <div class="col-md-8">
                                <label>ชื่อห้องพัก</label>
                                <input type="text" class="form-control" name="room_name" value="<?= $row['room_name']; ?>"
                                       required>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label>จำนวนที่นอน</label>
                        <input type="text" class="form-control numberOnly" maxlength="2" name="room_beds" value="<?= $row['room_beds']; ?>"
                               required>
                    </div>

                    <div class="form-group">
                        <label>ขนาดห้อง</label>
                        <input type="text" class="form-control" name="room_size" value="<?= $row['room_name']; ?>"
                               required>
                    </div>

                    <div class="form-group">
                        <label>รายละเอียด</label>
                        <textarea class="form-control" name="detail"><?= $row['room_description']; ?></textarea>
                    </div>


                    <p align="center">
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                        <a href="room.php?id=<?=$homestay_id?>" class="btn btn-warning">ย้อนกลับ</a>
                    </p>
                </form>
            </div>
        </div>
    </div>


</div>

<?PHP include "include/footer.php"; ?>


</body>
</html>