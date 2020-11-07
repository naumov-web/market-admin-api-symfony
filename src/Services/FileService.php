<?php

namespace App\Services;

use App\Entity\File;
use App\Repository\FileRepository;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Class FileService
 * @package App\Services
 */
final class FileService
{

    /**
     * File path template
     * @var string
     */
    public const PATH_TEMPLATE = '/storage/{{date}}/{{hash}}/{{file_name}}';

    /**
     * File repository instance
     * @var FileRepository
     */
    protected $repository;

    /**
     * Kernel interface instance
     * @var KernelInterface
     */
    protected $kernel;

    /**
     * FileService constructor.
     * @param FileRepository $repository
     * @param KernelInterface $kernel
     */
    public function __construct(FileRepository $repository, KernelInterface $kernel)
    {
        $this->repository = $repository;
        $this->kernel = $kernel;
    }

    /**
     * Create and store file
     *
     * @param array $data
     * @return File
     */
    public function create(array $data): File
    {
        $path = $this->storeFile($data);
        $file_model_data = [];
    }

    /**
     * Create multiple files
     *
     * @param array $items
     * @return array
     */
    public function createMultiple(array $items): array
    {
        $result = [];

        foreach ($items as $item) {
            $result[] = $this->create($item);
        }

        return $result;
    }

    /**
     * Store file and return path
     *
     * @param array $data
     * @return string
     */
    protected function storeFile(array $data): string
    {
        $base_path = $this->kernel->getStorageDir();
        $result_path = str_replace(
            [],
            [],
            self::PATH_TEMPLATE
        );

        return $result_path;
    }

}