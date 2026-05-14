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
                <select class="role-dropdown" data-id="${user.id}">
                    <option value="Administrator" ${user.role === "Administrator" ? "selected" : ""}>Administrator</option>
                    <option value="Moderator" ${user.role === "Moderator" ? "selected" : ""}>Moderator</option>
                    <option value="Faculty" ${user.role === "Faculty" ? "selected" : ""}>Faculty</option>
                    <option value="Student" ${user.role === "Student" ? "selected" : ""}>Student</option>
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
      filteredData = usersData.filter(
        (user) => user.role === "Administrator" || user.role === "Moderator",
      );
    }

    currentPage = 1;
    renderTable();
  });
});

tableBody.addEventListener("change", (e) => {
  if (e.target.classList.contains("role-dropdown")) {
    const id = parseInt(e.target.getAttribute("data-id"));
    const newRole = e.target.value;

    const index = usersData.findIndex((user) => user.id === id);
    if (index !== -1) {
      usersData[index].role = newRole;
      alert(`User permission changed to ${newRole} successfully!`);
    }

    const activeFilter = document.querySelector(".filter.active").id;
    if (activeFilter === "student") {
      filteredData = usersData.filter((user) => user.role === "Student");
    } else if (activeFilter === "faculty") {
      filteredData = usersData.filter((user) => user.role === "Faculty");
    } else if (activeFilter === "admin") {
      filteredData = usersData.filter(
        (user) => user.role === "Administrator" || user.role === "Moderator",
      );
    } else {
      filteredData = usersData;
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
    let tempFilteredData = usersData;

    if (activeFilter === "student") {
      tempFilteredData = usersData.filter((user) => user.role === "Student");
    } else if (activeFilter === "faculty") {
      tempFilteredData = usersData.filter((user) => user.role === "Faculty");
    } else if (activeFilter === "admin") {
      tempFilteredData = usersData.filter(
        (user) => user.role === "Administrator" || user.role === "Moderator",
      );
    }

    if (searchTerm !== "") {
      filteredData = tempFilteredData.filter((user) => {
        return (
          user.name.toLowerCase().includes(searchTerm) ||
          user.email.toLowerCase().includes(searchTerm)
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
