<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateAboutPageRequest;
use App\Http\Requests\Admin\UpdateCareerPageRequest;
use App\Http\Requests\Admin\UpdateContactPageRequest;
use App\Http\Requests\Admin\UpdateEventsPageRequest;
use App\Http\Requests\Admin\UpdateFooterPageRequest;
use App\Http\Requests\Admin\UpdateHomePageRequest;
use App\Models\DynamicPage;
use Illuminate\Support\Facades\Storage;

class DynamicPageController extends Controller
{
    public function homeEdit()
    {
        $page = DynamicPage::firstOrNew(['page_key' => 'home']);

        // If content is empty or not in the expected format, initialize it
        if (empty($page->content) || !isset($page->content)) {
            $page->content = [
                'en' => [
                    'hero_title' => 'We Are Here To Hear',
                    'hero_subtitle' => 'Hero Subtitle',
                    'hero_image' => '',
                    'trusted_companies_heading' => 'Trusted by 4,000+ companies',
                    'company_logos' => array_fill(0, 10, ''),
                    'about_heading' => 'About Us',
                    'about_description' => 'Lorem Ipsum is simply dummy text...',
                    'about_image' => '',
                    'industries_heading' => 'we are industry first',
                    'industries' => array_fill(0, 8, [
                        'title' => '',
                        'image' => ''
                    ]),
                    'video_file' => '',
                    'careers_heading' => 'Careers',
                    'careers_description' => 'We Can Help You To Grow Your Business...',
                    'careers_image' => '',
                    'careers_features' => array_fill(0, 6, ''),
                    'testimonials_heading' => 'Testimonials',
                    'testimonials' => array_fill(0, 5, [
                        'name' => '',
                        'position' => '',
                        'stars' => 5,
                        'text' => '',
                        'image' => ''
                    ])
                ],
                'ar' => [
                    'hero_title' => 'نحن هنا لنسمع',
                    'hero_subtitle' => 'العنوان الفرعي',
                    'hero_image' => '',
                    'trusted_companies_heading' => 'يثق بنا أكثر من 4000 شركة',
                    'company_logos' => array_fill(0, 10, ''),
                    'about_heading' => 'من نحن',
                    'about_description' => 'لوريم إيبسوم هو ببساطة نص شكلي...',
                    'about_image' => '',
                    'industries_heading' => 'نحن أولاً في الصناعة',
                    'industries' => array_fill(0, 8, [
                        'title' => '',
                        'image' => ''
                    ]),
                    'video_file' => '',
                    'careers_heading' => 'الوظائف',
                    'careers_description' => 'يمكننا مساعدتك في تنمية عملك...',
                    'careers_image' => '',
                    'careers_features' => array_fill(0, 6, ''),
                    'testimonials_heading' => 'آراء العملاء',
                    'testimonials' => array_fill(0, 5, [
                        'name' => '',
                        'position' => '',
                        'stars' => 5,
                        'text' => '',
                        'image' => ''
                    ])
                ]
            ];
            $page->save();
        }

        return view('admin.pages.dynamicPages.home', compact('page'));
    }

