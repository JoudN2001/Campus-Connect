// DUMMY DATA
import { eventsData } from "../../data/events.js";

// FILTER BUTTONS
const filterAllBtn = document.getElementById("all");
const filterUpComingBtn = document.getElementById("upcoming");
const filterActiveBtn = document.getElementById("active");
const filterCompletedBtn = document.getElementById("completed");
const filtersBtns = document.querySelectorAll(".filter");

// SUMMARY CARD 
const summaryCardValue = document.querySelector(".card .value")
summaryCardValue.innerHTML= eventsData.filter((event) => event.status === "Active").length

// TABLE & PAGINATION
const tableBody = document.querySelector("tbody");
const pagination = document.querySelector(".pagination-num");
const eventsNumber = eventsData.length;
const nextPageBtn = document.getElementById("next");
const previousPageBtn = document.getElementById("previous");
const itemsPerPage = 5;
let currentPage = 1;
let filteredData = eventsData;

// TABLE RENDER WITH PAGINATION
function renderTable() {
  const totalPages = Math.ceil(filteredData.length / itemsPerPage);
  const startIndex = (currentPage - 1) * itemsPerPage;
  const endIndex = startIndex + itemsPerPage;
  const pageData = filteredData.slice(startIndex, endIndex);
  const actualEndIndex = Math.min(endIndex, filteredData.length);
  if (pagination) {
    pagination.innerHTML = `Showing <strong>${startIndex + 1}</strong> to <strong>${actualEndIndex}</strong> of <strong>${filteredData.length}</strong> events`;
  }

  // MAPING DUMMY DATA
  tableBody.innerHTML = pageData
    .map((event) => {
      const formatedDate = new Intl.DateTimeFormat("en-GB", {
        day: "numeric",
        month: "long",
        year: "numeric",
      }).format(new Date(event.date));

      const percent =
        event.capacity > 0
          ? Math.round((event.registered / event.capacity) * 100)
          : 0;

      let statusClass = "pending";
      if (event.status === "Active") statusClass = "approved";
      if (event.status === "Cancelled") statusClass = "rejected";
      if (event.status === "Completed") statusClass = "offline";

      return `
  <td>
    <div class="student-profile">
      <img
        src="${event.image}"
        alt="${event.title}"
        class="event-thumbnail"
      />
      <div class="info-stack">
        <span class="name">${event.title}</span>
        <span class="sub-text">${event.location}</span>
      </div>
    </div>
  </td>
  <td>
    <div class="info-stack">
      <span class="main-text">${formatedDate}</span>
      <span class="sub-text">${event.startTime} - ${event.endTime}</span>
    </div>
  </td>
  <td>
    <div class="info-stack">
      <span class="main-text">${event.registered} / ${event.capacity}</span>
      <span class="sub-text">${percent}% Full</span>
    </div>
  </td>
  <td>
    <span class="status-badge ${statusClass}">${event.status}</span>
  </td>
  <td>
    <div class="action-buttons icon-only">
      <span class="material-symbols-outlined action-icon">edit</span>
      <span class="material-symbols-outlined action-icon">visibility</span>
      <span class="material-symbols-outlined action-icon rejected">delete</span>
    </div>
  </td>
</tr>`;
    })
    .join("");
}

nextPageBtn.addEventListener("click", () => {
  const totalPages = Math.ceil(filteredData.length / itemsPerPage);
  if (currentPage < totalPages) {
    currentPage++;
    renderTable();
  }
});

previousPageBtn.addEventListener("click", () => {
  if (currentPage > 1) {
    currentPage--;
    renderTable();
  }
});

// FILTERS
filtersBtns.forEach((filterBtn) => {
  filterBtn.addEventListener("click", () => {
    filtersBtns.forEach((filter) => filter.classList.remove("active"));
    filterBtn.classList.add("active");

    if (filterBtn.id === "all") {
      filteredData = eventsData;
    } else if (filterBtn.id === "upcoming") {
      filteredData = eventsData.filter((event) => event.status === "Upcoming");
    } else if (filterBtn.id === "active") {
      filteredData = eventsData.filter((event) => event.status === "Active");
    } else if (filterBtn.id === "cancelled") {
      filteredData = eventsData.filter((event) => event.status === "Cancelled");
    } else if (filterBtn.id === "completed") {
      filteredData = eventsData.filter((event) => event.status === "Completed");
    }

    currentPage = 1;

    renderTable();
  });
});

renderTable();
