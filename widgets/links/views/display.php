<ul id="links-widget">
<?php foreach($links as $link): ?>
	<li><a href="<?php echo $link['link_url']; ?>" title="<?php echo $link['link_name']; ?>" target="<?php echo $link['link_target']; ?>" ><?php echo $link['link_name']; ?></a></li>
<?php endforeach; ?>
</ul>