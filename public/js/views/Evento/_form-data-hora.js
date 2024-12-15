document.addEventListener("DOMContentLoaded", function () {
    flatpickr("#data_inicio", {
        dateFormat: "d/m/Y",
        locale: "pt"
    });

    flatpickr("#data_fim", {
        dateFormat: "d/m/Y",
        locale: "pt"
    });

    flatpickr("#hora_inicio", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
        locale: "pt"
    });

    flatpickr("#hora_fim", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
        locale: "pt"
    });
});
