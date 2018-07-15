<table>
    <tr>
        <th><?= __('#')?></th>
        <th><?= __('Username')?></th>
        <th><?= __('Role')?></th>
        <th><?= __('Actions')?></th>
    </tr>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= h($user->id) ?></td>
            <td><?= h($user->username) ?></td>
            <td><?= h($user->user_role->name) ?></td>
            <td>
                <?= $this->Html->link(__('Delete'), ['action' => 'delete', $user->id]) ?>    
            </td>
        </tr>
    <?php endforeach; ?>
</table>