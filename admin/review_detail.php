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

                <legend>รายละเอียดตอบกลับรีวิวของลูกค้า</legend>

                <?PHP
                extract($_GET);
                $sql = "SELECT * FROM tb_review a INNER JOIN tb_user b ON a.user_id = b.user_id INNER JOIN tb_homestay d ON a.homestay_id = d.homestay_id WHERE review_id = '{$id}'";
                $result = result_array($sql);
                ?>

                <div class="row">

                    <?PHP foreach ($result as $row) { ?>
                        <div class="col-md-10 col-md-offset-1" style="margin-bottom: 20px;">
                            <div style="border: 2px solid #cccccc; padding: 15px 20px; background: #ffffff;">
                                <div class="row">
                                    <div class="col-md-2">
                                        <img src="../uploads/<?= $row['user_picture'] ?>" class="img-responsive" alt="">
                                    </div>
                                    <div class="col-md-7 text-left">
                                        <b>ผู้รีวิว
                                            :</b> <?= $row['user_titlename']; ?><?= $row['user_name']; ?> <?= $row['user_lastname']; ?>
                                        <br>
                                        <b>ห้อข้อ :</b> <?= $row['review_name']; ?> <br>
                                        <b>รายละเอียด :</b> <?= $row['review_detail']; ?> <br>
                                        <b>โฮมสเตย์ :</b> <?= $row['homestay_name']; ?> <br>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <?= $row['review_date']; ?>
                                    </div>
                                </div>
                            </div>

                            <?PHP
                            $sql = "SELECT * FROM tb_review_answer a INNER JOIN tb_user b ON a.user_id = b.user_id WHERE review_id = '{$row['review_id']}' ORDER BY review_answer_id ASC ";
                            $answer = result_array($sql);
                            ?>

                            <?PHP foreach ($answer as $_answer) { ?>
                                <div class="col-md-10 col-md-offset-1">
                                    <div style="border: 2px solid #cccccc; padding: 15px 20px; background: #ffffff; margin-top: 3px;">
                                        <div class="row">
                                            <div class="col-md-9 text-left">
                                                <p>
                                                    <?=$_answer['review_answer_detail'];?>
                                                </p>
                                                <b>ผู้ตอบ :</b> <?= $_answer['user_titlename']; ?><?= $_answer['user_name']; ?> <?= $_answer['user_lastname']; ?>
                                                [ <?= role($_answer['user_type']); ?> ]
                                            </div>
                                            <div class="col-md-3 text-center">
                                                <?= $_answer['review_answer_date']; ?>
                                                <br>
                                                <?PHP if ($_answer['review_answer_status'] == 1) { ?>
                                                    <a href="process/review_answer_status_update.php?status=0&id=<?= $_answer['review_answer_id']; ?>"
                                                       class="btn btn-success btn-xs">
                                                        <i class="fa fa-eye"></i>
                                                    </a>

                                                <?PHP } else { ?>
                                                    <a href="process/review_answer_status_update.php?status=1&id=<?= $_answer['review_answer_id']; ?>"
                                                       class="btn btn-default btn-xs">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                <?PHP } ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?PHP } ?>
                        </div>

                    <?PHP } ?>


                    <div class="clearfix"></div>
                    <a href="review_form.php?id=<?= $row['review_id']; ?>"
                       class="btn btn-primary">
                        ตอบกลับ
                    </a>
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