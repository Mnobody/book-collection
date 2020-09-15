
{$currentUrl = $url->generate($urlMatcher->getCurrentRoute()->getName())}

{NavBar::begin()
    ->brandLabel($applicationParameters->getName())
    ->brandUrl('/')
    ->options(['class' => 'navbar navbar-expand navbar-light bg-light'])
    ->start()
}

{Nav::widget()
    ->currentPath($currentUrl)
    ->items([
        ['label' => 'About', 'url' => $url->generate('site/about')],
        ['label' => 'Contact', 'url' => $url->generate('contact/form')]
    ])
    ->options(['class' => 'navbar-nav'])
}

{NavBar::end()}
