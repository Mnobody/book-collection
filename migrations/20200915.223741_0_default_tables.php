<?php

namespace App\Migration;

use Spiral\Migrations\Migration;

class OrmDefault94427fd26a3c59d57cb1afbbe0c16ab7 extends Migration
{
    protected const DATABASE = 'default';

    const ISBN_LENGTH = 13;

    public function up()
    {
        $this->author();
        $this->book();
        $this->genre();

        $this->book_author();
        $this->book_genre();
    }

    public function down()
    {
        $this->table('book_author')->drop();
        $this->table('book_genre')->drop();

        $this->table('author')->drop();
        $this->table('book')->drop();
        $this->table('genre')->drop();
    }

    private function author()
    {
        $schema = $this->table('author')->getSchema();

        $schema->bigPrimary('id');
        $schema->string('name')->nullable(false);
        $schema->string('surname')->nullable(false);
        $schema->timestamp('birthday');
        $schema->boolean('active');

        $schema->save();
    }

    private function book()
    {
        $schema = $this->table('book')->getSchema();

        $schema->bigPrimary('id');
        $schema->string('title')->nullable(false);
        $schema->string('isbn', self::ISBN_LENGTH);
        $schema->integer('page_count');
        $schema->string('description');
        $schema->integer('price_net')->nullable(false);
        $schema->integer('price_gross')->nullable(false);
        $schema->boolean('active');

        $schema->save();
    }

    private function genre()
    {
        $schema = $this->table('genre')->getSchema();

        $schema->bigPrimary('id');
        $schema->string('name')->nullable(false);
        $schema->boolean('active');

        $schema->save();
    }

    private function book_author()
    {
        $schema = $this->table('book_author')->getSchema();

        $schema->bigPrimary('id');
        $schema->bigInteger('book_id')->nullable(false);
        $schema->bigInteger('author_id')->nullable(false);

        $schema->foreignKey(['book_id'])->references('book', ['id']);
        $schema->foreignKey(['author_id'])->references('author', ['id']);

        $schema->save();
    }

    private function book_genre()
    {
        $schema = $this->table('book_genre')->getSchema();

        $schema->bigPrimary('id');
        $schema->bigInteger('book_id')->nullable(false);
        $schema->bigInteger('genre_id')->nullable(false);

        $schema->foreignKey(['book_id'])->references('book', ['id']);
        $schema->foreignKey(['genre_id'])->references('genre', ['id']);

        $schema->save();
    }
}
