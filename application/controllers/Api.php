<?php
require APPPATH . '/libraries/TokenHandler.php';
//include Rest Controller library
require APPPATH . 'libraries/REST_Controller.php';

class Api extends REST_Controller
{

  protected $token;
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->library('session');
    // creating object of TokenHandler class at first
    $this->tokenHandler = new TokenHandler();
    header('Content-Type: application/json');
  }

  public function web_redirect_to_buy_course_get($auth_token = "", $course_id = "", $app_url = "")
  {
    $this->load->library('session');
    if ($auth_token != "" && $course_id != "" && is_numeric($course_id)) {

      //decode user auth token
      $user_details = json_decode($this->token_data_get($auth_token), true);
      $query = $this->user_model->get_all_user($user_details['user_id']);

      //user login
      if ($query->num_rows() > 0) {
        $row = $query->row();
        $this->session->set_userdata('user_id', $row->id);
        $this->session->set_userdata('role_id', $row->role_id);
        $this->session->set_userdata('role', get_user_role('user_role', $row->id));
        $this->session->set_userdata('name', $row->first_name . ' ' . $row->last_name);
        $this->session->set_userdata('is_instructor', $row->is_instructor);
        if ($row->role_id == 1) {
          $this->session->set_userdata('admin_login', '1');
        } else if ($row->role_id == 2) {
          $this->session->set_userdata('user_login', '1');
        }
        $this->session->set_userdata('app_url', $app_url . '://');
        $this->session->set_flashdata('flash_message', get_phrase('welcome') . ' ' . $row->first_name . ' ' . $row->last_name);

        //add item to cart
        if (!$this->session->userdata('cart_items')) {
          $this->session->set_userdata('cart_items', array());
        }
        $previous_cart_items = $this->session->userdata('cart_items');
        if (in_array($course_id, $previous_cart_items)) {
          $key = array_search($course_id, $previous_cart_items);
          unset($previous_cart_items[$key]);
        } else {
          array_push($previous_cart_items, $course_id);
        }

        $course_details = $this->crud_model->get_course_by_id($course_id)->row_array();
        if ($course_details['discount_flag'] == 1) {
          $price = $course_details['discounted_price'];
        } else {
          $price = $course_details['price'];
        }
        $this->session->set_userdata('total_price_of_checking_out', $price);
        $this->session->set_userdata('cart_items', $previous_cart_items);

        //redirect to payment page
        redirect(site_url('home/payment'), 'refresh');
      } else {
        $this->session->set_flashdata('error_message', get_phrase('invalid_auth_token'));
        redirect(site_url('home/login'), 'refresh');
      }
    } else {
      $this->session->set_flashdata('error_message', site_phrase('something_is_wrong'));
      redirect(site_url('home/login'), 'refresh');
    }
  }

  // Unprotected routes will be located here.
  // Fetch all the top courses
  public function top_courses_get($top_course_id = "")
  {
    $top_courses = array();
    $user_id = 0;
    $enroll_result = array();
    $response_result = array();
    $return_array = array();
    if (!empty($_GET['auth_token'])) {
      $auth_token = $_GET['auth_token'];
      $logged_in_user_details = json_decode($this->token_data_get($auth_token), true);
      $user_id = $logged_in_user_details['user_id'];
    }
    if ($user_id > 0) {
      $enroll_result = $this->api_model->enroll_course_get($user_id);
    }
    $top_courses = $this->api_model->top_courses_get($top_course_id);

    foreach ($top_courses as $row) {
      $row['is_enroll'] = 0;
      if (!empty($enroll_result)) {
        foreach ($enroll_result as $row_enrol) {
          if ($row['id'] == $row_enrol['course_id']) {
            $row['is_enroll'] = 1;
          }
        }
      }
      array_push($response_result, $row);
    }
    $return_array['top_course']=$response_result;

    $return_array['section_top']['main_title']='India’s coming-of-age platform for all your learning needs.';
    $return_array['section_top']['sub_title']='The perfect place to hone your skills and turn them into forces that will guide you in your career journey. All it takes is a single step to turn your dreams into reality. Join us today to give your career the much-needed boost it deserves.';
    $return_array['section_top']['img']='https://procorner.in/assets/frontend/default/img/tutor.png';
    
    $return_array['section_quick_feature']['main_title']='Quick Feature';
    $return_array['section_quick_feature']['sub_title']='What makes our courses so unique and why should you invest in them?';
    
    $return_array['section_quick_feature']['sub_content'][0]['img']='https://procorner.in/assets/frontend/default/img/study.png';
    $return_array['section_quick_feature']['sub_content'][0]['img_main_title']='5 Online courses';
    $return_array['section_quick_feature']['sub_content'][0]['img_sub_title']='Courses on trending, impactful topics';

    $return_array['section_quick_feature']['sub_content'][1]['img']='https://procorner.in/assets/frontend/default/img/qa.png';
    $return_array['section_quick_feature']['sub_content'][1]['img_main_title']='Expert instruction';
    $return_array['section_quick_feature']['sub_content'][1]['img_sub_title']='A Step-by-step help guide';

    $return_array['section_quick_feature']['sub_content'][2]['img']='https://procorner.in/assets/frontend/default/img/access.png';
    $return_array['section_quick_feature']['sub_content'][2]['img_main_title']='Lifetime access';
    $return_array['section_quick_feature']['sub_content'][2]['img_sub_title']='Learn whenever you want to';


    // $return_array['section_inside_courses']['main_title']='Inside the courses you’ll get';
    // $return_array['section_inside_courses']['sub_title']='All the amazing perks that we offer so that you are satisfied with the course materials!';
    // $return_array['section_inside_courses']['boolet_img']='https://procorner.in/assets/frontend/default/img/check-mark.png';


    // $return_array['section_inside_courses']['sub_content'][0]['img']='https://procorner.in/assets/frontend/default/img/Pro-level-Hindi-Content.png';
    // $return_array['section_inside_courses']['sub_content'][0]['main_title']='Pro-level Hindi Content';
    // $return_array['section_inside_courses']['sub_content'][0]['sub_title']='Want to learn in your regional language? You can do that with us along with some features';
    
        
    // $return_array['section_inside_courses']['sub_content'][0]['list'][0]='Crisp understanding of difficult concepts.';
    // $return_array['section_inside_courses']['sub_content'][0]['list'][1]='A detailed breakdown of topics.';
    // $return_array['section_inside_courses']['sub_content'][0]['list'][2]='Content in video format.';
    // $return_array['section_inside_courses']['sub_content'][0]['list'][3]='Actionable steps and strategies.';
    // $return_array['section_inside_courses']['sub_content'][0]['list'][4]='Network and connect with like-minded learners.';
    // $return_array['section_inside_courses']['sub_content'][0]['list'][5]='Pre-recorded content will be provided.';
    // $return_array['section_inside_courses']['sub_content'][0]['list'][5]='Watch at your own pace, anytime, anywhere.';


    // $return_array['section_inside_courses']['sub_content'][1]['img']='https://procorner.in/assets/frontend/default/img/Queries-tab.png';
    // $return_array['section_inside_courses']['sub_content'][1]['main_title']='Queries tab';
    // $return_array['section_inside_courses']['sub_content'][1]['sub_title']='Satisfy all the lingering questions that arise due to your curiosity while you are learning something new';    
        
    // $return_array['section_inside_courses']['sub_content'][1]['list'][0]='Don’t take your doubts to the next step of your professional ladder.';
    // $return_array['section_inside_courses']['sub_content'][1]['list'][1]='Clear your doubts with our top educators.';
    // $return_array['section_inside_courses']['sub_content'][1]['list'][2]='Use our Doubts Tab for your queries.';
    // $return_array['section_inside_courses']['sub_content'][1]['list'][3]='Drop your questions at any time of the day.';
    // $return_array['section_inside_courses']['sub_content'][1]['list'][4]='Clear your doubts and satisfy your curiosity.';
    // $return_array['section_inside_courses']['sub_content'][1]['list'][5]='Grow with us as you tweak your mistakes.';
    // $return_array['section_inside_courses']['sub_content'][1]['list'][5]='Ask your doubts in our community group as well.';


    // $return_array['section_inside_courses']['sub_content'][1]['img']='https://procorner.in/assets/frontend/default/img/Lifetime-subscription.png';
    // $return_array['section_inside_courses']['sub_content'][1]['main_title']='Lifetime subscription.';
    // $return_array['section_inside_courses']['sub_content'][1]['sub_title']='Get this super-feature too along with the purchase of our courses! Check them below';    
        
    // $return_array['section_inside_courses']['sub_content'][1]['list'][0]='Get unlimited access to your purchased courses.';
    // $return_array['section_inside_courses']['sub_content'][1]['list'][1]='Zero extra fees for any future additions to the course.';
    // $return_array['section_inside_courses']['sub_content'][1]['list'][2]='Revise by going through the courses multiple times.';
    // $return_array['section_inside_courses']['sub_content'][1]['list'][3]='Get lifetime access to the community group as well.';
    // $return_array['section_inside_courses']['sub_content'][1]['list'][4]='Any upgrades that are made will be provided for free.';
    // $return_array['section_inside_courses']['sub_content'][1]['list'][5]='Learn and prosper at your pace.';
    // $return_array['section_inside_courses']['sub_content'][1]['list'][5]='Rewatch topics for better retention of knowledge.';
    


    $return_array['section_money_back']['img']='https://procorner.in/assets/frontend/default/img/Money-Back-Guarantee.png';
    $return_array['section_money_back']['main_title']='45 DAYS MONEY-BACK GUARANTEE';
    $return_array['section_money_back']['paragraphe']='45 days money-back guarantee After purchasing the course if you don’t get the desired results, our team will personally help you. If still, you are unhappy with the course in any way, you can cancel anytime within 45 days of purchase and a full refund will be made.';

    $return_array['section_money_back']['block'][0]['icon']='fa-door-open';
    $return_array['section_money_back']['block'][0]['title']='Inception in';
    $return_array['section_money_back']['block'][0]['numbers']='2016';

    $return_array['section_money_back']['block'][1]['icon']='fa-history';
    $return_array['section_money_back']['block'][1]['title']='Experience';
    $return_array['section_money_back']['block'][1]['numbers']='12+ Years';

    $return_array['section_money_back']['block'][2]['icon']='fa-chalkboard-teacher';
    $return_array['section_money_back']['block'][2]['title']='Learning';
    $return_array['section_money_back']['block'][2]['numbers']='40+ Hours';

    $return_array['section_money_back']['block'][3]['icon']='fa-smile';
    $return_array['section_money_back']['block'][3]['title']='Course satisfaction';
    $return_array['section_money_back']['block'][3]['numbers']='100%';

    // $return_array['section_resourses']['main_title']='45 DAYS MONEY-BACK GUARANTEE';
    // $return_array['section_resourses']['sub_title']='We have resources for everyone. Whether, you are a working professional, student, or a business. We have something specific for emerging women too';

    // $return_array['section_resourses']['block'][0]['img']='https://procorner.in/assets/frontend/default/img/idea.png';
    // $return_array['section_resourses']['block'][0]['main_title']='For learners';
    // $return_array['section_resourses']['block'][0]['sub_text']='Skyrocket your career with your sharp skillset. Or learn for expanding your wit.';
    // $return_array['section_resourses']['block'][0]['see_more_link']='#';

    // $return_array['section_resourses']['block'][1]['img']='https://procorner.in/assets/frontend/default/img/businessman.png';
    // $return_array['section_resourses']['block'][1]['main_title']='For businesses';
    // $return_array['section_resourses']['block'][1]['sub_text']='Incorporate a growth mindset in your employees through our stackable courses.';
    // $return_array['section_resourses']['block'][1]['see_more_link']='#';

    // $return_array['section_resourses']['block'][2]['img']='https://procorner.in/assets/frontend/default/img/cap.png';
    // $return_array['section_resourses']['block'][2]['main_title']='For emerging women';
    // $return_array['section_resourses']['block'][2]['sub_text']='We help women in achieving their dreams by providing certified courses that will empower them.';
    // $return_array['section_resourses']['block'][2]['see_more_link']='#';

    // $return_array['section_learners_across']['main_title']='Learners across 160+ countries';
    // $return_array['section_learners_across']['sub_title']='We have a global footprint of 160+ countries. Our students learn from the comfort of their homes and develop incredible skills.';
    // $return_array['section_learners_across']['img']='https://procorner.in/assets/frontend/default/img/globalpresence-map.jpg';
    
    // $return_array['section_learners_across']['list'][0]['title']='CourseReport.com';
    // $return_array['section_learners_across']['list'][0]['rating']='4.8';
    // $return_array['section_learners_across']['list'][0]['img']='https://procorner.in/assets/frontend/default/img/course-report.png';

    // $return_array['section_learners_across']['list'][1]['title']='CourseReport.com';
    // $return_array['section_learners_across']['list'][1]['rating']='4.8';
    // $return_array['section_learners_across']['list'][1]['img']='https://procorner.in/assets/frontend/default/img/course-report.png';

    // $return_array['section_learners_across']['list'][2]['title']='CourseReport.com';
    // $return_array['section_learners_across']['list'][2]['rating']='4.8';
    // $return_array['section_learners_across']['list'][2]['img']='https://procorner.in/assets/frontend/default/img/course-report.png';


    // $return_array['section_blog']=$this->crud_model->get_blogs_home(4);
    // $return_array['section_testimonial'] = $this->crud_model->get_testimonial(10);
    // $return_array['section_download_our_app']['sub_title']='Procorner Eduflex just got a NEW app! We have created this app with some great features. Download the app to see it for yourself!';
    // $return_array['section_download_our_app']['list'][0]='Get productive in your free time.';
    // $return_array['section_download_our_app']['list'][1]='Bite-sized knowledge to make you smarter.';
    // $return_array['section_download_our_app']['list'][2]='Join our community of avid learners.';
    // $return_array['section_download_our_app']['list'][3]='Stay up-to-date with our new courses.';
    // $return_array['section_download_our_app']['list'][4]='Get better with each passing day.';
    // $return_array['section_download_our_app']['list'][5]='Network and connect with like-minded individuals.';


    $this->set_response($return_array, REST_Controller::HTTP_OK);
  }

  public function app_logo_get()
  {
    $response = array();
    $response['banner_image'] = base_url('uploads/system/' . get_frontend_settings('banner_image'));
    $response['light_logo'] = base_url('uploads/system/' . get_frontend_settings('light_logo'));
    $response['dark_logo'] = base_url('uploads/system/' . get_frontend_settings('dark_logo'));
    $response['small_logo'] = base_url('uploads/system/' . get_frontend_settings('small_logo'));
    $response['favicon'] = base_url('uploads/system/' . get_frontend_settings('favicon'));

    $this->set_response($response, REST_Controller::HTTP_OK);
  }

  // Fetch all the categories
  public function categories_get($category_id = "")
  {
    $categories = array();
    $categories = $this->api_model->categories_get($category_id);
    $this->set_response($categories, REST_Controller::HTTP_OK);
  }

  // Fetch all the courses belong to a certain category
  public function category_wise_course_get()
  {
    $category_id = $_GET['category_id'];
    $courses = $this->api_model->category_wise_course_get($category_id);
    $this->set_response($courses, REST_Controller::HTTP_OK);
  }

  // Fetch all the courses belong to a certain category
  public function languages_get()
  {
    $languages = $this->api_model->languages_get();
    $this->set_response($languages, REST_Controller::HTTP_OK);
  }

  // Filter course
  public function filter_course_get()
  {
    $courses = $this->api_model->filter_course();
    $this->set_response($courses, REST_Controller::HTTP_OK);
  }

  // Filter course
  public function courses_by_search_string_get()
  {
    $search_string = $_GET['search_string'];
    $courses = $this->api_model->courses_by_search_string_get($search_string);
    $this->set_response($courses, REST_Controller::HTTP_OK);
  }
  // get system settings
  public function system_settings_get()
  {
    $system_settings_data = $this->api_model->system_settings_get();
    $this->set_response($system_settings_data, REST_Controller::HTTP_OK);
  }

  // Login Api
  public function login_get()
  {
    $userdata = $this->api_model->login_get();
    if ($userdata['validity'] == 1) {
      $userdata['token'] = $this->tokenHandler->GenerateToken($userdata);
    }
    return $this->set_response($userdata, REST_Controller::HTTP_OK);
  }

  // Signup Api
  public function signup_post()
  {
    $response = array();
    $response = $this->api_model->signup_post();
    return $this->set_response($response, REST_Controller::HTTP_OK);
  }

  // Verify Email Api
  public function verify_email_address_post()
  {
    $response = array();
    $response = $this->api_model->verify_email_address_post();
    return $this->set_response($response, REST_Controller::HTTP_OK);
  }

  // Resend Verification Code Api
  public function resend_verification_code_post()
  {
    $response = array();
    $response = $this->api_model->resend_verification_code_post();
    return $this->set_response($response, REST_Controller::HTTP_OK);
  }

  public function course_object_by_id_get()
  {
    $course = $this->api_model->course_object_by_id_get();
    $this->set_response($course, REST_Controller::HTTP_OK);
  }
  //Protected APIs. This APIs will require Authorization.
  // My Courses API
  public function my_courses_get()
  {
    $response = array();
    $auth_token = $_GET['auth_token'];
    $logged_in_user_details = json_decode($this->token_data_get($auth_token), true);

    if ($logged_in_user_details['user_id'] > 0) {
      $response = $this->api_model->my_courses_get($logged_in_user_details['user_id']);
    } else {
    }
    return $this->set_response($response, REST_Controller::HTTP_OK);
  }

  // My Courses API
  public function my_wishlist_get()
  {
    $response = array();
    $auth_token = $_GET['auth_token'];
    $logged_in_user_details = json_decode($this->token_data_get($auth_token), true);

    if ($logged_in_user_details['user_id'] > 0) {
      $response = $this->api_model->my_wishlist_get($logged_in_user_details['user_id']);
    } else {
    }
    return $this->set_response($response, REST_Controller::HTTP_OK);
  }

  // Get all the sections
  public function sections_get()
  {
    $response = array();
    $auth_token = $_GET['auth_token'];
    $course_id  = $_GET['course_id'];
    $logged_in_user_details = json_decode($this->token_data_get($auth_token), true);

    if ($logged_in_user_details['user_id'] > 0) {
      $response = $this->api_model->sections_get($course_id, $logged_in_user_details['user_id']);
    } else {
    }
    return $this->set_response($response, REST_Controller::HTTP_OK);
  }

  //Get all lessons, section wise.
  public function section_wise_lessons_get()
  {
    $response = array();
    $auth_token = $_GET['auth_token'];
    $section_id = $_GET['section_id'];
    $logged_in_user_details = json_decode($this->token_data_get($auth_token), true);
    if ($logged_in_user_details['user_id'] > 0) {
      $response = $this->api_model->section_wise_lessons($section_id, $logged_in_user_details['user_id']);
    } else {
    }
    return $this->set_response($response, REST_Controller::HTTP_OK);
  }

  // Remove from wishlist
  public function toggle_wishlist_items_get()
  {
    $auth_token = $_GET['auth_token'];
    $logged_in_user_details = json_decode($this->token_data_get($auth_token), true);
    if ($logged_in_user_details['user_id'] > 0) {
      $status = $this->api_model->toggle_wishlist_items_get($logged_in_user_details['user_id'], $logged_in_user_details['user_id']);
    }
    $response['status'] = $status;
    return $this->set_response($response, REST_Controller::HTTP_OK);
  }

  // Lesson Details
  public function lesson_details_get()
  {
    $response = array();
    $auth_token = $_GET['auth_token'];
    $lesson_id = $_GET['lesson_id'];

    $logged_in_user_details = json_decode($this->token_data_get($auth_token), true);
    if ($logged_in_user_details['user_id'] > 0) {
      $response = $this->api_model->lesson_details_get($logged_in_user_details['user_id'], $lesson_id);
    } else {
    }
    return $this->set_response($response, REST_Controller::HTTP_OK);
  }

  // video otp playbackinfo
  public function video_otp_playbackinfo_get()
  {
    $response = array();
    $response['otp'] = '';
    $response['playbackInfo'] = '';
    $res_vidocipher = get_vidociphr_video_by_id($_GET['vidoCipher_id']);
    if (isset($_GET['auth_token']) && !empty($_GET['auth_token'])) {
      $auth_token = $_GET['auth_token'];
      $logged_in_user_details = json_decode($this->token_data_get($auth_token), true);
    } else {
      $logged_in_user_details['user_id'] = 0;
    }

    if ($logged_in_user_details['user_id'] > 0) {
      if (!empty($res_vidocipher)) {
        $response['otp'] = $res_vidocipher->otp;
        $response['playbackInfo'] = $res_vidocipher->playbackInfo;
      }
    } else {
      $lesson = $this->api_model->lesson_details_by_videoId_get($_GET['vidoCipher_id']);
      if (!empty($lesson)) {
        if ($lesson['is_free'] == 1) {
          $response['otp'] = $res_vidocipher->otp;
          $response['playbackInfo'] = $res_vidocipher->playbackInfo;
        }
      }
    }
    return $this->set_response($response, REST_Controller::HTTP_OK);
  }

  // Course Details
  public function course_details_by_id_get()
  {    
    $response = array();
    $course_id = $_GET['course_id'];
    if (isset($_GET['auth_token']) && !empty($_GET['auth_token'])) {
      $auth_token = $_GET['auth_token'];
      $logged_in_user_details = json_decode($this->token_data_get($auth_token), true);
    } else {
      $logged_in_user_details['user_id'] = 0;
    }
    if ($logged_in_user_details['user_id'] > 0) {
      $response = $this->api_model->course_details_by_id_get($logged_in_user_details['user_id'], $course_id);
    } else {
      $response = $this->api_model->course_details_by_id_get(0, $course_id);
    }
    $ratings = $this->api_model->get_ratings('course', $course_id)->result_array();
    $percentage_ratings=array();
    for($i=1;$i<=5;$i++){
      $res=$this->api_model->get_percentage_of_specific_rating($i, 'course', $course_id);
      $percentage_ratings['rating_'.$i]=$res;
    }

    $response_array=array();
    foreach($response as $row){
      $row['date_added']=date('D, d-M-Y', $row['date_added']);
      $row['last_modified']=date('D, d-M-Y', $row['last_modified']);
      array_push($response_array,$row);
    }
    $response=$response_array;

    $response['ratings']=array();
    foreach($ratings as $row){
      $row['date_added']=date('D, d-M-Y', $row['date_added']);
      array_push($response['ratings'],$row);
    }
    $response['percentage_ratings']=$percentage_ratings;    
    return $this->set_response($response, REST_Controller::HTTP_OK);
  }

  // submit quiz view
  public function submit_quiz_post()
  {
    $submitted_quiz_info = array();
    $container = array();
    $quiz_id = $this->input->post('lesson_id');
    $quiz_questions = $this->crud_model->get_quiz_questions($quiz_id)->result_array();
    $total_correct_answers = 0;
    foreach ($quiz_questions as $quiz_question) {
      $submitted_answer_status = 0;
      $correct_answers = json_decode($quiz_question['correct_answers']);
      $submitted_answers = array();
      foreach ($this->input->post($quiz_question['id']) as $each_submission) {
        if (isset($each_submission)) {
          array_push($submitted_answers, $each_submission);
        }
      }
      sort($correct_answers);
      sort($submitted_answers);
      if ($correct_answers == $submitted_answers) {
        $submitted_answer_status = 1;
        $total_correct_answers++;
      }
      $container = array(
        "question_id" => $quiz_question['id'],
        'submitted_answer_status' => $submitted_answer_status,
        "submitted_answers" => json_encode($submitted_answers),
        "correct_answers"  => json_encode($correct_answers),
      );
      array_push($submitted_quiz_info, $container);
    }
    $page_data['submitted_quiz_info']   = $submitted_quiz_info;
    $page_data['total_correct_answers'] = $total_correct_answers;
    $page_data['total_questions'] = count($quiz_questions);
    $this->load->view('lessons/quiz_result', $page_data);
  }

  public function save_course_progress_get()
  {
    $response = array();
    if (isset($_GET['auth_token']) && !empty($_GET['auth_token'])) {
      $auth_token = $_GET['auth_token'];
      $logged_in_user_details = json_decode($this->token_data_get($auth_token), true);
      $response = $this->api_model->save_course_progress_get($logged_in_user_details['user_id']);
    } else {
    }
    return $this->set_response($response, REST_Controller::HTTP_OK);
  }

  //Upload user image
  public function upload_user_image_post()
  {
    $response = array();
    if (isset($_POST['auth_token']) && !empty($_POST['auth_token'])) {
      $auth_token = $_POST['auth_token'];
      $logged_in_user_details = json_decode($this->token_data_get($auth_token), true);
      if ($logged_in_user_details['user_id'] > 0) {
        if (isset($_FILES['file']) && $_FILES['file']['name'] != "") {
          $user_image = $this->db->get_where('users', array('id' => $logged_in_user_details['user_id']))->row('image') . '.jpg';
          if (file_exists('uploads/user_image/' . $user_image)) {
            unlink('uploads/user_image/' . $user_image);
          }
          $data['image'] = md5(rand(10000, 10000000));
          $this->db->where('id', $logged_in_user_details['user_id']);
          $this->db->update('users', $data);
          move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/user_image/' . $data['image'] . '.jpg');
        }
        $response['status'] = 'success';
      }
    } else {
      $response['status'] = 'failed';
    }
    return $this->set_response($response, REST_Controller::HTTP_OK);
  }

  // update user data
  public function update_userdata_post()
  {
    $response = array();
    if (isset($_POST['auth_token']) && !empty($_POST['auth_token'])) {
      $auth_token = $_POST['auth_token'];
      $logged_in_user_details = json_decode($this->token_data_get($auth_token), true);
      if ($logged_in_user_details['user_id'] > 0) {
        $response = $this->api_model->update_userdata_post($logged_in_user_details['user_id']);
      }
    } else {
      $response['status'] = 'failed';
      $response['error_reason'] = get_phrase('unauthorized_login');
    }
    return $this->set_response($response, REST_Controller::HTTP_OK);
  }

  // password reset
  public function update_password_post()
  {
    $response = array();
    if (isset($_POST['auth_token']) && !empty($_POST['auth_token'])) {
      $auth_token = $_POST['auth_token'];
      $logged_in_user_details = json_decode($this->token_data_get($auth_token), true);
      if ($logged_in_user_details['user_id'] > 0) {
        $response = $this->api_model->update_password_post($logged_in_user_details['user_id']);
      }
    } else {
      $response['status'] = 'failed';
    }
    return $this->set_response($response, REST_Controller::HTTP_OK);
  }

  // Get user data
  public function userdata_get()
  {
    $response = array();
    if (isset($_GET['auth_token']) && !empty($_GET['auth_token'])) {
      $auth_token = $_GET['auth_token'];
      $logged_in_user_details = json_decode($this->token_data_get($auth_token), true);
      $response = $this->api_model->userdata_get($logged_in_user_details['user_id']);
      $response['status'] = 'success';
    } else {
      $response['status'] = 'failed';
    }
    return $this->set_response($response, REST_Controller::HTTP_OK);
  }

  // check whether certificate addon is installed and get certificate
  public function certificate_addon_get()
  {
    $response = array();
    if (isset($_GET['auth_token']) && !empty($_GET['auth_token'])) {
      $auth_token = $_GET['auth_token'];
      $logged_in_user_details = json_decode($this->token_data_get($auth_token), true);
      $user_id = $logged_in_user_details['user_id'];
      $course_id = $_GET['course_id'];

      $response = $this->api_model->certificate_addon_get($user_id, $course_id);
    } else {
      $response['status'] = 'failed';
    }
    return $this->set_response($response, REST_Controller::HTTP_OK);
  }
  /////////// Generating Token and put user data into  token ///////////

  //////// get data from token ////////////
  public function GetTokenData()
  {
    $received_Token = $this->input->request_headers('Authorization');
    if (isset($received_Token['Token'])) {
      try {
        $jwtData = $this->tokenHandler->DecodeToken($received_Token['Token']);
        return json_encode($jwtData);
      } catch (Exception $e) {
        http_response_code('401');
        echo json_encode(array("status" => false, "message" => $e->getMessage()));
        exit;
      }
    } else {
      echo json_encode(array("status" => false, "message" => "Invalid Token"));
    }
  }

  public function token_data_get($auth_token)
  {
    //$received_Token = $this->input->request_headers('Authorization');
    if (isset($auth_token)) {
      try {

        $jwtData = $this->tokenHandler->DecodeToken($auth_token);
        return json_encode($jwtData);
      } catch (Exception $e) {
        echo 'catch';
        http_response_code('401');
        echo json_encode(array("status" => false, "message" => $e->getMessage()));
        exit;
      }
    } else {
      echo json_encode(array("status" => false, "message" => "Invalid Token"));
    }
  }

  public function enroll_free_course_get()
  {
    if (isset($_GET['auth_token']) && !empty($_GET['auth_token'])) {
      $auth_token = $_GET['auth_token'];
      $course_id = $_GET['course_id'];
      $logged_in_user_details = json_decode($this->token_data_get($auth_token), true);

      $course_details = $this->crud_model->get_course_by_id($course_id)->row_array();
      if ($course_details['is_free_course'] == 1) {
        $data['course_id'] = $course_id;
        $data['user_id']   = $logged_in_user_details['user_id'];
        if ($this->db->get_where('enrol', $data)->num_rows() > 0) {
          $response['message'] = 'already_enrolled';
          $response['status'] = 'failed';
        } else {
          $data['date_added'] = strtotime(date('D, d-M-Y'));
          $this->db->insert('enrol', $data);
          $response['message'] = 'success';
          $response['status'] = 'success';
        }
      } else {
        $response['message'] = 'This course is not free';
        $response['status'] = 'failed';
      }
    } else {
      $response['message'] = 'Invalid auth token';
      $response['status'] = 'failed';
    }

    return $this->set_response($response, REST_Controller::HTTP_OK);
  }


  function addon_status_get()
  {
    if (addon_status($_GET['unique_identifier'])) {
      $response['status'] = true;
    } else {
      $response['status'] = false;
    }

    $this->set_response($response, REST_Controller::HTTP_OK);
  }

  function zoom_live_class_get()
  {
    $course_id = $_GET['course_id'];
    $auth_token = $_GET['auth_token'];

    $user_details = json_decode($this->token_data_get($auth_token), true);
    //check live class access ability | valid users
    $course_details = $this->crud_model->get_course_by_id($course_id)->row_array();
    if ($course_details['user_id'] != $user_details['user_id']) {
      $enrolled_history = $this->db->get_where('enrol', array('user_id' => $user_details['user_id'], 'course_id' => $course_id))->num_rows();
      if ($enrolled_history > 0) {
        $access = true;
      } else {
        $access = false;
      }
    } else {
      $access = true;
    }

    if ($access && $course_id > 0) {
      $live_class = $this->db->get_where('live_class', array('course_id' => $course_id));
      if ($live_class->num_rows() > 0) {
        $response['zoom_live_class_details'] = $live_class->row_array();
      } else {
        $response['zoom_live_class_details'] = array();
      }
      $response['zoom_api_key'] = get_settings('zoom_api_key');
      $response['zoom_secret_key'] = get_settings('zoom_secret_key');
    } else {
      $response['zoom_live_class_details'] = array();
      $response['zoom_api_key'] = '';
      $response['zoom_secret_key'] = '';
    }
    $this->set_response($response, REST_Controller::HTTP_OK);
  }
}
