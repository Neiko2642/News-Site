  <section class="ptb-0">
    <div class="mb-30 brdr-ash-1 opacty-5"></div>
    <div class="container">
      <a class="mt-10" href="/"><i class="mr-5 ion-ios-home"></i>Home<i class="mlr-10 ion-chevron-right"></i></a>
Search
    </div><!-- container -->
  </section>
    <div class="container">
			<div class="row">

				<div class="col-md-12 col-lg-8">

					<div class="row">
<?php
if(isset($_POST['submit-search'])){
    $search = "%{$_POST['search']}%";
    $message=$_POST['search'];
$stmt = $con -> prepare('select tblposts.PostTitle as pid, tblposts.year as year, tblposts.month as month,  tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid, tblwritter.Writter as writter,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join   tblwritter on   tblwritter.WritterId=tblposts.WritterId where tblposts.PostTitle LIKE ?');
$stmt -> bind_param('s', $search);
$stmt -> execute();
$stmt -> store_result();
$stmt -> bind_result($pid,$year,$month,$posttitle,$PostImage,$category,$cid,$writter,$postdetails,$postingdate,$url);
if ($stmt->fetch()){
while($stmt->fetch())
        ?>
						<div class="col-sm-6">
							<img src="rsc/images/<?php echo $PostImage;?>" alt="<?php echo $posttitle;?>">
							<h4 class="pt-20"><a href="<?php echo $year?>/<?php echo $month?>/<?php echo $url?>"><b><?php echo $posttitle;?></b></a></h4>
							<ul class="list-li-mr-20 pt-10 mb-30">
								<li class="color-lite-black">by <a href="#" class="color-black"><b><?php echo $writter;?>,</b></a>
								<?php echo $postingdate;?></li>


							</ul>
						</div><!-- col-sm-6 -->

					</div><!-- row -->


				</div><!-- col-md-9 -->

				<div class="d-none d-md-block d-lg-none col-md-3"></div>
<?php include'rsc/includes/sidemenu.php'; ?>

			</div><!-- row -->
		</div><!-- container -->


        <?php
 }else{
     ?>
<center>
<h1>No results for <?php echo $message;?>.</h1>
<p>Check out our most recent articles</p>
</center>


<?php
$stmt = $con -> prepare('select tblposts.PostTitle as pid, tblposts.year as year, tblposts.month as month,  tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid, tblwritter.Writter as writter,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join   tblwritter on   tblwritter.WritterId=tblposts.WritterId where tblposts.Is_Active=? order by tblposts.id');
$stmt->bind_param('i', $active);
$active=1;
$stmt->execute();
$stmt->bind_result($pid,$year,$month,$posttitle,$PostImage,$category,$cid,$writter,$postdetails,$postingdate,$url);
while ($stmt->fetch()){?>
						<div class="col-sm-6">
							<img src="rsc/images/<?php echo $PostImage;?>" alt="<?php echo $posttitle;?>">
							<h4 class="pt-20"><a href="<?php echo $year?>/<?php echo $month?>/<?php echo $url?>"><b><?php echo $posttitle;?></b></a></h4>
							<ul class="list-li-mr-20 pt-10 mb-30">
								<li class="color-lite-black">by <a href="#" class="color-black"><b><?php echo $writter;?>,</b></a>
								<?php echo $postingdate;?></li>


							</ul>
						</div><!-- col-sm-6 -->
<?php } ?>

					</div><!-- row -->


				</div><!-- col-md-9 -->

				<div class="d-none d-md-block d-lg-none col-md-3"></div>
<?php include'rsc/includes/sidemenu.php'; ?>

			</div><!-- row -->
		</div><!-- container -->
<?php
}

} else {
    header("location: https://dailygrind.tech");
}

?>
