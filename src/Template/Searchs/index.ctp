<div>
	<label style="text-align: center;">SEARCH</label>
</div>

<form method="post" action="/searchs">
	<fieldset>
		<label>Order</label>
	    <div class="row">
	    	<div class="col-sm-3">
	    		<label for="order_no">Order No.</label>
			    <input id="order_no" type="text" name="order_no" value="" placeholder="Order's No.">
	    	</div>
			<div class="col-sm-3">
				<label for="product_quantity">Quantity</label>
			    <input style="pointer-events: none;" id="product_quantity" type="number" name="product_quantity" value="" placeholder="Product's quantity">
			</div>
			<div class="col-sm-3">
				<label for="product_price">Price</label>
			    <input style="pointer-events: none;" id="product_price" type="text" name="product_price" value="" placeholder="Product's price">
			</div>
			<div class="col-sm-3">
				<label for="order_date">Order's date</label>
			    <input style="pointer-events: none;" id="order_date" type="date" name="order_date" value="" placeholder="Order at">
			</div>
	    </div>
		<label>Customer</label>
	    <div class="row">
	    	<div class="col-sm-3">
	    		<label for="customer_name">Name</label>
			    <input style="pointer-events: none;" id="customer_name" type="text" name="customer_name" value="" placeholder="Customer's name">
	    	</div>
			<div class="col-sm-3">
				<label for="customer_nick_name">Nickname</label>
			    <input style="pointer-events: none;" id="customer_nick_name" type="text" name="customer_nick_name" value="" placeholder="Customer's nickname">
			</div>
			<div class="col-sm-3">
				<label for="customer_phone">Phone</label>
			    <input style="pointer-events: none;" id="customer_phone" type="text" name="customer_phone" value="" placeholder="Customer's phone number">
			</div>
			<div class="col-sm-3">
				<label for="customer_address">Address</label>
			    <input style="pointer-events: none;" id="customer_address" type="text" name="customer_address" value="" placeholder="Customer's address">
			</div>
	    </div>
	    <label>Product</label>
	    <div class="row">
	    	<div class="col-sm-4">
	    		<label for="product_size">Size</label>
			    <input style="pointer-events: none;" id="product_size" type="text" name="product_size" value="" placeholder="Product's size">
	    	</div>
			<div class="col-sm-4">
				<label for="product_name">Product</label>
			    <input style="pointer-events: none;" id="product_name" type="text" name="product_name" value="" placeholder="Product's name">
			</div>
			<div class="col-sm-4">
				<label for="product_category_id">Category</label>
			    <select style="pointer-events: none;" name="product_category_id">
			    	<?php foreach ($productCategories as $category):?>
					    <option value="<?= $category->id?>"><?= $category->name?></option>
					<?php endforeach;?>
			    </select>
			</div>
			
	    </div>
	    <input type="submit" value="Submit">
  	</fieldset>
</form>