<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
  {
header('location:index.php');
}
else{
if($_GET['action']=='del' && $_GET['scid'])
{
    $id=intval($_GET['scid']);
    $stmt = $con->prepare("UPDATE tblwritter SET Is_Active='0' WHERE WritterId='$id'");
    $stmt->bind_param("ii", $Is_Active, $id);
    $stmt->execute();
    $msg="Writer deleted ";
}
// Code for restore
if($_GET['resid'])
{
    $id=intval($_GET['resid']);
    $stmt = $con->prepare("UPDATE tblwritter SET Is_Active='1' WHERE WritterId='$id'");
    $stmt->bind_param("ii", $Is_Active, $id);
    $stmt->execute();
    $msg="Writer restored successfully";
}

// Code for Forever deletionparmdel
if($_GET['action']=='perdel' && $_GET['scid'])
{
    $id=intval($_GET['scid']);
    $stmt = $con->prepare("DELETE from tblwritter WHERE WritterId='$id'");
    $stmt->bind_param("ii",$id);
    $stmt->execute();
    $delmsg="Writer deleted forever";
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <title>NeikoPanel | Manage Writters</title>
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
                                    <h4 class="page-title">Manage Writers</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Admin</a>
                                        </li>
                                        <li>
                                            <a href="#">Writer </a>
                                        </li>
                                        <li class="active">
                                           Manage Writers
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
<a href="add-Writter.php">
<button id="addToTable" class="btn btn-success waves-effect waves-light">Add <i class="mdi mdi-plus-circle-outline" ></i></button>
</a>
 </div>

                                                <div class="table-responsive">
                                                    <table class="table m-0 table-colored-bordered table-bordered-primary">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th> Category</th>
                                                                <th>Writers Category</th>
                                                                <th>Description</th>

                                                                <th>Posting Date</th>
                                                                  <th>Last updation Date</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
<?php
$stmt = $con -> prepare('Select tblcategory.CategoryName as catname, tblwritter.Writter as writtername, tblwritter.WritterDescription as WritterDescription, tblwritter.PostingDate as writterpostingdate, tblwritter.UpdationDate as writterupdationdate, tblwritter.WritterId as writterid from  tblwritter join tblcategory on  tblwritter.CategoryId=tblcategory.id where  tblwritter.Is_Active=?');
$cnt=1;
$stmt -> bind_param('i', $cnt);
$stmt -> execute();
$stmt -> store_result();
$stmt -> bind_result($catname,$writtername,$WritterDescription,$writterpostingdate,$writterupdationdate,$writterid);
?>

<?php while ($stmt->fetch()){?>
 <tr>
<th scope="row"><?php echo htmlentities($cnt);?></th>
<td><?php echo $catname;?></td>
<td><?php echo $writtername;?></td>
<td><?php echo $WritterDescription;?></td>
<td><?php echo $writterpostingdate;?></td>
<td><?php echo $writterupdationdate;?></td>
<td><a href="edit-Writer.php?scid=<?php echo $writterid;?>"><i class="fa fa-pencil" style="color: #29b6f6;"></i></a>
    &nbsp;<a href="manage-writers.php?scid=<?php echo $writterid;?>&&action=del"> <i class="fa fa-trash-o" style="color: #f05050"></i></a> </td>
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

 <h4><i class="fa fa-trash-o" ></i> Deleted SubCategories</h4>

 </div>

<div class="table-responsive">
   <table class="table m-0 table-colored-bordered table-bordered-danger">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th> Category</th>
                                                                <th>Writers Category</th>
                                                                <th>Description</th>

                                                                <th>Posting Date</th>
                                                                  <th>Last updation Date</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
<?php
$stmt = $con -> prepare('Select tblcategory.CategoryName as catname, tblwritter.Writter as writtername, tblwritter.WritterDescription as WritterDescription, tblwritter.PostingDate as writterpostingdate, tblwritter.UpdationDate as writterupdationdate, tblwritter.WritterId as writterid from  tblwritter join tblcategory on  tblwritter.CategoryId=tblcategory.id where  tblwritter.Is_Active=?');
$cnt=0;
$stmt -> bind_param('i', $cnt);
$stmt -> execute();
$stmt -> store_result();
$stmt -> bind_result($catname,$writtername,$WritterDescription,$writterpostingdate,$writterupdationdate,$writterid);
?>


<?php while ($stmt->fetch()){?>
 <tr>
<th scope="row"><?php echo htmlentities($cnt);?></th>
<td><?php echo $catname;?></td>
<td><?php echo $writtername;?></td>
<td><?php echo $WritterDescription;?></td>
<td><?php echo $writterpostingdate;?></td>
<td><?php echo $writterupdationdate;?></td>
<td><a href="manage-writers.php?resid=<?php echo $writterid;?>"><i class="ion-arrow-return-right" title="Restore this Writter"></i></a>
    &nbsp;<a href="manage-writers.php?scid=<?php echo $writterid;?>&&action=perdel"> <i class="fa fa-trash-o" style="color: #f05050"></i></a> </td>
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
