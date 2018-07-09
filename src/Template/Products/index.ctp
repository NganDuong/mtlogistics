<table>
    <tr>
        <th><?= __('#')?></th>
        <th><?= __('Name')?></th>
        <th><?= __('Category')?></th>
        <th><?= __('Size')?></th>
        <th><?= __('Actions')?></th>
    </tr>
    <?php foreach ($products as $product): ?>

    <tr>
        <td><?= h($product->id) ?></td>
        <td><?= h($product->name) ?></td>
        <td><?= h($product->product_category->name) ?></td>
        <td><?= h($product->size) ?></td>
        <td>
            <?= $this->Html->link(__('Edit'), ['action' => 'update', $product->id]) ?>
            |
            <?= $this->Html->link(__('Delete'), ['action' => 'delete', $product->id]) ?>    
        </td>
    </tr>
    <?php endforeach; ?>
</table>