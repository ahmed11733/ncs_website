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
        // Create 3 departments
        $departments = [
            ['name' => 'Engineering'],
            ['name' => 'Marketing'],
            ['name' => 'Human Resources']
        ];

        foreach ($departments as $department) {
            $dept = JobDepartment::create($department);

            // Create 3 jobs for each department
            switch ($dept->name) {
                case 'Engineering':
                    $this->createEngineeringJobs($dept);
                    break;
                case 'Marketing':
                    $this->createMarketingJobs($dept);
                    break;
                case 'Human Resources':
                    $this->createHRJobs($dept);
                    break;
            }
        }
    }

    private function createEngineeringJobs(JobDepartment $department): void
    {
        $jobs = [
            [
                'title' => 'Senior Software Engineer',
                'experience_years' => 5,
                'last_date' => Carbon::now()->addDays(30),
                'job_description' => 'Develop and maintain software applications using modern technologies.',
                'skills' => 'PHP, Laravel, JavaScript, MySQL',
                'nationality' => 'Any',
                'certificate' => 'Computer Science degree',
                'age' => null,
                'specialization' => 'Backend Development'
            ],
            [
                'title' => 'Frontend Developer',
                'experience_years' => 3,
                'last_date' => Carbon::now()->addDays(45),
                'job_description' => 'Build responsive user interfaces using modern frontend frameworks.',
                'skills' => 'JavaScript, React, Vue, CSS',
                'nationality' => 'Any',
                'certificate' => 'Computer Science or related field',
                'age' => null,
                'specialization' => 'Frontend Development'
            ],
            [
                'title' => 'DevOps Engineer',
                'experience_years' => 4,
                'last_date' => Carbon::now()->addDays(60),
                'job_description' => 'Implement and maintain CI/CD pipelines and cloud infrastructure.',
                'skills' => 'AWS, Docker, Kubernetes, Terraform',
                'nationality' => 'Any',
                'certificate' => 'Computer Science or related field',
                'age' => null,
                'specialization' => 'Cloud Infrastructure'
            ]
        ];

        $this->createJobsForDepartment($department, $jobs);
    }

    private function createMarketingJobs(JobDepartment $department): void
    {
        $jobs = [
            [
                'title' => 'Digital Marketing Specialist',
                'experience_years' => 3,
                'last_date' => Carbon::now()->addDays(30),
                'job_description' => 'Develop and implement digital marketing campaigns.',
                'skills' => 'SEO, SEM, Social Media, Content Marketing',
                'nationality' => 'Any',
                'certificate' => 'Marketing or related field',
                'age' => null,
                'specialization' => 'Digital Marketing'
            ],
            [
                'title' => 'Content Marketing Manager',
                'experience_years' => 5,
                'last_date' => Carbon::now()->addDays(45),
                'job_description' => 'Develop content strategy and oversee content creation.',
                'skills' => 'Content Strategy, Copywriting, SEO',
                'nationality' => 'Any',
                'certificate' => 'Marketing, Communications or related field',
                'age' => null,
                'specialization' => 'Content Marketing'
            ],
            [
                'title' => 'Social Media Coordinator',
                'experience_years' => 2,
                'last_date' => Carbon::now()->addDays(60),
                'job_description' => 'Manage social media accounts and engage with audiences.',
                'skills' => 'Social Media Management, Content Creation',
                'nationality' => 'Any',
                'certificate' => 'Marketing or related field',
                'age' => null,
                'specialization' => 'Social Media'
            ]
        ];

        $this->createJobsForDepartment($department, $jobs);
    }

    private function createHRJobs(JobDepartment $department): void
    {
        $jobs = [
            [
                'title' => 'HR Business Partner',
                'experience_years' => 5,
                'last_date' => Carbon::now()->addDays(30),
                'job_description' => 'Partner with business units on HR strategies and initiatives.',
                'skills' => 'Employee Relations, Talent Management',
                'nationality' => 'Any',
                'certificate' => 'Human Resources or related field',
                'age' => null,
                'specialization' => 'HR Management'
            ],
            [
                'title' => 'Recruitment Specialist',
                'experience_years' => 3,
                'last_date' => Carbon::now()->addDays(45),
                'job_description' => 'Source, screen, and recruit top talent for the organization.',
                'skills' => 'Interviewing, Talent Sourcing',
                'nationality' => 'Any',
                'certificate' => 'Human Resources or related field',
                'age' => null,
                'specialization' => 'Recruitment'
            ],
            [
                'title' => 'Training and Development Coordinator',
                'experience_years' => 4,
                'last_date' => Carbon::now()->addDays(60),
                'job_description' => 'Develop and implement employee training programs.',
                'skills' => 'Training Development, Facilitation',
                'nationality' => 'Any',
                'certificate' => 'Human Resources or related field',
                'age' => null,
                'specialization' => 'Learning & Development'
            ]
        ];

        $this->createJobsForDepartment($department, $jobs);
    }

    private function createJobsForDepartment(JobDepartment $department, array $jobs): void
    {
        foreach ($jobs as $job) {
            $job['department_id'] = $department->id;
            Job::create($job);
        }
    }
}
