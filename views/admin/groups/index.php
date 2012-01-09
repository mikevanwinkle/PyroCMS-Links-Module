<section class="title"> 
<h4><?php echo lang('links_groups_admin.title'); ?></h4>
</section>

<section class="item">
	<p><?php echo lang('links_groups_admin.welcome'); ?></p>
	<?php //print_r($groups); ?>
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
					<td><?php echo @$group->links; ?></td>
					<td class="actions">
					<?php echo anchor('admin/blogroll/groups/edit/'.$group->id.'/', lang('global:edit'), 'class="button"'); ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php endif; ?>
</section>