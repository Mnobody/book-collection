
<div class="form">
    {Form::begin()
        ->action($actionUrl)
        ->options([
            'id' => 'form-author',
            'csrf' => $csrf
        ])
        ->start()
    }

    {$field->config($form, 'id')->hiddenInput()}
    {$field->config($form, 'name')}
    {$field->config($form, 'surname')}
    {$field->config($form, 'birthday')->textInput(['autocomplete' => 'off'])}
    {$field->config($form, 'active')->checkbox(['class' => 'mt-4'])}

    {Html::submitButton('Save', [
        'id' => 'author-button',
        'class' => 'btn btn-block btn-primary mt-4'
    ])}

    {Form::end()}

    <script type="application/javascript">
        document.addEventListener('DOMContentLoaded', function (event) {
            $(function () {
                $("#authorform-birthday").datepicker({
                    dateFormat: "yy-mm-dd"
                });
            });
        });
    </script>
</div>
