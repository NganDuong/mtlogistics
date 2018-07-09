<div class="dropdown top-bar-dropdown right">
	<span style="color: #fff">Menu</span>
	<div class="dropdown-content">
		<p><?= $this->Html->link(__('Create an order'), ['controller' => 'Orders', 'action' => 'create']) ?></p>
		<p><?= $this->Html->link(__('Search'), ['controller' => 'Searchs', 'action' => 'index']) ?></p>
		<p><?= $this->Html->link(__('Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></p>
		<p><?= $this->Html->link(__('Product Categories'), ['controller' => 'ProductCategories', 'action' => 'index']) ?></p>
		<p><?= $this->Html->link(__('Login'), ['controller' => 'Users', 'action' => 'login']) ?></p>
	</div>
</div>