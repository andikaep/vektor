<?php
defined('BASEPATH') or exit('No direct script access allowed');
$website = $this->db->get('admin_website')->row_array();
?>
<footer class="main-footer">
    <div class="footer-left">
        Copyright &copy; <?= $website['footer_website']; ?> <div class="bullet"></div> Design By <a href="https://hi-digital.web.id/">Mop Technology Industry</a>
    </div>
    <div class="footer-right">

    </div>
</footer>
</div>
</div>

<?php $this->load->view('templates/js'); ?>