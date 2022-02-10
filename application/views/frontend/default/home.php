<section class="bg-white p-0">
    <div class="container-md">
        <div class="row align-items-center">
            <div class="col-md-6 banner-title">
                <h2 class="fw-bold"><span>India’s</span> coming-of-age platform for <span>all</span> your <span>learning needs.</span></h2>
                <p>The perfect place to hone your skills and turn them into forces that will guide you in your career journey. All it takes is a single step to turn your dreams into reality. Join us today to give your career the much-needed boost it deserves.</p>
                <!-- <form class="" action="<?php echo site_url('home/search'); ?>" method="get">
                    <div class="input-group ">
                        <input type="text" class="form-control" name="query" placeholder="<?php echo site_phrase('what_do_you_want_to_learn'); ?>?" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <span class="input-group-text btn" id="basic-addon2" type="submit"><?php echo site_phrase('search'); ?></span>
                        </div>
                    </div>
                </form> -->
            </div>
            <div class="col-md-6">
                <img src="assets/frontend/default/img/tutor.png" width="80%">
            </div>
        </div>
    </div>
</section>

<section class="course-carousel-area">
    <div class="container-lg ">
        <div class="row">
            <div class="col text-center">
                <h3 class="course-carousel-title mb-2 text-center">Quick Feature</h3>
                <span class="d-block text-color-dark text-5 pb-2 mb-1 opacity-7">What makes our courses so unique and why should you invest in them?</span>
            </div>
        </div>
        <div class="content-grid">
            <div class="row content-grid-row text-center">
                <div class="col-md-4 col col-12 col-lg-4 content-grid-item flex-column p-5 pb-0">
                    <img src="assets/frontend/default/img/study.png" class="img-fluid mb-2" alt="">
                    <h5 class="mb-1"><b>5 Online courses</b></h5>
                    <p class="mb-0">Courses on trending, impactful topics</p>
                </div>
                <div class="col-md-4 col col-12 col-lg-4 content-grid-item flex-column p-5 pb-0">
                    <img src="assets/frontend/default/img/qa.png" class="img-fluid mb-2" alt="">
                    <h5 class="mb-1"><b>Expert instruction</b></h5>
                    <p class="mb-0">A Step-by-step help guide</p>
                </div>
                <div class="col-md-4 col col-12 col-lg-4 content-grid-item flex-column p-5 pb-0">
                    <img src="assets/frontend/default/img/access.png" class="img-fluid mb-2" alt="">
                    <h5 class="mb-1"><b>Lifetime access</b></h5>
                    <p class="mb-0">Learn whenever you want to</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="course-carousel-area bg-white">
    <div class="container-lg ">
        <div class="row">
            <div class="col text-center">
                <h3 class="course-carousel-title mb-2 text-center">Explore top courses</h3>
                <span class="d-block text-color-dark text-5 pb-2 mb-1 opacity-7">Invest in our courses. Invest in yourself. Select the best one for you, today!</span>
            </div>
        </div>
        <div class="row mt-5">
            <!-- page loader -->
            <div class="animated-loader">
                <div class="spinner-border text-secondary" role="status"></div>
            </div>

            <!-- <div class="course-carousel shown-after-loading" style="display: none;"> -->
            <?php $top_courses = $this->crud_model->get_top_courses()->result_array();
            $cart_items = $this->session->userdata('cart_items');
            foreach ($top_courses as $top_course) : ?>
                <?php
                $lessons = $this->crud_model->get_lessons('course', $top_course['id']);
                $course_duration = $this->crud_model->get_total_duration_of_lesson_by_course_id($top_course['id']);
                ?>
                <div class="col-md-4 col col-12 boxshadow-course mb-5">
                    <a onclick="return check_action(this);" href="<?php echo site_url(rawurlencode(slugify($top_course['title']))); ?>">
                        <div class="course-box">
                            <div class="course-image">
                                <img src="<?php echo $this->crud_model->get_course_thumbnail_url($top_course['id']); ?>" alt="" class="img-fluid">
                            </div>
                            <div class="course-details">
                                <h5 class="title"><?php echo $top_course['title']; ?></h5>
                                <div class="rating">
                                    <?php
                                    $total_rating =  $this->crud_model->get_ratings('course', $top_course['id'], true)->row()->rating;
                                    $number_of_ratings = $this->crud_model->get_ratings('course', $top_course['id'])->num_rows();
                                    if ($number_of_ratings > 0) {
                                        $average_ceil_rating = ceil($total_rating / $number_of_ratings);
                                    } else {
                                        $average_ceil_rating = 0;
                                    }

                                    for ($i = 1; $i < 6; $i++) : ?>
                                        <?php if ($i <= $average_ceil_rating) : ?>
                                            <i class="fas fa-star filled"></i>
                                        <?php else : ?>
                                            <i class="fas fa-star"></i>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                    <div class="d-inline-block">
                                        <span class="text-dark ms-1 text-15px">(<?php echo $average_ceil_rating; ?>)</span>
                                        <span class="text-dark text-12px text-muted ms-2">(<?php echo $number_of_ratings . ' ' . site_phrase('reviews'); ?>)</span>
                                    </div>
                                </div>
                                <div class="d-flex text-dark">
                                    <div class="">
                                        <i class="far fa-clock text-14px"></i>
                                        <span class="text-muted text-12px"><?php echo $course_duration; ?></span>
                                    </div>
                                    <div class="ms-3">
                                        <i class="far fa-list-alt text-14px"></i>
                                        <span class="text-muted text-12px"><?php echo $lessons->num_rows() . ' ' . site_phrase('lectures'); ?></span>
                                    </div>
                                </div>

                                <!-- <div class="row mt-3">
                                    <div class="col-6">
                                        <span class="badge badge-sub-warning text-11px"><?php echo site_phrase($top_course['level']); ?></span>
                                    </div>
                                     <div class="col-6 text-end">
                                        <button class="brn-compare-sm" onclick="return check_action(this, '<?php echo site_url('home/compare?course-1=' . rawurlencode(slugify($top_course['title'])) . '&&course-id-1=' . $top_course['id']); ?>');"><i class="fas fa-balance-scale"></i> <?php echo site_phrase('compare'); ?></button>
                                    </div> 
                                </div> -->

                                <hr class="divider-1">

                                <div class="d-block">
                                    <div class="floating-user d-inline-block">
                                        <?php //if ($top_course['multi_instructor']) :
                                           // $instructor_details = $this->user_model->get_multi_instructor_details_with_csv($top_course['user_id']);
                                           // $margin = 0;
                                           // foreach ($instructor_details as $key => $instructor_detail) { ?>
                                                <!-- <img style="margin-left: <?php echo $margin; ?>px;" class="position-absolute" src="<?php echo $this->user_model->get_user_image_url($instructor_detail['id']); ?>" width="30px" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $instructor_detail['first_name'] . ' ' . $instructor_detail['last_name']; ?>" onclick="return check_action(this,'<?php echo site_url('home/instructor_page/' . $instructor_detail['id']); ?>');"> -->
                                                <?php //$margin = $margin + 17; ?>
                                            <?php //} ?>
                                        <?php // else : ?>
                                            <?php //$user_details = $this->user_model->get_all_user($top_course['user_id'])->row_array(); ?>
                                            <!-- <img src="<?php echo $this->user_model->get_user_image_url($user_details['id']); ?>" width="30px" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $user_details['first_name'] . ' ' . $user_details['last_name']; ?>" onclick="return check_action(this,'<?php echo site_url('home/instructor_page/' . $user_details['id']); ?>');"> -->
                                        <?php //endif; ?>

                                        <span class="badge badge-sub-warning text-11px"><?php echo site_phrase($top_course['level']); ?></span>
                                    </div>



                                    <?php if ($top_course['is_free_course'] == 1) : ?>
                                        <p class="price text-right d-inline-block float-end"><?php echo site_phrase('free'); ?></p>
                                    <?php else : ?>
                                        <?php if ($top_course['discount_flag'] == 1) : ?>
                                            <p class="price text-right d-inline-block float-end"><small><?php echo currency($top_course['price']); ?></small><?php echo currency($top_course['discounted_price']); ?></p>
                                        <?php else : ?>
                                            <p class="price text-right d-inline-block float-end"><?php echo currency($top_course['price']); ?></p>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
            <!-- </div> -->

        </div>
    </div>
