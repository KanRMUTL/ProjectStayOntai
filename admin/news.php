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
                <a href="news_form.php" style="position: absolute; top: 10px; right: 10px;">
                    <button type="button" class="btn btn-primary btn-md"><i class="fa fa-plus"></i>
                        เพิ่มข้อมูล
                    </button>
                </a>
                <legend>จัดการข่าวสาร</legend>

                <?PHP
                $sql = "SELECT * FROM tb_news";
                $list = result_array($sql);
                ?>

                <div class="tb_all">
                    <table class="table table-striped table-bordered table-hover" id="table-js">
                        <thead>
                        <tr>
                            <th width="50">ลำดับ</th>
                            <th width="50">รูปภาพ</th>
                            <th>หัวข้อ</th>
                            <th width="150">จัดการ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?PHP foreach ($list as $key => $row) { ?>
                            <tr>
                                <td class="center"><?= $key + 1; ?></td>
                                <td class="center"><img src="../uploads/<?= $row['news_picture']; ?>" style="width: auto; height: 50px;" alt=""></td>
                                <td class="center"><?= $row['news_title']; ?></td>
                                <td class="center">
                                    <a href="new_picture.php?id=<?= $row['news_id']; ?>"
                                       class="btn btn-xs btn-primary btn-rounded">
                                        จัดการอัลบั้ม
                                    </a>

                                    <a href="news_form.php?id=<?= $row['news_id']; ?>"
                                       class="btn btn-xs btn-warning btn-rounded">
                                        แก้ไข
                                    </a>

                                    <a
                                        href="process/delete.php?table=tb_news&ff=news_id&id=<?= $row['news_id']; ?>"
                                        class="btn btn-xs btn-danger"
                                        onclick="return confirm_custom(this.href,'ต้องการลบข้อมูลนี้?');">
                                        ลบ
                                    </a>
                                </td>
                            </tr>
                        <?PHP } ?>
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