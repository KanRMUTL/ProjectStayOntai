<?PHP
include 'function/db_function.php';
include 'function/function.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>รายงานรายรับรายจ่าย</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <style>
        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box
        }

        .a4 {
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

        .sumcus {
            text-align: center;
            font-size: 17px;
            font-weight: bold;
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
            .a4 {
                border: none;
                height: 205mm;
            }

            .print {
                display: none;
            }
        }

        .review {
            text-align: left;
            font-size: 13px;
            font-weight: bold;
        }

    </style>
</head>

<body>


<p class="text-center print" style="padding: 20px;">
    <button onclick="return window.print();" type="button" class="btn btn-primary"><i class="fa fa-print"></i>
        พิมพ์
    </button>
</p>

<div class="a4">

    <?PHP
    extract($_GET);
    $sql = "SELECT * FROM tb_homestay";
    $result = result_array($sql);
    ?>

    <img src="assets/images/logo_footer.png"
         style="width: 150px; height: auto; position: absolute; right: 85px; top: 20px;" alt="">

    <p>
        ชุมชนออนใต้ <br>
        ตำบลออนใต้ อำเภอสันกำแพง <br>
        เชียงใหม่ รหัสไปรษณีย์ 50130 <br>
        โทร 098-6169666 <br>
    </p>
    <b>วันที่ออกใบเสร็จ : </b> <?php echo date("d-m-y h:i:s", strtotime("now")); ?> <br>
    </p>
    <br>
    <br>

    <h1>รายงานข้อมูลรายรับรายจ่าย</h1>
    <p class="text-center">
        <b>ประจำเดือน :</b> <?=mount_name($mm);?> <?= $yy + 543; ?>
    </p>

    <table class="table table-bordered">

        <thead>
        <tr style="background: #eeeeee;">
            <th class="text-center" colspan="5">รายละเอียด</th>
        </tr>
        <tr>
            <th class="text-center" width="50">ลำดับ</th>
            <th class="text-center" width="2500">รายการ</th>
            <th class="text-center" width="2100">รายรับ</th>
            <th class="text-center" width="1000">รายจ่าย</th>
            <th class="text-center" width="1000">รวม</th>

        </tr>
        </thead>
        <tbody>

        <?PHP foreach ($result as $key => $row) { ?>
            <tr>
                <td class="text-center"><?= $key + 1; ?></td>
                <td class="center"><?= $row['homestay_name']; ?></td>
                <td class="text-center">
                    <?PHP
                    $sql = "SELECT COALESCE(SUM(booking_detail_price * (booking_detail_adult + booking_detail_child ) * booking_detail_total),0) as num FROM tb_booking_detail a INNER JOIN tb_booking b ON a.booking_id = b.booking_id INNER JOIN tb_room d ON a.room_id = d.room_id WHERE d.homestay_id = '{$row['homestay_id']}' AND MONTH(booking_date) = '{$mm}' AND YEAR(booking_date) = '{$yy}' AND booking_detail_status BETWEEN 3 AND 5";
                    $count1 = row_array($sql);

                    $sql = "SELECT COALESCE(SUM(ledger_money),0) as num FROM tb_ledger WHERE homestay_id = '{$row['homestay_id']}' AND MONTH(ledger_date) = '{$mm}' AND YEAR(ledger_date) = '{$yy}' AND ledger_type = 1";
                    $count2 = row_array($sql);

                    $moneys1 = $count1['num'] + $count2['num'];

                    echo number_format($moneys1, 2);
                    ?>
                </td>
                <td class="text-center">
                    <?PHP
                    $sql = "SELECT COALESCE(SUM(ledger_money),0) as num FROM tb_ledger WHERE homestay_id = '{$row['homestay_id']}' AND MONTH(ledger_date) = '{$mm}' AND YEAR(ledger_date) = '{$yy}' AND ledger_type = 2";
                    $count3 = row_array($sql);

                    $sql = "SELECT COALESCE(SUM((booking_detail_price * (booking_detail_adult + booking_detail_child ) * booking_detail_total) * (commission_commis / 100)),0) as num FROM tb_booking_detail a INNER JOIN tb_booking b ON a.booking_id = b.booking_id INNER JOIN tb_room d ON a.room_id = d.room_id INNER JOIN tb_commission f ON a.booking_id = f.booking_id WHERE d.homestay_id = '{$row['homestay_id']}' AND MONTH(booking_date) = '{$mm}' AND YEAR(booking_date) = '{$yy}' AND booking_detail_status BETWEEN 3 AND 5";
                    $count4 = row_array($sql);

                    $moneys2 = $count3['num'] + $count4['num'];

                    echo number_format($moneys2, 2);

                    ?>
                </td>
                <td class="text-center">
                    <?=number_format($moneys1 - $moneys2, 2);?>
                </td>
            </tr>

        <?php } ?>

        </tbody>
    </table>

    <div style="text-align: right;">
        ลงชื่อ............................................................................ <br>
        เจ้าของโฮมสเตย์

    </div>

</div>

</body>
</html>
