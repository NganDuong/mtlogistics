<table>
    <tr>
        <th><?= __('Name')?></th>
        <th><?= __('Nickname')?></th>
        <th><?= __('Phone number')?></th>
        <th><?= __('Address')?></th>
        <th><?= __('Actions')?></th>
    </tr>
    <?php foreach ($customers as $customer): ?>
    <tr>
        <td><?= h($customer->name) ?></td>
        <td><?= h($customer->nickname) ?></td>
        <td><?= h($customer->phone) ?></td>
        <td><?= h($customer->address) ?></td>
        <td>
            <?= $this->Html->link('Edit', ['action' => 'update', $customer->id]) ?>
            |
            <?= $this->Html->link('Delete', ['action' => 'delete', $customer->id]) ?>    
        </td>
    </tr>
    <?php endforeach; ?>
</table>