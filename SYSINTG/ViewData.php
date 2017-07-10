<!DOCTYPE html>
<html>
<head>
	<title>View Data</title>
	<link rel="stylesheet" href="http://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="http://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
	<script>
	$(document).ready(function(){
    $('#example').DataTable();
	});
	</script>
</head>
<body>


<table id="example" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Birthday</th>
            <th>Age</th>
            <th>University</th>
        </tr>
    </thead>
    <tbody>
		<?php 
		include 'dbconnection.php'; 
		$sql = "SELECT studentId, firstName, surname, birthday, university FROM student";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				echo"<tr>";
				$firstName = $row['firstName'];
				$surname = $row['surname'];
				$birthday = $row['birthday'];
				$age = "";
				$university = $row['university'];
				echo "<td>{$row['firstName']}</td>";
				echo "<td>{$row['surname']}</td>";
				echo "<td>{$row['birthday']}</td>";
				echo "<td> 10 </td>";
				echo "<td>{$row['university']}</td>";
			
				echo "</tr>";
			}
		} else {
			echo "0 results";
		}
		?>
    </tbody>
</table>




</body>
</html>