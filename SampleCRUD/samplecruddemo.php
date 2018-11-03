<?php

$errors = "";
$errors2 = "";
$db = mysqli_connect('localhost','root','','samplecruddemo');

$update = false;
if(isset($_POST['insertdata'])){
	$firstname = mysql_real_escape_string($_POST['firstname']);
	$lastname = mysql_real_escape_string($_POST['lastname']);
	$gender = mysql_real_escape_string($_POST['gender']);
	$emailaddress = mysql_real_escape_string($_POST['emailaddress']);
	//echo("<script>console.log('PHP: ".$gender."');</script>");
	
    if(empty($firstname) || empty($lastname) || empty($gender) || empty($emailaddress)){
		$errors = "<div class='errorcss'><center>All the fields should not be blank</center></div>";
	}
	
	else if(!filter_var($emailaddress, FILTER_VALIDATE_EMAIL)){
		$errors = "<div class='errorcss'><center>Email address is not validate</center></div>";
	}
	
	else{
		$sql = "INSERT INTO user (firstname, lastname, gender, emailaddress) VALUES ('$firstname', '$lastname', '$gender', '$emailaddress')";
		mysqli_query($db, $sql);
		$errors = "<div class='successcss'><center>Your data was inserted to Database</center></div>";
	}
}

if(isset($_POST['updatedata'])){
	$updateidnumber = mysql_real_escape_string($_POST['updateidnumber']);
	$updatefirstname = mysql_real_escape_string($_POST['updatefirstname']);
	$updatelastname = mysql_real_escape_string($_POST['updatelastname']);
	$updategender = mysql_real_escape_string($_POST['updategender']);
	$updateemailaddress = mysql_real_escape_string($_POST['updateemailaddress']);
	
	if(empty($updateidnumber) || empty($updatefirstname) || empty($updatelastname) || empty($updategender) || empty($updateemailaddress)){
		$errors2 = "<div class='errorcss'><center>UPDATE FAILED: All the fields should not be blank</center></div>";
	}
	
	else if(!filter_var($updateemailaddress, FILTER_VALIDATE_EMAIL)){
		$errors2 = "<div class='errorcss'><center>UPDATE FAILED: Email address is not validate</center></div>";
	}
	
	else{
		$selectsql = mysqli_query($db, "SELECT * FROM user WHERE id=$updateidnumber");
		$row = mysqli_fetch_array($selectsql);
		if($row['id'] == $updateidnumber){
			//echo "TRUE";
			$updatesql = "UPDATE user SET firstname = '$updatefirstname', lastname = '$updatelastname', gender = '$updategender', emailaddress = '$updateemailaddress'
			WHERE id = $updateidnumber";
			mysqli_query($db, $updatesql);
			
			$errors2 = "<div class='successcss'><center>UPDATE SUCCESS:  The ID that you type is matched from the ID number table</center></div>";
		}
		else{
			//echo "FALSE";
			$errors2 = "<div class='errorcss'><center>Update Failed: The Item ID that you type does not match the Item ID's from the table</center></div>";
		}
	}
}

if(isset($_GET['update'])){
	//echo("<script>console.log('PHP: UPDATE');</script>");
	$update = true;
	$id = $_GET['update'];
	$record = mysqli_query($db, "SELECT * FROM user WHERE id=$id");
	if(count($record) == 1){
		$fetch = mysqli_fetch_array($record);
		$id = $fetch['id'];
		$firstname = $fetch['firstname'];
		$lastname = $fetch['lastname'];
		$gender = $fetch['gender'];
		$emailaddress = $fetch['emailaddress'];
	}
}

if(isset($_GET['delete'])){
	//echo("<script>console.log('PHP: ".$gender."');</script>");//echo("<script>console.log('PHP: ".$gender."');</script>");echo("<script>console.log('PHP: DELETE');</script>");
	$id = $_GET['delete'];
	$sql = "DELETE FROM user WHERE id=$id";
	mysqli_query($db, $sql);
}

