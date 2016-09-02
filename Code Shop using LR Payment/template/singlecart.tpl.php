			<table width="660" cellpadding="0" cellspacing="0" border="0" id="tblCart">
				<tr>
					<th width="250">Items�</th>
					<th width="120">Đơn giá</th>
					<th width="120">Quantity</th>
					<th width="120">Checkout</th>
					<th width="50">&nbsp;</th>
				<tr>
<?php
foreach($this->cart as $data) :
?>
				<tr>
					<td width="250"><?php echo $data['name']; ?></td>
					<td width="120"><?php echo $data['lr']; ?></td>
					<td width="120"><?php echo $data['quatity']; ?></td>
					<td width="120"><?php echo $data['total']; ?></td>
					<td width="50"><input type="image" src="./images/edit.png" title="Edit" /> <input type="image" src="./images/delete.png" title="Delete" /></td>
				<tr>
<?php
endforeach;
?>
			</table><br />
			<input type="button" onclick="emptyCart();" value="Clear items" />
			<input type="button" onclick="checkOut();" value="Checkout" />