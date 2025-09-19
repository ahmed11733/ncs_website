<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobDepartment;
use App\Models\Job;
use Carbon\Carbon;

class DepartmentAndJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'name' => [
                    'en' => 'Engineering',
                    'ar' => 'الهندسة'
                ],
                'jobs' => [
                    [
                        'title' => [
                            'en' => 'Senior Software Engineer',
                            'ar' => 'مهندس برمجيات أول'
                        ],
                        'experience_years' => 5,
                        'last_date' => Carbon::now()->addDays(30),
                        'job_description' => [
                            'en' => 'Develop and maintain software applications using modern technologies.',
                            'ar' => 'تطوير وصيانة تطبيقات البرمجيات باستخدام تقنيات حديثة.'
                        ],
                        'skills' => [
                            'en' => 'PHP, Laravel, JavaScript, MySQL',
                            'ar' => 'PHP، لارافيل، جافاسكريبت، MySQL'
                        ],
                        'nationality' => [
                            'en' => 'Any',
                            'ar' => 'أي جنسية'
                        ],
                        'certificate' => [
                            'en' => 'Computer Science degree',
                            'ar' => 'درجة في علوم الحاسب'
                        ],
                        'age' => null,
                        'specialization' => [
                            'en' => 'Backend Development',
                            'ar' => 'تطوير الواجهة الخلفية'
                        ]
                    ],
                    [
                        'title' => [
                            'en' => 'Frontend Developer',
                            'ar' => 'مطوّر واجهات أمامية'
                        ],
                        'experience_years' => 3,
                        'last_date' => Carbon::now()->addDays(45),
                        'job_description' => [
                            'en' => 'Build responsive user interfaces using modern frontend frameworks.',
                            'ar' => 'بناء واجهات مستخدم متجاوبة باستخدام أُطر حديثة.'
                        ],
                        'skills' => [
                            'en' => 'JavaScript, React, Vue, CSS',
                            'ar' => 'جافاسكريبت، رياكت، فيو، CSS'
                        ],
                        'nationality' => [
                            'en' => 'Any',
                            'ar' => 'أي جنسية'
                        ],
                        'certificate' => [
                            'en' => 'Computer Science or related field',
                            'ar' => 'علوم حاسب أو مجال ذو صلة'
                        ],
                        'age' => null,
                        'specialization' => [
                            'en' => 'Frontend Development',
                            'ar' => 'تطوير الواجهة الأمامية'
                        ]
                    ]
                ]
            ],
            [
                'name' => [
                    'en' => 'Marketing',
                    'ar' => 'التسويق'
                ],
                'jobs' => [
                    [
                        'title' => [
                            'en' => 'Digital Marketing Specialist',
                            'ar' => 'أخصائي تسويق رقمي'
                        ],
                        'experience_years' => 3,
                        'last_date' => Carbon::now()->addDays(30),
                        'job_description' => [
                            'en' => 'Develop and implement digital marketing campaigns.',
                            'ar' => 'تطوير وتنفيذ حملات تسويق رقمي.'
                        ],
                        'skills' => [
                            'en' => 'SEO, SEM, Social Media, Content Marketing',
                            'ar' => 'تحسين محركات البحث، التسويق عبر الشبكات الاجتماعية'
                        ],
                        'nationality' => [
                            'en' => 'Any',
                            'ar' => 'أي جنسية'
                        ],
                        'certificate' => [
                            'en' => 'Marketing or related field',
                            'ar' => 'تسويق أو مجال ذو صلة'
                        ],
                        'age' => null,
                        'specialization' => [
                            'en' => 'Digital Marketing',
                            'ar' => 'التسويق الرقمي'
                        ]
                    ]
                ]
            ],
            [
                'name' => [
                    'en' => 'Human Resources',
                    'ar' => 'الموارد البشرية'
                ],
                'jobs' => [
                    [
                        'title' => [
                            'en' => 'HR Business Partner',
                            'ar' => 'شريك أعمال الموارد البشرية'
                        ],
                        'experience_years' => 5,
                        'last_date' => Carbon::now()->addDays(30),
                        'job_description' => [
                            'en' => 'Partner with business units on HR strategies and initiatives.',
                            'ar' => 'التعاون مع وحدات الأعمال في استراتيجيات الموارد البشرية.'
                        ],
                        'skills' => [
                            'en' => 'Employee Relations, Talent Management',
                            'ar' => 'العلاقات الوظيفية، إدارة المواهب'
                        ],
                        'nationality' => [
                            'en' => 'Any',
                            'ar' => 'أي جنسية'
                        ],
                        'certificate' => [
                            'en' => 'Human Resources or related field',
                            'ar' => 'موارد بشرية أو مجال ذو صلة'
                        ],
                        'age' => null,
                        'specialization' => [
                            'en' => 'HR Management',
                            'ar' => 'إدارة الموارد البشرية'
                        ]
                    ]
                ]
            ]
        ];

        foreach ($departments as $depData) {
            $jobs = $depData['jobs'];
            unset($depData['jobs']);

            $department = JobDepartment::create($depData);

            foreach ($jobs as $job) {
                $job['department_id'] = $department->id;
                Job::create($job);
            }
        }
    }
}
