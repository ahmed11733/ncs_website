<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateAboutPageRequest;
use App\Http\Requests\Admin\UpdateContactPageRequest;
use App\Http\Requests\Admin\UpdateHomePageRequest;
use App\Models\DynamicPage;
use Illuminate\Support\Facades\Storage;

class DynamicPageController extends Controller
{
    public function homeEdit()
    {
        $page = DynamicPage::query()->firstOrNew(
            ['page_key' => 'home'],
            ['content' => []]
        );

        return view('admin.pages.dynamicPages.home', compact('page'));
    }

    public function homeUpdate(UpdateHomePageRequest $request)
    {
        // Get the existing page data first
        $page = DynamicPage::firstOrNew(
            ['page_key' => 'home'],
            ['content' => []]
        );

        $existingContent = $page->content ?? [];
        $validatedData = $request->validated();

        // Start with existing content and merge/update with new data
        $content = $existingContent;

        // Handle text fields
        $content['hero_title'] = $validatedData['hero_title'];
        $content['hero_subtitle'] = $validatedData['hero_subtitle'];
        $content['trusted_companies_heading'] = $validatedData['trusted_companies_heading'];
        $content['about_heading'] = $validatedData['about_heading'];
        $content['about_description'] = $validatedData['about_description'];
        $content['industries_heading'] = $validatedData['industries_heading'];
        $content['careers_heading'] = $validatedData['careers_heading'];
        $content['careers_description'] = $validatedData['careers_description'];
        $content['careers_features'] = $validatedData['careers_features'];
        $content['testimonials_heading'] = $validatedData['testimonials_heading'];

        // Handle file uploads
        $content = $this->handleSingleFileUpload($request, 'hero_image', $content, $existingContent, 'hero');
        $content = $this->handleSingleFileUpload($request, 'about_image', $content, $existingContent, 'about');
        $content = $this->handleSingleFileUpload($request, 'video_file', $content, $existingContent, 'videos');
        $content = $this->handleSingleFileUpload($request, 'careers_image', $content, $existingContent, 'careers');

        // Handle array file uploads
        $content = $this->handleCompanyLogosUpload($request, $content, $existingContent);
        $content = $this->handleIndustriesUpload($request, $content, $existingContent);
        $content = $this->handleTestimonialsUpload($request, $content, $existingContent);

        DynamicPage::updateOrCreate(
            ['page_key' => 'home'],
            ['content' => $content]
        );

        return redirect()->route('admin.dynamicPages.home')
            ->with('success', 'Home page content updated successfully!');
    }

    /**
     * Handle single file upload with preservation of existing file
     */
    private function handleSingleFileUpload($request, $fieldName, $content, $existingContent, $folder)
    {
        if ($request->hasFile($fieldName)) {
            $content[$fieldName] = $this->uploadFile($request->file($fieldName), $folder);
        } elseif (!isset($content[$fieldName]) && isset($existingContent[$fieldName])) {
            $content[$fieldName] = $existingContent[$fieldName];
        }

        return $content;
    }

    /**
     * Handle company logos array upload
     */
    private function handleCompanyLogosUpload($request, $content, $existingContent)
    {
        if ($request->hasFile('company_logos')) {
            foreach ($request->file('company_logos') as $index => $file) {
                if ($file) {
                    $content['company_logos'][$index] = $this->uploadFile($file, 'companies');
                }
            }
        } elseif (!isset($content['company_logos']) && isset($existingContent['company_logos'])) {
            $content['company_logos'] = $existingContent['company_logos'];
        }

        return $content;
    }

    /**
     * Handle industries array upload
     */
    private function handleIndustriesUpload($request, $content, $existingContent)
    {
        if ($request->has('industries')) {
            foreach ($request->industries as $index => $industry) {
                $content['industries'][$index]['title'] = $industry['title'];

                if ($request->hasFile("industries.$index.image")) {
                    $content['industries'][$index]['image'] = $this->uploadFile(
                        $request->file("industries.$index.image"),
                        'industries'
                    );
                } elseif (isset($existingContent['industries'][$index]['image'])) {
                    $content['industries'][$index]['image'] = $existingContent['industries'][$index]['image'];
                }
            }
        } elseif (!isset($content['industries']) && isset($existingContent['industries'])) {
            $content['industries'] = $existingContent['industries'];
        }

        return $content;
    }

    /**
     * Handle testimonials array upload
     */
    private function handleTestimonialsUpload($request, $content, $existingContent)
    {
        if ($request->has('testimonials')) {
            foreach ($request->testimonials as $index => $testimonial) {
                $content['testimonials'][$index]['name'] = $testimonial['name'];
                $content['testimonials'][$index]['position'] = $testimonial['position'];
                $content['testimonials'][$index]['text'] = $testimonial['text'];
                $content['testimonials'][$index]['stars'] = $testimonial['stars'];

                if ($request->hasFile("testimonials.$index.image")) {
                    $content['testimonials'][$index]['image'] = $this->uploadFile(
                        $request->file("testimonials.$index.image"),
                        'testimonials'
                    );
                } elseif (isset($existingContent['testimonials'][$index]['image'])) {
                    $content['testimonials'][$index]['image'] = $existingContent['testimonials'][$index]['image'];
                }
            }
        } elseif (!isset($content['testimonials']) && isset($existingContent['testimonials'])) {
            $content['testimonials'] = $existingContent['testimonials'];
        }

        return $content;
    }

