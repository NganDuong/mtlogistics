<form method="post" enctype="multipart/form-data" action="/orders/create">
	<fieldset>
	    <legend>Customer</legend>
	    <div class="row">
	    	<div class="col-sm-6">
	    		<p>
			    	<label for="customer_name">Name</label>
				    <input id="customer_name" type="text" name="customer_name" value="" placeholder="Customer's name">
			    </p>
			    <p>
			    	<label for="customer_nick_name">Nickname</label>
				    <input id="customer_nick_name" type="text" name="customer_nick_name" value="" placeholder="Customer's nickname">
			    </p>
	    	</div>
		    <div class="col-sm-6">	
			    <p>
			    	<label for="customer_phone">Phone</label>
				    <input id="customer_phone" type="text" name="customer_phone" value="" placeholder="Customer's phone number">
			    </p>
			    <p>
			    	<label for="customer_address">Address</label>
				    <input id="customer_address" type="text" name="customer_address" value="" placeholder="Customer's address">
			    </p>
			</div>
	    </div>		    
	    <legend>Order</legend>
	    <div class="row">
	    	<div class="col-sm-6">
			    <p>
			    	<label for="product_name">Product</label>
				    <input id="product_name" type="text" name="product_name" value="" placeholder="Product's name">
			    </p>
			    <p>
			    	<label for="product_quantity">Quantity</label>
				    <input id="product_quantity" type="number" name="product_quantity" value="" placeholder="Product's quantity">
			    </p>
			    <p>
			    	<label for="product_category_id">Category</label>
				    <select name="product_category_id">
				    	<?php foreach ($productCategories as $category):?>
						    <option value="<?= $category->id?>"><?= $category->name?></option>
						<?php endforeach;?>
				    </select>
			    </p>
			    <p>
			    	<label for="order_date">Order's date</label>
				    <input id="order_date" type="date" name="order_date" value="<?php echo date('Y-m-d'); ?>" placeholder="Order at">
			    </p>
			</div>
			<div class="col-sm-6">
			    <p>
			    	<label for="product_size">Size</label>
				    <input id="product_size" type="text" name="product_size" value="" placeholder="Product's size">
			    </p>
			    <p>
			    	<label for="product_price">Price</label>
				    <input id="product_price" type="text" name="product_price" value="" placeholder="Product's price">
			    </p>
			    <p>
			    	<label for="create_note">Note</label>
				    <input id="create_note" type="text" name="create_note" value="" placeholder="Order's note">
			    </p>
			    <p>
			    	<label for="product_image">Image</label>
				    <input id="product_image" type="file" name="product_image">
			    </p>			    
			</div>
		</div>
	    <input type="submit" value="Submit">
  	</fieldset>
</form>