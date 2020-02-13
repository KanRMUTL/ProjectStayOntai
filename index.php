<?PHP
include 'function/db_function.php';
include 'function/function.php';
?>

<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Stay Ontai</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/option_homestay.css" rel="stylesheet">
    <link href="assets/css/responsive.css" rel="stylesheet">


    <script src="assets/js/jquery-1.11.1.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>


    <link rel="stylesheet" type="text/css" href="assets/js/slider/slick.min.css">
    <script src="assets/js/slider/slick.min.js"></script>
    <script src="assets/js/fm.timetator.jquery.js"></script>

    <script src="admin/assets/js/datepicker/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="admin/assets/js/datepicker/ui.css">

    <link rel="stylesheet" href="assets/js/fancybox/source/jquery.fancybox.css"/>
    <script src="assets/js/fancybox/source/jquery.fancybox.pack.js"></script>
    <script src="assets/js/fancybox/source/helpers/jquery.fancybox-thumbs.js"></script>
    <script src="assets/js/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

    <script src="assets/js/sweetalert-master/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="assets/js/sweetalert-master/sweetalert.css">

    <style>
        div.ui-datepicker{
            font-size:13px;
        }

        .btn, input, select, textarea {
            font-family: sans-serif;
        }



        .container {
            position: relative;
        }

    </style>


    <script>
        $(document).ready(function () {

            $(".fancybox").fancybox();

            $('input.numberOnly').keyup(function (e) {
                if (/\D/g.test(this.value)) {
                    // Filter non-digits from input value.
                    this.value = this.value.replace(/\D/g, '');
                }
            });

            $("input.datepickernow").datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: 0
            });

            $("input.datepickermax").datepicker({
                dateFormat: 'yy-mm-dd',
                maxDate: 0
            });

            $("input.datepicker").datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                yearRange: "-100:+1",
            });

            $('input.timeall').timetator({
                seperator: ':',        // the seperator used to seperate hours, minutes and seconds
                useSeconds: false,     // if set to true, then seconds will also be used
                useCap:	true		   // if set to true, the time value will be capped at 23:59
            });
        });

        function confirm_custom(url, str) {
            swal({
                    title: "แจ้งเตือน",
                    text: str,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "ใช่",
                    cancelButtonText: "ยกเลิก",
                    closeOnConfirm: false
                },
                function () {
                    window.location.href = url;
                });

            return false;
        }

    </script>


</head>
<body>
<?PHP

if (isset($_GET['reset'])) {
    unset($_SESSION['homestay']);
}

if (isset($_GET['reset_service'])) {
    $_SESSION['homestay']['service'] = array();
}

if (!isset($_SESSION['homestay'])) {
    $_SESSION['homestay'] = array();

    $_SESSION['homestay']['start'] = date("Y-m-d");
    $_SESSION['homestay']['beds'] = 2;
    $_SESSION['homestay']['room'] = 1;
    $_SESSION['homestay']['total'] = 1;
    $_SESSION['homestay']['adult'] = 2;
    $_SESSION['homestay']['child'] = 0;
    $_SESSION['homestay']['type'] = "ทั้งหมด";

    $_SESSION['homestay']['booking'] = array();
    $_SESSION['homestay']['service'] = array();
}

if (empty($_GET['module'])) {
    $module = "home";
    $action = "index";
} else {
    $module = $_GET['module'];
    $action = $_GET['action'];
}
include("modules/$module/$action.php");
?>

<?PHP include 'include/footer.php'; ?>

<script>
    $(window).scroll(function () {
        var header = $('.new-header'),
            scroll = $(window).scrollTop();

        if (scroll >= 12) header.addClass('fixed');
        else header.removeClass('fixed');
    });

</script>

<script>
    $(document).ready(function () {
        $("#modalAllPage").on("show.bs.modal", function (e) {
            var link = $(e.relatedTarget);
            $(this).find(".modal-content").load(link.attr("href"));
        });

    });
</script>


<div class="modal fade" id="modalAllPage" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true" >

    <div class="modal-dialog" role="document">
        <div class="modal-content">
        </div>
    </div>
</div>

</body>
</html>