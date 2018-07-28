<form method="post" enctype="multipart/form-data" action="/orders/update/<?= $order->id?>" class="order-form">
	<fieldset>
	    <legend><?= __('Customer')?></legend>
	    <div class="row">
	    	<div class="col-md-6">
	    		<p class="row">
		    		<div class="col-md-4">
		    			<label for="customer_name"><?= __('Name')?></label>
		    		</div>
		    		<div class="col-md-8">
		    			<input id="customer_name" type="text" name="customer_name" value="<?= $order->customer->name?>" placeholder="<?= $order->customer->name?>">
		    		</div>
	    		</p>
	    		<p class="row">
		    		<div class="col-md-4">
		    			<label for="customer_nick_name"><?= __('Nickname')?></label>
		    		</div>
		    		<div class="col-md-8">
		    			<input id="customer_nick_name" type="text" name="customer_nick_name" value="<?= $order->customer->nickname?>" placeholder="<?= $order->customer->nickname?>">
		    		</div>
	    		</p>
	    	</div>
	    	<div class="col-md-6">
		    	<p class="row">
		    		<div class="col-md-4">
		    			<label for="customer_phone"><?= __('Phone')?> (*)</label>
		    		</div>
		    		<div class="col-md-8">
		    			<input id="customer_phone" type="text" name="customer_phone" value="<?= $order->customer->phone?>" placeholder="<?= $order->customer->phone?>">
		    		</div>
	    		</p>
	    		<p class="row">
		    		<div class="col-md-4">
		    			<label for="customer_address"><?= __('Address')?></label>
		    		</div>
		    		<div class="col-md-8">
		    			<input id="customer_address" type="text" name="customer_address" value="<?= $order->customer->address?>" placeholder="<?= $order->customer->address?>">
		    		</div>
	    		</p>
			</div>
	    </div>		    
	    <legend><?= __('Order')?></legend>
	    <div class="row">
	    	<br>
	    	<div class="col-md-6">
	    		<p class="row">
		    		<div class="col-md-4">
		    			<label for="product_category_id"><?= __('Category')?> (*)</label>
		    		</div>
		    		<div class="col-md-8">
		    			<div class="custom-select">
		    				<select name="product_category_id" <?= ($userRoleId===3 ? 'style="pointer-events:none;"' : '')?> >
						    	<?php foreach ($productCategories as $category):?>
								    <option value="<?= $category->id?>" <?php echo ($category->id == $order->product->product_category_id) ? 'selected="selected"' : '';?> ><?= $category->name?></option>
								<?php endforeach;?>
						    </select>
		    			</div>			    			
		    		</div>
	    		</p>
	    		<p class="row">
		    		<div class="col-md-4">
		    			<label for="product_name"><?= __('Product')?> (*)</label>
		    		</div>
		    		<div class="col-md-8">
		    			<input id="product_name" type="text" name="product_name" value="<?= $order->product->name?>" placeholder="<?= $order->product->name?>" <?= ($userRoleId===3 ? 'style="pointer-events:none;"' : '')?> >
		    		</div>
	    		</p>
	    		<p class="row">
		    		<div class="col-md-4">
		    			<label for="product_quantity"><?= __('Quantity')?> (*)</label>
		    		</div>
		    		<div class="col-md-8">
		    			<input id="product_quantity" type="number" name="product_quantity" value="<?= $order->quantity?>" placeholder="<?= $order->quantity?>" <?= ($userRoleId===3 ? 'style="pointer-events:none;"' : '')?> >
		    		</div>
	    		</p>
	    		<p class="row">
		    		<div class="col-md-4">
		    			<label for="order_date"><?= __('Date')?></label>
		    		</div>
		    		<div class="col-md-8">
		    			<input id="order_date" type="date" name="order_date" value="<?= $order->order_date?>" <?= ($userRoleId===3 ? 'style="pointer-events:none;"' : '')?> >
		    		</div>
	    		</p>
			</div>
			<div class="col-md-6">
				<p class="row">
		    		<div class="col-md-4">
		    			<label for="product_size"><?= __('Size')?> (*)</label>
		    		</div>
		    		<div class="col-md-8">
		    			<input id="product_size" type="text" name="product_size" value="<?= $order->product->size?>" placeholder="<?= $order->product->size?>" <?= ($userRoleId===3 ? 'style="pointer-events:none;"' : '')?> >
		    		</div>
	    		</p>
	    		<p class="row">
		    		<div class="col-md-4">
		    			<label for="product_price"><?= __('Price')?> (*)</label>
		    		</div>
		    		<div class="col-md-8">
		    			<input id="product_price" type="text" name="product_price" value="<?= $order->price?>" placeholder="<?= $order->price?>" <?= ($userRoleId===3 ? 'style="pointer-events:none;"' : '')?> >
		    		</div>
	    		</p>
	    		<p class="row">
		    		<div class="col-md-4">
		    			<label for="create_note"><?= __('Note')?></label>
		    		</div>
		    		<div class="col-md-8">
		    			<input id="create_note" type="text" name="create_note" value="<?= $order->create_note?>" placeholder="<?= $order->create_note?>" <?= ($userRoleId===3 ? 'style="pointer-events:none;"' : '')?> >
		    		</div>
	    		</p>
	    		<p class="row">
		    		<div class="col-md-4">
		    			<label for="product_image"><?= __('Image')?></label>
		    		</div>
		    		<div class="col-md-8">
		    			<?php if (!empty($order->product->product_photo->path)):?>
				    		<img src="<?= $order->product->product_photo->path ?>" alt="Photo" style="max-width:  100px;">
				    	<?php endif; ?>
				    	<?php if (empty($order->product->product_photo->path)):?>
						    <input id="product_image" type="file" name="product_image" value="" >
				    	<?php endif; ?>
		    		</div>
	    		</p>			    
			</div>
		</div>
		<div class="row">
			<div class="col-md-9"></div>
			<div class="col-md-3">
				<input class="submit-button" style="float: right;" type="submit" value="<?= __('Submit')?>">
			</div>			
		</div>	    
  	</fieldset>
</form>