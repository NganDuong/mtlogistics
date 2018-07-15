<div class="header-top-right right">
	<span style="color: #fff">
		<?= $this->Html->link(__('Create an order'), ['controller' => 'Orders', 'action' => 'create']) ?>
	</span>
	|
	<span style="color: #fff">
		<?= $this->Html->link(__('Search'), ['controller' => 'Searchs', 'action' => 'index']) ?>
	</span>
	|
	<div class="dropdown top-bar-dropdown">
		<span style="color: #fff">Menu</span>
		<div class="dropdown-content">
			<p><?= $this->Html->link(__('Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></p>
			<p><?= $this->Html->link(__('Product Categories'), ['controller' => 'ProductCategories', 'action' => 'index']) ?></p>
			<p>
				<?= $this->Html->link(__('Login'), ['controller' => 'Users', 'action' => 'login']) ?>
			</p>
		</div>
	</div>
</div>	