<div id="footerwrap">
    <footer class="clearfix"></footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <p></p>
            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        $('#table-js').dataTable();

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

        $("input.datepicker").datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+1",
        });
    });

</script>



