{extends file="../layout/main.tpl"}

{$view->setTitle('Update Book')}

{block name=content}

    <h1 class="title"> Update Book </h1>

    <div class="row">
        <div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 col-sm-12">

            {include file='book/_form.tpl'}

        </div>
    </div>

{/block}
