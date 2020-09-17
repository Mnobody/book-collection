
{extends file="../layout/main.tpl"}

{$view->setTitle('Book')}

{block name=content}

    <h1 class="title"> Book </h1>

    <a href="/book/create" class="btn btn-primary"> Create New Book </a>

    <div class="row">
        <div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 col-sm-12 mb-4">

            {include file='book/_search_form.tpl'}

        </div>
    </div>

    <div class="mt-4">
        {ListView::widget()
            ->dataReader($dataReader)
            ->itemView($viewItem)
        }
    </div>

{/block}
