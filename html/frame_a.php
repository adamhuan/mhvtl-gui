<html>
<head><title>MHVTL Web Console</title></head>
<link href="styles.css" rel="stylesheet" type="text/css">
<body>
<hr width="100%" size=10 color="blue">
<?php $output = `sudo -u root -S cat ../version`;?>
<FONT COLOR=#000000 ><b>Console: </FONT><FONT COLOR=#008000><?php echo $output ;?></FONT></b>


<hr width="100%" size=1 color="blue">

<tr>
<td>
<img src="images/tux.png" ALIGN="middle" ><b><FONT COLOR=blue size=4> Virtual Tape Library System</FONT></b>
</td>
</tr>
<?php $output = shell_exec('sudo -u root -S ../scripts/os_release.sh');?>
<pre><b><FONT COLOR=#000000><?php echo $output ;?></FONT></b></pre>


<script type="text/javascript">
var ray={
ajax:function(st)
	{
		this.show('load');
	},
show:function(el)
	{
		this.getID(el).style.display='';
	},
getID:function(el)
	{
		return document.getElementById(el);
	}
}
</script>

<div id="load" style="display:none;"><img src="images/loading.gif" border=0></div>


<table border="0" width="470"  >
<td>
<form action="confirm.start_mhvtl.php" method="post" onsubmit="return ray.ajax()">
<input TYPE="submit" class="sameSize" style="color: #008000" value=" Start ">
</form>
</td>

<td>
<form action="confirm.stop_mhvtl.php" method="post" onsubmit="return ray.ajax()">
<input TYPE="submit" class="sameSize" style="color: #FF0000" value=" Stop ">
</form>
</td>


<td>
<form action="activity.php" method="post" onsubmit="return ray.ajax()">
<input TYPE="submit" class="sameSize" style="color: #000000" value=" Activity ">
</form>
</td>


<td>
<form action="monitor.php" method="post" onsubmit="return ray.ajax()">
<input TYPE="submit" class="sameSize" style="color: #000000" value=" Monitor " >
</form>
</td>



</table>
<br>

<TABLE BORDER='1' CELLSPACING='4' CELLPADDING='4' style="background-color: #000000" BORDERCOLOR=grey >

<TR>
<TD>
<div style="overflow:auto;height:140px;width:450px;" id="ReloadThis" >
<?php
include 'fdisplay.php' ;
?>
</div>
</table>

<br>
<td>
<form action="frame_a.php" method="post" onsubmit="return ray.ajax()">
<input TYPE="submit" style="color: #000000" value=" Refresh ">
</form>
</td>
<br>

<table>
<?php
$output = shell_exec('DEVICES=`sudo -u root -S ../scripts/plot_devices.sh`; if [ ! -z "$DEVICES" ]; then echo "$DEVICES";fi');
echo "<pre><p style=\"text-align:left;\"><b>$output</b></p></pre>";
?>
</table>

<div style="overflow:auto;height:110px;width:550px;float:left;" >
<?php
if (!file_exists('/tmp/mhvtl.last.update.check'))
{
$output = shell_exec('touch -t 200001010000.00 /tmp/mhvtl.last.update.check');
}
?>

<?php
if (!file_exists('/tmp/mhvtl-gui.last.update.check'))
{
$output = shell_exec('touch -t 200001010000.00 /tmp/mhvtl-gui.last.update.check');
}
?>

<?php
$output = shell_exec('LASTCHECK=`find /tmp/mhvtl.last.update.check -mtime +1`; if [ ! -z "$LASTCHECK" ]; then CHECKU=`sudo -u root -S ../scripts/check_update.sh| grep -v "MHVTL is up-to-date"`; if [ ! -z "$CHECKU" ] ; then echo "<img src="images/animated_alert.gif" /> $CHECKU" ;fi;
fi');
echo "<pre>$output</pre>";
?>

<?php
$output = shell_exec('LASTCHECK=`find /tmp/mhvtl-gui.last.update.check -mtime +1`; if [ ! -z "$LASTCHECK" ]; then CHECKU=`sudo -u root -S ../scripts/check_gui.update.sh| grep -v "MHVTL-GUI is up-to-date"`;if [ ! -z "$CHECKU" ] ; then echo "<img src="images/animated_alert.gif" /> $CHECKU";fi;
fi');
echo "<pre>$output</pre>";
?>
</div>

</body>
</html>
