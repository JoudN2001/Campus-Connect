import { usersData } from "../../data/users.js";

// SUMMARY CARDS
const totalUsersValue = document.getElementById("total-users");
if (totalUsersValue) {
  totalUsersValue.innerHTML = usersData.length;
}

// FILTER BUTTONS
const filterAllBtn = document.getElementById("all");
const filtersBtns = document.querySelectorAll(".filter");

// TABLE & PAGINATION ELEMENTS
const tableBody = document.querySelector("tbody");
const pagination = document.querySelector(".pagination-num");
const nextPageBtn = document.getElementById("next");
const previousPageBtn = document.getElementById("previous");

// PAGINATION STATE
const itemsPerPage = 5;
let currentPage = 1;
let filteredData = usersData;

// RENDER FUNCTION
function renderTable() {
  const startIndex = (currentPage - 1) * itemsPerPage;
  const endIndex = startIndex + itemsPerPage;
  const pageData = filteredData.slice(startIndex, endIndex);
  const actualEndIndex = Math.min(endIndex, filteredData.length);

  // Update Pagination Text
  if (pagination) {
    pagination.innerHTML = `Showing <strong>${filteredData.length === 0 ? 0 : startIndex + 1}</strong> to <strong>${actualEndIndex}</strong> of <strong>${filteredData.length}</strong> users`;
  }

  // Map the Data to HTML
  tableBody.innerHTML = pageData
    .map((user) => {
      // Set proper status badge colors
      let statusClass = "offline";
      if (user.status === "Active") statusClass = "approved";

      return `
        <tr>
            <td>
                <div class="student-profile">
                    <img src="${user.avatar}" alt="${user.name}">
                    <div style="display: flex; flex-direction: column; gap: 0.2rem;">
                        <span class="name">${user.name}</span>
                        <span style="font-size: 0.8rem; color: #6c757d;">${user.email}</span>
                    </div>
                </div>
            </td>
            <td>
                <div style="display: flex; flex-direction: column; gap: 0.2rem;">
                    <span style="font-weight: 600; color: #333;">${user.lastLoginTime}</span>
                    <span style="font-size: 0.8rem; color: #8C98A4;">${user.lastLoginMethod}</span>
                </div>
            </td>
            <td><span class="status-badge ${statusClass}">${user.status}</span></td>
            <td>
                <select class="role-dropdown">
                    <option ${user.role === "Administrator" ? "selected" : ""}>Administrator</option>
                    <option ${user.role === "Moderator" ? "selected" : ""}>Moderator</option>
                    <option ${user.role === "Faculty" ? "selected" : ""}>Faculty</option>
                    <option ${user.role === "Student" ? "selected" : ""}>Student</option>
                </select>
            </td>
        </tr>`;
    })
    .join("");
}

// PAGINATION LISTENERS
if (nextPageBtn) {
  nextPageBtn.addEventListener("click", () => {
    const totalPages = Math.ceil(filteredData.length / itemsPerPage);
    if (currentPage < totalPages) {
      currentPage++;
      renderTable();
    }
  });
}

if (previousPageBtn) {
  previousPageBtn.addEventListener("click", () => {
    if (currentPage > 1) {
      currentPage--;
      renderTable();
    }
  });
}

// FILTER LISTENERS
filtersBtns.forEach((filterBtn) => {
  filterBtn.addEventListener("click", () => {
    // Update Active Button styling
    filtersBtns.forEach((filter) => filter.classList.remove("active"));
    filterBtn.classList.add("active");

    // Filter the array based on button ID
    if (filterBtn.id === "all") {
      filteredData = usersData;
    } else if (filterBtn.id === "student") {
      filteredData = usersData.filter((user) => user.role === "Student");
    } else if (filterBtn.id === "faculty") {
      filteredData = usersData.filter((user) => user.role === "Faculty");
    } else if (filterBtn.id === "admin") {
      // Include both Administrators and Moderators in the Admin filter
      filteredData = usersData.filter(
        (user) => user.role === "Administrator" || user.role === "Moderator",
      );
    }

    // Reset to page 1 and re-render
    currentPage = 1;
    renderTable();
  });
});

// INITIAL RENDER
renderTable();
