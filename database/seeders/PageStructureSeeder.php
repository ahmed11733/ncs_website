<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageCategory;
use App\Models\PageSection;
use Illuminate\Database\Seeder;

class PageStructureSeeder extends Seeder
{
    public function run()
    {
        // Create 3 page categories
        $categories = [
            ['name' => 'Main Pages'],
            ['name' => 'Information'],
            ['name' => 'Services'],
        ];

        foreach ($categories as $categoryData) {
            $category = PageCategory::create($categoryData);

            // Create 2 pages for each category
            $pages = $this->getPagesForCategory($category->id);
            foreach ($pages as $pageData) {
                $page = Page::create($pageData);

                // Create 5 sections for each page
                $this->createSectionsForPage($page->id);
            }
        }
    }

    protected function getPagesForCategory($categoryId)
    {
        $pages = [];

        if ($categoryId == 1) { // Main Pages
            $pages = [
                ['page_category_id' => $categoryId, 'title' => 'Home', 'name' => 'Home', 'subtitle' => 'Welcome to our website', 'order' => 1],
                ['page_category_id' => $categoryId, 'title' => 'About Us','name' => 'About Us', 'subtitle' => 'Learn about our company', 'order' => 2],
            ];
        } elseif ($categoryId == 2) { // Information
            $pages = [
                ['page_category_id' => $categoryId, 'title' => 'FAQ', 'name' => 'FAQ', 'subtitle' => 'Frequently asked questions', 'order' => 1],
                ['page_category_id' => $categoryId, 'title' => 'Contact', 'name' => 'Contact', 'subtitle' => 'Get in touch with us', 'order' => 2],
            ];
        } elseif ($categoryId == 3) { // Services
            $pages = [
                ['page_category_id' => $categoryId, 'title' => 'Web Development','name' => 'Web Development', 'subtitle' => 'Professional web solutions', 'order' => 1],
                ['page_category_id' => $categoryId, 'title' => 'Digital Marketing','name' => 'Digital Marketing', 'subtitle' => 'Boost your online presence', 'order' => 2],
            ];
        }

        return $pages;
    }

    protected function createSectionsForPage($pageId)
    {
        $sections = [];

        for ($i = 1; $i <= 5; $i++) {
            $sections[] = [
                'page_id' => $pageId,
                'label' => $i === 1 ? 'main' : null,
                'title' => "Section $i for Page $pageId",
                'sub_title' => $i % 2 === 0 ? "Subtitle for section $i" : null,
                'content' => "This is the content for section $i of page $pageId...",
                'image' => $i % 3 === 0 ? "sections/section-$i.jpg" : null, // Example image path
                'order' => $i // Set order sequentially
            ];
        }

        PageSection::query()->insert($sections);
    }
}
