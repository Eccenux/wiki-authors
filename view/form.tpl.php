<style>
/* form */
label {
	display: block;
}
#page_name {
	padding: .3em;
	min-width: 40ch;
	font-size: 110%;
}
</style>

<h2><?= L('Full list of authors') ?></h2>
<form action="" method="GET">
	<label for="page_name"><?= L('Page') ?>:</label>
	<?php if (!empty($_GET['user_lang'])): ?>
		<input type="hidden" name="user_lang" value="<?= htmlspecialchars($_GET['user_lang']) ?>">
	<?php endif; ?>
	<input type="text" id="page_name" name="page_name" required>
	<p><input type="submit" value="<?= L('Authors list') ?>">
</form>

<?php if (!empty($strDieMessage)): ?>
	<h2><?= L('Information') ?></h2>
	<?=$strDieMessage?>
<?php endif; ?>
