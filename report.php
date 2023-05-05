<?php
require_once ("classes/Autoload.php");
$oController = new Controller();
$xml = $_REQUEST['xml'];
$settings = $oController->getSettings();
$aDatabase = Project::getInfoProject(dirname(__FILE__) . "/xml/$xml.xml");

$aDatabase['totalPf'] = (int) $aDatabase['totalPf'];
$valorProjeto = Util::formataMoeda($aDatabase['totalPf'] * $settings['settings']['valorPf']);
$prazoEntrega = (int) round($aDatabase['totalPf'] / $settings['settings']['prodEquipe']);
?>
<!doctype html>
<html lang="pt">
<head>
	<?php include_once("includes/header.php");?>
</head>
<body class="teal lighten-5">
	<?php include_once("includes/menu.php");?>
	<?php include_once("includes/loading.php");?>
	<main class="container light">
		<blockquote class="border">
			<a href="./">Home</a> > Project Report
		</blockquote>
		<div class="row">
			<div class="col s12">
				<ul class="tabs hoverable">
					<li class="tab col s3 teal-text text-lighten-2"><a class="active"
						href="#test1">Data Project</a></li>
					<li class="tab col s3 teal-text text-lighten-2"><a href="#test2">Tables</a></li>
					<li class="tab col s3 teal-text text-lighten-2"><a href="#test3">Burndown
							Chart</a></li>
				</ul>
			</div>
			<div id="test1" class="col s12">
				<div class="card hoverable">
					<div class="card-content">
						<span class="card-title">Project <?=$xml?></span>
						<div class="row">
							<div class="col s4">
								<label class="teal-text lighten-2-text">Front-End Framework</label>
								<div><?=$aDatabase['frontEnd']?></div>
							</div>
							<div class="col s4">
								<label class="teal-text lighten-2-text">Back-End Framework</label>
								<div><?=$aDatabase['backEnd']?></div>
							</div>
						</div>
						<div class="row">
							<div class="col s4">
								<label class="teal-text lighten-2-text">Project Effort Measure
									(FP)</label>
								<div><?=$aDatabase['totalPf']?></div>
							</div>
							<div class="col s4">
								<label class="teal-text lighten-2-text">Function Point Cost (R$)</label>
								<div><?=$settings['settings']['valorPf']?></div>
							</div>
							<div class="col s4">
								<label class="teal-text lighten-2-text">Created Project Cost
									(R$)</label>
								<div><?=$valorProjeto?></div>
							</div>
						</div>
						<div class="row">
							<div class="col s4">
								<label class="teal-text lighten-2-text">Number of Lines
									Generated</label>
								<div><?=$aDatabase['numLineCode']?></div>
							</div>
							<div class="col s4">
								<label class="teal-text lighten-2-text">Team Productivity
									(FP/Day)</label>
								<div><?=$settings['settings']['prodEquipe']?></div>
							</div>
							<div class="col s4">
								<label class="teal-text lighten-2-text">Time Estimate (Days)</label>
								<div><?=$prazoEntrega?></div>
							</div>
						</div>
						<div class="row">
							<div class="col s12">
								<a href="geradas/<?=$xml?>" class="btn btn-block"
									target="_blank">Open Project</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="test2" class="col s12">
				<div class="card hoverable">
					<div class="card-content">
						<span class="card-title">Tables</span>
        				<?php foreach($aDatabase as $aTabela){?>
            				<blockquote>
            					<?=$aTabela['schema']?>.<?=$aTabela['name']?>
            					<label>Type:</label> <?=$aTabela['type']?>
            				</blockquote>
						<table class="striped">
							<thead>
								<tr>
									<td class="light teal-text lighten-2-text">Name</td>
									<td class="light teal-text lighten-2-text">Type</td>
									<td class="light teal-text lighten-2-text">Null</td>
									<td class="light teal-text lighten-2-text">PK</td>
									<td class="light teal-text lighten-2-text">AI</td>
									<td class="light teal-text lighten-2-text">FK Table</td>
									<td class="light teal-text lighten-2-text">FK Column</td>
								</tr>
							</thead>
							<tbody>
                    			<?php foreach($aTabela as $sCampo){?>
                    			<tr>
									<td><?=$sCampo['name']?></td>
									<td><?=$sCampo['type']?></td>
									<td><?=$sCampo['null']?></td>
									<td><?=$sCampo['pk']?></td>
									<td><?=$sCampo['ai']?></td>
									<td><?=($sCampo['fkTable'] !='') ? $sCampo['fkTable'] : "-"?></td>
									<td><?=($sCampo['fkColumn'] !='') ? $sCampo['fkColumn'] : "-"?></td>
								</tr>
                    			<?php } ?>
                    			</tbody>
						</table>
                		<?php }?>
                		<blockquote>Number of Tables: <?=count($aDatabase)?></blockquote>
					</div>
				</div>
			</div>
			<div id="test3" class="col s12">
