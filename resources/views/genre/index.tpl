
{extends file="../layout/main.tpl"}

{$view->setTitle('Genre')}

{block name=content}

    <h1 class="title"> Genre </h1>

    <a href="/genre/create" class="btn btn-primary"> Create New Genre </a>

    <div class="mt-4">
        {ListView::widget()
            ->dataReader($dataReader)
            ->itemView($viewItem)
        }
    </div>

{/block}
