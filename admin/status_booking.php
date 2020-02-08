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

                <legend>สถานะการเข้าพัก</legend>

                <?PHP
            
                $date = date("Y-m-d");
                if (isset($_GET['date'])) {
                    $date = $_GET['date'];
                }
                $uid = check_session("id");
                $sql = "SELECT * FROM tb_booking a INNER JOIN tb_booking_detail b ON a.booking_id = b.booking_id INNER JOIN tb_room d ON b.room_id = d.room_id INNER JOIN tb_homestay e ON d.homestay_id = e.homestay_id INNER JOIN tb_user g ON a.user_id = g.user_id WHERE a.booking_check_in = '{$date}' AND e.user_id='{$uid}' ORDER BY a.booking_id DESC ";

                $result = result_array($sql);


                ?>

                <div class="tb_all">

                    <div class="row">
                        <form action="">

                            <div class="col-md-4 text-right">
                                ข้อมูลวันที่
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control datepicker" name="date" value="<?= $date; ?>" required>
                                </div>
                            </div>

                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <table class="table table-striped table-bordered table-hover" id="table-js">
                        <thead>
                        <tr>
                            <th width="90">เลขที่</th>
                            <th>รายการ</th>
                            <th width="100">เช็คอิน</th>
                            <th width="100">เช็คเอ้า</th>
                            <th width="100">สถานะ</th>
                            <th width="50"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?PHP foreach ($result as $key => $row) { ?>
                            <tr>
                                <td class="center"><?= booking_id($row['booking_id']); ?></td>
                                <td class="text-left">
                                    <b>โฮมสเตย์ :</b> <?= $row['homestay_name'] ?> <br>
                                    <b>ห้อง :</b> <?= $row['room_name'] ?> <br>
                                    <b>ราคารวม :</b> <?= ($row['booking_detail_price'] * ($row['booking_detail_adult'] + $row['booking_detail_child'])) * $row['booking_detail_total'] ?> บาท <br>
                                    <hr style="margin: 5px;">
                                    <?= $row['user_titlename'] ?><?= $row['user_name'] ?> <?= $row['user_lastname'] ?>
                                    <br>
                                    <b>ว/ด/ป :</b> <?= $row['user_birth']; ?> <br>
                                </td>

                                <td class="center">
                                    <?= date_th($row['booking_check_in']); ?>
                                </td>

                                <td class="center">
                                    <?= date_th($row['booking_check_out']); ?>
                                </td>

                                <td class="center">
                                    <?= booking_detail_status($row['booking_detail_status']); ?>
                                </td>

                                <td class="center">
                                    <a target="_blank" href="../print_booking.php?id=<?= $row['booking_id']; ?>"
                                       class="btn btn-info btn-rounded">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        <?PHP }?>
                 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</div>

<?PHP include "include/footer.php"; ?>


</body>
</html>