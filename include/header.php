<div id="bg-click-mobile"></div>

<div class="new-header">
    <div class="header">
        <div class="logo">
            <a href="index.php">
                <img src="assets/images/logo.png" alt="">
            </a>
        </div>


        <div class="header-status">
            <button type="button" class="show_mobile btn-menu-mobile">
                <span class="fa fa-bars"></span>
            </button>
            <ul class="hide_mobile">
                <?PHP if (check_session("user_id")) { ?>
                    <li>
                        <?PHP
                        $my = check_user(check_session("user_id"));

                        $name = "คุณ {$my['user_name']} {$my['user_lastname']}";
                        ?>
                        <a style="text-decoration: none; color: #ffd700; margin-right: -12px;">
                            <?= cut_text($name, 65); ?>
                        </a>

                        <div class="text-welcome hide_mobile">
                            WELCOME TO HOMESTAY OON-TAI
                        </div>
                        <div class="text-welbow">
                            <a href="index.php?module=user&action=editprofile">แก้ไขข้อมูลส่วนตัว</a>
                            <?PHP
                            $sql = "SELECT * FROM tb_booking WHERE user_id = '{$my['user_id']}' AND booking_status = 1";
                            $result = result_array($sql);
                            ?>
                            <a href="index.php?module=homestay&action=payment">ชำระเงิน [ <?= count($result); ?> ]</a>
                            <a href="index.php?module=user&action=list_booking">ประวัติการจอง</a>
                            <a href="index.php?module=user&action=list_review">ประวัติการรีวิว</a>
                            <a href="process/logout.php" style="color: #ff8482;">ออกจากระบบ</a>
                        </div>
                    </li>
                <?PHP } else { ?>

                    <div class="text-welcome2 hide_mobile">
                        WELCOME TO HOMESTAY OON-TAI
                    </div>
                    <li>
                        <div class="tex-weldow2">
                            <a href="index.php?module=user&action=register">สมัครสมาชิก</a>
                            <a href="index.php?module=user&action=login">เข้าสู่ระบบ</a>
                            <a href="index.php?module=user&action=forget_password">ลืมรหัสผ่าน</a>
                        </div>
                    </li>
                <?PHP } ?>

            </ul>
        </div>

    </div>
    <div class="menu hide_mobile">

        <ul>
            <li>
                <a href="index.php?module=home&action=index">หน้าหลัก</a>
            </li>
            <li>
                <a href="index.php?module=home&action=about">เกี่ยวกับ</a>
            </li>
            <li>
                <a href="index.php?module=home&action=news">ข่าวสาร</a>
            </li>
            <li>
                <a href="index.php?module=home&action=homestay">โฮมสเตย์</a>
            </li>
            <li>
                <a href="index.php?module=home&action=visitplace">สถานที่ท่องเที่ยว</a>
            </li>
            <li>
                <a href="index.php?module=home&action=otop">สินค้า OTOP</a>
            </li>
            <li>
                <a href="index.php?module=home&action=contact">ติดต่อ</a>
            </li>
            <li>
                <a href="index.php?module=home&action=review">รีวิวโฮสเตย์</a>
            </li>
        </ul>
    </div>

    <?PHP if (count($_SESSION['homestay']['booking']) > 0) { ?>
        <a href="index.php?module=homestay&action=confirm_booking" class="cart-booking">
            <i class="fa fa-eye"></i>
            จองแล้ว <?= count($_SESSION['homestay']['booking']); ?> ห้อง
            เหลือ <?= $_SESSION['homestay']['room'] - count($_SESSION['homestay']['booking']); ?> ห้อง
        </a>
    <?PHP } ?>

    <div class="clearfix"></div>
</div>

<div id="nav-mobile" style="overflow: auto;">
    <ul>
        <?PHP if (check_session("user_id")) { ?>
            <li>
                <?PHP
                $my = check_user(check_session("user_id"));

                $name = "คุณ {$my['user_name']} {$my['user_lastname']}";
                ?>
                <a style="text-decoration: none; color: #ffd700; margin-right: -12px;">
                    <?= cut_text($name, 65); ?>
                </a>

                <div class="text-welbow">
                    <a href="index.php?module=user&action=editprofile">แก้ไขข้อมูลส่วนตัว</a>
                    <?PHP
                    $sql = "SELECT * FROM tb_booking WHERE user_id = '{$my['user_id']}' AND booking_status = 1";
                    $result = result_array($sql);
                    ?>
                    <a href="index.php?module=homestay&action=payment">ชำระเงิน [ <?= count($result); ?> ]</a>
                    <a href="index.php?module=user&action=list_booking">ประวัติการจอง</a>
                    <a href="index.php?module=user&action=list_review">ประวัติการรีวิว</a>
                    <a href="process/logout.php" style="color: #ff8482;">ออกจากระบบ</a>
                </div>
            </li>
        <?PHP } else { ?>
            <li>
                <div class="tex-weldow2">
                    <a href="index.php?module=user&action=register">สมัครสมาชิก</a>
                    <a href="index.php?module=user&action=login">เข้าสู่ระบบ</a>
                    <a href="index.php?module=user&action=forget_password">ลืมรหัสผ่าน</a>
                </div>
            </li>
        <?PHP } ?>

        <li>
            <a href="index.php?module=home&action=index">หน้าหลัก</a>
        </li>
        <li>
            <a href="index.php?module=home&action=about">เกี่ยวกับ</a>
        </li>
        <li>
            <a href="index.php?module=home&action=news">ข่าวสาร</a>
        </li>
        <li>
            <a href="index.php?module=home&action=homestay">โฮมสเตย์</a>
        </li>
        <li>
            <a href="index.php?module=home&action=visitplace">สถานที่ท่องเที่ยว</a>
        </li>
        <li>
            <a href="index.php?module=home&action=otop">สินค้า OTOP</a>
        </li>
        <li>
            <a href="index.php?module=home&action=contact">ติดต่อ</a>
        </li>
        <li>
            <a href="index.php?module=home&action=review">รีวิวโฮสเตย์</a>
        </li>
    </ul>
</div>

<script>
    $(document).ready(function () {
        $(".btn-menu-mobile").click(function () {
            $("div#bg-click-mobile").show();
            $("div#nav-mobile").show();
        });


        $("div#bg-click-mobile").click(function () {
            $("div#bg-click-mobile").hide();
            $("div#nav-mobile").hide();
        });
    });
</script>