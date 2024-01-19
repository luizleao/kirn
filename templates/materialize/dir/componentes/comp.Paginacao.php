<ul class="pagination center">
	<li class="waves-effect <?=($_REQUEST['pag'] == 1) ? "disabled" : ""?>">
		<a href="?pag=<?=$_REQUEST['pag']-1?>"><i class="material-icons">chevron_left</i></a></li>
<?php
for ($i = 1; $i <= $numPags; $i ++) {
    ?>
	<li class="waves-effect <?=($_REQUEST['pag'] == $i) ? "active" : ""?>"><a
		href="?pag=<?=$i?>"><?=$i?></a></li>
<?php
}
?>
	<li class="waves-effect <?=($_REQUEST['pag'] == $numPags) ? "disabled" : ""?>"><a href="?pag=<?=$_REQUEST['pag']+1?>"><i class="material-icons">chevron_right</i></a></li>
</ul>