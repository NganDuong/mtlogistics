<?php if(!empty($orders)):?>
    <?php foreach($orders as $order):?>
        <div class="container">
            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a data-toggle="collapse" href="#collapse1">
                            <h4 class="panel-title">
                                <table>
                                    <tr>
                                        <th>No. </th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Order at</th>
                                        <th>Order's notes</th>
                                    </tr>
                                    <tr>
                                        <td><?= h($order->order_code) ?></td>
                                        <td><?= h($order->price) ?></td>
                                        <td><?= h($order->quantity) ?></td>
                                        <td><?= h($order->order_date) ?></td>
                                        <td>
                                            <p>
                                                <?= h($order->create_note) ?>
                                            </p>
                                            <p>
                                                <?= h($order->delivery_note) ?>
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            </h4>
                        </a>            
                    </div>
                    <div id="collapse1" class="panel-collapse collapse">
                        <div class="panel-body">
                            <h4 class="panel-title">Customer</h4>
                            <table>
                                <tr>
                                    <th><?= __('Name')?></th>
                                    <th><?= __('Nickname')?></th>
                                    <th><?= __('Phone number')?></th>
                                    <th><?= __('Address')?></th>
                                </tr>
                                <tr>
                                    <td><?= h($order->customer->name) ?></td>
                                    <td><?= h($order->customer->nickname) ?></td>
                                    <td><?= h($order->customer->phone) ?></td>
                                    <td><?= h($order->customer->address) ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="panel-footer">
                            <h4 class="panel-title">Product</h4>
                            <table>
                                <tr>
                                    <th><?= __('#')?></th>
                                    <th><?= __('Name')?></th>
                                    <th><?= __('Category')?></th>
                                    <th><?= __('Size')?></th>
                                </tr>
                                <tr>
                                    <td><?= h($order->product->id) ?></td>
                                    <td><?= h($order->product->name) ?></td>
                                    <td><?= h($order->product->product_category->name) ?></td>
                                    <td><?= h($order->product->size) ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach?>
<?php endif?>