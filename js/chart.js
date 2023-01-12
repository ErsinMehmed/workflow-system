var countAll = $("#order-count").val();
var countActive = $(".active-order-count").val();
var countFinished = $(".finished-order-count").val();

var active = (countActive * 100) / countAll;
var finished = (countFinished * 100) / countAll;

const ctx = document.getElementById("orders-chart");

new Chart(ctx, {
  type: "doughnut",

  data: {
    labels: ["Активни", "Приключени или отказани"],
    datasets: [
      {
        data: [active.toFixed(0), finished.toFixed(0)],
        backgroundColor: ["rgb(193, 225, 193)", "rgb(250, 160, 160)"],
        hoverOffset: 4,
      },
    ],
  },
  plugins: [ChartDataLabels],
  options: {
    maintainAspectRatio: false,
    plugins: {
      legend: {
        labels: {
          font: {
            size: 15,
          },
          color: "rgb(145,145,145)",
        },
      },
      title: {
        display: true,
        text: "Задачи за деня",
        color: "rgb(145,145,145)",
        font: {
          size: 20,
        },
      },
      datalabels: {
        formatter: (value, context) => {
          return value + "%";
        },
        color: "white",
        font: {
          weight: "600",
          size: 14,
        },
      },
    },
  },
});

