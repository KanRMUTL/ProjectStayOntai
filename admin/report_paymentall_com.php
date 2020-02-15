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

                <legend>รายงานการชำระเงิน</legend>


            <div class="table-tap">
                <ul class="nav nav-tabs">
                        <li><a href="report_paymentall.php?&active=1">การชำระเงินการจองโฮมสเตย์</a></li>
                        <li class='active'><a href="report_paymentall_com.php?&active=2">การชำระเงินจากค่าคอมมินชั่น</a></li>
                    </ul>
                <div class="tb_all">


                    <?PHP
                   extract($_GET);
                   $list = array();
                   ?>
                    <?PHP
                    $sql = "SELECT * FROM tb_booking a INNER JOIN tb_booking_detail b ON a.booking_id = b.booking_id INNER JOIN tb_room d ON b.room_id = d.room_id INNER JOIN tb_homestay e ON d.homestay_id = e.homestay_id INNER JOIN tb_user g ON a.user_id = g.user_id INNER JOIN tb_commission h ON a.booking_id = h.booking_id WHERE booking_detail_status BETWEEN 3 AND 5 AND booking_type = 1 ORDER BY a.booking_check_in ASC ";
                    $list = result_array($sql);
                    
                    
                    // $money = ($row['booking_detail_price'] * ($row['booking_detail_adult'] + $row['booking_detail_child'])) * $row['booking_detail_total'];
                                    

                    // $key = 0;
                    // foreach ($list as $row) {
                    // $list[$key]['payment_id'] = $row['payment_id'];
                    // $list[$key]['date'] = $row['payment_date'];
                    // $list[$key]['money'] = $row['payment_money'];
                    // $list[$key]['name'] = $row['payment_bank'];
                    // $list[$key]['booking_id'] = $row['booking_id'];
                    // $money = $row['payment_money'];
                    // $list[$key]['money'] = $money;
                    // $key++;

                    // }    
                    ?>

                   


                     <!-- PC Screen -->   
                    <div class="tb_all d-none d-sm-block">
                    <table class="table table-striped table-bordered table-hover" id="table-js">
                        <thead>
                        <tr>
                            <th width="50">ลำดับ</th>
                            <th>วันที่</th>
                            <th>เลขที่การจอง</th>
                            <th>โฮมสเตย์</th>
                            <th>ส่วนเเบ่ง</th>
                            <th>จำนวนเงิน</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sum = 0;
                        ?>
                        <?PHP foreach ($list as $key => $row) { ?>
                            
                            <tr>
                                <td class="center"><?= $key + 1; ?></td>
                                <td class="center">
                                    <?= date_th($row['booking_check_in']); ?>
                                </td>
                                <td class="center"><?= booking_id($row['booking_id']); ?></td>
                                <td class="center"><?= $row['homestay_name'] ?></td>
                                <td class="center"><?= $row['commission_commis']; ?>%</td>
                                <?PHP
                                    $money = ($row['booking_detail_price'] * ($row['booking_detail_adult'] + $row['booking_detail_child'])) * $row['booking_detail_total'];
                                    ?>
                               
                                <td class="center"><?= number_format($amout=$money * ($row['commission_commis'] / 100), 2) ?> บาท</td>
                                
                                <?PHP
                                $sum = $sum + $amout;
                                ?>
                
                            </tr>
                        <?PHP } ?>

                        </tbody>
                    </table>
                    </div>
                    <div style="text-align: left; margin: 0px 25px;">
                        <b>ราคารวม</b> <b>: <?= $sum; ?> บาท</b>
                    </div>
                     <!-- End PC Screen --> 

                    <!-- Mobile Screen -->    
                    <table class="table table-striped table-bordered table-hover d-block d-sm-none" id="table-mobile">
                        <thead>
                            <tr>
                                <th >รายการ</th>
                            </tr>
                            </thead>
                        <tbody>
                              <?PHP foreach ($list as $key => $row) { ?>
                                 <tr>
                                    <td class="text-left">
                                        <div style="white-space: normal;">
                                        <ul class="list-group">
                                            <li class="list-group-item text-center">
                                                <b>ลำดับที่ <?= $key + 1; ?></b> 
                                            </li>
                                            <li class="list-group-item">
                                                <b>วันที่ชำระเงิน : </b><?= $row['payment_date']; ?><br>
                                                <b>ชื่อธนาคาร : </b><?= $row['payment_bank']; ?><br>
                                                <b>ชื่อผู้ชำระเงิน  : </b><?= $row['user_titlename']; ?><?= $row['user_name']; ?> <?= $row['user_lastname']; ?> <br>
                                                <b>จำนวนเงิน : </b><?= number_format($row['payment_money']); ?> <br>
                                                <b>สถานะ : </b> <?= booking_status($row['booking_status']); ?> <br>
                                             </li>
                                         </ul>
                                     </div>
                                    </td>
                                </tr>
                            <?PHP } ?>
                        </tbody>
                    </table>
                    <!--End Mobile Screen -->   
                    <hr>

                    <a href="report.php" class="btn btn-warning">ย้อนกลับ</a>
                    <a href="../print_paymentall_com.php" class="btn btn-warning d-none d-sm-inline" >ปริ้นรายงาน</a>
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