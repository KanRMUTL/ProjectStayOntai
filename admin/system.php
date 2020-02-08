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

                <legend>ตั้งค่าระบบ</legend>

                <?PHP
                $sql = "SELECT * FROM tb_visitplace";
                $list = result_array($sql);
                ?>

                <div class="tb_all">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th width="50">ลำดับ</th>
                            <th>รายการ</th>
                            <th width="100">ค่า</th>
                            <th width="250">แก้ไข</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?PHP
                        $sql = "SELECT * FROM tb_system WHERE system_id = 1";
                        $row = row_array($sql);
                        ?>
                        <tr>
                            <td class="center">1</td>
                            <td class="text-left"><?= $row['system_name']; ?></td>
                            <td class="center"><?= $row['system_value']; ?>%</td>
                            <td>
                                <form action="process/system_process.php">
                                    <input type="hidden" name="id" value="1">

                                    <div class="col-md-8">
                                        <div class="row">
                                            <input type="text" class="form-control numberOnly" name="value" maxlength="2" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-warning btn-xs">
                                            อัพเดท
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        <?PHP
                        $sql = "SELECT * FROM tb_system WHERE system_id = 2";
                        $row = row_array($sql);
                        ?>
                        <tr>
                            <td class="center">1</td>
                            <td class="text-left"><?= $row['system_name']; ?></td>
                            <td class="center"><?= $row['system_value']; ?> ชม.</td>
                            <td>
                                <form action="process/system_process.php">
                                    <input type="hidden" name="id" value="2">

                                    <div class="col-md-8">
                                        <div class="row">
                                            <input type="text" class="form-control numberOnly" name="value" maxlength="2" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-warning btn-xs">
                                            อัพเดท
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
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