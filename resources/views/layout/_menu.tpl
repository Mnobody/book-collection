
{$parts = explode('/', $urlMatcher->getCurrentRoute()->getPattern())}
{$currentUrl = implode(['/', $parts[1]])}

{NavBar::begin()
    ->brandLabel($applicationParameters->getName())
    ->brandUrl('/')
    ->options(['class' => 'navbar navbar-expand navbar-light bg-light'])
    ->start()
}

{Nav::widget()
    ->currentPath($currentUrl)
    ->items([
        ['label' => 'Author', 'url' => $url->generate('author/index')],
        ['label' => 'Genre', 'url' => $url->generate('genre/index')]
    ])
    ->options(['class' => 'navbar-nav'])
}

{NavBar::end()}
