<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
  {
header('location:index.php');
}
else{

// For adding post
if(isset($_POST['submit']))
{
$posttitle=$_POST['posttitle'];
$catid=$_POST['category'];
$writterid=$_POST['writter'];
$postdetails=$_POST['postdescription'];
$arr = explode(" ",$posttitle);
$url=implode("-",$arr);
$imgfile=$_FILES["postimage"]["name"];
$year = $_POST['year'];
$month = $_POST['month'];
$tag1 = $_POST['tag1'];
$tag2 = $_POST['tag2'];
$tag3 = $_POST['tag3'];
$tag4 = $_POST['tag4'];
$tag5 = $_POST['tag5'];

$extension = substr($imgfile,strlen($imgfile)-4,strlen($imgfile));


$imgnewfile=md5($imgfile).$extension;
// Code for move image into directory
move_uploaded_file($_FILES["postimage"]["tmp_name"],"../"."rsc/"."images/".$imgnewfile);

$status=1;
$stmt = $con->prepare("INSERT INTO tblposts(PostTitle,CategoryId,writterId,PostDetails,PostUrl,Is_Active,PostImage,year, month,tag1,tag2,tag3,tag4,tag5) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?)");
$stmt->bind_param("siissisiisssss", $posttitle, $catid, $writterid, $postdetails, $url, $status, $imgnewfile, $year, $month,$tag1,$tag2,$tag3,$tag4,$tag5);
$stmt->execute();
if($stmt)
{
{
$msg="Post created ";
$oldumask = umask(0);
$year = date("y");
$month = date("n");
mkdir("../" . $year, 0777);
mkdir("../" . $year . "/" . $month, 0777);
mkdir("../" . $year . "/" . $month . "/" . $url . "/", 0777);

umask($oldumask);
$my_file = "../" . $year ."/". $month ."/". $url. "/" ."index.php";
$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
$data = file_get_contents('templates/infonews.php');
fwrite($handle, $data);
}
}
else{
$error="Something went wrong . Please try again.";
}


}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <!-- App title -->
        <title>NeikoPanel | Add Post</title>

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
 <script>
function getWritter(val) {
  $.ajax({
  type: "POST",
  url: "get_writer.php",
  data:'catid='+val,
  success: function(data){
    $("#writter").html(data);
  }
  });
  }
  </script>
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
                                    <h4 class="page-title">Add Post </h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Post</a>
                                        </li>
                                        <li>
                                            <a href="#">Add Post </a>
                                        </li>
                                        <li class="active">
                                            Add Post
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

<div class="row">
<div class="col-sm-6">
<!---Success Message--->
<?php if($msg){ ?>
<div class="alert alert-success" role="alert">
<strong>Well done!</strong> <?php echo htmlentities($msg);?>
</div>
<?php } ?>

<!---Error Message--->
<?php if($error){ ?>
<div class="alert alert-danger" role="alert">
<strong>Oh snap!</strong> <?php echo htmlentities($error);?></div>
<?php } ?>


</div>
</div>


                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="p-6">
                                    <div class="">
<form name="addpost" method="post" enctype="multipart/form-data">
 <div class="form-group m-b-20">
<label for="exampleInputEmail1">Post Title</label>
<input type="text" class="form-control" id="posttitle" name="posttitle" placeholder="Enter title" required>
</div>



<div class="form-group m-b-20">
<label for="exampleInputEmail1">Category</label>
<select class="form-control" name="category" id="category" onChange="getWritter(this.value);" required>
<option value="">Select Category </option>
<?php
$stmt = $con -> prepare('select id,CategoryName from  tblcategory where Is_Active=?');

$active=1;

$stmt -> bind_param('i', $active);
$stmt -> execute();
$stmt -> store_result();
$stmt -> bind_result($id, $CategoryName);
?>
<?php
while ($stmt->fetch()){?>
<option value="<?php echo $id;?>"><?php echo $CategoryName;?></option>
<?php } ?>

</select>
</div>

<div class="form-group m-b-20">
<label for="exampleInputEmail1">Writer</label>
<select class="form-control" name="writter" id="writter" required>

</select>
</div>


<div class="row">
<div class="col-sm-12">
 <div class="card-box">
<h4 class="m-b-30 m-t-0 header-title"><b>Post Details</b></h4>
<textarea class="summernote" name="postdescription" required></textarea>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
 <div class="card-box">
<h4 class="m-b-30 m-t-0 header-title"><b>Tag 1</b></h4>
<input name="tag1" required></input>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
 <div class="card-box">
<h4 class="m-b-30 m-t-0 header-title"><b>Tag 2</b></h4>
<input name="tag2"></input>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
 <div class="card-box">
<h4 class="m-b-30 m-t-0 header-title"><b>Tag 3</b></h4>
<input name="tag3"></input>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
 <div class="card-box">
<h4 class="m-b-30 m-t-0 header-title"><b>Tag 4</b></h4>
<input name="tag4"></input>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
 <div class="card-box">
<h4 class="m-b-30 m-t-0 header-title"><b>Tag 5</b></h4>
<input name="tag5"></input>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
 <div class="card-box">
<h4 class="m-b-30 m-t-0 header-title"><b>Feature Image</b></h4>
<input type="file" class="form-control" id="postimage" name="postimage" >
</div>
</div>
</div>
<input type="hidden" id="year" name="year" value="<?php echo date("y"); ?>">
<input type="hidden" id="month" name="month" value="<?php echo date("m"); ?>">

<button type="submit" name="submit" class="btn btn-success waves-effect waves-light">Save and Post</button>
 <button type="button" class="btn btn-danger waves-effect waves-light">Discard</button>
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


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


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

        <!--Summernote js-->
        <script src="../../rsc/plugins/summernote/summernote.min.js"></script>
        <!-- Select 2 -->
        <script src="../../rsc/plugins/select2/js/select2.min.js"></script>
        <!-- Jquery filer js -->
        <script src="../../rsc/plugins/jquery.filer/js/jquery.filer.min.js"></script>

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
