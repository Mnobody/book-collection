{extends file="../layout/main.tpl"}

{$view->setTitle('Update Author')}

{block name=content}

    <h1 class="title"> Update Author </h1>

    <div class="row">
        <div class="col-4 offset-4">

            {include file='author/_form.tpl'}

        </div>
    </div>

{/block}
