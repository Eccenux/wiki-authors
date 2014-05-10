
</div>
<div id="footer">
	<p>Copyright &copy;2011 Maciej Jaros (pl:User:Nux, en:User:Nux)</p>
	<? if (!empty($arrTicks)) { ?>
		<div id="ticks">
			<?=L('Execution times')?> [s]:
			<ul>
				<? foreach ($arrTicks as $strTickName=>$intDurtation) { ?>
					<li><?=sprintf("<em>%s</em> %.4f", $strTickName, $intDurtation)?></li>
				<? } ?>
			</ul>
		</div>
	<? } ?>
</div>
</body>
</html>