<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- General JS Scripts -->
<script src="<?php echo base_url(); ?>assets/modules/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/popper.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/tooltip.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/stisla.js"></script>

<script src="<?php echo base_url(); ?>assets/modules/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/chart.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>


<script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>

<script src="<?php echo base_url(); ?>assets/js/datatables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/buttons/js/buttons.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/buttons/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/buttons/js/buttons.colVis.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/buttons/js/buttons.foundation.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/buttons/js/buttons.jqueryui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/buttons/js/buttons.semanticui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/buttons/js/buttons.print.min.js"></script>

<script src="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/codemirror/lib/codemirror.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/codemirror/mode/javascript/javascript.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/jquery-selectric/jquery.selectric.min.js"></script>


<script src="<?php echo base_url(); ?>assets/modules/dropzonejs/min/dropzone.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/page/components-multiple-upload.js"></script>

<script src="<?php echo base_url(); ?>assets/js/page/index.js"></script>


<script>
    $(document).ready(function() {
        $('.data').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
        $('.datatable').DataTable();
    });
</script>
<script>
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>

</body>

</html>