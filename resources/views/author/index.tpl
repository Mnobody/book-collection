
{extends file="../layout/main.tpl"}

{$view->setTitle('Author')}

{block name=content}

    <h1 class="title"> Author </h1>

    <a href="/author/create" class="btn btn-primary"> Create New Author </a>

    <div class="mt-4">
        {ListView::widget()
            ->dataReader($dataReader)
            ->itemView($viewItem)
        }
    </div>

{/block}
