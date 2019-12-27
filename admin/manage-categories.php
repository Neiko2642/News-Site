<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}
else{
if($_GET['action']=='del' && $_GET['rid'])
{
    $id=intval($_GET['rid']);
    $stmt = $con->prepare("UPDATE tblcategory SET Is_Active='0' WHERE id='$id'");
    $stmt->bind_param("ii", $Is_Active, $id);
    $stmt->execute();
    $msg="Category deleted ";
}
// Code for restore
if($_GET['resid'])
{
    $id=intval($_GET['resid']);
    $stmt = $con->prepare("UPDATE tblcategory SET Is_Active='1' WHERE id='$id'");
    $stmt->bind_param("ii", $Is_Active, $id);
    $stmt->execute();
    $msg="Category restored successfully";
}

// Code for Forever deletionparmdel
if($_GET['action']=='parmdel' && $_GET['rid'] && $_GET['CategoryName'])
{
$path ="../" . $_GET['CategoryName'];
array_map('unlink', glob("$path/*.*"));
if(!rmdir($path)) {
  $dirmsg="Could not remove $path";
}
    $id=intval($_GET['rid']);
    $stmt = $con->prepare("DELETE FROM tblcategory WHERE id='$id'");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $delmsg="Category deleted forever";
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <title>NeikoPanel | Manage Categories</title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
        <script src="assets/js/modernizr.min.js"></script>

    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
<?php include('includes/topheader.php');?>

            <!-- ========== Left Sidebar Start ========== -->
<?php include('includes/leftsidebar.php');?>
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">


                        <div class="row">
                            <div class="col-xs-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Manage Categories</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Admin</a>
                                        </li>
                                        <li>
                                            <a href="#">Category </a>
                                        </li>
                                        <li class="active">
                                           Manage Categories
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->


<div class="row">
<div class="col-sm-6">  
 
<?php if($msg){ ?>
<div class="alert alert-success" role="alert">
<strong>Well done!</strong> <?php echo htmlentities($msg);?>
</div>
<?php } ?>

<?php if($delmsg){ ?>
<div class="alert alert-danger" role="alert">
<strong>Oh snap!</strong> <?php echo htmlentities($delmsg);?></div>
<?php } ?>


</div>
                                 
                                 
                                    


                                   


                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="demo-box m-t-20">
<div class="m-b-30">
<a href="add-category.php">
<button id="addToTable" class="btn btn-success waves-effect waves-light">Add <i class="mdi mdi-plus-circle-outline" ></i></button>
</a>
 </div>

                                                <div class="table-responsive">
                                                    <table class="table m-0 table-colored-bordered table-bordered-primary">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th> Category</th>
                                                                <th>Description</th>
                                                          
                                                                <th>Posting Date</th>
                                                                  <th>Last updation Date</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
<?php 
$stmt = $con -> prepare('Select id,CategoryName,Description,PostingDate,UpdationDate from  tblcategory where Is_Active=?');
$cnt=1;
$stmt -> bind_param('i', $cnt);
$stmt -> execute();
$stmt -> store_result();
$stmt -> bind_result($id,$CategoryName,$Description,$PostingDate,$UpdationDate);
?>

 <tr>
<?php 
while ($stmt->fetch()){?>
<th scope="row"><?php echo $cnt;?></th>
<td><?php echo $CategoryName;?></td>
<td><?php echo $Description;?></td>
<td><?php echo $PostingDate;?></td>
<td><?php echo $UpdationDate;?></td>
<td><a href="edit-category.php?cid=<?php echo $id;?>"><i class="fa fa-pencil" style="color: #29b6f6;"></i></a> 
    &nbsp;<a href="manage-categories.php?rid=<?php echo $id;?>&&action=del"> <i class="fa fa-trash-o" style="color: #f05050"></i></a> </td>
</tr>
<?php
$cnt++;
 } ?>
</tbody>
                                                  
                                                    </table>
                                                </div>




                                            </div>

                                        </div>

                            
                                    </div>
                                    <!--- end row -->


                                    
<div class="row">
<div class="col-md-12">
<div class="demo-box m-t-20">
<div class="m-b-30">

 <h4><i class="fa fa-trash-o" ></i> Deleted Categories</h4>

 </div>

<div class="table-responsive">
<table class="table m-0 table-colored-bordered table-bordered-danger">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th> Category</th>
                                                                <th>Description</th>
                                                          
                                                                <th>Posting Date</th>
                                                                  <th>Last updation Date</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
<?php 
$stmt = $con -> prepare('Select id,CategoryName,Description,PostingDate,UpdationDate from  tblcategory where Is_Active=?');
$cnt=0;
$stmt -> bind_param('i', $cnt);
$stmt -> execute();
$stmt -> store_result();
$stmt -> bind_result($id,$CategoryName,$Description,$PostingDate,$UpdationDate);
?>


 <tr>
<?php while ($stmt->fetch()){?>
<th scope="row"><?php echo $cnt;?></th>
<td><?php echo $CategoryName;?></td>
<td><?php echo $Description;?></td>
<td><?php echo $PostingDate;?></td>
<td><?php echo $UpdationDate;?></td>
<td><a href="manage-categories.php?resid=<?php echo $id;?>"><i class="ion-arrow-return-right" title="Restore this category"></i></a> 
    &nbsp;<a href="manage-categories.php?rid=<?php echo $id;?>&CategoryName=<?php echo $CategoryName;?>&&action=parmdel" title="Delete forever"> <i class="fa fa-trash-o" style="color: #f05050"></i> </td>
</tr>
<?php
}
  ?>
</tbody>
                                                  
                                                    </table>
                                                </div>



                                                
                                            </div>

                                        </div>

                            
                                    </div>                  
                                  



                                   






                        






                    </div> <!-- container -->

                </div> <!-- content -->
<?php include('includes/footer.php');?>
            </div>

        </div>
        <!-- END wrapper -->



        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <script src="../plugins/switchery/switchery.min.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

    </body>
</html>
<?php } ?>