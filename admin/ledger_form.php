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

    $id = "";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }

    $sql = "SELECT * FROM tb_ledger WHERE ledger_id = '{$id}'";
    $row = row_array($sql);


    ?>


    <div class="col-sm-9 col-lg-9">
        <div id="register-wraper">
            <div class="form_all">

                <legend>จัดการบัญชี : รายจ่าย</legend>

                <form role="form" action="process/ledger_process.php" method="post"
                      enctype="multipart/form-data">

                    <input type="hidden" name="id" value="<?= $row['ledger_id']; ?>">
                    <input type="hidden" name="type" value="2">

                    <div class="form-group">
                        <label>โฮมสเตย์</label>
                        <?PHP
                        $uid = check_session("id");
                        $sql = "SELECT * FROM tb_homestay WHERE user_id = '{$uid}'";
                        $list = result_array($sql);
                        ?>

                        <select name="homestay_id" class="form-control" required>
                            <option disabled selected value="">เลือกโฮมสเตย์</option>
                            <?PHP foreach ($list as $key => $_list) { ?>
                                <option <?= $_list['homestay_id'] == $row['homestay_id'] ? "selected" : ""; ?>
                                        value="<?= $_list['homestay_id']; ?>"><?= $_list['homestay_name']; ?></option>
                            <?PHP } ?>
                        </select>

                    </div>

                    <div class="form-group">
                        <label>รายการ</label>
                        <input type="text" class="form-control" name="name" value="<?= $row['ledger_name']; ?>"
                               required>
                    </div>


                    <div class="form-group">
                        <label>จำนวนเงิน</label>
                        <input type="text" class="form-control numberOnly" name="money"
                               value="<?= $row['ledger_money']; ?>"
                               required>
                    </div>

                    <p align="center">
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                        <a href="ledger.php?type=2&active=2" class="btn btn-warning">ย้อนกลับ</a>
                    </p>
                </form>
            </div>
        </div>
    </div>


</div>

<?PHP include "include/footer.php"; ?>


</body>
</html>