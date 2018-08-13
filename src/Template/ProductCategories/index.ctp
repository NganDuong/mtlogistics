<br>
<h3 class="center highlight-color"><?= __('List of product categories')?></h3>
<?= $this->Html->link(__('Create'), ['action' => 'create'], ['class' => 'right']) ?>
<div class="table-responsive">
    <table class="table">
        <tr>
            <th><?= __('No.')?></th>
            <th><?= __('Name')?></th>
            <th><?= __('Actions')?></th>
        </tr>
        <?php foreach ($results as $result): ?>
        <tr>
            <td><?= h($result->id) ?></td>
            <td><?= h($result->name) ?></td>
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