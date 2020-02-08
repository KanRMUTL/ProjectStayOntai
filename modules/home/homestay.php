<div class="block-page">
    <div class="container">
        <?PHP include 'include/header.php'; ?>


        <h1 class="title-page text-center">โฮมสเตย์</h1>

        <?PHP
        //        _print_r( $_SESSION['homestay']);


        $date = $_SESSION['homestay']['start'];
        $room = $_SESSION['homestay']['room'];
        $total = $_SESSION['homestay']['total'];
        $adult = $_SESSION['homestay']['adult'];
        $child = $_SESSION['homestay']['child'];
        $type = $_SESSION['homestay']['type'];
        $beds = $_SESSION['homestay']['beds'];


        $end = add_date($date, $total);

        //        _print_r($_SESSION['homestay']);
        ?>


        <div class="row">

            <div class="col-md-10 col-md-offset-1">
                <div class="list-travel">
                    <div class="row text-left">
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
                            <!----------------------ปุ่ม search ------------------->
                            <div class="col-md-2" style="padding-top: 30px;" id="btn-icon">
                                <button type="submit" class="btn btn-primary btn-sm" id="btn-search">
                                    <i class="fa fa-search"></i>
                                </button>
                            <!----------------------ปุ่ม คัดกรอก ------------------->
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#selectService" id="btn-set">
                                    <i class="fa fa-gear"></i>
                                </button>
                            <!----------------------ปุ่ม รีเซต ------------------->
                                <a href="index.php?module=home&action=homestay&reset" class="btn btn-warning btn-sm" id="btn-reset">
                                    <i class="fa fa-refresh" id="icon-reset"></i>
                                </a>
                            </div>
                        </form>
                    </div>
                    <!----------------------------------------------------------ตัวคัดกรอง------->
                    <?PHP if (count($_SESSION['homestay']['service']) > 0) { ?>
                        <hr>
                        <b style="float: left">ตัวกรอง : </b>
                        <?PHP foreach ($_SESSION['homestay']['service'] as $service_id) { ?>
                            <?PHP
                            $sql = "SELECT * FROM tb_service WHERE service_id = '{$service_id}'";
                            $service_row = row_array($sql);
                            ?>
                            <style>
                                .select-service-list {
                                    float: left;
                                    background: #FFB9D1;
                                    color: #ffffff;
                                    padding: 5px 10px;
                                    margin: 3px;
                                    border-radius: 10px;
                                }

                                .select-service-list i {
                                    color: #ff410d;
                                }
                            </style>
                            <div class="select-service-list">
                                <?= $service_row['service_name']; ?> <!--ชื่อตัวกรอกด้านล่าง------->
                                <a href="process/unset_service.php?service_id=<?= $service_row['service_id'] ?>"><i
                                            class="fa fa-times"></i></a>
                            </div>
                        <?PHP } ?>
                    <?PHP } ?>
                    <!----------------------------------------------------------ตัวคัดกรอง------->
                    <div class="clearfix"></div>
                    <hr>

                    <?PHP
                    $sql = "SELECT * FROM tb_homestay ORDER BY rand()";
                    $result = result_array($sql);
                    $result = check_opiton_homestay($result);

                    ?>

                    <p class="text-center">
                        เช็คอินวันที่ <span class="text-danger"><?= date_th($date); ?></span>
                        เช็คเอาท์วันที่ <span class="text-danger"><?= date_th($end); ?></span>
                        จำนวน <span class="text-danger"><?= $total; ?></span> คืน
                        <br>
                        จำนวน <span class="text-danger"><?= $room; ?></span> ห้อง
                        ผู้ใหญ่ <span class="text-danger"><?= $adult; ?></span> คน
                        เด็ก <span class="text-danger"><?= $child; ?></span> คน
                    </p>
                    <div class="row">

                        <?PHP
                        $count_show = 0;
                        ?>

                        <?PHP foreach ($result as $row) { ?>
                            <?PHP
                            $where = "  AND '{$beds}' <= room_beds";

                            if ($type == "ห้องรวม") {
                                $where = " AND room_type = '{$type}' AND '{$beds}' <= room_beds";
                            } elseif ($type == "ห้องส่วนตัว") {
                                $where = " AND room_type = '{$type}' AND '{$beds}' <= room_beds";
                            }

                            $msg = "ไม่มีห้อง";
                            $check = 0;
                            $sql = "SELECT * FROM tb_room WHERE homestay_id = '{$row['homestay_id']}' {$where} ORDER BY room_id DESC";
                            $room = result_array($sql);


                            if (count($room) > 0) {
                                foreach ($room as $_room) {

                                    $check = check_booking($_room['room_id'], $date, $end);
                                    if (!$check) {
                                        $msg = "ไม่ว่าง";
                                    } else {
                                        $msg = "";
                                        break;
                                    }

                                }
                            }
                            ?>

                            <?PHP if ($msg != "ไม่มีห้อง" && $msg != "ไม่ว่าง") { ?>
                                <?PHP
                                $count_show++;
                                $select_room = check_room_select($row['homestay_id']);
                                ?>
                                <div class="col-md-4 mb25">
                                    <div class="content-all">
                                        <?PHP if (!$check) { ?>
                                            <div class="alert-homestay">
                                                <?= $msg; ?>
                                            </div>
                                        <?PHP } ?>
                                        <?PHP if ($select_room) { ?>
                                            <i class="fa fa-check"
                                               style="position: absolute; background: #00A200; color: #ffffff; font-size: 30px; right: 10px; top: 10px; padding: 10px; border-radius: 50%;"></i>
                                        <?PHP } ?>
                                        <a href="modules/modal/sub_select_room.php?id=<?= $row['homestay_id']; ?>"
                                           data-toggle="modal" data-target="#modalAllPage" data-remote="false">
                                            <img src="uploads/<?= $row['homestay_pic']; ?>" alt="">
                                            <p><?= $row['homestay_name']; ?></p>
                                        </a>
                                    </div>
                                </div>
                            <?PHP } ?>

                        <?PHP } ?>

                        <?PHP if ($count_show == 0) { ?>
                            <div style="font-size: 30px; color: red; padding: 40px 0; border: 1px dotted #cccccc; margin-bottom: 30px;">
                                ไม่มีห้องว่างในวันเวลาตามเงื่อนไขที่คุณเลือก
                            </div>
                        <?PHP } ?>
                    </div>

                </div>
            </div>

        </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="selectService" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="process/set_service.php" method="post">
                <div class="modal-body">
            
                    <!------------------------------------------------------------------------------------STATUS SERVICE------------->
                    <h2 class="text-center">ตัวกรอง สิ่งอำนวยความสะดวก</h2>
                    <div class="resporn-icon">

                    <div class="row">
                        <?PHP
                        $sql = "SELECT * FROM tb_service WHERE service_status = 1";
                        $service = result_array($sql);
                        ?>

                        <?PHP foreach ($service as $_service) { ?>

                            <?PHP

                            $check_option = "";
                            $check_service = false;

                            if (count($_SESSION['homestay']['service']) > 0) {
                                foreach ($_SESSION['homestay']['service'] as $service_id) {
                                    if ($service_id == $_service['service_id']) {
                                        $check_service = true;
                                        break;
                                    }
                                }
                            }

                            if ($check_service) {
                                $check_option = "checked";
                            }

                            ?>
                            
                            <div class="col-md-4">
                                <input type="checkbox" name="service[]" value="<?= $_service['service_id']; ?>"
                                       <?= $check_option; ?>>
                                <img src="assets/images/icon/<?= $_service['service_photo']; ?>"
                                     style="width: auto; height: 20px; column-count: 3;" alt="">
                                <?= $_service['service_name']; ?>

                            </div>
                        <?PHP } ?>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    
                    <div class="row">
                        <div class="col-md-7 text-left">
                            <?PHP foreach ($_SESSION['homestay']['service'] as $service_id) { ?>
                                <?PHP
                                $sql = "SELECT * FROM tb_service WHERE service_id = '{$service_id}'";
                                $service_row = row_array($sql);
                                ?>
                                <style>
                                    .select-service-list {
                                        float: left;
                                        background: #FFB9D1;
                                        color: #ffffff;
                                        padding: 5px 10px;
                                        margin: 3px;
                                        border-radius: 10px;

                                    }

                                    .select-service-list i {
                                        color: #ff410d;
                                    }
                                </style>
                                <div class="select-service-list" style="font-size: 16px;">
                                    <?= $service_row['service_name']; ?>
                                </div>
                            <?PHP } ?>
                        </div>
                        <div class="col-md-5">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                            <a href="index.php?module=home&action=homestay&reset_service" class="btn btn-warning">
                                รีเซ็ต
                            </a>
                            <button type="submit" class="btn btn-primary">ตกลง</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

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



