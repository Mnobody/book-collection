<?php

declare(strict_types=1);

namespace App\Library\Form;

use Yiisoft\Form\FormModel;
use Yiisoft\Validator\Rule\Required;

final class SearchForm extends FormModel
{
    private string $q = '';

    public function attributeLabels(): array
    {
        return [
            'q' => 'Query',
        ];
    }

    public function formName(): string
    {
        return 'SearchForm';
    }

    public function rules(): array
    {
        return [
            'q' => [new Required],
        ];
    }
}
