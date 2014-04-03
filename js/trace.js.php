<?php
$res = @include("../../main.inc.php"); // From htdocs directory
if (! $res) {
    $res = @include("../../../main.inc.php"); // From "custom" directory
}

if (! empty($conf->global->MAIN_SYSLOG_DISABLE_FILE)) exit;

?>
function showDebugTrace() {
	
	$('body').append('<div id="debug-trace" title="Debug Trace"></div>');
	
	/*
	$('#debug-trace').dialog({
		position:'right bottom'
		
	});
	*/
	$('#debug-trace').css({
		position:'fixed'
		,bottom:0
		,right:'5px'
		,width:'500px'
		,height:'500px'
		,opacity:.8
		,backgroundColor:'#fff'
		,border:'1px solid #000'
	});

	$('#debug-trace').append('<iframe id="debug-iframe" width="100%" frameborder="0" height="100%" src="<?php echo dol_buildpath('/debugtrace/trace.php',1) ?>"></iframe>');
	
	$('#debug-trace').append('<div id="debug-options"><a href="#" id="debug-open-close">Switch</a> | <a href="#" id="debug-refresh">Refresh</a> | <a href="#" id="debug-show-error">Warning/Error</a></div>');
	
	$('#debug-trace #debug-open-close').click(function() {
		if( parseInt($('#debug-trace').css('height'))>100 ) $('#debug-trace').css('height','20px');
		else  $('#debug-trace').css('height','500px');
	});

	$('#debug-trace #debug-refresh').click(function() {
		var iframe = document.getElementById('debug-iframe');
		iframe.src ='<?php echo dol_buildpath('/debugtrace/trace.php',1) ?>';

	});
	
	$('#debug-trace #debug-show-error').click(function() {
		var iframe = document.getElementById('debug-iframe');
		iframe.src = '<?php echo dol_buildpath('/debugtrace/trace.php?showError=1',1) ?>';

	});
	
	$('#debug-trace #debug-options').css({
		position:'absolute'
		,top:0
		,right:20
		,backgroundColor:'#fff'
		,color:'blue'
	});

	
}

$(document).ready(function() {
	showDebugTrace();	
});


