<footer class="footer-area d-print-none bg-gray mt-5">
  <div class="container-xl">
    <div class="row mb-3">
      
      <div class="col-6 col-sm-6 col-md-3">
        <h5 class="">Join our community</h5>
        <ul class="list-unstyled text-small">
          <li class="mb-1"><a class="link-secondary footer-hover-link" href="">LinkedIn Group</a></li>
          <li class="mb-1"><a class="link-secondary footer-hover-link" href="">Facebook Group</a></li>
          <li class="mb-1"><a class="link-secondary footer-hover-link" href="">Instagram Group</a></li>
          <li class="mb-1"><a class="link-secondary footer-hover-link" href="">WhatsApp Group</a></li>
        </ul>
      </div>
      <div class="col-6 col-sm-6 col-md-3">
        <h5 class=""><?php echo site_phrase('help'); ?></h5>
        <ul class="list-unstyled text-small">
          <li class="mb-1"><a class="link-secondary footer-hover-link" href="<?php echo site_url('home/about_us'); ?>"><?php echo site_phrase('about_us'); ?></a></li>
          <li class="mb-1"><a class="link-secondary footer-hover-link" href="<?php echo site_url('home/privacy_policy'); ?>"><?php echo site_phrase('privacy_policy'); ?></a></li>
          <li class="mb-1"><a class="link-secondary footer-hover-link" href="<?php echo site_url('home/terms_and_condition'); ?>"><?php echo site_phrase('terms_and_condition'); ?></a></li>
          <li class="mb-1"><a class="link-secondary footer-hover-link" href="<?php echo site_url('home/refund_policy'); ?>"><?php echo site_phrase('refund_policy'); ?></a></li>
        </ul>
      </div>
      
       <div class="col-6 col-sm-6 col-md-3">
        <h5 class="">Contact Us</h5>
        <ul class="list-unstyled text-small custome-ul-li">
            <li class="mb-1 phone">
              <a class="link-secondary footer-hover-link" href="tel:<?php echo get_settings('phone'); ?>">
                <?php echo get_settings('phone'); ?>
              </a>
            </li>
            <li class="mb-1 email">
              <a class="link-secondary footer-hover-link" href="mailto:<?php echo get_settings('system_email'); ?>">
                <?php echo get_settings('system_email'); ?>
              </a>
            </li>
            <li class="mb-1 address">
              <a class="link-secondary footer-hover-link" target="_blank" href="https://www.google.com/maps/place/Qwesys+Digital+Solutions+-+IT+Company/@21.1754862,72.7961925,17z/data=!3m1!4b1!4m5!3m4!1s0x3be04e7ad43a0fad:0xef7eeeee1505b0cf!8m2!3d21.1754862!4d72.7983812">
                <?php echo get_settings('address'); ?>
              </a>
            </li>
        </ul>
      </div>
      
      
      <!--<div class="col-6 col-sm-6 col-md-3">-->
      <!--  <h5 class="text-muted"><?php //echo site_phrase('top_categories'); ?></h5>-->
      <!--  <ul class="list-unstyled text-small">-->
      <!--    <?php //$top_10_categories = $this->crud_model->get_top_categories(6, 'sub_category_id'); ?>-->
      <!--    <?php //foreach($top_10_categories as $top_10_category): ?>-->
      <!--      <?php //$category_details = $this->crud_model->get_category_details_by_id($top_10_category['sub_category_id'])->row_array(); ?>-->
      <!--      <li class="mb-1">-->
      <!--        <a class="link-secondary footer-hover-link" href="<?php //echo site_url('home/courses?category='.$category_details['slug']); ?>">-->
      <!--          <?php //echo $category_details['name']; ?>-->
                <!-- <span class="fw-700 text-end">(<?php //echo $top_10_category['course_number']; ?>)</span> -->
      <!--        </a>-->
      <!--      </li>-->
      <!--    <?php //endforeach; ?>-->
      <!--  </ul>-->
      <!--</div>-->
      
      
      <div class="col-sm-12 col-md-3 order-sm-first">
        <img src="<?php echo base_url('uploads/system/'.get_frontend_settings('dark_logo')); ?>" width="130">
        <small class="d-block mb-3 fw-600 text-muted">Procorner Eduflex Private Limited believes in providing the best learning to level up the next wave of entrepreneurs. Since 2016, our goal has been to help individuals reach their highest potential.</small>
        <ul class="footer-social-link">
          <?php //$facebook = get_frontend_settings('facebook'); ?>
          <?php //$twitter = get_frontend_settings('twitter'); ?>
          <?php //$linkedin = get_frontend_settings('linkedin'); ?>
          <?php //if($facebook): ?>
            <li class="mb-1">
              <a href="#"><i class="fab fa-facebook-f"></i></a>
            </li>
          <?php //endif; ?>
          <?php //if($twitter): ?>
            <li class="mb-1">
              <a href="#"><i class="fab fa-instagram"></i></a>
            </li>
          <?php //endif; ?>
          <?php //if($linkedin): ?>
            <li class="mb-1">
              <a href="#"><i class="fab fa-linkedin"></i></a>
            </li>
          <?php //endif; ?>

          <li class="mb-1">
              <a href="#"><i class="fab fa-youtube"></i></a>
            </li>
        </ul>
      </div>
    </div>
  </div>
  <section class="border-top p-0">
    <div class="container-xl">
      <div class="row mt-3 py-1">
        <div class="col-12 text-muted text-13px text-center">
          &copy; 2021 <?php echo get_settings('system_name'); ?>, <?php echo site_phrase('all_rights_reserved'); ?>
        </div>              
      </div>
    </div>
  </section>
</footer>

<script type="text/javascript">
    function switch_language(language) {
        $.ajax({
            url: '<?php echo site_url('home/site_language'); ?>',
            type: 'post',
            data: {language : language},
            success: function(response) {
                setTimeout(function(){ location.reload(); }, 500);
            }
        });
    }
</script>



<!-- PAYMENT MODAL -->
<!-- Modal -->
<?php
$paypal_info = json_decode(get_settings('paypal'), true);
$stripe_info = json_decode(get_settings('stripe_keys'), true);
if ($paypal_info[0]['active'] == 0) {
  $paypal_status = 'disabled';
}else {
  $paypal_status = '';
}
if ($stripe_info[0]['active'] == 0) {
  $stripe_status = 'disabled';
}else {
  $stripe_status = '';
}
?>

<!-- Modal -->
<div class="modal fade multi-step" id="EditRatingModal" tabindex="-1" role="dialog" aria-hidden="true" reset-on-close="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content edit-rating-modal">
      <div class="modal-header">
        <h5 class="modal-title step-1" data-step="1"><?php echo site_phrase('step').' 1'; ?></h5>
        <h5 class="modal-title step-2" data-step="2"><?php echo site_phrase('step').' 2'; ?></h5>
        <h5 class="m-progress-stats modal-title">
          &nbsp;of&nbsp;<span class="m-progress-total"></span>
        </h5>

        <button type="button" class="close" data-bs-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="m-progress-bar-wrapper">
        <div class="m-progress-bar">
        </div>
      </div>
      <div class="modal-body step step-1">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              <div class="modal-rating-box">
                <h4 class="rating-title"><?php echo site_phrase('how_would_you_rate_this_course_overall'); ?>?</h4>
                <fieldset class="your-rating">

                  <input type="radio" id="star5" name="rating" value="5" />
                  <label class = "full" for="star5"></label>

                  <!-- <input type="radio" id="star4half" name="rating" value="4 and a half" />
                  <label class="half" for="star4half"></label> -->

                  <input type="radio" id="star4" name="rating" value="4" />
                  <label class = "full" for="star4"></label>

                  <!-- <input type="radio" id="star3half" name="rating" value="3 and a half" />
                  <label class="half" for="star3half"></label> -->

                  <input type="radio" id="star3" name="rating" value="3" />
                  <label class = "full" for="star3"></label>

                  <!-- <input type="radio" id="star2half" name="rating" value="2 and a half" />
                  <label class="half" for="star2half"></label> -->

                  <input type="radio" id="star2" name="rating" value="2" />
                  <label class = "full" for="star2"></label>

                  <!-- <input type="radio" id="star1half" name="rating" value="1 and a half" />
                  <label class="half" for="star1half"></label> -->

                  <input type="radio" id="star1" name="rating" value="1" />
                  <label class = "full" for="star1"></label>

                  <!-- <input type="radio" id="starhalf" name="rating" value="half" />
                  <label class="half" for="starhalf"></label> -->

                </fieldset>
              </div>
            </div>
            <div class="col-md-6">
              <div class="modal-course-preview-box">
                <div class="card">
                  <img class="card-img-top img-fluid" id = "course_thumbnail_1" alt="">
                  <div class="card-body">
                    <h5 class="card-title" class = "course_title_for_rating" id = "course_title_1"></h5>
                    <p class="card-text" id = "instructor_details">

                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="modal-body step step-2">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              <div class="modal-rating-comment-box">
                <h4 class="rating-title"><?php echo site_phrase('write_a_public_review'); ?></h4>
                <textarea id = "review_of_a_course" name = "review_of_a_course" placeholder="<?php echo site_phrase('describe_your_experience_what_you_got_out_of_the_course_and_other_helpful_highlights').'. '.site_phrase('what_did_the_instructor_do_well_and_what_could_use_some_improvement') ?>?" maxlength="65000" class="form-control"></textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="modal-course-preview-box">
                <div class="card">
                  <img class="card-img-top img-fluid" id = "course_thumbnail_2" alt="">
                  <div class="card-body">
                    <h5 class="card-title" class = "course_title_for_rating" id = "course_title_2"></h5>
                    <p class="card-text">
                      -
                      <?php
                      $admin_details = $this->user_model->get_admin_details()->row_array();
                      echo $admin_details['first_name'].' '.$admin_details['last_name'];
                      ?>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <input type="hidden" name="course_id" id = "course_id_for_rating" value="">
      <div class="modal-footer">
        <button type="button" class="btn btn-primary next step step-1" data-step="1" onclick="sendEvent(2)"><?php echo site_phrase('next'); ?></button>
        <button type="button" class="btn btn-primary previous step step-2 mr-auto" data-step="2" onclick="sendEvent(1)"><?php echo site_phrase('previous'); ?></button>
        <button type="button" class="btn btn-primary publish step step-2" onclick="publishRating($('#course_id_for_rating').val())" id = ""><?php echo site_phrase('publish'); ?></button>
      </div>
    </div>
  </div>
</div><!-- Modal -->


