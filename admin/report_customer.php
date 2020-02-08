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

                <legend>รายงานข้อมูลลูกค้า</legend>



                <div class="tb_all">



                    <?PHP
                    $sql = "SELECT * FROM tb_user WHERE user_type = 9";
                    $list = result_array($sql);
                    ?>

                    <table class="table table-striped table-bordered table-hover" id="table-js">
                        <thead>
                        <tr>
                            <th width="50">ลำดับ</th>
                            <th width="50">รูปภาพ</th>
                            <th>ชื่อ - นามสกุล</th>
                            <th>อีเมล</th>
                            <th>เบอร์โทร</th>
                            <th>วันเกิด</th>
                            <th>ที่อยู่</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?PHP foreach ($list as $key => $row) { ?>
                            <tr>
                                <td class="center"><?= $key + 1; ?></td>
                                <td class="center"><img src="../uploads/<?= $row['user_picture']; ?>" style="width: auto; height: 50px;" alt=""></td>
                                <td class="center"><?= $row['user_titlename']; ?><?= $row['user_name']; ?> <?= $row['user_lastname']; ?></td>
                                <td class="center"><?= $row['user_email']; ?></td>
                                <td class="center"><?= $row['user_tel']; ?></td>
                                <td class="center"><?= $row['user_birth']; ?></td>
                                <td class="center"><?= $row['user_address']; ?></td>
                            </tr>
                        <?PHP } ?>
                        </tbody>
                    </table>


                    <hr>

                    <a href="report.php" class="btn btn-warning">ย้อนกลับ</a>
                    <a href="../print_customer.php" class="btn btn-warning">ปริ้นรายงาน</a>
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