    public function homeUpdate(UpdateHomePageRequest $request)
    {
        $page = DynamicPage::firstOrNew(['page_key' => 'home']);
        $validatedData = $request->validated();

        // Get existing content or create new structure with proper nested arrays
        $content = $page->getTranslations('content')?? [];

        // Ensure the content has the proper structure
        if (!isset($content['en']) || !is_array($content['en'])) {
            $content['en'] = [];
        }
        if (!isset($content['ar']) || !is_array($content['ar'])) {
            $content['ar'] = [];
        }

        // Handle hero image upload (same for both languages)
        $heroImage = $this->handleSingleFileUpload(
            $request,
            'hero_image',
            $content['en'], // Current content for reference
            $content['en'], // Existing content for fallback
            'home/hero'
        );

        // If no new hero image uploaded, try to get from existing content
        if (empty($heroImage)) {
            $heroImage = $content['en']['hero_image'] ?? $content['ar']['hero_image'] ?? '';
        }

        // Handle about image upload (same for both languages)
        $aboutImage = $this->handleSingleFileUpload(
            $request,
            'about_image',
            $content['en'], // Current content for reference
            $content['en'], // Existing content for fallback
            'home/about'
        );

        // If no new about image uploaded, try to get from existing content
        if (empty($aboutImage)) {
            $aboutImage = $content['en']['about_image'] ?? $content['ar']['about_image'] ?? '';
        }

        // Handle careers image upload (same for both languages)
        $careersImage = $this->handleSingleFileUpload(
            $request,
            'careers_image',
            $content['en'], // Current content for reference
            $content['en'], // Existing content for fallback
            'home/careers'
        );

        // If no new careers image uploaded, try to get from existing content
        if (empty($careersImage)) {
            $careersImage = $content['en']['careers_image'] ?? $content['ar']['careers_image'] ?? '';
        }

        // Handle video file upload (same for both languages)
        $videoFile = $this->handleSingleFileUpload(
            $request,
            'video_file',
            $content['en'], // Current content for reference
            $content['en'], // Existing content for fallback
            'home/videos'
        );

        // If no new video file uploaded, try to get from existing content
        if (empty($videoFile)) {
            $videoFile = $content['en']['video_file'] ?? $content['ar']['video_file'] ?? '';
        }

        // Handle company logos upload
        $companyLogos = [];
        for ($i = 0; $i < 10; $i++) {
            $logoPath = $this->handleSingleFileUpload(
                $request,
                "company_logos_$i",
                $content['en'], // Current content for reference
                $content['en'], // Existing content for fallback
                'home/company-logos'
            );

            // If no new logo uploaded, try to get from existing content
            if (empty($logoPath)) {
                $logoPath = $content['en']['company_logos'][$i] ?? $content['ar']['company_logos'][$i] ?? '';
            }

            $companyLogos[] = $logoPath;
        }

        // Handle industries upload
        $industriesImages = [];
        for ($i = 0; $i < 8; $i++) {
            $industryImage = $this->handleSingleFileUpload(
                $request,
                "industries_image_$i",
                $content['en']['industries'][$i] ?? [], // Current industry for reference
                $content['en']['industries'][$i] ?? [], // Existing industry for fallback
                'home/industries'
            );

            // If no new industry image uploaded, try to get from existing content
            if (empty($industryImage)) {
                $industryImage = $content['en']['industries'][$i]['image'] ??
                    $content['ar']['industries'][$i]['image'] ?? '';
            }

            // English industry
            $industriesImages[] = [
                'title' => $validatedData['industries_title']['en'][$i] ?? '',
                'image' => $industryImage
            ];
        }

        // Handle testimonials upload
        $testimonialsImages = [];
        for ($i = 0; $i < 5; $i++) {
            $testimonialImage = $this->handleSingleFileUpload(
                $request,
                "testimonials_image_$i",
                $content['en']['testimonials'][$i] ?? [], // Current testimonial for reference
                $content['en']['testimonials'][$i] ?? [], // Existing testimonial for fallback
                'home/testimonials'
            );

            // If no new testimonial image uploaded, try to get from existing content
            if (empty($testimonialImage)) {
                $testimonialImage = $content['en']['testimonials'][$i]['image'] ??
                    $content['ar']['testimonials'][$i]['image'] ?? '';
            }

            // English testimonial
            $testimonialsImages[] = [
                'name' => $validatedData['testimonials_name']['en'][$i] ?? '',
                'position' => $validatedData['testimonials_position']['en'][$i] ?? '',
                'stars' => $validatedData['testimonials_stars']['en'][$i] ?? 5,
                'text' => $validatedData['testimonials_text']['en'][$i] ?? '',
                'image' => $testimonialImage
            ];
        }

        // Update English content
        $content['en'] = [
            'hero_title' => $validatedData['hero_title']['en'],
            'hero_subtitle' => $validatedData['hero_subtitle']['en'],
            'hero_image' => $heroImage,
            'trusted_companies_heading' => $validatedData['trusted_companies_heading']['en'],
            'company_logos' => $companyLogos,
            'about_heading' => $validatedData['about_heading']['en'],
            'about_description' => $validatedData['about_description']['en'],
            'about_image' => $aboutImage,
            'industries_heading' => $validatedData['industries_heading']['en'],
            'industries' => $industriesImages,
            'video_file' => $videoFile,
            'careers_heading' => $validatedData['careers_heading']['en'],
            'careers_description' => $validatedData['careers_description']['en'],
            'careers_image' => $careersImage,
            'careers_features' => $validatedData['careers_features']['en'] ?? array_fill(0, 6, ''),
            'testimonials_heading' => $validatedData['testimonials_heading']['en'],
            'testimonials' => $testimonialsImages
        ];

        // Update Arabic content
        $content['ar'] = [
            'hero_title' => $validatedData['hero_title']['ar'],
            'hero_subtitle' => $validatedData['hero_subtitle']['ar'],
            'hero_image' => $heroImage, // Same image for both languages
            'trusted_companies_heading' => $validatedData['trusted_companies_heading']['ar'],
            'company_logos' => $companyLogos,
            'about_heading' => $validatedData['about_heading']['ar'],
            'about_description' => $validatedData['about_description']['ar'],
            'about_image' => $aboutImage, // Same image for both languages
            'industries_heading' => $validatedData['industries_heading']['ar'],
            'industries' => $industriesImages,
            'video_file' => $videoFile,
            'careers_heading' => $validatedData['careers_heading']['ar'],
            'careers_description' => $validatedData['careers_description']['ar'],
            'careers_image' => $careersImage,
            'careers_features' => $validatedData['careers_features']['ar'] ?? array_fill(0, 6, ''),
            'testimonials_heading' => $validatedData['testimonials_heading']['ar'],
            'testimonials' => $testimonialsImages
        ];

        // Make sure we ONLY have the en and ar keys
        $page->content = [
            'en' => $content['en'],
            'ar' => $content['ar']
        ];

        $page->save();

        return redirect()->route('admin.dynamicPages.home')
            ->with('success', 'Home page content updated successfully!');
    }

