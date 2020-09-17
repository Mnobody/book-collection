
<div class="form">
    {Form::begin()
        ->action($actionUrl)
        ->options([
            'id' => 'form-book',
            'csrf' => $csrf
        ])
        ->start()
    }

    {$field->config($form, 'title')}
    {$field->config($form, 'isbn')}
    {$field->config($form, 'page_count')}
    {$field->config($form, 'description')->textArea(['rows' => 4])}
    {$field->config($form, 'price_net')}
    {$field->config($form, 'price_gross')}
    {$field->config($form, 'active')->checkbox(['class' => 'mt-4'])}

    {Html::submitButton('Save', [
        'id' => 'author-button',
        'class' => 'btn btn-block btn-primary mt-4'
    ])}

    {Form::end()}

    <script type="application/javascript">
        document.addEventListener('DOMContentLoaded', function (event) {

        });
    </script>
</div>
