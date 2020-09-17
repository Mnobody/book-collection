<?php

declare(strict_types=1);

namespace App\Library\Form;

use App\Library\Entity\Book;
use App\Library\Form\Rule\Isbn;
use Yiisoft\Form\FormModel;
use Yiisoft\Validator\Rule\Boolean;
use Yiisoft\Validator\Rule\Number;
use Yiisoft\Validator\Rule\Required;

final class BookForm extends FormModel
{
    private string $title = '';
    private string $isbn = '';
    private string $page_count = '';
    private string $description = '';
    private string $price_net = '';
    private string $price_gross = '';
    private string $active = '';
    private string $authors = '';
    private string $genres = '';

    public function attributeLabels(): array
    {
        return [
            'title' => 'Title',
            'isbn' => 'Isbn',
            'page_count' => 'Page Count',
            'description' => 'Description',
            'price_net' => 'Price Net',
            'price_gross' => 'Price Gross',
            'active' => 'Active',
            'authors' => 'Authors',
            'genres' => 'Genres',
        ];
    }

    public function formName(): string
    {
        return 'BookForm';
    }

    public function rules(): array
    {
        return [
            'title' => [new Required],
            'isbn' => [(new Isbn)->skipOnEmpty(true)],
            'page_count' => [(new Number)->skipOnEmpty(true)],
            'price_net' => [new Required, new Number],
            'price_gross' => [new Required, new Number],
            'active' => [new Boolean],
        ];
    }

    public function loadFromEntity(Book $entity)
    {
        $this->setAttribute('title', $entity->getTitle());
        $this->setAttribute('isbn', $entity->getIsbn() ?? '');
        $this->setAttribute('page_count', $entity->getPageCount() ?? '');
        $this->setAttribute('description', $entity->getDescription() ?? '');
        $this->setAttribute('price_net', $entity->getPriceNet()); // todo: convert from integer (cents) (as stored in db) to decimal (currency)
        $this->setAttribute('price_gross', $entity->getPriceGross()); // todo: convert from integer (cents) (as stored in db) to decimal (currency)
        $this->setAttribute('active', (string) $entity->getActive());

        // authors
        $ids = [];
        foreach ($entity->getAuthors() as $author) {
            $ids[] = $author->getId();
        }
        $this->setAttribute('authors', implode(',', $ids));

        // genres
        $ids = [];
        foreach ($entity->getGenres() as $genre) {
            $ids[] = $genre->getId();
        }
        $this->setAttribute('genres', implode(',', $ids));
    }
}
