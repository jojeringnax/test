<?php
/**
 * @var $tasks \app\models\Task[]
 */
$pag = new \jojer\other\Paginator($tasks);
?>
<?= $pag ?>

<div style="width: 200px;padding: 0 15px;" class="legend">
    <div class="flex flex-row">
        <div class="bg-success" style="width: 40px;height: 40px;"></div>
        <span>Active</span>
    </div>
    <div class="flex flex-row">
        <div class="bg-danger" style="width: 40px;height: 40px;"></div>
        <span>Finished</span>
    </div>
</div>
<a  href="/task/create" style="width: 300px;height:100px" class="btn btn-success">Add task</a>


