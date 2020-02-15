<!doctype html>
<html>
<head>
    <?PHP include "include/script.php"; ?>
    <link href="../assets/css/option_homestay.css" rel="stylesheet">
    <style>
        .form-group {
            overflow: hidden;
        }
    </style>
</head>
<body>

<?PHP
if (isset($_GET['reset'])) {
    unset($_SESSION['homestay']);
}

if (!isset($_SESSION['homestay'])) {
    $_SESSION['homestay'] = array();

    $_SESSION['homestay']['start'] = date("Y-m-d");
    $_SESSION['homestay']['beds'] = 1;
    $_SESSION['homestay']['room'] = 1;
    $_SESSION['homestay']['total'] = 1;
    $_SESSION['homestay']['adult'] = 1;
    $_SESSION['homestay']['child'] = 0;
    $_SESSION['homestay']['type'] = "ทั้งหมด";

    $_SESSION['homestay']['booking'] = array();
    $_SESSION['homestay']['service'] = array();
}

$date = $_SESSION['homestay']['start'];
$room = $_SESSION['homestay']['room'];
$total = $_SESSION['homestay']['total'];
$adult = $_SESSION['homestay']['adult'];
$child = $_SESSION['homestay']['child'];
$type = $_SESSION['homestay']['type'];
$beds = $_SESSION['homestay']['beds'];


$end = add_date($date, $total);
?>


<?PHP include "include/header.php"; ?>

<div class="container main">

    <?PHP include "include/right.php"; ?>


    <div class="col-sm-9 col-lg-9">
        <div id="register-wraper">
            <div id="register-form" style="position: relative;">

                <legend>จองแบบหมุนเวียนโฮมสเตย์</legend>

                <div class="col-md-12">
                    <div class="row text-left d-none d-sm-block">
                        <form action="process/set_homestay.php" method="post">
                            <input type="hidden" name="module" value="home">
                            <input type="hidden" name="action" value="homestay">

                            <input type="hidden" name="room" value="<?= $room; ?>">
                            <input type="hidden" name="adult" value="<?= $adult; ?>">
                            <input type="hidden" name="child" value="<?= $child; ?>">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>วันที่เช็คอิน</label>
                                    <input type="text" class="form-control datepickernow" name="date"
                                           value="<?= $date; ?>" required>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>จำนวน</label>
                                    <select name="total" class="form-control" required>
                                        <?PHP for ($i = 1; $i <= 15; $i++) { ?>
                                            <option <?= $total == $i ? "selected" : ""; ?>
                                                    value="<?= $i; ?>"><?= $i; ?> คืน
                                            </option>
                                        <?PHP } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3" style="">
                                <label>จำนวนห้องละผู้เข้าพัก</label>
                                <div class="input-div">
                                    <span class="room_show"><?= $room ?></span> ห้อง /
                                    <span class="adult_show"><?= $adult ?></span> ผู้ใหญ่ /
                                    <span class="child_show"><?= $child ?></span> เด็ก
                                    <div class="pp-option">
                                        <p>
                                            <b>ห้อง</b>
                                            <i class="fa fa-minus-circle hover_all room_minus"></i>
                                            <span class="room_show"><?= $room ?></span>
                                            <i class="fa fa-plus-circle hover_all room_plus"></i>
                                        </p>
                                        <p>
                                            <b>ผู้ใหญ่</b>
                                            <i class="fa fa-minus-circle hover_all adult_minus"></i>
                                            <span class="adult_show"><?= $adult ?></span>
                                            <i class="fa fa-plus-circle hover_all adult_plus"></i>
                                        </p>
                                        <p>
                                            <b>เด็ก</b>
                                            <i class="fa fa-minus-circle hover_all child_minus"></i>
                                            <span class="child_show"><?= $child ?></span>
                                            <i class="fa fa-plus-circle hover_all child_plus"></i>
                                        </p>
                                    </div>
                                </div>
                                <div class="bg_option_homestay"></div>

                            </div>


                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>ประเภท</label>
                                    <select name="type" class="form-control" required>
                                        <option <?= $type == "ทั้งหมด" ? "selected" : ""; ?>
                                                value="ทั้งหมด"> ทั้งหมด
                                        </option>
                                        <option <?= $type == "ห้องส่วนตัว" ? "selected" : ""; ?>
                                                value="ห้องส่วนตัว"> ห้องส่วนตัว
                                        </option>

                                        <option <?= $type == "ห้องรวม" ? "selected" : ""; ?>
                                                value="ห้องรวม"> ห้องรวม
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2" style="padding-top: 30px;">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-search"></i>
                                </button>
                                <a href="round_booking.php?reset" class="btn btn-warning">
                                    <i class="fa fa-refresh"></i>
                                </a>
                            </div>
                        </form>
                    </div>
                    <hr>

                    <?PHP
                    $sql = "SELECT * FROM tb_homestay";
                    $temp = result_array($sql);

                    foreach ($temp as &$_temp) {
                        $sql = "SELECT d.booking_date , COUNT(booking_detail_id) as num FROM tb_booking_detail a INNER JOIN tb_room b ON a.room_id = b.room_id INNER JOIN tb_booking d ON a.booking_id = d.booking_id WHERE homestay_id = '{$_temp['homestay_id']}' AND booking_detail_status != 6 ORDER BY d.booking_id DESC ";
                        $temp_room = row_array($sql);
                        $_temp['total'] = $temp_room['num'];

                        if ($_temp['total'] > 0) {
                            $_temp['date'] = $temp_room['booking_date'];
                        } else {
                            $_temp['date'] = "-";
                        }


                    }

                    $result = $temp;


