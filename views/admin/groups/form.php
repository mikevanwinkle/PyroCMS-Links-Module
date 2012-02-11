<section class="title">
<?php if (@$this->method == 'create'): ?>
	<h4><?php echo lang('links_groups_admin.create_title'); ?></h4>
<?php else: ?>
	<h4><?php echo sprintf(lang('links_groups_admin.edit_title')); ?></h4>
<?php endif; ?>
</section>
<section class="item">
<?php echo form_open(uri_string(), 'class="crud"'); ?>
	
	<div class="form_inputs">
	<ul>
		<li class="odd">
			<label for="name"><?php echo lang('links_groups_admin.name_label'); ?> <span>*</span></label>
			<div class="input"><?php echo form_input('name', htmlspecialchars_decode(@$group->name), 'maxlength="100" id="name"'); ?></div>				
		</li>
		
		<li>
			<label for="description"><?php echo lang('links_groups_admin.description_label'); ?></label>
			<div class="input">
				<?php echo form_textarea(array('id' => 'description', 'name' => 'description', 'value' => @$group->description, 'rows' => 5, 'class' => 'raw')); ?>
			</div>
		</li>
		
		<li class="odd">
			<label for="slug"><?php echo lang('links_groups_admin.slug_label'); ?> <span>*</span></label>
			<div class="input"><?php echo form_input('slug', htmlspecialchars_decode(@$group->slug), 'maxlength="100" id="name"'); ?></div>				
		</li>
	
	</ul>
	<div class="buttons float-right padding-top">
		<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel'))); ?>
	</div>
	</div><!-- .form_inputs -->
<?php echo form_close(); ?>
