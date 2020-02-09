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

                <legend>เช็คอินเข้าห้องพัก</legend>

                <div style="padding: 15px;">
                    <ul class="nav nav-tabs">
                        <li><a href="check_in.php">เช็คอินวันนี้</a></li>
                        <li class="active"><a href="check_in_all.php">รอเช็คอิน</a></li>
                    </ul>
                </div>

                <?PHP
$uid = check_session("id");
$sql = "SELECT * FROM tb_booking a INNER JOIN tb_booking_detail b ON a.booking_id = b.booking_id INNER JOIN tb_room d ON b.room_id = d.room_id INNER JOIN tb_homestay e ON d.homestay_id = e.homestay_id INNER JOIN tb_user g ON a.user_id = g.user_id WHERE booking_check_in != CURDATE() AND booking_status = 3 AND booking_detail_status = 3 AND e.user_id = '{$uid}'";
$result = result_array($sql);
 ?>

                <!-- PC Screen -->
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
                                    <b>ว/ด/ป :</b> <?=  date_format(date_create($row['user_birth']), 'd/m/Y'); ?> <br>
                                </td>

                                <td class="center">
                                    <?= booking_detail_status($row['booking_detail_status']); ?>
                                </td>

                                <td class="center">
                                    <a target="_blank" href="../print_booking.php?print&id=<?= $row['booking_id']; ?>" class="btn btn-info btn-rounded btn-sm">
                                        รายละเอียด
                                    </a>
                                </td>
                            </tr>
                        <?PHP } ?>
                        </tbody>
                    </table>
                </div>
                <!-- PC Screen -->

                <!-- Mobile Screen -->
                <div class="tb_all d-block d-sm-none">
                    <table class="table table-striped table-bordered table-hover" id="table-js">
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
                                            <b>ราคารวม :</b> <?= ($row['booking_detail_price'] * ($row['booking_detail_adult'] + $row['booking_detail_child'])) * $row['booking_detail_total'] ?> บาท
                                        </li>
                                        <li class="list-group-item text-left">
                                            <b>ลูกค้า : </b><?= $row['user_titlename'] ?><?= $row['user_name'] ?> <?= $row['user_lastname'] ?> <br>
                                            <b>เบอร์โทร :</b> <?= $row['user_tel']; ?> <br>
                                            <b>อีเมล์ :</b> <?= $row['user_email']; ?> <br>
                                            <b>ว/ด/ป :</b> <?= date_format(date_create($row['user_birth']), 'd/m/Y'); ?>
                                        </li>
                                        <li class="list-group-item">
                                        <b>สถานะ : <?= booking_detail_status($row['booking_detail_status']); ?></b>
                                        </li>
                                        <li class="list-group-item">
                                        <a target="_blank" href="../print_booking.php?print&id=<?= $row['booking_id']; ?>" class="btn btn-info btn-rounded btn-sm">
                                            รายละเอียด
                                        </a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        <?PHP } ?>
                        </tbody>
                    </table>
                </div>
                <!--End Mobile Screen -->

            </div>
        </div>
    </div>


</div>

<?PHP include "include/footer.php"; ?>


</body>
</html>