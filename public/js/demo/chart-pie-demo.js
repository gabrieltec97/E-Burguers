// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

var valor1 = $(".lbl1").val();
var valor2 = $(".lbl2").val();
var valor3 = $(".lbl3").val();
var valor4 = $(".lbl4").val();

var quantidade1 = $(".valor1").val();
var quantidade2 = $(".valor2").val();
var quantidade3 = $(".valor3").val();
var quantidade4 = $(".valor4").val();

var texto2 = ' pedidos';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: [valor4, valor3,valor2, valor1],
    datasets: [{
      data: [quantidade4, quantidade3, quantidade2, quantidade1],
      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', 'red'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', 'red'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});
