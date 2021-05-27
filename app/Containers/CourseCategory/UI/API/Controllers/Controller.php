<?php

namespace App\Containers\CourseCategory\UI\API\Controllers;

use App\Containers\CourseCategory\UI\API\Requests\CreateCourseCategoryRequest;
use App\Containers\CourseCategory\UI\API\Requests\DeleteCourseCategoryRequest;
use App\Containers\CourseCategory\UI\API\Requests\GetAllCourseCategoriesRequest;
use App\Containers\CourseCategory\UI\API\Requests\FindCourseCategoryByIdRequest;
use App\Containers\CourseCategory\UI\API\Requests\UpdateCourseCategoryRequest;
use App\Containers\CourseCategory\UI\API\Transformers\CourseCategoryTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class Controller
 *
 * @package App\Containers\CourseCategory\UI\API\Controllers
 */
class Controller extends ApiController
{
    /**
     * @param CreateCourseCategoryRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createCourseCategory(CreateCourseCategoryRequest $request)
    {
        $coursecategory = Apiato::call('CourseCategory@CreateCourseCategoryAction', [$request]);

        return $this->created($this->transform($coursecategory, CourseCategoryTransformer::class));
    }

    /**
     * @param FindCourseCategoryByIdRequest $request
     * @return array
     */
    public function findCourseCategoryById(FindCourseCategoryByIdRequest $request)
    {
        $coursecategory = Apiato::call('CourseCategory@FindCourseCategoryByIdAction', [$request]);

        return $this->transform($coursecategory, CourseCategoryTransformer::class);
    }

    /**
     * @param GetAllCourseCategoriesRequest $request
     * @return array
     */
    public function getAllCourseCategories(GetAllCourseCategoriesRequest $request)
    {
        $coursecategories = Apiato::call('CourseCategory@GetAllCourseCategoriesAction', [$request]);

        return $this->transform($coursecategories, CourseCategoryTransformer::class);
    }

    /**
     * @param UpdateCourseCategoryRequest $request
     * @return array
     */
    public function updateCourseCategory(UpdateCourseCategoryRequest $request)
    {
        $coursecategory = Apiato::call('CourseCategory@UpdateCourseCategoryAction', [$request]);

        return $this->transform($coursecategory, CourseCategoryTransformer::class);
    }

    /**
     * @param DeleteCourseCategoryRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteCourseCategory(DeleteCourseCategoryRequest $request)
    {
        Apiato::call('CourseCategory@DeleteCourseCategoryAction', [$request]);

        return $this->noContent();
    }
}
