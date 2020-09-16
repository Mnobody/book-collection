<?php
declare(strict_types=1);

namespace App\Library\Form;

use Yiisoft\Form\FormModel;
use Yiisoft\Validator\Rule\Boolean;
use Yiisoft\Validator\Rule\Required;

final class GenreForm extends FormModel
{
    private ?int $id = null;
    private string $name = '';
    private string $active = '';

    public function attributeLabels(): array
    {
        return [
            'name' => 'Name',
            'active' => 'Active',
        ];
    }

    public function formName(): string
    {
        return 'GenreForm';
    }

    public function rules(): array
    {
        return [
            'name' => [new Required],
            'active' => [new Boolean],
        ];
    }
}
