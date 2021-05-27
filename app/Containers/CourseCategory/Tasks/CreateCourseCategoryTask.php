<?php

namespace App\Containers\CourseCategory\Tasks;

use App\Containers\CourseCategory\Data\Repositories\CourseCategoryRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateCourseCategoryTask extends Task
{

    protected $repository;

    public function __construct(CourseCategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $data)
    {
        try {
            return $this->repository->create($data);
        }
        catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}
