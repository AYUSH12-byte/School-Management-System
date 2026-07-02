<?php

namespace Database\Seeders;

use App\Models\Admission;
use App\Models\Contact;
use App\Models\Course;
use App\Models\Department;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Setting;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ─── Admin User ──────────────────────────────────────────
        User::create([
            'name'     => 'EduManage Admin',
            'email'    => 'admin@edumanage.com',
            'password' => Hash::make('password'),
        ]);

        // ─── Departments ─────────────────────────────────────────
        $departments = collect([
            ['name' => 'Science & Technology',   'description' => 'Covers Physics, Chemistry, Biology, and Computer Science.', 'is_active' => true],
            ['name' => 'Humanities',             'description' => 'Encompasses History, Sociology, Psychology, and English Literature.', 'is_active' => true],
            ['name' => 'Commerce',               'description' => 'Focuses on Business Studies, Accounting, and Economics.', 'is_active' => true],
            ['name' => 'Information Technology', 'description' => 'Programming, Networking, Database Management, and Web Development.', 'is_active' => true],
            ['name' => 'Management',             'description' => 'BBA, MBA, and business management programs.', 'is_active' => true],
        ])->map(fn($d) => Department::create($d));

        [$science, $humanities, $commerce, $it, $management] = $departments;

        // ─── Teachers ────────────────────────────────────────────
        $teacherData = [
            ['name' => 'Dr. Ramesh Sharma',   'email' => 'ramesh@edumanage.com',   'phone' => '9841000001', 'department_id' => $science->id,     'qualification' => 'PhD in Physics',        'bio' => 'Expert in quantum mechanics with 15+ years of teaching experience.', 'is_active' => true],
            ['name' => 'Mrs. Sunita Thapa',   'email' => 'sunita@edumanage.com',   'phone' => '9841000002', 'department_id' => $humanities->id,   'qualification' => 'MA in English Lit.',    'bio' => 'Passionate about literature and creative writing. Published author.', 'is_active' => true],
            ['name' => 'Mr. Bikram Rai',      'email' => 'bikram@edumanage.com',   'phone' => '9841000003', 'department_id' => $commerce->id,     'qualification' => 'CA, M.Com',             'bio' => 'Certified Accountant with 10 years in corporate finance and academia.', 'is_active' => true],
            ['name' => 'Ms. Priya Gurung',    'email' => 'priya@edumanage.com',    'phone' => '9841000004', 'department_id' => $it->id,           'qualification' => 'M.Sc. Computer Science','bio' => 'Full-stack developer and educator specializing in web technologies.', 'is_active' => true],
            ['name' => 'Mr. Deepak Acharya',  'email' => 'deepak@edumanage.com',   'phone' => '9841000005', 'department_id' => $management->id,   'qualification' => 'MBA, B.Ed',             'bio' => 'Strategic management expert with corporate and academic experience.', 'is_active' => true],
            ['name' => 'Dr. Anita Karki',     'email' => 'anita@edumanage.com',    'phone' => '9841000006', 'department_id' => $science->id,      'qualification' => 'PhD in Chemistry',      'bio' => 'Research chemist turned educator with a passion for lab-based learning.', 'is_active' => true],
            ['name' => 'Mr. Sanjay Poudel',   'email' => 'sanjay@edumanage.com',   'phone' => '9841000007', 'department_id' => $it->id,           'qualification' => 'B.E. Computer Eng.',   'bio' => 'Cybersecurity specialist and ethical hacker with 8 years experience.', 'is_active' => true],
            ['name' => 'Mrs. Kavita Joshi',   'email' => 'kavita@edumanage.com',   'phone' => '9841000008', 'department_id' => $humanities->id,   'qualification' => 'MA in Sociology',       'bio' => 'Social researcher with expertise in Nepalese society and culture.', 'is_active' => true],
        ];
        $teachers = collect($teacherData)->map(fn($t) => Teacher::create($t));

        // ─── Courses ─────────────────────────────────────────────
        $courseData = [
            [
                'title'         => '+2 Science (PCB)',
                'slug'          => '+2-science-pcb',
                'description'   => 'Two-year higher secondary program covering Physics, Chemistry, and Biology. Ideal for students aspiring to medical and health science fields.',
                'department_id' => $science->id,
                'teacher_id'    => $teachers[0]->id,
                'duration'      => '2 Years',
                'fee'           => 35000.00,
                'level'         => 'beginner',
                'seats'         => 60,
                'is_active'     => true,
                'is_featured'   => true,
            ],
            [
                'title'         => '+2 Science (PCM)',
                'slug'          => '+2-science-pcm',
                'description'   => 'Physics, Chemistry, and Mathematics program for students aiming for engineering and technical fields.',
                'department_id' => $science->id,
                'teacher_id'    => $teachers[5]->id,
                'duration'      => '2 Years',
                'fee'           => 35000.00,
                'level'         => 'beginner',
                'seats'         => 60,
                'is_active'     => true,
                'is_featured'   => true,
            ],
            [
                'title'         => 'BCA – Bachelor of Computer Applications',
                'slug'          => 'bca-bachelor-computer-applications',
                'description'   => 'A 4-year undergraduate program focusing on computer science, programming, database systems, and software engineering.',
                'department_id' => $it->id,
                'teacher_id'    => $teachers[3]->id,
                'duration'      => '4 Years',
                'fee'           => 55000.00,
                'level'         => 'intermediate',
                'seats'         => 40,
                'is_active'     => true,
                'is_featured'   => true,
            ],
            [
                'title'         => 'BBS – Bachelor of Business Studies',
                'slug'          => 'bbs-bachelor-business-studies',
                'description'   => 'A comprehensive undergraduate business program covering accounting, economics, marketing, and management.',
                'department_id' => $commerce->id,
                'teacher_id'    => $teachers[2]->id,
                'duration'      => '4 Years',
                'fee'           => 45000.00,
                'level'         => 'intermediate',
                'seats'         => 50,
                'is_active'     => true,
                'is_featured'   => false,
            ],
            [
                'title'         => 'Diploma in IT',
                'slug'          => 'diploma-information-technology',
                'description'   => 'A practical 3-year diploma program in web development, networking, and system administration.',
                'department_id' => $it->id,
                'teacher_id'    => $teachers[6]->id,
                'duration'      => '3 Years',
                'fee'           => 40000.00,
                'level'         => 'intermediate',
                'seats'         => 30,
                'is_active'     => true,
                'is_featured'   => false,
            ],
            [
                'title'         => 'MBA – Master of Business Administration',
                'slug'          => 'mba-master-business-administration',
                'description'   => 'Advanced management program covering strategic management, finance, marketing, and leadership.',
                'department_id' => $management->id,
                'teacher_id'    => $teachers[4]->id,
                'duration'      => '2 Years',
                'fee'           => 80000.00,
                'level'         => 'advanced',
                'seats'         => 25,
                'is_active'     => true,
                'is_featured'   => true,
            ],
        ];
        $courses = collect($courseData)->map(fn($c) => Course::create($c));

        // ─── Students ────────────────────────────────────────────
        $studentNames = [
            ['Aarav Sharma', 'aarav@example.com', '9841100001'],
            ['Sita Thapa', 'sita@example.com', '9841100002'],
            ['Rohan Basnet', 'rohan@example.com', '9841100003'],
            ['Priya Rai', 'priya.student@example.com', '9841100004'],
            ['Aakash Magar', 'aakash@example.com', '9841100005'],
            ['Nisha Gurung', 'nisha@example.com', '9841100006'],
            ['Bikash Bhandari', 'bikash@example.com', '9841100007'],
            ['Pooja Shrestha', 'pooja@example.com', '9841100008'],
            ['Rajan Khadka', 'rajan@example.com', '9841100009'],
            ['Anita Lama', 'anita.student@example.com', '9841100010'],
        ];
        foreach ($studentNames as $i => [$name, $email, $phone]) {
            Student::create([
                'name'      => $name,
                'email'     => $email,
                'phone'     => $phone,
                'address'   => 'Kathmandu, Nepal',
                'dob'       => now()->subYears(rand(16, 24))->format('Y-m-d'),
                'course_id' => $courses->random()->id,
                'status'    => 'active',
            ]);
        }

        // ─── News ────────────────────────────────────────────────
        $newsItems = [
            [
                'title'        => 'EduManage School Achieves 98% Pass Rate in National Examinations',
                'slug'         => 'edumanage-school-98-percent-pass-rate',
                'excerpt'      => 'We are proud to announce that our students achieved a remarkable 98% pass rate in the national board examinations this year.',
                'body'         => '<p>EduManage School is thrilled to announce that our students have achieved an outstanding 98% pass rate in the national board examinations held this year. This remarkable achievement is a testament to the dedication of our students, teachers, and staff.</p><p>The Science department led the way with 100% results, followed closely by Commerce at 97% and Humanities at 96%. Our principal, Mr. Hari Prasad, expressed his immense pride in the entire school community.</p><p>"This achievement reflects our commitment to quality education and personalized learning," said Mr. Prasad. "We will continue to strive for excellence in all academic endeavors."</p><p>Special recognition goes to our top performers who secured distinction grades across all subjects.</p>',
                'is_featured'  => true,
                'is_published' => true,
                'published_at' => now()->subDays(3),
            ],
            [
                'title'        => 'Annual Sports Day 2024 — A Grand Celebration',
                'slug'         => 'annual-sports-day-2024',
                'excerpt'      => 'The Annual Sports Day 2024 was celebrated with great enthusiasm, featuring over 20 sports events and a record participation of 500+ students.',
                'body'         => '<p>EduManage School hosted its Annual Sports Day on the grand school grounds with an electric atmosphere. Over 500 students participated across 20+ sporting events including athletics, football, basketball, badminton, and traditional Nepali games.</p><p>The event was inaugurated by the Chief Guest, Dr. Binod Chaudhary, who emphasized the importance of physical activity for holistic student development.</p><p>The day concluded with a colorful prize distribution ceremony where top performers were felicitated with medals and trophies. The Science House emerged as the overall champion, edging out Commerce House in the final standings.</p>',
                'is_featured'  => false,
                'is_published' => true,
                'published_at' => now()->subDays(10),
            ],
            [
                'title'        => 'New Computer Lab Inaugurated with 50 High-Performance Workstations',
                'slug'         => 'new-computer-lab-inaugurated',
                'excerpt'      => 'EduManage School has inaugurated a state-of-the-art computer lab equipped with 50 high-performance workstations to enhance IT education.',
                'body'         => '<p>In a significant upgrade to our IT infrastructure, EduManage School has officially inaugurated a brand-new, state-of-the-art computer laboratory. The facility is equipped with 50 high-performance workstations, high-speed fiber internet, and the latest software tools.</p><p>The lab is designed to support BCA, Diploma IT, and +2 Computer Science students with an environment conducive to modern technology learning. The facility includes a dedicated server room, a projector system, and ergonomic furniture.</p><p>Students will now have access to industry-standard development environments, graphic design tools, and networking simulation software, preparing them for real-world technology careers.</p>',
                'is_featured'  => false,
                'is_published' => true,
                'published_at' => now()->subDays(20),
            ],
            [
                'title'        => 'Scholarship Program Open for Meritorious Students — Apply Now',
                'slug'         => 'scholarship-program-meritorious-students',
                'excerpt'      => 'EduManage School is offering full and partial scholarships for the upcoming academic year. Applications are now open for all eligible students.',
                'body'         => '<p>EduManage School is proud to announce the opening of its annual scholarship program for the upcoming academic year 2024-2025. Both full and partial scholarships are available for meritorious and economically disadvantaged students.</p><p><strong>Eligibility Criteria:</strong></p><ul><li>Full Scholarship: Students who scored 90% or above in their previous board examinations</li><li>Partial Scholarship (50%): Students who scored 80-89% in their previous examinations</li><li>Need-based scholarships are also available upon application</li></ul><p>Interested students are encouraged to collect the application form from the school office or download it from the school website. The last date for submission is July 31, 2024.</p>',
                'is_featured'  => true,
                'is_published' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'title'        => 'Parent-Teacher Meeting Scheduled for Next Month',
                'slug'         => 'parent-teacher-meeting-scheduled',
                'excerpt'      => 'The quarterly parent-teacher meeting is scheduled for next month. All parents are requested to confirm their attendance.',
                'body'         => '<p>EduManage School will be hosting its quarterly Parent-Teacher Meeting next month. The meeting is an excellent opportunity for parents to connect with faculty, discuss their child\'s academic progress, and address any concerns.</p><p>The meeting will be held in the school auditorium and will include individual consultations with subject teachers. Each session will be 10 minutes long, and parents are requested to book their preferred time slot in advance.</p><p>This initiative is part of our commitment to maintaining open communication between school and home, ensuring every student receives the support they need to thrive.</p>',
                'is_featured'  => false,
                'is_published' => true,
                'published_at' => now()->subDays(1),
            ],
        ];
        foreach ($newsItems as $n) {
            News::create($n);
        }

        // ─── Gallery ─────────────────────────────────────────────
        $galleryItems = [
            ['title' => 'School Main Building',    'category' => 'campus',  'sort_order' => 1,  'is_active' => true],
            ['title' => 'Computer Laboratory',     'category' => 'campus',  'sort_order' => 2,  'is_active' => true],
            ['title' => 'Science Laboratory',      'category' => 'campus',  'sort_order' => 3,  'is_active' => true],
            ['title' => 'School Library',          'category' => 'campus',  'sort_order' => 4,  'is_active' => true],
            ['title' => 'Annual Sports Day 2024',  'category' => 'events',  'sort_order' => 5,  'is_active' => true],
            ['title' => 'Graduation Ceremony 2023','category' => 'events',  'sort_order' => 6,  'is_active' => true],
            ['title' => 'Cultural Program Night',  'category' => 'events',  'sort_order' => 7,  'is_active' => true],
            ['title' => 'Science Exhibition',      'category' => 'events',  'sort_order' => 8,  'is_active' => true],
            ['title' => 'Students in Class',       'category' => 'students','sort_order' => 9,  'is_active' => true],
            ['title' => 'Group Project Work',      'category' => 'students','sort_order' => 10, 'is_active' => true],
            ['title' => 'Football Match',          'category' => 'sports',  'sort_order' => 11, 'is_active' => true],
            ['title' => 'Basketball Tournament',   'category' => 'sports',  'sort_order' => 12, 'is_active' => true],
        ];
        foreach ($galleryItems as $g) {
            Gallery::create($g);
        }

        // ─── Sample Admissions ───────────────────────────────────
        Admission::create([
            'name'            => 'Manish Tamang',
            'email'           => 'manish@example.com',
            'phone'           => '9841200001',
            'course_id'       => $courses->first()->id,
            'previous_school' => 'Shree Janasewa Secondary School',
            'qualification'   => 'SEE Grade A',
            'status'          => 'pending',
            'message'         => 'Interested in the Science program.',
        ]);

        Admission::create([
            'name'            => 'Kabita Shrestha',
            'email'           => 'kabita@example.com',
            'phone'           => '9841200002',
            'course_id'       => $courses[2]->id,
            'previous_school' => 'Saraswoti Higher Secondary School',
            'qualification'   => '+2 Science (A+)',
            'status'          => 'approved',
            'message'         => 'Looking forward to studying BCA.',
        ]);

        // ─── Sample Contact Messages ─────────────────────────────
        Contact::create([
            'name'    => 'Rajesh Kumar',
            'email'   => 'rajesh@example.com',
            'phone'   => '9841300001',
            'subject' => 'Inquiry about BCA program',
            'message' => 'I would like to know more about the BCA program fees and eligibility criteria.',
            'status'  => 'unread',
        ]);

        // ─── Settings ────────────────────────────────────────────
        $settings = [
            ['key' => 'school_name',    'value' => 'EduManage School'],
            ['key' => 'school_phone',   'value' => '+977-01-4567890'],
            ['key' => 'school_email',   'value' => 'info@edumanage.com'],
            ['key' => 'school_address', 'value' => 'Kathmandu, Nepal'],
            ['key' => 'school_tagline', 'value' => 'Quality Education for a Better Future'],
            ['key' => 'facebook_url',   'value' => 'https://facebook.com/edumanage'],
            ['key' => 'twitter_url',    'value' => 'https://twitter.com/edumanage'],
            ['key' => 'youtube_url',    'value' => 'https://youtube.com/edumanage'],
        ];
        foreach ($settings as $s) {
            Setting::create($s);
        }
    }
}