</section>

<section class="course-carousel-area">
    <div class="container-lg">
        <div class="row">
            <div class="col text-center">
                <h3 class="course-carousel-title mb-2 text-center">Inside the courses you’ll get</h3>
                <span class="d-block text-color-dark text-5 pb-2 mb-1 opacity-7">All the amazing perks that we offer so that you are satisfied with the course materials!</span>
            </div>
        </div>
        <div class="content-grid">
            <div class="row content-grid-row">
                <div class="col-md-6 content-grid-item flex-column p-5">
                    <img src="assets/frontend/default/img/Pro-level-Hindi-Content.png" class="img-fluid mb-2" alt="">
                </div>
                <div class="col-md-6 content-grid-item flex-column p-5">
                    <h4 class="mb-3"><b>Pro-level Hindi Content</b></h4>
                    <p class="mb-3">Want to learn in your regional language? You can do that with us along with some features</p>
                    <ul class="check-list">
                        <li class="">Crisp understanding of difficult concepts.</li>
                        <li class="">A detailed breakdown of topics.</li>
                        <li class="">Content in video format.</li>
                        <li class="">Actionable steps and strategies.</li>
                        <li class="">Network and connect with like-minded learners.</li>
                        <li class="">Pre-recorded content will be provided.</li>
                        <li class="">Watch at your own pace, anytime, anywhere.</li>
                    </ul>
                </div>
            </div>
            <div class="row content-grid-row">
                <div class="col-md-6 content-grid-item flex-column p-5">
                    <h4 class="mb-3"><b>Queries tab</b></h4>
                    <p class="mb-3">Satisfy all the lingering questions that arise due to your curiosity while you are learning something new</p>
                    <ul class="check-list">
                        <li class="">Don’t take your doubts to the next step of your professional ladder.</li>
                        <li class="">Clear your doubts with our top educators.</li>
                        <li class="">Use our Doubts Tab for your queries.</li>
                        <li>Drop your questions at any time of the day.</li>
                        <li>Clear your doubts and satisfy your curiosity.</li>
                        <li>Grow with us as you tweak your mistakes.</li>
                        <li>Ask your doubts in our community group as well.</li>
                    </ul>
                </div>
                <div class="col-md-6 content-grid-item flex-column p-5">
                    <img src="assets/frontend/default/img/Queries-tab.png" class="img-fluid mb-2" alt="">
                </div>
            </div>
            <div class="row content-grid-row">
                <div class="col-md-6 content-grid-item flex-column p-5 pb-0">
                    <img src="assets/frontend/default/img/Lifetime-subscription.png" class="img-fluid mb-2" alt="">
                </div>
                <div class="col-md-6 content-grid-item flex-column p-5 pb-0">
                    <h4 class="mb-3"><b>Lifetime subscription.</b></h4>
                    <p class="mb-3">Get this super-feature too along with the purchase of our courses! Check them below</p>
                    <ul class="check-list">
                        <li class="">Get unlimited access to your purchased courses.</li>
                        <li class="">Zero extra fees for any future additions to the course.</li>
                        <li class="">Revise by going through the courses multiple times.</li>
                        <li>Get lifetime access to the community group as well.</li>
                        <li>Any upgrades that are made will be provided for free.</li>
                        <li>Learn and prosper at your pace.</li>
                        <li>Rewatch topics for better retention of knowledge.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
