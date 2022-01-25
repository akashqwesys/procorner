<?php
$testimonial_details = $this->crud_model->get_testimonial_details_by_id($testimonial_id)->row_array();
?>

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box ">
            <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('update_testimonial'); ?></h4>
        </div>
    </div>
</div>

<div class="row justify-content-md-center">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <div class="col-lg-12">
                    <h4 class="mb-3 header-title"><?php echo get_phrase('update_testimonial_form'); ?></h4>
                    <form class="required-form" action="<?php echo site_url('admin/testimonials/edit/' . $testimonial_id); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="testimonial_name"><?php echo get_phrase('testimonial_name'); ?><span class="required">*</span></label>
                        <input type="text" value="<?php echo $testimonial_details['testimonial_name']; ?>" class="form-control" id="testimonial_name" name = "testimonial_name" required>
                    </div>       
                    <div class="form-group">
                        <label for="testimonial_title"><?php echo get_phrase('testimonial_title'); ?><span class="required">*</span></label>
                        <input type="text" value="<?php echo $testimonial_details['testimonial_title']; ?>" class="form-control" id="testimonial_title" name = "testimonial_title" required>
                    </div>
                    <div class="form-group">
                        <label for="testimonial_type"><?php echo get_phrase('testimonial_type'); ?><span class="required">*</span></label>
                        <input type="text" value="<?php echo $testimonial_details['testimonial_type']; ?>" class="form-control" id="testimonial_type" name = "testimonial_type" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="testimonial_description"><?php echo get_phrase('testimonial_description'); ?><span class="required">*</span></label>                                
                        <textarea name="testimonial_description" id = "testimonial_description" class="form-control"><?php echo $testimonial_details['testimonial_description']; ?></textarea>                        
                    </div> 
                    <div class="form-group" id = "thumbnail-picker-area">
                        <label> <?php echo get_phrase('testimonial_thumbnail'); ?> <small>(<?php echo get_phrase('the_image_size_should_be'); ?>: 400 X 255)</small> </label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="testimonial_thumbnail" name="testimonial_thumbnail" accept="image/*" onchange="changeTitleOfImageUploader(this)">
                                <label class="custom-file-label" for="testimonial_thumbnail"><?php echo get_phrase('choose_thumbnail'); ?></label>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="checkRequiredFields()"><?php echo get_phrase("submit"); ?></button>
                    </form>
                </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<script type="text/javascript">
    $(document).ready(function () {
        initSummerNote(['#testimonial_description']);
    });
</script>