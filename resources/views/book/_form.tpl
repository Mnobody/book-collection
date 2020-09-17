
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

    {$field->config($form, 'authors')->hiddenInput()}
    {$field->config($form, 'genres')->hiddenInput()}

    <div class="mt-4">
        <h5>
            Authors
        </h5>
        <ol class="selectable-list" data-input-id="bookform-authors">
            {foreach from=$authors item=author}
                <li class="ui-widget-content" data-id="{$author->getId()}">{implode(' ', [$author->getName(), $author->getSurname()])}</li>
            {/foreach}
        </ol>
    </div>

    <div class="mt-4">
        <h5>
            Genres
        </h5>
        <ol class="selectable-list" data-input-id="bookform-genres">
            {foreach from=$genres item=genre}
                <li class="ui-widget-content" data-id="{$genre->getId()}">{$genre->getName()}</li>
            {/foreach}
        </ol>
    </div>

    {Html::submitButton('Save', [
        'id' => 'author-button',
        'class' => 'btn btn-block btn-primary mt-4'
    ])}

    {Form::end()}

    <script type="application/javascript">
        document.addEventListener('DOMContentLoaded', function (event) {

            // highlight selected
            $(".selectable-list").each(function() {
                let self = $(this);
                let input = $('#' + self.data('input-id'));
                let ids = input.val().length ? input.val().split(',') : [];
                ids.forEach(function (id) {
                    let li = self.find('li[data-id="' + id + '"]');
                    li.addClass('ui-selected');
                });
            });

            $(".selectable-list").selectable({
                selected: function(event, ui) {
                    let selected = $(ui.selected);
                    let input = $('#' + selected.closest('ol[data-input-id]').data('input-id'));
                    let val = input.val();
                    let ids = val.length ? val.split(',') : [];
                    let id = selected.data('id');

                    if (ids.indexOf(id.toString()) === -1) {
                        ids.push(selected.data('id'));
                    }
                    input.val(ids.join(','));
                },
                unselected: function(event, ui) {
                    let unselected = $(ui.unselected);
                    let input = $('#' + unselected.closest('ol[data-input-id]').data('input-id'));
                    let val = input.val();
                    let ids = val.length ? val.split(',') : [];
                    let id = unselected.data('id');

                    let position = ids.indexOf(id.toString());
                    if (position >= 0) {
                        ids.splice(position, 1);
                    }
                    input.val(ids.join(','));
                }
            });
        });
    </script>
</div>
