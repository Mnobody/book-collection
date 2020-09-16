
{extends file="../layout/main.tpl"}

{$view->setTitle('Create Genre')}

{block name=content}

    <h1 class="title"> Create Genre </h1>

    <div class="row">
        <div class="col-4 offset-4">

            {include file='genre/_form.tpl'}

        </div>
    </div>

{/block}
