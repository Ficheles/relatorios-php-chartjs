function ret(param){
    var values = [];
    $.each(param, function(key, val){
       values.push(val) ;
    });

    return values;
}

/*********************************** GRÁFICO DE BARRAS ***********************************/
$(function () {
    var ctx, data, myBarChart, option_bars;
    Chart.defaults.global.responsive = true;
    ctx = $('#horarios').get(0).getContext('2d');
    //ctx = document.getElementById('horarios').getContext('2d');
    ctx.canvas.height = 100;
    option_bars = {
        responsive: true,
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Chart.js Bar Chart'
                    }

        // scaleBeginAtZero: true,
        // scaleShowGridLines: true,
        // scaleGridLineColor: "rgba(0,0,0,.05)",
        // scaleGridLineWidth: 1,
        // scaleShowHorizontalLines: true,
        // scaleShowVerticalLines: false,
        // barShowStroke: true,
        // barStrokeWidth: 1,
        // barValueSpacing: 5,
        // barDatasetSpacing: 3,
        //legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
    };

    var periodo = '-3 days';
    $.getJSON('/classes/Relatorios.php/trafego_por_hora/'+periodo, function(response){
        
        data = {
            labels: Object.keys(response),
            //labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            datasets: [
                {
                    label: "Acessos por Hora",
                    //fillColor: "rgba(26, 188, 156,0.6)",
                    //strokeColor: "#1ABC9C",
                    //pointColor: "#1ABC9C",
                    //pointStrokeColor: "#fff",
                    //pointHighlightFill: "#fff",
                    //pointHighlightStroke: "#1ABC9C",
                    //backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                    backgroundColor: 'transparent',
                    borderColor: 'rgba(77,166, 253, 0.85)',
                    //borderColor: window.chartColors.red,
                    borderWidth: 1,
                    //data: [65, 59, 80, 81, 56, 55, 40]
                    data: ret(response)
                }
            ]
        };

    //     console.log(Object.keys(response));
    //     console.log(ret(response));
    // });
       // myBarChart = new Chart(ctx).Bar(data, option_bars);
        myBarChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: option_bars
        });
    });    

});

/*********************************** GRÁFICO DE LINHAS ***********************************/

$(function () {
    var ctx, data, myLineChart, options;
    Chart.defaults.global.responsive = true;
    ctx = $('#mensal').get(0).getContext('2d');
    ctx.canvas.height = 100;

    $.getJSON('/classes/Relatorios.php/trafego_mensal/', function(response){

        options = {
            responsive: true,
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Chart.js Bar Chart'
            }
        };    

        data = {
            labels: Object.keys(response),
            //labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            datasets: [
                {
                    label: "Acessos Mensal por dia",
                    backgroundColor: 'transparent',
                    borderColor: 'rgba(77,166, 253, 0.85)',
                    borderWidth: 1,
                    //data: [65, 59, 80, 81, 56, 55, 40]
                    data: ret(response)
                }
            ]
        };
        
        myLineChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: options
        });
    });
});


/*********************************** GRÁFICO POLAR **************************************/


  var chartColors = window.chartColors;
  var color = Chart.helpers.color;
  //var colorNames = Object.keys(window.chartColors);

