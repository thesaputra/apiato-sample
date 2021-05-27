<?php

namespace App\Containers\CourseCategory\Tasks;

use App\Containers\CourseCategory\Data\Repositories\CourseCategoryRepository;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeleteCourseCategoryTask extends Task
{

    protected $repository;

    public function __construct(CourseCategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {
            return $this->repository->delete($id);
        }
        catch (Exception $exception) {
            throw new DeleteResourceFailedException();
        }
    }
}
