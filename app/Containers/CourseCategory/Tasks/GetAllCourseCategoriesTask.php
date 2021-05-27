<?php

namespace App\Containers\CourseCategory\Tasks;

use App\Containers\CourseCategory\Data\Repositories\CourseCategoryRepository;
use App\Ship\Parents\Tasks\Task;

class GetAllCourseCategoriesTask extends Task
{

    protected $repository;

    public function __construct(CourseCategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->paginate();
    }
}
