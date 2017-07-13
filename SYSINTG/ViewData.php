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
	Other view types: <br>
	
	<input type="checkbox" name="viewType[]" value="viewAgeRange">
	View Age range from: <input type="text" name="age1" size=2> to: <input type="text" name="age2" size=2>
	<br>
	<input type="checkbox" name="viewType[]" value="viewByUniversity">
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
	<br>
	<input type="submit" name="viewTypeSubmit" value="Go"> <br>
	<!--
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
	<input type="submit" name="univCompute" value="Compute"><br> -->
</form>
<?php
	$mode=1;
	$error="";
	$message="";
	if(isset($_POST['logout'])) {
		header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/logout.php");
	}
	else if (isset($_POST['all'])) {
		$mode=1;
		$message.="The list of students from all Universities";
	}
	else if (isset($_POST['viewTypeSubmit']) ) {
		if (isset($_POST['viewType'])) {
			$viewType = $_POST['viewType'];
			$arr = array();
			for($i = 0; $i < 2; $i++) {
				array_push($arr, 0);
			}
			for ($i = 0; $i <  count($_POST['viewType']); $i++) {
				 if($viewType[$i] == "viewAgeRange" ) {
					 $arr[0] = 1;
				 }
				 else if($viewType[$i] == "viewByUniversity" ) {
					 $arr[1] = 1;
				 }
			}
			
			//Checking
			if($arr[0] == 1 && $arr[1] == 1){
				$mode=4;
				$message.="The list of students ages ".$_POST['age1']." to ".$_POST['age2']." from ".$_POST['sortedUniversity'];
			}
			else if($arr[1] == 1) {
				$mode=3;
				$message.="The list of students from ".$_POST['sortedUniversity'];
			}
			else if($arr[0] == 1) {
				if(isset($_POST['age1']) && isset($_POST['age2'])) {
					if((!ctype_digit($_POST['age1']) || !ctype_digit($_POST['age2'])) || ($_POST['age1'] > $_POST['age2'])) {
						$error.="Error! Invalid input in age fields!";
						$message.="Viewing the list of students from all universities instead.";
					}
					else {
						$mode=2;
						$message.="The list of students ages ".$_POST['age1']." to ".$_POST['age2'];
					}
				}
				else {
					$error.="Error! Age fields left blank!";
					$message.="Viewing the list of students from all universities instead.";
				}
			}
			else 
				$mode=1;
			
			if($mode == 3 || $mode == 4) {
				include 'dbconnection.php';
				$sqlCount = "SELECT COUNT(university) as 'totalStudents' FROM student WHERE university='{$_POST['sortedUniversity']}'";
				$resultCount = $conn->query($sqlCount);
				$rowCount = $resultCount->fetch_assoc();
				$totalStudents = $rowCount['totalStudents'];
				$message.="<br>Total ".$_POST['sortedUniversity']." Students: ".$totalStudents;
			}
		}
		else {
			$error.="Error! No checkbox checked!";
			$message.="Viewing the list of students from all universities instead.";
		}
	}
	else {
		$mode=1;
		$message.="The list of students from all Universities";
	}
	/*
	else if (isset($_POST['univCompute'])) {
		$mode=5;
		include 'dbconnection.php';
		$sqlCount = "SELECT COUNT(university) as 'totalStudents' FROM student WHERE university='{$_POST['computedUniversity']}'";
		$resultCount = $conn->query($sqlCount);
		$rowCount = $resultCount->fetch_assoc();
		$totalStudents = $rowCount['totalStudents'];
		$message.="The list of students from ".$_POST['sortedUniversity'];
		$message.="<br>Total ".$_POST['sortedUniversity']." Students: ".$totalStudents;
	}*/
?>

<?php 
echo "<p>";
if($error!="") {
	echo "<br><font size='5' color='red'>".$error."<font size='3'>";
}
echo "<br><font size='5' color='black'>".$message."</p><font size='3'>";
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
			$sql = "SELECT studentId, firstName, surname, birthday, university FROM student WHERE university='{$_POST['sortedUniversity']}' AND FLOOR(DATEDIFF(CURDATE(), birthday)/365.24) >= {$_POST['age1']} AND FLOOR(DATEDIFF(CURDATE(), birthday)/365.24) <= {$_POST['age2']}";
		}
		/*
		else if ($mode==5) {
			$sql = "SELECT studentId, firstName, surname, birthday, university FROM student WHERE university='{$_POST['computedUniversity']}'";
		}*/	
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