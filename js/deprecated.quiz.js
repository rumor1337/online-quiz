const dropdownBtn = document.getElementById("dropdownBtn");
const dropdown = document.getElementById("dropdown");
const selectedTopic = document.getElementById("selectedTopic");
const form = document.getElementById('hiddenSelected');

dropdownBtn.addEventListener("click", () => {
  dropdown.style.display =
    dropdown.style.display === "block" ? "none" : "block";
});

document.querySelectorAll(".dropdown-content div").forEach(item => {
  item.addEventListener("click", () => {
    const topic = item.textContent;
    const backendTopic = item.getAttribute('data-topic');

    selectedTopic.textContent = "Selected: " + topic;
    form.value = backendTopic;
    dropdownBtn.textContent = topic + " ▼";

    dropdown.style.display = "none";
  });
});

window.addEventListener("click", (e) => {
  if (!dropdownBtn.contains(e.target)) {
    dropdown.style.display = "none";
  }
});