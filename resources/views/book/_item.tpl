
<div class="row">
    <div class="col-10">
        <span class="badge bg-info"> Id: </span> {$model->getId()} |
        <span class="badge bg-info"> Title: </span> {$model->getTitle()} |
        {if $model->getIsbn()} <span class="badge bg-info"> Isbn: </span> {$model->getIsbn()} | {/if}
        {if $model->getPageCount()} <span class="badge bg-info"> Page Count: </span> {$model->getPageCount()} | {/if}
        {if $model->getDescription()} <span class="badge bg-info"> Description: </span> {$model->getDescription()} | {/if}
        <span class="badge bg-info"> Price Net: </span> {$model->getPriceNet()} |
        <span class="badge bg-info"> Price Gross: </span> {$model->getPriceGross()} |
        {if !$model->getAuthors()->isEmpty()} <span class="badge bg-info"> Authors: </span>
            {$authors = []}
            {foreach from=$model->getAuthors() item=author}
                {$count = array_push($authors, implode(' ', [$author->getName(), $author->getSurname()]))}
            {/foreach}
            {implode(', ', $authors)} |
        {/if}
        {if !$model->getGenres()->isEmpty()} <span class="badge bg-info"> Genres: </span>
            {$genres = []}
            {foreach from=$model->getGenres() item=genre}
                {$count = array_push($genres, $genre->getName())}
            {/foreach}
            {implode(', ', $genres)} |
        {/if}
        <span class="badge bg-info"> Activity: </span> {if $model->getActive()} Active {else} Inactive {/if}
    </div>
    <div class="col-2 text-right">
        <a href="/book/update/{$model->getId()}"> Update </a>
        &nbsp;
        <a href="/book/delete/{$model->getId()}"> Delete </a>
    </div>
</div>


<hr>
