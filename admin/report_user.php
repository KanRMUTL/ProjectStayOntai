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

                <legend>รายงานข้อมูลพนักงาน</legend>


                <div class="tb_all">


                    <?PHP
                    $sql = "SELECT * FROM tb_user WHERE user_type < 3 order by user_type DESC ";
                    $list = result_array($sql);
                    ?>
                    <!-- PC Screen -->
                    <table class="table table-striped table-bordered table-hover d-none d-sm-block" id="table-js">
                        <thead>
                        <tr>
                            <th width="50">ลำดับ</th>
                            <th width="50">รูปภาพ</th>
                            <th>ชื่อ - นามสกุล</th>
                            <th>เบอร์โทร</th>
                            <th>วันเกิด</th>
                            <th>ที่อยู่</th>
                            <th>สถานะ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?PHP foreach ($list as $key => $row) { ?>
                            <tr>
                                <td class="center"><?= $key + 1; ?></td>
                                <td class="center"><img src="../uploads/<?= $row['user_picture']; ?>"
                                                        style="width: auto; height: 50px;" alt=""></td>
                                <td class="center"><?= $row['user_titlename']; ?><?= $row['user_name']; ?> <?= $row['user_lastname']; ?></td>
                                <td class="center"><?= $row['user_tel']; ?></td>
                                <td class="center"><?= date_format(date_create($row['user_birth']), 'd/m/Y'); ?></td>
                                <td class="center"><?= $row['user_address']; ?></td>
                                <td class="center"><?= role($row['user_type']); ?></td>
                            </tr>
                        <?PHP } ?>
                        </tbody>
                    </table>
                    <!-- End PC Screen -->

                     <!-- Mobile Screen -->
                     <table class="table table-striped table-bordered table-hover d-block d-sm-none" id="table-mobile">
                        <thead>
                        <tr>
                            <th>รายการ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?PHP foreach ($list as $key => $row) { ?>
                            <tr>
                                <td>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <b>ลำดับที่ <?= $key + 1; ?></b>
                                    </li>
                                    <li class="list-group-item text-left">
                                        <b>ชื่อ - สกุล : </b><?= $row['user_titlename']; ?><?= $row['user_name']; ?> <?= $row['user_lastname']; ?><br>
                                        <b>เบอร์โทร : </b><?= $row['user_tel']; ?><br>
                                        <b>วันเกิด : </b><?= date_format(date_create($row['user_birth']), 'd/m/Y'); ?><br>
                                        <b>ที่อยู่ : </b><?= $row['user_address']; ?><br>
                                        <b>สถานะ : </b><?= role($row['user_type']); ?>
                                    </li>
                                </ul>
                                </td>
                            </tr>
                        <?PHP } ?>
                        </tbody>
                    </table>
                    <!-- End Mobile Screen -->
                    
                    <hr>
                    <div class="">
                        <a href="report.php" class="btn btn-warning mb-2">ย้อนกลับ</a>
                        <a href="../print_employee.php" class="btn btn-warning mb-2">ปริ้นรายงาน</a>
                    </div>
                    <br>
                    <br>
                </div>
            </div>
        </div>
    </div>


</div>

<?PHP include "include/footer.php"; ?>


</body>
</html>