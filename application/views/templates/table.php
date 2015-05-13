<div class="table-responsive">
	<table class="table" id="<?php echo $table_name?>">
		<thead>
			<tr>
				<th>#</th>			
				<?php foreach($fields as $field_name => $field_display): ?>
				<th><?php echo $field_display; ?></th>
				<?php endforeach; ?>
			</tr>
		</thead>

		<tbody>
			<?php 
			$index = 0;
			foreach($rows as $row): 
			?>
			<tr>
				<th scope="row"> <?php echo ++$index; ?> </th>
				<?php foreach($fields as $field_name => $field_display): ?>
				<td><?php echo $row->$field_name; ?></td>
				<?php endforeach; ?>
			</tr>
			<?php endforeach; ?>			
		</tbody>
	</table>
</div>