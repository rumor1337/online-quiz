const dropdownBtn = document.getElementById("dropdownBtn");
const dropdown = document.getElementById("dropdown");
const selectedTopic = document.getElementById("selectedTopic");

// Toggle dropdown
dropdownBtn.addEventListener("click", () => {
  dropdown.style.display =
    dropdown.style.display === "block" ? "none" : "block";
});

// Select topic
document.querySelectorAll(".dropdown-content div").forEach(item => {
  item.addEventListener("click", () => {
    const topic = item.getAttribute("data-topic");

    selectedTopic.textContent = "Selected: " + topic;
    dropdownBtn.textContent = topic + " ▼";

    dropdown.style.display = "none";
  });
});

// Close when clicking outside
window.addEventListener("click", (e) => {
  if (!dropdownBtn.contains(e.target)) {
    dropdown.style.display = "none";
  }
});