</section>

<section class="category-course-list-area bg-white">
    <div class="container">       
        <div class="row">
        <div class="row">
            <div class="col text-center">
                <h3 class="course-carousel-title mb-2 text-center">Our Bundles</h3>
                <span class="d-block text-color-dark text-5 pb-2 mb-1 opacity-7">...</span>
            </div>
        </div>
            <div class="col-md-12">
                <div class="category-course-list">

                    <div class="row justify-content-center">
                        <?php foreach($course_bundles->result_array() as $bundle):
                            $instructor_details = $this->user_model->get_all_user($bundle['user_id'])->row_array();
                            $course_ids = json_decode($bundle['course_ids']);
                            sort($course_ids);
                        ?>
                        <div class="col-md-8 col-lg-6 col-xl-4 mb-3">
                            <div class="course-box-wrap">
                                <div class="course-box">
                                    <div class="course">
                                        <!--Bundle images-->
                                    </div>
                                    <a href="<?= site_url('bundle_details/'.$bundle['id'].'/'.slugify($bundle['title'])); ?>">
                                        <div class="card-header course-bundle-header pt-3">
                                            <p><?= $bundle['title']; ?></p>
                                            <small><?= count($course_ids).' '.site_phrase('courses'); ?></small>
                                        </div>
                                    </a>
                                    <div class="card-body">
                                        <div class="row course_bundle_box">
                                            <!--total price corses on this bundle-->
                                            <?php $total_courses_price = 0; ?>
                                            <?php foreach($course_ids as $key => $course_id):
                                                ++$key;
                                                $this->db->where('id', $course_id);
                                                $this->db->where('status', 'active');
                                                $course_details = $this->db->get('course')->row_array();

                                                if ($course_details['is_free_course'] != 1):
                                                    if ($course_details['discount_flag'] != 1): ?>
                                                        <?php $total_courses_price += $course_details['price'];
                                                    else:
                                                        $total_courses_price += $course_details['discounted_price'];
                                                    endif;
                                                endif;
                                                if($key <= 3): ?>
                                                    <div class="col-md-12 mb-2">
                                                        <div class="accordion" id="<?= 'example_'.$bundle['id'].$course_details['id']; ?>">
                                                            <a href="<?php echo site_url('home/course/'.rawurlencode(slugify($course_details['title'])).'/'.$course_details['id']); ?>" target="_blank">
                                                                <div class="card">
                                                                    <div class="card-header collapsed p-0" type="button" data-toggle="collapse" data-target="#<?= 'course_'.$bundle['id'].$course_details['id']; ?>" aria-expanded="false" aria-controls="<?= 'course_'.$bundle['id'].$course_details['id']; ?>">
                                                                        <img src="<?php echo $this->crud_model->get_course_thumbnail_url($course_details['id']); ?>" alt="" class="img-fluid float-left min-height-50" width="60px;">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <p class="text-muted m-0 cursor-pointer text-12">
                                                                                    <?= $course_details['title']; ?>

                                                                                    <?php if ($course_details['is_free_course'] == 1): ?>
                                                                                        <b><span class="float-right d-block"><?php echo site_phrase('free'); ?></span></b>
                                                                                    <?php else: ?>
                                                                                        <?php if ($course_details['discount_flag'] != 1): ?>
                                                                                            <b><span class="float-right d-block"><?php echo currency($course_details['price']); ?></span></b>
                                                                                        <?php else: ?>
                                                                                            <b><span class="float-right d-block"><?php echo currency($course_details['discounted_price']); ?></span></b>
                                                                                        <?php endif; ?>
                                                                                    <?php endif; ?>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="row bundle-arrow-down text-center box-shadow-0 cursor-pointer" id="bundle_arrow_down_<?= $bundle['id']; ?>" onclick="toggleBundleCourses('<?= $bundle['id']; ?>', '<?= count($course_ids); ?>')">
                                            <div class="col-12 p-1"><i class="fas fa-angle-down"></i></div>
                                        </div>
                                        <div class="row bundle-slider closed" id="gif_loader_<?= $bundle['id']; ?>"></div>

                                        <!--Here is load more bundle-->
                                        <div class="row bundle-slider closed" id="course_of_bundle_<?= $bundle['id']; ?>"></div>
                                        <hr class="mt-1">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="w-50 float-left text-left text-muted text-12">
                                                    <?php //Bundle Rating
                                                        $ratings = $this->course_bundle_model->get_bundle_wise_ratings($bundle['id']);
                                                        $bundle_total_rating = $this->course_bundle_model->sum_of_bundle_rating($bundle['id']);
                                                        if ($ratings->num_rows() > 0) {
                                                            $bundle_average_ceil_rating = ceil($bundle_total_rating / $ratings->num_rows());
                                                        }else {
                                                            $bundle_average_ceil_rating = 0;
                                                        }
                                                    ?>
                                                    <div class="rating-row">
                                                        <?php for($i = 1; $i <= 5; $i++):?>
                                                            <?php if ($i <= $bundle_average_ceil_rating): ?>
                                                                <i class="fas fa-star filled text-warning"></i>
                                                            <?php else: ?>
                                                                <i class="fas fa-star text-ccc"></i>
                                                            <?php endif; ?>
                                                        <?php endfor; ?>
                                                        <br>
                                                        <span class="enrolled-num">
                                                            (<?php echo $ratings->num_rows().' '.site_phrase('students'); ?>)
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="w-50 float-right text-right text-muted">
                                                    <strike class="text-12"><?= currency($total_courses_price); ?></strike>
                                                    <?= currency($bundle['price']); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <div class="col-md-12 text-center">
                            <?php if($course_bundles->num_rows() <= 0):
                                echo site_phrase('no_result_found').' !';
                            endif; ?>
                        </div>
                    </div>
                </div>
                <nav>
                    <?= $this->pagination->create_links(); ?>
                </nav>
            </div>
        </div>
    </div>
