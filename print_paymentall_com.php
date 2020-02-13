<?PHP
include 'function/db_function.php';
include 'function/function.php';

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>รายงาน</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <script src="printThis.js"></script>

    <style>
        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box
        }

        #print-div {
            position: relative;
            height: auto;
            width: 210mm;
            min-height: 250mm;
            margin: 20px auto 20px auto;
            border: 1px solid #f1f1e3;
            padding: 20px 40px;
            line-height: 20px;
            overflow: hidden;
        }

        h1 {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            padding-top: 20px;
            line-height: 30px;
        }

        h2 {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            padding-bottom: 2px;
            line-height: 30px;
            font-weight: normal;
        }

        span {
            padding: 0 50px 0 15px;
            border-bottom: 1px dashed #000;
        }

        .sen {
            width: 300px;
            height: 75px;
            font-size: 12px;
            text-align: center;
            line-height: 18px;
            padding-top: 20px;
            clear: both;
        }

        .bor_titel {
            width: 49%;
            border: 2px solid #000;
            border-radius: 20px;
            padding: 20px 10px;
            margin-bottom: 30px;
        }

        table.tb_title {
            width: 100%;
            height: 80px;
        }

        @media print {
            #print-div {
                border: none;
                height: 205mm;
            }

            .print {
                display: none;
            }
        }
        @media print {
            .panel-heading {
                display:none
            }
        }

    </style>
</head>

<body>





  <p class="text-center print" style="padding: 20px;">
    <button onclick="return window.print();" type="button" class="btn btn-primary"><i class="fa fa-print"></i>
        พิมพ์
    </button>
</p>


<div id="print-div">

    <img src="assets/images/logo_footer.png"
    style="width: 150px; height: auto; position: absolute; right: 85px; top: 20px;" alt="">

    <p>
        ชุมชนออนใต้ <br>
        ตำบลออนใต้ อำเภอสันกำแพง <br>
        เชียงใหม่ รหัสไปรษณีย์ 50130 <br>
        โทร 098-6169666 <br>
    </p>

    <p>
        <b>วันที่ออกใบเสร็จ : </b> <?php echo date("d-m-y h:i:s",strtotime("now"));?>  <br>
    </p>
    <br>
    <br>
    <h1>รายงานการชำระเงินทั้งหมด</h1>

    <table class="table table-bordered">

        <thead>
            <tr style="background: #eeeeee;">
                <th class="text-center" colspan="7">รายละเอียด</th>
            </tr>
            <tr>
                <th class="text-center" width="50">ลำดับ</th>
                <th class="text-center" width="2500">วันที่</th>
                <th class="text-center" width="2500">เลขที่การจอง</th>
                <th class="text-center" width="1500">โฮมสเตย์</th>
                <th class="text-center" width="1500">ส่วนเเบ่ง</th>
                <th class="text-center" width="1500">จำนวนเงิน</th>
                
                
            </tr>
        </thead>
        <tbody>
             <?PHP
                   extract($_GET);
                   $list = array();
                   ?>
                    <?PHP
                    $sql = "SELECT * FROM tb_booking a INNER JOIN tb_booking_detail b ON a.booking_id = b.booking_id INNER JOIN tb_room d ON b.room_id = d.room_id INNER JOIN tb_homestay e ON d.homestay_id = e.homestay_id INNER JOIN tb_user g ON a.user_id = g.user_id INNER JOIN tb_commission h ON a.booking_id = h.booking_id WHERE booking_detail_status BETWEEN 3 AND 5 AND booking_type = 1 ORDER BY a.booking_check_in ASC ";
                    $list = result_array($sql);

            $sum = 0;  
           ?>

           <?PHP foreach ($list as $key => $row) { ?>
           
            <tr>
                <td class="center"><?= $key + 1; ?></td>
                 <td class="center"><?= date_th($row['booking_check_in']); ?></td>
                <td class="center"><?= booking_id($row['booking_id']); ?></td>
                <td class="center"><?= $row['homestay_name'] ?></td>
                <td class="center"><?= $row['commission_commis']; ?>%</td>
                <td class="center"><?= $row['homestay_name'] ?></td>
                 <?PHP
                                    $money = ($row['booking_detail_price'] * ($row['booking_detail_adult'] + $row['booking_detail_child'])) * $row['booking_detail_total'];
                                    ?>
                               
                                <td class="center"><?= number_format($amout=$money * ($row['commission_commis'] / 100), 2) ?> บาท</td>
                                
                                <?PHP
                                $sum = $sum + $amout;
                                ?>
                        <?PHP } ?>
        </tr>
         <tr>
                <td colspan="6" style="text-align: right;"><b style="margin: 0px 33px;">ราคารวม :</b> <b> <?= $sum; ?> บาท</b></td>
        </tr>
    </tbody>
</table>
<br>
<br>
<div style="text-align: right;">
    ลงชื่อ............................................................................ <br>
    เจ้าของโฮมสเตย์

</div>

</div>

</body>
</html>
