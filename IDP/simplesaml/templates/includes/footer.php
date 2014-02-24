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

	<img  src="/<?php echo $this->data['baseurlpath']; ?>resources/icons/uniquindio.gif" alt="logo" style="float: right" />		
	Copyright &copy; 2014 <a href="http://facebook.com/juan23davila">Juan David Davila - Andres Felipe Herrera</a>

	<br style="clear: right" />
	
</div><!-- #footer -->


<!--</div>
</div>
</div>-->
</div><!-- #wrap -->

</body>
</html>