</section>
<?php include "course_bundle_scripts.php"; ?>
<hr style="color: #f1f7f8;">

<section class="course-carousel-area bg-white">
    <div class="container-lg">
        <div class="row">
            <div class="col-md-12 d-flex">                
                <div class="text-box">
                    <h3>45 DAYS MONEY-BACK<br>GUARANTEE</h3>
                    <p>
                    45 days money-back guarantee
After purchasing the course if you don’t get the desired results, our team will personally help you. If still, you are unhappy with the course in any way, you can cancel anytime within 45 days of purchase and a full refund will be made.
<br><a href="#" class="color-blue">Further details here.</a>

                    </p>
                </div>
                <img src="assets/frontend/default/img/Money-Back-Guarantee.png" width="50%">
            </div>
        </div>
        <div class="row text-center mt-5">
            <div class="col">
            <div class="counter boxshadow-counter">
                <i class="fa fa-door-open fa-3x"></i>
                <p class="count-text ">Inception in</p>
                <h5 class="mb-3"><b>2016</b></h5>        
            </div>
            </div>
            <div class="col">
            <div class="counter boxshadow-counter">
                <i class="fa fa-history fa-3x"></i>
                <p class="count-text ">Experience</p>
                <h5 class="mb-3"><b>12+ Years</b></h5>        
            </div>
            </div>
            <div class="col">
            <div class="counter boxshadow-counter">
            <i class="fa fa-chalkboard-teacher fa-3x"></i>  
                <p class="count-text ">Learning</p>
                <h5 class="mb-3"><b>40+ Hours</b></h5>        
            </div>
            </div>
            <div class="col">
            <div class="counter boxshadow-counter">
                <i class="fa fa-smile fa-3x"></i>
                <p class="count-text ">Course satisfaction</p>
                <h5 class="mb-3"><b>100%</b></h5>        
            </div>
            </div>
        </div>
    </div>
