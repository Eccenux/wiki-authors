<p><a href="<?=$strPageBaseURL?>?oldid=<?=$numOldId?>" target="_blank" rel="noopener"><?=L('Page')?></a></p>

<p><?=L('Authors:stats note')?></p>

<?php if (!empty($arrAuthors)) { ?>
<p><strong><?=L('Authors list')?></strong>: 
<?php
	$names = array_column($arrAuthors, 'user_name');
	echo implode(', ', $names);
?>.
</p>
<?php } ?>

<table>
	<thead>
		<tr>
			<th><?=L('Author')?></th>
			<th><?=L('Number of edits')?></th>
			<th><?=L('Total bytes changed')?></th>
			<th><?=L('Bytes changed')?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($arrAuthors as &$rowStat) { ?>
			<tr>
				<td>
					<?php if (!empty($rowStat['user_name'])) { ?>
						<a href="<?=$strPageBaseURL?>User:<?=urlencode($rowStat['user_name'])?>"><?=htmlspecialchars( strtr($rowStat['user_name'],'_',' ') )?></a>
					<?php } else { ?>
						<i>?</i>
					<?php } ?>
				</td>
				<td><?=$rowStat['edits_num']?></td>
				<td><?=number_format($rowStat['total_len'], 0, '', ' ')?></td>
				<td><?=$rowStat['bytes_changed']?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>
