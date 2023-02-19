const currentDate = new Date();
let currentYear = currentDate.getFullYear();
let currentMonth = currentDate.getMonth();
let daysInMonth = [];
let daysArray = [];
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

alertify.set("notifier", "position", "top-center");

$(document).on("click", "#add-user-work-schedule", function () {
  const userId = $("#get-user-id-work");
  const userName = $("#get-user-name-schedule");

  if (!userId.val() || selectedDays.length <= 5 || selectedDays.length >= 23) {
    return alertify.error(
      !userId.val()
        ? "Изберете потребител"
        : selectedDays.length >= 23
        ? "Избрали сте повече от 22 календарни дни"
        : "Изберете повече от 5 календарни дни"
    );
  }

  $.ajax({
    url: "action/AdminSchedule.php",
    type: "POST",
    data: {
      dates: JSON.stringify(selectedDays),
      daysCount: selectedDays.length,
      userId: userId.val(),
      currentMonth: currentMonth,
    },
    success: function () {
      $(".user-box").removeClass("bg-slate-50");
      selectedDays = [];
      updateTable();
      $("#load-user-data").load(window.location.href + " #load-user-data");
      alertify.success(`Успено обновихте графика на ${userName.val()}`);
      userId.val("");
    },
  });
});

$(document).on("click", "#set-user-id-work", function () {
  const id = $(this).val();
  $(".user-box").removeClass("bg-slate-50");
  $(this).addClass("bg-slate-50");

  $.ajax({
    url: `action/AdminSchedule.php?id=${id}`,
    type: "GET",
    success: function (response) {
      const res = JSON.parse(response);

      if (res.data.current_month == currentMonth && res.data.work_days) {
        selectedDays = res.data.work_days.slice(1, -1).split(",").map(Number);
        updateTable();
      } else {
        selectedDays = [];
        updateTable();
      }
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

        html += `<td><div class="w-10 h-10 my-0.5 flex justify-center items-center cursor-pointer font-medium calendar-date-box ${
          selected
            ? "bg-blue-400 hover:bg-blue-500 text-white"
            : `${textColorClass} hover:bg-blue-400 hover:text-white`
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

$(document).on("click", "#calendar", function (event) {
  if (!event.target.classList.contains("calendar-date-box")) {
    return;
  }

  let day = event.target.dataset.day;
  let index = selectedDays.indexOf(+day);

  if (index === -1) {
    selectedDays.push(+day);
    event.target.classList.remove("text-slate-700", "text-slate-400");
    event.target.classList.add("bg-blue-400", "text-white", "hover:opacity-80");
  } else {
    selectedDays.splice(index, 1);
    event.target.classList.remove(
      "bg-blue-400",
      "text-white",
      "hover:opacity-80"
    );

    updateTable();
  }
});

updateDays();

$(document).on("click", "#set-user-id-work", function () {
  const userData = $(this).val().split(" ");
  $("#get-user-id-work").val(userData[0]);

  if (userData[2]) {
    $("#get-user-name-schedule").val(`${userData[1]} ${userData[2]}`);
  } else {
    $("#get-user-name-schedule").val(`${userData[1]}`);
  }
});

$(document).on("click", "#select-user-work-schedule", function () {
  selectedDays = [];

  for (let i = 0; i < daysInMonth.length; i++) {
    let date = new Date(currentYear, currentMonth, daysInMonth[i]);
    let dayOfWeek = date.getDay();
    if (dayOfWeek >= 1 && dayOfWeek <= 5) {
      selectedDays.push(daysInMonth[i]);
    }
  }

  updateTable();
});

$(document).on("click", "#clear-user-work-schedule", function () {
  selectedDays = [];
  updateDays();
});

const slideMessageContainers = document.querySelectorAll(".slide-message");

slideMessageContainers.forEach((slideMessageContainer) => {
  slideMessageContainer.addEventListener("mouseover", (event) => {
    const innerMessage = event.currentTarget.querySelector(".inner-message");
    const accepted = event.currentTarget.querySelector(".accept-message");
    const rejected = event.currentTarget.querySelector(".reject-message");
    const question = event.currentTarget.querySelector("#id-question");

    let isDragging = false;
    let currentX;
    let initialX;
    let xOffset = 0;

    innerMessage.addEventListener("mousedown", dragStart);
    innerMessage.addEventListener("mouseup", dragEnd);
    innerMessage.addEventListener("mouseleave", dragEnd);
    innerMessage.addEventListener("mousemove", drag);

    function dragStart(e) {
      initialX = e.clientX;
      isDragging = true;
    }

    function dragEnd(e) {
      isDragging = false;

      if (xOffset > 160) {
        innerMessage.classList.add("hidden");
        innerMessage.style.transform = "translateX(100%)";
        accepted.classList.remove("hidden");
        accepted.classList.add("block");

        $.ajax({
          url: "action/AdminSchedule.php",
          type: "POST",
          data: {
            state: 1,
            role: "Admin",
            questionId: question.value,
          },
          success: function (response) {
            console.log(response);
          },
        });
      } else if (xOffset < -160) {
        innerMessage.classList.add("hidden");
        innerMessage.style.transform = "translateX(-100%)";
        rejected.classList.remove("hidden");
        rejected.classList.add("block");

        $.ajax({
          url: "action/AdminSchedule.php",
          type: "POST",
          data: {
            state: 0,
            role: "Admin",
            questionId: question.value,
          },
          success: function (response) {
            console.log(response);
          },
        });
      } else {
        innerMessage.style.transform = "translateX(0)";
      }

      innerMessage.classList.remove("text-green-500");
      innerMessage.classList.remove("text-red-500");
    }

    function drag(e) {
      if (!isDragging) return;

      e.preventDefault();
      currentX = e.clientX;
      xOffset = currentX - initialX;
      innerMessage.style.transform = `translateX(${xOffset}px)`;

      if (xOffset > 70) {
        innerMessage.classList.remove("text-red-500");
        innerMessage.classList.add("text-green-500");
      } else if (xOffset < -70) {
        innerMessage.classList.remove("text-green-500");
        innerMessage.classList.add("text-red-500");
      } else {
        innerMessage.classList.remove("text-green-500");
        innerMessage.classList.remove("text-red-500");
      }
    }
  });
});

