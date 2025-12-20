<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                "title" => "General Discussion",
                "description" => "General web development topics and community announcements"
            ],
            [
                "title" => "Frontend Development",
                "description" => "HTML, CSS, JavaScript, React, Vue, Angular and frontend frameworks"
            ],
            [
                "title" => "Backend Development",
                "description" => "Server-side programming, APIs, databases, and backend frameworks"
            ],
            [
                "title" => "Full Stack",
                "description" => "Complete web application development from frontend to backend"
            ],
            [
                "title" => "CSS & Styling",
                "description" => "CSS frameworks, preprocessors, animations, and responsive design"
            ],
            [
                "title" => "JavaScript",
                "description" => "Vanilla JavaScript, ES6+, TypeScript, and modern JS features"
            ],
            [
                "title" => "React",
                "description" => "React.js, Next.js, hooks, state management, and React ecosystem"
            ],
            [
                "title" => "Vue.js",
                "description" => "Vue 2/3, Vue Router, Pinia, Nuxt.js, and Vue ecosystem"
            ],
            [
                "title" => "Laravel & PHP",
                "description" => "Laravel framework, PHP development, and backend best practices"
            ],
            [
                "title" => "Node.js & Express",
                "description" => "Server-side JavaScript, Express.js, and Node.js ecosystem"
            ],
            [
                "title" => "Databases",
                "description" => "SQL, NoSQL, database design, optimization, and migrations"
            ],
            [
                "title" => "APIs & REST",
                "description" => "API design, REST, GraphQL, authentication, and integration"
            ],
            [
                "title" => "DevOps & Deployment",
                "description" => "Hosting, servers, Docker, CI/CD, and deployment strategies"
            ],
            [
                "title" => "Version Control",
                "description" => "Git, GitHub, GitLab, branching strategies, and collaboration"
            ],
            [
                "title" => "Testing",
                "description" => "Unit testing, integration testing, Jest, PHPUnit, and testing strategies"
            ],
            [
                "title" => "Performance & Optimization",
                "description" => "Website speed, optimization techniques, and performance monitoring"
            ],
            [
                "title" => "Security",
                "description" => "Web security, authentication, authorization, and best practices"
            ],
            [
                "title" => "Mobile Development",
                "description" => "Progressive Web Apps, React Native, and mobile web solutions"
            ],
            [
                "title" => "UI/UX Design",
                "description" => "User interface design, user experience, and design systems"
            ],
            [
                "title" => "Tools & Editors",
                "description" => "IDEs, VS Code extensions, development tools, and productivity tips"
            ],
            [
                "title" => "Career & Jobs",
                "description" => "Job opportunities, interview preparation, and career advice"
            ],
            [
                "title" => "Learning Resources",
                "description" => "Tutorials, courses, books, and learning materials"
            ],
            [
                "title" => "Code Reviews",
                "description" => "Get feedback on your code and help others improve theirs"
            ],
            [
                "title" => "Project Showcase",
                "description" => "Show off your projects and get feedback from the community"
            ],
            [
                "title" => "Help & Support",
                "description" => "Get help with coding problems and debugging issues"
            ],
            [
                "title" => "Freelancing",
                "description" => "Freelance projects, client management, and business tips"
            ],
            [
                "title" => "Best Practices",
                "description" => "Coding standards, architecture patterns, and industry standards"
            ],
            [
                "title" => "New Technologies",
                "description" => "Emerging technologies, frameworks, and industry trends"
            ],
            [
                "title" => "Open Source",
                "description" => "Open source projects, contributions, and collaboration"
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}