//                    array_multisort(array_column($result, 'total'),  SORT_ASC, array_column($result, 'date'), SORT_ASC, $result);

                    function sortByOrder($a, $b)
                    {
                        return $a['total'] - $b['total'];
                    }

                    usort($result, 'sortByOrder');
                    ?>

                    <p class="text-center d-none d-sm-block">
                        เช็คอินวันที่ <span class="text-danger"><?= date_th($date); ?></span>
                        เช็คเอาท์วันที่ <span class="text-danger"><?= date_th($end); ?></span>
                        จำนวน <span class="text-danger"><?= $total; ?></span> คืน
                        <br>
                        จำนวน <span class="text-danger"><?= $room; ?></span> ห้อง
                        ผู้ใหญ่ <span class="text-danger"><?= $adult; ?></span> คน
                        เด็ก <span class="text-danger"><?= $child; ?></span> คน
                    </p>

                    <p style="margin-bottom: 10px; overflow: hidden;" class="d-none d-sm-block">
                        <a href="confirm_booking.php" class="cart-booking">
                            <i class="fa fa-eye"></i>
                            จองแล้ว <?= count($_SESSION['homestay']['booking']); ?> ห้อง
                            เหลือ <?= $_SESSION['homestay']['room'] - count($_SESSION['homestay']['booking']); ?> ห้อง
                        </a>
                    </p>

                    <!-- PC Screen -->
                    <div class="table-responsive d-none d-sm-block">
                        <table class="table table-bordered">
                            <thead>
                            <tr style="background: #eeeeee;">
                                <th class="tb-middle" width="60">คิวที่</th>
                                <th class="tb-middle">โฮมสเตย์</th>
                                <th class="tb-middle" width="135">การจองทั้งหมด</th>
