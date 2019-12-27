                <div class="col-md-6 col-lg-4" id="stickyNav">
					<div class="pl-20 pl-md-0">


						<div class="mb-50">
							<h4 class="p-title"><b>RECENT POSTS</b></h4>

<?php
$stmt = $con -> prepare('select tblposts.PostTitle as pid, tblposts.year as year, tblposts.month as month,  tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid, tblwritter.Writter as writter,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join   tblwritter on   tblwritter.WritterId=tblposts.WritterId where tblposts.Is_Active=? order by tblposts.id desc limit 2');
$active=1;
$stmt -> bind_param('i', $active);
$stmt -> execute();
$stmt -> store_result();
$stmt -> bind_result($pid,$year,$month,$posttitle,$PostImage,$category,$cid,$writter,$postdetails,$postingdate,$url);
while ($stmt->fetch()){
?>

							<a class="oflow-hidden pos-relative mb-20 dplay-block" href="<?php echo $year;?>/<?php echo $month;?>/<?php echo $url;?>">
								<div class="wh-100x abs-tlr"><img src="rsc/images/<?php echo $PostImage;?>" alt=""></div>
								<div class="ml-120 min-h-100x">
									<h5><b><?php echo $posttitle;?></b></h5>
									<h6 class="color-lite-black pt-10">by <span class="color-black"><b><?php echo $writter ?>,</b></span> <?php echo $postingdate?></h6>
								</div>
							</a><!-- oflow-hidden -->
<?php } ?>



						</div><!-- mtb-50 -->

						<div class="mtb-50 pos-relative">
							<img src="rsc/images/man.jpg" alt="">
							<div class="abs-tblr bg-layer-7 text-center color-white">
								<div class="dplay-tbl">
									<div class="dplay-tbl-cell">
										<h4><b>ADVETISEMENT</b></h4>

									</div><!-- dplay-tbl-cell -->
								</div><!-- dplay-tbl -->
							</div><!-- abs-tblr -->
						</div><!-- mtb-50 -->


					</div><!--  pl-20 -->
				</div><!-- col-md-3 -->
