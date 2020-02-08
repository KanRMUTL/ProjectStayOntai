<div class="block-page">
    <div class="container">
        <?PHP include 'include/header.php'; ?>

        <?PHP
        extract($_GET);
        $cid = check_session("user_id");
        $sql = "SELECT * FROM tb_booking WHERE user_id = '{$cid}' AND booking_status < 3";
        $result = result_array($sql);
        ?>


        <h1 class="title-page text-center">ชำระเงิน</h1>

        <div class="row margin-bottom-20">
            <div class="col-md-5">
                <p class="text-center">ชำระเงินได้ที่</p>
                <img src="assets/images/bank.png" class="img-responsive" alt="">
            </div>
            <div class="col-md-7">
                <p class="text-center">แจ้งชำระเงิน</p>

                <div class="form_all">

                    <?PHP
                    $booking_id = "";

                    $cid = check_session("user_id");
                    if (isset($_GET['booking_id'])) {
                        $booking_id = $_GET['booking_id'];
                    }

                    $sql = "SELECT * FROM tb_booking WHERE user_id = '$cid' AND (booking_status = 1 OR booking_status = 2) ";
                    $list_booking = result_array($sql);

                    $show = false;
                    $button = "button";
                    if ($list_booking) {
                        $button = "submit";
                        $show = true;
                    }


                    ?>


                    <form action="">
                        <input type="hidden" name="module" value="homestay">
                        <input type="hidden" name="action" value="payment">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 text-right">
                                    เลขที่การจอง
                                </div>

                                <div class="col-md-7">
                                    <select name="booking_id" class="form-control" required>
                                        <option selected disabled value="">เลือกเลขที่การจองที่รอชำระเงิน</option>
                                        <?PHP if ($show) { ?>
                                            <?PHP foreach ($list_booking as $value) { ?>
                                                <option <?= $booking_id == $value['booking_id'] ? "selected" : "" ?>
                                                        value="<?= $value['booking_id'] ?>">
                                                    <?= booking_id($value['booking_id']); ?>
                                                    <?= date_th($value['booking_check_in']) ?> -
                                                    <?= date_th($value['booking_check_out']); ?>
                                                    [ <?= $value['booking_sum']; ?> บาท ]
                                                </option>
                                            <?PHP } ?>
                                        <?PHP } else { ?>
                                            <option value="">ไม่พบเลขที่การจองที่รอชำระเงิน</option>
                                        <?PHP } ?>

                                    </select>
                                </div>

                                <div class="col-md-1">
                                    <button type="<?= $button; ?>" class="btn btn-primary">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>


                        </div>
                    </form>

                    <?PHP if ($booking_id != "") { ?>

                        <?PHP
                        $sql = "SELECT * , a.booking_id as booking_id FROM tb_booking a INNER JOIN tb_booking_detail b ON a.booking_id = b.booking_id INNER JOIN tb_room d ON b.room_id = d.room_id INNER JOIN tb_homestay e ON d.homestay_id = e.homestay_id LEFT JOIN tb_payment f ON a.booking_id = f.booking_id WHERE a.user_id = '$cid' AND (booking_status = 1 OR booking_status = 2) AND a.booking_id = '{$booking_id}'";
                        $row = row_array($sql);
                        ?>

                        <table class="table table-bordered" style="background: #fff;">
                            <tr>
                                <th colspan="2" class="text-center">รายละเอียดโฮมสเตย์</th>
                            </tr>
                            <tr>
                                <th class="text-right" width="200">โฮมสเตย์</th>
                                <td><?= $row['homestay_name'] ?></td>
                            </tr>
                            <tr>
                                <th class="text-right" width="200">ห้องพัก</th>
                                <td><?= $row['room_name'] ?></td>
                            </tr>
                            <tr>
                                <th class="text-right" width="200">ประเภท</th>
                                <td><?= $row['room_type'] ?></td>
                            </tr>
                            <tr>
                                <th class="text-right" width="200">ราคาต่อคืน</th>
                                <td><?= number_format($row['homestay_price'], 2); ?> บาท</td>
                            </tr>
                            <tr>
                                <th colspan="2" class="text-center">รายละเอียดการจอง</th>
                            </tr>
                            <tr>
                                <th class="text-right" width="200">เลขที่การจอง</th>
                                <td>
                                    <?= booking_id($row['booking_id']); ?>
                                    <a target="_blank" href="print_booking.php?id=<?= $row['booking_id']; ?>" class="btn btn-info btn-rounded">
                                        <i class="fa fa-print"></i> พิมพ์ใบจอง
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-right" width="200">จำนวน</th>
                                <td><?= $row['booking_detail_total'] ?> คืน</td>
                            </tr>
                            <tr>
                                <th class="text-right" width="200">เช็คอิน</th>
                                <td><?= date_th($row['booking_check_in']); ?></td>
                            </tr>
                            <tr>
                                <th class="text-right" width="200">เช็คเอาท์</th>
                                <td><?= date_th($row['booking_check_out']); ?></td>
                            </tr>
                            <tr>
                                <th class="text-right" width="200">สถานะ</th>
                                <td><?= booking_status($row['booking_status']); ?></td>
                            </tr>
                            <tr style="color: red;">
                                <th class="text-right" width="200">ราคารวมที่ต้องชำระเงิน</th>
                                <td><?= number_format($row['booking_sum'], 2); ?> บาท</td>
                            </tr>
                            <?PHP if ($row['booking_status'] == 2) { ?>
                                <tr>
                                    <th colspan="2" class="text-center">รายละเอียดการชำระเงิน</th>
                                </tr>
                                <tr>
                                    <th class="text-right" width="200">ธนาคาร</th>
                                    <td><?= $row['payment_bank'] ?> คืน</td>
                                </tr>
                                <tr>
                                    <th class="text-right" width="200">วันที่โอน</th>
                                    <td><?= datetime_th($row['payment_date']); ?></td>
                                </tr>
                                <tr>
                                    <th class="text-right" width="200">ยอดโอน</th>
                                    <td><?= number_format($row['payment_money'], 2); ?> บาท</td>
                                </tr>
                                <tr>
                                    <th class="text-right" width="200">หลักฐานการโอน</th>
                                    <td>
                                        <img src="uploads/<?= $row['payment_picture']; ?>" class="img-responsive" alt="">
                                    </td>
                                </tr>
                            <?PHP } ?>
                        </table>

                        <?PHP if ($row['booking_status'] == 1) { ?>
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <form role="form" action="process/payment_process.php" id="form-payment-new" method="post" autocomplete="off"
                                          enctype="multipart/form-data">

                                        <input type="hidden" name="booking_id" value="<?= $row['booking_id']; ?>">
                                        <input type="hidden" name="money" value="<?= $row['booking_sum']; ?>">

                                        <div class="form-group">
                                            <label>ธนาคาร</label>
                                            <select name="bank" class="form-control" required>
                                                <option selected disabled value="">เลือกธนาคารที่โอน</option>
                                                <option>ธนาคารกสิกรไทย</option>
                                                <option>ธนาคารไทยพาณิชย์</option>
                                                <option>ธนาคารกรุงเทพ</option>
                                                <option>ธนาคารกรุงไทย</option>
                                                <option>ธนาคารกรุงศรีอยุธยา</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>วันที่โอน</label>
                                            <input type="text" class="form-control datepickermax"  name="date">
                                        </div>

                                        <div class="form-group">
                                            <label>เวลาโอน</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <select name="hh" class="form-control" required>
                                                        <option value="" disabled selected>เลือกชั่วโมง</option>
                                                        <option>00</option>
                                                        <option>01</option>
                                                        <option>02</option>
                                                        <option>03</option>
                                                        <option>04</option>
                                                        <option>05</option>
                                                        <option>06</option>
                                                        <option>07</option>
                                                        <option>08</option>
                                                        <option>09</option>
                                                        <?PHP for ($i = 10; $i < 24; $i++) { ?>
                                                            <option><?= $i; ?></option>
                                                        <?PHP } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <select name="mm" class="form-control" required>
                                                        <option value="" disabled selected>เลือกนาที</option>
                                                        <option>00</option>
                                                        <option>01</option>
                                                        <option>02</option>
                                                        <option>03</option>
                                                        <option>04</option>
                                                        <option>05</option>
                                                        <option>06</option>
                                                        <option>07</option>
                                                        <option>08</option>
                                                        <option>09</option>
                                                        <?PHP for ($i = 10; $i < 60; $i++) { ?>
                                                            <option><?= $i; ?></option>
                                                        <?PHP } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>หลักฐานการโอน</label>
                                            <input type="file" class="form-control" accept="image/*" name="img">
                                        </div>

                                        <p align="center">
                                            <button id="summit-payment" type="button"
                                                    class="btn btn-warning">แจ้งชำระเงิน
                                            </button>
                                        </p>
                                    </form>
                                </div>
                            </div>

                        <?PHP } ?>


                    <?PHP } else { ?>
                        <p class="text-right" style="color: #812d1a; padding: 100px 0; text-align: center;">
                            กรุณาเลือกการจองที่ต้องชำระเงิน
                        </p>
                    <?PHP } ?>
                </div>
            </div>
        </div>


    </div>
</div>


<script>
    $(document).ready(function () {
        $("button#summit-payment").click(function () {
            swal({
                    title: "แจ้งเตือน",
                    text: "ยืนยันการแจ้งชำระเงิน?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "ใช่",
                    cancelButtonText: "ยกเลิก",
                    closeOnConfirm: false
                },
                function () {
                   $("form#form-payment-new").submit();
                });
        });
    });
</script>
