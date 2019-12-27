    <footer class="bg-191 color-ccc">

    	<div class="container">

			<div class="opacty-2"></div>

			<div class="oflow-hidden color-ash font-9 text-sm-center ptb-sm-5">

				<ul class="float-left float-sm-none list-a-plr-10 list-a-plr-sm-5 list-a-ptb-15 list-a-ptb-sm-10">
					                    <?php
$stmt = $con -> prepare('select PageName from tblpages');
$stmt -> execute();
$stmt -> store_result();
$stmt -> bind_result($pages);
while ($stmt->fetch()){
?>
					<li><a class="pl-0 pl-sm-10" href="<?php echo $pages;?>"><?php echo $pages;?></a></li>
<?php } ?>
				</ul>
				<ul class="float-right float-sm-none list-a-plr-10 list-a-plr-sm-5 list-a-ptb-15 list-a-ptb-sm-5">
					<li></a>

Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved by Some Site </li>
				</ul>

			</div><!-- oflow-hidden -->
		</div><!-- container -->
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
	</footer>