    /**
     * Upload file and return storage path
     */
    private function uploadFile($file, $folder)
    {
        $path = $file->store("pages/home/{$folder}", 'public');
        return Storage::url($path);
    }

    public function aboutEdit()
    {
        $page = DynamicPage::query()->firstOrNew(
            ['page_key' => 'about'],
            ['content' => []]
        );

        return view('admin.pages.dynamicPages.about', compact('page'));
    }

    public function aboutUpdate(UpdateAboutPageRequest $request)
    {
        // Get the existing page data first
        $page = DynamicPage::query()->firstOrNew(
            ['page_key' => 'about'],
            ['content' => []]
        );

        $existingContent = $page->content ?? [];
        $validatedData = $request->validated();

        // Start with existing content
        $content = $existingContent;

        // Hero Section
        $content['hero_title'] = $validatedData['hero_title'];
        $content['hero_subtitle'] = $validatedData['hero_subtitle'];
        $content = $this->handleSingleFileUpload($request, 'hero_image', $content, $existingContent, 'about/hero');

        // About Section
        $content['about_title'] = $validatedData['about_title'];
        $content['about_description'] = $validatedData['about_description'];
        $content = $this->handleSingleFileUpload($request, 'about_image', $content, $existingContent, 'about/about');

        // Why Choose Us Section
        $content['why_choose_title'] = $validatedData['why_choose_title'];
        $content['why_choose_subtitle'] = $validatedData['why_choose_subtitle'];
        $content = $this->handleWhyChooseItemsUpload($request, $content, $existingContent);

        DynamicPage::query()->updateOrCreate(
            ['page_key' => 'about'],
            ['content' => $content]
        );

        return redirect()->route('admin.dynamicPages.about')
            ->with('success', 'About Us page content updated successfully!');
    }

    /**
     * Handle Why Choose Us items upload
     */
    private function handleWhyChooseItemsUpload($request, $content, $existingContent)
    {
        if ($request->has('why_choose_items')) {
            foreach ($request->why_choose_items as $index => $item) {
                $content['why_choose_items'][$index]['title'] = $item['title'];
                $content['why_choose_items'][$index]['description'] = $item['description'];

                if ($request->hasFile("why_choose_items.$index.image")) {
                    $content['why_choose_items'][$index]['image'] = $this->uploadFile(
                        $request->file("why_choose_items.$index.image"),
                        'about/why-choose-us'
                    );
                } elseif (isset($existingContent['why_choose_items'][$index]['image'])) {
                    $content['why_choose_items'][$index]['image'] = $existingContent['why_choose_items'][$index]['image'];
                }
            }
        } elseif (!isset($content['why_choose_items']) && isset($existingContent['why_choose_items'])) {
            $content['why_choose_items'] = $existingContent['why_choose_items'];
        }

        return $content;
    }

    public function contactEdit()
    {
        $page = DynamicPage::firstOrNew(
            ['page_key' => 'contact'],
            ['content' => []]
        );

        return view('admin.pages.dynamicPages.contact', compact('page'));
    }

    public function contactUpdate(UpdateContactPageRequest $request)
    {
        // Get the existing page data first
        $page = DynamicPage::query()->firstOrNew(
            ['page_key' => 'contact'],
            ['content' => []]
        );

        $existingContent = $page->content ?? [];
        $validatedData = $request->validated();

        // Start with existing content
        $content = $existingContent;

        // Hero Section
        $content['hero_title'] = $validatedData['hero_title'];
        $content['hero_subtitle'] = $validatedData['hero_subtitle'];
        $content = $this->handleSingleFileUpload($request, 'hero_image', $content, $existingContent, 'contact/hero');

        // Contact Information
        $content['phone'] = $validatedData['phone'];
        $content['email'] = $validatedData['email'];

        // Office Locations
        $content['egypt_office'] = $validatedData['egypt_office'];
        $content['saudi_office'] = $validatedData['saudi_office'];

        // Social Links
        $content['facebook_url'] = $validatedData['facebook_url'] ?? null;
        $content['youtube_url'] = $validatedData['youtube_url'] ?? null;
        $content['instagram_url'] = $validatedData['instagram_url'] ?? null;
        $content['twitter_url'] = $validatedData['twitter_url'] ?? null;
        $content['linkedin_url'] = $validatedData['linkedin_url'] ?? null;

        DynamicPage::query()->updateOrCreate(
            ['page_key' => 'contact'],
            ['content' => $content]
        );

        return redirect()->route('admin.dynamicPages.contact')
            ->with('success', 'Contact Us page content updated successfully!');
    }
}
