const schedule = [
  { name: "Event1", time: "07:00:00" },
  { name: "Event2", time: "07:30:00" },
  { name: "Event3", time: "08:00:00" },
  { name: "Event4", time: "09:00:00" },
];

const scheduleContainer = document.getElementById("schedule-container");

function displaySchedule() {
  schedule.forEach((event) => {
const eventDiv = document.createElement("div");
eventDiv.innerHTML = `<h3>${event.name}</h3><p>Scheduled: ${event.time}</p><div id="${event.name}-countdown"></div>`;
scheduleContainer.appendChild(eventDiv);

startCountdown(event);
  });
}

function startCountdown(event) {
  const [hours, minutes, seconds] = event.time.split(":").map(Number);

  const eventTime = new Date();
  eventTime.setHours(hours);
  eventTime.setMinutes(minutes);
  eventTime.setSeconds(seconds);

  const countdownDiv = document.getElementById(`${event.name}-countdown`);

  function updateCountdown() {
const now = new Date();
const timeDiff = eventTime.getTime() - now.getTime();

if (timeDiff <= 0) {
countdownDiv.innerHTML = "Time Up!";
clearInterval(intervalId);
return;
  }

const days = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
const hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
const minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
const seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);

countdownDiv.innerHTML = `Time Left: ${days}d ${hours}h ${minutes}m ${seconds}s`;
  }

  updateCountdown(); // Initial update
  const intervalId = setInterval(updateCountdown, 1000); // Update every second
}
displaySchedule();
