
{$assetManager->register([AppAsset::class, CdnFontAwesomeAsset::class])}

{$view->setCssFiles($assetManager->getCssFiles())}
{$view->setJsFiles($assetManager->getJsFiles())}

{$view->beginPage()}
<!DOCTYPE html>
<html lang="{Html::encode($applicationParameters->getLanguage())}" class="h-100">
    {include file='layout/_head.tpl'}
    {$view->beginBody()}
    <body class="d-flex flex-column h-100">

        <header>
            {include file='layout/_menu.tpl'}
        </header>

        <main class="flex-shrink-0">
            <div class="container my-3">
                {FlashMessage::widget()}
                {block name=content}{/block}
            </div>
        </main>

        {include file='layout/_footer.tpl'}
    </body>
    {$view->endBody()}
</html>
{$view->endPage()}


