<?php

	$res = @include("../main.inc.php"); 
	if(!$res) $res = @include("../../main.inc.php"); // From htdocs directory
	
	
	
	$file = strtr( SYSLOG_FILE,array(
		'DOL_DATA_ROOT'=>DOL_DATA_ROOT
	));
	
	$showError = isset($_REQUEST['showError']);
	
	$nb_ligne = ($showError) ? 50000:500;
	
	$TResult=array();
	exec('tail --lines '.$nb_ligne.' '.$file, $TResult);
	
	/* Sous windows ?
	 * $f1 = fopen($file,'r');
	
	$position = filesize($file); 
	
	fseek($f1, $position-1000);
	
	while(!feof($f1)) {
		$TResult[] =fgets($f1);
	}
	fclose($f1);
	
	print_r($TResult);
	*/
	$ToShow = array();
	
	foreach($TResult as $row) {
		
		$row_test=strtolower($row);
		if(strpos($row_test,'failed')!==false || strpos($row_test,'error')!==false) {
			$color='red';
		}
		else if(strpos($row_test,'sql')!==false || strpos($row_test,'select')!==false) {
			$color='green';
		}
		else {
			$color='black';
		}
		
		if(!$showError || $color=='red') {
			$ToShow[] = '<div style="padding-bottom:2px; color:'.$color.'"><span style="color:blue;">'.substr($row,0,19).'</span>'.substr($row,19).'</div>';	
		}
		
		
		
	}
	
	
?><html>
	<head>
		<style>
			body {
				font-family: "Arial, Helvetica, sans-serif";
				font-size: 9px;
				
			}
			
		</style>

	</head>
<body>
	<?php
	
	print implode("<br />", $ToShow);
	
	?>
	<script type="text/javascript">
		window.scrollTo(0,document.body.scrollHeight);
	</script>
</body>
</html><?php	
	
	
	