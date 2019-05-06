<?php
/**
 * @var $task \app\models\Task
 */
?>
<div class="card">
    <div class="card-header <?= $task->status ? 'bg-danger' : 'bg-success'?>">
        Task number <?= $task->id ?>
    </div>
    <div class="card-body">
        <h5 class="card-title">For user <?= $task->username ?></h5>
        <p class="card-text"><?= $task->content ?></p>
        <a href="/admin" class="btn btn-primary">Back</a>
        <a href="/task/delete?id=<?= $task->id ?>" class="btn btn-danger">Delete</a>
    </div>
</div>
