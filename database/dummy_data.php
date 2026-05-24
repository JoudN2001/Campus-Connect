<?php
$usersData = [
    [
        "full_name" => "Eleanor Vance",
        "email" => "e.vance@university.edu",
        "avatar" => "https://i.pravatar.cc/150?img=5",
        "last_login_time" => date('Y-m-d H:i:s', strtotime('-2 hours')),
        "last_login_method" => "Web Portal",
        "status" => "Active",
        "role" => "Administrator"
    ],
    [
        "full_name" => "Marcus Thorne",
        "email" => "m.thorne@university.edu",
        "avatar" => "https://i.pravatar.cc/150?img=11",
        "last_login_time" => date('Y-m-d H:i:s', strtotime('-1 day')),
        "last_login_method" => "Mobile App",
        "status" => "Active",
        "role" => "Moderator"
    ],
    [
        "full_name" => "Sarah Jenkins",
        "email" => "s.jenkins24@student.edu",
        "avatar" => "https://i.pravatar.cc/150?img=9",
        "last_login_time" => "2026-10-12 14:00:00",
        "last_login_method" => "Web Portal",
        "status" => "Offline",
        "role" => "Student"
    ],
    [
        "full_name" => "Dr. Robert Chen",
        "email" => "r.chen@faculty.edu",
        "avatar" => "https://i.pravatar.cc/150?img=12",
        "last_login_time" => "2026-10-10 09:30:00",
        "last_login_method" => "Web Portal",
        "status" => "Active",
        "role" => "Faculty"
    ],
    [
        "full_name" => "Lila Patel",
        "email" => "l.patel@student.edu",
        "avatar" => "https://i.pravatar.cc/150?img=47",
        "last_login_time" => date('Y-m-d H:i:s'), // Just now
        "last_login_method" => "Mobile App",
        "status" => "Active",
        "role" => "Student"
    ],
    [
        "full_name" => "Dr. Amanda Lewis",
        "email" => "a.lewis@faculty.edu",
        "avatar" => "https://i.pravatar.cc/150?img=33",
        "last_login_time" => date('Y-m-d H:i:s', strtotime('-3 days')),
        "last_login_method" => "Web Portal",
        "status" => "Offline",
        "role" => "Faculty"
    ],
    [
        "full_name" => "James Wilson",
        "email" => "j.wilson88@student.edu",
        "avatar" => "https://i.pravatar.cc/150?img=60",
        "last_login_time" => date('Y-m-d H:i:s', strtotime('-5 hours')),
        "last_login_method" => "Mobile App",
        "status" => "Active",
        "role" => "Student"
    ],
    [
        "full_name" => "Prof. Michael Chang",
        "email" => "m.chang@university.edu",
        "avatar" => "https://i.pravatar.cc/150?img=68",
        "last_login_time" => "2026-10-08 11:15:00",
        "last_login_method" => "Web Portal",
        "status" => "Offline",
        "role" => "Administrator"
    ],
    [
        "full_name" => "Emily Davis",
        "email" => "e.davis@student.edu",
        "avatar" => "https://i.pravatar.cc/150?img=43",
        "last_login_time" => date('Y-m-d H:i:s', strtotime('-1 hour')),
        "last_login_method" => "Mobile App",
        "status" => "Active",
        "role" => "Student"
    ],
    [
        "full_name" => "David Osei",
        "email" => "d.osei@student.edu",
        "avatar" => "https://i.pravatar.cc/150?img=14",
        "last_login_time" => date('Y-m-d H:i:s', strtotime('-1 day')),
        "last_login_method" => "Web Portal",
        "status" => "Offline",
        "role" => "Student"
    ],
    [
        "full_name" => "Olivia Martinez",
        "email" => "o.martinez@university.edu",
        "avatar" => "https://i.pravatar.cc/150?img=32",
        "last_login_time" => date('Y-m-d H:i:s', strtotime('-10 minutes')),
        "last_login_method" => "Web Portal",
        "status" => "Active",
        "role" => "Moderator"
    ],
    [
        "full_name" => "Daniel Kim",
        "email" => "d.kim99@student.edu",
        "avatar" => "https://i.pravatar.cc/150?img=53",
        "last_login_time" => "2026-10-01 16:45:00",
        "last_login_method" => "Mobile App",
        "status" => "Offline",
        "role" => "Student"
    ],
    [
        "full_name" => "Dr. Hassan Ali",
        "email" => "h.ali@faculty.edu",
        "avatar" => "https://i.pravatar.cc/150?img=61",
        "last_login_time" => date('Y-m-d H:i:s'), // Today
        "last_login_method" => "Web Portal",
        "status" => "Active",
        "role" => "Faculty"
    ],
    [
        "full_name" => "Sophia Taylor",
        "email" => "s.taylor@student.edu",
        "avatar" => "https://i.pravatar.cc/150?img=20",
        "last_login_time" => "2026-10-11 10:00:00",
        "last_login_method" => "Mobile App",
        "status" => "Offline",
        "role" => "Student"
    ],
    [
        "full_name" => "Liam Gallagher",
        "email" => "l.gallagher@student.edu",
        "avatar" => "https://i.pravatar.cc/150?img=59",
        "last_login_time" => date('Y-m-d H:i:s', strtotime('-2 hours')),
        "last_login_method" => "Web Portal",
        "status" => "Active",
        "role" => "Student"
    ]
];

