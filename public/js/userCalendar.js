const currentDate = new Date();
let currentYear = currentDate.getFullYear();
let currentMonth = currentDate.getMonth();
let daysInMonth = [];
let selectedDays = [];
const months = [
  "Януари",
  "Февруари",
  "Март",
  "Април",
  "Май",
  "Юни",
  "Юли",
  "Август",
  "Септември",
  "Октомври",
  "Ноември",
  "Декември",
];

$(document).on("click", "#show-user-schedule", function () {
  const id = $(this).val();

  $.ajax({
    type: "GET",
    url: `action/AdminSchedule.php?id=${id}`,
    success: function (response) {
      const res = JSON.parse(response);
      selectedDays = res.data.work_days.slice(1, -1).split(",").map(Number);
      updateTable();
      updateDays();
    },
  });
});

$("#show-date").html(`${months[currentMonth]} ${currentYear}`);

function updateDays() {
  daysInMonth = [];
  let date = new Date(currentYear, currentMonth, 1);
  while (date.getMonth() === currentMonth) {
    daysInMonth.push(new Date(date).getDate());
    date.setDate(date.getDate() + 1);
  }
  updateTable();
}

let table = $("#calendar");

function updateTable() {
  let firstDay = new Date(currentYear, currentMonth, 0).getDay();
  let numRows = Math.ceil((firstDay + daysInMonth.length) / 7);
  let row = 0;
  let col = 0;
  let html = "";

  for (let i = 0; i < numRows; i++) {
    html += "<tr>";

    for (let j = 0; j < 7; j++) {
      if (
        (row === 0 && j < firstDay) ||
        (row > 0 && col >= daysInMonth.length)
      ) {
        html += "<td></td>";
      } else {
        let selected = selectedDays.indexOf(daysInMonth[col]) !== -1;
        let dayOfWeek = new Date(
          currentYear,
          currentMonth,
          daysInMonth[col]
        ).getDay();
        let textColorClass = "text-slate-700";

        if (dayOfWeek === 0 || dayOfWeek === 6) {
          textColorClass = "text-slate-400";
        }

        html += `<td><div class="w-10 h-10 my-0.5 flex justify-center items-center font-medium ${
          selected ? "bg-blue-400 text-white" : `${textColorClass}`
        } rounded-full transition-all" data-day="${daysInMonth[col++]}">${
          daysInMonth[col - 1]
        }</div></td>`;
      }
    }

    html += "</tr>";
    row++;
  }

  table.html(html);
}

