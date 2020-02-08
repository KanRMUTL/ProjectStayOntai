<?PHP
include '../function/db_function.php';
include '../function/function.php';
check_login('id', 'login.php');
?>


<meta charset="utf-8">
<title>Stay Ontai</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/css/custom.css"/>

<link href="assets/css/main.css" rel="stylesheet">

<script type="text/javascript" src="assets/js/jquery.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<link href="../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">

<script src="assets/js/datepicker/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="assets/js/datepicker/ui.css">


<link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet"/>
<script src="assets/js/dataTables/jquery.dataTables.js"></script>
<script src="assets/js/dataTables/dataTables.bootstrap.js"></script>


<link rel="stylesheet"  href="../assets/js/fancybox/source/jquery.fancybox.css"/>
<script src="../assets/js/fancybox/source/jquery.fancybox.pack.js"></script>
<script src="../assets/js/fancybox/source/helpers/jquery.fancybox-thumbs.js"></script>
<script src="../assets/js/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

<script src="../assets/js/sweetalert-master/sweetalert-dev.js"></script>
<link rel="stylesheet" href="../assets/js/sweetalert-master/sweetalert.css">

<script src="../assets/ckeditor/ckeditor.js"></script>

<style>
    div.ui-datepicker{
        font-size:13px;
    }

    body {
        background: #109b83;
        font-size: 22px;
    }

    input ,textarea {
        font-size: 20px !important;
    }

    .navbar-inverse {
        background-color: #109b83;
    }

    .dash-unit {
        background-color: #8ff4ba;
        border: 1px solid #15d166;
    }

    .dash-unit:hover {
        background-color: #8ff4ba;
    }

    .list_menu img {
        background: #b9f8d5;
    }

    .user {
        background: #f9f9f9;
        border: 1px solid #095d2d;
    }

    .profile_view {
        height: 315px;
        background: #8ff4ba;
        border: 1px solid #095d2d;
    }

    #footerwrap {
        background: #109b83;
        border-top-color: #095d2d;
    }

    .well {
        overflow: hidden;
        padding: 10px;
    }

    button , .btn {
        font-family: sans-serif;
    }

    .hover_all {
        cursor: pointer;
    }

    .hover_all:hover {
        opacity: 0.5;
    }

    .tb_all{
        padding: 10px 25px;
    }

    table tr th , table tr td {
        text-align: center;
    }

    .form_all{
        text-align: left;
        padding: 30px 100px;

    }

    .tb-middle {
        vertical-align: middle !important;
    }
</style>


<script>
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


