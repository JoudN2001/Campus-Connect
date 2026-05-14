import { eventsData } from "../../data/events.js";
import { usersData } from "../../data/users.js";
import { registrationsData } from "../../data/registrations.js";

// SUMMARY CARDS
function updateSummary() {
  const activeEventsValue = document.getElementById("active-events");
  const totalRegistrationsValue = document.getElementById(
    "total-registrations",
  );
  const pendingApprovalsValue = document.getElementById("pending-approvals");

  if (activeEventsValue) {
    activeEventsValue.innerHTML = registrationsData.filter(
      (reg) => reg.status === "Approved",
    ).length;
  }
  if (totalRegistrationsValue) {
    totalRegistrationsValue.innerHTML = registrationsData.length;
  }
  if (pendingApprovalsValue) {
    pendingApprovalsValue.innerHTML = registrationsData.filter(
      (reg) => reg.status === "Pending",
    ).length;
  }
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

// FORMATE TIME A GO
function formatTimeAgo(date, locale = "en") {
  const diffInSeconds = Math.floor((date - new Date()) / 1000);
  const units = [
    { name: "year", seconds: 31536000 },
    { name: "month", seconds: 2592000 },
    { name: "day", seconds: 86400 },
    { name: "hour", seconds: 3600 },
    { name: "minute", seconds: 60 },
    { name: "second", seconds: 1 },
  ];

  const rtf = new Intl.RelativeTimeFormat(locale, { numeric: "auto" });

  for (const unit of units) {
    if (Math.abs(diffInSeconds) >= unit.seconds || unit.name === "second") {
      const value = Math.floor(diffInSeconds / unit.seconds);
      return rtf.format(value, unit.name);
    }
  }
}

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
  tableBody.innerHTML = pageData
    .map((reg) => {
      const formatedDate = formatTimeAgo(new Date(reg.dateApplied));
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
          <td class="date-text">${formatedDate}</td>
          <td><span class="status-badge ${statusClass}">${reg.status}</span></td>
          <td>
              <div class="action-buttons icon-only">
                  <span class="material-symbols-outlined action-icon approved" data-id="${reg.id}" title="Approve">check</span>
                  <span class="material-symbols-outlined action-icon rejected" data-id="${reg.id}" title="Reject">close</span>
              </div>
          </td>
      </tr>`;
    })
    .join("");
  updateSummary();
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
      filteredData = registrationsData.filter(
        (reg) => reg.status === "Pending",
      );
    } else if (filterBtn.id === "approved") {
      filteredData = registrationsData.filter(
        (reg) => reg.status === "Approved",
      );
    } else if (filterBtn.id === "rejected") {
      filteredData = registrationsData.filter(
        (reg) => reg.status === "Rejected",
      );
    }

    currentPage = 1;
    renderTable();
  });
});

tableBody.addEventListener("click", (e) => {
  if (e.target.classList.contains("approved")) {
    const id = parseInt(e.target.getAttribute("data-id"));

    const index = registrationsData.findIndex((reg) => reg.id === id);
    if (index !== -1) {
      registrationsData[index].status = "Approved";
      alert("Registration Approved Successfully!");
    }

    const activeFilter = document.querySelector(".filter.active").id;
    if (activeFilter === "pending") {
      filteredData = registrationsData.filter(
        (reg) => reg.status === "Pending",
      );
    } else if (activeFilter === "rejected") {
      filteredData = registrationsData.filter(
        (reg) => reg.status === "Rejected",
      );
    } else if (activeFilter === "approved") {
      filteredData = registrationsData.filter(
        (reg) => reg.status === "Approved",
      );
    } else {
      filteredData = registrationsData;
    }

    renderTable();
  }
  if (e.target.classList.contains("rejected")) {
    const id = parseInt(e.target.getAttribute("data-id"));

    const index = registrationsData.findIndex((reg) => reg.id === id);
    if (index !== -1) {
      registrationsData[index].status = "Rejected";
      alert("Registration has been Rejected.");
    }

    const activeFilter = document.querySelector(".filter.active").id;
    if (activeFilter === "pending") {
      filteredData = registrationsData.filter(
        (reg) => reg.status === "Pending",
      );
    } else if (activeFilter === "rejected") {
      filteredData = registrationsData.filter(
        (reg) => reg.status === "Rejected",
      );
    } else if (activeFilter === "approved") {
      filteredData = registrationsData.filter(
        (reg) => reg.status === "Approved",
      );
    } else {
      filteredData = registrationsData;
    }

    renderTable();
  }
});

// SEARCH FILTERATION
const searchInput = document.querySelector('input[type="search"]');
const searchForm = document.querySelector(".search-filter form");

if (searchForm) {
  searchForm.addEventListener("submit", (e) => {
    e.preventDefault();
  });
}

if (searchInput) {
  searchInput.addEventListener("input", (e) => {
    const searchTerm = e.target.value.toLowerCase();

    const activeFilter = document.querySelector(".filter.active").id;
    let tempFilteredData = registrationsData;

    if (activeFilter === "pending") {
      filteredData = registrationsData.filter(
        (reg) => reg.status === "Pending",
      );
    } else if (activeFilter === "rejected") {
      filteredData = registrationsData.filter(
        (reg) => reg.status === "Rejected",
      );
    } else if (activeFilter === "approved") {
      filteredData = registrationsData.filter(
        (reg) => reg.status === "Approved",
      );
    } else {
      filteredData = registrationsData;
    }

    if (searchTerm !== "") {
      filteredData = tempFilteredData.filter((reg) => {
        return (
          reg.name.toLowerCase().includes(searchTerm) ||
          reg.event.toLowerCase().includes(searchTerm)
        );
      });
    } else {
      filteredData = tempFilteredData;
    }

    currentPage = 1;
    renderTable();
  });
}

renderTable();
