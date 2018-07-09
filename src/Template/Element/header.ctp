<!-- <div class="top-bar-section">
    <ul class="right">
        <li><?= $this->Html->link('Create an order', ['controller' => 'Orders', 'action' => 'create']) ?></li>
        <li><?= $this->Html->link('Seacrh', ['controller' => 'Searchs', 'action' => 'index']) ?></li>
        <li><a target="_blank" href="">Login</a></li>
    </ul>

    <select class="right" style="width: inherit;">
    	<option value="">Menu</option>
    	<option value="">
    		<?= $this->Html->link('Create an order', ['controller' => 'Orders', 'action' => 'create']) ?>
    	</option>
    	<option value="">
    		<?= $this->Html->link('Seacrh', ['controller' => 'Searchs', 'action' => 'index']) ?>
    	</option>
    	<option value="">
    		<?= $this->Html->link('Login', ['controller' => 'Users', 'action' => 'login']) ?>
    	</option>
    </select>


</div> -->

<div class="dropdown top-bar-dropdown right">
	<span style="color: #fff">Menu</span>
	<div class="dropdown-content">
		<p><?= $this->Html->link('Create an order', ['controller' => 'Orders', 'action' => 'create']) ?></p>
		<p><?= $this->Html->link('Seacrh', ['controller' => 'Searchs', 'action' => 'index']) ?></p>
		<p><?= $this->Html->link('Customers', ['controller' => 'Customers', 'action' => 'index']) ?></p>
		<p><?= $this->Html->link('Product Categories', ['controller' => 'ProductCategories', 'action' => 'index']) ?></p>
		<p><?= $this->Html->link('Login', ['controller' => 'Users', 'action' => 'login']) ?></p>
	</div>
</div>