<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
  {
header('location:index.php');
}
else{
if(isset($_POST['update']))
{
$posttitle=$_POST['posttitle'];
$catid=$_POST['category'];
$writterid=$_POST['writter'];
$postdetails=$_POST['postdescription'];
$tag1 = $_POST['tag1'];
$tag2 = $_POST['tag2'];
$tag3 = $_POST['tag3'];
$tag4 = $_POST['tag4'];
$tag5 = $_POST['tag5'];
$arr = explode(" ",$posttitle);
$url=implode("-",$arr);
$status=1;
$postid=intval($_GET['pid']);

$stmt = $con->prepare("UPDATE tblposts SET   tag1='$tag1',tag2='$tag2', tag3='$tag3',tag4='$tag4', tag5='$tag5',PostTitle='$posttitle',CategoryId='$catid',WritterId='$writterid',PostDetails='$postdetails',PostUrl='$url',Is_Active='$status' WHERE id='$postid'");
    $stmt->bind_param("siissiisssss", $posttitle,$catid,$writterid,$postdetails,$url,$status,$postid,$tag1,$tag2,$tag3,$tag4,$tag5);
$stmt->execute();

if($stmt)
{
$msg="Post updated ";
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
        <title>NeikoPanel | Edit Post</title>

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
        <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
        <script src="assets/js/modernizr.min.js"></script>
 <script>
function getWritter(val) {
  $.ajax({
  type: "POST",
  url: "get_writter.php",
  data:'writterid='+val,
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
                                    <h4 class="page-title">Edit Post </h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Admin</a>
                                        </li>
                                        <li>
                                            <a href="#"> Posts </a>
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

<?php
$stmt = mysqli_prepare($con, "select tblposts.tag1 as tag1, tblposts.tag2 as tag2,tblposts.tag3 as tag3,tblposts.tag4 as tag4, tblposts.tag5 as tag5, tblposts.id as postid,tblposts.PostImage,tblposts.PostTitle as title,tblposts.PostDetails,tblcategory.CategoryName as category,tblcategory.id as catid,tblwritter.WritterId as writterid,tblwritter.Writter as writter from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join tblwritter on tblwritter.WritterId=tblposts.WritterId where tblposts.id=? and tblposts.Is_Active=1");
$stmt->bind_param("i", $postid);
$postid=intval($_GET['pid']);
$stmt->execute();
$stmt->bind_result($tag1,$tag2,$tag3,$tag4,$tag5,$postid,$PostImage,$title,$PostDetails,$category,$catid,$writterid,$writter);
$stmt->fetch();
?>
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="p-6">
                                    <div class="">
                                        <form name="addpost" method="post">
 <div class="form-group m-b-20">
<label for="exampleInputEmail1">Post Title</label>
<input type="text" class="form-control" id="posttitle" value="<?php echo $title;?>" name="posttitle" placeholder="Enter title" required>
</div>



<div class="form-group m-b-20">
<label for="exampleInputEmail1">Category</label>
<select class="form-control" name="category" id="category" onChange="getWritter(this.value);" required>
<option value="<?php echo $catid;?>"><?php echo $category;?></option>

</select>
</div>

<div class="form-group m-b-20">
<label for="exampleInputEmail1">Writer</label>
<select class="form-control" name="writter" id="writter" required>
<option value="<?php echo $writterid;?>"><?php echo $writter?></option>
</select>
</div>


     <div class="row">
<div class="col-sm-12">
 <div class="card-box">
<h4 class="m-b-30 m-t-0 header-title"><b>Post Details</b></h4>
<textarea class="summernote" name="postdescription" required><?php echo htmlentities($PostDetails);?></textarea>
</div>
</div>
</div>


<div class="row">
<div class="col-sm-12">
 <div class="card-box">
<h4 class="m-b-30 m-t-0 header-title"><b>Tag 1</b></h4>
<input name="tag1" value="<?php echo $tag1;?>"required></input>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
 <div class="card-box">
<h4 class="m-b-30 m-t-0 header-title"><b>Tag 2</b></h4>
<input name="tag2" value="<?php echo $tag2;?>"></input>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
 <div class="card-box">
<h4 class="m-b-30 m-t-0 header-title"><b>Tag 3</b></h4>
<input name="tag3" value="<?php echo $tag3;?>"></input>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
 <div class="card-box">
<h4 class="m-b-30 m-t-0 header-title"><b>Tag 4</b></h4>
<input name="tag4" value="<?php echo $tag4;?>"></input>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
 <div class="card-box">
<h4 class="m-b-30 m-t-0 header-title"><b>Tag 5</b></h4>
<input name="tag5" value="<?php echo $tag5;?>"></input>
</div>
</div>
</div>


 <div class="row">
<div class="col-sm-12">
 <div class="card-box">
<h4 class="m-b-30 m-t-0 header-title"><b>Post Image</b></h4>
<img src="../rsc/images/<?php echo $PostImage;?>" width="300"/>
<br />
<a href="change-image.php?pid=<?php echo $postid;?>">Update Image</a>
</div>
</div>
</div>


<button type="submit" name="update" class="btn btn-success waves-effect waves-light">Update </button>

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
        <script src="../rsc/plugins/switchery/switchery.min.js"></script>

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
