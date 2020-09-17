<?php

declare(strict_types=1);

namespace App\Library\Form;

use App\Library\Entity\Author;
use Yiisoft\Form\FormModel;
use Yiisoft\Validator\Rule\Boolean;
use Yiisoft\Validator\Rule\Required;
use Yiisoft\Validator\Rule\MatchRegularExpression;

final class AuthorForm extends FormModel
{
    private string $name = '';
    private string $surname = '';
    private string $birthday = '';
    private string $active = '';

    public function attributeLabels(): array
    {
        return [
            'name' => 'Name',
            'surname' => 'Surname',
            'birthday' => 'Birthday',
            'active' => 'Active',
        ];
    }

    public function formName(): string
    {
        return 'AuthorForm';
    }

    public function rules(): array
    {
        return [
            'name' => [new Required],
            'surname' => [new Required],
            'birthday' => [(new MatchRegularExpression('/^\d{4}-\d{2}-\d{2}$/'))->skipOnEmpty(true)],
            'active' => [new Boolean],
        ];
    }

    public function loadFromEntity(Author $entity)
    {
        $this->setAttribute('name', $entity->getName());
        $this->setAttribute('surname', $entity->getSurname());
        $this->setAttribute('birthday', $entity->getBirthday() ? $entity->getBirthday()->format('Y-m-d') : '');
        $this->setAttribute('active', (string) $entity->getActive());
    }
}
