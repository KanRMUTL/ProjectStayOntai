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

    <?PHP
    extract($_GET);
    $sql = "SELECT * FROM tb_review a INNER JOIN tb_user b ON a.user_id = b.user_id INNER JOIN tb_homestay d ON a.homestay_id = d.homestay_id WHERE a.review_id = '{$id}' ORDER BY review_id DESC ";
    $row = row_array($sql);
    ?>


    <div class="col-sm-9 col-lg-9">
        <div id="register-wraper">
            <div class="form_all">

                <legend>ตอบกลับรีวิว</legend>

                <div>
                    <b>หัวข้อ : </b> <?= $row['review_name']; ?> <br>
                    <b>คะแนน : </b> <?= $row['review_star']; ?> <br>
                    <b>รายละเอียด : </b> <?= $row['review_detail']; ?> <br>
                    <b>สมาชิก : </b> <?= $row['user_titlename']; ?><?= $row['user_name']; ?> <?= $row['user_lastname']; ?> <br>
                </div>

                <form role="form" action="process/review_send.php" method="post"
                      enctype="multipart/form-data">

                    <input type="hidden" name="id" value="<?=$row['review_id']?>">
                    <input type="hidden" name="tel" value="<?=$row['user_tel']?>">

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label style="color: red;">ตอบกลับรีวิว</label>
                                <textarea class="form-control" rows="2" name="msg" maxlength="1000"
                                          required></textarea>
                            </div>
                        </div>

                    </div>


                    <p align="center">
                        <button type="submit" class="btn btn-primary">ส่งข้อความ</button>
                        <a href="review.php" class="btn btn-warning">ย้อนกลับ</a>
                    </p>
                </form>
            </div>
        </div>
    </div>


</div>

<?PHP include "include/footer.php"; ?>


<script>
    $(document).ready(function () {
        $(document).ready(function () {

            $("select[name='provinces']").change(function () {
                var id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "../ajax/get_districts.php",
                    cache: false,
                    data: {
                        id: id
                    },
                    success: function (list) {
                        $("select[name='districts']").empty();
                        $("select[name='districts']").append(list);

                    }
                });
            });

            $("select[name='districts']").change(function () {
                var id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "../ajax/get_subdistricts.php",
                    cache: false,
                    data: {
                        id: id
                    },
                    success: function (list) {
                        $("select[name='subdistricts']").empty();
                        $("select[name='subdistricts']").append(list);

                    }
                });
            });
        });
    });
</script>


</body>
</html>