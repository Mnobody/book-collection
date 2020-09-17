<?php

declare(strict_types=1);

namespace App\Library\Controller;

use App\Library\Entity\Author;
use App\Library\Form\AuthorForm;
use App\Library\Repository\AuthorRepository;
use App\Library\Service\AuthorService;
use Cycle\ORM\ORMInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ServerRequestInterface;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Http\Header;
use App\View\ViewRenderer;
use Psr\Http\Message\ResponseInterface;
use Yiisoft\Http\Method;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\DataResponse\DataResponseFactoryInterface;
use Yiisoft\Session\Flash\Flash;

final class AuthorController
{
    private ViewRenderer $viewRenderer;
    private ResponseFactoryInterface $responseFactory;

    public function __construct(ViewRenderer $viewRenderer, ResponseFactoryInterface $responseFactory)
    {
        $this->viewRenderer = $viewRenderer->withControllerName('author');
        $this->responseFactory = $responseFactory;
    }

    public function index(ORMInterface $orm, Aliases $aliases): ResponseInterface
    {
        /** @var AuthorRepository $repository */
        $repository = $orm->getRepository(Author::class);

        $dataReader = $repository->list();

        return $this->viewRenderer->render('index', [
            'dataReader' => $dataReader,
            'viewItem' => $aliases->get('@views/author/_item.tpl'),
            'classes' => [
                'ListView' => \App\Widget\ListView::class
            ]
        ]);
    }

    public function create(AuthorForm $form, AuthorService $service, Flash $flash, UrlGeneratorInterface $url, ServerRequestInterface $request): ResponseInterface
    {
        $body = $request->getParsedBody();
        $method = $request->getMethod();

        if (($method === Method::POST) && $form->load($body) && $form->validate()) {

            $service->create($form);

            $flash->add('success', ['body' => 'New author successfully created'], true);

            return $this->responseFactory
                ->createResponse(302)
                ->withHeader(Header::LOCATION, $url->generate('author/index'));
        }

        return $this->viewRenderer->withCsrf()->render('create', [
            'form' => $form,
            'actionUrl' => $url->generate('author/create'),
            'classes' => [
                'Form' => \Yiisoft\Form\Widget\Form::class,
            ]
        ]);
    }

    public function update(AuthorForm $form, AuthorService $service, ORMInterface $orm, Flash $flash, UrlGeneratorInterface $url, ServerRequestInterface $request): ResponseInterface
    {
        $id = $request->getAttribute('id');
        $body = $request->getParsedBody();
        $method = $request->getMethod();

        /** @var AuthorRepository $repository */
        $repository = $orm->getRepository(Author::class);
        /** @var Author $author */
        $author = $repository->findOne(['id' => $id]);

        $form->loadFromEntity($author);

        if (($method === Method::POST) && $form->load($body) && $form->validate()) {

            $service->update((int) $id, $form);

            $flash->add('success', ['body' => 'Author successfully updated'], true);

            return $this->responseFactory
                ->createResponse(302)
                ->withHeader(Header::LOCATION, $url->generate('author/index'));
        }

        return $this->viewRenderer->withCsrf()->render('update', [
            'form' => $form,
            'actionUrl' => $url->generate('author/update', ['id' => $id]),
            'classes' => [
                'Form' => \Yiisoft\Form\Widget\Form::class,
            ]
        ]);
    }

    public function delete(AuthorService $service, ServerRequestInterface $request, Flash $flash, DataResponseFactoryInterface $responseFactory, UrlGeneratorInterface $url): ResponseInterface
    {
        $service->delete((int) $request->getAttribute('id'));

        $flash->add('success', ['body' => 'Author successfully deleted'], true);

        return $responseFactory
            ->createResponse(302)
            ->withHeader(Header::LOCATION, $url->generate('author/index'));
    }
}
