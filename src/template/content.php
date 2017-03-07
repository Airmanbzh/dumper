<div class="resume <?php if ($templateVar->isTraversable()) { ?>complex<?php } ?>">
	<div>
		<?php if (!is_null($templateVar->getKey())){?>
			<span class="key"><?=$templateVar->getKey()?></span>
		<?php } ?>
		<em><?=$templateVar->getShortDescription()?></em>
		<samp><?=$templateVar->getDescription()?></samp>
	</div>
<?php if ($templateVar->isTraversable()) { ?>
	<ul>
		<?php foreach ($templateVar->getVar() as $key => $content) { ?>
			<li>
				<?=new \Dumper\Content($content, $key)?>
			</li>
		<?php } ?>
	</ul>
<?php } ?>
</div>