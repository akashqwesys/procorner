<div class="row justify-content-center">
	<div class="col-md-7 pt-4 pb-3">		
		<form class="add-question-form" action="<?= site_url('addons/course_forum/add_new_question'); ?>" method="post">
			<label for="questionDescription"><?= site_phrase('title_or_summary'); ?></label>
    		<input type="text" id="questionTitle" class="form-control" name="title" required>
    		<br>
    		<label for="questionDescription"><?= site_phrase('details'); ?></label>
    		<textarea class="form-control" name="description" id="questionDescription" rows="4"></textarea>
    		<a href="javascript:;" class="btn bg-info border-5-info mt-4 px-5 float-right" onclick="publish_question('<?= $course_id; ?>')"><?= site_phrase('publish'); ?></a>
		</form>
	</div>
</div>