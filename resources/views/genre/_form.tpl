
<div class="form">
    {Form::begin()
        ->action($actionUrl)
        ->options([
            'id' => 'form-genre',
            'csrf' => $csrf
        ])
        ->start()
    }

    {$field->config($form, 'id')->hiddenInput()}
    {$field->config($form, 'name')}
    {$field->config($form, 'active')->checkbox(['class' => 'mt-4'])}

    {Html::submitButton('Save', [
        'id' => 'genre-button',
        'class' => 'btn btn-block btn-primary mt-4'
    ])}

    {Form::end()}
</div>
