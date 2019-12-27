<?php
include('includes/config.php');
if(!empty($_POST["catid"])) 
{
 $id=intval($_POST['catid']);
$query=mysqli_query($con,"SELECT * FROM  tblwritter WHERE CategoryId=$id and Is_Active=1");
?>
<option value="">Select Writter</option>
<?php
 while($row=mysqli_fetch_array($query))
 {
  ?>
  <option value="<?php echo htmlentities($row['WritterId']); ?>"><?php echo htmlentities($row['Writter']); ?></option>
  <?php
 }
}
?>