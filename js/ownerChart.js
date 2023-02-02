// Number pie chart of offer types
const ctx = document.getElementById("offer-chart");

var pieChart = new Chart(ctx, {
  type: "pie",

  data: {
    labels: ["Основна", "Премиум", "Вип"],
    datasets: [
      {
        data: [
          $("#first-offer").val(),
          $("#second-offer").val(),
          $("#third-offer").val(),
        ],
        backgroundColor: [
          "rgb(25, 136, 255)",
          "rgb(127, 189, 255)",
          "rgb(178, 215, 255)",
        ],
      },
    ],
  },
  options: {
    maintainAspectRatio: false,
    responsive: true,
    plugins: {
      legend: {
        position: "bottom",
      },
    },
  },
});

$(document).on("change", "#select-period", function (e) {
  const period = $(this).val();

  $.ajax({
    url: "action/Owner.php",
    type: "POST",
    data: { period: period },
    success: function (response) {
      const res = jQuery.parseJSON(response);

      pieChart.data.datasets[0].data = [res.first, res.second, res.third];

      pieChart.update();
    },
  });
});

// Line chart for incomes and expenses
const ctx1 = document.getElementById("income-chart");

const labels = [
  "Яну",
  "Фев",
  "Мар",
  "Апр",
  "Май",
  "Юни",
  "Юли",
  "Авг",
  "Сеп",
  "Окт",
  "Ное",
  "Дек",
];

const currentMonth = new Date().getMonth();
const updatedLabels = labels.slice(0, currentMonth + 1);
const pastIncomes = [];
const pastExpenses = [];

for (let i = 0; i <= currentMonth; i++) {
  pastIncomes.push($("#" + labels[i].toLowerCase()).val());
  pastExpenses.push($("#1" + labels[i].toLowerCase()).val());
}

const updatedIncome = pastIncomes.slice(0, currentMonth + 1);
const updatedExpense = pastExpenses.slice(0, currentMonth + 1);

new Chart(ctx1, {
  type: "line",

  data: {
    labels: updatedLabels,
    datasets: [
      {
        label: "Приходи",
        fill: "start",
        data: updatedIncome,
        borderColor: "rgba(0,123,255,1)",
        backgroundColor: ["rgba(0,123,255,0.1)"],
        pointHoverBackgroundColor: "rgb(0,123,255, 0.6)",
        pointBackgroundColor: "rgb(0,123,255)",
        borderWidth: 1.5,
        pointHoverRadius: 4,
      },
      {
        label: "Разходи",
        fill: "start",
        data: updatedExpense,
        backgroundColor: "rgba(255,65,105,0.1)",
        borderColor: "rgba(255,65,105,1)",
        pointBackgroundColor: "rgba(255,65,105,1)",
        pointHoverBackgroundColor: "rgba(255,65,105,0.6)",
        borderDash: [3, 3],
        borderWidth: 1.5,
        pointHoverRadius: 4,
        pointBorderColor: "rgba(255,65,105,1)",
      },
    ],
  },
  options: {
    maintainAspectRatio: false,
    responsive: true,
    elements: {
      line: {
        tension: 0.3,
      },
      point: {
        radius: 0,
      },
    },
    scales: {
      x: {
        grid: {
          display: false,
        },
      },
    },
    hover: {
      mode: "nearest",
      intersect: false,
    },
    tooltips: {
      custom: false,
      mode: "nearest",
      intersect: false,
    },
  },
});
