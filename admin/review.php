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

                <legend>ตอบกลับรีวิวของลูกค้า</legend>


                <div class="tb_all">


                    <?PHP
                    $sql = "SELECT * FROM tb_review a INNER JOIN tb_user b ON a.user_id = b.user_id INNER JOIN tb_homestay d ON a.homestay_id = d.homestay_id WHERE review_status < 2 ORDER BY review_id DESC ";
                    $list = result_array($sql);
                    ?>

                    <table class="table table-striped table-bordered table-hover" id="table-js">
                        <thead>
                        <tr>
                            <th width="50">ลำดับ</th>
                            <th>ความคิดเห็น</th>
                            <th width="60">คะแนน</th>
                            <th>โฮมสเตย์</th>
                            <th width="90">วันที่</th>
                            <th>ลูกค้า</th>
                            <th width="60">แสดง</th>
                            <th width="100">จัดการ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?PHP foreach ($list as $key => $row) { ?>
                            <tr>
                                <td class="center"><?= $key + 1; ?></td>
                                <td class="text-left">
                                    <b><?= $row['review_name']; ?> </b><br>
                                    <?= $row['review_detail']; ?>
                                </td>
                                <td class="center"><?= $row['review_star']; ?></td>
                                <td class="center"><?= $row['homestay_name']; ?></td>
                                <td class="center"><?= datetime_th($row['review_date']); ?></td>
                                <td class="center"><?= $row['user_titlename']; ?><?= $row['user_name']; ?> <?= $row['user_lastname']; ?></td>
                                <td class="center">
                                    <?PHP if ($row['review_show'] == 1) { ?>
                                        <a href="process/review_show_update.php?status=0&id=<?= $row['review_id']; ?>"
                                           class="btn btn-success btn-xs">
                                            <i class="fa fa-eye"></i>
                                        </a>

                                    <?PHP } else { ?>
                                        <a href="process/review_show_update.php?status=1&id=<?= $row['review_id']; ?>"
                                           class="btn btn-default btn-xs">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    <?PHP } ?>

                                </td>

                                <td class="center">
                                    <?PHP if ($row['review_status'] == 1) { ?>
                                        <span style="color: green;">ตอบกลับแล้ว</span>
                                        <a href="review_detail.php?id=<?= $row['review_id']; ?>"
                                           class="btn btn-primary btn-xs">
                                            รายละเอียด
                                        </a>
                                    <?PHP } else { ?>
                                        <a href="review_form.php?id=<?= $row['review_id']; ?>"
                                           class="btn btn-primary btn-xs">
                                            ตอบกลับ
                                        </a>

                                        <a href="process/review_update.php?status=2&id=<?= $row['review_id']; ?>"
                                           class="btn btn-danger btn-xs"
                                           onclick="return confirm_custom(this.href,'ยืนยันการทำรายการ?');">
                                            ลบ
                                        </a>
                                    <?PHP } ?>
                                </td>
                            </tr>
                        <?PHP } ?>
                        </tbody>
                    </table>





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