</section>
<!-- <section class="course-carousel-area bg-white counter-section">
    <div class="container-lg">
        <div class="row text-center mb-5 mt-5">
            <div class="col">
            <div class="counter boxshadow-counter">
                <i class="fa fa-door-open fa-3x"></i>
                <p class="count-text ">Inception in</p>
                <h5 class="mb-3"><b>2016</b></h5>        
            </div>
            </div>
            <div class="col">
            <div class="counter boxshadow-counter">
                <i class="fa fa-history fa-3x"></i>
                <p class="count-text ">Experience</p>
                <h5 class="mb-3"><b>12+ Years</b></h5>        
            </div>
            </div>
            <div class="col">
            <div class="counter boxshadow-counter">
            <i class="fa fa-chalkboard-teacher fa-3x"></i>  
                <p class="count-text ">Learning</p>
                <h5 class="mb-3"><b>40+ Hours</b></h5>        
            </div>
            </div>
            <div class="col">
            <div class="counter boxshadow-counter">
                <i class="fa fa-smile fa-3x"></i>
                <p class="count-text ">Course satisfaction</p>
                <h5 class="mb-3"><b>100%</b></h5>        
            </div>
            </div>
        </div>
</div>
</section> -->
<section class="course-carousel-area">
    <div class="container-lg ">
        <div class="row mb-5">
            <div class="col text-center">
                <h3 class="course-carousel-title mb-2 text-center">Resourses</h3>
                <span class="d-block text-color-dark text-5 pb-2 mb-1 opacity-7">We have resources for everyone. Whether, you are a working professional, student, or a business. We have something specific for emerging women too</span>
            </div>
        </div>
        <div class="row content-grid-row">
            <div class="col-md-3 flex-column p-4 bg-white m-2 boxshadow-resourse">
                <img src="assets/frontend/default/img/idea.png" class="img-fluid mb-2" alt="" width="75">
                <h5 class="mb-3"><b>For learners</b></h5>
                <p class="mb-3">Skyrocket your career with your sharp skillset. Or learn for expanding your wit.</p>
                <a href="#" class="color-blue"><b>See more <i class="fa fa-arrow-right"></i></b></a>
            </div>
            <div class="col-md-1 flex-column p-5">&nbsp;
            </div>
            <div class="col-md-3 flex-column p-4 bg-white m-2 boxshadow-resourse">
                <img src="assets/frontend/default/img/businessman.png" class="img-fluid mb-2" alt="" width="75">
                <h5 class="mb-3"><b>For businesses</b></h5>
                <p class="mb-3">Incorporate a growth mindset in your employees through our stackable courses.</p>
                <a href="#" class="color-blue"><b>See more <i class="fa fa-arrow-right"></i></b></a>
            </div>
            <div class="col-md-1 flex-column p-5">&nbsp;
            </div>
            <div class="col-md-3 flex-column p-4 bg-white m-2 boxshadow-resourse">
                <img src="assets/frontend/default/img/cap.png" class="img-fluid mb-2" alt="" width="75">
                <h5 class="mb-3"><b>For emerging women</b></h5>
                <p class="mb-3">We help women in achieving their dreams by providing certified courses that will empower them.</p>
                <a href="#" class="color-blue"><b>See more <i class="fa fa-arrow-right"></i></b></a>
            </div>
        </div>

    </div>
