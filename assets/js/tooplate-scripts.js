const width_threshold = 480;

function drawLineChart() {
  if ($("#lineChart").length) {
    ctxLine = document.getElementById("lineChart").getContext("2d");
    optionsLine = {
      scales: {
        yAxes: [
          {
            scaleLabel: {
              display: true,
              labelString: "Visits"
            }
          }
        ]
      }
    };

    // Set aspect ratio based on window width
    optionsLine.maintainAspectRatio =
      $(window).width() < width_threshold ? false : true;

    configLine = {
      type: "line",
      data: {
        labels: [
          "January",
          "February",
          "March",
          "April",
          "May",
          "June",
          "July"
        ],
        datasets: [
          {
            label: "Latest Visits",
            data: [88, 68, 79, 57, 50, 55, 70],
            fill: false,
            borderColor: "rgb(75, 192, 192)",
            cubicInterpolationMode: "monotone",
            pointRadius: 0
          },
          {
            label: "Popular Hits",
            data: [33, 45, 37, 21, 55, 74, 69],
            fill: false,
            borderColor: "rgba(255,99,132,1)",
            cubicInterpolationMode: "monotone",
            pointRadius: 0
          },
          {
            label: "Featured",
            data: [44, 19, 38, 46, 85, 66, 79],
            fill: false,
            borderColor: "rgba(153, 102, 255, 1)",
            cubicInterpolationMode: "monotone",
            pointRadius: 0
          }
        ]
      },
      options: optionsLine
    };

    lineChart = new Chart(ctxLine, configLine);
  }
}

function drawBarChart() {
  if ($("#barChart").length) {
    ctxBar = document.getElementById("barChart").getContext("2d");

    optionsBar = {
      responsive: true,
      scales: {
        yAxes: [
          {
            barPercentage: .7,
            ticks: {
              beginAtZero: true,
            },
            scaleLabel: {
              display: true,
              labelString: "Pages"
            }
          }
        ]
      }
    };

    optionsBar.maintainAspectRatio =
      $(window).width() < width_threshold ? false : true;

      var webHostingPages = $(".Web-Hosting").length;
      var aboutPages = $(".About").length;
      var webDevPages = $(".Web-Dev").length;
      var homePages = $(".Home").length;
      var digitalMarketings = $(".Digital-Marketing").length;

      var fullPercent = webDevPages+aboutPages+webHostingPages+homePages+digitalMarketings;

      var webHostingPagesPercentage = Math.ceil((webHostingPages / fullPercent)* 100);
      var aboutPagesPercentage = Math.ceil((aboutPages / fullPercent)* 100);
      var webDevPagesPercentage = Math.ceil((webDevPages / fullPercent)* 100);
      var homePagesPercentage = Math.ceil((homePages / fullPercent)* 100);
      var digitalMarketingsPercentage = Math.ceil((digitalMarketings / fullPercent)* 100);
    /**
     * COLOR CODES
     * Red: #F7604D
     * Aqua: #4ED6B8
     * Green: #A8D582
     * Yellow: #D7D768
     * Purple: #9D66CC
     * Orange: #DB9C3F
     * Blue: #3889FC
     */

    configBar = {
      type: "horizontalBar",
      data: {
        labels: ["Home", "About", "Web-Dev", "Web-Hosting", "Digital-Marketing",],
        datasets: [
          {
            label: "% of Visits",
            data: [homePagesPercentage, aboutPagesPercentage, webDevPagesPercentage, webHostingPagesPercentage, digitalMarketingsPercentage],
            backgroundColor: [
              "#F7604D",
              "#4ED6B8",
              "#A8D582",
              "#D7D768",
              "#9D66CC"
            ],
            borderWidth: 0
          }
        ]
      },
      options: optionsBar
    };

    barChart = new Chart(ctxBar, configBar);
  }
}

function drawPieChart() {
  if ($("#pieChart").length) {
    var chartHeight = 300;

    $("#pieChartContainer").css("height", chartHeight + "px");

    ctxPie = document.getElementById("pieChart").getContext("2d");

    optionsPie = {
      responsive: true,
      maintainAspectRatio: false,
      layout: {
        padding: {
          left: 10,
          right: 10,
          top: 10,
          bottom: 10
        }
      },
      legend: {
        position: "top"
      }
    };
    var pages;
    var numberOfVisits;
    var persentage;
    configPie = {
      type: "pie",
      data: {
        datasets: [
          {
            data: [fullSpace, storageSpace, freeSpace],
            backgroundColor: ["#F7604D", "#4ED6B8", "#A8D582"],
            label: "Storage"
          }
        ],
        labels: [
          "Full Storage ("+fullSpace+"GB)",
          "Used Storage ("+storageSpace+"GB)",
          "Available Storage ("+freeSpace+"GB)"
        ]
      },
      options: optionsPie
    };

    pieChart = new Chart(ctxPie, configPie);
  }
}

function updateLineChart() {
  if (lineChart) {
    lineChart.options = optionsLine;
    lineChart.update();
  }
}

function updateBarChart() {
  if (barChart) {
    barChart.options = optionsBar;
    barChart.update();
  }
}
