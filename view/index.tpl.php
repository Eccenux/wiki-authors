<!--
<form action="index.php" method="get">
	<input id="kal_val_godziny"	type="hidden" size="2" />
	<input id="kal_val_minuty"	type="hidden" size="2" />
	<input id="kal_val_sekundy"	type="hidden" size="2" />
		
	<input id="kal_val_rok"		name="Dy" type="text" size="4" />
	<input id="kal_val_miesiac"	name="Dm" type="text" size="2" />
	<input id="kal_val_dzien"	name="Dd" type="text" size="2" />

	<input type="submit" name="submit" />
</form>
-->

<table>
	<thead>
		<tr>
			<th><?=L('Author')?></th>
			<th><?=L('Number of edits')?></th>
			<th><?=L('Total length')?></th>
		</tr>
	</thead>
	<tbody>
		<? foreach ($arrAuthors as &$rowStat) { ?>
			<tr>
				<td>
					<? if (!empty($rowStat['user_name'])) { ?>
						<a href="<?=$strPageBaseURL?>User:<?=$rowStat['user_name']?>"><?=strtr($rowStat['user_name'],'_',' ')?></a>
					<? } else { ?>
						<i>?</i>
					<? } ?>
				</td>
				<td><?=$rowStat['edits_num']?></td>
				<td><?=$rowStat['total_len']?></td>
			</tr>
		<? } ?>
	</tbody>
</table>

<p><?=L('Authors:stats note')?></p>