<!--                                <th class="tb-middle" width="175">การจองล่าสุด</th>-->
                                <th class="tb-middle" width="100">สถานะ</th>
                                <th class="tb-middle" width="100">จัดการ</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?PHP foreach ($result as $key => $row) { ?>

                                <?PHP
                                $where = "  AND '{$beds}' <= room_beds";

                                if ($type == "ห้องรวม") {
                                    $where = " AND room_type = '{$type}' AND '{$beds}' <= room_beds";
                                } elseif ($type == "ห้องส่วนตัว") {
                                    $where = " AND room_type = '{$type}' AND '{$beds}' <= room_beds";
                                }

                                $msg = "<span style='color: #cc9c0b;'>ไม่มีห้อง</span>";
                                $check = 0;
                                $sql = "SELECT * FROM tb_room WHERE homestay_id = '{$row['homestay_id']}' {$where} ORDER BY room_id DESC";
                                $room = result_array($sql);


                                if (count($room) > 0) {
                                    foreach ($room as $_room) {

                                        $check = check_booking($_room['room_id'], $date, $end);

                                        if (!$check) {
                                            $msg = "<span style='color: red;'>ไม่ว่าง</span>";
                                        } else {
                                            $msg = "<span style='color: green;'>ว่าง</span>";
                                            break;
                                        }

                                    }
                                }
                                ?>

                                <tr>
                                    <td><?= $key + 1; ?></td>
                                    <td><?= $row['homestay_name']; ?></td>
                                    <td><?= $row['total']; ?> ครั้ง</td>
<!--                                    <td>--><?//= $row['date']; ?><!--</td>-->
                                    <td>
                                        <?= $msg; ?>

                                    </td>
                                    <td>
                                        <a href="select_room.php?id=<?= $row['homestay_id']; ?>"
                                           class="btn btn-primary">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>

                            <?PHP } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- End PC Screen -->
                    
                    <!-- Mobile Screen -->
                    <div class="table-responsive d-block d-sm-none">
                        <table class="table table-bordered">
                            <thead>
                            <tr style="background: #eeeeee;">
                                <th class="tb-middle" width="60">รายการ</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?PHP foreach ($result as $key => $row) { ?>

                                <?PHP
                                $where = "  AND '{$beds}' <= room_beds";

                                if ($type == "ห้องรวม") {
                                    $where = " AND room_type = '{$type}' AND '{$beds}' <= room_beds";
                                } elseif ($type == "ห้องส่วนตัว") {
                                    $where = " AND room_type = '{$type}' AND '{$beds}' <= room_beds";
                                }

                                $msg = "<span style='color: #cc9c0b;'>ไม่มีห้อง</span>";
                                $check = 0;
                                $sql = "SELECT * FROM tb_room WHERE homestay_id = '{$row['homestay_id']}' {$where} ORDER BY room_id DESC";
                                $room = result_array($sql);


                                if (count($room) > 0) {
                                    foreach ($room as $_room) {

                                        $check = check_booking($_room['room_id'], $date, $end);

                                        if (!$check) {
                                            $msg = "<span style='color: red;'>ไม่ว่าง</span>";
                                        } else {
                                            $msg = "<span style='color: green;'>ว่าง</span>";
                                            break;
                                        }

                                    }
                                }
                                ?>

                                <tr>
                                    <td>
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <b>คิวที่ <?= $key + 1; ?></b>
                                            </li>
                                            <li class="list-group-item">
                                                <?= $row['homestay_name']; ?><br>
                                                การจองทั้งหมด : <?= $row['total']; ?> ครั้ง
                                            </li>
                                            <li class="list-group-item"> 
                                               <b>สถานะ : <?= $msg; ?></b>
                                            </li>
                                           <!--  <li class="list-group-item"> 
                                                <a href="select_room.php?id=<?= $row['homestay_id']; ?>" class="btn btn-primary">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </li> -->
                                        </ul>
                                    </td>
                                </tr>

                            <?PHP } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- End Mobile Screen -->

                </div>


            </div>
        </div>
    </div>


</div>

<?PHP include "include/footer.php"; ?>

<script>
    $(document).ready(function (e) {

        $(".input-div").click(function () {
            $(".pp-option").show();
            $(".bg_option_homestay").show();
        });

        $(".room_minus").click(function () {
            var num = parseInt($("input[name='room']").val()) || 0;

            if (num > 1) {
                num--;
                $("input[name='room']").val(num)
                $(".room_show").empty();
                $(".room_show").append(num);

            }
        });

        $(".room_plus").click(function () {
            var num = parseInt($("input[name='room']").val()) || 0;

            if (num < 100) {
                num++;
                $("input[name='room']").val(num)
                $(".room_show").empty();
                $(".room_show").append(num);
            }
        });

        $(".adult_minus").click(function () {
            var num = parseInt($("input[name='adult']").val()) || 0;

            if (num > 1) {
                num--;
                $("input[name='adult']").val(num)
                $(".adult_show").empty();
                $(".adult_show").append(num);

            }
        });

        $(".adult_plus").click(function () {
            var num = parseInt($("input[name='adult']").val()) || 0;

            if (num < 100) {
                num++;
                $("input[name='adult']").val(num)
                $(".adult_show").empty();
                $(".adult_show").append(num);
            }
        });

        $(".child_minus").click(function () {
            var num = parseInt($("input[name='child']").val()) || 0;

            if (num > 0) {
                num--;
                $("input[name='child']").val(num)
                $(".child_show").empty();
                $(".child_show").append(num);

            }
        });

        $(".child_plus").click(function () {
            var num = parseInt($("input[name='child']").val()) || 0;

            if (num < 100) {
                num++;
                $("input[name='child']").val(num)
                $(".child_show").empty();
                $(".child_show").append(num);
            }
        });

        $(".bg_option_homestay").click(function () {
            $(".pp-option").hide();
            $(".bg_option_homestay").hide();
        });
    });
</script>


</body>
</html>