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
    public const PATH_TEMPLATE = '/storage/{{date}}/{{hash}}';

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

        $file_model = new File(
            $data['name'],
            $path,
            $data['mime']
        );

        return $this->repository->store($file_model);
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
            [
                '{{date}}',
                '{{hash}}'
            ],
            [
                date('Y-m-d'),
                sha1(microtime())
            ],
            self::PATH_TEMPLATE
        );

        if (!is_dir($base_path . $result_path)) {
            mkdir($base_path . $result_path, 0777, $recursive = true);
        }

        file_put_contents(
            $base_path . $result_path . '/' . $data['name'],
            base64_decode($data['content'])
        );

        return $result_path;
    }

}