window.onload = function() {
    
    $.getJSON('/classes/Relatorios.php/trafego_semanal/', function(response){
        var config = {
            data: {
                datasets: [{
                    data: ret(response),
                    backgroundColor: [
                        color('red').alpha(0.5).rgbString(),
                        color('orange').alpha(0.5).rgbString(),
                        color('yellow').alpha(0.5).rgbString(),
                        color('green').alpha(0.5).rgbString(),
                        color('blue').alpha(0.5).rgbString(),
                        color('purple').alpha(0.5).rgbString(),
                        color('gray').alpha(0.5).rgbString()
                    ],
                    label: 'Acesso Semanal' // for legend
                }],
                labels: Object.keys(response)
            },
            options: {
                responsive: true,
                legend: {
                    position: 'right',
                },
                title: {
                    display: true,
                    text: 'Acesso Semanal'
                },
                scale: {
                    ticks: {
                        beginAtZero: true
                    },
                    reverse: false
                },
                animation: {
                    animateRotate: false,
                    animateScale: true
                }
            }
        };

        var ctx = document.getElementById('semanal');
        window.myPolarArea = new Chart.PolarArea(ctx, config);
    });


/*********************************** GRÁFICO EM DOUGHNUT ********************************/
    $.getJSON('/classes/Relatorios.php/trafego_por_navegador/', function(response){
        
        var config = {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: ret(response),
                    backgroundColor: [
                        color('red').alpha(0.5).rgbString(),
                        color('orange').alpha(0.5).rgbString(),
                        color('yellow').alpha(0.5).rgbString(),
                        color('green').alpha(0.5).rgbString(),
                        color('blue').alpha(0.5).rgbString()
                    ],
                    label: 'Semana'
                }],
                labels: Object.keys(response)
            },
            options: {
                responsive: true,
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Navegadores'
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        };


        var ctx = document.getElementById('navegador').getContext('2d');
        window.myDoughnut = new Chart(ctx, config);

    });



/*********************************** GRÁFICO EM RADAR ***********************************/
    
    $.getJSON('/classes/Relatorios.php/trafego_por_plataforma/', function(response){
 
        var config = {
            type: 'radar',
            data: {
                labels: Object.keys(response),
                datasets: [{
                    label: 'Acessos',
                    backgroundColor: color('red').alpha(0.2).rgbString(),
                    borderColor: color('red').alpha(0.5).rgbString(),
                    pointBackgroundColor:color('red').alpha(0.5).rgbString(),
                    data: ret(response)
                }]
            },
            options: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Plataformas'
                },
                scale: {
                    ticks: {
                        beginAtZero: true
                    }
                }
            }
        };

        
        window.myRadar = new Chart(document.getElementById('plataforma'), config);

     });
    
}; // Fecha window.onload


// eslint-disable-next-line no-unused-vars
    function toggleSmooth(btn) {
        var value = btn.classList.toggle('btn-on');
        window.myRadar.options.elements.line.tension = value ? 0.4 : 0.000001;
        window.myRadar.update();
    }
/*********************************** GRÁFICO EM PIZZA ***********************************/
/*
$(function () {
    var ctx, data, myPieChart, options;
    Chart.defaults.global.responsive = true;
    ctx = $('#pie-chart').get(0).getContext('2d');
    ctx.canvas.height = 180;
    options = {
        showScale: false,
        scaleShowGridLines: false,
        scaleGridLineColor: "rgba(0,0,0,.05)",
        scaleGridLineWidth: 0,
        scaleShowHorizontalLines: false,
        scaleShowVerticalLines: false,
        bezierCurve: false,
        bezierCurveTension: 0.4,
        pointDot: false,
        pointDotRadius: 0,
        pointDotStrokeWidth: 2,
        pointHitDetectionRadius: 20,
        datasetStroke: true,
        datasetStrokeWidth: 4,
        datasetFill: true,
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
    };
    data = [
        {
            value: 300,
            color: "#FA2A00",
            highlight: "#FA2A00",
            label: "Red"
        }, {
            value: 50,
            color: "#1ABC9C",
            highlight: "#1ABC9C",
            label: "Green"
        }, {
            value: 100,
            color: "#FABE28",
            highlight: "#FABE28",
            label: "Yellow"
        }, {
            value: 40,
            color: "#999",
            highlight: "#999",
            label: "Grey"
        }, {
            value: 120,
            color: "#22A7F0",
            highlight: "#22A7F0",
            label: "Blue"
        }
    ];
    
    var myPieChart = new Chart(ctx).Pie(data, options);
});
*/