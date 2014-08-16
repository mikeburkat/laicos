<div>

<p>
Select from one of the following options:
</p>
<form action="assignment1" method="post">
	<select name="option">
	<option value="0">Select everyone registered in the database</option>
	<option value="1">Select Percy Shelly</option>
	<option value="2">Select Percy Shelly's friends</option>
	<option value="3">Select Percy Shelly's son's friends</option>
	</select>
	<input type="submit" value="Go">
</form>

<table align="center" class="table table-striped" style="width: 80%">
<?php


$result = array();
foreach($tableData as $sub){
	$result = array_merge($result, $sub);
}
$headers = array_keys($result);
echo "<thead><tr>";
	
foreach($headers as $key){
	echo "<th>";
	echo $key;
	echo "</th>";
}
echo "</tr></thead>";
	
foreach($tableData as $row){

	echo "<tr>";
	foreach($row as $column){
		echo "<td>";
		echo $column;
		echo "</td>";
	}
	
	echo "</tr>";
}

?>
</table>
</div>