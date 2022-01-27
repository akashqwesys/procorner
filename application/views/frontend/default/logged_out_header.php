<section class="menu-area bg-white py-2">
  <div class="container-xl">
    <nav class="navbar navbar-expand-lg bg-white">

      <ul class="mobile-header-buttons">
        <li><a class="mobile-nav-trigger" href="#mobile-primary-nav">Menu<span></span></a></li>
        <li><a class="mobile-search-trigger" href="#mobile-search">Search<span></span></a></li>
      </ul>

      <a href="<?php echo site_url(''); ?>" class="navbar-brand" href="#"><img src="<?php echo base_url('uploads/system/'.get_frontend_settings('dark_logo')); ?>" alt="" height="35"></a>

      <?php include 'menu.php'; ?>

      <!-- <?php if ($this->session->userdata('admin_login')): ?>
        <div class="instructor-box menu-icon-box ms-auto">
          <div class="icon">
            <a href="<?php echo site_url('admin'); ?>" style="border: 1px solid transparent; margin: 0px; font-size: 14px; width: max-content; border-radius: 5px; max-height: 40px; line-height: 40px; padding: 0px 10px;"><?php echo site_phrase('administrator'); ?></a>
          </div>
        </div>
      <?php endif; ?> -->

      <div class="cart-box menu-icon-box ms-auto" id = "cart_items">
        <?php include 'cart_items.php'; ?>
      </div>

      <span class="signin-box-move-desktop-helper"></span>
      <div class="sign-in-box btn-group">

      <?php if ($this->session->userdata('user_login') == 1){ ?>
          <a href="<?php echo site_url('login/logout'); ?>" class="btn btn-sign-up"><?php echo site_phrase('log_out'); ?></a>  
      <?php }else{ ?>
        <a href="<?php echo site_url('/login'); ?>" class="btn btn-sign-up"><?php echo site_phrase('log_in'); ?></a>      
        <?php } ?>
      </div> <!--  sign-in-box end -->
    </nav>
  </div>
</section>
