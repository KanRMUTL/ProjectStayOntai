<style>
    a.link-head {
        color: gold !important;
    }

    .nav-new {
        list-style: none;
        float: right;
        padding-top: 10px;
    }
</style>
<div class="navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header" style="width: 100%;">

            <a class="navbar-brand" href="index.php" style="font-size: 32px; color: #ffffff;"><img
                        src="assets/img/logo.png"
                        style="float: left; margin: -12px 10px 0 0; width: auto; height: 44px; border-radius: 50%; background: #ffffff;"
                        alt=""> OON TAI</a>

            <ul class="nav-new">
                <?PHP if (check_session("role") == 2) { ?>
                    <li>
                        <?PHP
                        $sql = "SELECT * FROM tb_booking a INNER JOIN tb_payment f ON a.booking_id = f.booking_id INNER JOIN tb_user g ON a.user_id = g.user_id WHERE booking_status = 2";
                        $result = result_array($sql);
                        ?>
                        <a href="alert_payment.php" class="link-head">
                            <i class="fa fa-warning"></i>
                            แจ้งชำระเงิน [ <?= count($result); ?> ]
                        </a>
                    </li>
                <?PHP } ?>
            </ul>
        </div>
    </div>
</div>