<?php
//create_cat.php
include 'connect.php';
include 'header.php';
error_reporting(E_ERROR | E_WARNING | E_PARSE);
echo '<h2>Create a category</h2>';
if($_SESSION['signed_in'] == false | $_SESSION['user_level'] != 1 )
{
	//the user is not an admin
	echo 'Sorry, you do not have sufficient rights to access this page.';
}
else
{
	//the user has admin rights
	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{
		//the form hasn't been posted yet, display it
		echo '<form method="post" action="">
			Category name: <input type="text" name="cat_name" /><br />
			Category description:<br /> <textarea name="cat_description" /></textarea><br /><br />
			<input type="submit" value="Add category" />
		 </form>';
	}
	else
	{
		//the form has been posted, so save it
		$sql = "INSERT INTO categories(cat_name, cat_description)
		   VALUES('" . mysqli_real_escape_string($conn,$_POST['cat_name']) . "',
				 '" . mysqli_real_escape_string($conn,$_POST['cat_description']) . "')";
		$result = $conn->query($sql);
		if(!$result)
		{
			//something went wrong, display the error
			echo 'Error' . mysqli_error($conn);
		}
		else
		{
			echo 'New category succesfully added.';
		}
	}
}

include 'footer.php';
?>
