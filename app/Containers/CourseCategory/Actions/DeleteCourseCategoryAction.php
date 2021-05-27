<?php

namespace App\Containers\CourseCategory\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class DeleteCourseCategoryAction extends Action
{
    public function run(Request $request)
    {
        return Apiato::call('CourseCategory@DeleteCourseCategoryTask', [$request->id]);
    }
}
