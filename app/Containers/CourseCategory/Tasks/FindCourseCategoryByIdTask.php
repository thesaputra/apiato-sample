<?php

namespace App\Containers\CourseCategory\Tasks;

use App\Containers\CourseCategory\Data\Repositories\CourseCategoryRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindCourseCategoryByIdTask extends Task
{

    protected $repository;

    public function __construct(CourseCategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {
            return $this->repository->find($id);
        }
        catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
