<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Qwesys Digital Solutions">
  <title>LinkedIn Page Design</title>

      <?php include 'metas.php'; ?>
        <title><?php echo get_settings('system_title'); ?> | <?php echo $page_title; ?></title>
      <?php include 'includes_top.php'; ?>

    <!-- CSS  -->
    <style type="text/css">
      .features.clearfix { margin-top: 83px; }
      .section {
        position: relative;
        width: 100%;
        display: inline-block;
        margin-top: 50px;
      }
      header { background: linear-gradient(to right, #480048, #C04848); }
      .course_list {
        position: relative;
        width: 100%;
      }
      .list {
        position: relative;
        width: 33.33%;
        float: left;
      }
      .list li {
        width: 100%;
        position: relative;
        float: left;
        padding: 10px 20px;
      }
      .tab .btn { 
        width: 100%;
        padding: 10px;
      }
      .course_list .btn_home_align {
        width: 100%;
        position: relative;
        display: inline-block;
      }
      .course_list .btn_home_align {
        width: 100%;
        position: relative;
        display: inline-block;
        padding: 20px 0;
      }
      .about_content {
        float: left;
        position: relative;
        margin-top: 50px;
      }
      .about_content .left {
        width: 40%;
        float: left;
        padding: 0 10px;
      }
      .about_content .right {
        width: 60%;
        float: right;
        padding: 0 30px;
      }
      .img-content { 
        background-color: #e9e9e7;
        padding: 20px;
      }
      .img-title {
        font-size: 16px; 
        font-weight: bold; 
        text-transform: inherit; 
        text-align: left;
        margin-bottom: 20px;
      }
      .img-description {
        border-top: 1px solid #e6e6e6;
        padding-top: 20px;
      }
      .img2 .img-fluid { width: 50%; }
      .img2 { text-align: center; }
      .right li {
        padding: 20px;
        margin-bottom: 20px;
        border-style: solid;
        border-width: 1px 1px 1px 1px;
        border-color: #dddddd;
        border-radius: 4px 4px 4px 4px;
      }
      .inner-content { background-color: #ffffff; }
      .section-4 .col-md-4 { padding: 10px; }
      .inner-content {
        background-color: #fff;
        padding: 15px;
        border-radius: 10px;
        overflow: hidden;
      }
      .section-5 .col-lg-6 { padding: 10px; }
      .feedback {
        padding: 20px;
        background-color: #fefefe;
        box-shadow: 0 1px 5px 0 rgba(0,0,0,.2),0 3px 1px -2px rgba(0,0,0,.12),0 2px 2px 0 rgba(0,0,0,.14);
        border-radius: 5px;
        width: 100%;
        display: inline-block;
    }
    .section-6 { 
      background: linear-gradient(to right, #480048, #C04848);
      padding: 062px 0px 0230px 0px; 
    }
    .PromoAd .left {
        width: 50%;
        float: left;
        position: relative;
        padding: 25px;
    }
    .PromoAd .right {
        width: 50%;
        float: right;
        position: relative;
    }
    .PromoAd h2  {
        color: #fff;
        margin-bottom: 30px;
    }
    .PromoAd p { color: #c5c5c5; }
    .image-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-size: cover;
      background-position: 50%;
    }
    .section.section-7 { 
      margin-top: -10%;
      display: flex;
   }
    .belowPromoAd {
      width: 50%;
      position: relative;
      display: flex;
      margin: 0 auto;
      background-color: #FFF;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0px 52px 34px 0px rgba(0, 0, 0, 0.08);
      transition: background 0.3s, border 0.3s, border-radius 0.3s, box-shadow 0.3s;
      padding: 30px;
    }
    .belowPromoAd img {  width: 25%; }
    .belowPromoAd h5 { 
      padding: 35px 0;
      line-height: 1.5em;
    }
    .belowPromoAd p {
      line-height: 30px;
      font-weight: 600;
      color: #959595;
    }
    .belowPromoAd p span { color: #333; }
    .avatar { width: 50px; }
    .avatar-container p {
      display: inline-flex;
      margin: 0 10px;
    }
    .AboutMe_top {
      position: relative;
      display: flex;
    }
    .AboutMe_top .left, .AboutMe_top .right {
      width: 20%;
      position: relative;
    }
    .AboutMe_top .middle {
      width: 60%;
      position: relative;
      background-color: #121921;
      padding: 50px;
    }
    .AboutMe_bottom img {
      vertical-align: middle;
      display: inline-block;
      width: 100%;
    }
    .AboutMe_top .middle .title h3 {
      color: #fff;
      text-transform: uppercase;
      margin-bottom: 30px;
    }
    .AboutMe_top .middle .description p {
      color: #888;
      font-weight: 500;
      line-height: 25px;
      margin: 0;
    }
    </style>
  </head>
<body>
    <div id="page">
      <!-- Header -->
      <?php include 'header.php'; ?>
      <!-- Main content starts from here -->

      <!-- The black banner content starts -->
      <div class="features clearfix">
          <div class="container">
            <ul>
              <li><i class="pe-7s-study"></i>
                  <h4>
                      <?php
                      $status_wise_courses = $this->crud_model->get_status_wise_courses();
                      $number_of_courses = $status_wise_courses['active']->num_rows();
                      echo $number_of_courses.' '.site_phrase('online_courses'); ?>
                  </h4><span><?php echo site_phrase('explore_your_knowledge'); ?></span>
              </li>
              <li><i class="pe-7s-cup"></i>
                  <h4><?php echo site_phrase('expert_instruction'); ?></h4>
                  <span><?php echo site_phrase('find_the_right_course_for_you'); ?></span>
              </li>
              <li><i class="pe-7s-target"></i>
                  <h4><?php echo site_phrase('lifetime_access'); ?></h4>
                  <span><?php echo site_phrase('learn_on_your_schedule'); ?></span>
              </li>
            </ul>
          </div>
      </div>
      <!-- The black banner content ends -->

      <main>
        <div class="section section-1">
          <div class="container">
            <div class="main_title_2">
              <span><em></em></span>
              <h2>Top Courses</h2>
            </div>
            <div class="course_list">
              <div class="list">
              <ul>
                <li class="tab tab-1">
                  <a href="#collapse1" class="btn btn-info" data-toggle="collapse">Agency Owners</a>
                  <div id="collapse1" class="collapse">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                  </div>
                </li>
                <li class="tab tab-2">
                  <a href="#collapse2" class="btn btn-info" data-toggle="collapse">Speakers and Authors</a>
                  <div id="collapse2" class="collapse">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                  </div>
                </li>
                <li class="tab tab-3">
                  <a href="#collapse3" class="btn btn-info" data-toggle="collapse">Legal Professionals</a>
                  <div id="collapse3" class="collapse">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                  </div>
                </li>
              </ul>
              </div>
              <div class="list">
              <ul>
                <li class="tab tab-4">
                  <a href="#collapse4" class="btn btn-info" data-toggle="collapse">Real estate Professionals</a>
                  <div id="collapse4" class="collapse">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                  </div>
                </li>
                <li class="tab tab-5">
                  <a href="#collapse5" class="btn btn-info" data-toggle="collapse">Small business Owners</a>
                  <div id="collapse5" class="collapse">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                  </div>
                </li>
                <li class="tab tab-6">
                  <a href="#collapse6" class="btn btn-info" data-toggle="collapse">B2B Marketers</a>
                  <div id="collapse6" class="collapse">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                  </div>
                </li>
              </ul>
              </div>
              <div class="list">
              <ul>
                <li class="tab tab-7"
                ><a href="#collapse7" class="btn btn-info" data-toggle="collapse">Sales and Business Executives</a>
                  <div id="collapse7" class="collapse">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                  </div>
                </li>
                <li class="tab tab-8">
                  <a href="#collapse8" class="btn btn-info" data-toggle="collapse">Business coaches</a>
                  <div id="collapse8" class="collapse">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                  </div>
                </li>
                <li class="tab tab-9">
                  <a href="#collapse9" class="btn btn-info" data-toggle="collapse">Personal Development</a>
                  <div id="collapse9" class="collapse">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.s
                  </div>
                </li>
              </ul>
              </div>

              <div class="btn_home_align">
                <a href="https://procorner.in/home/courses" class="btn_1 rounded">View all courses</a>
              </div>

              </div>
          </div>
        </div>

        <div class="section section-2">
          <div class="container">
            <div class="main_title_2">
              <span><em></em></span>
              <h2>All that you’ll ever need to know</h2>
            </div>
            <div class="about_content">
              <div class="left">
                <div class="img1">
                  <img src="https://sisinty.com/wp-content/uploads/2021/02/RK__4705-min-scaled.jpg" class="img-fluid" alt=""> 
                  <div class="img-content">
                      <h4 class="img-title"><center>74 videos  &nbsp; · &nbsp;  8 hours</center></h4>
                      <p class="img-description">Access all rock-solid growth hacking video content, which will help you set your LinkedIn on fire and never worry about your business leads ever again.</p>
                  </div>
                </div>
                <div class="img2"><img src="https://sisinty.com/wp-content/uploads/2021/01/Group-3@2x-1-1.png" class="img-fluid" alt=""></div>
              </div>
              <div class="right">
                <ul>
                  <li>
                    <p>My <strong>6-Step Blueprint</strong> is designed to drum up brand awareness and generate leads without sending a single message to anyone on LinkedIn. Attract the customers – not the other way around.</p>
                  </li>
                  <li>
                    <p><strong>My super-secret tactics</strong> to get 100s of endorsements on all your skills and recommendations on your LinkedIn profile using automation without even asking for them, making your profile look legit.</p>
                  </li>
                  <li>
                    <p><strong>My unique and untapped Sales Navigator automated process</strong> will help you find qualified leads easily, add them to your connections, send them a series of automated messages, find their email IDs, send them an email sequence and show them on AD on Facebook all automated</p>
                  </li>
                  <li>
                    <p><strong>The Advanced Profile Optimisation Strategies</strong> that I and my clients use to rank for the desired keywords on LinkedIn search and google search in no time almost effortlessly. Obviously results in tons of leads and sales all organic</p>
                  </li>
                  <li>
                    <p><strong>The exact way I generate incredibly engaging content</strong>, my content hacking tricks that catapulted me over 25M+ views on LinkedIn (Averaging 87,000+ views per post)</p>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div class="section section-3">
          <div class="container">
            <div class="main_title_2">
              <span><em></em></span>
              <h2>Categories</h2>
            </div>
            <div class="row justify-content-center">
              <?php foreach ($this->crud_model->get_categories()->result_array() as $category):
                if($category['parent'] > 0)
                continue; ?>
                <!-- /grid_item -->
                <div class="col-lg-4 col-md-6 wow" data-wow-offset="150">
                  <a href="<?php echo site_url('home/courses?category='.$category['slug']); ?>" class="grid_item">
                    <figure class="block-reveal">
                      <div class="block-horizzontal"></div>
                      <img src="<?php echo base_url('uploads/thumbnails/category_thumbnails/'.$category['thumbnail']); ?>" class="img-fluid" alt="">
                      <div class="info">
                        <small><i class="ti-layers"></i>
                          <?php echo $this->crud_model->get_category_wise_courses($category['id'])->num_rows().' '.site_phrase('courses'); ?>
                        </small>
                        <h3><?php echo $category['name']; ?></h3>
                      </div>
                    </figure>
                  </a>
                </div>
                <!-- /grid_item -->
              <?php endforeach; ?>
            </div>
          </div>
        </div>

        <div class="section section-4">
          <div class="container">
            <div class="main_title_2">
              <span><em></em></span>
              <h2>Bonus Courses</h2>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="inner-content">
                  <h4>Bonus 1</h4>
                  <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.</p>
                  <p><a href="https://procorner.in/home/courses" class="btn_1 rounded">View Detils</a></p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="inner-content">
                  <h4>Bonus 2</h4>
                  <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.</p>
                  <p><a href="https://procorner.in/home/courses" class="btn_1 rounded">View Detils</a></p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="inner-content">
                  <h4>Bonus 3</h4>
                  <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.</p>
                  <p><a href="https://procorner.in/home/courses" class="btn_1 rounded">View Detils</a></p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="inner-content">
                  <h4>Bonus 4</h4>
                  <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.</p>
                  <p><a href="https://procorner.in/home/courses" class="btn_1 rounded">View Detils</a></p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="inner-content">
                  <h4>Bonus 5</h4>
                  <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.</p>
                  <p><a href="https://procorner.in/home/courses" class="btn_1 rounded">View Detils</a></p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="inner-content">
                  <h4>Bonus 6</h4>
                  <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.</p>
                  <p><a href="https://procorner.in/home/courses" class="btn_1 rounded">View Detils</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="section section-5">
          <div class="container">
            <div class="main_title_2">
              <span><em></em></span>
              <h2>What our learners are saying</h2>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="feedback">
                  <p>Awesome and informative courses for beginners.Thanks a lot to the Great Learning Team.</p>
                  <div class="avatar-container">
                     <img src="https://procorner.in/uploads/user_image/placeholder.png" alt="" class="avatar"> 
                     <p>Joseph Tran</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="feedback">
                  <p>Wow, I am really happy to see the Great Learning offering free courses. Quality is not questionable at all, the best content in the market.</p>
                  <div class="avatar-container">
                     <img src="https://procorner.in/uploads/user_image/placeholder.png" alt="" class="avatar"> 
                     <P>Joseph Tran</P>
                  </div>
                </div>
                </div>
                <div class="col-lg-6">
                <div class="feedback">
                  <p>@Great Learning. Thank you so much for such a wonderful course video on Python. It's really insightful</p>
                  <div class="avatar-container">
                     <img src="https://procorner.in/uploads/user_image/placeholder.png" alt="" class="avatar"> 
                     <P>Somen Das</P>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="feedback">
                  <p>Excellent Teaching. I truly learned a lot and used it to teach some of my students also.</p>
                  <div class="avatar-container">
                     <img src="https://procorner.in/uploads/user_image/placeholder.png" alt="" class="avatar"> 
                     <P>Somen Das</P>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="section section-6">
          <div class="container">
            <div class="PromoAd">
              <div class="left">
                  <h2>Before you ask for it, here’s some proof</h2>
                  <p>I’ve filmed a quick video showing you all my LinkedIn stats and numbers. Unlike typical gurus out there, I’m a pure practitioner. I practice what I preach.</p>
                  <a class="btn_1 rounded" href="https://procorner.in/home/courses">Start Now</a>
              </div>
              <div class="right">
                <video  src="http://sisinty.com/wp-content/uploads/2021/03/Part-2-_-Proof.mp4" controls="" controlslist="nodownload">
                </video>
                <div class="image-overlay" style="background-image: url(&quot;https://sisinty.com/wp-content/uploads/2021/01/Img-Copy-1-1.png&quot;);" data-ll-status="loaded">
                      <div class="play" role="button">
                        <i class="eicon-play" aria-hidden="true"></i>
                      </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="section section-7">
          <div class="container">
            <div class="belowPromoAd">
              <div class="content">
                <img src="https://sisinty.com/wp-content/uploads/2021/02/download.png" class="img-fluid" alt="">
                <h5>“Vaibhav is a crazy retard when it comes to cracking Growth Codes. I wish he never shares his stuff with anyone else.”</h5>
                <p>Udit Goenka<br><span>Founder, Pitchground</span></p>
              </div>
            </div>
          </div>
        </div>

        <div class="section section-8">
          <div class="AboutMe_top">
              <div class="left">
                <img src="http://sisinty.com/wp-content/uploads/2021/01/RK__96782x-1-1.jpg" class="img-fluid" alt="">
              </div>
              <div class="middle">
                <div class="title">
                  <h3>About Me</h3>
                </div>
                <div class="description">
                  <p>I transform startups into cash-printing businesses, growth consult for brands and help them use the internet to skyrocket profits and their overall bottom lines.
                  <br><br> In 2012, I started “CrazyHeads” which served 100+ clients across the globe in just 3 years in my college days, with 14 other crazy heads!But in 2015, I joined Uber to help them scale from 100 trips to 1M trips every week. I later joined Klook India and helped them clock $27M/year business.
                  <br><br>I have consulted 60+ startups, delivered 40+ workshops &amp; 20 talks in top institutions in growth. Many reputed publications like Entrepreneur have featured me and I have launched 3 Growth Hacking Courses (LinkedIn, Chatbots &amp; Instagram).
                </div>
              </div>
              <div class="right">
                <img src="http://sisinty.com/wp-content/uploads/2021/01/RK__4665-12x-1.jpg" class="img-fluid" alt="">
              </div>
          </div>
          <div class="AboutMe_bottom">
            <img src="https://sisinty.com/wp-content/uploads/2021/01/DSC056192x-1-1-1-scaled-1-1024x312.jpg" class="img-fluid" alt="">
          </div>
        </div>

        <div class="section section-9">
          <div class="container">
            <div class="careerplus">
              
            </div>
          </div>
        </div>

      </main>
      <!-- footer -->
      <?php include 'footer.php'; ?>
    </div>
    <!-- end of page -->

    <?php include 'includes_bottom.php'; ?>
    <?php include 'common_scripts.php'; ?>
    <?php include 'modal.php'; ?>

</body>
</html>