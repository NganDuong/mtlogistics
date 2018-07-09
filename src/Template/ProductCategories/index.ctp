<table>
    <tr>
        <th><?= __('No.')?></th>
        <th><?= __('Name')?></th>
        <th><?= __('Actions')?></th>
    </tr>
    <?php foreach ($categories as $category): ?>

    <tr>
        <td><?= h($category->id) ?></td>
        <td><?= h($category->name) ?></td>
        <td>
            <?= $this->Html->link(__('Edit'), ['action' => 'update', $category->id]) ?>
            |
            <?= $this->Html->link(__('Delete'), ['action' => 'delete', $category->id]) ?>    
        </td>
    </tr>
    <?php endforeach; ?>
</table>