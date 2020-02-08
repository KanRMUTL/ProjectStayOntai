<!doctype html>
<html>
<head>
    <?PHP include "include/script.php"; ?>
    <style>
        .form-group {
            overflow: hidden;
        }

        .bg-map {
            background-color: rgba(0, 0, 0, 0.6);
            left: 0px;
            min-height: 100vh;
            position: fixed;
            top: 0px;
            width: 100%;
            z-index: 9999;
            display: none;
        }
    </style>
</head>
<body>


<?PHP include "include/header.php"; ?>

<div class="container main">

    <?PHP include "include/right.php"; ?>


    <?PHP
    $id = "";
    $uid = check_session("id");

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }

    $sql = "SELECT * FROM tb_homestay WHERE homestay_id = '{$id}' AND user_id = '{$uid}'";
    $row = row_array($sql);


    ?>


    <div class="col-sm-9 col-lg-9">
        <div id="register-wraper">
            <div class="form_all">

                <legend>จัดการโฮมสเตย์</legend>

                <form role="form" action="process/homestay_process.php" method="post"
                      enctype="multipart/form-data">

                    <input type="hidden" name="id" value="<?= $row['homestay_id']; ?>">


                    <div class="form-group">
                        <label>โฮมสเตย์</label>
                        <input type="text" class="form-control" name="name" value="<?= $row['homestay_name']; ?>"
                               required>
                    </div>

                    <div class="form-group">
                        <label>ราคาต่อคืน</label>
                        <input type="text" class="form-control numberOnly" name="price"
                               value="<?= $row['homestay_price']; ?>"
                               required>
                    </div>


                    <div class="form-group">
                        <label>ที่อยู่</label>
                        <textarea class="form-control" name="address"><?= $row['homestay_address']; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>ตำแหน่งที่ตั้ง (ละติจูด / ลองจิจูด)</label>

                        <div class="row">
                            <div class="col-md-8">
                                <input type="text" placeholder="ละติจูด" class="form-control" name="lat"
                                       value="<?= $row['homestay_latitude']; ?>"
                                       required>

                                <input type="text" placeholder="ลองจิจูด" style="margin-top: 10px;" class="form-control"
                                       name="lng" value="<?= $row['homestay_longitude']; ?>"
                                       required>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="btn btn-info" id="btnShowmap">
                                    <img src="assets/img/icon/map_search.png" style="width: auto; height: 60px;" alt="">
                                </button>
                            </div>
                        </div>

                    </div>


                    <div class="form-group">
                        <label>รายละเอียด</label>
                        <textarea class="form-control" name="detail"><?= $row['homestay_detail']; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>รูปภาพประกอบ</label>
                        <input type="file" class="form-control" accept="image/*" name="img">
                    </div>

                    <div class="form-group">
                        <label>สิ่งอำนวยความสะดวก</label>
                        <hr>
                        <div class="row">
                            <?PHP
                            $sql = "SELECT * FROM tb_service";
                            $service = result_array($sql);
                            ?>

                            <?PHP foreach ($service as $_service) { ?>

                                <?PHP
                                $sql = "SELECT * FROM tb_service_option WHERE service_id = '{$_service['service_id']}' AND homestay_id = '{$row['homestay_id']}'";
                                $check_service = row_array($sql);

                                if ($check_service) {
                                    $check_option = "checked";
                                } else {
                                    $check_option = "";
                                }
                                ?>

                                <div class="col-md-3">
                                    <input type="checkbox" name="service[]" value="<?= $_service['service_id']; ?>" <?=$check_option;?>>
                                    <?= $_service['service_name']; ?>
                                </div>
                            <?PHP } ?>
                        </div>
                    </div>

                    <hr>

                    <p align="center">
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                        <a href="homestay.php" class="btn btn-warning">ย้อนกลับ</a>
                    </p>
                </form>
            </div>
        </div>
    </div>


</div>

<?PHP include "include/footer.php"; ?>

<div class="bg-map">
    <h2 class="text-center" style="font-size: 30px; color: #ffffff; font-weight: bold;">กรุณาเลือกตำแหน่งบนแผนที่</h2>
    <div id="dvMap"
         style="width: 100%; height: 350px; max-width: 800px; margin: 10px auto; border: 3px solid #ffffff;"></div>
    <p class="text-center">
        <button type="button" id="btnSuccess" class="btn btn-success">เสร็จสิ้น</button>
    </p>
</div>

<script type="text/javascript">

    $(document).ready(function () {
        $("#btnShowmap").click(function () {
            $(".bg-map").show();
        });

        $("#btnSuccess").click(function () {
            $(".bg-map").hide();
        });
    });

    CKEDITOR.replace('detail', {
        skin: 'kama',
        language: 'en',
        enterMode: 2,
        shiftEnterMode: 1,
        height: 200,

        toolbar:
            [
                //['Source'],
                //['Cut','Copy','Paste','PasteText','Preview'],
                //['Undo','Redo','-','SelectAll','RemoveFormat'],
                '/',
                ['Bold', 'Italic', 'Underline', 'Strike', '-'],
                ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', 'Blockquote'],
                ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
                //  ['Link','Unlink','Anchor'],
                ['Image', 'Flash', 'Table', 'Smiley', 'SpecialChar'],
                '/',
                ['Styles', 'Format', 'FontSize'],
                ['TextColor', 'BGColor'],
                // ['Maximize', 'ShowBlocks','-','About']
            ],
        filebrowserBrowseUrl: 'ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl: 'ckfinder/ckfinder.html?Type=Images',
        filebrowserFlashBrowseUrl: 'ckfinder/ckfinder.html?Type=Flash',
        filebrowserUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
    });
</script>

<script type="text/javascript">

    window.onload = function () {

        var default_lat = 18.8117681;
        var default_lng = 98.9136552;
        var default_position = null;

        var myLatLng;

        var mapOptions = {
            center: new google.maps.LatLng(default_lat, default_lng),
            zoom: 10,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var marker;
        var infoWindow = new google.maps.InfoWindow();
        var latlngbounds = new google.maps.LatLngBounds();
        var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
        google.maps.event.addListener(map, 'click', function (e) {
            $("input[name='lat']").val(e.latLng.lat());
            $("input[name='lng']").val(e.latLng.lng());

            myLatLng = {lat: e.latLng.lat(), lng: e.latLng.lng()};

            if (marker) {
                marker.setPosition(myLatLng);
            } else {
                marker = new google.maps.Marker({
                    position: myLatLng,
                    map: map,
                    title: 'จุดที่เลือก'
                });
            }
        });
    }


</script>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYgr4Io1KMLmr6OZ5RrsimQk7c9V7RAww&callback=initMap">
</script>


</body>
</html>