    /**
     * Handle single file upload with preservation of existing file
     */
    private function handleSingleFileUpload($request, $fieldName, $currentContent, $existingContent, $folder)
    {
        if ($request->hasFile($fieldName)) {
            // Upload the new file
            $path = $this->uploadFile($request->file($fieldName), $folder);

            return asset($path);
        } elseif (!isset($currentContent[$fieldName]) && isset($existingContent[$fieldName])) {
            // Keep the existing file if no new file is uploaded
            return $existingContent[$fieldName];
        }

        // Return empty string if no file exists
        return '';
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
        $page = DynamicPage::firstOrNew(['page_key' => 'about']);

        // If content is empty or not in the expected format, initialize it
        if (empty($page->content) || !isset($page->content)) {
            $page->content = [
                'en' => [
                    'hero_title' => 'About Us',
                    'hero_subtitle' => 'Learn More About Our Company And Our Mission',
                    'hero_image' => '',
                    'about_title' => 'About Our Company',
                    'about_description' => 'We are a leading company in our industry with years of experience...',
                    'about_image' => '',
                    'why_choose_title' => 'Why Choose Us',
                    'why_choose_subtitle' => 'Discover the reasons why our clients trust us',
                    'why_choose_items' => [
                        [
                            'title' => 'Expert Team',
                            'description' => 'Our team consists of industry experts',
                            'icon' => ''
                        ],
                        [
                            'title' => 'Quality Service',
                            'description' => 'We deliver top-notch services to our clients',
                            'icon' => ''
                        ],
                        [
                            'title' => 'Customer Support',
                            'description' => '24/7 customer support for all your needs',
                            'icon' => ''
                        ],
                        [
                            'title' => 'Innovation',
                            'description' => 'We constantly innovate to stay ahead',
                            'icon' => ''
                        ],
                        [
                            'title' => 'Reliability',
                            'description' => 'You can count on us to deliver',
                            'icon' => ''
                        ],
                        [
                            'title' => 'Global Reach',
                            'description' => 'We serve clients worldwide',
                            'icon' => ''
                        ],
                        [
                            'title' => 'Competitive Pricing',
                            'description' => 'Get the best value for your investment',
                            'icon' => ''
                        ],
                        [
                            'title' => 'Proven Results',
                            'description' => 'Our track record speaks for itself',
                            'icon' => ''
                        ],
                        [
                            'title' => 'Custom Solutions',
                            'description' => 'Tailored approaches for your needs',
                            'icon' => ''
                        ],
                        [
                            'title' => 'Long-term Partnership',
                            'description' => 'We grow together with our clients',
                            'icon' => ''
                        ]
                    ]
                ],
                'ar' => [
                    'hero_title' => 'من نحن',
                    'hero_subtitle' => 'تعرف أكثر على شركتنا ومهمتنا',
                    'hero_image' => '',
                    'about_title' => 'عن شركتنا',
                    'about_description' => 'نحن شركة رائدة في مجالنا مع سنوات من الخبرة...',
                    'about_image' => '',
                    'why_choose_title' => 'لماذا تختارنا',
                    'why_choose_subtitle' => 'اكتشف الأسباب التي تجعل عملائنا يثقون بنا',
                    'why_choose_items' => [
                        [
                            'title' => 'فريق خبراء',
                            'description' => 'فريقنا يتكون من خبراء في المجال',
                            'icon' => ''
                        ],
                        [
                            'title' => 'خدمة عالية الجودة',
                            'description' => 'نقدم خدمات متميزة لعملائنا',
                            'icon' => ''
                        ],
                        [
                            'title' => 'دعم العملاء',
                            'description' => 'دعم العملاء على مدار الساعة طوال أيام الأسبوع',
                            'icon' => ''
                        ],
                        [
                            'title' => 'الابتكار',
                            'description' => 'نبتكر باستمرار لنتقدم على المنافسين',
                            'icon' => ''
                        ],
                        [
                            'title' => 'الموثوقية',
                            'description' => 'يمكنك الاعتماد علينا في التسليم',
                            'icon' => ''
                        ],
                        [
                            'title' => 'الوصول العالمي',
                            'description' => 'نخدم عملاءنا في جميع أنحاء العالم',
                            'icon' => ''
                        ],
                        [
                            'title' => 'أسعار تنافسية',
                            'description' => 'احصل على أفضل قيمة لاستثمارك',
                            'icon' => ''
                        ],
                        [
                            'title' => 'نتائج مثبتة',
                            'description' => 'سجلنا الحافل يتحدث عن نفسه',
                            'icon' => ''
                        ],
                        [
                            'title' => 'حلول مخصصة',
                            'description' => 'نهج مصمم خصيصًا لاحتياجاتك',
                            'icon' => ''
                        ],
                        [
                            'title' => 'شراكة طويلة الأجل',
                            'description' => 'ننمو معًا مع عملائنا',
                            'icon' => ''
                        ]
                    ]
                ]
            ];
            $page->save();
        }

        return view('admin.pages.dynamicPages.about', compact('page'));
    }

