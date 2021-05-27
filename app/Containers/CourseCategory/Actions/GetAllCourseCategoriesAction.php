<?php

namespace App\Containers\CourseCategory\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class GetAllCourseCategoriesAction extends Action
{
    public function run(Request $request)
    {
        $coursecategories = Apiato::call('CourseCategory@GetAllCourseCategoriesTask', [], ['addRequestCriteria']);

        return $coursecategories;
    }
}
