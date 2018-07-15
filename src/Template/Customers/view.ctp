<table>
    <tr>
        <th><?= __('Name')?></th>
        <th><?= __('Nickname')?></th>
        <th><?= __('Phone number')?></th>
        <th><?= __('Address')?></th>
        <th><?= __('Actions')?></th>
    </tr>
    <tr>
        <td><?= h($customer->name) ?></td>
        <td><?= h($customer->nickname) ?></td>
        <td><?= h($customer->phone) ?></td>
        <td><?= h($customer->address) ?></td>
        <td>
            <?= $this->Html->link(__('Edit'), ['action' => 'update', $customer->id]) ?>
            |
            <?= $this->Html->link(__('Delete'), ['action' => 'delete', $customer->id]) ?>    
        </td>
    </tr>
</table>