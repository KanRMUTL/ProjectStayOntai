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

    <?PHP
    extract($_GET);
    $sql = "SELECT * FROM tb_booking a INNER JOIN tb_user b ON a.user_id = b.user_id WHERE a.booking_id = '{$id}' ";
    $row = row_array($sql);

    $sql = "SELECT * FROM tb_booking_detail b INNER JOIN tb_room d ON b.room_id = d.room_id INNER JOIN tb_homestay e ON d.homestay_id = e.homestay_id WHERE b.booking_id = '$id' ";
    $result = result_array($sql);
    ?>
    

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
        <b>รหัสการจอง : </b> <?= booking_id($row['booking_id']); ?> <br>
        <b>วันที่ออกใบเสร็จ : </b> <?= datetime_th($row['booking_date']); ?> <br>
    </p>

    <p>
        <b>วันที่เช็คอิน : </b> <?= date_th($row['booking_check_in']); ?> <br>
        <b>วันที่เช็คเอาท์ : </b> <?= date_th($row['booking_check_out']); ?> <br>
        <b>สถานะ : </b> <?= booking_status($row['booking_status']); ?> <br>
    </p>
    <h1>ใบจองห้องพัก</h1>

    <table class="table table-bordered">
        <tr style="background: #eeeeee;">
            <th class="text-center" colspan="2">ชื่อและที่อยู่ของลูกค้า</th>
        </tr>
        <tr>
            <th width="200">ชื่อลูกค้า :</th>
            <td>
                <?= $row['user_titlename']; ?><?= $row['user_name']; ?> <?= $row['user_lastname']; ?>
            </td>
        </tr>
        <tr>
            <th width="200">ที่อยู่ :</th>
            <td>
                <?= $row['user_address']; ?>
            </td>
        </tr>
        <tr>
            <th width="200">อีเมล :</th>
            <td>
                <?= $row['user_email']; ?>
            </td>
        </tr>
        <tr>
            <th width="200">เบอร์โทร :</th>
            <td>
                <?= $row['user_tel']; ?>
            </td>
        </tr>
    </table>

    <table class="table table-bordered">

        <thead>
            <tr style="background: #eeeeee;">
                <th class="text-center" colspan="6">รายละเอียด</th>
            </tr>
            <tr>
                <th class="text-center" width="50">ลำดับ</th>
                <th class="text-center">ห้อง</th>
                <th class="text-center">จำนวนคนที่พัก</th>
                <th class="text-center">จำนวนคืนที่พัก</th>
                <th class="text-center" width="100">สถานะ</th>
                <th class="text-center" width="150">ราคารวม</th>

            </tr>
        </thead>
        <tbody>
            <?PHP foreach ($result as $key => $value) { ?>
                <tr>
                    <td class="text-center"><?= $key + 1; ?></td>
                    <td class="text-left">
                        <b>โฮมสเตย์ :</b> <?= $value['homestay_name'] ?> <br>
                        <b>ห้อง :</b> <?= $value['room_name'] ?> <br>
                        <b>ประเภท :</b> <?= $value['room_type'] ?> <br>
                        <b>จำนวนเด็ก :</b> <?= $value['booking_detail_child'] ?>&nbsp;คน <br>
                        <b>จำนวนผู้ใหญ่ :</b> <?= $value['booking_detail_adult'] ?>  &nbsp;คน <br>
                        <!-- <b>จำนวนคืน :</b> <?= $value['booking_detail_total'] ?> <br> -->
                    </td>

                    <!--จำนวนห้องคนที่พัก-->
                    <td class="text-center">
                       <?php   $people=($value['booking_detail_child']+$value['booking_detail_adult']); ?>
                       <?= $people?> &nbsp;คน
                   </td>
                   <!----->

                   <!--จำนวนคืนที่พัก-->
                   <td class="text-center">
                    <?php $amount=($value['booking_detail_total']); ?>
                    <?= $amount?> &nbsp;คืน
                </td>
                <!----->

                <td class="text-center">
                    <?= booking_detail_status($value['booking_detail_status']); ?>
                </td>

                <td class="text-center">
                    <?PHP
                    $total = ($value['booking_detail_price'] * ($value['booking_detail_adult'] + $value['booking_detail_child'])) * $value['booking_detail_total'];
                    ?>
                    <?= $total; ?>
                    บาท
                </td>


            </tr>
            <?PHP } ?>

            <tr>
                <th class="text-right" colspan="5">ค่าธรรมเนียม(บาท)</th>
                <td>0 บาท</td>
            </tr>
            <tr>
                <th class="text-right" colspan="5">ค่าธรรมเนียม(บาท)</th>
                <td><?= $row['booking_sum'] ?> บาท</td>
            </tr>
        </tbody>
    </table>

    <div style="text-align: right;">
        ลงชื่อ............................................................................ <br>
        เจ้าของโฮมสเตย์

    </div>

</div>

</body>
</html>
