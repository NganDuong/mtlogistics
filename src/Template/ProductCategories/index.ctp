<table>
    <tr>
        <th><?= __('#')?></th>
        <th><?= __('Name')?></th>
        <th><?= __('Actions')?></th>
    </tr>
    <?php foreach ($categories as $category): ?>

    <tr>
        <td><?= h($category->id) ?></td>
        <td><?= h($category->name) ?></td>
        <td>
            <?= $this->Html->link('Edit', ['action' => 'update', $category->id]) ?>
            |
            <?= $this->Html->link('Delete', ['action' => 'delete', $category->id]) ?>    
        </td>
    </tr>
    <?php endforeach; ?>
</table>