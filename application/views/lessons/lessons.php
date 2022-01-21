<style>

.accordion_one .panel-group {
    border: 1px solid #f1f1f1;
    margin-top: 100px
}

a:link {
    text-decoration: none
}

.accordion_one .panel {
    background-color: transparent;
    box-shadow: none;
    border-bottom: 0px solid transparent;
    border-radius: 0;
    margin: 0
}

.accordion_one .panel-default {
    border: 0
}

.accordion-wrap .panel-heading {
    padding: 0px;
    border-radius: 0px
}

h4 {
    font-size: 18px;
    line-height: 24px
}

.accordion_one .panel .panel-heading a.collapsed {
    color: #999999;
    display: block;
    padding: 12px 30px;
    border-top: 0px
}

.accordion_one .panel .panel-heading a {
    display: block;
    padding: 12px 30px;
    background: #fff;
    color: #313131;
    border-bottom: 1px solid #f1f1f1
}

.accordion-wrap .panel .panel-heading a {
    font-size: 14px
}

.accordion_one .panel-group .panel-heading+.panel-collapse>.panel-body {
    border-top: 0;
    padding-top: 0;
    padding: 25px 30px 30px 35px;
    background: #fff;
    color: #999999
}

.img-accordion {
    width: 81px;
    float: left;
    margin-right: 15px;
    display: block
}

.accordion_one .panel .panel-heading a.collapsed:after {
    content: "\2b";
    color: #999999;
    background: #f1f1f1
}

.accordion_one .panel .panel-heading a:after,
.accordion_one .panel .panel-heading a.collapsed:after {
    font-family: 'FontAwesome';
    font-size: 15px;
    width: 36px;
    line-height: 48px;
    text-align: center;
    background: #F1F1F1;
    float: left;
    margin-left: -31px;
    margin-top: -12px;
    margin-right: 15px
}

.accordion_one .panel .panel-heading a:after {
    content: "\2212"
}

.accordion_one .panel .panel-heading a:after,
.accordion_one .panel .panel-heading a.collapsed:after {
    font-family: 'FontAwesome';
    font-size: 15px;
    width: 36px;
    height: 48px;
    line-height: 48px;
    text-align: center;
    background: #F1F1F1;
    float: left;
    margin-left: -31px;
    margin-top: -12px;
    margin-right: 15px
}

</style>
<?php
$course_details = $this->crud_model->get_course_by_id($course_id)->row_array();

if(isset($bundle_id) && $bundle_id > 0):
    $my_course_url = strtolower($this->session->userdata('role')) == 'user' ? site_url('home/my_bundles') : 'javascript::';
    $btn_title = 'my_bundles';
else:
    $my_course_url = strtolower($this->session->userdata('role')) == 'user' ? site_url('home/my_courses') : 'javascript::';
    $btn_title = 'my_courses';
endif;
$course_details_url = site_url("home/course/".slugify($course_details['title'])."/".$course_id);
?>
<div class="container-fluid course_container">
    <!-- Top bar -->
    <div class="row">
        <div class="col-md-12 col-lg-7 col-xl-9 course_header_col">
            <h5>
                <img src="<?php echo base_url('uploads/system/').get_frontend_settings('small_logo');?>" height="25"> |
                <?php echo $course_details['title']; ?>
            </h5>
        </div>
        <div class="col-md-12 col-lg-5 col-xl-3 course_header_col text-right">
            <a href="javascript::" class="course_btn" onclick="toggle_lesson_view()"><i class="fa fa-arrows-alt-h"></i></a>
            <a href="<?php echo $my_course_url; ?>" class="course_btn"> <i class="fa fa-chevron-left"></i> <?php echo get_phrase($btn_title); ?></a>
            <a href="<?php echo $course_details_url; ?>" class="course_btn"><?php echo get_phrase('course_details'); ?> <i class="fa fa-chevron-right"></i></a>
        </div>
    </div>

    <div class="row" id = "lesson-container">
        <?php if (isset($lesson_id) == true || isset($scorm_curriculum) == true): ?>
            <!-- Course content, video, quizes, files starts-->
            <?php include $course_details['course_type'].'_course_content_body.php'; ?>
            <!-- Course content, video, quizes, files ends-->
        <?php endif; ?>

        <!-- Course sections and lesson selector sidebar starts-->
            <?php if($course_details['course_type'] == 'general'): ?>
                <?php include 'course_content_sidebar.php'; ?>
            <?php endif; ?>
        <!-- Course sections and lesson selector sidebar ends-->
    </div>
</div>
