
<h1>Users</h1>
<ul>
    <li><?= $this->Html->link(__('add User'), ['action' => 'add']) ?></li>
</ul>
<table>
    <thead>
    <tr>
        <th>id</th>
        <th>username</th>
        <th>password</th>
        <th>role</th>
        <th>created</th>
        <th>modified</th>
        <th class="actions">Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($users as $user): ?>
    <tr>
        <td><?= $user->id ?></td>
        <td><?= h($user->username) ?></td>
        <td><?= $user->password ?></td>
        <td><?= $user->role ?></td>
        <td><?= $user->created ?></td>
        <td><?= $user->modified ?></td>
        <td class="actions">
            <?= $this->Html->link('View',['action' => 'view', $user->id]) ?>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
