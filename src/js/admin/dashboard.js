// DUMMY DATA
import { eventsData } from "../../data/events.js";
import { usersData } from "../../data/users.js";
import { registrationsData } from "../../data/registrations.js";

// SUMMARY CARD
const activeEventsValue = document.getElementById("actice-events");
const totalRegistrationsValue = document.getElementById("total-registrations");
const pendingApprovalsValue = document.getElementById("pending-approvals");
activeEventsValue.innerHTML = eventsData.filter(
  (event) => event.status === "Active",
).length;
totalRegistrationsValue.innerHTML = registrationsData.length;
pendingApprovalsValue.innerHTML = eventsData.filter(
  (event) => event.status === "Upcoming",
).length;

// NEXT EVENT CARD
const nextEvent = document.querySelector(".main-event");
const featuredEvents = document.querySelector(".selected-events");

const sortedEvents = [...eventsData].sort((a, b) => {
  return new Date(a.date) - new Date(b.date);
});

const formatedDate = new Intl.DateTimeFormat("en-GB", {
  day: "numeric",
  month: "long",
  year: "numeric",
}).format(new Date(sortedEvents[0].date));

nextEvent.innerHTML = `
<img class="bg-img" src="${sortedEvents[0].image}" alt="Featured Event">
<div class="event-content">
    <div class="top-info">
        <span class="status">Next Major Event</span>
        <h4 class="event-title">${sortedEvents[0].title}</h4>
    </div>
    <div class="event-info">
        <div class="info-block">
            <span class="info-label">DATE</span>
            <p class="detailes">${formatedDate}</p>
        </div>
        <div class="info-block">
            <span class="info-label">VENUE</span>
            <p class="detailes">${sortedEvents[0].location}</p>
        </div>
    </div>
</div>`;

// FEATURED CARDS
const randomEvents = [...eventsData]
  .sort(() => 0.5 - Math.random())
  .slice(0, 3);

featuredEvents.innerHTML = randomEvents
  .map((randomEvent) => {
    return `
    <div class="card">
        <img src="${randomEvent.image}" alt="thumbnail">
        <div class="detailes">
            <span class="catagory">${randomEvent.category}</span>
            <h2>${randomEvent.title}</h2>
            <p>${randomEvent.registered} Registered</p> 
        </div>
    </div>`;
  })
  .join("");
