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

                <legend>รายงานคะแนนรีวิว</legend>



                <div class="tb_all">


                    <?PHP
                    $sql = "SELECT * FROM tb_review a INNER JOIN tb_user b ON a.user_id = b.user_id INNER JOIN tb_homestay d ON a.homestay_id = d.homestay_id ORDER BY review_id DESC ";
                    $list = result_array($sql);
                    ?>

                     <!-- PC Screen -->   
                    <div class="tb_all d-none d-sm-block">
                    <table class="table table-striped table-bordered table-hover" id="table-js">
                        <thead>
                        <tr>
                            <th width="50">ลำดับ</th>
                            <th>ความคิดเห็น</th>
                            <th>คะแนน</th>
                            <th>โฮมสเตย์</th>
                            <th>วันที่</th>
                            <th>ลูกค้า</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?PHP foreach ($list as $key => $row) { ?>
                            <tr>
                                <td class="center"><?= $key + 1; ?></td>
                                <td class="center">
                                    <b><?= $row['review_name']; ?> </b><br>
                                    <?= $row['review_detail']; ?>
                                </td>
                                <td class="center"><?= $row['review_star']; ?></td>
                                <td class="center"><?= $row['homestay_name']; ?></td>
                                <td class="center"><?= datetime_th($row['review_date']); ?></td>
                                <td class="center"><?= $row['user_titlename']; ?><?= $row['user_name']; ?> <?= $row['user_lastname']; ?></td>
                            </tr>
                        <?PHP } ?>
                        </tbody>
                    </table>
                    </div>
                     <!-- End PC Screen --> 

                    <!-- Mobile Screen -->    
                    <table class="table table-striped table-bordered table-hover d-block d-sm-none" id="table-mobile">
                        <thead>
                            <tr>
                                <th >รายการ</th>
                            </tr>
                            </thead>
                        <tbody>
                              <?PHP foreach ($list as $key => $row) { ?>
                                 <tr>
                                    <td class="text-left">
                                        <div style="white-space: normal;">
                                        <ul class="list-group">
                                            <li class="list-group-item text-center">
                                                <b>ลำดับที่ <?= $key + 1; ?></b> 
                                            </li>
                                            <li class="list-group-item">
                                                <b>ความคิดเห็น : </b><?= $row['review_detail']; ?><br>
                                                <b>คะแนน : </b><?= $row['review_star']; ?><br>
                                                <b>โฮมสเตย์  : </b><?= $row['homestay_name']; ?> <br>
                                                <b>วันที่ : </b><?= datetime_th($row['review_date']); ?> <br>
                                                <b>ลูกค้า : </b><?= $row['user_titlename']; ?><?= $row['user_name']; ?> <?= $row['user_lastname']; ?> <br>
                                             </li>
                                         </ul>
                                     </div>
                                    </td>
                                </tr>
                            <?PHP } ?>
                        </tbody>
                    </table>
                    <!--End Mobile Screen -->   
                    <hr>

                    <a href="report.php" class="btn btn-warning">ย้อนกลับ</a>
                    <a href="../print_review.php" class="btn btn-warning d-none d-sm-inline" >ปริ้นรายงาน</a>
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