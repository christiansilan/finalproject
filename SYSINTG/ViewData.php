<?php
	session_start();
	if($_SESSION['currUser']==null) {
		header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/Login.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>View Data</title>
	<link rel="stylesheet" href="http://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="http://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
	<script>
	$(document).ready(function(){
    $('#studentData').DataTable();
	});
	</script>
</head>
<body>

<form name="Login" method="post" action="" >
	<input type="submit" name="logout" value="Logout"><br><br>
	<input type="submit" name="all" value="View All Data"> <br>
	
	<input type="checkbox" name="sortType" value="getAgeRange">
	View Age range from: <input type="text" name="age1" size=2> to: <input type="text" name="age2" size=2>
	<input type="submit" name="ageRange" value="Go"><br>
	
	<input type="checkbox" name="sortType" value="sortByUniversity">
	Sort by University:
	<select name="sortedUniversity">
		<option value="Ateneo De Manila University">Ateneo De Manila University</option>
		<option value="De La Salle University">De La Salle University</option>
		<option value="Lyceum of the Philippines University">Lyceum of the Philippines University</option>
		<option value="Mapua Institute of Technology">Mapua Institute of Technology</option>
		<option value="STI">STI</option>
		<option value="University of Santo Tomas">University of Santo Tomas</option>
		<option value="University of the Philippines">University of the Philippines</option>
	</select>
	<input type="submit" name="univSort" value="Go"> <br>
	
	<input type="checkbox" name="sortType" value="computeTotalStudents">
	Compute total students in university:
	<select name="computedUniversity">
		<option value="Ateneo De Manila University">Ateneo De Manila University</option>
		<option value="De La Salle University">De La Salle University</option>
		<option value="Lyceum of the Philippines University">Lyceum of the Philippines University</option>
		<option value="Mapua Institute of Technology">Mapua Institute of Technology</option>
		<option value="STI">STI</option>
		<option value="University of Santo Tomas">University of Santo Tomas</option>
		<option value="University of the Philippines">University of the Philippines</option>
	</select>
	<input type="submit" name="univCompute" value="Go"><br>
</form>
<?php
	$mode=1;
	if(isset($_POST['logout'])) {
		header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/logout.php");
	}
	else if (isset($_POST['all'])) {
		$mode=1;
	}
	else if (isset($_POST['ageRange'])) {
		$mode=2;
	}
	else if (isset($_POST['univSort'])) {
		$mode=3;
	}
	else if (isset($_POST['univCompute'])) {
		$mode=4;
	}
?>
<table id="studentData" class="display" cellspacing="0" width="100%">
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
		if($mode==1)
			$sql = "SELECT studentId, firstName, surname, birthday, university FROM student";
		else if ($mode==2) {
			$sql = "SELECT studentId, firstName, surname, birthday, university FROM student WHERE FLOOR(DATEDIFF(CURDATE(), birthday)/365.24) >= {$_POST['age1']} AND FLOOR(DATEDIFF(CURDATE(), birthday)/365.24) <= {$_POST['age2']}";
		}
		else if ($mode==3) {
			$sql = "SELECT studentId, firstName, surname, birthday, university FROM student WHERE university='{$_POST['sortedUniversity']}'";
		}
		else if ($mode==4) {
			$sql = "SELECT studentId, firstName, surname, birthday, university FROM student WHERE university='{$_POST['computedUniversity']}'";
			
			$sqlCount = "SELECT COUNT(university) as 'totalStudents' FROM student WHERE university='{$_POST['computedUniversity']}'";
			$resultCount = $conn->query($sqlCount);
			$rowCount = $resultCount->fetch_assoc();
			$totalStudents = $rowCount['totalStudents'];
			echo "Total Students: ".$totalStudents;
		}
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				echo"<tr>";
				$firstName = $row['firstName'];
				$surname = $row['surname'];
				
				//Birthday format convertion
				$birthday = $row['birthday'];
				$birthdayText = date("M j, Y", strtotime($birthday));
				
				//Age computation
				$birthDate = date("m/d/Y", strtotime($birthday));
				$birthDate = explode("/", $birthDate);
				$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
					? ((date("Y") - $birthDate[2]) - 1)
					: (date("Y") - $birthDate[2]));
					
				$university = $row['university'];
				echo "<td>{$row['firstName']}</td>";
				echo "<td>{$row['surname']}</td>";
				echo "<td>{$birthdayText}</td>";
				echo "<td>{$age}</td>";
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