<?php
$actualArray = [
    (int) $aDatabase['totalPf'],
    $aDatabase['totalPf'] - 2,
    $aDatabase['totalPf'] - 20,
    $aDatabase['totalPf'] / 2,
    $aDatabase['totalPf'] / 4,
    $aDatabase['totalPf'] / 6
];

$idealArray = range(0, (int) $aDatabase['totalPf'], $settings['settings']['prodEquipe']);
$idealArray[count($idealArray) - 1] = (int) $aDatabase['totalPf'];

$idealXArray = [];
for ($i = 0; $i <= $prazoEntrega; $i ++) {
    $idealXArray[] = 'Day ' . $i;
}

?>
<?php include_once("includes/js.php");?>
<script>
$(document).ready(function() {

function loadBurningDown(){
	$('#container-burndown').highcharts({
	    title: {
	      text: 'Burndown Chart - <?=$xml?>',
	      x: -10 //center
	    },
		scrollbar: {
	                barBackgroundColor: 	'gray',
	                barBorderRadius: 		7,
	                barBorderWidth: 		0,
	                buttonBackgroundColor: 'gray',
	                buttonBorderWidth: 		0,
	                buttonBorderRadius: 	7,
	                trackBackgroundColor: 	'none',
	                trackBorderWidth: 		1,
	                trackBorderRadius: 		8,
	                trackBorderColor: 		'#CCC'
	            },
	    colors: ['blue', 'red'],
	    plotOptions: {
	      line: {
	        lineWidth: 3
	      },
	      tooltip: {
	        hideDelay: 200
	      }
	    },
	    subtitle: {
	      text: 'Summary of project follow-up',
	      x: -10
	    },
	    xAxis: {
	      categories: <?=json_encode($idealXArray);?>
	    },
	    yAxis: {
	      title: {
	        text: 'Backlog Requirement (FP)'
			
	      },
		 type: 'linear',
		 max:<?=$aDatabase['totalPf']?>,
		 min:0,
		 tickInterval :<?=$settings['settings']['prodEquipe']?>
		 
	    },
		
	    tooltip: {
	      valueSuffix: ' FPs',
	      crosshairs: true,
	      shared: true
	    },
	    legend: {
	     layout: 'horizontal',
	      align: 'center',
	      verticalAlign: 'bottom',
	      borderWidth: 0
	    },
	    series: [{
	      name: 'Estimated',
	      color: 'rgba(255,0,0,0.25)',
	      lineWidth: 2,
		  
	      data: <?= json_encode(array_reverse($idealArray));?>}, 
	      {
	      name: 'Executed',
	      color: 'rgba(0,120,200,0.75)',
	      marker: {
	        radius: 6
	      },
	      data: eval('[' + $("#dailyEffort").val() + ']')}]
	      
	      //data: <?=json_encode($actualArray);?>}]
	  });
	}

	loadBurningDown();

	$("#dailyEffort").on("keyup", function (){
		loadBurningDown();
	});
});

function converteS2O(text){
	var obj = eval('[' + text+ ']'); //JSON.parse("["+text+"]");
	console.log(obj);
}
</script>
				<div class="card hoverable">
					<div class="card-content">
						<div class="input-field">
							<input type="text" class="" id="dailyEffort" name="dailyEffort"
								value="" /> <label for="login">Daily Effort</label>
						</div>
						<div id="container-burndown"
							style="align: center; max-width: 610px; height: 400px;"></div>
					</div>
				</div>
			</div>
		</div>
	</main>
	<?php include_once("includes/footer.php");?>
	<?php include_once("includes/modals.php");?>
</body>
</html>