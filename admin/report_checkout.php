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
        $start = date("Y-m-d");
        $end =  date("Y-m-d");
        if (isset($_GET['start']) && isset($_GET['end'])) {
            $start = $_GET['start'];
            $end = $_GET['end'];
        }
        ?>


        <div class="col-sm-9 col-lg-9">
            <div id="register-wraper">
                <div id="register-form" style="position: relative;">

                    <legend>รายงานการออกที่พักของลูกค้า</legend>

                    <?PHP
                    $sql = "SELECT * FROM tb_otop";
                    $list = result_array($sql);
                    ?>

                    <div class="tb_all">
                        <div class="row" style="margin-bottom: 30px;">
                            <form action="">

                               <label class="col-md-2 control-label"
                               style="font-size: 22px; text-align: right; padding-top: 3px;">วันที่</label>

                               <div class="col-md-3">
                                <div class="form-group">
                                    <input type="date" class="form-control" name="start" value="<?=$start?>" required>
                                </div>
                            </div>

                            <label class="col-md-1 control-label"
                            style="font-size: 22px; text-align: center;  padding-top: 3px;">ถึง</label>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="date" class="form-control" name="end" value="<?=$end?>" required>
                                </div>
                            </div>

                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary" name="day">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!----------------------------------------- ค้นหาเดือนตาม เดือน------------------------>
                    <?PHP
                    $yy = date("Y");
                    $mm = date("m");
                    if (isset($_GET['yy']) && isset($_GET['mm'])) {
                        $yy = $_GET['yy'];
                        $mm = $_GET['mm'];
                    }
                    ?>
                    <div class="row" style="margin-bottom: 15px;">
                        <form action="" method="get">
                            <div class="form-group" style="margin-top: -3%;">
                                <label class="col-md-2 control-label"
                                style="font-size: 22px; text-align: right; padding-top: 3px;">เดือน</label>

                                <div class="col-md-3">
                                    <select name="mm" class="form-control" required>
                                        <option <?= $mm == 1 ? "selected" : ""; ?> value="1">
                                            มกราคม
                                        </option>
                                        <option <?= $mm == 2 ? "selected" : ""; ?> value="2">
                                            กุมภาพันธ์
                                        </option>
                                        <option <?= $mm == 3 ? "selected" : ""; ?> value="3">
                                            มีนาคม
                                        </option>
                                        <option <?= $mm == 4 ? "selected" : ""; ?> value="4">
                                            เมษายน
                                        </option>
                                        <option <?= $mm == 5 ? "selected" : ""; ?> value="5">พฤษภาคม
                                        </option>
                                        <option <?= $mm == 6 ? "selected" : ""; ?> value="6">
                                            มิถุนายน
                                        </option>
                                        <option <?= $mm == 7 ? "selected" : ""; ?> value="7">กรกฎาคม
                                        </option>
                                        <option <?= $mm == 8 ? "selected" : ""; ?> value="8">สิงหาคม
                                        </option>
                                        <option <?= $mm == 9 ? "selected" : ""; ?> value="9">กันยายน
                                        </option>
                                        <option <?= $mm == 10 ? "selected" : ""; ?> value="10">
                                            ตุลาคม
                                        </option>
                                        <option <?= $mm == 11 ? "selected" : ""; ?> value="11">
                                            พฤศจิกายน
                                        </option>
                                        <option <?= $mm == 12 ? "selected" : ""; ?> value="12">
                                            ธันวาคม
                                        </option>
                                    </select>
                                </div>

                                <label class="col-md-1 control-label"
                                style="font-size: 22px; text-align: center;  padding-top: 3px;">พ.ศ.</label>


                                <div class="col-md-3">
                                    <select name="yy" class="form-control" required>
                                        <?PHP for ($y = 2000; $y < 2100; $y++) { ?>
                                            <option <?= $yy == $y ? "selected" : ""; ?>
                                            value="<?= $y; ?>"><?= $y + 543; ?></option>
                                            <?PHP } ?>
                                        </select>
                                    </div>


                                    <div class="col-md-1">
                                       <button type="submit" class="btn btn-primary" name="year">
                                        <i class="fa fa-search"></i>
                                    </button>


                                </div>
                            </div>
                        </form>
                    </div>

                    <!----------------------------------------- ค้นหาเดือนตาม เดือน------------------------>

                    <?PHP
                    if(isset($_GET["day"])){ 

                        $sql = "SELECT * FROM tb_booking a INNER JOIN tb_booking_detail b ON a.booking_id = b.booking_id INNER JOIN tb_room d ON b.room_id = d.room_id INNER JOIN tb_homestay e ON d.homestay_id = e.homestay_id INNER JOIN tb_user g ON a.user_id = g.user_id WHERE (booking_check_out BETWEEN '{$start} 00:00:00' AND '{$end} 23:59:59') AND booking_detail_status=5  ORDER BY a.booking_check_in ASC ";
                        $result = result_array($sql);
                        ?>

                         <!-- PC Screen -->   
                    <div class="tb_all d-none d-sm-block">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="50">ลำดับ</th>
                                    <th>รายการ</th>
                                  <!--   <th>เช็คอิน</th> -->
                                    <th>เช็คเอาท์</th>
                                 <!--    <th>ราคารวม</th>-->
                                    <th width="100">สถานะ</th> 
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

                                            <hr style="margin: 5px">

                                            <?= $row['user_titlename'] ?><?= $row['user_name'] ?> <?= $row['user_lastname'] ?> <br>
                                            <b>เบอร์โทร :</b> <?= $row['user_tel']; ?> <br>
                                            <b>อีเมล์ :</b> <?= $row['user_email']; ?> <br>
                                            <b>ว/ด/ป :</b> <?= $row['user_birth']; ?> <br>
                                        </td>

                                        <!-- <td class="center"><?= date_th($row['booking_check_in']); ?></td> -->
                                        <td class="center"><?= date_th($row['booking_check_out']); ?></td>
                                        <!-- <td>
                                            <?= ($row['booking_detail_price'] * ($row['booking_detail_adult'] + $row['booking_detail_child'])) * $row['booking_detail_total'] ?> บาท
                                        </td> -->
                                        <td class="center">
                                            <?= booking_detail_status($row['booking_detail_status']); ?>
                                        </td>

                                    </tr>
                                    <?PHP } ?>
                                    </tbody>
                                    </table>
                                </div>
                                 <!-- End PC Screen --> 

                                <?php }elseif(isset($_GET["year"])){ ?>
                                    <?php
                                    $sql = "SELECT * FROM tb_booking a INNER JOIN tb_booking_detail b ON a.booking_id = b.booking_id INNER JOIN tb_room d ON b.room_id = d.room_id INNER JOIN tb_homestay e ON d.homestay_id = e.homestay_id INNER JOIN tb_user g ON a.user_id = g.user_id WHERE ( MONTH(booking_check_out) = '{$mm}' AND YEAR(booking_check_out) = '{$yy}') AND booking_detail_status=5  ORDER BY a.booking_check_in ASC ";
                                    $result = result_array($sql);
                                    ?>

                                      <!-- PC Screen -->   
                                     <div class="tb_all d-none d-sm-block">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th width="50">ลำดับ</th>
                                                <th>รายการ</th>
                                                <!-- <th>เช็คอิน</th> -->
                                                <th>เช็คเอาท์</th>
                                               <!--  <th>ราคารวม</th> -->
                                                <th width="100">สถานะ</th>
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

                                                        <hr style="margin: 5px">

                                                        <?= $row['user_titlename'] ?><?= $row['user_name'] ?> <?= $row['user_lastname'] ?> <br>
                                                        <b>เบอร์โทร :</b> <?= $row['user_tel']; ?> <br>
                                                        <b>อีเมล์ :</b> <?= $row['user_email']; ?> <br>
                                                        <b>ว/ด/ป :</b> <?= $row['user_birth']; ?> <br>
                                                    </td>

                                                    <!-- <td class="center"><?= date_th($row['booking_check_in']); ?></td> -->
                                                    <td class="center"><?= date_th($row['booking_check_out']); ?></td>
                                                  <!--   <td>
                                                        <?= ($row['booking_detail_price'] * ($row['booking_detail_adult'] + $row['booking_detail_child'])) * $row['booking_detail_total'] ?> บาท
                                                    </td> -->
                                                    <td class="center">
                                                        <?= booking_detail_status($row['booking_detail_status']); ?>
                                                    </td>

                                                </tr>
                                                <?PHP } ?>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- End PC Screen --> 

                  

                    <?PHP
                    if(isset($_GET["day"])){ 

                        $sql = "SELECT * FROM tb_booking a INNER JOIN tb_booking_detail b ON a.booking_id = b.booking_id INNER JOIN tb_room d ON b.room_id = d.room_id INNER JOIN tb_homestay e ON d.homestay_id = e.homestay_id INNER JOIN tb_user g ON a.user_id = g.user_id WHERE (booking_check_out BETWEEN '{$start} 00:00:00' AND '{$end} 23:59:59') AND booking_detail_status=5  ORDER BY a.booking_check_in ASC ";
                        $result = result_array($sql);
                        ?>
                    <!-- Mobile Screen -->    
                    <table class="table table-striped table-bordered table-hover  d-sm-none" id="table-mobile">
                        
                        <tbody>
                              <?PHP foreach ($result as $key => $row) { ?>
                                 <tr>
                                     <td class="text-left">
                                        <ul class="list-group">
                                            <li class="list-group-item text-center">
                                                <b>ลำดับที่ <?= $key + 1; ?></b> 
                                            </li>
                                            <li class="list-group-item">
                                                <b>เลขที่การจอง :</b> <?= booking_id($row['booking_id']); ?> <br>
                                                <b>โฮมสเตย์ :</b> <?= $row['homestay_name'] ?> <br>
                                                <b>ห้อง :</b> <?= $row['room_name'] ?> <br>

                                                 <hr style="margin: 5px">

                                                <?= $row['user_titlename'] ?><?= $row['user_name'] ?> <?= $row['user_lastname'] ?> <br>
                                                <b>เบอร์โทร :</b> <?= $row['user_tel']; ?> <br>
                                                <b>อีเมล์ :</b> <?= $row['user_email']; ?> <br>
                                             <b>ว/ด/ป :</b> <?= $row['user_birth']; ?> <br>
                                             <b>เช็คเอาท์ :</b> <?= date_th($row['booking_check_out']); ?> <br>
                                             <b>สถานะ :</b> <?= booking_detail_status($row['booking_detail_status']); ?>
                                             </li>
                                         </ul>
                                            </td>

                                       

                                    </tr>
                                    <?PHP } ?>
                                    </tbody>
                                    </table>
                               <!-- Mobile Screen -->   


                                <?php }elseif(isset($_GET["year"])){ ?>
                                    <?php
                                    $sql = "SELECT * FROM tb_booking a INNER JOIN tb_booking_detail b ON a.booking_id = b.booking_id INNER JOIN tb_room d ON b.room_id = d.room_id INNER JOIN tb_homestay e ON d.homestay_id = e.homestay_id INNER JOIN tb_user g ON a.user_id = g.user_id WHERE ( MONTH(booking_check_out) = '{$mm}' AND YEAR(booking_check_out) = '{$yy}') AND booking_detail_status=5  ORDER BY a.booking_check_in ASC ";
                                    $result = result_array($sql);
                                    ?>
                                    <!-- Mobile Screen -->    
                    <table class="table table-striped table-bordered table-hover  d-sm-none" id="table-mobile">
                        
                        <tbody>
                              <?PHP foreach ($result as $key => $row) { ?>
                                 <tr>
                                     <td class="text-left">
                                        <ul class="list-group">
                                            <li class="list-group-item text-center">
                                                <b>ลำดับที่ <?= $key + 1; ?></b> 
                                            </li>
                                            <li class="list-group-item">
                                                <b>เลขที่การจอง :</b> <?= booking_id($row['booking_id']); ?> <br>
                                                <b>โฮมสเตย์ :</b> <?= $row['homestay_name'] ?> <br>
                                                <b>ห้อง :</b> <?= $row['room_name'] ?> <br>

                                                 <hr style="margin: 5px">

                                                <?= $row['user_titlename'] ?><?= $row['user_name'] ?> <?= $row['user_lastname'] ?> <br>
                                                <b>เบอร์โทร :</b> <?= $row['user_tel']; ?> <br>
                                                <b>อีเมล์ :</b> <?= $row['user_email']; ?> <br>
                                             <b>ว/ด/ป :</b> <?= $row['user_birth']; ?> <br>
                                             <b>เช็คเอาท์ :</b> <?= date_th($row['booking_check_out']); ?> <br>
                                             <b>สถานะ :</b> <?= booking_detail_status($row['booking_detail_status']); ?>
                                             </li>
                                         </ul>
                                            </td>

                                       

                                    </tr>
                                    <?PHP } ?>
                                       <?PHP } ?>
                                    </tbody>
                                    </table>
                               <!-- Mobile Screen -->   


                           

                                    <hr>

                                    <a href="report.php" class="btn btn-warning">ย้อนกลับ</a>
                                    <a href="../print_checkout.php?start=<?=$start;?>&end=<?=$end;?>" class="btn btn-warning d-none d-sm-inline">ปริ้นรายงานรายวัน</a>
                                    <a href="../print_mount_checkout.php?yy=<?=$yy;?>&mm=<?=$mm;?>" class="btn btn-warning d-none d-sm-inline">ปริ้นรายงานรายเดือน</a>

                                    <br>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>

            <?PHP include "include/footer.php"; ?>



        </body>
        </html>