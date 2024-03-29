<?PHP
include 'function/db_function.php';
include 'function/function.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>รายงานการรีวิวที่พัก</title>
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
        .review{
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

        <img src="assets/images/logo_footer.png"
        style="width: 150px; height: auto; position: absolute; right: 85px; top: 20px;" alt="">

        <p>
            ชุมชนออนใต้ <br>
            ตำบลออนใต้ อำเภอสันกำแพง <br>
            เชียงใหม่ รหัสไปรษณีย์ 50130 <br>
            โทร 098-6169666 <br>
        </p>
        <b>วันที่ออกใบเสร็จ : </b> <?php echo date("d-m-y h:i:s",strtotime("now"));?> <br>
    </p>
    <br>
    <br>

    <h1>รายงานข้อมูลรีวิวที่พัก</h1>

    <table class="table table-bordered">

        <thead>
            <tr style="background: #eeeeee;">
                <th class="text-center" colspan="4">รายละเอียด</th>
            </tr>
            <tr>
                <th class="text-center" width="50">ลำดับ</th>
                <th class="text-center" width="2500">โฮมสเตย์</th>
                <th class="text-center" width="2100">ชื่อคนที่รีวิวโฮมสเตย์</th>
                <th class="text-center" width="1000">ภาพรวม(คะเเนน)</th>
                
            </tr>
        </thead>
        <tbody>
            <?PHP
            $sql = "SELECT * FROM tb_review a INNER JOIN tb_user b ON a.user_id = b.user_id INNER JOIN tb_homestay d ON a.homestay_id = d.homestay_id ORDER BY review_id DESC ";
            $list = result_array($sql);
            ?>
             <?PHP foreach ($list as $key => $row) { ?>
                <tr>
                    <td class="center"><?= $key + 1; ?></td>
                    <td class="center"><?= $row['homestay_name']; ?></td>
                    <td class="center"><?= $row['user_titlename']; ?><?= $row['user_name']; ?> <?= $row['user_lastname']; ?></td>
                    <td class="center"><?= $row['review_star']; ?></td>
                <?php }?>
            </tr>
        </tbody>
    </table>
    <p class="review">หมายเหตุ คะเเนน 5 ดีมาก 4 ดี 3 พอใช้ 2 ปรับปรุง 1 เเย่</p>

    <hr style="border-bottom: 1px solid; position: relative;">
    <p class="sumcus">จำนวนลูกค้าที่ประเมินทั้งหมด <?php echo count($list)?> คน</p>
    <hr style="border-bottom: 1px solid; position: relative;">
    <br>
    <div style="text-align: right;">
        ลงชื่อ............................................................................ <br>
        เจ้าของโฮมสเตย์

    </div>

</div>

</body>
</html>
