<!--Add Administrator facebox-->
  <?php
  include("../settings/connection.php");
  include("../settings/session.php");
  $id = $_GET['id'];
  ?>
	<div class="login_title"><span>STOCK IN</span></div>
	<br>
		<form method="post" >
			<table class="login">
				<tr><td><input type="hidden" name="pid" autocomplete="off" class="input-large number" id="text" value="<?php echo $id; ?>" required/></td></tr>
				<tr><td><input type="number" name="new_stck" autocomplete="off" class="input-large number" id="text" placeholder="Enter No. of Stock" required/></td></tr>
				<tr><td><button name="stockin" type="submit" class="btn btn-block btn-large btn-info"><i ></i> Enter</button></td></tr>
			</table>
		</form>
  </div>
