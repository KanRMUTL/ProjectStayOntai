<!doctype html>
<html>
<head>
    <?PHP include "include/script.php"; ?>
    <style>
        .form-group {
            overflow: hidden;
        }

        .content-select-room{
            text-align: left;
            border: 1px solid #dddddd;
            padding: 15px 20px;
            height: 300px;
            overflow: auto;
            margin-bottom: 20px;
        }

        .text-bold{
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>
<body>


<?PHP include "include/header.php"; ?>

<div class="container main">

    <?PHP include "include/right.php"; ?>

    <?PHP
    extract($_GET);
    $sql = "SELECT * FROM tb_homestay WHERE homestay_id = '{$id}' ";
    $head = row_array($sql);
    ?>


    <div class="col-sm-9 col-lg-9">
        <div id="register-wraper">
            <div id="register-form" style="position: relative;">

                <legend>ข้อมูลห้องพัก : <?= $head['homestay_name']; ?></legend>

                <?PHP
                $sql = "SELECT * FROM tb_room WHERE homestay_id = '{$head['homestay_id']}' ORDER BY room_id DESC ";
                $result = result_array($sql);
                ?>

                <div class="tb_all">

                    <div class="content-select-room">

                        <center>
                            <img src="../uploads/<?= $head['homestay_pic']; ?>" style="width: auto; height: 200px;" alt="">
                        </center>
                        <h2 class="text-center text-bold">สิ่งอำนวยความสะดวก</h2>

                        <div class="row">
                            <?PHP
                            $sql = "SELECT * FROM tb_service a INNER JOIN tb_service_option b ON a.service_id = b.service_id WHERE homestay_id = '{$head['homestay_id']}' ";
                            $service = result_array($sql);
                            ?>

                            <?PHP foreach ($service as $_service) { ?>

                                <div class="col-md-3">
                                    <img src="../assets/images/icon/<?= $_service['service_photo']; ?>" style="width: auto; height: 20px;" alt="">
                                    <?= $_service['service_name']; ?>
                                </div>
                            <?PHP } ?>
                        </div>

                        <h2 class="text-center text-bold">รายละเอียด</h2>

                        <p>
                            <?= $head['homestay_detail']; ?>
                        </p>

                        <h2>ตำแหน่งที่ตั้ง</h2>

                        <div id="dvMap"
                             style="width: 100%; height: 200px; max-width: 900px; margin: 10px auto; border: 3px solid #ffffff;"></div>

                    </div>

                    <table class="table table-bordered" style="background: #fff;">
                        <tr style="background: #eee;">
                            <th class="text-center" width="250">รูปภาพ</th>
                            <th class="text-center">รายการ</th>
                            <th width="120" class="text-center">ผู้เข้าพัก</th>
                            <th width="120" class="text-center">ราคาต่อคืน</th>
                        </tr>

                        <?PHP foreach ($result as $key => $row) { ?>

                            <tr>
                                <td class="text-center">
                                    <?PHP
                                    $sql = "SELECT * FROM tb_picture WHERE room_id = '{$row['room_id']}'";
                                    $photo = result_array($sql);
                                    ?>
                                    <?PHP foreach ($photo as $check => $p) { ?>
                                        <?PHP if ($check == 0) { ?>
                                            <div class="col-md-12" style="padding: 0!important;">
                                                <a href="../uploads/<?= $p['picture_img']; ?>" class="fancybox"
                                                   rel="photo<?= $key ?>">
                                                    <img src="../uploads/<?= $p['picture_img']; ?>" width="100%"/>
                                                </a>
                                            </div>
                                        <?PHP } else { ?>
                                            <div class="col-md-3" style="padding: 0!important;">
                                                <a href="../uploads/<?= $p['picture_img']; ?>" class="fancybox"
                                                   rel="photo<?= $key ?>">
                                                    <img src="../uploads/<?= $p['picture_img']; ?>" width="100%"/>
                                                </a>
                                            </div>
                                        <?PHP } ?>
                                    <?PHP } ?>
                                </td>
                                <td class="text-left" style="padding-left: 30px;">
                                    <b style="font-size: 40px;"><?= $row['room_name']; ?></b> <br>
                                    <b>ประเภท ></b> <?= $row['room_type']; ?> <br>
                                    <b>ขนาดห้อง ></b> <?= $row['room_size']; ?> <br>
                                    <b>รายละเอียด ></b> <?= $row['room_description']; ?>
                                </td>
                                <td class="text-center"><?= $row['room_beds']; ?> คน</td>
                                <td class="text-center"><?= number_format($head['homestay_price'], 2); ?> บาท</td>
                            </tr>
                        <?PHP } ?>
                    </table>
                </div>

                <hr>

                <center>
                    <a href="list_homestay.php" class="btn btn-warning">ย้อนกลับ</a>
                </center>

            </div>
        </div>
    </div>


</div>

<?PHP include "include/footer.php"; ?>

<script type="text/javascript">

    window.onload = function () {

        var default_lat = "<?=$head['homestay_latitude'];?>";
        var default_lng = "<?=$head['homestay_longitude'];?>";

        var mapOptions = {
            center: new google.maps.LatLng(default_lat, default_lng),
            zoom: 12,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var marker;
        var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);

        marker = new google.maps.Marker({
            position: new google.maps.LatLng(default_lat, default_lng),
            map: map,
            title: 'จุดที่เลือก'
        });
    }

</script>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYgr4Io1KMLmr6OZ5RrsimQk7c9V7RAww&callback=initMap">
</script>



</body>
</html>