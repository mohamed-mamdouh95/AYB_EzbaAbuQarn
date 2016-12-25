<?php
include"db.php";
if ($_COOKIE["admin"] == Null) {
    header('Location: login.php');
}
class project
{
    public $projectName;
}

$p = new project;
$record = "";
if (isset($_POST['projectName'])) 
{
	$p->projectName = $_POST['projectName'];
	$insert = " INSERT INTO PROJECT(projectName) VALUES('$p->projectName')" ;
	if ($conn->query($insert) === TRUE) 
	{
        $record = "New project is added successfully";
    } 
	else 
	{
        if ($conn->errno == 1062) 
		{
            $record = "project is already added";
        } 
		else 
		{
            $record = "There is something wrong";
        }
    }
}
$conn->close();
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/add.css">
</head>
<body>
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="">
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="logout.php">Log out</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-header">
            <li><a><?php echo $_COOKIE["admin"]; ?></a></li>
        </ul>
      </div>
    </nav>
    <div class="container">
        <div class="row">
            <h2>Add New Project</h2>
            <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                Name: <input type="text" name="projectName" required><br><br>
                <div class="row">
                    <input type="submit" class="btn btn-primary btn-primary" name="submit" value="Add Project">
                    <a href="project.php" class="btn btn-primary btn-primary"><span class="glyphicon glyphicon-backward"></span> Back</a><br><br>
                </div>
            </form>
        </div>
        <?= $record ?>
    </div>
</body>
</html>

