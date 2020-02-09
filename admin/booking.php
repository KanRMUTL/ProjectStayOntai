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

                <legend>จัดการเข้าพักของลูกค้า</legend>

                <?PHP
                    $uid = check_session("id");
                    $sql = "SELECT * FROM tb_booking a INNER JOIN tb_booking_detail b ON a.booking_id = b.booking_id INNER JOIN tb_room d ON b.room_id = d.room_id INNER JOIN tb_homestay e ON d.homestay_id = e.homestay_id INNER JOIN tb_user g ON a.user_id = g.user_id WHERE e.user_id = '$uid' ORDER BY a.booking_id DESC ";
                    $result = result_array($sql);
                ?>

                <!-- PC Screen  -->
                <div class="tb_all d-none d-sm-block">
                    <table class="table table-striped table-bordered table-hover" id="table-js">
                        <thead>
                        <tr>
                            <th width="50">ลำดับ</th>
                            <th>ห้อง</th>
                            <th>ผู้จอง</th>
                            <th width="100">สถานะ</th>
                            <th width="110">จัดการ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?PHP foreach ($result as $key => $row) { ?>
                            <tr>
                                <td class="center"><?= $key + 1; ?></td>
                                <td class="text-left">
                                    <b>เลขที่การจอง :</b> <?= booking_id($row['booking_id']); ?> <br>
                                    <b>โฮมสเตย์ :</b> <?= $row['homestay_name'] ?> <br>
                                    <b>ห้อง :</b> <?= $row['room_name'] ?> <br>
                                    <b>ราคารวม :</b> <?= ($row['booking_detail_price'] * ($row['booking_detail_adult'] + $row['booking_detail_child'])) * $row['booking_detail_total'] ?> บาท <br>
                                </td>
                                <td class="text-left">
                                    <?= $row['user_titlename'] ?><?= $row['user_name'] ?> <?= $row['user_lastname'] ?> <br>
                                    <b>เบอร์โทร :</b> <?= $row['user_tel']; ?> <br>
                                    <b>อีเมล์ :</b> <?= $row['user_email']; ?> <br>
                                    <b>ว/ด/ป :</b> <?= $row['user_birth']; ?> <br>
                                </td>

                                <td class="center">
                                    <?= booking_detail_status($row['booking_detail_status']); ?>
                                </td>

                                <td class="center">
                                    <a target="_blank" href="../print_booking.php?print&id=<?= $row['booking_id']; ?>" class="btn btn-info btn-rounded btn-sm">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <?PHP if($row['booking_detail_status'] < 4){ ?>
                                        <a href="process/booking_detail_update.php?status=6&id=<?= $row['booking_detail_id']; ?>&url=booking.php"
                                           class="btn btn-danger btn-rounded btn-sm"
                                           onclick="return confirm_custom(this.href,'ยืนยันการยกเลิก?');">
                                            ยกเลิก
                                        </a>
                                    <?PHP } ?>

                                </td>
                            </tr>
                        <?PHP } ?>
                        </tbody>
                    </table>
                </div>
                 <!-- End PC Screen  -->

                <!-- Mobile Screen  -->
                <div class="tb_all d-block d-sm-none">
                    <table class="table table-striped table-bordered table-hover" id="table-mobile">
                        <thead>
                        <tr>
                            <th>รายการ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?PHP foreach ($result as $key => $row) { ?>
                            <tr>
                                <td>
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <b>ลำดับที่ <?= $key + 1; ?></b>
                                        </li>
                                        <li class="list-group-item text-left">
                                            <b>เลขที่การจอง :</b> <?= booking_id($row['booking_id']); ?> <br>
                                            <b>โฮมสเตย์ :</b> <?= $row['homestay_name'] ?> <br>
                                            <b>ห้อง :</b> <?= $row['room_name'] ?> <br>
                                            <b>ราคารวม :</b> <?= ($row['booking_detail_price'] * ($row['booking_detail_adult'] + $row['booking_detail_child'])) * $row['booking_detail_total'] ?> บาท <br>
                                        </li>
                                        <li class="list-group-item text-left">
                                            <b>ผู้จอง : </b><?= $row['user_titlename'] ?><?= $row['user_name'] ?> <?= $row['user_lastname'] ?> <br>
                                            <b>เบอร์โทร :</b> <?= $row['user_tel']; ?> <br>
                                            <b>อีเมล์ :</b> <?= $row['user_email']; ?> <br>
                                            <b>ว/ด/ป :</b> <?= $row['user_birth']; ?> <br>
                                        </li>
                                        <li class="list-group-item">
                                            <b>สถานะ : <?= booking_detail_status($row['booking_detail_status']); ?></b>
                                        </li>
                                        
                                            <?PHP if($row['booking_detail_status'] < 4){ ?>
                                                <li class="list-group-item">
                                                    <a href="process/booking_detail_update.php?status=6&id=<?= $row['booking_detail_id']; ?>&url=booking.php"
                                                    class="btn btn-danger btn-rounded btn-sm"
                                                    onclick="return confirm_custom(this.href,'ยืนยันการยกเลิก?');">
                                                        ยกเลิก
                                                    </a>
                                                </li>
                                            <?PHP } ?>
                                        
                                    </ul>
                                </td>
                            </tr>
                        <?PHP } ?>
                        </tbody>
                    </table>
                </div>
                 <!-- End Mobile Screen  -->

            </div>
        </div>
    </div>


</div>

<?PHP include "include/footer.php"; ?>


</body>
</html>