</section>

<section class="course-carousel-area bg-white">
    <div class="container-lg ">
        <div class="content-grid">
            <div class="row content-grid-row mb-5">
                <div class="col-md-6 content-grid-item flex-column">
                    <img src="assets/frontend/default/img/Download-our-app.png" class="img-fluid mb-2" alt="">
                </div>
                <div class="col-md-6 content-grid-item flex-column">
                    <h4 class="mb-2"><b>Download our app</b></h4>
                    <p class="mb-3">Procorner Eduflex just got a NEW app! We have created this app with some great features. Download the app to see it for yourself!</p>
                    <ul class="mb-4 check-list" >
                        <li class="">Get productive in your free time.</li>
                        <li class="">Bite-sized knowledge to make you smarter.</li>
                        <li class="">Join our community of avid learners.</li>
                        <li class="">Stay up-to-date with our new courses.</li>
                        <li>Get better with each passing day.</li>
                        <li>Network and connect with like-minded individuals.</li>
                    </ul>
                    <a href="" class="btn btn-primary bt-lg">Download App</a>
                </div>
            </div>

            <div class="row">
                <div class="col text-center">
                    <h3 class="course-carousel-title mb-2 text-center">Learners across 160+ countries</h3>
                    <span class="d-block text-color-dark text-5 pb-2 mb-1 opacity-7">We have a global footprint of 160+ countries. Our students learn from the comfort of their homes and develop incredible skills.</span>
                    <img src="assets/frontend/default/img/globalpresence-map.jpg" class="img-fluid mb-2" alt="">
                </div>
                <div class="row content-grid-row">
                    <div class="col-md-3 flex-column p-2 bg-white m-2 boxshadow-resourse">
                        <img src="assets/frontend/default/img/course-report.png" class="img-fluid" width="10%" alt="" style="display:inline-block">
                        <h5 style="display:inline-block" style="display:inline-block"><b>CourseReport.com</b></h5>
                        <span class="badge badge-sub-primary text-11px mt-1">4.8 <i class="fa fa-star" style="color:#fac43f"></i></span>
                    </div>
                    <div class="col-md-1 flex-column">&nbsp;
                    </div>
                    <div class="col-md-3 flex-column p-2 bg-white m-2 boxshadow-resourse">
                        <img src="assets/frontend/default/img/course-report.png" class="img-fluid" width="10%" alt="" style="display:inline-block">
                        <h5 style="display:inline-block" style="display:inline-block"><b>Google.com</b></h5>
                     <span class="badge badge-sub-primary text-11px mt-1">4.8 <i class="fa fa-star" style="color:#fac43f"></i></span>
                    </div>
                    <div class="col-md-1 flex-column">&nbsp;
                    </div>
                    <div class="col-md-3 flex-column p-2 bg-white m-2 boxshadow-resourse">
                        <img src="assets/frontend/default/img/course-report.png" class="img-fluid" width="10%" alt="" style="display:inline-block">
                        <h5 style="display:inline-block" style="display:inline-block"><b>Mouthshut.com</b></h5>
                        <span class="badge badge-sub-primary text-11px mt-1">4.8 <i class="fa fa-star" style="color:#fac43f"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="section-blog ">
    <div class="container-lg">
    <div class="row mb-5">
        <div class="col-md-6">
            <h3 class="course-carousel-title mb-2" style="display:inline-block">Latest stories and insights<br><span class="text-blue">learn with our blogs</span></h3>
            <span class="d-block text-color-dark text-5 pb-2 mb-1 opacity-7">Learn more about us through these unique blog pots. They are fun to read and won’t cost you a dime!</span>
        </div>
        <div class="col-md-6"><a href="#" class="btn btn-primary blog-button btn-lg">Visit more blogs</a></div>
    </div>
        <div class="row row-cols-1 row-cols-lg-4 row-cols-md-3 g-4 justify-content-center">
        <?php $blogs = $this->crud_model->get_blogs_home(4); ?>
            <!-- <div class="col-12">
                <h4 class="fw-700">Latest blogs</h4>
            </div> -->
            <?php foreach ($blogs as $row){ ?>
            <div class="col">
                <div class="card radius-10 course-box">
                    <img src="<?php echo base_url('uploads/thumbnails/blog_thumbnail/' . $row['blog_image']); ?>" class="card-img-top radius-top-10" alt="AI-Based learning is the future of Corporate Training">
                    <div class="card-body pt-4">
                      
                        <h5 class="card-title"><a href="#"><?php echo ellipsis($row['blog_title'], 60); ?></a></h5>
                        <p class="card-text ellipsis-line-3" style="display: -webkit-box!important;-webkit-line-clamp: 3 !important;-webkit-box-orient: vertical !important;overflow: hidden !important;text-overflow: ellipsis !important;white-space: normal !important;"><?php echo ellipsis(strip_tags(html_entity_decode($row['blog_description'])), 200); ?></p>
                            <p class="blog-date">
                            <?php 
                                $date=date_create($row['added_date']);
                                echo date_format($date,"d/M/Y");
                            ?>
                            </p>
                            <a href="#" class="color-blue"><b>See more <i class="fa fa-arrow-right"></i></b></a>
                    </div>
                </div>
            </div> 
              <?php } ?>         
        </div>
    </div>
