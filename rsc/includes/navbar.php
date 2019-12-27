    <header>
        <div class="bg-191">
            <div class="container">
                <div class="oflow-hidden color-ash font-9 text-sm-center ptb-sm-5">

    				<ul class="list-a-plr-10 list-a-plr-sm-5 list-a-ptb-15 list-a-ptb-sm-10">
						<?php echo file_get_contents('rsc/prices/btc.php'); ?>
						<?php echo file_get_contents('rsc/prices/ltc.php'); ?>
						<?php echo file_get_contents('rsc/prices/eth.php'); ?>
					</ul>
				</div><!-- top-menu -->
			</div><!-- container -->
		</div><!-- bg-191 -->
		<div class="container">
			<a class="logo" href=""><img src="rsc/images/man.jpg" alt="Logo"></a>


			<a class="right-area src-btn" href="#" >
				<i class="active src-icn ion-search"></i>
				<i class="close-icn ion-close"></i>
			</a>
			<div class="src-form">
				<form class="search-form" action="search.php" method="POST">
                                        <input type="search" id="searchForm" name="search" placeholder="Search something..." required="">
                                        <button type="submit" name="submit-search" style="display:none"></button>
                                    </form>
			</div><!-- src-form -->

			<a class="menu-nav-icon" data-menu="#main-menu" href="#"><i class="ion-navicon"></i></a>

			<ul class="main-menu" id="main-menu">
				<li><a href="/">Home</a></li>

				<?php
 $stmt = $con -> prepare('select id,CategoryName from tblcategory');
$stmt -> execute();
$stmt -> store_result();
$stmt -> bind_result($id,$CategoryName);
while ($stmt->fetch()){
?>
<li><a class="navbarset"href="/<?php echo $CategoryName?>"><?php echo $CategoryName;?></a></li>
<?php } ?>



			</ul>
			<div class="clearfix"></div>
                <hr>
		</div><!-- container -->
	</header>
