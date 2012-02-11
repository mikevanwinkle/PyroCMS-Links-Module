<section class="title"> 
<h4><?php echo lang('links_groups_admin.title'); ?></h4>
</section>

<section class="item">
	<?php if($groups): ?>
		<table class="table-list">
			<thead>
				<tr>
					<th>Name</th>
					<th>Description</th>
					<th>Slug</th>
					<th>Links</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($groups as $group): ?>
				<tr>
					<td><?php echo $group->name; ?></td>
					<td><?php echo $group->description; ?></td>
					<td><?php echo $group->slug; ?></td>
					<td><?php echo @$group->count; ?></td>
					<td class="actions">
					<?php echo anchor('admin/links/groups/edit/'.$group->id.'/', lang('global:edit'), 'class="button"'); ?>
					<?php echo anchor('admin/links/groups/delete/'.$group->id.'/', lang('global:delete'), 'class="confirm button"'); ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php else: ?>
		<div class="no_data"><?php echo lang('links_groups_admin.no_groups'); ?></div>
	<?php endif; ?>
</section>