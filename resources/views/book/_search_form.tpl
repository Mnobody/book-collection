
<div class="form">
    {Form::begin()
        ->action($url->generate('book/index'))
        ->options([
            'id' => 'form-search',
            'csrf' => $csrf
        ])
        ->start()
    }

    <div class="row">
        <div class="col-10 my-auto">
            {$field->config($form, 'q')->textInput()->label('')}
        </div>
        <div class="col-2 my-auto">
            {Html::submitButton('Search', [
                'class' => 'btn btn-success'
            ])}
        </div>
    </div>

    {Form::end()}

</div>
