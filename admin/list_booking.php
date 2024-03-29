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

                <legend>ข้อมูลการจองโฮมสเตย์</legend>
                
                <form action="" class="row ml-2 mr-2">
                    <?PHP
                        $start_date = date("Y-m-d");
                        $start_time = date("00:00");
                        $end_date = date("Y-m-d");
                        $end_time = date("23:59");
                       
                        if (isset($_GET['start_date'], $_GET['start_date'])) {
                            
                            $start_date = $_GET['start_date'];
                            $start_time = $_GET['start_time'];
                            $end_date = $_GET['end_date'];
                            $end_time = $_GET['end_time'];

                        }
                        $start = $start_date.' '.$start_time;
                        $end = $end_date.' '.$end_time;
                    ?>
                    <div class="row">
                        <div class="col-md-2">
                            วันที่เริ่มต้น
                        </div>
                        <div class="col-md-4 text-left mb-2">
                            <input type="date" name="start_date" value="<?PHP echo $start_date ?>" id="start" class="form-control">
                        </div>
                        <div class="col-md-1">
                            เวลา
                        </div>
                        <div class="col-md-4 text-left mb-2">
                            <input type="time" name="start_time" value="<?PHP echo $start_time ?>" id="start" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            วันที่สิ้นสุด
                        </div>
                        <div class="col-md-4 text-left mb-2">
                            <input type="date" name="end_date" value="<?PHP echo $end_date ?>" id="start" class="form-control">
                        </div>
                        <div class="col-md-1">
                            เวลา
                        </div>
                        <div class="col-md-4 text-left mb-2">
                            <input type="time" name="end_time" value="<?PHP echo $end_time ?>" id="start" class="form-control">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>

                <?PHP
                $sql = "SELECT * FROM tb_booking a INNER JOIN tb_booking_detail b ON a.booking_id = b.booking_id INNER JOIN tb_room d ON b.room_id = d.room_id INNER JOIN tb_homestay e ON d.homestay_id = e.homestay_id INNER JOIN tb_user g ON a.user_id = g.user_id WHERE booking_date > '$start' AND  booking_date < '$end' ORDER BY a.booking_id DESC ";
                $result = result_array($sql);
                ?>
                <!-- PC Screen -->          
                <div class="tb_all d-none d-sm-block">
                    <table class="table table-striped table-bordered table-hover" id="table-js">
                        <thead>
                        <tr>
                            <th width="50">ลำดับ</th>
                            <th>ห้อง</th>
                            <th>ผู้จอง</th>
                            <th width="100">สถานะ</th>
                            <th width="100">รายละเอียด</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?PHP foreach ($result as $key => $row) { ?>
                            <tr>
                                <td class="center"><?= $key + 1; ?></td>
                                <td class="text-left">
                                    <b>เลขที่การจอง :</b> <?= booking_id($row['booking_id']); ?> <br>
                                    <b>โฮมสเตย์ :</b> <?= $row['homestay_name'] ?> <br>
                                    <b>ห้อง :</b> <?= $row['room_name'] ?> <br>
                                    <?PHP
                                    $sum = 0;

                                    $sum = $row['booking_detail_price'] * ($row['booking_detail_adult'] + $row['booking_detail_child']) * $row['booking_detail_total'];
                                    ?>
                                    <b>ราคารวม :</b> <?= number_format($sum, 2); ?> <br>
                                </td>
                                <td class="text-left">
                                    <?= $row['user_titlename'] ?><?= $row['user_name'] ?> <?= $row['user_lastname'] ?> <br>
                                    <b>เบอร์โทร :</b> <?= $row['user_tel']; ?> <br>
                                    <b>อีเมล์ :</b> <?= $row['user_email']; ?> <br>
                                    <b>ว/ด/ป :</b> <?= $row['user_birth']; ?> <br>
                                    <b>วันที่จอง :</b> <?= date_format(date_create( $row['booking_date']), 'd/m/Y H:m:s'); ?> <br>
                                </td>

                                <td class="center">
                                    <?= booking_detail_status($row['booking_detail_status']); ?>
                                </td>

                                <td class="center">
                                    <a target="_blank" href="../print_booking.php?id=<?= $row['booking_id']; ?>" class="btn btn-info btn-rounded">
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
                <div class="tb_all d-block d-sm-none">
                    <table class="table table-striped table-bordered table-hover" id="table-mobile">
                        <thead>
                        <tr>
                            <th>รายการ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?PHP foreach ($result as $key => $row) { ?>
                            <tr>
                                <td class="center">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <b>
                                                ลำดับที่  <?= $key + 1; ?></li>
                                            </b>
                                        <li class="list-group-item text-left">
                                            <b>เลขที่การจอง :</b> <?= booking_id($row['booking_id']); ?> <br>
                                            <b>โฮมสเตย์ :</b> <?= $row['homestay_name'] ?> <br>
                                            <b>ห้อง :</b> <?= $row['room_name'] ?> <br>
                                            <?PHP
                                            $sum = 0;

                                            $sum = $row['booking_detail_price'] * ($row['booking_detail_adult'] + $row['booking_detail_child']) * $row['booking_detail_total'];
                                            ?>
                                            <b>ราคารวม :</b> <?= number_format($sum, 2); ?> <br>
                                        </li>
                                        <li class="list-group-item text-left">
                                            <b>ผู้จอง :</b> <?= $row['user_titlename'] ?><?= $row['user_name'] ?> <?= $row['user_lastname'] ?> <br>
                                            <b>เบอร์โทร :</b> <?= $row['user_tel']; ?> <br>
                                            <b>อีเมล์ :</b> <?= $row['user_email']; ?> <br>
                                            <b>ว/ด/ป :</b> <?= $row['user_birth']; ?> <br>
                                        </li>
                                        <li class="list-group-item text-left">
                                            <b>สถานะ : </b><?= booking_detail_status($row['booking_detail_status']); ?>
                                        </li>
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

<?PHP include "include/footer.php"; ?>


</body>
</html>
