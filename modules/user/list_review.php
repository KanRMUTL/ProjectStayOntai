<div class="block-page">
    <div class="container">
        <?PHP include 'include/header.php'; ?>


        <h1 class="title-page text-center">ประวัติการรีวิว</h1>

        <div class="row">
            <div class="col-md-12">

                <?PHP
                $uid = check_session("user_id");
                $sql = "SELECT * FROM tb_review a INNER JOIN tb_user b ON a.user_id = b.user_id INNER JOIN tb_homestay d ON a.homestay_id = d.homestay_id WHERE a.user_id = '{$uid}' ORDER BY review_id DESC ";
                $list = result_array($sql);
                ?>

                <div class="table-responsive">
                    <table class="table table-bordered" style="background: #ffffff;">
                        <thead>
                        <tr style="background: #eeeeee;">
                            <th class="text-center" width="50">ลำดับ</th>
                            <th class="text-center">ความคิดเห็น</th>
                            <th class="text-center" width="120">คะแนน</th>
                            <th class="text-center" width="200">โฮมสเตย์</th>
                            <th class="text-center" width="200">วันที่</th>
                            <th class="text-center" width="200">สมาชิก</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?PHP foreach ($list as $key => $row) { ?>
                            <tr>
                                <td class="text-center"><?= $key + 1; ?></td>
                                <td class="text-left">
                                    <b><?= $row['review_name']; ?> </b><br>
                                    <?= $row['review_detail']; ?>
                                </td>
                                <td class="text-center"><?= $row['review_star']; ?></td>
                                <td class="text-center"><?= $row['homestay_name']; ?></td>
                                <td class="text-center"><?= datetime_th($row['review_date']); ?></td>
                                <td class="text-center"><?= $row['user_titlename']; ?><?= $row['user_name']; ?> <?= $row['user_lastname']; ?></td>
                            </tr>
                        <?PHP } ?>

                        <?PHP if (count($list) == 0) { ?>
                            <tr>
                                <td colspan="8" class="text-center">ไม่มีรายการ</td>
                            </tr>
                        <?PHP } ?>
                        </tbody>
                    </table>

                    <br>
                    <br>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>