$eventsData = [
    [
        "title" => "Global AI & Ethics Symposium",
        "category" => "Technology",
        "event_date" => "2026-10-24",
        "start_time" => "09:00:00",
        "end_time" => "17:00:00",
        "location" => "Great Hall",
        "description" => "Join elite engineering minds to discuss the ethical implications of artificial intelligence in modern society.",
        "image" => "https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=600&q=80",
        "capacity" => 500,
        "registered" => 450,
        "status" => "Upcoming"
    ],
    [
        "title" => "Alumni Networking Gala",
        "category" => "Social",
        "event_date" => "2026-11-02",
        "start_time" => "19:00:00",
        "end_time" => "23:00:00",
        "location" => "Grand Ballroom",
        "description" => "Connect with Fortune 500 recruiters and university alumni in an exclusive evening of networking.",
        "image" => "https://images.unsplash.com/photo-1511795409834-ef04bbd61622?w=600&q=80",
        "capacity" => 200,
        "registered" => 200,
        "status" => "Active"
    ],
    [
        "title" => "Public Speaking Masterclass",
        "category" => "Workshop",
        "event_date" => "2026-05-15",
        "start_time" => "14:00:00",
        "end_time" => "16:00:00",
        "location" => "Room 304",
        "description" => "Learn the nuances of corporate leadership and overcome stage fright with professional vocal coaches.",
        "image" => "https://images.unsplash.com/photo-1475721027785-f74eccf877e2?w=600&q=80",
        "capacity" => 50,
        "registered" => 45,
        "status" => "Active"
    ],
    [
        "title" => "Inter-College Track Meet",
        "category" => "Sports",
        "event_date" => "2026-04-10",
        "start_time" => "08:00:00",
        "end_time" => "18:00:00",
        "location" => "Main Stadium",
        "description" => "Annual athletics competition featuring track and field events between all university departments.",
        "image" => "https://images.unsplash.com/photo-1461896836934-ffe607ba8211?w=600&q=80",
        "capacity" => 1000,
        "registered" => 850,
        "status" => "Completed"
    ],
    [
        "title" => "Quantum Computing Intro",
        "category" => "Technology",
        "event_date" => "2026-10-20",
        "start_time" => "10:00:00",
        "end_time" => "12:00:00",
        "location" => "Science Lab B",
        "description" => "Exploring the frontiers of quantum computing and its implications for cybersecurity.",
        "image" => "https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=600&q=80",
        "capacity" => 30,
        "registered" => 0,
        "status" => "Cancelled"
    ],
    [
        "title" => "Spring Career Fair 2027",
        "category" => "Academic",
        "event_date" => "2027-03-10",
        "start_time" => "10:00:00",
        "end_time" => "16:00:00",
        "location" => "University Expo Center",
        "description" => "Meet with over 100 employers looking to hire students for internships and full-time roles.",
        "image" => "https://images.unsplash.com/photo-1556761175-4b46a572b786?w=600&q=80",
        "capacity" => 1500,
        "registered" => 1200,
        "status" => "Upcoming"
    ],
    [
        "title" => "UI/UX Design Hackathon",
        "category" => "Technology",
        "event_date" => "2026-06-05",
        "start_time" => "09:00:00",
        "end_time" => "21:00:00",
        "location" => "Innovation Hub",
        "description" => "A 12-hour design sprint to solve user experience challenges for local non-profits.",
        "image" => "https://images.unsplash.com/photo-1522542550221-31fd19575a2d?w=600&q=80",
        "capacity" => 100,
        "registered" => 95,
        "status" => "Upcoming"
    ],
    [
        "title" => "Campus Cultural Fest",
        "category" => "Social",
        "event_date" => "2026-05-20",
        "start_time" => "16:00:00",
        "end_time" => "22:00:00",
        "location" => "Central Plaza",
        "description" => "Celebrate global diversity with food stalls, live music, and traditional dance performances.",
        "image" => "https://images.unsplash.com/photo-1533174000220-400159f809a7?w=600&q=80",
        "capacity" => 2000,
        "registered" => 1850,
        "status" => "Upcoming"
    ],
    [
        "title" => "Resume Writing Workshop",
        "category" => "Workshop",
        "event_date" => "2026-05-18",
        "start_time" => "13:00:00",
        "end_time" => "15:00:00",
        "location" => "Library Room 2B",
        "description" => "Craft a winning resume with 1-on-1 feedback from university career advisors.",
        "image" => "https://images.unsplash.com/photo-1586281380349-632531db7ed4?w=600&q=80",
        "capacity" => 40,
        "registered" => 40,
        "status" => "Active"
    ],
    [
        "title" => "Varsity Basketball Finals",
        "category" => "Sports",
        "event_date" => "2026-03-25",
        "start_time" => "18:00:00",
        "end_time" => "20:30:00",
        "location" => "Indoor Arena",
        "description" => "Cheer on the university team as they face off against our historic rivals in the championship.",
        "image" => "https://images.unsplash.com/photo-1504450758481-7338eba7524a?w=600&q=80",
        "capacity" => 800,
        "registered" => 800,
        "status" => "Completed"
    ],
    [
        "title" => "Advanced Data Structures",
        "category" => "Academic",
        "event_date" => "2026-06-12",
        "start_time" => "11:00:00",
        "end_time" => "13:00:00",
        "location" => "Lecture Hall A",
        "description" => "Guest lecture by a Google engineer on implementing efficient trees and graphs in production.",
        "image" => "https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=600&q=80",
        "capacity" => 150,
        "registered" => 130,
        "status" => "Upcoming"
    ],
    [
        "title" => "Freshman Welcome Mixer",
        "category" => "Social",
        "event_date" => "2026-09-01",
        "start_time" => "17:00:00",
        "end_time" => "20:00:00",
        "location" => "Student Union",
        "description" => "Ice-breakers, free pizza, and an introduction to university clubs for incoming freshmen.",
        "image" => "https://images.unsplash.com/photo-1517457373958-b7bdd4587205?w=600&q=80",
        "capacity" => 400,
        "registered" => 350,
        "status" => "Upcoming"
    ],
    [
        "title" => "Outdoor Yoga Session",
        "category" => "Sports",
        "event_date" => "2026-05-22",
        "start_time" => "07:00:00",
        "end_time" => "08:30:00",
        "location" => "Botanical Gardens",
        "description" => "A relaxing sunrise yoga session to help students de-stress before final exams.",
        "image" => "https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=600&q=80",
        "capacity" => 60,
        "registered" => 55,
        "status" => "Upcoming"
    ],
    [
        "title" => "Cybersecurity Capture the Flag",
        "category" => "Technology",
        "event_date" => "2026-02-14",
        "start_time" => "09:00:00",
        "end_time" => "21:00:00",
        "location" => "Computer Lab 1",
        "description" => "A competitive hacking event to test your networking and cryptography skills.",
        "image" => "https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?w=600&q=80",
        "capacity" => 80,
        "registered" => 75,
        "status" => "Completed"
    ],
    [
        "title" => "Pottery & Ceramics Workshop",
        "category" => "Workshop",
        "event_date" => "2026-05-28",
        "start_time" => "15:00:00",
        "end_time" => "18:00:00",
        "location" => "Arts Studio",
        "description" => "Learn the basics of wheel throwing and glazing in this hands-on creative session.",
        "image" => "https://images.unsplash.com/photo-1610701596007-11502861dcfa?w=600&q=80",
        "capacity" => 20,
        "registered" => 20,
        "status" => "Active"
    ],
    [
        "title" => "Medical Research Symposium",
        "category" => "Academic",
        "event_date" => "2026-07-15",
        "start_time" => "09:00:00",
        "end_time" => "16:00:00",
        "location" => "Medical Campus Auditorium",
        "description" => "Postgraduate students present their latest findings in cellular biology and pharmacology.",
        "image" => "https://images.unsplash.com/photo-1532187863486-abf9dbad1b69?w=600&q=80",
        "capacity" => 250,
        "registered" => 180,
        "status" => "Upcoming"
    ],
    [
        "title" => "Open Mic Night",
        "category" => "Social",
        "event_date" => "2026-05-16",
        "start_time" => "20:00:00",
        "end_time" => "23:00:00",
        "location" => "Campus Cafe",
        "description" => "Show off your musical, comedic, or poetic talents, or just come to enjoy the show.",
        "image" => "https://images.unsplash.com/photo-1516280440502-a2f0b7c7b203?w=600&q=80",
        "capacity" => 100,
        "registered" => 80,
        "status" => "Active"
    ],
    [
        "title" => "Inter-Faculty Chess Tournament",
        "category" => "Sports",
        "event_date" => "2026-06-01",
        "start_time" => "10:00:00",
        "end_time" => "18:00:00",
        "location" => "Recreation Center",
        "description" => "A Swiss-system chess tournament open to all students and faculty members.",
        "image" => "https://images.unsplash.com/photo-1529699211952-734e80c4d42b?w=600&q=80",
        "capacity" => 64,
        "registered" => 64,
        "status" => "Upcoming"
    ],
    [
        "title" => "React.js Crash Course",
        "category" => "Technology",
        "event_date" => "2026-05-10",
        "start_time" => "13:00:00",
        "end_time" => "16:00:00",
        "location" => "Virtual (Zoom)",
        "description" => "A fast-paced introduction to building modern user interfaces using React and Hooks.",
        "image" => "https://images.unsplash.com/photo-1633356122544-f134324a6cee?w=600&q=80",
        "capacity" => 500,
        "registered" => 490,
        "status" => "Completed"
    ],
    [
        "title" => "Thesis Writing Retreat",
        "category" => "Workshop",
        "event_date" => "2026-08-05",
        "start_time" => "09:00:00",
        "end_time" => "17:00:00",
        "location" => "Library Quiet Floor",
        "description" => "Dedicated writing time for seniors and grad students, complete with coffee and peer review.",
        "image" => "https://images.unsplash.com/photo-1455390582262-044cdead2708?w=600&q=80",
        "capacity" => 50,
        "registered" => 25,
        "status" => "Upcoming"
    ],
    [
        "title" => "Startup Pitch Competition",
        "category" => "Academic",
        "event_date" => "2026-09-15",
        "start_time" => "14:00:00",
        "end_time" => "18:00:00",
        "location" => "Business School Theater",
        "description" => "Student entrepreneurs pitch their startup ideas to local angel investors for seed funding.",
        "image" => "https://images.unsplash.com/photo-1559136555-9ce7b5fda016?w=600&q=80",
        "capacity" => 300,
        "registered" => 280,
        "status" => "Upcoming"
    ],
    [
        "title" => "Winter Charity Ball",
        "category" => "Social",
        "event_date" => "2026-12-10",
        "start_time" => "19:30:00",
        "end_time" => "00:00:00",
        "location" => "Downtown Hotel",
        "description" => "A formal dining and dancing event to raise funds for the local children's hospital.",
        "image" => "https://images.unsplash.com/photo-1519671482749-fd09be7ccebf?w=600&q=80",
        "capacity" => 400,
        "registered" => 390,
        "status" => "Upcoming"
    ],
    [
        "title" => "5K Campus Fun Run",
        "category" => "Sports",
        "event_date" => "2026-10-05",
        "start_time" => "08:00:00",
        "end_time" => "10:00:00",
        "location" => "Campus Gates",
        "description" => "A casual 5K run around the university campus. Costumes are highly encouraged!",
        "image" => "https://images.unsplash.com/photo-1552674605-171ff5aa595a?w=600&q=80",
        "capacity" => 1000,
        "registered" => 650,
        "status" => "Upcoming"
    ],
    [
        "title" => "Blockchain & Web3 Summit",
        "category" => "Technology",
        "event_date" => "2026-04-20",
        "start_time" => "10:00:00",
        "end_time" => "15:00:00",
        "location" => "Tech Annex",
        "description" => "Exploring decentralized applications, smart contracts, and the future of finance.",
        "image" => "https://images.unsplash.com/photo-1621416894569-0f39ed31d247?w=600&q=80",
        "capacity" => 200,
        "registered" => 200,
        "status" => "Completed"
    ],
    [
        "title" => "Photography Walk",
        "category" => "Workshop",
        "event_date" => "2026-06-25",
        "start_time" => "16:00:00",
        "end_time" => "18:00:00",
        "location" => "Old Campus Square",
        "description" => "Learn composition and lighting techniques while exploring the historic parts of campus.",
        "image" => "https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=600&q=80",
        "capacity" => 30,
        "registered" => 15,
        "status" => "Upcoming"
    ],
    [
        "title" => "Environmental Science Fair",
        "category" => "Academic",
        "event_date" => "2026-04-22",
        "start_time" => "09:00:00",
        "end_time" => "14:00:00",
        "location" => "Green Quad",
        "description" => "Earth Day event showcasing student projects on sustainability and renewable energy.",
        "image" => "https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?w=600&q=80",
        "capacity" => 400,
        "registered" => 310,
        "status" => "Completed"
    ],
    [
        "title" => "Guest Author Book Reading",
        "category" => "Social",
        "event_date" => "2026-11-15",
        "start_time" => "18:30:00",
        "end_time" => "20:00:00",
        "location" => "Main Library",
        "description" => "Award-winning author discussing their latest novel, followed by a Q&A and book signing.",
        "image" => "https://images.unsplash.com/photo-1457369804613-52c61a468e7d?w=600&q=80",
        "capacity" => 120,
        "registered" => 120,
        "status" => "Upcoming"
    ],
    [
        "title" => "Intramural Volleyball League",
        "category" => "Sports",
        "event_date" => "2026-09-10",
        "start_time" => "17:00:00",
        "end_time" => "21:00:00",
        "location" => "South Gym",
        "description" => "Kickoff for the fall semester mixed-gender volleyball league.",
        "image" => "https://images.unsplash.com/photo-1593787406536-3696c42a2b0c?w=600&q=80",
        "capacity" => 160,
        "registered" => 145,
        "status" => "Upcoming"
    ],
    [
        "title" => "Machine Learning Study Group",
        "category" => "Technology",
        "event_date" => "2026-05-17",
        "start_time" => "18:00:00",
        "end_time" => "20:00:00",
        "location" => "Study Room 4C",
        "description" => "Weekly meetup to review PyTorch tutorials and work on personal ML projects.",
        "image" => "https://images.unsplash.com/photo-1555949963-ff9fe0c870eb?w=600&q=80",
        "capacity" => 25,
        "registered" => 25,
        "status" => "Active"
    ],
    [
        "title" => "Financial Literacy 101",
        "category" => "Workshop",
        "event_date" => "2026-08-20",
        "start_time" => "14:00:00",
        "end_time" => "16:00:00",
        "location" => "Lecture Hall C",
        "description" => "Crucial workshop for seniors covering budgeting, student loans, and basic investing.",
        "image" => "https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=600&q=80",
        "capacity" => 200,
        "registered" => 0,
        "status" => "Cancelled"
    ]
];

