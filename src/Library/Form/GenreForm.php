<?php
declare(strict_types=1);

namespace App\Library\Form;

use App\Library\Entity\Genre;
use Yiisoft\Form\FormModel;
use Yiisoft\Validator\Rule\Boolean;
use Yiisoft\Validator\Rule\Required;

final class GenreForm extends FormModel
{
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

    public function loadFromEntity(Genre $entity)
    {
        $this->setAttribute('name', $entity->getName());
        $this->setAttribute('active', (string) $entity->getActive());
    }
}
