<?php

namespace App\Controller;

use ActivityPhp\Server;
use App\Ontologies\DTFOntology;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_default')]
    public function index(): Response
    {
        return $this->render('default/index.html.twig',
            [
                'abcde' => 'fghi',
            ]
        );

    }

    #[Route('/json', name: 'app_default_json')]
    public function jsonIndex(): JsonResponse
    {
        $server = new Server([
            'logger' => [
                'driver' => '\Psr\Log\NullLogger',
            ],
            'instance' => [
                'host' => 'dtf.lunaspheregames.com',
                'types' => 'include',
                'debug' => true,
            ],
            'cache' => [],
            'http' => [
                'agent' => 'DTF',
            ],
            'dialects' => [],
            'ontologies' => [
                'my-ontology' => DTFOntology::class,
            ],
        ]);

        $handle = 'psion1369@lemmy.world';

        // Get a WebFinger instance
        $webfinger = $server->actor($handle)->webfinger();

        // Dumps all properties
        // print_r($webfinger->toArray());

        // A one line call
        // print_r(
        // $server->actor($handle)->webfinger()->toArray()
        // );

        return $this->json($webfinger->toArray());
    }
}
