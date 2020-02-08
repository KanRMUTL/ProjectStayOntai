<div></div>
<?PHP function sweetalert_success($head, $msg, $url)
{ ?>
    <script>
        swal({
                title: "<?=$head;?>",
                text: "<?=$msg;?>",
                type: "success"
            },
            function () {
                window.location.href = '<?=$url;?>';

            });
    </script>
<?PHP } ?>

<?PHP function sweetalert_error($head, $msg, $url)
{ ?>
    <script>
        swal({
                title: "<?=$head;?>",
                text: "<?=$msg;?>",
                type: "error"
            },
            function () {
                window.location.href = '<?=$url;?>';
            });
    </script>
<?PHP } ?>

<?PHP function sweetalert_error_b($head, $msg)
{ ?>
    <script>
        swal({
                title: "<?=$head;?>",
                text: "<?=$msg;?>",
                type: "error"
            },
            function () {
                window.history.back();
            });
    </script>
<?PHP } ?>



<?PHP function sweetalert_info($head, $msg, $url)
{ ?>
    <script>
        swal({
                title: "<?=$head;?>",
                text: "<?=$msg;?>",
                type: "info"
            },
            function () {
                window.location.href = '<?=$url;?>';

            });
    </script>
<?PHP } ?>



<?PHP function sweetalert_info_b($head, $msg)
{ ?>
    <script>
        swal({
                title: "<?=$head;?>",
                text: "<?=$msg;?>",
                type: "info"
            },
            function () {

                window.history.back();
            });
    </script>
<?PHP } ?>


<?PHP function sweetalert_success_ref($head, $msg)
{ ?>
    <script>
        swal({
                title: "<?=$head;?>",
                text: "<?=$msg;?>",
                type: "success"
            },
            function () {

                window.location.href = document.referrer;
            });
    </script>
<?PHP } ?>

<?PHP function sweetalert_error_ref($head, $msg)
{ ?>
    <script>
        swal({
                title: "<?=$head;?>",
                text: "<?=$msg;?>",
                type: "error"
            },
            function () {

                window.location.href = document.referrer;
            });
    </script>
<?PHP } ?>