$firstNames = [
    "Liam",
    "Aisha",
    "Carlos",
    "Yuki",
    "Sarah",
    "David",
    "Elena",
    "Marcus",
    "Sophia",
    "James",
    "Emily",
    "Olivia",
    "Daniel",
    "Hassan",
    "Michael",
    "Emma",
    "Noah",
    "Ava",
    "William",
    "Isabella"
];

$lastNames = [
    "Gallagher",
    "Patel",
    "Mendoza",
    "Tanaka",
    "Jenkins",
    "Osei",
    "Rodriguez",
    "Thorne",
    "Chen",
    "Wilson",
    "Davis",
    "Martinez",
    "Kim",
    "Ali",
    "Chang",
    "Smith",
    "Johnson",
    "Williams",
    "Brown",
    "Jones"
];

$sampleEvents = [
    "Global AI & Ethics Symposium",
    "Alumni Networking Gala",
    "Public Speaking Masterclass",
    "Inter-College Track Meet",
    "Quantum Computing Intro",
    "Spring Career Fair 2027",
    "UI/UX Design Hackathon",
    "Campus Cultural Fest",
    "Resume Writing Workshop"
];

$statuses = ["Pending", "Approved", "Rejected"];

$registrationsData = [];

$endDate = time();
$startDate = strtotime('-30 days');

for ($i = 1; $i <= 145; $i++) {
    $randomFirstName = $firstNames[array_rand($firstNames)];
    $randomLastName = $lastNames[array_rand($lastNames)];
    $randomEvent = $sampleEvents[array_rand($sampleEvents)];
    $randomStatus = $statuses[array_rand($statuses)];

    $randomTimestamp = mt_rand($startDate, $endDate);
    $dateApplied = date('Y-m-d H:i:s', $randomTimestamp);

    $avatarId = ($i % 70) + 1;

    $registrationsData[] = [
        "student_name" => $randomFirstName . " " . $randomLastName,
        "event_name" => $randomEvent,
        "date_applied" => $dateApplied,
        "status" => $randomStatus,
        "avatar" => "https://i.pravatar.cc/150?img=" . $avatarId
    ];
}
