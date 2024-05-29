<?php
defined('BASEPATH') or exit('No direct script access allowed');
$website = $this->db->get('admin_website')->row_array();
?>
<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="<?php echo base_url(); ?>admin/menu"><?= $website['nama_website']; ?></a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="<?php echo base_url(); ?>admin/menu"><?= $website['nama_website_singkat']; ?></a>
    </div>
    <ul class="sidebar-menu">
      <li class="<?php echo $this->uri->segment(2) == 'dashboard' ? 'active' : ''; ?>">
        <a href="<?= base_url('administrator'); ?>" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
      </li>
      <?php
      $menu = $this->db->get('admin_menu')->result_array();
      foreach ($menu as $m) :
        $submenu = $this->db->get_where('admin_menu', array('id_parent' => $m['id']));
        if ($submenu->num_rows() > 0) :
          ?>
          <li class="dropdown <?php echo $this->uri->segment(2) == $m['link_menu'] ? 'active' : ''; ?>">
            <a href="<?= $m['link_menu'] ?>" class="nav-link has-dropdown"><i class="<?= $m['icon_menu'] ?>"></i><span><?= $m['nama_menu'] ?></span></a>
            <ul class="dropdown-menu">
              <?php
              $uri2 = $this->uri->segment(2);
              $uri3 = $this->uri->segment(3);
              $uri = $uri2 . "/" . $uri3;
              ?>
              <?php foreach ($submenu->result_array() as $sub) : ?>
                <li class="<?php echo $uri ==  $sub['link_menu'] ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('admin/') . $sub['link_menu'] ?>"><?= $sub['nama_menu'] ?></a></li>
              <?php endforeach; ?>
            </ul>
          </li>
        <?php
        else :
          if ($m['id_parent'] == 0) :
            ?>
            <li class="<?php echo $this->uri->segment(2) == $m['link_menu'] ? 'active' : ''; ?>">
              <a href="<?= base_url('admin/') . $m['link_menu'] ?>" class="nav-link"><i class="<?= $m['icon_menu'] ?>"></i><span><?= $m['nama_menu'] ?></span></a>
            </li>
          <?php endif;  ?>
        <?php endif;  ?>
      <?php endforeach;  ?>
    </ul>

    <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
      <a href="<?= base_url('administrator/logout') ?>" class="btn btn-primary btn-lg btn-block btn-icon-split">
        <i class="fas fa-rocket"></i> Logout
      </a>
    </div>
  </aside>
</div>