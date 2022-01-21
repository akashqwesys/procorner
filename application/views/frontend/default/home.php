<section class="bg-white">
    <div class="container-md">
        <div class="row">
            <div class="col-md-6 home-banner-wrap">
                <h2 class="fw-bold"><span>Procorner eduflex</span> private limited - a skill focused <span>institute</span></h2>
                <p><?php echo site_phrase(get_frontend_settings('banner_sub_title')); ?></p>
                <form class="" action="<?php echo site_url('home/search'); ?>" method="get">
                    <div class="input-group ">
                        <input type="text" class="form-control" name="query" placeholder="<?php echo site_phrase('what_do_you_want_to_learn'); ?>?" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <span class="input-group-text btn" id="basic-addon2" type="submit"><?php echo site_phrase('search'); ?></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <img src="assets/frontend/default/img/tutor.png" width="100%">
            </div>
        </div>
    </div>
</section>

<section class="course-carousel-area">
    <div class="container-lg py-5">
        <div class="row">
            <div class="col text-center">
                <h3 class="course-carousel-title mb-4 text-center">Quick Feature</h3>
                <span class="d-block text-color-dark text-5 pb-2 mb-1 opacity-7">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eget tortor vel sem semper gravida. Ut posuere.</span>
            </div>
        </div>
        <div class="content-grid">
            <div class="row content-grid-row text-center">
                <div class="col-md-4 col-lg-4 content-grid-item flex-column p-5">
                    <img src="assets/frontend/default/img/study.png" class="img-fluid mb-2" alt="">
                    <h5 class="mb-1"><b>5 Online courses</b></h5>
                    <p class="mb-0">Explore a varity of fresh topics</p>
                </div>
                <div class="col-md-4 col-lg-4 content-grid-item flex-column p-5">
                    <img src="assets/frontend/default/img/qa.png" class="img-fluid mb-2" alt="">
                    <h5 class="mb-1"><b>Expert instruction</b></h5>
                    <p class="mb-0">Find the right course for you</p>
                </div>
                <div class="col-md-4 col-lg-4 content-grid-item flex-column p-5">
                    <img src="assets/frontend/default/img/access.png" class="img-fluid mb-2" alt="">
                    <h5 class="mb-1"><b>Lifetime access</b></h5>
                    <p class="mb-0">Lear on your schedule</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="course-carousel-area bg-white">
    <div class="container-lg py-5">
        <div class="row">
            <div class="col text-center">
                <h3 class="course-carousel-title mb-4 text-center">Explore top courses</h3>
                <span class="d-block text-color-dark text-5 pb-2 mb-1 opacity-7">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eget tortor vel sem semper gravida. Ut posuere.</span>
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
                <div class="col-md-4 boxshadow-course mb-5">
                    <a onclick="return check_action(this);" href="<?php echo site_url('home/course/' . rawurlencode(slugify($top_course['title'])) . '/' . $top_course['id']); ?>">
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

                                <div class="row mt-3">
                                    <div class="col-6">
                                        <span class="badge badge-sub-warning text-11px"><?php echo site_phrase($top_course['level']); ?></span>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button class="brn-compare-sm" onclick="return check_action(this, '<?php echo site_url('home/compare?course-1=' . rawurlencode(slugify($top_course['title'])) . '&&course-id-1=' . $top_course['id']); ?>');"><i class="fas fa-balance-scale"></i> <?php echo site_phrase('compare'); ?></button>
                                    </div>
                                </div>

                                <hr class="divider-1">

                                <div class="d-block">
                                    <div class="floating-user d-inline-block">
                                        <?php if ($top_course['multi_instructor']) :
                                            $instructor_details = $this->user_model->get_multi_instructor_details_with_csv($top_course['user_id']);
                                            $margin = 0;
                                            foreach ($instructor_details as $key => $instructor_detail) { ?>
                                                <img style="margin-left: <?php echo $margin; ?>px;" class="position-absolute" src="<?php echo $this->user_model->get_user_image_url($instructor_detail['id']); ?>" width="30px" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $instructor_detail['first_name'] . ' ' . $instructor_detail['last_name']; ?>" onclick="return check_action(this,'<?php echo site_url('home/instructor_page/' . $instructor_detail['id']); ?>');">
                                                <?php $margin = $margin + 17; ?>
                                            <?php } ?>
                                        <?php else : ?>
                                            <?php $user_details = $this->user_model->get_all_user($top_course['user_id'])->row_array(); ?>
                                            <img src="<?php echo $this->user_model->get_user_image_url($user_details['id']); ?>" width="30px" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $user_details['first_name'] . ' ' . $user_details['last_name']; ?>" onclick="return check_action(this,'<?php echo site_url('home/instructor_page/' . $user_details['id']); ?>');">
                                        <?php endif; ?>
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
    <div class="container-lg py-5">
        <div class="row">
            <div class="col text-center">
                <h3 class="course-carousel-title mb-4 text-center">Inside each course, you will find...</h3>
                <span class="d-block text-color-dark text-5 pb-2 mb-1 opacity-7">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eget tortor vel sem semper gravida. Ut posuere.</span>
            </div>
        </div>
        <div class="content-grid">
            <div class="row content-grid-row">
                <div class="col-md-6 content-grid-item flex-column p-5">
                    <img src="assets/frontend/default/img/inside.png" class="img-fluid mb-2" alt="">
                </div>
                <div class="col-md-6 content-grid-item flex-column p-5">
                    <h4 class="mb-3"><b>Title Heading goes here</b></h4>
                    <p class="mb-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eget tortor vel sem semper gravida. Ut posuere.</p>
                    <ul>
                        <li class="mb-3">Lorem ipsum dolor sit amet, consectetur</li>
                        <li class="mb-3">Lorem ipsum dolor sit amet, consectetur</li>
                        <li class="mb-3">Lorem ipsum dolor sit amet, consectetur</li>
                        <li class="mb-3">Lorem ipsum dolor sit amet, consectetur</li>
                        <li class="mb-3">Lorem ipsum dolor sit amet, consectetur</li>
                        <li class="mb-3">Lorem ipsum dolor sit amet, consectetur</li>
                        <li class="mb-3">Lorem ipsum dolor sit amet, consectetur</li>
                    </ul>
                </div>
            </div>
            <div class="row content-grid-row">
                <div class="col-md-6 content-grid-item flex-column p-5">
                    <h4 class="mb-3"><b>Title Heading goes here</b></h4>
                    <p class="mb-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eget tortor vel sem semper gravida. Ut posuere.</p>
                    <ul>
                        <li class="mb-3">Lorem ipsum dolor sit amet, consectetur</li>
                        <li class="mb-3">Lorem ipsum dolor sit amet, consectetur</li>
                        <li class="mb-3">Lorem ipsum dolor sit amet, consectetur</li>
                        <li class="mb-3">Lorem ipsum dolor sit amet, consectetur</li>
                        <li class="mb-3">Lorem ipsum dolor sit amet, consectetur</li>
                        <li class="mb-3">Lorem ipsum dolor sit amet, consectetur</li>
                        <li class="mb-3">Lorem ipsum dolor sit amet, consectetur</li>
                    </ul>
                </div>
                <div class="col-md-6 content-grid-item flex-column p-5">
                    <img src="assets/frontend/default/img/inside.png" class="img-fluid mb-2" alt="">
                </div>
            </div>
            <div class="row content-grid-row">
                <div class="col-md-6 content-grid-item flex-column p-5">
                    <img src="assets/frontend/default/img/inside.png" class="img-fluid mb-2" alt="">
                </div>
                <div class="col-md-6 content-grid-item flex-column p-5">
                    <h4 class="mb-3"><b>Title Heading goes here</b></h4>
                    <p class="mb-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eget tortor vel sem semper gravida. Ut posuere.</p>
                    <ul>
                        <li class="mb-3">Lorem ipsum dolor sit amet, consectetur</li>
                        <li class="mb-3">Lorem ipsum dolor sit amet, consectetur</li>
                        <li class="mb-3">Lorem ipsum dolor sit amet, consectetur</li>
                        <li class="mb-3">Lorem ipsum dolor sit amet, consectetur</li>
                        <li class="mb-3">Lorem ipsum dolor sit amet, consectetur</li>
                        <li class="mb-3">Lorem ipsum dolor sit amet, consectetur</li>
                        <li class="mb-3">Lorem ipsum dolor sit amet, consectetur</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="course-carousel-area bg-white">
    <div class="container-lg">
        <div class="row mb-5 mt-5">
            <div class="col-md-12 d-flex">
                <img src="assets/frontend/default/img/monyback.png" width="50%">
                <div class="text-box mt-5">
                    <h3>45 DAYS MONEY<br>BACK GUARANTEE</h3>
                    <p>
                        If you don't get results after you followed the methods I teach in the course. I will personally work with you to correct you if you are doing it wrong. If you still don't get results, I will refund 100% of your money. Full details here.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="course-carousel-area">
    <div class="container-lg py-5">
        <div class="row mb-5">
            <div class="col text-center">
                <h3 class="course-carousel-title mb-4 text-center">Resourses</h3>
                <span class="d-block text-color-dark text-5 pb-2 mb-1 opacity-7">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eget tortor vel sem semper gravida. Ut posuere.</span>
            </div>
        </div>
        <div class="row content-grid-row">
            <div class="col-md-3 flex-column p-4 bg-white m-2 boxshadow-resourse">
                <img src="assets/frontend/default/img/idea.png" class="img-fluid mb-2" alt="" width="75">
                <h5 class="mb-3"><b>For Learners</b></h5>
                <p class="mb-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eget tortor vel sem semper gravida. Ut posuere.</p>
                <a href="#"><b>See more <i class="fa fa-arrow-right"></i></b></a>
            </div>
            <div class="col-md-1 flex-column p-5">&nbsp;
            </div>
            <div class="col-md-3 flex-column p-4 bg-white m-2 boxshadow-resourse">
                <img src="assets/frontend/default/img/businessman.png" class="img-fluid mb-2" alt="" width="75">
                <h5 class="mb-3"><b>For Learners</b></h5>
                <p class="mb-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eget tortor vel sem semper gravida. Ut posuere.</p>
                <a href="#"><b>See more <i class="fa fa-arrow-right"></i></b></a>
            </div>
            <div class="col-md-1 flex-column p-5">&nbsp;
            </div>
            <div class="col-md-3 flex-column p-4 bg-white m-2 boxshadow-resourse">
                <img src="assets/frontend/default/img/cap.png" class="img-fluid mb-2" alt="" width="75">
                <h5 class="mb-3"><b>For Learners</b></h5>
                <p class="mb-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eget tortor vel sem semper gravida. Ut posuere.</p>
                <a href="#"><b>See more <i class="fa fa-arrow-right"></i></b></a>
            </div>
        </div>

    </div>
