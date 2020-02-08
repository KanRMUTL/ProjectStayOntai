<div class="block-page">
    <div class="container">
        <?PHP include 'include/header.php'; ?>

        <div class="col-md-10 col-md-offset-1">
            <div class="content-all padding-inout">

                <?PHP
                extract($_GET);
                $sql = "SELECT * FROM tb_visitplace WHERE visitplace_id = '{$id}'";
                $row = row_array($sql);
                ?>

                <h1 class="title-page text-center"><?=$row['visitplace_name'];?></h1>

                <p class="text-center">
                    <small><?=$row['visitplace_date'];?></small> <br>
                    <img src="uploads/<?=$row['visitplace_picture'];?>" style="width: 100%; height: 300px;" alt="">
                </p>

                <hr>

                <?=$row['visitplace_detail'];?>

                <hr>

                <p>คลังรูปภาพ</p>

                <?PHP
                $sql = "SELECT * FROM tb_visitplacepic WHERE visitplace_id = '{$id}'";
                $list = result_array($sql);
                ?>

                <?PHP foreach ($list as $value){ ?>
                    <div class="col-md-2">
                        <div style="margin-bottom: 15px;">
                            <a href="uploads/<?=$value['visitplacepic_img'];?>" rel="group" class="fancybox">
                                <img src="uploads/<?=$value['visitplacepic_img'];?>" class="img-responsive" alt="">
                            </a>
                        </div>
                    </div>
                <?PHP } ?>

                <div class="clearfix"></div>

                <hr>

                <h2>ตำแหน่งที่ตั้ง</h2>

                <div id="dvMap" style="width: 100%; height: 350px; max-width: 900px; margin: 10px auto; border: 3px solid #ffffff;"></div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">

    window.onload = function () {

        var default_lat = "<?=$row['visitplace_latitude'];?>";
        var default_lng = "<?=$row['visitplace_longitude'];?>";

        var mapOptions = {
            center: new google.maps.LatLng(default_lat, default_lng),
            zoom: 12,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var marker;
        var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);

        marker = new google.maps.Marker({
            position: new google.maps.LatLng(default_lat, default_lng),
            map: map,
            title: 'จุดที่เลือก'
        });
    }

</script>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYgr4Io1KMLmr6OZ5RrsimQk7c9V7RAww&callback=initMap">
</script>