<div class="panel">
	<div class="panel-heading center">
		<h3>
			<?= __('Order')?> #<?= $order->order_code?>
		</h3>			
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-6">
				<h5 style="font-weight: bold"><?= __('Details')?></h5>
				<div class="row">
					<div class="col-md-6 padding-bot-5">
						<label class="italic bold"><?= __('Price')?>: </label>
						<span class="order-form-content bold"><?= $order->price?></span>
					</div>
					<div class="col-md-6 padding-bot-5">
						<label class="italic bold"><?= __('Quantity')?>: </label>
		        		<span class="order-form-content bold"><?= $order->quantity?></span>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 padding-bot-5">
						<label class="italic"><?= __('Order at')?>: </label>
		        		<span class="order-form-content"><?= $order->order_date?></span>
					</div>
					<div class="col-md-6 padding-bot-5">
						<?php if (!empty($order->sent)): ?>
							<label class="italic"><?= __('Sent at')?>: </label>
							<span class="order-form-content"><?= $order->sent?></span>
						<?php endif;?>
					</div>
				</div>
				<?php if (!empty($order->delivered)): ?>
					<div class="row">
						<div class="col-md-6 padding-bot-5">
					        <label class="italic bold"><?= __('Payment method')?>: </label>
					        <span class="order-form-content bold"><?= $order->payment_method->name?></span>
					    </div>
						<div class="col-md-6 padding-bot-5">
							<label class="italic"><?= __('Delivered at')?>: </label>
							<span class="order-form-content"><?= $order->delivered?></span>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 padding-bot-5">
					        <label class="italic"><?= __('Delivery method')?>: </label>
					        <span class="order-form-content"><?= $order->delivery_method->name?></span>
					    </div>
					    <div class="col-md-6 padding-bot-5">
					        <label class="italic bold"><?= __('Carrier')?>: </label>
					        <span class="order-form-content bold"><?= $order->delivery_name?></span>
					    </div>
					</div>
				<?php endif;?>
				<br>
				<h5 style="font-weight: bold"><?= __('Customer')?></h5>
				<div class="row">
					<div class="col-md-6 padding-bot-5">
						<label class="italic bold"><?= __('Name')?>: </label>
						<span class="order-form-content bold"><?= $order->customer->name?></span>
					</div>
					<div class="col-md-6 padding-bot-5">
						<label class="italic"><?= __('Nickname')?>: </label>
		        		<span class="order-form-content"><?= $order->customer->nickname?></span>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 padding-bot-5">
						<label class="italic bold"><?= __('Phone number')?>: </label>
		        		<span class="order-form-content bold"><?= $order->customer->phone?></span>
					</div>
					<div class="col-md-6 padding-bot-5">
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 padding-bot-5">
						<label class="italic bold"><?= __('Address')?>: </label>
		        		<span class="order-form-content bold"><?= $order->customer->address?></span>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<h5 style="font-weight: bold"><?= __('Product')?></h5>
				<div class="row">
					<div class="col-md-6 padding-bot-5">
						<label class="italic bold"><?= __('Label')?>: </label>
						<span class="order-form-content bold"><?= $order->product->name?></span>
					</div>
					<div class="col-md-6 padding-bot-5">
						<label class="italic"><?= __('Category')?>: </label>
	        			<span class="order-form-content"><?= $order->product->product_category->name?></span>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 padding-bot-5">
						<label class="italic"><?= __('Size')?>: </label>
		        		<span class="order-form-content"><?= $order->product->size?></span>
					</div>
					<div class="col-md-6 padding-bot-5">
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 padding-bot-5">
				        <label class="italic"><?= __('Note')?>: </label>
				    </div>
				    <div class="col-md-9 padding-bot-5">
				        <p><?= $order->create_note?></p>
						<p><?= $order->delivery_note?></p>
				    </div>						
				</div>
				<div class="row">
					<div class="col-md-3 padding-bot-5">
						<label class="italic"><?= __('Photo')?>: </label>
					</div>
					<div class="col-md-9 padding-bot-5">
		        		<img src="<?= !empty($order->product->product_photo->path) ? $order->product->product_photo->path : '' ?>" alt="Photo" style="max-width:  250px;">
					</div>
				</div>				
			</div>
		</div>		
	</div>
	<div class="panel-footer">
		<div class="row">			
			<div class="col-sm-6">
				<?= $this->Html->link(__('Edit'), ['action' => 'update', $order->id], ['class' => 'button button-link']) ?>
				<?= $this->Html->link(__('Print for shipper'), ['action' => 'print', $order->id, 1], ['class' => 'button button-link']) ?>
				<?= $this->Html->link(__('Print for carrier'), ['action' => 'print', $order->id, 2], ['class' => 'button button-link']) ?>
				<?= $this->Html->link(__('Print for post office'), ['action' => 'print', $order->id, 3], ['class' => 'button button-link']) ?>
			</div>
			<div class="col-sm-6">
				<?php if (empty($order->sent)): ?>
					<form method="post" action="/orders/sent/<?= $order->id?>" style="float: right;">
					    <input type="submit" value="<?= __('Sent')?>">
					</form>
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
										<h4 class="modal-title" style="text-align: center;"><?= __('CONFIRMATION')?></h4>
									</div>
									<div class="modal-body">
										<form method="post" action="/orders/delivered/<?= $order->id?>">
											<label><?= __('Choose a payment method')?></label>
											<select name="payment_method_id">
										    	<?php foreach ($paymentMethods as $paymentMethod):?>
												    <option value="<?= $paymentMethod->id?>"><?= $paymentMethod->name?></option>
												<?php endforeach;?>
										    </select>

											<label><?= __('Choose a delivery method')?></label>
											<select name="delivery_method_id">
										    	<?php foreach ($deliveryMethods as $deliveryMethod):?>
												    <option value="<?= $deliveryMethod->id?>"><?= $deliveryMethod->name?></option>
												<?php endforeach;?>
										    </select>

										    <label><?= __('Carrier')?>: </label>
										    <input id="delivery_name" type="text" name="delivery_name" value="" placeholder="<?= __('Carrier')?>">

										    <label><?= __('Note')?>: </label>
										    <input id="delivery_note" type="text" name="delivery_note" value="" placeholder="<?= __('Note')?>">

										    <input type="submit" value="<?= __('Submit')?>">
										</form>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal"><?= __('Close')?></button>
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