<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }
    else{
if(isset($_POST['submit']))
{
$name=$_POST['name'];
$course=$_POST['course']; 
$department=$_POST['department']; 
$semester=$_POST['semester']; 
$email=$_POST['email']; 
$mobileNo=$_POST['mobileNo'];
$dob=$_POST['dob']; 

$sql="INSERT INTO  students(Name,Course,Department,Semester,Email,MobileNo,DOB) VALUES(:name,:course,:department,:semester,:email,:mobileNo,:dob)";
$query = $dbh->prepare($sql);
$query->bindParam(':name',$name,PDO::PARAM_STR);
$query->bindParam(':course',$course,PDO::PARAM_STR);
$query->bindParam(':department',$department,PDO::PARAM_STR);
$query->bindParam(':semester',$semester,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':mobileNo',$mobileNo,PDO::PARAM_STR);
$query->bindParam(':dob',$dob,PDO::PARAM_STR);

$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Student info added successfully";
}
else 
{
$error="Something went wrong. Please try again";
}

}
/*
    course,sem,registration -> subjectcode,regulation(SELECT) -> (INSERT)
    1 Btech 6 2016 CSCL-601
    1 Btech 6 2016 CSCL-602
    1 btech 6 2016 CSCL-603
    SELECT * from marksentry where dept = $dept, sem = $sem, course = $course and subjectCode = $subjectCode
*/
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SMMS Admin| Student Registration< </title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" >
        <link rel="stylesheet" href="css/select2/select2.min.css" >
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
    </head>
    <body class="top-navbar-fixed">
        <div class="main-wrapper">

            <!-- ========== TOP NAVBAR ========== -->
  <?php include('includes/topbar.php');?> 
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">

                    <!-- ========== LEFT SIDEBAR ========== -->
                   <?php include('includes/leftbar.php');?>  
                    <!-- /.left-sidebar -->

                    <div class="main-page">

                     <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">Student Registration</h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                
                                        <li class="active">Student Registration</li>
                                    </ul>
                                </div>
                             
                            </div>
                            <!-- /.row -->
                        </div>
                        <div class="container-fluid">
                           
                        <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>Fill the Student info</h5>
                                                </div>
                                            </div>
                                            <div class="panel-body">
<?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
 <strong>Well done!</strong><?php echo htmlentities($msg); ?>
 </div><?php } 
else if($error){?>
    <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } ?>
<form class="form-horizontal" method="post">
<div class="form-group">
    <label for="default" class="col-sm-2 control-label">Full Name</label>
    <div class="col-sm-10">
        <input type="text" name="name" class="form-control" id="name" required="required" autocomplete="off">
    </div>
</div>

<div class="form-group">
    <label for="default" class="col-sm-2 control-label">Course</label>
    <div class="col-sm-10">
        <select name="course" class="form-control" id="default" required="required">
                <option value="">Select Course</option>
                <option value="BTech">BTech</option>
                <option value="MTech">MTech</option>
                <option value="MSc">MSc</option>
        </select>
    </div>
</div>

<div class="form-group">
    <label for="default" class="col-sm-2 control-label">Department</label>
    <div class="col-sm-10">
        <select name="department" class="form-control" id="default" required="required">
            <option value="">Select Department</option>
            <option value="Computer Science and Engineering">Computer Science and Engineering</option>
            <option value="Electronics and Communication Engineering">Electronics and Communication Engineering</option>
            <option value="Information Technology">Information Technology</option>
        </select>
    </div>
</div>

<div class="form-group">
<label for="default" class="col-sm-2 control-label">Semester</label>
<div class="col-sm-10">
<input type="number" name="semester" class="form-control" id="semester" required="required" autocomplete="off">
</div>
</div>

<div class="form-group">
<label for="default" class="col-sm-2 control-label">Email id</label>
<div class="col-sm-10">
<input type="email" name="email" class="form-control" id="email" required="required" autocomplete="off">
</div>
</div>

<div class="form-group">
<label for="default" class="col-sm-2 control-label">Phone Number</label>
<div class="col-sm-10">
<input type="text" name="mobileNo" class="form-control" id="mobileNo" required="required" autocomplete="off">
</div>
</div>

<div class="form-group">
    <label for="date" class="col-sm-2 control-label">DOB</label>
    <div class="col-sm-10">
        <input type="date"  name="dob" class="form-control" id="dob">
    </div>
</div>
                                                    
<div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="submit" class="btn btn-primary">Add</button>
        </div>
    </div>
</form>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-md-12 -->
                                </div>
                    </div>
                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->
        </div>
        <!-- /.main-wrapper -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>
        <script src="js/prism/prism.js"></script>
        <script src="js/select2/select2.min.js"></script>
        <script src="js/main.js"></script>
        <script>
            $(function($) {
                $(".js-states").select2();
                $(".js-states-limit").select2({
                    maximumSelectionLength: 2
                });
                $(".js-states-hide").select2({
                    minimumResultsForSearch: Infinity
                });
            });
        </script>
    </body>
</html>
<?PHP } ?>
