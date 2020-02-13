<!doctype html>
<html>
<head>
    <?PHP include "include/script.php"; ?>
</head>
<body>


<?PHP include "include/header.php"; ?>


<div class="container main">

    <?PHP include "include/right.php"; ?>


    <div class="col-sm-9 col-lg-9">

        <h3 class="text-center" style="color: #000000; font-weight: bold;">รายงาน</h3>
        <?PHP if (check_session('role') == 3) { ?>
            <div class="row">

                <div class="col-sm-4 col-lg-4">
                    <a href="report_customer.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/user.png">
                            </div>
                            <h1>รายงานข้อมูลลูกค้า</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="report_user.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/user2.png">
                            </div>
                            <h1>รายงานข้อมูลพนักงาน</h1>
                        </div>
                    </a>
                </div>

            </div>

        <?PHP } elseif (check_session('role') == 2) { ?>
            <div class="row">
                <div class="col-sm-4 col-lg-4">
                    <a href="report_chart_booking.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/barchart.png">
                            </div>
                            <h1>รายงานยอดลูกค้าที่เข้าพัก</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="report_booking.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/folder_customer.png">
                            </div>
                            <h1>รายงานสรุปจำนวนลูกค้า</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="report_check_in.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/checkin.png">
                            </div>
                            <h1>รายงานการเข้าพักของลูกค้า</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="report_checkout.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/checkout.png">
                            </div>
                            <h1>รายงานการออกที่พักของลูกค้า</h1>
                        </div>
                    </a>
                </div>


                <div class="col-sm-4 col-lg-4">
                    <a href="report_customer.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/user.png">
                            </div>
                            <h1>รายงานข้อมูลลูกค้า</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="report_review.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/qq.png">
                            </div>
                            <h1>รายงานคะแนนรีวิว</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="report_commission.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/commission.png">
                            </div>
                            <h1>รายงานค่าคอมมิชชั่น</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="report_paymentall.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/moenyall.png">
                            </div>
                            <h1>รายงานการชำระเงินทั้งหมด</h1>
                        </div>
                    </a>
                </div>

            </div>


        <?PHP } elseif (check_session('role') == 1) { ?>
            <div class="row">
                <div class="col-sm-4 col-lg-4">
                    <a href="report_homestay_chart_booking.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/barchart.png">
                            </div>
                            <h1>รายงานยอดลูกค้าที่เข้าพัก</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="report_homestay_booking.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/folder_customer.png">
                            </div>
                            <h1>รายงานสรุปจำนวนลูกค้า</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="report_homestay_check_in.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/checkin.png">
                            </div>
                            <h1>รายงานการเข้าพักของลูกค้า</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="report_homestay_checkout.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/checkout.png">
                            </div>
                            <h1>รายงานการออกที่พักของลูกค้า</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="report_money.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/money.png">
                            </div>
                            <h1>รายงานรายรับ-รายจ่าย</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="report_customer.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/user.png">
                            </div>
                            <h1>รายงานข้อมูลลูกค้า</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="report_homestay_review.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/qq.png">
                            </div>
                            <h1>รายงานคะแนนรีวิว</h1>
                        </div>
                    </a>
                </div>
                <div class="col-sm-4 col-lg-4">
                    <a href="report_homestay_paymentall.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/moenyall.png">
                            </div>
                            <h1>รายงานการชำระเงินทั้งหมด</h1>
                        </div>
                    </a>
                </div>


            </div>

        <?PHP } elseif (check_session('role') == 0) { ?>
            <div class="row">
                <div class="col-sm-4 col-lg-4">
                    <a href="report_chart_booking.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/barchart.png">
                            </div>
                            <h1>รายงานยอดลูกค้าที่เข้าพัก</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="report_booking.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/folder_customer.png">
                            </div>
                            <h1>รายงานสรุปจำนวนลูกค้า</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="report_check_in.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/checkin.png">
                            </div>
                            <h1>รายงานการเข้าพักของลูกค้า</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="report_checkout.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/checkout.png">
                            </div>
                            <h1>รายงานการออกที่พักของลูกค้า</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="report_money.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/money.png">
                            </div>
                            <h1>รายงานรายรับ-รายจ่าย</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="report_customer.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/user.png">
                            </div>
                            <h1>รายงานข้อมูลลูกค้า</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="report_review.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/qq.png">
                            </div>
                            <h1>รายงานคะแนนรีวิว</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="report_commission.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/commission.png">
                            </div>
                            <h1>รายงานค่าคอมมิชชั่น</h1>
                        </div>
                    </a>
                </div>

            </div>
        <?PHP } ?>
    </div>


</div>

<?PHP include "include/footer.php"; ?>


</body>
</html>