    public function aboutUpdate(UpdateAboutPageRequest $request)
    {
        $page = DynamicPage::firstOrNew(['page_key' => 'about']);
        $validatedData = $request->validated();

        // Get existing content or create new structure with proper nested arrays
        $content = $page->getTranslations('content') ?? [];

        // Ensure the content has the proper structure
        if (!isset($content['en']) || !is_array($content['en'])) {
            $content['en'] = [];
        }
        if (!isset($content['ar']) || !is_array($content['ar'])) {
            $content['ar'] = [];
        }

        // Handle hero image upload (same for both languages)
        $heroImage = $this->handleSingleFileUpload(
            $request,
            'hero_image',
            $content['en'], // Current content for reference
            $content['en'], // Existing content for fallback
            'about/hero'
        );

        // If no new hero image uploaded, try to get from existing content
        if (empty($heroImage)) {
            $heroImage = $content['en']['hero_image'] ?? $content['ar']['hero_image'] ?? '';
        }

        // Handle about image upload (same for both languages)
        $aboutImage = $this->handleSingleFileUpload(
            $request,
            'about_image',
            $content['en'], // Current content for reference
            $content['en'], // Existing content for fallback
            'about/about'
        );

        // If no new about image uploaded, try to get from existing content
        if (empty($aboutImage)) {
            $aboutImage = $content['en']['about_image'] ?? $content['ar']['about_image'] ?? '';
        }

        // Handle why choose us items icons
        $whyChooseItemsEn = [];
        $whyChooseItemsAr = [];

        // Process 10 items (fixed count as requested)
        for ($i = 0; $i < 10; $i++) {
            $iconPath = $this->handleSingleFileUpload(
                $request,
                "why_choose_icon_{$i}",
                $content['en']['why_choose_items'][$i] ?? [], // Current item for reference
                $content['en']['why_choose_items'][$i] ?? [], // Existing item for fallback
                'about/why-choose'
            );

            // If no new icon uploaded, try to get from existing content
            if (empty($iconPath)) {
                $iconPath = $content['en']['why_choose_items'][$i]['icon'] ??
                    $content['ar']['why_choose_items'][$i]['icon'] ?? '';
            }

            // English item
            $whyChooseItemsEn[] = [
                'title' => $validatedData['why_choose_title']['en'][$i] ?? '',
                'description' => $validatedData['why_choose_description']['en'][$i] ?? '',
                'icon' => $iconPath
            ];

            // Arabic item
            $whyChooseItemsAr[] = [
                'title' => $validatedData['why_choose_title']['ar'][$i] ?? '',
                'description' => $validatedData['why_choose_description']['ar'][$i] ?? '',
                'icon' => $iconPath // Same icon for both languages
            ];
        }

        // Update English content
        $content['en'] = [
            'hero_title' => $validatedData['hero_title']['en'],
            'hero_subtitle' => $validatedData['hero_subtitle']['en'],
            'hero_image' => $heroImage,
            'about_title' => $validatedData['about_title']['en'],
            'about_description' => $validatedData['about_description']['en'],
            'about_image' => $aboutImage,
            'why_choose_title' => $validatedData['why_choose_main_title']['en'],
            'why_choose_subtitle' => $validatedData['why_choose_main_subtitle']['en'],
            'why_choose_items' => $whyChooseItemsEn
        ];

        // Update Arabic content
        $content['ar'] = [
            'hero_title' => $validatedData['hero_title']['ar'],
            'hero_subtitle' => $validatedData['hero_subtitle']['ar'],
            'hero_image' => $heroImage, // Same image for both languages
            'about_title' => $validatedData['about_title']['ar'],
            'about_description' => $validatedData['about_description']['ar'],
            'about_image' => $aboutImage, // Same image for both languages
            'why_choose_title' => $validatedData['why_choose_main_title']['ar'],
            'why_choose_subtitle' => $validatedData['why_choose_main_subtitle']['ar'],
            'why_choose_items' => $whyChooseItemsAr
        ];

        // Make sure we ONLY have the en and ar keys
        $page->content = [
            'en' => $content['en'],
            'ar' => $content['ar']
        ];

        $page->save();


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
        $page = DynamicPage::firstOrNew(['page_key' => 'contact']);

        // If content is empty or not in the expected format, initialize it
        if (empty($page->content) || !isset($page->content)) {
            $page->content = [
                'en' => [
                    'hero_title' => 'Contact Us',
                    'hero_subtitle' => 'We\'re Happy To Assist — Feel Free To Contact Us With Any Questions Or Service Inquiries.',
                    'hero_image' => '',
                    'phone' => '+1012 3456 789',
                    'email' => 'demo@gmail.com',
                    'egypt_office' => '132 Dartmouth Street Boston, Massachusetts 02156 United States',
                    'saudi_office' => '132 Dartmouth Street Boston, Massachusetts 02156 United States',
                    'facebook_url' => '',
                    'youtube_url' => '',
                    'instagram_url' => '',
                    'twitter_url' => '',
                    'linkedin_url' => '',
                ],
                'ar' => [
                    'hero_title' => 'تواصل معنا',
                    'hero_subtitle' => 'نحن سعداء لمساعدتك — لا تتردد في التواصل معنا لأي أسئلة أو استفسارات حول خدماتنا.',
                    'hero_image' => '',
                    'phone' => '+1012 3456 789',
                    'email' => 'demo@gmail.com',
                    'egypt_office' => 'مكتب مصر - عنوان المكتب هنا',
                    'saudi_office' => 'مكتب السعودية - عنوان المكتب هنا',
                    'facebook_url' => '',
                    'youtube_url' => '',
                    'instagram_url' => '',
                    'twitter_url' => '',
                    'linkedin_url' => '',
                ]
            ];
            $page->save();
        }

        return view('admin.pages.dynamicPages.contact', compact('page'));
    }

