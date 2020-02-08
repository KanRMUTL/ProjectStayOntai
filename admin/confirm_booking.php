<!doctype html>
<html>
<head>
    <?PHP include "include/script.php"; ?>
    <link href="../assets/css/option_homestay.css" rel="stylesheet">
    <style>
        .form-group {
            overflow: hidden;
        }

        .content-select-room{
            text-align: left;
            border: 1px solid #dddddd;
            padding: 15px 20px;
            height: 300px;
            overflow: auto;
        }

        .text-bold{
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<?PHP
$start = $_SESSION['homestay']['start'];
$room = $_SESSION['homestay']['room'];
$total = $_SESSION['homestay']['total'];
$adult = $_SESSION['homestay']['adult'];
$child = $_SESSION['homestay']['child'];
$type = $_SESSION['homestay']['type'];
$beds = $_SESSION['homestay']['beds'];


$end = add_date($start, $total);

?>


<?PHP include "include/header.php"; ?>

<div class="container main">

    <?PHP include "include/right.php"; ?>


    <div class="col-sm-9 col-lg-9">
        <div id="register-wraper">
            <div id="register-form" style="position: relative;">

                <legend>จองแบบหมุนเวียนโฮมสเตย์</legend>



                <div class="col-md-12">

                    <p class="text-center">
                        เช็คอินวันที่ <span class="text-danger"><?= date_th($start); ?></span>
                        เช็คเอาท์วันที่ <span class="text-danger"><?= date_th($end); ?></span>
                        จำนวน <span class="text-danger"><?= $total; ?></span> คืน
                        <br>
                        จำนวน <span class="text-danger"><?= $room; ?></span> ห้อง
                        ผู้ใหญ่ <span class="text-danger"><?= $adult; ?></span> คน
                        เด็ก <span class="text-danger"><?= $child; ?></span> คน
                    </p>

                    <h2 class="title-page text-center">ยืนยันการจองโฮมสเตย์</h2>

                    <form action="process/booking_process.php" method="post" id="form-booking">

                        <input type="hidden" name="start" value="<?=$start;?>">
                        <input type="hidden" name="end" value="<?=$end;?>">

                        <div class="col-md-12">

                            <table class="table table-bordered" style="background: #fff;">
                                <tr style="background: #eee;">
                                    <th class="text-center">รายการ</th>
                                    <th width="80" class="text-center">ผู้เข้าพัก <br> สูงสุด</th>
                                    <th width="90" class="text-center">ผู้ใหญ่</th>
                                    <th width="90" class="text-center">เด็ก</th>
                                    <th width="80" class="text-center">ราคา <br> คน/คืน</th>
                                    <th width="80" class="text-center">รวม</th>
                                    <th width="70" class="text-center">จัดการ</th>
                                </tr>

                                <?PHP
                                $result = $_SESSION['homestay']['booking'];
                                ?>

                                <?PHP foreach ($result as $key => $room_id) { ?>

                                    <?PHP
                                    $sql = "SELECT * FROM tb_room a INNER JOIN tb_homestay b ON a.homestay_id = b.homestay_id WHERE room_id = '{$room_id}'";
                                    $row = row_array($sql);
                                    ?>

                                    <tr>
                                        <td class="text-left" style="padding-left: 30px;">
                                            <b style="font-size: 30px;"><?= $row['room_name']; ?></b> <br>
                                            <b>โฮมสเตย์ :</b> <?= $row['homestay_name']; ?> <br>
                                            <b>ประเภท :</b> <?= $row['room_type']; ?> <br>
                                            <b>ขนาดห้อง :</b> <?= $row['room_size']; ?> <br>
                                        </td>
                                        <td class="text-center">

                                            <?PHP
                                            $pp_full = $row['room_beds'];
                                            ?>

                                            <?= $row['room_beds']; ?> คน

                                            <?PHP if ($row['room_type'] == "ห้องรวม") { ?>
                                                <?PHP
                                                $pp_full = $row['room_beds'] - check_booking_all($row['room_id'], $start, $end);
                                                ?>
                                                <br>
                                                <div class="check_booking_all">
                                                    ว่าง : <?= $pp_full; ?>
                                                </div>
                                            <?PHP } ?>

                                            <input type="hidden" id="max<?= $row['room_id']; ?>"
                                                   value="<?= $pp_full; ?>">
                                        </td>
                                        <td class="text-center">
                                            <select name="adult[<?= $row['room_id']; ?>]"
                                                    onchange="check_if(<?= $row['room_id']; ?>)"
                                                    class="form-control adult adult<?= $row['room_id']; ?>">
                                                <?PHP for ($i = 1; $i <= $row['room_beds']; $i++) { ?>
                                                    <option value="<?= $i; ?>"><?= $i; ?> คน</option>
                                                <?PHP } ?>
                                            </select>
                                        </td>
                                        <td class="text-center">
                                            <select name="child[<?= $row['room_id']; ?>]"
                                                    onchange="check_if(<?= $row['room_id']; ?>)"
                                                    class="form-control child child<?= $row['room_id']; ?>">
                                                <?PHP for ($i = 0; $i <= $row['room_beds']; $i++) { ?>
                                                    <option value="<?= $i; ?>"><?= $i; ?> คน</option>
                                                <?PHP } ?>
                                            </select>
                                        </td>
                                        <td class="text-center">
                                            <input type="hidden" name="price[<?= $row['room_id']; ?>]"
                                                   id="price<?= $row['room_id']; ?>"
                                                   value="<?= $row['homestay_price']; ?>">
                                            <?= number_format($row['homestay_price'], 0); ?> บาท
                                        </td>
                                        <td class="text-center">
                                            <input type="hidden" name="sum<?= $row['room_id']; ?>"
                                                   id="sum<?= $row['room_id']; ?>" class="sum_total"
                                                   value="<?= $row['homestay_price']; ?>">
                                            <span class="showsum<?= $row['room_id']; ?>">
                                    <?= number_format($row['homestay_price'], 0); ?>
                                    บาท
                                        </span>
                                        </td>
                                        <td class="text-center">
                                            <a href="process/unset_booking.php?room_id=<?= $row['room_id'] ?>"
                                               onclick="return confirm_custom(this.href,'ยืนยันการยกเลิกห้องพัก?');"
                                               class="btn btn-danger btn-sm">ยกเลิก</a>
                                        </td>
                                    </tr>
                                <?PHP } ?>

                                <?PHP if (count($result) == 0) { ?>
                                    <tr>
                                        <td style="color: red;" colspan="10" class="text-center">ไม่มีห้องที่คุณเลือก</td>
                                    </tr>
                                <?PHP } ?>

                                <tr>
                                    <th colspan="5" class="text-right">ราคารวม</th>
                                    <td colspan="2">
                                        <input type="hidden" name="sum_total" id="sum_total">
                                        <span class="text-danger" id="showsum_total"></span> บาท
                                    </td>
                                </tr>

                                <tr>
                                    <th colspan="5" class="text-right">จำนวนวันพัก</th>
                                    <td colspan="2">
                                        <input type="hidden" name="total" value="<?= $total; ?>">
                                        <span class="text-danger"><?= $total; ?></span> คืน
                                    </td>
                                </tr>

                                <tr>
                                    <th colspan="5" class="text-right">จำนวนห้อง</th>
                                    <td colspan="2">
                                        <input type="hidden" name="room" value="<?= $room; ?>">
                                        <span class="text-danger"><?= $room; ?></span> ห้อง
                                    </td>
                                </tr>

                                <tr>
                                    <th colspan="5" class="text-right">จำนวนคน</th>
                                    <td colspan="2">
                                        ผู้ใหญ่ <span class="text-danger"><?= $adult; ?></span> คน <br>
                                        เด็ก <span class="text-danger"><?= $child; ?></span> คน
                                    </td>
                                </tr>

                                <tr style="color: red;">
                                    <th colspan="5" class="text-right">ราคารวมทั้งหมด</th>
                                    <td colspan="2">
                                        <input type="hidden" name="sum_true" id="sum_true">
                                        <span class="text-danger" id="showsum_true"></span> บาท
                                    </td>
                                </tr>



                            </table>

                            <hr>

                            <center>
                                <a href="round_booking.php" class="btn btn-warning">ย้อนกลับ</a>
                                <button type="button" class="btn btn-success submit-form-booking">ยืนยันการจอง</button>
                            </center>


                            <br>
                            <br>
                            <br>


                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


</div>

<?PHP include "include/footer.php"; ?>

<script>
    $(document).ready(function () {
        $(".cart-booking").hide();

        sum_total();

        $(".submit-form-booking").click(function(){
            var room = <?=$room?>;
            var count = <?=count($result)?>;
            var adult = <?=$adult?>;
            var child = <?=$child?>;
            var num_adults = sum_adult();
            var num_childs = sum_child();

            if (room != count) {
                alert_new("จำนวนห้องไม่ครบ " + room + " ห้อง");
                return false;
            }

            if (num_adults != adult) {
                alert_new("จำนวนผู้ใหญ่ยังไม่ครบ " + adult + " คน");
                return false;
            }

            if (num_childs != child) {
                alert_new("จำนวนเด็กยังไม่ครบ " + child + " คน");
                return false;
            }

            swal({
                    title: "แจ้งเตือน",
                    text: "ยืนยันการจองอีกครั้ง",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "ใช่",
                    cancelButtonText: "ยกเลิก",
                    closeOnConfirm: false
                },
                function () {
                    $("#form-booking").submit();
                });
        });
    });

    function check_if(room_id) {
        var adult = <?=$adult?>;
        var child = <?=$child?>;
        var num_adults = sum_adult();
        var num_childs = sum_child();
        var max = parseInt($("input#max" + room_id).val()) || 0;
        var price = parseInt($("input#price" + room_id).val()) || 0;
        var sum = parseInt($("input#sum" + room_id).val()) || 0;
        var now_adult = parseInt($("select.adult" + room_id).val()) || 0;
        var now_child = parseInt($("select.child" + room_id).val()) || 0;

        if (num_adults > adult) {
            alert_new("จำนวนผู้ใหญ่ทั้งหมดห้ามเกิน " + adult + " คน");
            $("select.adult" + room_id).val(1)
            return false;
        }

        console.log("max :" + max);
        console.log("now_adult :" + now_adult);
        console.log("now_child :" + now_child);
        console.log("now_sum :" + (now_adult + now_child));

        if (num_childs > child) {
            alert_new("จำนวนเด็กทั้งหมดห้ามเกิน " + child + " คน");
            $("select.child" + room_id).val(0);
            return false;
        }

        if ((now_adult + now_child) > max) {
            alert_new("จำนวนผู้พักทั้งหมดห้ามเกิน " + max + " คน");
            $("select.adult" + room_id).val(1)
            $("select.child" + room_id).val(0);
            return false;
        }

        $("input#sum" + room_id).val((now_adult + now_child) * price);
        $("span.showsum" + room_id).empty();
        $("span.showsum" + room_id).append($("input#sum" + room_id).val() + " บาท");

        sum_total();


    }

    function sum_adult() {
        var total = 0;
        $("select.adult").each(function (index, element) {
            total = total + parseInt($(element).val());
        });

        return total;
    }

    function sum_child() {
        var total = 0;
        $("select.child").each(function (index, element) {
            total = total + parseInt($(element).val());
        });

        return total;
    }

    function sum_total() {
        var total = parseInt($("input[name='total']").val()) || 0;
        var sum = 0;
        $("input.sum_total").each(function (index, element) {

            sum = sum + parseInt($(element).val());
        });

        $("input#sum_total").val(sum);
        $("span#showsum_total").empty();
        $("span#showsum_total").append($("input#sum_total").val());

        $("input#sum_true").val(sum * total);
        $("span#showsum_true").empty();
        $("span#showsum_true").append($("input#sum_true").val());
    }

    function alert_new(msg) {
        swal({
                title: "เกิดข้อผิดพลาด!!",
                text: msg,
                type: "error"
            },
            function () {
                return false;
            });
    }

</script>


</body>
</html>