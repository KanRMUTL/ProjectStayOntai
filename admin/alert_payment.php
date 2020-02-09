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

                <legend>แจ้งชำระเงิน</legend>

                <?PHP
                $sql = "SELECT * FROM tb_booking a INNER JOIN tb_payment f ON a.booking_id = f.booking_id INNER JOIN tb_user g ON a.user_id = g.user_id WHERE booking_status = 2";
                $result = result_array($sql);
                ?>

                <!-- PC Screen -->
                <div class="tb_all d-none d-sm-block">
                    <table class="table table-striped table-bordered table-hover" id="table-js">
                        <thead>
                        <tr>
                            <th width="50">ลำดับ</th>
                            <th width="60">รูปภาพ</th>
                            <th>รายการ</th>
                            <th>ยอดโอน</th>
                            <th width="160">จัดการ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?PHP foreach ($result as $key => $row) { ?>
                            <tr>
                                <td class="center"><?= $key + 1; ?></td>
                                <td class="center">
                                    <a href="../uploads/<?= $row['payment_picture']; ?>" class="fancybox">
                                        <img src="../uploads/<?= $row['payment_picture']; ?>"
                                             style="width: auto; height: 50px;" alt="">
                                    </a>
                                </td>
                                <td class="text-left">
                                    <b>เลขที่การจอง :</b> <?= booking_id($row['booking_id']); ?> <br>
                                    <b>ธนาคาร :</b> <?= $row['payment_bank']; ?> <br>
                                    <b>วันที่โอน :</b> <?= datetime_th($row['payment_date']); ?> <br>
                                    <b>ราคารวมที่ต้องชำระเงิน :</b> <?= number_format($row['booking_sum'], 2); ?> <br>
                                    <b>ลูกค้า :</b> <?= $row['user_titlename'] ?><?= $row['user_name'] ?> <?= $row['user_lastname'] ?> <br>
                                </td>
                                <td class="center"><?= number_format($row['payment_money'],2); ?></td>
                                <td class="center">
                                    <a href="process/booking_update.php?status=3&id=<?= $row['booking_id']; ?>&url=alert_payment.php"
                                       class="btn btn-success btn-sm btn-rounded"
                                       onclick="return confirm_custom(this.href,'ยืนยันการชำระเงินแล้ว?');">
                                        เงินเข้าแล้ว
                                    </a>
                                    <a href="process/booking_update.php?status=1&id=<?= $row['booking_id']; ?>&url=alert_payment.php"
                                       class="btn btn-danger btn-sm btn-rounded"
                                       onclick="return confirm_custom(this.href,'ยืนยันว่าเงินไม่เข้า? ให้ลูกค้ากลับไปแจ้งโอนมาใหม่');">
                                        เงินไม่เข้า
                                    </a>
                                    <a target="_blank" href="../print_booking.php?id=<?= $row['booking_id']; ?>" class="btn btn-info btn-rounded btn-sm">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        <?PHP } ?>
                        </tbody>
                    </table>
                </div>
                <!-- End PC Screen -->

                <!-- Mobile Screen -->
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
                                            <br>
                                            <a href="../uploads/<?= $row['payment_picture']; ?>" class="fancybox">
                                                <img src="../uploads/<?= $row['payment_picture']; ?>" style="width: 100%;" alt="">
                                            </a>
                                        </li>
                                        <li class="list-group-item text-left">
                                            <b>เลขที่การจอง :</b> <?= booking_id($row['booking_id']); ?> <br>
                                            <b>ธนาคาร :</b> <?= $row['payment_bank']; ?> <br>
                                            <b>วันที่โอน :</b> <?= datetime_th($row['payment_date']); ?> <br>
                                            <b>ราคารวมที่ต้องชำระเงิน :</b> <?= number_format($row['booking_sum'], 2); ?> <br>
                                            <b>ลูกค้า :</b> <?= $row['user_titlename'] ?><?= $row['user_name'] ?> <?= $row['user_lastname'] ?> <br>
                                        </li>
                                        <li class="list-group-item">
                                            <b>ยอดโอน : </b><?= number_format($row['payment_money'],2); ?>
                                        </li>
                                        <li class="list-group-item">
                                        <a href="process/booking_update.php?status=3&id=<?= $row['booking_id']; ?>&url=alert_payment.php"
                                        class="btn btn-success btn-sm btn-rounded mb-2"
                                        onclick="return confirm_custom(this.href,'ยืนยันการชำระเงินแล้ว?');">
                                            เงินเข้าแล้ว
                                        </a>
                                        <a href="process/booking_update.php?status=1&id=<?= $row['booking_id']; ?>&url=alert_payment.php"
                                        class="btn btn-danger btn-sm btn-rounded mb-2"
                                        onclick="return confirm_custom(this.href,'ยืนยันว่าเงินไม่เข้า? ให้ลูกค้ากลับไปแจ้งโอนมาใหม่');">
                                            เงินไม่เข้า
                                        </a>
                                        </li>
                                        
                                    </ul>
                                </td>
                            </tr>
                        <?PHP } ?>
                        </tbody>
                    </table>
                </div>
                <!-- End PC Screen -->


            </div>
        </div>
    </div>


</div>

<?PHP include "include/footer.php"; ?>


</body>
</html>