</section>

<!-- <section class="course-carousel-area blog">
    <div class="container-lg ">
        <div class="row">
            <div class="col-md-6">
                <h3 class="course-carousel-title mb-2" style="display:inline-block">Latest stories and insights<br><span class="text-blue">learn with our blogs</span></h3>
                <span class="d-block text-color-dark text-5 pb-2 mb-1 opacity-7">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eget tortor vel sem semper gravida. Ut posuere.</span>
            </div>
            <div class="col-md-6"><a href="#" class="btn btn-primary blog-button btn-lg">Visit more blogs</a></div>
        </div>
         <div class="row mt-5"> -->
            <!-- page loader --> 
            <!-- <div class="animated-loader">
                <div class="spinner-border text-secondary" role="status"></div>
            </div>
            <div class="col-md-4 col col-12 boxshadow-course mb-5">
                <a href="#">
                    <div class="course-box">
                        <div class="course-image">
                            <img src="assets/frontend/default/img/blog1.jpg" alt="" class="img-fluid">
                        </div>
                        <div class="course-details p-5">
                            <h4 class="blog-title">Blog Title here 01</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab perspiciatis cum debitis nisi deleniti aliquid beatae consequatur quas qui?</p>
                            <p class="blog-date">01/Month/2022</p>
                            <a href="#" class="color-blue"><b>See more <i class="fa fa-arrow-right"></i></b></a>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col col-12 boxshadow-course mb-5">
                <a href="#">
                    <div class="course-box">
                        <div class="course-image">
                            <img src="assets/frontend/default/img/blog1.jpg" alt="" class="img-fluid">
                        </div>
                        <div class="course-details p-5">
                            <h4 class="blog-title">Blog Title here 01</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab perspiciatis cum debitis nisi deleniti aliquid beatae consequatur quas qui?</p>
                            <p class="blog-date">01/Month/2022</p>
                            <a href="#" class="color-blue"><b>See more <i class="fa fa-arrow-right"></i></b></a>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col col-12 boxshadow-course mb-5">
                <a href="#">
                    <div class="course-box">
                        <div class="course-image">
                            <img src="assets/frontend/default/img/blog1.jpg" alt="" class="img-fluid">
                        </div>
                        <div class="course-details p-5">
                            <h4 class="blog-title">Blog Title here 01</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab perspiciatis cum debitis nisi deleniti aliquid beatae consequatur quas qui?</p>
                            <p class="blog-date">01/Month/2022</p>
                            <a href="#" class="color-blue"><b>See more <i class="fa fa-arrow-right"></i></b></a>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section> --> 
