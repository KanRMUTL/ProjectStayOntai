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
        var screenOfDevice = screen.width
        if(screenOfDevice >= 576 ) {
            $('#table-js').dataTable();
        } else {
            $('#table-mobile').dataTable({
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true,
                drawCallback: function() {
                    $('table').css('width', '100%');
                    $('#table-mobile_length label').addClass('d-flex')
                    $('#table-mobile_filter label').addClass('d-flex justify-content-start')
                    $('#table-mobile_filter label input').addClass('ml-5')
                    $(`#table-mobile_length label select`).addClass('custom-select ml-1 mr-1')
                    $('.tb_all').attr('style', 'padding: 10px 15px;')
                    $('div.dataTables_filter input').attr('style', 'width: auto')
                }
            });

        }

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
