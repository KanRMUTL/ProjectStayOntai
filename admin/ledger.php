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
    extract($_GET);
    $list = array();
    $uid = check_session("id");
    $sql = "SELECT * FROM tb_ledger g inner join tb_homestay h on g.homestay_id = h.homestay_id where g.ledger_type = 2 and h.user_id = {$uid}";
    $result = result_array($sql);

    $key = 0;
    foreach ($result as $row) {
        $list[$key]['ledger_id'] = $row['ledger_id'];
        $list[$key]['name'] = $row['ledger_name'];
        $list[$key]['money'] = $row['ledger_money'];
        $list[$key]['date'] = $row['ledger_date'];
        $list[$key]['homestay_id'] = $row['homestay_id'];
        $list[$key]['status'] = 1;

        $key++;
    }

    $sql = "SELECT * FROM tb_booking_detail a INNER JOIN tb_room b ON a.room_id = b.room_id INNER JOIN tb_homestay h ON b.homestay_id = h.homestay_id INNER JOIN tb_booking g ON a.booking_id = g.booking_id INNER JOIN tb_commission f ON a.booking_id = f.booking_id WHERE h.user_id = {$uid} AND booking_detail_status BETWEEN 3 AND 5";
    $result = result_array($sql);

    foreach ($result as $row) {
        $list[$key]['ledger_id'] = 0;
        $list[$key]['name'] = "[ค่าคอม] {$row['room_name']}";

        $money = (($row['booking_detail_price'] * ($row['booking_detail_adult'] + $row['booking_detail_child'])) * $row['booking_detail_total']) * ($row['commission_commis'] / 100);
        $list[$key]['money'] = $money;

        $list[$key]['date'] = $row['booking_check_in'];
        $list[$key]['homestay_id'] = $row['homestay_id'];
        $list[$key]['status'] = 0;

        $key++;
    }

    ?>


    <div class="col-sm-9 col-lg-9">
        <div id="register-wraper">
            <div id="register-form" style="position: relative;">
                <a href="ledger_form.php" style="position: absolute; top: 10px; right: 10px;">
                    <button type="button" class="btn btn-primary btn-md"><i class="fa fa-plus"></i>
                        เพิ่มข้อมูล
                    </button>
                </a>
                <legend>จัดการบัญชี</legend>


                <style>
                    .table-tap {
                        padding: 15px;
                    }

                    .table-tap .nav-tabs {
                        margin-bottom: 20px;
                    }

                    .table-tap .nav-tabs a {
                        color: #000000;
                    }
                </style>

                <div class="table-tap">

                    <ul class="nav nav-tabs">
                        <li><a href="ledger_income.php?type=1&active=1">บัญชีรายรับ</a></li>
                        <li class='active'><a href="ledger.php?type=2&active=2">บัญชีรายจ่าย</a></li>
                    </ul>

                    <div class="tb_all">
                        <table class="table table-striped table-bordered table-hover" id="table-js">
                            <thead>
                            <tr>
                                <th>รายการ</th>
                                <th>จำนวนเงิน</th>
                                <th>วันที่</th>
                                <th>โฮมสเตย์</th>
                                <th width="120">จัดการ</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?PHP
                            $sum = 0;
                            ?>
                            <?PHP foreach ($list as $key => $row) { ?>
                                <?PHP
                                $sum = $sum + $row['money'];
                                ?>
                                <tr>
                                    <td class="center"><?= $row['name']; ?></td>
                                    <td class="center"><?= $row['money']; ?></td>
                                    <td class="center"><?= $row['date']; ?></td>
                                    <td class="center"><?= get_homestay($row['homestay_id']); ?></td>
                                    <td class="center">
                                        <?PHP if ($row['status']) { ?>
                                            <a href="ledger_form.php?id=<?= $row['ledger_id']; ?>"
                                               class="btn btn-xs btn-warning btn-rounded">
                                                แก้ไข
                                            </a>

                                            <a href="process/delete.php?table=tb_ledger&ff=ledger_id&id=<?= $row['ledger_id']; ?>"
                                               class="btn btn-xs btn-danger"
                                               onclick="return confirm_custom(this.href,'ต้องการลบข้อมูลนี้?');">
                                                ลบ
                                            </a>
                                        <?PHP } else { ?>
                                            <button type="button" class="btn btn-xs btn-default btn-rounded">
                                                ไม่สามารถจัดการได้
                                            </button>
                                        <?PHP } ?>
                                    </td>
                                </tr>
                            <?PHP } ?>

                            </tr>
                            </tbody>
                        </table>
                    </div>

                     <div style="text-align: left; margin: 0px 25px;">
                        <b>ราคารวม</b> <b>: <?= $sum; ?> บาท</b>
                    </div>


                </div>
            </div>
        </div>
    </div>


</div>

<?PHP include "include/footer.php"; ?>


</body>
</html>