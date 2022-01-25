<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo $page_title; ?>
                    <a href="<?php echo site_url('admin/blog_form/add_blog'); ?>" class="btn btn-outline-primary btn-rounded alignToTitle"><i class="mdi mdi-plus"></i><?php echo get_phrase('add_blog'); ?></a>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title"><?php echo get_phrase('blogs'); ?></h4>
                <div class="table-responsive-sm mt-4">
                    <table id="basic-datatable" class="table table-striped table-centered mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo get_phrase('title'); ?></th>
                                <th><?php echo get_phrase('image'); ?></th>
                                <!-- <th><?php //echo get_phrase('sort_order'); ?></th> -->
                                <th><?php echo get_phrase('actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=0;
                            foreach ($blogs as $row) : ?>
                                <tr>
                                    <td><?php $i=$i+1; echo $i; ?></td>
                                    <td><?php echo $row['blog_title']; ?></td>
                                    <td>
                                        <img src="<?php echo base_url('uploads/thumbnails/blog_thumbnail/' . $row['blog_image']); ?>" alt="" height="150" width="150" class="img-fluid img-thumbnail">
                                    </td>                                    
                                    <!-- <td><?php //echo $row['sort_number']; ?></td> -->
                                    <td>
                                        <?php //if (!is_root_admin($row['blog_id'])) : ?>
                                            <div class="dropright dropright">
                                                <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="mdi mdi-dots-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu">                                                    
                                                    <li><a class="dropdown-item" href="<?php echo site_url('admin/blog_form/edit_blog/' . $row['blog_id']) ?>"><?php echo get_phrase('edit'); ?></a></li>
                                                    <li><a class="dropdown-item" href="#" onclick="confirm_modal('<?php echo site_url('admin/blogs/delete/' . $row['blog_id']); ?>');"><?php echo get_phrase('delete'); ?></a></li>
                                                </ul>
                                            </div>
                                        <?php //else : ?>
                                            <!-- <span class="badge badge-success"><?php //echo ucwords(get_phrase('root_admin')); ?></span> -->
                                        <?php //endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>