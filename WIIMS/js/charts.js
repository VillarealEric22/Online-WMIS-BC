var xValues = [100,200,300,400,500,600,700,800,900,1000];

new Chart("LineChart", {
  type: "line",
  data: {

    labels: xValues,
    datasets: [{ 
      label: 'Oven',
      data: [860,1140,1060,1060,1070,1110,1330,2210,7830,2478],
      borderColor: "red",
      fill: false
    }, { 
      label: 'Mixers',
      data: [1600,1700,1700,1900,2000,2700,4000,5000,6000,7000],
      borderColor: "green",
      fill: false
    }, { 
      label: 'Slicers',
      data: [300,700,2000,5000,6000,4000,2000,1000,200,100],
      borderColor: "blue",
      fill: false
    }]
  },
  options: {
    legend: {display: true}
  }
});

var xValues = ["Oven", "Mixer", "Slicer", "Grinder", "Plancha"];
var yValues = [55, 49, 44, 24, 15];
var barColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
  "#e8c3b9",
  "#1e7145"
];

new Chart("PieChart", {
    type: "pie",
    data: {
      labels: xValues,
      datasets: [{
        backgroundColor: barColors,
        data: yValues
      }]
    },
    options: {
      title: {
        display: true,
        text: "Inventory"
      }
    }
  });