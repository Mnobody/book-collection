
<head>
    <meta charset="{Html::encode($applicationParameters->getCharset())}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {if $view->getTitle() !== null}
        <title> {Html::encode($this->getTitle())} </title>
    {/if}
    {$view->head()}
</head>
