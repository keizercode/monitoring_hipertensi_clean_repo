<?php

namespace App\Http\Controllers;

use App\Models\EducationalContent;

class EducationController extends Controller
{
    public function index()
    {
        $dietContents = EducationalContent::getByCategory('diet');
        $exerciseContents = EducationalContent::getByCategory('exercise');
        $hydrationContents = EducationalContent::getByCategory('hydration');
        $medicationContents = EducationalContent::getByCategory('medication');
        
        return view('education.index', compact(
            'dietContents',
            'exerciseContents',
            'hydrationContents',
            'medicationContents'
        ));
    }

    public function show(EducationalContent $content)
    {
        return view('education.show', compact('content'));
    }
}
