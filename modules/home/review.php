<div class="block-page">
    <div class="container">
        <?PHP include 'include/header.php'; ?>


        <h1 class="title-page text-center">รีวิวโฮสเตย์</h1>

        <?PHP
        $sql = "SELECT * FROM tb_review a INNER JOIN tb_user b ON a.user_id = b.user_id INNER JOIN tb_homestay d ON a.homestay_id = d.homestay_id WHERE review_show = 1";
        $result = result_array($sql);
        ?>

        <div class="row">

            <?PHP foreach ($result as $row) { ?>
                <div class="col-md-10 col-md-offset-1" style="margin-bottom: 20px;">
                    <div style="border: 2px solid #cccccc; padding: 15px 20px; background: #ffffff;">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="uploads/<?= $row['user_picture'] ?>" class="img-responsive" alt="">
                            </div>
                            <div class="col-md-8">
                                <b>ผู้รีวิว
                                    :</b> <?= $row['user_titlename']; ?><?= $row['user_name']; ?> <?= $row['user_lastname']; ?>
                                <br>
                                <b>ห้อข้อ :</b> <?= $row['review_name']; ?> <br>
                                <b>รายละเอียด :</b> <?= $row['review_detail']; ?> <br>
                                <b>โฮมสเตย์ :</b> <?= $row['homestay_name']; ?> <br>
                            </div>
                            <div class="col-md-2 text-center">
                                <?= $row['review_date']; ?>
                            </div>
                        </div>
                    </div>

                    <?PHP
                    $sql = "SELECT * FROM tb_review_answer a INNER JOIN tb_user b ON a.user_id = b.user_id WHERE review_answer_status = 1 AND review_id = '{$row['review_id']}' ORDER BY review_answer_id ASC ";
                    $answer = result_array($sql);
                    ?>

                    <?PHP foreach ($answer as $_answer) { ?>
                        <div class="col-md-10 col-md-offset-1">
                            <div style="border: 2px solid #cccccc; padding: 15px 20px; background: #ffffff; margin-top: 3px;">
                                <div class="row">
                                    <div class="col-md-9">
                                        <b>ได้ทำการตอบกลับ</b>
                                        <p>
                                            <?=$_answer['review_answer_detail'];?>
                                        </p>
                                        <b>ผู้ตอบ : </b> <?= $_answer['user_titlename']; ?><?= $_answer['user_name']; ?> <?= $_answer['user_lastname']; ?>
                                        [ <?= role($_answer['user_type']); ?> ]
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <?= $_answer['review_answer_date']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?PHP } ?>
                </div>

            <?PHP } ?>


            <div class="clearfix"></div>
            <?PHP if (check_session("user_id")) { ?>
                <div class="col-md-6 col-md-offset-3" style="margin-left: 8%">
                    <div style="width: 172%; height: auto; overflow: hidden; background: #ffffff; border-radius: 20px; padding: 20px 50px; border: 3px solid #cccccc;" id="review_setup">
                        <h2 class="text-center">ข้อความรีวิว</h2>

                        

                        <form method="post" action="process/review_process.php">
                            <div class="form-group">
                                <label>โฮมสเตย์</label>
                                <?PHP
                                $sql = "SELECT * FROM tb_homestay ORDER BY homestay_id DESC ";
                                $result = result_array($sql);
                                ?>
                                <select name="homestay_id" class="form-control" required>
                                    <option disabled selected value="">เลือกโฮมสเตย์</option>
                                    <?PHP foreach ($result as $row) { ?>
                                        <option value="<?= $row['homestay_id'] ?>"><?= $row['homestay_name'] ?></option>
                                    <?PHP } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>หัวข้อ</label>
                                <input type="name" class="form-control" name="name">
                            </div>

                            <div class="form-group">
                                <label>รายละเอียด</label>
                                <textarea name="detail" rows="3" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <label>คะแนน</label> <br>
                                <div style="padding-left: 50px;">
                                    <label class="radio">
                                        <input type="radio" name="star" value="5" checked> 5 (ดีเยี่ยม)
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="star" value="2"> 4 (ดีมาก)
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="star" value="3"> 3 (ดี)
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="star" value="2"> 2 (พอใช้)
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="star" value="1"> 1 (ปรับปรุง)
                                    </label>
                                </div>
                            </div>

                            

                            <button type="submit" style="width: 100%;" class="btn btn-primary">ส่งรีวิว</button>
                        </form>
                    </div>
                </div>

            <?PHP } ?>
            <div class="clearfix"></div>
            <br>
            <br>
            <br>

        </div>

    </div>
</div>



