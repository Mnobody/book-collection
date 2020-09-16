<?php

declare(strict_types=1);

namespace App\Library\Controller;

use App\Library\Entity\Genre;
use App\Library\Form\GenreForm;
use App\Library\Repository\GenreRepository;
use App\Library\Service\GenreService;
use App\View\ViewRenderer;
use Cycle\ORM\ORMInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Yiisoft\Aliases\Aliases;
use Yiisoft\DataResponse\DataResponseFactoryInterface;
use Yiisoft\Http\Header;
use Yiisoft\Http\Method;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Session\Flash\Flash;

final class GenreController
{
    private ViewRenderer $viewRenderer;

    private ResponseFactoryInterface $responseFactory;

    public function __construct(ViewRenderer $viewRenderer, ResponseFactoryInterface $responseFactory)
    {
        $this->viewRenderer = $viewRenderer->withControllerName('genre');
        $this->responseFactory = $responseFactory;
    }

    public function index(ORMInterface $orm, Aliases $aliases): ResponseInterface
    {
        /** @var GenreRepository $repository */
        $repository = $orm->getRepository(Genre::class);

        $dataReader = $repository->list();

        return $this->viewRenderer->render('index', [
            'dataReader' => $dataReader,
            'viewItem' => $aliases->get('@views/genre/_item.tpl'),
            'classes' => [
                'ListView' => \App\Widget\ListView::class
            ]
        ]);
    }

    public function create(GenreForm $form, GenreService $service, Flash $flash, UrlGeneratorInterface $url, ServerRequestInterface $request): ResponseInterface
    {
        $body = $request->getParsedBody();
        $method = $request->getMethod();

        if (($method === Method::POST) && $form->load($body) && $form->validate()) {

            $service->create($form);

            $flash->add('success', ['body' => 'New genre successfully created'], true);

            return $this->responseFactory
                ->createResponse(302)
                ->withHeader(Header::LOCATION, $url->generate('genre/index'));
        }

        return $this->viewRenderer->withCsrf()->render('create', [
            'form' => $form,
            'actionUrl' => $url->generate('genre/create'),
            'classes' => [
                'Form' => \Yiisoft\Form\Widget\Form::class,
            ]
        ]);
    }

    public function update(GenreForm $form, GenreService $service, ORMInterface $orm, Flash $flash, UrlGeneratorInterface $url, ServerRequestInterface $request): ResponseInterface
    {
        $id = $request->getAttribute('id');
        $body = $request->getParsedBody();
        $method = $request->getMethod();

        if (($method === Method::POST) && $form->load($body) && $form->validate()) {

            $service->update($form);

            $flash->add('success', ['body' => 'Genre successfully updated'], true);

            return $this->responseFactory
                ->createResponse(302)
                ->withHeader(Header::LOCATION, $url->generate('genre/index'));
        }

        /** @var GenreRepository $repository */
        $repository = $orm->getRepository(Genre::class);
        /** @var Genre $genre */
        $genre = $repository->findOne(['id' => $id]);

        $form->load([
            'id' => $genre->getId(),
            'name' => $genre->getName(),
            'active' => (string) $genre->getActive(),
        ], '');

        return $this->viewRenderer->withCsrf()->render('update', [
            'form' => $form,
            'actionUrl' => $url->generate('genre/update', ['id' => $id]),
            'classes' => [
                'Form' => \Yiisoft\Form\Widget\Form::class,
            ]
        ]);
    }

    public function delete(GenreService $service, ServerRequestInterface $request, Flash $flash, DataResponseFactoryInterface $responseFactory, UrlGeneratorInterface $url): ResponseInterface
    {
        $service->delete((int) $request->getAttribute('id'));

        $flash->add('success', ['body' => 'Genre successfully deleted'], true);

        return $responseFactory->createResponse(302)
            ->withHeader(Header::LOCATION, $url->generate('genre/index'));
    }
}
