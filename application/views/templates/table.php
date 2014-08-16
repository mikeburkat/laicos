<div>

<table align="center" class="table table-striped" style="width: 80%">
<?php

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