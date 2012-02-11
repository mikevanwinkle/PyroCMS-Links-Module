<section class="title">
<?php if ($this->method == 'create'): ?>
	<h4><?php echo lang('links_admin.create_title'); ?></h4>
<?php else: ?>
	<h4><?php echo sprintf(lang('links_admin.edit_title')); ?></h4>
<?php endif; ?>
</section>

<section class="item">
<?php echo form_open(uri_string(), 'class="crud"'); ?>
	
	<div class="form_inputs">
	<ul>
		<li class="odd">
				<label for="link_name"><?php echo lang('links_admin.name_label'); ?> <span>*</span></label>
				<div class="input"><?php echo form_input('link_name', htmlspecialchars_decode(@$link['link_name']), 'maxlength="100" id="link_name"'); ?></div>				
		</li>
		<li class="even">
				<label for="link_url"><?php echo lang('links_admin.url_label'); ?> <span>*</span></label>
				<div class="input"><?php echo form_input('link_url', htmlspecialchars_decode(@$link['link_url']), 'maxlength="100" id="title"'); ?></div>				
		</li>
		<li>
			<label for="link_description"><?php echo lang('links_admin.description_label'); ?></label>
			<div class="input">
				<?php echo form_textarea(array('id' => 'description', 'name' => 'link_description', 'value' => @$link['link_description'], 'rows' => 5, 'class' => 'raw')); ?>
			</div>
		</li>
		<li>
			<label for="link_group"><?php echo lang('links_admin.group_label'); ?></label>
			<div class="input">
			<?php if(empty($link_groups)): ?>
				<p>You have not yet entered a link group.</p>
			<?php else: ?>
				<?php echo form_dropdown('link_group', $link_groups, @$link['link_group']); ?>
			<?php endif; ?>
			</div>
		</li>
		<li>
			<label for="link_target"><?php echo lang('links_admin.target_label'); ?></label>
			<div class="input">
				<?php echo form_dropdown('link_target', array(
						'' => '--none--',
						'_blank' => '_blank',
						'_parent' => '_parent'
					), @$link['link_target']); ?>
			</div>
		</li>
		<?php if(isset($link['link_id'])) : ?>
			<input type="hidden" name="link_id" value="<?php echo $link['link_id']; ?>" />
		<?php endif; ?>
		<input type="hidden" name="link_created" value="<?php echo date('Y-m-d H:i:s'); ?>" />
		<input type="hidden" name="link_owner" value="<?php echo (!isset($link['link_owner']))?$this->current_user->id:$link['link_owner']; ?>" />
		<div class="buttons float-right padding-top">
				<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel'))); ?>
		</div>
		
	</ul>
	</div>
	
<?php echo form_close(); ?>