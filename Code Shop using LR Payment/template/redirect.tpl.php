<?php
	include TPL_DIR . 'header.tpl.php';
	include TPL_DIR . 'sidebar.tpl.php';
?>
	<div id="main">
		<!-- VinaGame content -->
        <div class="box">
			<h3><?php echo $this->title; ?></h3>
			<p id="content">
			<?php echo $this->msg; ?> Please waiting, This site auto redirect.<br />
			(<a href="<?php echo $this->url; ?>">If you dont want to wait a long time. Please click here now.</a>)
			<META http-equiv="refresh" content="5;URL=<?php echo $this->url; ?>"> 
			</p>
		</div>
    </div>
<?php
	include TPL_DIR . 'footer.tpl.php';
?>