<section class="featured-instructor see-how-others">
    <div class="container-lg">
        <div class="row">
            <div class="col">
                <h3 class="course-carousel-title mb-2 text-center">See how others are feeling about us</span></h3>
                <span class="d-block text-color-dark text-5 pb-2 mb-5 opacity-7 text-center">Are you still confused? Read others’ opinions about us.</span>
            </div>
        </div>
        <div class="row justify-content-center mb-5">
            <div class="col-md-9 col-lg-7">
                <div class="animated-loader">
                    <div class="spinner-border text-secondary" role="status"></div>
                </div>
                <div class="top-istructor-slick shown-after-loading" style="display: none;">
                    <?php $testimonials = $this->crud_model->get_testimonial(10); ?>
                    <?php foreach ($testimonials as $row) : ?>
                        <div class="d-sm-flex text-center text-md-start">
                            <div class="top-instructor-img ms-auto me-auto">
                                <img src="<?php echo base_url('uploads/thumbnails/testimonial_thumbnail/' . $row['testimonial_image']); ?>" width="200px" height="200px">
                            </div>
                            <div class="top-instructor-details">
                                <h4 class="mb-1 fw-700"><?php echo $row['testimonial_name']; ?></h4>
                                <span class="fw-500 text-muted text-14px"><?php echo ellipsis($row['testimonial_title'], 60); ?></span><br>
                                <span class="fw-500 text-muted text-14px"><?php echo ellipsis($row['testimonial_type'], 60); ?></span>
                                <p class="text-12px fw-500 text-muted my-3"><?php echo ellipsis(strip_tags(html_entity_decode($row['testimonial_description'])), 200); ?></p>
                                <p class="top-instructor-arrow my-3">
                                    <span class="cursor-pointer" onclick="$('.top-istructor-slick .slick-prev').click();"><i class="fas fa-angle-left"></i></span>
                                    <span class="cursor-pointer" onclick="$('.top-istructor-slick .slick-next').click();"><i class="fas fa-angle-right"></i></span>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mb-5 boxshadow-resourse lets-start">
            <div class="col-md-6">
                <h3 class="course-carousel-title m-5" style="display:inline-block"><span class="text-blue">Are you ready to start <br>your course now!</span></h3>
            </div>
            <div class="col-md-6 mb-5 text-center ">
                <a href="#" class="btn btn-primary btn-lg">Lets get start</a>
                &nbsp;&nbsp;&nbsp;
                <a href="#" class="btn btn-primary btn-lg">Contact us</a>
            </div>
        </div>
    </div>
</section>
<section class="contact-us-line pb-0">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-9 col-lg-9 boxshadow-get-in-line justify-content-center">
                <h3 class="course-carousel-title m-5" style="display:inline-block"><span>Get in Line with us</span></h3>
                <input type="text" class="input-news-letter" placeholder="Sign up for news letter">
                <a href="#" class="btn btn-lg">Sign up</a>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    function handleWishList(elem) {

        $.ajax({
            url: '<?php echo site_url('home/handleWishList'); ?>',
            type: 'POST',
            data: {
                course_id: elem.id
            },
            success: function(response) {
                if (!response) {
                    window.location.replace("<?php echo site_url('login'); ?>");
                } else {
                    if ($(elem).hasClass('active')) {
                        $(elem).removeClass('active')
                    } else {
                        $(elem).addClass('active')
                    }
                    $('#wishlist_items').html(response);
                }
            }
        });
    }

    function handleCartItems(elem) {
        url1 = '<?php echo site_url('home/handleCartItems'); ?>';
        url2 = '<?php echo site_url('home/refreshWishList'); ?>';
        $.ajax({
            url: url1,
            type: 'POST',
            data: {
                course_id: elem.id
            },
            success: function(response) {
                $('#cart_items').html(response);
                if ($(elem).hasClass('addedToCart')) {
                    $('.big-cart-button-' + elem.id).removeClass('addedToCart')
                    $('.big-cart-button-' + elem.id).text("<?php echo site_phrase('add_to_cart'); ?>");
                } else {
                    $('.big-cart-button-' + elem.id).addClass('addedToCart')
                    $('.big-cart-button-' + elem.id).text("<?php echo site_phrase('added_to_cart'); ?>");
                }
                $.ajax({
                    url: url2,
                    type: 'POST',
                    success: function(response) {
                        $('#wishlist_items').html(response);
                    }
                });
            }
        });
    }

    function handleEnrolledButton() {
        $.ajax({
            url: '<?php echo site_url('home/isLoggedIn'); ?>',
            success: function(response) {
                if (!response) {
                    window.location.replace("<?php echo site_url('login'); ?>");
                }
            }
        });
    }

    $(document).ready(function() {
        if (!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            if ($(window).width() >= 840) {
                $('a.has-popover').webuiPopover({
                    trigger: 'hover',
                    animation: 'pop',
                    placement: 'horizontal',
                    delay: {
                        show: 500,
                        hide: null
                    },
                    width: 330
                });
            } else {
                $('a.has-popover').webuiPopover({
                    trigger: 'hover',
                    animation: 'pop',
                    placement: 'vertical',
                    delay: {
                        show: 100,
                        hide: null
                    },
                    width: 335
                });
            }
        }

        if ($(".course-carousel")[0]) {
            $(".course-carousel").slick({
                dots: false,
                infinite: false,
                speed: 300,
                slidesToShow: 4,
                slidesToScroll: 4,
                swipe: false,
                touchMove: false,
                responsive: [{
                        breakpoint: 840,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                        },
                    },
                    {
                        breakpoint: 620,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                        },
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        },
                    },
                ],
            });
        }

        if ($(".top-istructor-slick")[0]) {
            $(".top-istructor-slick").slick({
                dots: false
            });
        }
    });
</script>