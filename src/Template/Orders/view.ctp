<div class="panel panel-default">
	<div class="panel-heading" style="text-align: center;"># <?= $order->order_code?></div>
	<div class="panel-body">
		<h5 style="font-weight: bold"><?= __('Order')?></h5>
		<br>
		<div class="row">	
			<div class="col-sm-3">
				<span><?= __('Price')?>: </span>
				<span><?= $order->price?></span>
			</div>
			<div class="col-sm-3">
		        <span><?= __('Quantity')?>: </span>
		        <span><?= $order->quantity?></span>
		    </div>
		    <div class="col-sm-3">
		        <span><?= __('Order at')?>: </span>
		        <span><?= $order->order_date?></span>
		    </div>
		</div>
		
			<br>
			<h5 style="font-weight: bold"><?= __('Detail')?></h5>
			<br>
			<?php if (!empty($order->sent)): ?>
				<div class="row">	
					<div class="col-sm-6">
						<span><?= __('Sent at')?>: </span>
						<span><?= $order->sent?></span>
					</div>
					<div class="col-sm-6">
				        <span><?= __('Payment method')?>: </span>
				        <span><?= $order->payment_method->name?></span>
				    </div>
				</div>
			<?php endif;?>
			<?php if (!empty($order->delivered)): ?>
				<div class="row">	
					<div class="col-sm-4">
						<span><?= __('Delivered at')?>: </span>
						<span><?= $order->delivered?></span>
					</div>
					<div class="col-sm-4">
				        <span><?= __('Delivery method')?>: </span>
				        <span><?= $order->delivery_method->name?></span>
				    </div>
				    <div class="col-sm-4">
				        <span><?= __('Carrier')?>: </span>
				        <span><?= $order->delivery_name?></span>
				    </div>
				</div>
			<?php endif;?>
		<br>
		<h5 style="font-weight: bold"><?= __('Customer')?></h5>
		<br>
		<div class="row">			
			<div class="col-sm-3">
				<span><?= __('Name')?>: </span>
				<span><?= $order->customer->name?></span>
			</div>
			<div class="col-sm-3">
		        <span><?= __('Nickname')?>: </span>
		        <span><?= $order->customer->nickname?></span>
		    </div>
		    <div class="col-sm-3">
		        <span><?= __('Phone number')?>: </span>
		        <span><?= $order->customer->phone?></span>
		    </div>
		    <div class="col-sm-3">
		        <span><?= __('Address')?>: </span>
		        <span><?= $order->customer->address?></span>
			</div>
		</div>
		<br>
		<h5 style="font-weight: bold"><?= __('Product')?></h5>
		<br>
		<div class="row">			
			<div class="col-sm-3">
				<span><?= __('Name')?>: </span>
				<span><?= $order->product->name?></span>
			</div>
			<div class="col-sm-3">
		        <span><?= __('Category')?>: </span>
		        <span><?= $order->product->product_category->name?></span>
		    </div>
		    <div class="col-sm-3">
		        <span><?= __('Size')?>: </span>
		        <span><?= $order->product->size?></span>
		    </div>
		    <div class="col-sm-3">
		        <span><?= __('Photo')?>: </span>
		        <img src="<?= !empty($order->product->product_photo->path) ? $order->product->product_photo->path : '' ?>" alt="Photo" style="max-width:  100px;">
			</div>
		</div>
		<h5 style="font-weight: bold"><?= __('Note')?></h5>
		<div class="row">			
			<p><?= $order->create_note?></p>
			<p><?= $order->delivery_note?></p>
		</div>
	</div>
	<div class="panel-footer">
		<div class="row">			
			<div class="col-sm-6">
			</div>
			<div class="col-sm-6">
				<?php if (empty($order->sent)): ?>
					<button style="float: right; margin: 5px" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#sentModal"><?= __('Sent')?></button>

					<div class="container">
						<!-- Modal -->
						<div class="modal fade" id="sentModal" role="dialog">
							<div class="modal-dialog">    
								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title" style="text-align: center;">SENT CONFIRMATION</h4>
									</div>
									<div class="modal-body">
										<form method="post" action="/orders/sent/<?= $order->id?>">
											<label>Choose a payment method</label>
											<select name="payment_method_id">
										    	<?php foreach ($paymentMethods as $paymentMethod):?>
												    <option value="<?= $paymentMethod->id?>"><?= $paymentMethod->name?></option>
												<?php endforeach;?>
										    </select>
										    <input type="submit" value="Submit">
										</form>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</div>

							</div>
						</div>
					</div>
				<?php endif;?>
				<?php if (!empty($order->sent) && empty($order->delivered)): ?>
					<button style="float: right; margin: 5px" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#deliveredModal"><?= __('Delivered')?></button>

					<div class="container">
						<!-- Modal -->
						<div class="modal fade" id="deliveredModal" role="dialog">
							<div class="modal-dialog">    
								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title" style="text-align: center;">DELIVERED CONFIRMATION</h4>
									</div>
									<div class="modal-body">
										<form method="post" action="/orders/delivered/<?= $order->id?>">
											<label>Choose a delivery method</label>
											<select name="delivery_method_id">
										    	<?php foreach ($deliveryMethods as $deliveryMethod):?>
												    <option value="<?= $deliveryMethod->id?>"><?= $deliveryMethod->name?></option>
												<?php endforeach;?>
										    </select>

										    <label>Carrier: </label>
										    <input id="delivery_name" type="text" name="delivery_name" value="" placeholder="Carrier's name">

										    <label>Note: </label>
										    <input id="delivery_note" type="text" name="delivery_note" value="" placeholder="Note">

										    <input type="submit" value="Submit">
										</form>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</div>

							</div>
						</div>
					</div>
				<?php endif;?>
		    </div>
		</div>
	</div>
</div>