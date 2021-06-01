<?php

namespace App\Containers\CourseCategory\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class CreateCourseCategoryAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            'name'
        ]);

        $coursecategory = Apiato::call('CourseCategory@CreateCourseCategoryTask', [$data]);

        return $coursecategory;
    }
}
