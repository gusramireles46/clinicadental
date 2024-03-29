// Función para crear el calendario
function createCalendar(year, month) {
    const daysInMonth = new Date(year, month + 1, 0).getDate();
    const firstDayOfMonth = new Date(year, month, 1).getDay();
    const today = new Date().getDate();

    const table = document.getElementById('calendar');
    table.innerHTML = '';

    // Crea los encabezados del calendario
    const header = table.createTHead();
    const headerRow = header.insertRow();
    const daysOfWeek = ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'];
    daysOfWeek.forEach(day => {
        const th = document.createElement('th');
        th.textContent = day;
        headerRow.appendChild(th);
    });

    // Crea las celdas del calendario
    let dayOfMonth = 1;
    for (let i = 0; i < 6; i++) {
        const row = table.insertRow();
        for (let j = 0; j < 7; j++) {
            const cell = row.insertCell();
            if ((i === 0 && j < firstDayOfMonth) || dayOfMonth > daysInMonth) {
                cell.textContent = '';
            } else {
                cell.textContent = dayOfMonth;
                if (dayOfMonth === today) {
                    cell.classList.add('today');
                }
                dayOfMonth++;
            }
        }
    }
}

// Obtiene la fecha actual
const currentDate = new Date();
const currentYear = currentDate.getFullYear();
const currentMonth = currentDate.getMonth();

// Crea el calendario con la fecha actual
createCalendar(currentYear, currentMonth);