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
        <?PHP if (check_session('role') == 3) { ?>
            <div class="row">

                <div class="col-sm-4 col-lg-4">
                    <a href="secretary.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/user2.png">
                            </div>
                            <h1>จัดการเลขานุการ</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="agency.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/agency.png">
                            </div>
                            <h1>จัดการเอเจนซี่</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="owner.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/user.png">
                            </div>
                            <h1>จัดการเจ้าของโฮมสเตย์</h1>
                        </div>
                    </a>
                </div>


                <div class="col-sm-4 col-lg-4">
                    <a href="visitplace.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/travel.png">
                            </div>
                            <h1>จัดการสถานที่ท่องเที่ยว</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="otop.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/otop.png">
                            </div>
                            <h1>จัดการสินค้า OTOP</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="news.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/newpaper.png">
                            </div>
                            <h1>จัดการข้อมูลข่าวสาร</h1>
                        </div>
                    </a>
                </div>

                <!-- <div class="col-sm-4 col-lg-4">
                    <a href="review.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/qq.png">
                            </div>
                            <h1>ตอบกลับรีวิวของลูกค้า</h1>
                        </div>
                    </a>
                </div> -->

                <div class="col-sm-4 col-lg-4">
                    <a href="list_homestay.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/homestay.png">
                            </div>
                            <h1>ข้อมูลโฮมสเตย์</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="list_booking.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/booking.png">
                            </div>
                            <h1>ข้อมูลการจองโฮมสเตย์</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="status_booking.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/use.png">
                            </div>
                            <h1>สถานะการเข้าพัก</h1>
                        </div>
                    </a>
                </div>


                <div class="col-sm-4 col-lg-4">
                    <a href="report.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/report.png">
                            </div>
                            <h1>รายงาน</h1>
                        </div>
                    </a>
                </div>



            </div>

        <?PHP } elseif (check_session('role') == 2) { ?>
            <div class="row">
                <div class="col-sm-4 col-lg-4">
                    <a href="news.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/newpaper.png">
                            </div>
                            <h1>จัดการข้อมูลข่าวสาร</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="list_homestay.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/homestay.png">
                            </div>
                            <h1>ข้อมูลโฮมสเตย์</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="list_booking.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/booking.png">
                            </div>
                            <h1>ข้อมูลการจองโฮมสเตย์</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="status_booking.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/use.png">
                            </div>
                            <h1>สถานะการเข้าพัก</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="round_booking.php?reset">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/wan.png">
                            </div>
                            <h1>จองแบบหมุนเวียนโฮมสเตย์</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="review.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/qq.png">
                            </div>
                            <h1>ตอบกลับรีวิวของลูกค้า</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="promotion.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/promotion.png">
                            </div>
                            <h1>จัดการโปรโมชั่น</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="system.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/setting.png">
                            </div>
                            <h1>ตั้งค่าระบบ</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="report.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/report.png">
                            </div>
                            <h1>รายงาน</h1>
                        </div>
                    </a>
                </div>

            </div>


        <?PHP } elseif (check_session('role') == 1) { ?>
            <div class="row">
                <div class="col-sm-4 col-lg-4">
                    <a href="homestay.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/homestay.png">
                            </div>
                            <h1>จัดการโฮมสเตย์</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="booking.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/check_booking.jpg">
                            </div>
                            <h1>จัดการการเข้าพักของลูกค้า</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="check_in.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/checkin.png">
                            </div>
                            <h1>เช็คอินห้องพัก</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="check_out.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/checkout.png">
                            </div>
                            <h1>เช็คเอาท์ห้องพัก</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="status_booking.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/use.png">
                            </div>
                            <h1>สถานะการเข้าพัก</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="ledger_income.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/money.png">
                            </div>
                            <h1>จัดการบัญชี</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="report.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/report.png">
                            </div>
                            <h1>รายงาน</h1>
                        </div>
                    </a>
                </div>

                 <div class="col-sm-4 col-lg-4">
                    <a href="news.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/newpaper.png">
                            </div>
                            <h1>จัดการข้อมูลข่าวสาร</h1>
                        </div>
                    </a>
                </div>


            </div>

        <?PHP } elseif (check_session('role') == 0) { ?>
            <div class="row">
                <div class="col-sm-4 col-lg-4">
                    <a href="list_homestay.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/homestay.png">
                            </div>
                            <h1>ข้อมูลโฮมสเตย์</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="list_booking.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/booking.png">
                            </div>
                            <h1>ข้อมูลการจองโฮมสเตย์</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="status_booking.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/use.png">
                            </div>
                            <h1>สถานะการเข้าพัก</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="round_booking.php?reset">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/wan.png">
                            </div>
                            <h1>จองแบบหมุนเวียนโฮมสเตย์</h1>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <a href="report.php">
                        <div class="dash-unit list_menu">
                            <div class="thumbnail">
                                <img src="assets/img/icon/report.png">
                            </div>
                            <h1>รายงาน</h1>
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