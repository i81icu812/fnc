<!DOCTYPE html>
<html>
<head><title>Schedule</title></head>
<body>
    <div id="schedule"></div>
    <script>
        const scheduleDiv = document.getElementById('schedule');
        const dailySchedule = [
            { time: '07:00', activity: 'Wake Up' },
            { time: '07:30', activity: 'Breakfast' },
            { time: '08:00', activity: 'Morning Walk' },
            { time: '24:00', activity: 'Midnight' },
        ];
        function displaySchedule() {
            let scheduleHTML = '<h2>Schedule</h2>';
            dailySchedule.forEach(item => {
                const eventTime = new Date();
                const [hours, minutes] = item.time.split(':');
                eventTime.setHours(parseInt(hours), parseInt(minutes), 0, 0);
                scheduleHTML += `<p><b>${item.time}:</b> ${item.activity} <span id="${item.time}-countdown"></span></p>`;
            });
            scheduleDiv.innerHTML = scheduleHTML;
            startCountdowns();
        }
        function startCountdowns() {
            dailySchedule.forEach(item => {
                const eventTime = new Date();
                const [hours, minutes] = item.time.split(':');
                eventTime.setHours(parseInt(hours), parseInt(minutes), 0, 0);
                const countdownElement = document.getElementById(`${item.time}-countdown`);
                updateCountdown(eventTime, countdownElement);
                 // Initial call to update, then update every second
                setInterval(() => updateCountdown(eventTime, countdownElement), 1000);
            });
        }
        function updateCountdown(eventTime, countdownElement) {
           const now = new Date();
            const timeLeft = eventTime - now;
             if (timeLeft < 0) {
              countdownElement.innerText = 'Timer expired.!';
                return;
            }
            const hours = Math.floor(timeLeft / (1000 * 60 * 60));
            const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
            countdownElement.innerText = `${hours}h ${minutes}m ${seconds}s left`;
        }
        displaySchedule();
    </script>
</body>
</html>
