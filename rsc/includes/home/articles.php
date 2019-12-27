	<div class="container">
		
			<div class="h-2-3 h-sm-auto">
		<div class="h-400x h-sm-auto">
		    
		    <?php
$stmt = mysqli_prepare($con, "select tblposts.PostTitle, tblposts.year, tblposts.month, tblposts.PostTitle,tblposts.PostImage,tblcategory.CategoryName,tblcategory.id, tblwritter.Writter,tblposts.PostDetails,tblposts.PostingDate,tblposts.PostUrl from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join tblwritter on tblwritter.WritterId=tblposts.WritterId where tblposts.Is_Active=? order by tblposts.id desc LIMIT 1");
$stmt->bind_param('i', $active);
$active=1;
$stmt->execute();
$stmt->bind_result($pid,$year,$month,$posttitle,$PostImage,$category,$cid,$writter,$postdetails,$postingdate,$url);
while ($stmt->fetch()){?>
				<div class="pb-5 pr-5 pr-sm-0 float-left float-sm-none w-2-3 w-sm-100 h-100 h-sm-300x">
					<a class="pos-relative h-100 dplay-block" href="<?php echo $year?>/<?php echo $month?>/<?php echo $url?>">
					<div class="bg-grad-layer-6">
							<img  src="rsc/images/<?php echo $PostImage;?>" style=" max-height: 400px;">
					</div>
						
						<div class="abs-blr color-white p-20 bg-sm-color-7">

							<h3 class="mb-15 mb-sm-5 font-sm-13" ><b><?php echo $posttitle;?></b></h3>
							<ul class="list-li-mr-20">
								<li>by <span class="color-primary"><b><?php echo $writter; ?></b></span> <?php echo $postingdate ?></li>
							</ul>
						</div><!--abs-blr -->
					</a><!-- pos-relative -->
				</div><!-- w-1-3 -->
			<?php } ?>
				
				
				<div class="float-left float-sm-none w-1-3 w-sm-100 h-100 h-sm-600x">
						    <?php
$stmt = mysqli_prepare($con, "select tblposts.PostTitle, tblposts.year, tblposts.month, tblposts.PostTitle,tblposts.PostImage,tblcategory.CategoryName,tblcategory.id, tblwritter.Writter,tblposts.PostDetails,tblposts.PostingDate,tblposts.PostUrl from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join tblwritter on tblwritter.WritterId=tblposts.WritterId where tblposts.Is_Active=? order by tblposts.id LIMIT 1 OFFSET 2 ");
$stmt->bind_param('i', $active);
$active=1;
$stmt->execute();
$stmt->bind_result($pid,$year,$month,$posttitle,$PostImage,$category,$cid,$writter,$postdetails,$postingdate,$url);
while ($stmt->fetch()){?>
					<div class="pl-5 pb-5 pl-sm-0 ptb-sm-5 pos-relative h-50">
						<a class="pos-relative h-100 dplay-block" href="<?php echo $year?>/<?php echo $month?>/<?php echo $url?>">
						
							<img src="rsc/images/<?php echo $PostImage;?>" height="195" width="195">
							
							<div class="abs-blr color-white p-20 bg-sm-color-7">
								<h4 class="mb-10 mb-sm-5"><b><?php echo $posttitle;?></b></h4>
								<ul class="list-li-mr-20">
									<li><?php echo $postingdate ?></li>
								</ul>
							</div><!--abs-blr -->
						</a><!-- pos-relative -->
					</div><!-- w-1-3 -->
<?php } ?>
						    <?php
$stmt = mysqli_prepare($con, "select tblposts.PostTitle, tblposts.year, tblposts.month, tblposts.PostTitle,tblposts.PostImage,tblcategory.CategoryName,tblcategory.id, tblwritter.Writter,tblposts.PostDetails,tblposts.PostingDate,tblposts.PostUrl from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join tblwritter on tblwritter.WritterId=tblposts.WritterId where tblposts.Is_Active=? order by tblposts.id LIMIT 1 OFFSET 3 ");
$stmt->bind_param('i', $active);
$active=1;
$stmt->execute();
$stmt->bind_result($pid,$year,$month,$posttitle,$PostImage,$category,$cid,$writter,$postdetails,$postingdate,$url);
while ($stmt->fetch()){?>
					<div class="pl-5 pb-5 pl-sm-0 ptb-sm-5 pos-relative h-50">
						<a class="pos-relative h-100 dplay-block" href="<?php echo $year?>/<?php echo $month?>/<?php echo $url?>">
						
							<img src="rsc/images/<?php echo $PostImage;?>" height="200" width="200">
							
							<div class="abs-blr color-white p-20 bg-sm-color-7">
								<h4 class="mb-10 mb-sm-5"><b><?php echo $posttitle;?></b></h4>
								<ul class="list-li-mr-20">
									<li><?php echo $postingdate ?></li>
								</ul>
							</div><!--abs-blr -->
						</a><!-- pos-relative -->
					</div><!-- w-1-3 -->
<?php } ?>
					
				</div><!-- float-left -->

			</div><!-- h-2-3 -->
		</div><!-- h-100vh -->
	</div><!-- container -->
  <section>
        <div class="container">
        	<div class="row">
				<div class="col-md-12 col-lg-8">
					<div class="row">
					    <?php
$stmt = mysqli_prepare($con, "select tblposts.PostTitle, tblposts.year, tblposts.month, tblposts.PostTitle,tblposts.PostImage,tblcategory.CategoryName,tblcategory.id, tblwritter.Writter,tblposts.PostDetails,tblposts.PostingDate,tblposts.PostUrl from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join tblwritter on tblwritter.WritterId=tblposts.WritterId where tblposts.Is_Active=? order by RAND() ");
$stmt->bind_param('i', $active);
$active=1;
$stmt->execute();
$stmt->bind_result($pid,$year,$month,$posttitle,$PostImage,$category,$cid,$writter,$postdetails,$postingdate,$url);
while ($stmt->fetch()){?>
						<div class="col-sm-6">
						    <h4 class="p-title mt-30"><b><?php echo $category;?></b></h4>
							<img src="https://dailygrind.tech/rsc/images/<?php echo $PostImage;?>" height="200" width="200">
							<h4 class="pt-20"><a href="<?php echo $year?>/<?php echo $month?>/<?php echo $url?>"><b><?php echo $posttitle;?></b></a></h4>
							<ul class="list-li-mr-20 pt-10 mb-30">
								<li class="color-lite-black">by <a class="color-black"><b><?php echo $writter;?>,</b></a>
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
	</section>
