
<div class="row">
    <div class="col-10">
        <span class="badge bg-info">Id: </span> {$model->getId()} |
        <span class="badge bg-info"> Name: </span> {$model->getName()} |
        <span class="badge bg-info"> Surname: </span> {$model->getSurname()} |
        {if $model->getBirthday()} <span class="badge bg-info"> Birthday: </span> {$model->getBirthday()|date_format} | {/if}
        <span class="badge bg-info"> Activity: </span> {if $model->getActive()} Active {else} Inactive {/if}
    </div>
    <div class="col-2 text-right">
        <a href="/author/update/{$model->getId()}"> Update </a>
        &nbsp;
        <a href="/author/delete/{$model->getId()}"> Delete </a>
    </div>
</div>


<hr>
