<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Allow all authenticated users (adjust as needed)
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:150',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',

            'feature_video' => 'nullable|file|mimetypes:video/mp4,video/x-msvideo,video/quicktime|max:20000',

            'modules' => 'required|array|min:1',
            'modules.*.name' => 'required|string|max:150',

            'modules.*.contents' => 'required|array|min:1',
            'modules.*.contents.*.title' => 'required|string|max:150',
            'modules.*.contents.*.source_type' => 'required|in:link,image,video',
            'modules.*.contents.*.link' => 'required_if:modules.*.contents.*.source_type,link|nullable|url|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The course title is required.',
            'description.required' => 'Please provide a course description.',
            'category_id.required' => 'Please select a category.',
            'modules.required' => 'You must add at least one module.',
            'modules.*.name.required' => 'Each module must have a name.',
            'modules.*.contents.required' => 'Each module must include at least one content item.',
            'modules.*.contents.*.title.required' => 'Each content item must have a title.',
            'modules.*.contents.*.source_type.required' => 'Please select a source type for the content.',
            'modules.*.contents.*.link.required_if' => 'A valid YouTube link is required when source type is "link".',
        ];
    }
}
