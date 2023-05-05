<div class="pagination pagination-centered">
	<ul>
		<li class="<?=($_REQUEST['pag'] == 1) ? "disabled" : ""?>"><a
			href="?pag=<?=$_REQUEST['pag']-1?>">&lt; Anterior</a></li>
<?php
for ($i = 1; $i <= $numPags; $i ++) {
    ?>
		<li class="page-item <?=($_REQUEST['pag'] == $i) ? "disabled" : ""?>"><a
			href="?pag=<?=$i?>"><?=$i?></a></li>
<?php
}
?>
		<li class="<?=($_REQUEST['pag'] == $numPags) ? "disabled" : ""?>"><a
			href="?pag=<?=$_REQUEST['pag']+1?>">Próximo &gt;</a></li>
	</ul>
	<!-- /.pagination -->
</div>