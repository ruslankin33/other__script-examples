<table>
<?php foreach($clients as $value) : ?>
	<tr>
		<td><?= $value['id']; ?></td>
		<td><?= $value['name']; ?></td>
		<td><?= $value['summLeads']; ?></td>
	</tr>
<?php endforeach; ?>
	<tr>
		<td style="text-align:right;" colspan="3"><?= $allSummLeads ?></td>
	</tr>
</table>
<style>
	table {
		border: 1px solid black;
	}

	td {
		padding-left: 15px;
		padding-right: 15px;
		border: 1px solid black;
	}
</style>