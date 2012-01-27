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
					<th><a href="admin/links/index/name/<?php echo $order; ?>">Link</th>
					<th>Description</th>
					<th>Owner</th>
					<th>Group</th>
					<th><a href="admin/links/index/created/<?php echo $order; ?>">Created</a></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($links as $link): ?>
				<tr>
					<td><?php echo $link['link_name']; ?> <a href="<?php echo $link['link_url']; ?>" target="_blank"><img src="<?php echo $this->module_details['path'].'/assets/images/linkicon.png'; ?>" /></a></td>
					<td><?php echo $link['link_description']; ?></td>
					<td><?php echo $link['link_owner']; ?></td>
					<td><?php echo $link['link_group']; ?></td>
					<td><?php echo $link['link_created']; ?></td>
					<td class="actions">
					<?php echo anchor('admin/links/edit/'.$link['id'].'/', lang('global:edit'), 'class="btn orange"'); ?>
					<?php echo anchor('admin/links/delete/'.$link['id'].'/', lang('global:delete'), 'class="confirm btn red delete"'); ?></td>
				</tr>	
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php endif; ?>
</section>