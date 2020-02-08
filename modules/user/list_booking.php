<div class="block-page">
    <div class="container">
        <?PHP include 'include/header.php'; ?>


        <h1 class="title-page text-center">ประวัติการจอง</h1>

        <div class="row">
            <div class="col-md-12">
                <?PHP
                $uid = check_session("user_id");
                $sql = "SELECT * FROM tb_booking a INNER JOIN tb_user b ON a.user_id = b.user_id WHERE a.user_id = '{$uid}' ORDER BY a.booking_id DESC ";
                $result = result_array($sql);
                ?>

                <div class="table-responsive">
                    <table class="table table-bordered" style="background: #ffffff;">
                        <thead>
                        <tr style="background: #eeeeee;">
                            <th class="text-center" width="100">ลำดับ</th>
                            <th class="text-center">รายการ</th>
                            <th class="text-center" width="180">ราคารวม</th>
                            <th class="text-center" width="180">สถานะ</th>
                            <th class="text-center" width="180">จัดการ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?PHP foreach ($result as $key => $row) { ?>
                            <tr>
                                <td data-title="ลำดับ &nbsp" class="text-center"><?= $key + 1; ?></td>
                                <td data-title="รายละเอียด" class="text-left">
                                 <p><b>เลขที่การจอง :</b> <?=booking_id($row['booking_id'])?> <br>
                                    <b>เช็คอิน :</b> <?=date_th($row['booking_check_in']);?> <br>
                                   <b>เวลาเช็คอิน :</b><?=date($row['booking_date']);?><br>
                                   <div class="clo2">
                                   <b>เช็คเอาท์ :</b> <?=date_th($row['booking_check_out']);?> <br>
                                    <b>ผู้จอง :</b> <?= $row['user_titlename']; ?><?= $row['user_name']; ?> <?= $row['user_lastname']; ?></p>
                                   </div>
                                  
                                </td>
                                <td data-title="ราคารวม &nbsp" class="text-center"><?= number_format($row['booking_sum'],2); ?></td>
                                <td data-title="สถานะ &nbsp" class="text-center"><?= booking_status($row['booking_status']); ?></td>
                                <td class="text-center">
                                    <a target="_blank" href="print_booking.php?id=<?=$row['booking_id'];?>" class="btn btn-primary btn-sm">รายละเอียด</a>
                                </td>
                            </tr>
                        <?PHP } ?>

                        <?PHP if (count($result) == 0) { ?>
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



