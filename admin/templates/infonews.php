<?php
session_start();
error_reporting(0);
include('../../../rsc/includes/config.php');


$ip = $_SERVER['REMOTE_ADDR'];
$news=basename(__DIR__);

if ($ip){
$stmt = $con -> prepare('SELECT * FROM tblviews WHERE ip = ? AND postname = ?');
$news=basename(__DIR__);
$stmt -> bind_param('ss', $ip, $news);
$stmt -> execute();
$stmt -> store_result();
if ($stmt->num_rows > 0) {

    }else{
$stmt = $con->prepare("INSERT INTO tblviews(postname,ip) VALUES (?,?)");
$stmt->bind_param("ss", $news, $ip);
$stmt->execute();
}
}

//Genrating CSRF Token
// Set session variables

if (empty($_SESSION['token'])) {
 $_SESSION['token'] = bin2hex(random_bytes(32));
}

if(isset($_POST['submit']))
{
  //Verifying CSRF Token
if (!empty($_POST['csrftoken'])) {
    if (hash_equals($_SESSION['token'], $_POST['csrftoken'])) {
$name=$_POST['name'];
$comment=$_POST['comment'];

$news=basename(__DIR__);

$postname=$news;

$stmt = $con->prepare("INSERT INTO tblcomments(postname,name,comment) VALUES (?,?,?)");
$stmt->bind_param("sss", $postname, $name, $comment);
$stmt->execute();

if($stmt):
  unset($_SESSION['token']);
  header("refresh: 0.1");
else :
 echo "<script>alert('Something went wrong. Please try again.');</script>";

endif;

}
}
}
 ?>
 <?php
$stmt = $con -> prepare('select tblposts.tag1 as tag1, tblposts.tag2 as tag2,tblposts.tag3 as tag3,tblposts.tag4 as tag4, tblposts.tag5 as tag5, tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.CategoryName as cid, tblwritter.Writter as writter,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join   tblwritter on   tblwritter.WritterId=tblposts.WritterId where tblposts.PostUrl=?');
$news=basename(__DIR__);
$stmt -> bind_param('s', $news);
$stmt -> execute();
$stmt -> store_result();
$stmt -> bind_result($tag1,$tag2,$tag3,$tag4,$tag5,$posttitle,$PostImage,$category,$cid,$writter,$postdetails,$postingdate,$url);
while ($stmt->fetch()){
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
  <title>  <?php echo $posttitle; ?></title>
<?php include'../../../rsc/includes/header.php';?>


</head>
<body>

<?php include'../../../rsc/includes/navbar.php';?>


  <section class="ptb-0">
    <div class="container">
      <a class="mt-10" href="index.html"><i class="mr-5 ion-ios-home"></i>Home<i class="mlr-10 ion-chevron-right"></i></a>
      <a class="mt-10 color-ash" href="">  <?php echo $category; ?></a>
    </div><!-- container -->
  </section>


  <section>
    <div class="container">
      <div class="row">

        <div class="col-md-12 col-lg-8">
          <img class="img-fluid rounded" src="../../../rsc/images/<?php echo $PostImage;?>" alt="<?php echo $posttitle;?>">
          <h3 class="mt-30"><b><?php echo $posttitle;?></b></h3>
          <ul class="list-li-mr-20 mtb-15">
            <li>by <a href="#"><b><?php echo $writter;?> </b></a> <?php echo $postingdate;?></li>
          </ul>

<p><?php
$pt=$postdetails;
              echo  (substr($pt,0));?></p>

          <div class="float-left-right text-center mt-40 mt-sm-20">

            <ul class="mb-30 list-li-mt-10 list-li-mr-5 list-a-plr-15 list-a-ptb-7 list-a-bg-grey list-a-br-2 list-a-hvr-primary ">

              <li><a><?php echo $tag1; ?></a></li>
              <li><a><?php echo $tag2; ?></a></li>
              <li><a><?php echo $tag3; ?></a></li>
              <li><a><?php echo $tag4; ?></a></li>
              <li><a><?php echo $tag5; ?></a></li>

            </ul>
            <ul class="mb-30 list-a-bg-grey list-a-hw-radial-35 list-a-hvr-primary list-li-ml-5">
              <li class="mr-10 ml-0">Share</li>
              <li><a href="https://twitter.com/intent/tweet?text=Check out <?php echo $posttitle ?>At/<?php echo $_SERVER['REQUEST_URI']; ?>"><i class="ion-social-twitter"></i></a></li>
            </ul>

          </div><!-- float-left-right -->

          <div class="brdr-ash-1 opacty-5"></div>

<h4 class="p-title mt-20"><b>Comment Section</b></h4>


          <div class="sided-70 mb-40">
 <?php
$stmt = $con -> prepare('select name,comment,postingDate from  tblcomments where postname=? ');
$comment=basename(__DIR__);
$stmt -> bind_param('s', $comment);
$stmt -> execute();
$stmt -> store_result();
$stmt -> bind_result($name,$comment,$postingDate);
while ($stmt->fetch()){
?>



          </div><!-- sided-70 -->


          <div class="sided-70 mb-50">

            <div class="s-right ml-100 ml-xs-85">
              <h5><b><?php echo $name;?>, </b> <span class="font-8 color-ash"><?php echo $postingDate;?></span></h5>
              <p class="mt-10 mb-15"><?php echo $comment;?> </p>
            </div><!-- s-right -->
<?php } ?>
          </div><!-- sided-70 -->

          <h4 class="p-title mt-20"><b>LEAVE A COMMENT</b></h4>

          <form class="form-block form-plr-15 form-h-45 form-mb-20 form-brdr-lite-white mb-md-50" name="Comment" method="post">
            <input type="hidden" name="csrftoken" value="<?php echo htmlentities($_SESSION['token']); ?>" />
        <input type="text" name="name" placeholder="Enter your name" required>
        <textarea  name="comment" placeholder="Comment" required></textarea>

            <button class="btn-fill-primary plr-30" rows="4" cols="50" type="submit" name="submit"><b>LEAVE A COMMENT</b></button>
          </form>
        </div><!-- col-md-9 -->

        <div class="d-none d-md-block d-lg-none col-md-3"></div>
        <?php include'../../../rsc/includes/sidemenu.php'; ?>

      </div><!-- row -->

    </div><!-- container -->
  </section>


<?php include'../../../rsc/includes/footer.php'; ?>
<?php include'../../../rsc/includes/js.php';?>

</body>
</html>
<?php }?>