    public function contactUpdate(UpdateContactPageRequest $request)
    {
        $page = DynamicPage::firstOrNew(['page_key' => 'contact']);
        $validatedData = $request->validated();

        // Get existing content or create new structure with proper nested arrays
        $content = $page->getTranslations('content') ?? [];

        // Ensure the content has the proper structure
        if (!isset($content['en']) || !is_array($content['en'])) {
            $content['en'] = [];
        }
        if (!isset($content['ar']) || !is_array($content['ar'])) {
            $content['ar'] = [];
        }

        // Handle image upload (same for both languages)
        $heroImage = $this->handleSingleFileUpload(
            $request,
            'hero_image',
            $content['en'], // Current content for reference
            $content['en'], // Existing content for fallback
            'contact/hero'
        );

        // If no new image uploaded, try to get from existing content
        if (empty($heroImage)) {
            $heroImage = $content['en']['hero_image'] ?? $content['ar']['hero_image'] ?? '';
        }

        // Update English content
        $content['en'] = [
            'hero_title' => $validatedData['hero_title']['en'],
            'hero_subtitle' => $validatedData['hero_subtitle']['en'],
            'hero_image' => $heroImage,
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'egypt_office' => $validatedData['egypt_office']['en'],
            'saudi_office' => $validatedData['saudi_office']['en'],
            'facebook_url' => $validatedData['facebook_url'] ?? '',
            'youtube_url' => $validatedData['youtube_url'] ?? '',
            'instagram_url' => $validatedData['instagram_url'] ?? '',
            'twitter_url' => $validatedData['twitter_url'] ?? '',
            'linkedin_url' => $validatedData['linkedin_url'] ?? '',
        ];

        // Update Arabic content
        $content['ar'] = [
            'hero_title' => $validatedData['hero_title']['ar'],
            'hero_subtitle' => $validatedData['hero_subtitle']['ar'],
            'hero_image' => $heroImage, // Same image for both languages
            'phone' => $validatedData['phone'], // Same for both languages
            'email' => $validatedData['email'], // Same for both languages
            'egypt_office' => $validatedData['egypt_office']['ar'],
            'saudi_office' => $validatedData['saudi_office']['ar'],
            'facebook_url' => $validatedData['facebook_url'] ?? '',
            'youtube_url' => $validatedData['youtube_url'] ?? '',
            'instagram_url' => $validatedData['instagram_url'] ?? '',
            'twitter_url' => $validatedData['twitter_url'] ?? '',
            'linkedin_url' => $validatedData['linkedin_url'] ?? '',
        ];

        $page->content = $content;
        $page->save();

        return redirect()->route('admin.dynamicPages.contact')
            ->with('success', 'Contact Us page content updated successfully!');
    }

    public function footerEdit()
    {
        $page = DynamicPage::firstOrNew(['page_key' => 'footer']);

        // Set default content structure for both languages
        if (empty($page->getTranslations('content'))) {
            $defaultContent = [
                'event_title' => 'Join Our Event',
                'event_subtitle' => 'Stay updated with our latest events and conferences',
                'email' => 'contact@example.com',
                'phone' => '+1 234 567 890',
                'whatsapp_number' => '',
                'facebook_url' => '',
                'instagram_url' => '',
                'twitter_url' => '',
                'linkedin_url' => '',
                'youtube_url' => '',
                'copyright' => '© 2023 Your Company Name. All rights reserved.'
            ];

            $page->setTranslations('content', [
                'en' => $defaultContent,
                'ar' => [
                    'event_title' => 'انضم إلى حدثنا',
                    'event_subtitle' => 'ابق على اطلاع بآخر الأحداث والمؤتمرات',
                    'email' => 'contact@example.com', // Non-translatable
                    'phone' => '+1 234 567 890', // Non-translatable
                    'whatsapp_number' => '',
                    'facebook_url' => '',
                    'instagram_url' => '',
                    'twitter_url' => '',
                    'linkedin_url' => '',
                    'youtube_url' => '',
                    'copyright' => '© 2023 اسم شركتك. جميع الحقوق محفوظة.'
                ]
            ]);
        }

        return view('admin.pages.dynamicPages.footer', compact('page'));
    }

