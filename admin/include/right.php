<div class="col-sm-3 col-lg-3">

    <div class="half-unit user">
        <div class="clockcenter">
            <p id="timeRight" style="color: #000000; font-weight: bold;">

            </p>
            <img src="assets/img/logo.png" style="width: 100px; height: auto;" alt="">
            <div style="color: #000000; font-weight: bold;">
                <p>
                    โฮมสเตย์ออนใต้ <br>
                    สันกำแพง เชียงใหม่
                </p>
            </div>
        </div>
    </div>

    <div class="half-unit user">
        <div class="clockcenter">
            <?PHP if (check_session('picture') != "") { ?>
                <img src="../uploads/<?= check_session('picture'); ?>" alt="">
            <?PHP } else { ?>
                <img src="assets/img/icon/no.png" alt="">
            <?PHP } ?>

            <h2 style="color: #000000;">
                (
                <small style="color: #ff0000;"><?= role(check_session('role')); ?></small>
                )
                <br>
                <?= check_session('name'); ?> <?= check_session('lastname'); ?>
            </h2>

            <a href="edit_profile.php" class="btn btn-warning btn-sm">แก้ไขข้อมูลส่วนตัว</a>
            <a href="process/logout.php" class="btn btn-danger btn-sm">ออกจากระบบ</a>

        </div>
    </div>


</div>


<script>
    $(document).ready(function () {
        setInterval(function() {
            var date = new Date();

            $('#timeRight').html(
                addZero(date.getHours()) + ":" + addZero(date.getMinutes()) + ":" + addZero(date.getSeconds())
            );
        }, 500);
    });

    function addZero(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }
</script>


