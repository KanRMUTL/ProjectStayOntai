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
    $sql = "SELECT * FROM tb_room WHERE room_id = '{$id}'";
    $title = row_array($sql);
    ?>


    <div class="col-sm-9 col-lg-9">
        <div id="register-wraper">
            <div id="register-form" style="position: relative;">

                <legend>จัดการอัมบั้มข่าวสาร : <?=$title['room_name'];?></legend>


                <div class="tb_all">
                    <form action="process/room_img_process.php" enctype="multipart/form-data" method="post">
                        <input type="hidden" name="id" value="<?=$id?>">
                        <div class="col-md-6">
                            <div class="form-group text-left">
                                <label>รูปภาพ <small style="color: red;">เลือกได้หลายรูปต่อครั้ง</small></label>
                                <input type="file" class="form-control" name="img[]" multiple
                                       required>
                            </div>
                        </div>

                        <div class="col-md-1">
                            <label></label>
                            <button style="margin-top: 3px;" type="submit" class="btn btn-primary">อัพโหลด</button>
                        </div>
                    </form>

                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-left">รูปภาพ :</p>
                            <?PHP
                            $sql = "SELECT * FROM tb_picture WHERE room_id = '{$id}'";
                            $list = result_array($sql);
                            ?>
                            <?PHP foreach ($list as $row){ ?>
                                <div class="col-md-2">
                                    <div style="margin-bottom: 15px;">
                                        <img src="../uploads/<?=$row['picture_img'];?>" class="img-responsive" alt="">
                                        <p>
                                            <a
                                                href="process/delete.php?table=tb_picture&ff=picture_id&id=<?= $row['picture_id']; ?>"
                                                class="btn btn-xs btn-danger"
                                                onclick="return confirm_custom(this.href,'ต้องการลบข้อมูลนี้?');">
                                                ลบ
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            <?PHP } ?>

                        </div>
                    </div>

                    <hr>

                    <center>
                        <a href="room.php?id=<?=$title['homestay_id'];?>" class="btn btn-warning">ย้อนกลับ</a>
                    </center>
                </div>
            </div>
        </div>
    </div>


</div>

<?PHP include "include/footer.php"; ?>



</body>
</html>