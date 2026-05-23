const firstNames = [
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
  "Isabella",
];
const lastNames = [
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
  "Jones",
];
const sampleEvents = [
  "Global AI & Ethics Symposium",
  "Alumni Networking Gala",
  "Public Speaking Masterclass",
  "Inter-College Track Meet",
  "Quantum Computing Intro",
  "Spring Career Fair 2027",
  "UI/UX Design Hackathon",
  "Campus Cultural Fest",
  "Resume Writing Workshop",
];
const statuses = ["Pending", "Approved", "Rejected"];

function getRandomDate(start, end) {
  return new Date(
    start.getTime() + Math.random() * (end.getTime() - start.getTime()),
  );
}

const registrationsData = [];

const endDate = new Date();
const startDate = new Date();
startDate.setDate(endDate.getDate() - 30);

for (let i = 1; i <= 145; i++) {
  const randomFirstName =
    firstNames[Math.floor(Math.random() * firstNames.length)];
  const randomLastName =
    lastNames[Math.floor(Math.random() * lastNames.length)];
  const randomEvent =
    sampleEvents[Math.floor(Math.random() * sampleEvents.length)];
  const randomStatus = statuses[Math.floor(Math.random() * statuses.length)];

  const randomDate = getRandomDate(startDate, endDate);

  const avatarId = (i % 70) + 1;

  registrationsData.push({
    id: i,
    name: `${randomFirstName} ${randomLastName}`,
    event: randomEvent,
    dateApplied: randomDate.toISOString(),
    status: randomStatus,
    avatar: `https://i.pravatar.cc/150?img=${avatarId}`,
  });
}

export { registrationsData };
