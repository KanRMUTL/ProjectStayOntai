<div class="block-page">
    <div class="container">
        <?PHP include 'include/header.php'; ?>

        <?PHP
        extract($_GET);
        $sql = "SELECT * FROM tb_homestay WHERE homestay_id = '{$id}' ";
        $head = row_array($sql);


        $start = $_SESSION['homestay']['start'];
        $room = $_SESSION['homestay']['room'];
        $total = $_SESSION['homestay']['total'];
        $adult = $_SESSION['homestay']['adult'];
        $child = $_SESSION['homestay']['child'];
        $type = $_SESSION['homestay']['type'];
        $beds = $_SESSION['homestay']['beds'];


        $end = add_date($start, $total);

        ?>


        <h1 class="title-page text-center">โฮมสเตย์ > <?= $head['homestay_name']; ?></h1>

        <div class="row">
            <p class="text-center">
                เช็คอินวันที่ <span class="text-danger"><?= date_th($start); ?></span>
                เช็คเอาท์วันที่ <span class="text-danger"><?= date_th($end); ?></span>
                จำนวน <span class="text-danger"><?= $total; ?></span> คืน
                <br>
                จำนวน <span class="text-danger"><?= $room; ?></span> ห้อง
                ผู้ใหญ่ <span class="text-danger"><?= $adult; ?></span> คน
                เด็ก <span class="text-danger"><?= $child; ?></span> คน
            </p>

            <div class="col-md-8 col-md-offset-2">
                <div class="content-all padding-inout">
                    <center>
                        <img src="uploads/<?= $head['homestay_pic']; ?>" style="width: auto; height: 200px;" alt="">
                    </center>
                    <h2>สิ่งอำนวยความสะดวก</h2>
                <div class="resporn-icon">
                    <div class="row">
                        <?PHP
                        $sql = "SELECT * FROM tb_service a INNER JOIN tb_service_option b ON a.service_id = b.service_id WHERE homestay_id = '{$head['homestay_id']}' ";
                        $service = result_array($sql);
                        ?>

                        <?PHP foreach ($service as $_service) { ?>
                            <div class="col-md-3">
                                <img src="assets/images/icon/<?= $_service['service_photo']; ?>"
                                     style="width: auto; height: 20px;" alt="">
                                <?= $_service['service_name']; ?>
                            </div>
                        <?PHP } ?>
                        </div>
                    </div>
                    <div class="detail_sub">
                    <h2>รายละเอียด</h2>

                    <?= $head['homestay_detail']; ?>

                    <h2>ที่อยู่</h2>

                    <?= $head['homestay_address']; ?>
                    </div>
                    <h2>ตำแหน่งที่ตั้ง</h2>

                    <div id="dvMap"
                         style="width: 100%; height: 200px; max-width: 900px; margin: 10px auto; border: 3px solid #ffffff;"></div>
                </div>
            </div>

            <?PHP

            $where = "  AND '{$beds}' <= room_beds";

            if ($type == "ห้องรวม") {
                $where = " AND room_type = '{$type}' AND '{$beds}' <= room_beds";
            } elseif ($type == "ห้องส่วนตัว") {
                $where = " AND room_type = '{$type}' AND '{$beds}' <= room_beds";
            }

            $sql = "SELECT * FROM tb_room WHERE homestay_id = '{$head['homestay_id']}' {$where} ORDER BY room_id DESC ";
            $result = result_array($sql);
            ?>

            <div class="col-md-12">


                <h3 class="text-center">กรุณาเลือกห้องพัก</h3>


                <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered" style="background: #fff;" id="table-bordered">
                        <thead>
                        <tr style="background: #eee;">

                            <th class="text-center" width="250">รูปภาพ</th>
                            
                            <th class="text-center">รายการ</th>

                            <th width="120" class="text-center">ผู้เข้าพักสูงสุด</th>
                            <th width="120" class="text-center">ราคา/คน/คืน</th>
                            <th width="100" class="text-center">จองเลย</th>
                        </tr>
                        </thead>
                        <?PHP foreach ($result as $key => $row) { ?>

                            <?PHP
                            $check_status = check_booking($row['room_id'], $start, $end);
                            ?>

                            <tr>
                                <td class="text-center">
                                    
                                    <?PHP
                                    $sql = "SELECT * FROM tb_picture WHERE room_id = '{$row['room_id']}'";
                                    $photo = result_array($sql);
                                    ?>
                                    <?PHP foreach ($photo as $check => $p) { ?>
                                        <?PHP if ($check == 0) { ?>
                                            <div class="col-md-12" style="padding: 0!important;">
                                                <a href="uploads/<?= $p['picture_img']; ?>" class="fancybox"
                                                   rel="photo<?= $key ?>">
                                                    <img src="uploads/<?= $p['picture_img']; ?>" width="100%"/>
                                                </a>
                                            </div>
                                        <?PHP } else { ?>
                                            <div class="col-md-3" style="padding: 0!important;">
                                                <a href="uploads/<?= $p['picture_img']; ?>" class="fancybox"
                                                   rel="photo<?= $key ?>">
                                                    <img src="uploads/<?= $p['picture_img']; ?>" width="100%"/>
                                                </a>
                                            </div>
                                            
                                        <?PHP } ?>
                                    <?PHP } ?>
                                </td>
                                <td class="text-left" style="padding-left: 30px; white-space: normal;">
                                    <b id="table-bordered"><?= $row['room_name']; ?></b> <br>
                                    <b>ประเภท :</b> <?= $row['room_type']; ?> <br>
                                    <b>ขนาดห้อง :</b> <?= $row['room_size']; ?> <br>
                                    <b>รายละเอียด :</b> <?= $row['room_description']; ?>
                                </td>
                                <td class="text-center">
                                    <?= $row['room_beds']; ?> คน
                                    <?PHP if ($row['room_type'] == "ห้องรวม") { ?>
                                        <br>
                                        <div class="check_booking_all" style="display: inline;">
                                            ว่าง : <?= $row['room_beds'] - check_booking_all($row['room_id'], $start, $end); ?>
                                        </div>
                                    <?PHP } ?>
                                </td>
                                <td class="text-center"><?= number_format($head['homestay_price'], 2); ?> บาท</td>
                                <td class="text-center">
                                    <?PHP if ($check_status) { ?>
                                        <?PHP
                                        $check_session = check_booking_session($row['room_id']);
                                        ?>
                                        <?PHP if ($check_session) { ?>
                                            <a href="process/set_booking.php?room_id=<?= $row['room_id'] ?>"
                                               onclick="return confirm_custom(this.href,'ยืนยันการจองห้องพัก?');"
                                               class="btn btn-success">จองเลย</a>
                                        <?PHP } else { ?>
                                            <span style="color: #35d367;">จองแล้ว</span>
                                            <a href="process/unset_booking.php?room_id=<?= $row['room_id'] ?>"
                                               onclick="return confirm_custom(this.href,'ยืนยันการยกเลิกห้องพัก?');"
                                               class="btn btn-danger btn-sm">ยกเลิก</a>
                                        <?PHP } ?>
                                    <?PHP } else { ?>
                                        <span style="color: red;">ไม่ว่าง</span>
                                    <?PHP } ?>
                                </td>
                            </tr>
                        <?PHP } ?>

                        <?PHP if (count($result) == 0) { ?>
                            <tr>
                                <td colspan="7" class="text-center">ไม่มีห้อง</td>
                            </tr>
                        <?PHP } ?>

                    </table>
                    </div>
                    <hr>

                    <center>
                        <a href="index.php?module=home&action=homestay" class="btn btn-primary">เลือกห้องเพิ่ม</a>
                    </center>

                    <br>
                    <br>
                    <br>


                </div>
            </div>

        </div>

    </div>
</div>

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

