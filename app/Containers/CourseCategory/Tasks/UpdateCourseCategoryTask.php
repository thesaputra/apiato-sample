<?php

namespace App\Containers\CourseCategory\Tasks;

use App\Containers\CourseCategory\Data\Repositories\CourseCategoryRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateCourseCategoryTask extends Task
{

    protected $repository;

    public function __construct(CourseCategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id, array $data)
    {
        try {
            return $this->repository->update($data, $id);
        }
        catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
