/*!
    * Start Bootstrap - SB Admin v7.0.4 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2021 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }   

});


$(document).ready(function () 
{   
    // set interval
    setInterval(function () 
    {
        //console.log("setInterval function running");
        $.ajax({
            type: "POST",
            url: "read_db_data.php", 
            data: {get_data: 1}, // if any you would like to post any data
            dataType: "json",
            success: function (response) 
            {
                var data = response; // response data from your php script
                // When receiving data from a web server, the data is always a string
                var _value1 = JSON.parse(data.value1);
                var _value2 = JSON.parse(data.value2);
                var _reading_time = JSON.parse(data.reading_time); 

                //myLineChart.data.datasets[0].data = _value1;
                //myLineChart.update(); 

                myAreaChart.destroy();
                myAreaChart = new Chart(ctxAreaChart, {
                    type: 'line',
                    data: {    
                      labels: reading_time,
                      datasets: [{
                        label: "Temperature",
                        lineTension: 0.3,
                        backgroundColor: "rgba(2,117,216,0.2)",
                        borderColor: "rgba(2,117,216,1)",
                        pointRadius: 5,
                        pointBackgroundColor: "rgba(2,117,216,1)",
                        pointBorderColor: "rgba(255,255,255,0.8)",
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: "rgba(2,117,216,1)",
                        pointHitRadius: 50,
                        pointBorderWidth: 2,
                        data: _value1,
                      }],
                    },
                    options: {
                      scales: {
                        xAxes: [{
                          time: {
                            unit: 'date'
                          },
                          gridLines: {
                            display: false
                          },
                          ticks: {
                            maxTicksLimit: 7,
                            display: false //this will remove only the label
                          }
                        }],
                        yAxes: [{
                          
                          gridLines: {
                            color: "rgba(0, 0, 0, .125)",
                          }
                        }],
                      },
                      legend: {
                        display: false
                      },
                      animation: {
                        duration: 0, // general animation time
                       }
                    }
                  });

                  myBarChart.destroy();
                  myBarChart = new Chart(ctxBarChart, {
                    type: 'bar',
                    data: {
                      labels: reading_time,
                      datasets: [{
                        label: "Humidity",
                        backgroundColor: "rgba(2,117,216,1)",
                        borderColor: "rgba(2,117,216,1)",
                        data: _value2,
                      }],
                    },
                    options: {
                      animation: {
                        duration: 0, // general animation time
                          },
                  
                      scales: {
                        xAxes: [{
                          time: {
                            unit: 'month'
                          },
                          gridLines: {
                            display: false
                          },
                          ticks: {
                            maxTicksLimit: 6,
                            display: false //this will remove only the label
                          }
                        }],
                        yAxes: [{
                          gridLines: {
                            display: true
                          }
                        }],
                      },
                      legend: {
                        display: false
                      }
                    }
                  });
                  
                  
                //console.log("update");                 
            }
        });
    }, 2000);
    //console.log("1000");
});
