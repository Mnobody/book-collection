
{extends file="../layout/main.tpl"}

{$view->setTitle('Book')}

{block name=content}

    <h1 class="title"> Book </h1>

    <a href="/book/create" class="btn btn-primary"> Create New Book </a>

    <div class="mt-4">
        {ListView::widget()
            ->dataReader($dataReader)
            ->itemView($viewItem)
        }
    </div>

{/block}
