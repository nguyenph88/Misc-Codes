<?php
	include TPL_DIR . 'header.tpl.php';
	include TPL_DIR . 'sidebar.tpl.php';
?>
	<div id="main">
		<!-- VinaGame content -->
        <div class="box">
			<h3><?php echo $this->title; ?></h3>
			<p id="content">
			<?php echo $this->msg; ?>. Đang di chuyển.<br />
			(<a href="<?php echo $this->url; ?>">Hoặc click vào đây nếu bạn không muốn đợi lâu.</a>)
			<META http-equiv="refresh" content="5;URL=<?php echo $this->url; ?>"> 
			</p>
		</div>
    </div>
<?php
	include TPL_DIR . 'footer.tpl.php';
?>
