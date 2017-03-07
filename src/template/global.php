<div class="dumper">
	<?php $templateContent = $templateVar->getContent(); ?>
	<?=$templateContent?>
	<div>
		<small>Called line <?=$templateVar->backtrace->getLine()?> of <?=$templateVar->backtrace->getFile()?></small>
	</div>
</div>
