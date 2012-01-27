<label>Link Group:</label>
<select name="groups">
<?php foreach($groups as $k => $v): ?>
	<option value="<?php echo $k; ?>"><?php echo $v; ?></option>
<?php endforeach; ?>
</select>