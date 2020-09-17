{extends file="../layout/main.tpl"}

{$view->setTitle('Update Genre')}

{block name=content}

    <h1 class="title"> Update Genre </h1>

    <div class="row">
        <div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 col-sm-12">

            {include file='genre/_form.tpl'}

        </div>
    </div>

{/block}
