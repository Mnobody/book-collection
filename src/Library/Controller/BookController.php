<?php

declare(strict_types=1);

namespace App\Library\Controller;

use App\Library\Entity\Author;
use App\Library\Entity\Book;
use App\Library\Entity\Genre;
use App\Library\Form\BookForm;
use App\Library\Form\SearchForm;
use App\Library\Repository\BookRepository;
use App\Library\Service\BookService;
use App\View\ViewRenderer;
use Cycle\ORM\ORMInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\DataResponse\DataResponseFactoryInterface;
use Yiisoft\Http\Header;
use Yiisoft\Http\Method;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Session\Flash\Flash;

final class BookController
{
    private ViewRenderer $viewRenderer;
    private ResponseFactoryInterface $responseFactory;

    public function __construct(ViewRenderer $viewRenderer, ResponseFactoryInterface $responseFactory)
    {
        $this->viewRenderer = $viewRenderer->withControllerName('book');
        $this->responseFactory = $responseFactory;
    }

    public function index(SearchForm $form, ORMInterface $orm, Aliases $aliases, ServerRequestInterface $request): ResponseInterface
    {
        $body = $request->getParsedBody();
        $method = $request->getMethod();

        /** @var BookRepository $repository */
        $repository = $orm->getRepository(Book::class);

        if (($method === Method::POST) && $form->load($body) && $form->validate()) {
            $dataReader = $repository->search($form->getAttributeValue('q'));
        } else {
            $dataReader = $repository->list();
        }

        return $this->viewRenderer->withCsrf()->render('index', [
            'form' => $form,
            'dataReader' => $dataReader,
            'viewItem' => $aliases->get('@views/book/_item.tpl'),
            'classes' => [
                'ListView' => \App\Widget\ListView::class,
                'Form' => \Yiisoft\Form\Widget\Form::class,
            ]
        ]);
    }

    public function create(BookForm $form, BookService $service, ORMInterface $orm, Flash $flash, UrlGeneratorInterface $url, ServerRequestInterface $request): ResponseInterface
    {
        $body = $request->getParsedBody();
        $method = $request->getMethod();

        if (($method === Method::POST) && $form->load($body) && $form->validate()) {

            $service->create($form);

            $flash->add('success', ['body' => 'New book successfully created'], true);

            return $this->responseFactory
                ->createResponse(302)
                ->withHeader(Header::LOCATION, $url->generate('book/index'));
        }

        return $this->viewRenderer->withCsrf()->render('create', [
            'form' => $form,
            'actionUrl' => $url->generate('book/create'),
            'authors' => $orm->getRepository(Author::class)->allActive(),
            'genres' => $orm->getRepository(Genre::class)->allActive(),
            'classes' => [
                'Form' => \Yiisoft\Form\Widget\Form::class,
            ]
        ]);
    }

    public function update(BookForm $form, BookService $service, ORMInterface $orm, Flash $flash, UrlGeneratorInterface $url, ServerRequestInterface $request): ResponseInterface
    {
        $id = $request->getAttribute('id');
        $body = $request->getParsedBody();
        $method = $request->getMethod();

        /** @var BookRepository $repository */
        $repository = $orm->getRepository(Book::class);
        /** @var Book $book */
        $book = $repository->findOne(['id' => $id]);

        $form->loadFromEntity($book);

        if (($method === Method::POST) && $form->load($body) && $form->validate()) {

            $service->update((int) $id, $form);

            $flash->add('success', ['body' => 'Book successfully updated'], true);

            return $this->responseFactory
                ->createResponse(302)
                ->withHeader(Header::LOCATION, $url->generate('book/index'));
        }

        return $this->viewRenderer->withCsrf()->render('update', [
            'form' => $form,
            'actionUrl' => $url->generate('book/update', ['id' => $id]),
            'authors' => $orm->getRepository(Author::class)->allActive(),
            'genres' => $orm->getRepository(Genre::class)->allActive(),
            'classes' => [
                'Form' => \Yiisoft\Form\Widget\Form::class,
            ]
        ]);
    }

    public function delete(BookService $service, ServerRequestInterface $request, Flash $flash, DataResponseFactoryInterface $responseFactory, UrlGeneratorInterface $url): ResponseInterface
    {
        $service->delete((int) $request->getAttribute('id'));

        $flash->add('success', ['body' => 'Book successfully deleted'], true);

        return $responseFactory->createResponse(302)
            ->withHeader(Header::LOCATION, $url->generate('book/index'));
    }
}
