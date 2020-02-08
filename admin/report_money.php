<!doctype html>
<html>
<head>
    <?PHP include "include/script.php"; ?>
    <script src="assets/js/highcharts/highcharts.js"></script>
    <script src="assets/js/highcharts/exporting.js"></script>
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
    $yy = date("Y");
    $mm = date("m");
    if (isset($_GET['yy']) && isset($_GET['mm'])) {
        $yy = $_GET['yy'];
        $mm = $_GET['mm'];
    }

    ?>


    <div class="col-sm-9 col-lg-9">
        <div id="register-wraper">
            <div id="register-form" style="position: relative;">

                <legend>รายงานรายรับ-รายจ่าย</legend>

                <?PHP
                $sql = "SELECT * FROM tb_otop";
                $list = result_array($sql);
                ?>

                <div class="tb_all">
                    <div class="row" style="margin-bottom: 30px;">
                        <form action="" method="get">
                            <div class="form-group">
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
                                    <button type="submit" class="btn btn-info">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>


                    <?PHP
                    $data = array();
                    $name = array();

                    $sql = "SELECT * FROM tb_homestay";
                    $result = result_array($sql);

                    foreach ($result as $i => $row) {

                        $name[] = $row['homestay_name'];


                        $sql = "SELECT COALESCE(SUM(booking_detail_price * (booking_detail_adult + booking_detail_child ) * booking_detail_total),0) as num FROM tb_booking_detail a INNER JOIN tb_booking b ON a.booking_id = b.booking_id INNER JOIN tb_room d ON a.room_id = d.room_id WHERE d.homestay_id = '{$row['homestay_id']}' AND MONTH(booking_date) = '{$mm}' AND YEAR(booking_date) = '{$yy}' AND booking_detail_status BETWEEN 3 AND 5";
                        $count1 = row_array($sql);




                        $sql = "SELECT COALESCE(SUM(ledger_money),0) as num FROM tb_ledger WHERE homestay_id = '{$row['homestay_id']}' AND MONTH(ledger_date) = '{$mm}' AND YEAR(ledger_date) = '{$yy}' AND ledger_type = 1";
                        $count2 = row_array($sql);

                        $key = 0;
                        $data[$key]['name'] = "รายรับ";
                        $data[$key]['data'][$i] = $count1['num'] + $count2['num'];

                       

                        $sql = "SELECT COALESCE(SUM(ledger_money),0) as num FROM tb_ledger WHERE homestay_id = '{$row['homestay_id']}' AND MONTH(ledger_date) = '{$mm}' AND YEAR(ledger_date) = '{$yy}' AND ledger_type = 2";
                        $count3 = row_array($sql);

                        $sql = "SELECT COALESCE(SUM((booking_detail_price * (booking_detail_adult + booking_detail_child ) * booking_detail_total) * (commission_commis / 100)),0) as num FROM tb_booking_detail a INNER JOIN tb_booking b ON a.booking_id = b.booking_id INNER JOIN tb_room d ON a.room_id = d.room_id INNER JOIN tb_commission f ON a.booking_id = f.booking_id WHERE d.homestay_id = '{$row['homestay_id']}' AND MONTH(booking_date) = '{$mm}' AND YEAR(booking_date) = '{$yy}' AND booking_detail_status BETWEEN 3 AND 5";
                        $count4 = row_array($sql);

                        $key = 1;
                        $data[$key]['name'] = "รายจ่าย";
                        $data[$key]['data'][$i] = $count3['num'] + $count4['num'];


                    }

                    $data = json_encode($data, JSON_NUMERIC_CHECK);
                    $name = json_encode($name, JSON_NUMERIC_CHECK);

                    ?>

                    <div id="container" style="width: 100%; height: 400px; margin: 0 auto"
                         align="center"></div>

                    <hr>



                    <a href="report.php" class="btn btn-warning">ย้อนกลับ</a>
                     <a href="../print_moeny.php?mm=<?=$mm; ?>&yy=<?=$yy;?>" class="btn btn-primary">ปริ้นรายงาน</a>

                    <br>
                    <br>
                </div>
            </div>
        </div>
    </div>


</div>

<?PHP include "include/footer.php"; ?>


<script>
    $(function () {
        $('#container').highcharts({
            chart: {
                type: 'column'
            },
            colors: ['#07c700', '#dd765e'],
            title: {
                text: 'รายงานรายรับ-รายจ่าย เดือน <?=mount_name($mm);?> พ.ศ. <?=$yy + 543;?>',
                x: -20 //center
            },
            subtitle: {
                text: 'ผลการสรุปดังนี้',
                x: -20
            },
            xAxis: {
                categories: <?=$name;?>
            },
            yAxis: {
                title: {
                    text: 'จำนวนเงิน (บาท)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: ' บาท'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: <?=$data;?>
        });
    });
</script>


</body>
</html>