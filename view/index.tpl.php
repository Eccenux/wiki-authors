
<table>
	<thead>
		<tr>
			<th><?=L('Author')?></th>
			<th><?=L('Number of edits')?></th>
			<th><?=L('Total length')?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($arrAuthors as &$rowStat) { ?>
			<tr>
				<td>
					<?php if (!empty($rowStat['user_name'])) { ?>
						<a href="<?=$strPageBaseURL?>User:<?=$rowStat['user_name']?>"><?=strtr($rowStat['user_name'],'_',' ')?></a>
					<?php } else { ?>
						<i>?</i>
					<?php } ?>
				</td>
				<td><?=$rowStat['edits_num']?></td>
				<td><?=number_format($rowStat['total_len'], 0, '', ' ')?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>

<p><?=L('Authors:stats note')?></p>