</section>

<section class="course-carousel-area bg-white">
    <div class="container-lg py-5">
        <div class="content-grid">
            <div class="row content-grid-row mb-5">
                <div class="col-md-6 content-grid-item flex-column p-5">
                    <img src="assets/frontend/default/img/inside.png" class="img-fluid mb-2" alt="">
                </div>
                <div class="col-md-6 content-grid-item flex-column p-5">
                    <h4 class="mb-3"><b>Download our app</b></h4>
                    <p class="mb-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eget tortor vel sem semper gravida. Ut posuere.</p>
                    <ul class="mb-4">
                        <li class="mb-3">Lorem ipsum dolor sit amet, consectetur</li>
                        <li class="mb-3">Lorem ipsum dolor sit amet, consectetur</li>
                        <li class="mb-3">Lorem ipsum dolor sit amet, consectetur</li>
                        <li class="mb-3">Lorem ipsum dolor sit amet, consectetur</li>
                        <li class="mb-3">Lorem ipsum dolor sit amet, consectetur</li>
                        <li class="mb-3">Lorem ipsum dolor sit amet, consectetur</li>
                        <li class="mb-4">Lorem ipsum dolor sit amet, consectetur</li>
                    </ul>
                    <a href="" class="btn btn-primary bt-lg">Download App</a>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col text-center">
                    <h3 class="course-carousel-title mb-4 text-center">Leatners across 160+ countries</h3>
                    <span class="d-block text-color-dark text-5 pb-2 mb-1 opacity-7">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eget tortor vel sem semper gravida. Ut posuere.</span>
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