if(isset($_POST['search'])){
    $valuesearch = $_POST['searching'];
	$query = "SELECT * FROM user WHERE CONCAT(firstname, lastname) LIKE '%".$valuesearch."%'";
	$result = mysqli_query($db, $query);
}

else{
	$query = "SELECT * FROM user";
	$result = mysqli_query($db, $query);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<title>SAMPLE CRUD (PROCEDURAL)</title>
<meta name = "viewport" content = "width = device-width, initial-scale = 1">      
<link rel = "stylesheet"
href = "https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel = "stylesheet"
href = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
<script type = "text/javascript"
src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>           
<script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script> 
<script type="text/javascript">
   $(document).ready(function(){
     $('select').material_select();
   });
</script>
</head>
<style>
.errors{
	font-size: 30px;
}

.errorcss{
	width: 92%;
	margin: 0px auto;
	padding: 10px;
	border: 1px solid #a94442;
	color: #a94442;
	background: #f2dede;
	border-radius: 5px;
	text-align: left;
}

.successcss{
	width: 92%;
	margin: 0px auto;
	padding: 10px;
	border: 1px solid #27db4b;
	color: #27db4b;
	background: #f2dede;
	border-radius: 5px;
	text-align: left;
}


table {
  display: inline-grid;
  grid-template-areas: 
  "head-fixed" 
  "body-scrollable";
}

thead {
  grid-area: head-fixed;
  background-color: white;
}

tbody {
  grid-area: body-scrollable;
  background-color: white;
  overflow: auto;
  height: 500px;
}

th, td {
  padding: 5px 10px;
  text-align: left;
  border: 1px solid #ccc;
}

th:nth-child(1), td:nth-child(1) {
    min-width: 75px;
}

th:nth-child(2), td:nth-child(2){
    min-width: 120px;
}

th:nth-child(3), td:nth-child(3){
  min-width: 120px;
}

th:nth-child(4), td:nth-child(4){
  min-width: 75px;
}

th:nth-child(5), td:nth-child(5){
  min-width: 250px;
}

th:nth-child(6), td:nth-child(6){
  min-width: 320px;
}

</style>
<body>
<nav>
  <div class="nav-wrapper">
   <a href="#" class="brand-logo center" style="font-size: 1.0em;"><h4>SAMPLE CRUD (PROCEDURAL)</h4></a>
  </div>
</nav>
<div class="row">
  <div class="input-field col s3">
    <form action="samplecruddemo.php" method="POST">
	  <center><b><?php echo $errors;?></b></center>
	  <h5><center>Add Names from the List</center></h5><br/>
	  First Name: <input type="text" name="firstname" placeholder="Enter First Name" onkeypress="return isAlphaKey(event)" />
	  Last Name: <input type="text" name="lastname" placeholder="Enter Last Name" onkeypress="return isAlphaKey(event)" />
	  Gender: <select name="gender">
	  <option value="">Select Gender</option>
	  <option value="Male">Male</option>
	  <option value="Female">Female</option>
      </select>
	  Email Address: <input type="text" name="emailaddress" placeholder="Enter Email Address">
	  <center><button class="waves-effect waves-light btn" name="insertdata">Submit</button></center>
	</form>
  </div>
  
  <div class="input-field col s9">
     <form action="samplecruddemo.php" method="POST">
	   <div class="row">
	     <div class="input-field col s6">
		   <input type="text" name="searching" placeholder="Search First Name and Last Name" onkeypress="return isAlphaKey(event)"/>
		 </div>
		 <div class="input-field col s6">
           <button class="waves-effect waves-light btn" name="search">Search</button>
         </div>
	   </div>
	   <div class="row">
	     <div class="input-field col s6">
		   <table id="">
		     <thead>
			   <tr>
			     <th><center>ID</center></th>
				 <th><center>First Name</center></th>
				 <th><center>Last Name</center></th>
				 <th><center>Gender</center></th>
				 <th><center>Email Address</center></th>
				 <th><center>Update/Delete</center></th>
			   </tr>
			 </thead>
			 <tbody>
			   <?php
			     while($row = mysqli_fetch_array($result)){
					 echo "<tr>";
					 echo "<td><center>".$row['id']."</center></td>";
					 echo "<td><center>".$row['firstname']."</center></td>";
					 echo "<td><center>".$row['lastname']."</center></td>";
					 echo "<td><center>".$row['gender']."</center></td>";
					 echo "<td><center>".$row['emailaddress']."</center></td>";
					 echo "<td><center><a class='waves-effect waves-light btn' href='samplecruddemo.php?update=$row[id]'>UPDATE</a>
			         <a class='waves-effect waves-light btn' href='samplecruddemo.php?delete=$row[id]'>DELETE</a></center></td>";
				 }
			   ?>
			 </tbody>
		   </table>
		 </div>
	   </div>
	 </form>
	 <?php echo $errors2 ?>
	 <?php 
	 if($update==true){
	 ?>
	   <h5>Update Names from the List</h5>
	   <form action="" method="POST">
	     <div class="row">
		   <div class="input-field col s3">
		     Update ID Number: <input type="text" name="updateidnumber" placeholder="Enter ID Number" value="<?php echo $id ?>" onkeypress="return isNumberKey(event)">
		   </div>
		   <div class="input-field col s3">
		     Update First Name: <input type="text" name="updatefirstname" placeholder="Enter First Name" value="<?php echo $firstname ?>" onkeypress="return isAlphaKey(event)">
		   </div>
		   <div class="input-field col s3">
		     Update Last Name: <input type="text" name="updatelastname" placeholder="Enter Last Name" value="<?php echo $lastname ?>" onkeypress="return isAlphaKey(event)">
		   </div>
		   <div class="input-field col s3">
		     Update Gender: <select name="updategender">
			 <option value="">Select Gender</option>
			 <option value="Male">Male</option>
			 <option value="Female">Female</option>
			 </select>
		   </div>
		 </div>
		 <div class="row">
		   <div class="input-field col s3">
		     Update Email Address: <input type="text" name="updateemailaddress" placeholder="Enter Email Address" value="<?php echo $emailaddress ?>">
		   </div>
		 </div>
		 <div class="row">
		   <div class="input-field col s3">
             <button class="waves-effect waves-light btn" name="updatedata">Update Name</button>
           </div>
		 </div>
	   </form>
	 <?php
	 }
	 else{
	 ?>
	   <h5>Update Names from the List</h5>
	   <form action="" method="POST">
	     <div class="row">
		   <div class="input-field col s3">
		     Update ID Number: <input type="text" name="updateidnumber" placeholder="Enter ID Number" onkeypress="return isNumberKey(event)">
		   </div>
		   <div class="input-field col s3">
		     Update First Name: <input type="text" name="updatefirstname" placeholder="Enter First Name" onkeypress="return isAlphaKey(event)">
		   </div>
		   <div class="input-field col s3">
		     Update Last Name: <input type="text" name="updatelastname" placeholder="Enter Last Name" onkeypress="return isAlphaKey(event)">
		   </div>
		   <div class="input-field col s3">
		     Update Gender: <select name="updategender">
			 <option value="">Select Gender</option>
			 <option value="Male">Male</option>
			 <option value="Female">Female</option>
			 </select>
		   </div>
		 </div>
		 <div class="row">
		   <div class="input-field col s6">
		     Update Email Address: <input type="text" name="updateemailaddress" placeholder="Enter Email Address">
		   </div>
		 </div>
		 <div class="row">
		   <div class="input-field col s3">
             <button class="waves-effect waves-light btn" name="updatedata">Update Name</button>
           </div>
		 </div>
	   </form>
	  <?php
	  }
	  ?>
  </div>
</div>
</body>
<script>
function isAlphaKey(evt) {
   var keyCode = (evt.which) ? evt.which : evt.keyCode
     if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)
        return false;
       return true;
};
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
       return false;
     return true;
};
</script>
</html>