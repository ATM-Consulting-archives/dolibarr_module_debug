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

	$('#debug-trace').append('<iframe width="100%" frameborder="0" height="100%" src="<?=DOL_URL_ROOT_ALT.'/debugtrace/trace.php' ?>"></iframe>');
	
	$('#debug-trace').append('<a href="#" id="debug-open-close">Switch</a>');
	
	$('#debug-trace #debug-open-close').click(function() {
		if( parseInt($('#debug-trace').css('height'))>100 ) $('#debug-trace').css('height','20px');
		else  $('#debug-trace').css('height','500px');
	});
	
	$('#debug-trace #debug-open-close').css({
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


