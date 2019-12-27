<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
  {
header('location:index.php');
}
else{

if(isset($_POST['submit']))
{
$PageName=$_POST['PageName'];
$PageTitle=$_POST['PageTitle'];
$Description=$_POST['Description'];
$PostingDate=$_POST['PostingDate'];
$UpdationDate=$_POST['UpdationDate'];
$Is_Active=$_POST['Is_Active'];


$stmt = $con->prepare("INSERT INTO tblpages(PageName,PageTitle,Description,PostingDate,UpdationDate,Is_Active) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssiii", $PageName, $PageTitle, $Description, $PostingDate, $UpdationDate, $Is_Active);
$stmt->execute();

if($stmt)
{
$msg="Category created ";
$oldumask = umask(0);
mkdir("../" . $_POST['PageName'], 0777); // or even 01777 so you get the sticky bit set
$my_file = "../" . $_POST['PageName'];
$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file); //implicitly creates file
umask($oldumask);
$my_file = "../" . $_POST['PageName'];
$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
$data = file_get_contents('templates/pageinfo.php');
fwrite($handle, $data);
$stmt->close();
$con->close();
}
else{
$error="Something went wrong . Please try again.";
}
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>

        <title>NeikoPanel | Add Pages</title>


        <!-- Summernote css -->
        <link href="../rsc/plugins/summernote/summernote.css" rel="stylesheet" />

        <!-- Select2 -->
        <link href="../rsc/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

        <!-- Jquery filer css -->
        <link href="../rsc/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
        <link href="../rsc/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="../rsc/plugins/switchery/switchery.min.css">
        <script src="assets/js/modernizr.min.js"></script>

    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

<!-- Top Bar Start -->
 <?php include('includes/topheader.php');?>
<!-- Top Bar End -->


<!-- ========== Left Sidebar Start ========== -->
           <?php include('includes/leftsidebar.php');?>
 <!-- Left Sidebar End -->

            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">


                        <div class="row">
            				<div class="col-xs-12">
								<div class="page-title-box">
                                    <h4 class="page-title">Add Page</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Admin</a>
                                        </li>
                                        <li>
                                            <a href="#">Page </a>
                                        </li>
                                        <li class="active">
                                            Add Page
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>
                        <!-- end row -->
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="p-6">
                                    <div class="">
                                        <form method="post">
                                            <div class="form-group m-b-20">
                                                <label for="exampleInputEmail1">Page Title</label>
                                                <input type="text" class="form-control" id="PageTitle" name="PageTitle" value="<?php echo htmlentities($row['PageTitle'])?>" required>
                                            </div>

                                            <div class="form-group m-b-20">
                                                <label for="exampleInputEmail1">Page Name</label>
                                                <input type="text" class="form-control" id="PageName" name="PageName" value="<?php echo htmlentities($row['PageName'])?>" required>
                                            </div>



                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="card-box">
                                                        <h4 class="m-b-30 m-t-0 header-title"><b>Page Details</b></h4>
                                                        <textarea class="summernote" name="Description" required><?php echo htmlentities($row['Description'])?></textarea>
                                                    </div>
                                                </div>
                                            </div>


                                                    <input type="hidden" id="Is_Active" name="Is_Active" value="1">

                                            <button type="submit" name="submit" class="btn btn-success waves-effect waves-light">Post</button>

                                        </form>
                                    </div>
                                </div> <!-- end p-20 -->
                            </div> <!-- end col -->
                        </div>


                        <!-- end row -->


                    </div> <!-- container -->

                </div> <!-- content -->

<?php include('includes/footer.php');?>

            </div>
        </div>

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

        <!--Summernote js-->
        <script src="../rsc/plugins/summernote/summernote.min.js"></script>
        <!-- Select 2 -->
        <script src="../rsc/plugins/select2/js/select2.min.js"></script>
        <!-- Jquery filer js -->
        <script src="../rsc/plugins/jquery.filer/js/jquery.filer.min.js"></script>

        <!-- page specific js -->
        <script src="assets/pages/jquery.blog-add.init.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <script>

            jQuery(document).ready(function(){

                $('.summernote').summernote({
                    height: 240,                 // set editor height
                    minHeight: null,             // set minimum height of editor
                    maxHeight: null,             // set maximum height of editor
                    focus: false                 // set focus to editable area after initializing summernote
                });
                // Select2
                $(".select2").select2();

                $(".select2-limiting").select2({
                    maximumSelectionLength: 2
                });
            });
        </script>
  <script src="../rsc/plugins/switchery/switchery.min.js"></script>

        <!--Summernote js-->
        <script src="../rsc/plugins/summernote/summernote.min.js"></script>

    </body>
</html>
<?php } ?>
