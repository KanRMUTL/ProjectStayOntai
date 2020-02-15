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



                <div class="tb_all">

                    
                    <?PHP

                    extract($_GET);
    $list = array();
   $uid = check_session("id");
           $sql = "SELECT * FROM tb_payment p INNER JOIN tb_booking b ON p.booking_id = b.booking_id INNER JOIN tb_user u ON b.user_id = u.user_id INNER JOIN tb_booking_detail d ON b.booking_id = d.booking_id INNER JOIN tb_room m ON d.room_id = m.room_id INNER JOIN tb_homestay e ON m.homestay_id = e.homestay_id WHERE e.user_id='{$uid}' AND booking_status BETWEEN 3 AND 6 ORDER BY payment_id DESC ";
    $result = result_array($sql);


    $key = 0;
    foreach ($result as $row) {
        $list[$key]['payment_id'] = $row['payment_id'];
        $list[$key]['payment_date'] = $row['payment_date'];
        $list[$key]['payment_money'] = $row['payment_money'];
        $list[$key]['payment_bank'] = $row['payment_bank'];
        $list[$key]['booking_id'] = $row['booking_id'];
    

      
    }   



                    ?>

                     <!-- PC Screen -->   
                    <div class="tb_all d-none d-sm-block">
                    <table class="table table-striped table-bordered table-hover" id="table-js">
                        <thead>
                        <tr>
                            
                            <th>วันที่ชำระเงิน</th>
                            <th>ชื่อธนาคาร</th>
                            <th>ชื่อผู้ชำระเงิน</th>
                            <th>จำนวนเงิน</th>
                           
                        </tr>
                        </thead>
                        <tbody>
                        <?PHP
                            $sum = 0;
                            ?>
                        <?PHP foreach ($result as $row) { ?>
                            <?PHP
                                $sum = $sum + $row['payment_money'];
                                ?>
                            <tr>
                               
                                <td class="center">
                                    <?= $row['payment_date']; ?>
                                </td>
                                <td class="center"><?= $row['payment_bank']; ?></td>
                                 <td class="center"><?= $row['user_titlename']; ?><?= $row['user_name']; ?> <?= $row['user_lastname']; ?> </td>
                                <td class="center"><?= number_format($row['payment_money'],2); ?></td>
                                
                            </tr>
                        <?PHP } ?>
                        </tbody>
                    </table>
                    </div>
                     <div style="text-align: left; margin: 0px 25px;">
                        <b>เงินที่ชำระจากลูกค้าที่มาพัก รวม</b> <b>: <?= number_format($sum,2); ?> บาท</b>
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
                              <?PHP foreach ($result as  $row) { ?>
                                 <tr>
                                    <td class="text-left">
                                        <div style="white-space: normal;">
                                        <ul class="list-group">
                                         
                                            <li class="list-group-item">
                                                <b>วันที่ชำระเงิน : </b><?= $row['payment_date']; ?><br>
                                                <b>ชื่อธนาคาร : </b><?= $row['payment_bank']; ?><br>
                                                <b>ชื่อผู้ชำระเงิน  : </b><?= $row['user_titlename']; ?><?= $row['user_name']; ?> <?= $row['user_lastname']; ?> <br>
                                                <b>จำนวนเงิน : <?= number_format($row['payment_money'],2); ?> <br>
                                               
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
                    <a href="../print_homestay_paymentall.php" class="btn btn-warning d-none d-sm-inline" >ปริ้นรายงาน</a>
                    <br>
                    <br>
                </div>
            </div>
        </div>
    </div>

</div>

<?PHP include "include/footer.php"; ?>



</body>
</html>