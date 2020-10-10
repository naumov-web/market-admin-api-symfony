<?php

namespace App\Controller\Web;

use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Class DocsController
 * @package App\Controller\Web
 */
final class DocsController extends BaseController
{

    protected $kernel;

    /**
     * DocsController constructor.
     * @param KernelInterface $kernel
     */
    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * Render page with docs
     *
     * @return Response
     */
    public function page(): Response
    {
        return $this->render('docs.html.twig');
    }

    /**
     * Render swagger file
     *
     * @return BinaryFileResponse
     */
    public function swaggerFile()
    {
        $base_path = $this->kernel->getProjectDir();

        return $this->file($base_path . '/docs/swagger.yaml');
    }

}