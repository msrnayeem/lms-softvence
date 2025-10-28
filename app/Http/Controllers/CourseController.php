<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Services\CourseService;
use App\Repositories\CategoryRepository;

class CourseController extends Controller
{
    protected $service;
    protected $categoryRepo;

    public function __construct(CourseService $service, CategoryRepository $categoryRepo)
    {
        $this->service = $service;
        $this->categoryRepo = $categoryRepo;
    }

    public function index()
    {
        $courses = $this->service->getAllCourses();
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        $categories = $this->categoryRepo->all();
        return view('courses.create', compact('categories'));
    }

    public function store(StoreCourseRequest $request)
    {
        try {
            $this->service->createCourseWithModules($request);

            return redirect()
                ->route('courses.index')
                ->with('success', '✅ Course created successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', '⚠️ Something went wrong: ' . $e->getMessage());
        }
    }
}
