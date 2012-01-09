<section class="title"> 
<h4><?php echo lang('links_admin.title'); ?></h4>
</section>

<section class="item">
	<p><?php echo lang('links_admin.welcome'); ?></p>
	<?php //print_r($links); ?>
	<?php if($links): ?>
		<table class="table-list">
			<thead>
				<tr>
					<th><a href="admin/blogroll/index/name/<?php echo $order; ?>">Link</th>
					<th>Description</th>
					<th>Owner</th>
					<th>Group</th>
					<th><a href="admin/blogroll/index/created/<?php echo $order; ?>">Created</a></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($links as $link): ?>
				<tr>
					<td><?php echo $link['link_name']; ?> <small>[<a href="<?php echo $link['link_url']; ?>" target="_blank">Link</a>]</small></td>
					<td><?php echo $link['link_description']; ?></td>
					<td><?php echo $link['link_owner']; ?></td>
					<td><?php echo $link['link_group']; ?></td>
					<td><?php echo $link['link_created']; ?></td>
					<td class="actions">
					<?php echo anchor('admin/blogroll/edit/'.$link['id'].'/', lang('global:edit'), 'class="button"'); ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php endif; ?>
</section>