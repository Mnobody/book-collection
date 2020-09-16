
<div class="row">
    <div class="col-10">
        <span class="badge bg-info">Id: </span> {$model->getId()} |
        <span class="badge bg-info"> Name: </span> {$model->getName()} |
        <span class="badge bg-info"> Activity: </span> {if $model->getActive()} Active {else} Inactive {/if}
    </div>
    <div class="col-2 text-right">
        <a href="/genre/update/{$model->getId()}"> Update </a>
        &nbsp;
        <a href="/genre/delete/{$model->getId()}"> Delete </a>
    </div>
</div>


<hr>
