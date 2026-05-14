import { eventsData } from "../../data/events.js";
import { usersData } from "../../data/users.js";
import { registrationsData } from "../../data/registrations.js";

// SUMMARY CARDS
const activeEventsValue = document.getElementById("active-events"); // Fixed typo
const totalRegistrationsValue = document.getElementById("total-registrations");
const pendingApprovalsValue = document.getElementById("pending-approvals");

if (activeEventsValue) {
  activeEventsValue.innerHTML = registrationsData.filter(reg => reg.status === "Approved").length;
}
if (totalRegistrationsValue) {
  totalRegistrationsValue.innerHTML = registrationsData.length;
}
if (pendingApprovalsValue) {
  pendingApprovalsValue.innerHTML = registrationsData.filter(reg => reg.status === "Pending").length;
}

// FILTER BUTTONS
const filterAllBtn = document.getElementById("all");
const filtersBtns = document.querySelectorAll(".filter");

// TABLE & PAGINATION
const tableBody = document.querySelector("tbody");
const pagination = document.querySelector(".pagination-num");
const nextPageBtn = document.getElementById("next");
const previousPageBtn = document.getElementById("previous");

const itemsPerPage = 5;
let currentPage = 1;
let filteredData = registrationsData;

// TABLE RENDER WITH PAGINATION
function renderTable() {
  const startIndex = (currentPage - 1) * itemsPerPage;
  const endIndex = startIndex + itemsPerPage;
  const pageData = filteredData.slice(startIndex, endIndex);
  const actualEndIndex = Math.min(endIndex, filteredData.length);
  
  if (pagination) {
    pagination.innerHTML = `Showing <strong>${filteredData.length === 0 ? 0 : startIndex + 1}</strong> to <strong>${actualEndIndex}</strong> of <strong>${filteredData.length}</strong> events`;
  }

  // MAPING DUMMY DATA
  tableBody.innerHTML = pageData.map((reg) => {
      
      let statusClass = "pending";
      if (reg.status === "Approved") statusClass = "approved";
      if (reg.status === "Rejected") statusClass = "rejected";

      return `
      <tr>
          <td>
              <div class="student-profile">
                  <img src="${reg.avatar}" alt="${reg.name}">
                  <span class="name">${reg.name}</span>
              </div>
          </td>
          <td>${reg.event}</td>
          <td class="date-text">${reg.dateApplied}</td>
          <td><span class="status-badge ${statusClass}">${reg.status}</span></td>
          <td>
              <div class="action-buttons icon-only">
                  <span class="material-symbols-outlined action-icon approved">check</span>
                  <span class="material-symbols-outlined action-icon rejected">close</span>
              </div>
          </td>
      </tr>`;
    }).join(""); 
}

// EVENT LISTENERS MOVED OUTSIDE THE RENDER FUNCTION!
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
      filteredData = registrationsData;
    } else if (filterBtn.id === "pending") {
      filteredData = registrationsData.filter((reg) => reg.status === "Pending");
    } else if (filterBtn.id === "approved") {
      filteredData = registrationsData.filter((reg) => reg.status === "Approved");
    } else if (filterBtn.id === "rejected") {
      filteredData = registrationsData.filter((reg) => reg.status === "Rejected");
    }

    currentPage = 1;
    renderTable();
  });
});

// Initial load (call only once)
renderTable();