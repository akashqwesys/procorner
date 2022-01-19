<section class="page-header-area my-course-area">

<div class="container-fluid p-0 position-relative" style="background-image: url('https://demo.creativeitem.com/academy/assets/frontend/default/img/my_courses.jpg'); background-position: center;
    background-size: cover;">
    <div class="image-placeholder-2"></div>
    <div class="container" style="position: inherit;">
      <h1 class="page-title py-5 text-white print-hidden"><?php echo $page_title; ?></h1>
    </div>
  </div>

  <div class="container">
        <!-- <div class="row"> -->
            <!-- <div class="col"> -->
                <!-- <h1 class="print-hidden"><?php echo $page_title; ?></h1> -->
                <ul class="print-hidden">
                  <li class="<?php if($page_name == 'my_courses') echo 'active'; ?>">
                  <a href="<?php echo site_url('home/my_courses'); ?>"><?php echo site_phrase('courses'); ?></a>
                </li>

                  <?php if(addon_status('course_bundle')): ?>
                    <li class="<?php if($page_name == 'my_bundles' || $page_name == 'bundle_invoice') echo 'active'; ?>"><a href="<?php echo site_url('home/my_bundles'); ?>"><?php echo site_phrase('bundles'); ?></a></li>
                  <?php endif; ?>

                  <li class="<?php if($page_name == 'my_wishlist') echo 'active'; ?>"><a href="<?php echo site_url('home/my_wishlist'); ?>"><?php echo site_phrase('wishlists'); ?></a></li>

                  <li class="<?php if($page_name == 'my_messages') echo 'active'; ?>"><a href="<?php echo site_url('home/my_messages'); ?>"><?php echo site_phrase('messages'); ?></a></li>

                  <li class="<?php if($page_name == 'purchase_history' || $page_name == 'invoice') echo 'active'; ?>"><a href="<?php echo site_url('home/purchase_history'); ?>"><?php echo site_phrase('purchase_history'); ?></a></li>

                  <li class="<?php if($page_name == 'user_profile') echo 'active'; ?>"><a href="<?php echo site_url('home/profile/user_profile'); ?>"><?php echo site_phrase('profile'); ?></a></li>
                </ul>
            </div>
        <!-- </div> -->
    <!-- </div> -->
</section>