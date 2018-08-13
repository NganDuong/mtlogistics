<table>
    <tr>
        <th><?= __('Name')?></th>
        <th><?= __('Nickname')?></th>
        <th><?= __('Phone number')?></th>
        <th><?= __('Address')?></th>
        <th><?= __('Actions')?></th>
    </tr>
    <tr>
        <td><?= h($object->name) ?></td>
        <td><?= h($object->nickname) ?></td>
        <td><?= h($object->phone) ?></td>
        <td><?= h($object->address) ?></td>
        <td>
            <?= $this->Html->link(__('Edit'), ['action' => 'update', $object->id]) ?>
            |
            <?= $this->Html->link(__('Delete'), ['action' => 'delete', $object->id]) ?>    
        </td>
    </tr>
</table>