function togglePieChartsVisibility(sum, inputId, chartId) {
  $(inputId)
    .toggleClass("flex", sum === 0)
    .toggleClass("hidden", sum !== 0)
    .html(sum === 0 ? "Няма намерени данни" : "");
  $(chartId).css("display", sum === 0 ? "none" : "block");
}

// Number pie chart of offer types
const ctx = document.getElementById("offer-chart");

const firstOffer = parseInt($("#first-offer").val());
const secondOffer = parseInt($("#second-offer").val());
const thirdOffer = parseInt($("#third-offer").val());

const sum = firstOffer + secondOffer + thirdOffer;

if (sum === 0) {
  $("#offer-chart-no-data").html("Няма намерени данни");
} else {
  var pieChart = new Chart(ctx, {
    type: "pie",

    data: {
      labels: ["Основна", "Премиум", "Вип"],
      datasets: [
        {
          data: [firstOffer, secondOffer, thirdOffer],
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
}

$(document).on("change", "#select-period", function (e) {
  const period = $(this).val();

  $.ajax({
    url: "action/Owner.php",
    type: "POST",
    data: { period: period },
    success: function (response) {
      const res = jQuery.parseJSON(response);
      const sum = res.first + res.second + res.third;

      togglePieChartsVisibility(sum, "#offer-chart-no-data", "#offer-chart");

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
  pastIncomes.push($(`#${labels[i].toLowerCase()}`).val());
  pastExpenses.push($(`#1${labels[i].toLowerCase()}`).val());
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

// Numbers of payment by kind
const ctx2 = document.getElementById("pay-chart");

const cash = parseInt($("#cash-pay").val());
const card = parseInt($("#card-pay").val());

const sum1 = cash + card;

if (sum1 === 0) {
  $("#pay-chart-no-data").html("Няма намерени данни");
} else {
  var pieChart1 = new Chart(ctx2, {
    type: "pie",

    data: {
      labels: ["В брой", "С карта"],
      datasets: [
        {
          data: [cash, card],
          backgroundColor: ["rgb(25, 136, 255)", "rgb(127, 189, 255)"],
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
}

$(document).on("change", "#select-period-payment", function (e) {
  const payPeriod = $(this).val();

  $.ajax({
    url: "action/Owner.php",
    type: "POST",
    data: { payPeriod: payPeriod },
    success: function (response) {
      const res = jQuery.parseJSON(response);
      const sum = res.cash + res.card;

      togglePieChartsVisibility(sum, "#pay-chart-no-data", "#pay-chart");

      pieChart1.data.datasets[0].data = [res.cash, res.card];
      pieChart1.update();
    },
  });
});
