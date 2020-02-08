<!doctype html>
<html>
<head>
    <?PHP include "include/script.php";?>
    <style>
        .form-group {
            overflow: hidden;
        }
    </style>
</head>
<body>


<?PHP include "include/header.php";?>

<div class="container main">

    <?PHP include "include/right.php";?>


    <div class="col-sm-9 col-lg-9">
        <div id="register-wraper">
            <div id="register-form" style="position: relative;">

                <legend>ข้อมูลโฮมสเตย์</legend>

                <?PHP
$sql = "SELECT * FROM tb_homestay a INNER JOIN tb_user b ON a.user_id = b.user_id";
$list = result_array($sql);
?>

                <!-- PC Screen -->
                <div class="tb_all d-none d-sm-block">
                    <table class="table table-striped table-bordered table-hover" id="table-js">
                        <thead>
                        <tr>
                            <th width="50">ลำดับ</th>
                            <th width="60">รูปภาพ</th>
                            <th>รายการ</th>
                            <th>เจ้าของ</th>
                            <th width="90">จัดการ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?PHP foreach ($list as $key => $row) {?>
                            <tr>
                                <td class="center"><?=$key + 1;?></td>
                                <td class="center"><img src="../uploads/<?=$row['homestay_pic'];?>" style="width: auto; height: 50px;" alt=""></td>
                                <td class="center"><?=$row['homestay_name'];?></td>
                                <td class="center"><?=$row['user_titlename'];?><?=$row['user_name'];?> <?=$row['user_lastname'];?></td>
                                <td class="center">
                                    <a href="list_room.php?id=<?=$row['homestay_id'];?>"
                                       class="btn btn-xs btn-primary btn-rounded">
                                        ข้อมูลห้องพัก
                                    </a>
                                </td>
                            </tr>
                        <?PHP }?>
                        </tbody>
                    </table>
                </div>
                <!-- End PC Screen -->

                <!-- Mobile Screen -->
                <div class="tb_all d-block d-sm-none">
                    <table class="table table-striped table-bordered table-hover" id="table-mobile">
                        <thead>
                        <tr>
                            <th>รายการ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?PHP foreach ($list as $key => $row) {?>
                            <tr>
                                <td>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                    <b>
                                        ลำดับที่ <?=$key + 1;?>
                                    </b>
                                        <b>
                                            <?=$row['homestay_name'];?>
                                        </b>
                                    </li>
                                    <li class="list-group-item text-center">
                                        <img src="../uploads/<?=$row['homestay_pic'];?>" style="width: auto; height: 100px;" alt="">
                                        <br />
                                
                                        <b>
                                            เจ้าของ: 
                                        </b>
                                        <?=$row['user_titlename'];?><?=$row['user_name'];?> <?=$row['user_lastname'];?>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="list_room.php?id=<?=$row['homestay_id'];?>" class="btn btn-xs btn-primary btn-rounded">
                                            ข้อมูลห้องพัก
                                        </a>
                                    </li>
                                </td>
                            </ul>
                            </tr>

                        <?PHP }?>
                        </tbody>
                    </table>
                </div>
                <!-- End Mobile Screen -->
            </div>
        </div>
    </div>


</div>

<?PHP include "include/footer.php";?>



</body>
</html>