    public function footerUpdate(UpdateFooterPageRequest $request)
    {
        $page = DynamicPage::firstOrNew(['page_key' => 'footer']);

        $validatedData = $request->validated();

        // Structure content for both languages
        $enContent = [
            'event_title' => $validatedData['event_title']['en'],
            'event_subtitle' => $validatedData['event_subtitle']['en'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'whatsapp_number' => $validatedData['whatsapp_number'],
            'facebook_url' => $validatedData['facebook_url'],
            'instagram_url' => $validatedData['instagram_url'],
            'twitter_url' => $validatedData['twitter_url'],
            'linkedin_url' => $validatedData['linkedin_url'],
            'youtube_url' => $validatedData['youtube_url'],
            'copyright' => $validatedData['copyright']['en']
        ];

        $arContent = [
            'event_title' => $validatedData['event_title']['ar'],
            'event_subtitle' => $validatedData['event_subtitle']['ar'],
            'email' => $validatedData['email'], // Same for both languages
            'phone' => $validatedData['phone'], // Same for both languages
            'whatsapp_number' => $validatedData['whatsapp_number'],
            'facebook_url' => $validatedData['facebook_url'],
            'instagram_url' => $validatedData['instagram_url'],
            'twitter_url' => $validatedData['twitter_url'],
            'linkedin_url' => $validatedData['linkedin_url'],
            'youtube_url' => $validatedData['youtube_url'],
            'copyright' => $validatedData['copyright']['ar']
        ];

        // Set translations for the entire content
        $page->setTranslations('content', [
            'en' => $enContent,
            'ar' => $arContent
        ]);

        $page->save();

        return redirect()->route('admin.dynamicPages.footer')
            ->with('success', 'Footer content updated successfully!');
    }

    public function eventsEdit()
    {
        $page = DynamicPage::firstOrNew(['page_key' => 'events']);

        // If content is empty or not in the expected format, initialize it
        if (empty($page->content) || !isset($page->content)) {
            $page->content = [
                'en' => [
                    // Hero Section
                    'hero_title' => 'Where Technology Meets Opportunity',
                    'hero_subtitle' => 'Explore our latest events, workshops, and summits designed to inspire and connect tech leaders.',
                    'hero_image' => '',

                    // Main Content Section
                    'main_title' => 'Unmissable Experiences for Every Tech Enthusiast',
                    'main_description' => 'Discover our upcoming events designed to keep you at the forefront of technology. From conferences and webinars to hands-on workshops, each experience is crafted to inspire innovation, build expertise, and connect you with industry leaders and lead with confidence in a rapidly evolving digital world.',

                    // Learning Objectives
                    'learning_title' => 'What will you learn?',
                    'learning_points' => [
                        'Gain the skills you need to lead in the digital age',
                        'Walk away with practical insights you can apply immediately.',
                        'Be ready to turn knowledge into action.',
                        'Expand your expertise and stay ahead in a fast-changing tech world.',
                        'From theory to application — we help you make the leap.',
                        'Analyzing the project and business model and knowing the customer\'s needs by conducting interviews with officials and stakeholder.'
                    ],

                    // Featured Event
                    'featured_event_title' => 'Tech Innovation Day 2025',
                    'featured_event_date' => 'Jul.12.2025',
                    'featured_event_time' => 'From 4:00 PM To 8PM',
                    'featured_event_location' => 'Online',
                    'featured_event_description' => 'An interactive event bringing together technology experts and enthusiasts to explore the trends shaping tomorrow. Attend keynotes, join workshops, and network with industry professionals.',
                    'featured_event_image' => '',

                    // Event Card
                    'event_card_time_text' => '01 hr 2 mins',
                    'event_card_title' => 'Future of Tech: Live Event',
                    'event_card_date' => 'Jul.12.2025 /4:00 PM',
                    'event_card_location' => 'Online',
                    'event_card_description' => 'An interactive event bringing together technology experts and enthusiasts to explore the trends shaping tomorrow. Attend keynotes, join workshops, and network with industry professionals.',
                    'event_card_rating' => 4.3,
                    'event_card_raters_count' => 16325,
                    'event_card_image' => '',
                ],
                'ar' => [
                    // Hero Section
                    'hero_title' => 'حيث تلتقي التكنولوجيا بالفرصة',
                    'hero_subtitle' => 'استكشف أحدث فعالياتنا وورش العمل والقمم المصممة لإلهام وقادة التكنولوجيا.',
                    'hero_image' => '',

                    // Main Content Section
                    'main_title' => 'تجارب لا يمكن تفويتها لكل محبي التكنولوجيا',
                    'main_description' => 'اكتشف فعالياتنا القادمة المصممة لإبقائك في طليعة التكنولوجيا. من المؤتمرات والندوات عبر الإنترنت إلى ورش العمل العملية، تم تصميم كل تجربة لإلهام الابتكار وبناء الخبرة وتوصلك بقادة الصناعة.',

                    // Learning Objectives
                    'learning_title' => 'ماذا سوف تتعلم؟',
                    'learning_points' => [
                        'اكتسب المهارات التي تحتاجها للقيادة في العصر الرقمي',
                        'اغتنم رؤى عملية يمكنك تطبيقها على الفور.',
                        'كن مستعدًا لتحويل المعرفة إلى عمل.',
                        'وسع خبرتك وابقَ في المقدمة في عالم التكنولوجيا سريع التغير.',
                        'من النظرية إلى التطبيق - نحن نساعدك على القفزة.',
                        'تحليل المشروع ونموذج العمل ومعرفة احتياجات العملاء من خلال إجراء مقابلات مع المسؤولين وأصحاب المصلحة.'
                    ],

                    // Featured Event
                    'featured_event_title' => 'يوم الابتكار التكنولوجي 2025',
                    'featured_event_date' => '12 يوليو 2025',
                    'featured_event_time' => 'من 4:00 مساءً إلى 8:00 مساءً',
                    'featured_event_location' => 'عبر الإنترنت',
                    'featured_event_description' => 'فعالية تفاعلية تجمع بين خبراء التكنولوجيا والمتحمسين لاستكشاف الاتجاهات التي تشكل الغد. احضر المحاضرات الرئيسية وانضم إلى ورش العمل وتواصل مع المحترفين في الصناعة.',
                    'featured_event_image' => '',

                    // Event Card
                    'event_card_time_text' => 'ساعة واحدة ودقيقتان',
                    'event_card_title' => 'مستقبل التكنولوجيا: حدث مباشر',
                    'event_card_date' => '12 يوليو 2025 / 4:00 مساءً',
                    'event_card_location' => 'عبر الإنترنت',
                    'event_card_description' => 'فعالية تفاعلية تجمع بين خبراء التكنولوجيا والمتحمسين لاستكشاف الاتجاهات التي تشكل الغد. احضر المحاضرات الرئيسية وانضم إلى ورش العمل وتواصل مع المحترفين في الصناعة.',
                    'event_card_rating' => 4.3,
                    'event_card_raters_count' => 16325,
                    'event_card_image' => '',
                ]
            ];
            $page->save();
        }

        return view('admin.pages.dynamicPages.events', compact('page'));
    }

    public function eventsUpdate(UpdateEventsPageRequest $request)
    {
        $page = DynamicPage::firstOrNew(['page_key' => 'events']);
        $validatedData = $request->validated();

        // Get existing content or create new structure with proper nested arrays
        $content = $page->getTranslations('content') ?? [];

        // Ensure the content has the proper structure
        if (!isset($content['en']) || !is_array($content['en'])) {
            $content['en'] = [];
        }
        if (!isset($content['ar']) || !is_array($content['ar'])) {
            $content['ar'] = [];
        }

        // Handle hero image upload
        $heroImage = $this->handleSingleFileUpload(
            $request,
            'hero_image',
            $content['en'],
            $content['en'],
            'events/hero'
        );

        // If no new hero image uploaded, try to get from existing content
        if (empty($heroImage)) {
            $heroImage = $content['en']['hero_image'] ?? $content['ar']['hero_image'] ?? '';
        }

        // Handle featured event image upload
        $featuredEventImage = $this->handleSingleFileUpload(
            $request,
            'featured_event_image',
            $content['en'],
            $content['en'],
            'events/featured'
        );

        // If no new featured event image uploaded, try to get from existing content
        if (empty($featuredEventImage)) {
            $featuredEventImage = $content['en']['featured_event_image'] ?? $content['ar']['featured_event_image'] ?? '';
        }

        // Handle event card image upload
        $eventCardImage = $this->handleSingleFileUpload(
            $request,
            'event_card_image',
            $content['en'],
            $content['en'],
            'events/card'
        );

        // If no new event card image uploaded, try to get from existing content
        if (empty($eventCardImage)) {
            $eventCardImage = $content['en']['event_card_image'] ?? $content['ar']['event_card_image'] ?? '';
        }

        // Update English content
        $content['en'] = [
            // Hero Section
            'hero_title' => $validatedData['hero_title']['en'],
            'hero_subtitle' => $validatedData['hero_subtitle']['en'],
            'hero_image' => $heroImage,

            // Main Content Section
            'main_title' => $validatedData['main_title']['en'],
            'main_description' => $validatedData['main_description']['en'],

            // Learning Objectives
            'learning_title' => $validatedData['learning_title']['en'],
            'learning_points' => $validatedData['learning_points']['en'],

            // Featured Event
            'featured_event_title' => $validatedData['featured_event_title']['en'],
            'featured_event_date' => $validatedData['featured_event_date']['en'],
            'featured_event_time' => $validatedData['featured_event_time']['en'],
            'featured_event_location' => $validatedData['featured_event_location']['en'],
            'featured_event_description' => $validatedData['featured_event_description']['en'],
            'featured_event_image' => $featuredEventImage,

            // Event Card
            'event_card_time_text' => $validatedData['event_card_time_text']['en'],
            'event_card_title' => $validatedData['event_card_title']['en'],
            'event_card_date' => $validatedData['event_card_date']['en'],
            'event_card_location' => $validatedData['event_card_location']['en'],
            'event_card_description' => $validatedData['event_card_description']['en'],
            'event_card_rating' => $validatedData['event_card_rating'],
            'event_card_raters_count' => $validatedData['event_card_raters_count'],
            'event_card_image' => $eventCardImage,
        ];

        // Update Arabic content
        $content['ar'] = [
            // Hero Section
            'hero_title' => $validatedData['hero_title']['ar'],
            'hero_subtitle' => $validatedData['hero_subtitle']['ar'],
            'hero_image' => $heroImage, // Same image for both languages

            // Main Content Section
            'main_title' => $validatedData['main_title']['ar'],
            'main_description' => $validatedData['main_description']['ar'],

            // Learning Objectives
            'learning_title' => $validatedData['learning_title']['ar'],
            'learning_points' => $validatedData['learning_points']['ar'],

            // Featured Event
            'featured_event_title' => $validatedData['featured_event_title']['ar'],
            'featured_event_date' => $validatedData['featured_event_date']['ar'],
            'featured_event_time' => $validatedData['featured_event_time']['ar'],
            'featured_event_location' => $validatedData['featured_event_location']['ar'],
            'featured_event_description' => $validatedData['featured_event_description']['ar'],
            'featured_event_image' => $featuredEventImage, // Same image for both languages

            // Event Card
            'event_card_time_text' => $validatedData['event_card_time_text']['ar'],
            'event_card_title' => $validatedData['event_card_title']['ar'],
            'event_card_date' => $validatedData['event_card_date']['ar'],
            'event_card_location' => $validatedData['event_card_location']['ar'],
            'event_card_description' => $validatedData['event_card_description']['ar'],
            'event_card_rating' => $validatedData['event_card_rating'],
            'event_card_raters_count' => $validatedData['event_card_raters_count'],
            'event_card_image' => $eventCardImage, // Same image for both languages
        ];

        // Make sure we ONLY have the en and ar keys
        $page->content = [
            'en' => $content['en'],
            'ar' => $content['ar']
        ];

        $page->save();

        return redirect()->route('admin.dynamicPages.events')
            ->with('success', 'Events page content updated successfully!');
    }

    public function careerEdit()
    {
        $page = DynamicPage::firstOrNew(['page_key' => 'career']);

        // If content is empty or not in the expected format, initialize it
        if (empty($page->content) || !isset($page->content)) {
            $page->content = [
                'en' => [
                    // Hero Section
                    'hero_title' => 'Find A Job That Aligns With Your Interests And Skills',
                    'hero_subtitle' => 'Work alongside amazing people, and be a part of innovation that makes a real difference in businesses worldwide.',
                    'hero_image' => '',
                ],
                'ar' => [
                    // Hero Section
                    'hero_title' => 'ابحث عن وظيفة تتماشى مع اهتماماتك ومهاراتك',
                    'hero_subtitle' => 'اعمل جنبًا إلى جنب مع أشخاص رائعين، وكن جزءًا من الابتكار الذي يُحدث فرقًا حقيقيًا في الشركات حول العالم.',
                    'hero_image' => '',
                ]
            ];
            $page->save();
        }

        return view('admin.pages.dynamicPages.career', compact('page'));
    }

    public function careerUpdate(UpdateCareerPageRequest $request)
    {
        $page = DynamicPage::firstOrNew(['page_key' => 'career']);
        $validatedData = $request->validated();

        // Get existing content or create new structure with proper nested arrays
        $content = $page->getTranslations('content') ?? [];

        // Ensure the content has the proper structure
        if (!isset($content['en']) || !is_array($content['en'])) {
            $content['en'] = [];
        }
        if (!isset($content['ar']) || !is_array($content['ar'])) {
            $content['ar'] = [];
        }

        // Handle hero image upload
        $heroImage = $this->handleSingleFileUpload(
            $request,
            'hero_image',
            $content['en'],
            $content['en'],
            'career/hero'
        );

        // If no new hero image uploaded, try to get from existing content
        if (empty($heroImage)) {
            $heroImage = $content['en']['hero_image'] ?? $content['ar']['hero_image'] ?? '';
        }

        // Update English content
        $content['en'] = [
            // Hero Section
            'hero_title' => $validatedData['hero_title']['en'],
            'hero_subtitle' => $validatedData['hero_subtitle']['en'],
            'hero_image' => $heroImage,
        ];

        // Update Arabic content
        $content['ar'] = [
            // Hero Section
            'hero_title' => $validatedData['hero_title']['ar'],
            'hero_subtitle' => $validatedData['hero_subtitle']['ar'],
            'hero_image' => $heroImage, // Same image for both languages
        ];

        // Make sure we ONLY have the en and ar keys
        $page->content = [
            'en' => $content['en'],
            'ar' => $content['ar']
        ];

        $page->save();

        return redirect()->route('admin.dynamicPages.career')
            ->with('success', 'Career page content updated successfully!');
    }
}
