<?php
if(!empty($this->data['htmlinject']['htmlContentPost'])) {
	foreach($this->data['htmlinject']['htmlContentPost'] AS $c) {
		echo $c;
	}
}
?>
	</div><!-- #content -->
	<div id="footer">
		<hr />

		<img src="/<?php echo $this->data['baseurlpath']; ?>resources/icons/uniquindio.gif" alt="Small fish logo" style="float: right" />		
		Copyright &copy; 2007-2010 <a href="http://idp.anfho.com">Anfho</a>
		
		<br style="clear: right" />
	
	</div><!-- #footer -->

</div><!-- #wrap -->

</body>
</html>
