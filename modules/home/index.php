<style>
    .slick-prev {
        position: absolute;
        top: 52px;
        left: -45px;
        color: #ffffff;
        font-size: 100px;
        cursor: pointer;
    }

    .slick-next {
        position: absolute;
        top: 52px;
        right: -45px;
        color: #ffffff;
        font-size: 100px;
        cursor: pointer;
    }
</style>
<div class="block-index">
    <div class="container">
        <?PHP include 'include/header.php'; ?>
    </div>
</div>

<div class="main-index width_main">
    <div class="img-main-header">
        <img src="assets/images/bg_main_index.png" alt="">
    </div>

    <div class="main-body">
        <div class="col-md-7">
            <div class="main-welcome">
                ยินดีต้อนรับสู่โฮมสเตย์ออนใต้วิถีชีวิตไลฟ์สไตล์แบบธรรมชาติบำบัด (Naturopathy) อากาศสดชื่น
                เขียวขจีไปด้วยต้นไม้ใบหญ้าชวนให้ทุกท่านได้มาลองสัมผัสวิถีคนพื้นเมือง ภาษา การเป็นอยู่ อาหาร
                และขนบธรรมเนียม ที่มีถิ่นอารยธรรมความเป็นล้านนาสมัยก่อนแบบประยุกต์เข้ากับยุคสมัยนี้
                โฮมสเตย์ทุกหลังมีความเป็นเอกลักษณ์ของแต่ละบ้านไม่เหมือนกัน แต่ที่เหมือนกันและทุกครั้งที่มาพักคือ
                ความอบอุ่นจากเจ้าบ้าน
                ความเป็นห่วงเป็นใยเอาใจใส่ต่อผู้คนที่มาพักเหมือนเป็นครอบครัวเดียวกันจนทำให้ผู้คนที่เข้ามาพักไม่อาจทำให้ลืมจนย้อนกลับมาพักอีกครั้ง
                ไม่มีแค่โฮมสเตย์แต่ยังมีออนใต้เป็นเมืองเก่าที่มีตำนานมากมายทำนอง “ร้อยเรื่องเล่า”
                และยังรักษาวิถีชีวิตพื้นบ้าน มีความผูกพันธ์ ความโอบอ้อมอารีมีน้ำใจและวิถีชีวิตแบบ “บ้านจุ้ม เมืองเย็น”
                (บ้านที่อุดมสมบูรณ์ เมืองที่สงบร่มเย็น) ทำให้ตำบลออนใต้มีเสน่ห์ดึงดูดให้ผู้คนเข้ามาเยี่ยมเยือน
            </div>
        </div>

        <div class="col-md-5">
            <div class="main-promotion">
                <h2>PROMOTION</h2>

                <?PHP
                $sql = "SELECT * FROM tb_promotion ORDER BY promotion_id DESC limit 10";
                $result = result_array($sql);
                ?>
                <div style="width: 100%; height: 420px; overflow: auto">
                    <ul style="padding-left: 0; text-align: left;">
                        <?PHP foreach ($result as $row){ ?>
                            <li style="padding:0 20px; border-bottom: 1px solid #cccccc;">
                                <h4 style="font-size: 22px; font-weight: bold;">
                                    <?=$row['promotion_title'];?>
                                </h4>
                                <p style="font-size: 18px;">
                                    <?=$row['promotion_detail'];?>
                                </p>
                                <p style="font-size: 18px; color: red; text-align: right;">
                                    <b>ระยะเวลา :</b>
                                    <?=date_th($row['promotion_date_start']);?> -
                                    <?=date_th($row['promotion_date_end']);?>
                                </p>
                            </li>
                        <?PHP } ?>
                    </ul>


                </div>
            </div>
        </div>


        <div class="clearfix"></div>
    </div>
</div>

<div class="main-slide">
    <div class="width_main center-auto">
        <div class="main-body pdt25">
            <div class="slide">
                <div>
                    <a href="assets/images/test/pho01.png" class="fancybox" rel="sh1">
                        <img src="assets/images/test/pho01.png" alt="">
                    </a>
                </div>
                <div>
                    <a href="assets/images/test/pho02.png" class="fancybox" rel="sh1">
                        <img src="assets/images/test/pho02.png" alt="">
                    </a>
                </div>
                <div>
                    <a href="assets/images/test/pho03.png" class="fancybox" rel="sh1">
                        <img src="assets/images/test/pho03.png" alt="">
                    </a>
                </div>
                <div>
                    <a href="assets/images/test/pho04.png" class="fancybox" rel="sh1">
                        <img src="assets/images/test/pho04.png" alt="">
                    </a>
                </div>
                <div>
                    <a href="assets/images/test/pho05.png" class="fancybox" rel="sh1">
                        <img src="assets/images/test/pho05.png" alt="">
                    </a>
                </div>
                <div>
                    <a href="assets/images/test/pho06.png" class="fancybox" rel="sh1">
                        <img src="assets/images/test/pho06.png" alt="">
                    </a>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="main-travel center-auto">
                <h2>สถานที่ท่องเที่ยวแนะนำ</h2>

                <?PHP
                $sql = "SELECT * FROM tb_visitplace ORDER BY rand() limit 4 ";
                $result = result_array($sql);
                ?>


                <div class="bg_main">
                    <?PHP foreach ($result as $key => $row) { ?>
                        <div class="col-md-3 pt10 <?= ($key % 2) != 0 ? "bg_main" : "bg_white"; ?>">
                            <a href="index.php?module=home&action=visitplace_detail&id=<?=$row['visitplace_id'];?>">
                                <img src="uploads/<?= $row['visitplace_picture']; ?>" alt="">
                                <p class="<?= ($key % 2) != 0 ? "color_white" : "color_black"; ?>"><?= $row['visitplace_name']; ?></p>
                            </a>
                        </div>
                    <?PHP } ?>
                </div>

                <div class="clearfix"></div>

                <p class="text-right" style="padding-top: 10px">
                    <a href="index.php?module=home&action=visitplace" class="btn btn-warning">ดูทั้งหมด</a>
                </p>


            </div>

            <div class="clearfix"></div>
        </div>
        <div class="img-main-footer">
            <img src="assets/images/bg_main_footer_index.png" alt="">
        </div>
    </div>
</div>

<script>
    $(function () {
        $('.slide').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            prevArrow: '<div class="slick-prev" aria-label="Previous"><</div>',
            nextArrow: '<div class="slick-next" aria-label="Next">></div>',
        });
    });
</script>
