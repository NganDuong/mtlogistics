<br>
<h3 class="center highlight-color"><?= __('List of customers')?></h3>
<div class="table-responsive">
    <table class="table">
        <tr>
            <th><?= __('Name')?></th>
            <th><?= __('Nickname')?></th>
            <th><?= __('Phone number')?></th>
            <th><?= __('Address')?></th>
            <th><?= __('Actions')?></th>
        </tr>
        <?php foreach ($results as $result): ?>
        <tr>
            <td><?= h($result->name) ?></td>
            <td><?= h($result->nickname) ?></td>
            <td><?= h($result->phone) ?></td>
            <td><?= h($result->address) ?></td>
            <td class="center">
                <?= $this->Html->link(__('Edit'), ['action' => 'update', $result->id]) ?>
                |
                <?= $this->Html->link(__('Delete'), ['action' => 'delete', $result->id]) ?>    
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <div class="pagination">
        <?= ($prev > 0) ? $this->Html->link(__('< prev'), ['action' => 'index', $prev]) : '' ?>
        <?= ($next > 0) ? $this->Html->link(__('next >'), ['action' => 'index', $next]) : '' ?>
    </div>
</div>