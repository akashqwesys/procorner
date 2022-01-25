<!-- start page title -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('add_new_testimonial'); ?></h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row justify-content-center">
    <div class="col-xl-7">
        <div class="card">
            <div class="card-body">
              <div class="col-lg-12">
                <h4 class="mb-3 header-title"><?php echo get_phrase('testimonial_add_form'); ?></h4>

                <form class="required-form" action="<?php echo site_url('admin/testimonials/add'); ?>" method="post" enctype="multipart/form-data">                    
                    <div class="form-group">
                        <label for="testimonial_name"><?php echo get_phrase('testimonial_name'); ?><span class="required">*</span></label>
                        <input type="text" class="form-control" id="testimonial_name" name = "testimonial_name" required>
                    </div>       
                    <div class="form-group">
                        <label for="testimonial_title"><?php echo get_phrase('testimonial_title'); ?><span class="required">*</span></label>
                        <input type="text" class="form-control" id="testimonial_title" name = "testimonial_title" required>
                    </div>
                    <div class="form-group">
                        <label for="testimonial_type"><?php echo get_phrase('testimonial_type'); ?><span class="required">*</span></label>
                        <input type="text" class="form-control" id="testimonial_type" name = "testimonial_type" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="testimonial_description"><?php echo get_phrase('testimonial_description'); ?><span class="required">*</span></label>                                
                        <textarea name="testimonial_description" id = "testimonial_description" class="form-control"></textarea>                        
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
