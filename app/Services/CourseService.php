<?php

namespace App\Services;

use App\Repositories\CourseRepository;
use App\Repositories\ModuleRepository;
use App\Repositories\ContentRepository;
use Illuminate\Support\Facades\DB;

class CourseService
{
    protected $courseRepo;
    protected $moduleRepo;
    protected $contentRepo;

    public function __construct(
        CourseRepository $courseRepo,
        ModuleRepository $moduleRepo,
        ContentRepository $contentRepo
    ) {
        $this->courseRepo = $courseRepo;
        $this->moduleRepo = $moduleRepo;
        $this->contentRepo = $contentRepo;
    }

    public function createCourseWithModules($request)
    {
        DB::transaction(function () use ($request) {
            $featureVideo = null;
            if ($request->hasFile('feature_video')) {
                $featureVideo = $request->file('feature_video')->store('courses', 'public');
            }

            $course = $this->courseRepo->create([
                'title' => $request->title,
                'description' => $request->description,
                'feature_video' => $featureVideo,
                'category_id' => $request->category_id,
            ]);

            foreach ($request->modules as $moduleData) {
                $module = $this->moduleRepo->create([
                    'course_id' => $course->id,
                    'name' => $moduleData['name'],
                ]);

                foreach ($moduleData['contents'] as $contentData) {
                    $this->contentRepo->create([
                        'module_id' => $module->id,
                        'title' => $contentData['title'],
                        'source_type' => $contentData['source_type'] ?? 'link', // default to link
                        'link' => $contentData['link'] ?? null,
                    ]);
                }
            }
        });
    }

    public function getAllCourses()
    {
        return $this->courseRepo->all();
    }

}
