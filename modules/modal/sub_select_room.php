<?php
include '../../function/db_function.php';
include '../../function/function.php';
?>

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
<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: 8px">
    <span aria-hidden="true">&times;</span>
</button>

<h3 class="title-page text-center">โฮมสเตย์ > <?= $head['homestay_name']; ?></h3>

<div class="row">
    <div class="col-md-12">
        <div style="padding: 0 10px;">
            <h4 class="text-center">
                สิ่งอำนวยความสะดวก
            </h4>
            <div class="resporn-icon">
            <div class="row">
                <?PHP
                $sql = "SELECT * FROM tb_service a INNER JOIN tb_service_option b ON a.service_id = b.service_id WHERE homestay_id = '{$head['homestay_id']}' ";
                $service = result_array($sql);
                ?>

                <?PHP foreach ($service as $_service) { ?>
                    <div class="col-md-3" style="font-size: 18px;">
                        <img src="assets/images/icon/<?= $_service['service_photo']; ?>"
                             style="width: auto; height: 15px;" alt="">
                        <?= $_service['service_name']; ?>
                    </div>
                <?PHP } ?>
                </div>
            </div>
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


        <h3 style="padding: 0 10px;">
            กรุณาเลือกห้องพัก
            <a href="index.php?module=homestay&action=select_room&id=<?= $head['homestay_id']; ?>"
               class="btn btn-primary btn-sm pull-right">ดูข้อมูลแบบละเอียด</a>
        </h3>


        <div class="col-md-12">

            <table class="table table-bordered" style="background: #fff; font-size: 18px;">
                <tr style="background: #eee;">
                    <th class="text-center">รายการ</th>
                    <th width="80" class="text-center">ผู้เข้าพักสูงสุด</th>
                    <th width="60" class="text-center">ราคา/คน/คืน</th>
                    <th width="80" class="text-center">จองเลย</th>
                </tr>

                <?PHP foreach ($result as $key => $row) { ?>

                    <?PHP
                    $check_status = check_booking($row['room_id'], $start, $end);
                    ?>

                    <tr>
                        <td class="text-left" id="text-font">
                            <b style="font-weight: bold;"><?= $row['room_name']; ?></b> <br>
                            <b>ประเภท :</b> <?= $row['room_type']; ?> <br>
                            <b>ขนาดห้อง :</b> <?= $row['room_size']; ?> <br>
                        </td>
                        <td class="text-center">
                            <?= $row['room_beds']; ?> คน
                            <?PHP if ($row['room_type'] == "ห้องรวม") { ?>
                                <br>
                                <div class="check_booking_all" id="check_booking_all">
                                    ว่าง : <?= $row['room_beds'] - check_booking_all($row['room_id'], $start, $end); ?>
                                </div>
                            <?PHP } ?>
                        </td>
                        <td class="text-center"><?= number_format($head['homestay_price'], 2); ?></td>
                        <td class="text-center">
                            <?PHP if ($check_status) { ?>
                                <?PHP
                                $check_session = check_booking_session($row['room_id']);
                                ?>
                                <?PHP if ($check_session) { ?>
                                    <a href="process/set_booking.php?room_id=<?= $row['room_id'] ?>"
                                       onclick="return confirm_custom(this.href,'ยืนยันการจองห้องพัก?');"
                                       class="btn btn-success btn-xs">จองเลย</a>
                                <?PHP } else { ?>
                                    <span style="color: #35d367;">จองแล้ว</span>
                                    <a href="process/unset_booking.php?room_id=<?= $row['room_id'] ?>"
                                       onclick="return confirm_custom(this.href,'ยืนยันการยกเลิกห้องพัก?');"
                                       class="btn btn-danger btn-xs">ยกเลิก</a>
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
    </div>

</div>



