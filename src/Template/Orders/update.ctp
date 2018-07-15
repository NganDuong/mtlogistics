<form method="post" enctype="multipart/form-data" action="/orders/update/<?= $order->id?>">
	<fieldset>
	    <legend><?= __('Customer')?></legend>
	    <div class="row">
	    	<div class="col-sm-6">
	    		<p>
			    	<label for="customer_name"><?= __('Name')?></label>
				    <input id="customer_name" type="text" name="customer_name" value="<?= $order->customer->name?>" placeholder="<?= $order->customer->name?>">
			    </p>
			    <p>
			    	<label for="customer_nick_name"><?= __('Nickname')?></label>
				    <input id="customer_nick_name" type="text" name="customer_nick_name" value="<?= $order->customer->nickname?>" placeholder="<?= $order->customer->nickname?>">
			    </p>
	    	</div>
		    <div class="col-sm-6">	
			    <p>
			    	<label for="customer_phone"><?= __('Phone')?></label>
				    <input id="customer_phone" type="text" name="customer_phone" value="<?= $order->customer->phone?>" placeholder="<?= $order->customer->phone?>">
			    </p>
			    <p>
			    	<label for="customer_address"><?= __('Address')?></label>
				    <input id="customer_address" type="text" name="customer_address" value="<?= $order->customer->address?>" placeholder="<?= $order->customer->address?>">
			    </p>
			</div>
	    </div>		    
	    <legend><?= __('Order')?></legend>
	    <div class="row">
	    	<div class="col-sm-6">
	    		<p>
			    	<label for="product_category_id"><?= __('Category')?></label>
				    <select name="product_category_id">
				    	<?php foreach ($productCategories as $category):?>
						    <option value="<?= $category->id?>" <?php echo ($category->id == $order->product->product_category_id) ? 'selected="selected"' : '';?> ><?= $category->name?></option>
						<?php endforeach;?>
				    </select>
			    </p>
			    <p>
			    	<label for="product_name"><?= __('Product')?></label>
				    <input id="product_name" type="text" name="product_name" value="<?= $order->product->name?>" placeholder="<?= $order->product->name?>">
			    </p>
			    <p>
			    	<label for="product_quantity"><?= __('Quantity')?></label>
				    <input id="product_quantity" type="number" name="product_quantity" value="<?= $order->quantity?>" placeholder="<?= $order->quantity?>">
			    </p>
			    <p>
			    	<label for="order_date"><?= __('Date')?></label>
				    <input id="order_date" type="date" name="order_date" value="<?= $order->order_date?>">
			    </p>
			</div>
			<div class="col-sm-6">
			    <p>
			    	<label for="product_size"><?= __('Size')?></label>
				    <input id="product_size" type="text" name="product_size" value="<?= $order->product->size?>" placeholder="<?= $order->product->size?>">
			    </p>
			    <p>
			    	<label for="product_price"><?= __('Price')?></label>
				    <input id="product_price" type="text" name="product_price" value="<?= $order->price?>" placeholder="<?= $order->price?>">
			    </p>
			    <p>
			    	<label for="create_note"><?= __('Note')?></label>
				    <input id="create_note" type="text" name="create_note" value="<?= $order->create_note?>" placeholder="<?= $order->create_note?>">
			    </p>
			    <p>
			    	<?php if (!empty($order->product->product_photo->path)):?>
			    		<img src="<?= $order->product->product_photo->path ?>" alt="Photo" style="max-width:  100px;">
			    	<?php endif; ?>

			    	<?php if (empty($order->product->product_photo->path)):?>
			    		<label for="product_image"><?= __('Image')?></label>
					    <input id="product_image" type="file" name="product_image" value="" >
			    	<?php endif; ?>				    	
			    </p>			    
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6"></div>
			<div class="col-sm-6">
				<input style="float: right;"  type="submit" value="<?= __('Submit')?>">
			</div>			
		</div>	    
  	</fieldset>
</form>