<?php

namespace App\Containers\CourseCategory\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class FindCourseCategoryByIdAction extends Action
{
    public function run(Request $request)
    {
        $coursecategory = Apiato::call('CourseCategory@FindCourseCategoryByIdTask', [$request->id]);

        return $coursecategory;
    }
}
