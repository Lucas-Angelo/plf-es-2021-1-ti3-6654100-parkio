$(function () {
    const week = ['Dom','Seg','Ter','Qua','Qui','Sex','Sab']
    let chart, chart2;
    $(".reportDatePicker").attr('max',new Date().toISOString().split('T')[0])
    const colorm = getCookie('X-colormode')
    const bgColor = (colorm == 'light') ? '#d9d9d9': '#252531'

    //Set date (today - 7 days)
    let dt = new Date();
    dt.setDate( dt.getDate() - 6 )
    let day = ("0" + dt.getDate()).slice(-2);
    let month = ("0" + (dt.getMonth() + 1)).slice(-2);
    let dtComplete = dt.getFullYear()+"-"+(month)+"-"+(day);
    $("#txtDateBegin").val(dtComplete)


    $("#txtDateBegin").change(function(event) {
        dt = new Date(event.target.value + ' 00:00:00')
        dt.setDate( dt.getDate() + 6 )
        day = ("0" + dt.getDate()).slice(-2);
        month = ("0" + (dt.getMonth() + 1)).slice(-2);
        dtComplete = dt.getFullYear()+"-"+(month)+"-"+(day);
        $("#txtDateEnd").val(dtComplete)
    });

    $("#txtDateEnd").change(function(event) {
        dt = new Date(event.target.value + ' 00:00:00')
        dt.setDate( dt.getDate() - 6 )
        day = ("0" + dt.getDate()).slice(-2);
        month = ("0" + (dt.getMonth() + 1)).slice(-2);
        dtComplete = dt.getFullYear()+"-"+(month)+"-"+(day);
        $("#txtDateBegin").val(dtComplete)
    });

    $("#txtDateBegin").trigger('change')

    $("#btnFilter").click(function(event) {
        loadCharts()
    });

    btnFilter
    
    const localeopt = {
        "name": "pt-br",
        "options": {
            "toolbar": {
                "exportToSVG": "Baixar SVG",
                "exportToPNG": "Baixar PNG",
                "exportToCSV": "Baixar CSV",
                "menu": "Menu",
                "selection": "Selecionar",
                "selectionZoom": "Selecionar Zoom",
                "zoomIn": "Aumentar",
                "zoomOut": "Diminuir",
                "pan": "Navegação",
                "reset": "Reiniciar Zoom"
            }
        }
    }

    function randomDarkColor() {
        const x = Math.floor(Math.random() * 256);
        const y = 100 + Math.floor(Math.random() * 256);
        const z = 50 + Math.floor(Math.random() * 256);
        const bgColor = "rgb(" + x + "," + y + "," + z + ")";
        return bgColor
    }

    function renderGates() {
        $.ajax({
            url: '/api/gate',
            type: "GET",
            success: function (result) {
                let html = `<option value="0" selected>Selecione</option>`;

                result.forEach(gate => {
                    var htmlSegment;

                    htmlSegment = `<option value="${gate.id}">${gate.description}</option>`;

                    html += htmlSegment;
                });

                let container;
                container = document.querySelector('#gate');
                container.innerHTML = html;
            },
            error: function (err) {
                console.error('Failed retrieving information', err);
            },
        });
    }

    function renderUser_in() {
        $.ajax({
            url: '/api/users/search?type=p',
            type: "GET",
            success: function (result) {
                let html = `<option value="0" selected>Selecione</option>`;

                result.data.forEach(user_in => {
                    var htmlSegment;

                    htmlSegment = `<option value="${user_in.id}">${user_in.name}</option>`;

                    html += htmlSegment;
                });

                let container;
                container = document.querySelector('#user_in');
                container.innerHTML = html;
            },
            error: function (err) {
                console.error('Failed retrieving information', err);
            },
        });
    }

    function loadCharts(){
        if(chart && chart2) {
            chart.destroy()
            chart2.destroy()
        }
        const dat = $("#txtDateBegin").val()
        let filter = ''
        if($("#gate").val() != "0")
            filter += '&gate=' + $("#gate").val()
        
        if($("#user_in").val() != "0")
            filter += '&doorMen=' + $("#user_in").val()

        // Heat Chart
        $.ajax({
            url: '/api/reportVehicle?dates=' + dat + filter,
            type: "GET",
            success: function (result) {
                let series = []
                let ndt = new Date(dat + ' 00:00:00')
                let bigVal = 0;
                
                for(let i=0;i<7;i++) {
                    var max = Math.max.apply(Math, result[i]);
                    if(max > bigVal) bigVal = max
                    series[i] = {
                        name: null,
                        data: result[i]
                    }
                    if(ndt.getDay() + i <= 6)
                        series[i].name = week[ndt.getDay() + i]
                    else
                        series[i].name = week[(ndt.getDay() + i) % 7]
                }

                var options = {
                    series: series,
                    chart: {
                        height: 350,
                        type: 'heatmap',
                        background: bgColor,
                        locales: [localeopt],
                        defaultLocale: "pt-br"
                    },
                    dataLabels: {
                        enabled: false
                    },
                    colors: ["#662E91"],
                    plotOptions: {
                        heatmap: {
                            reverseNegativeShade: true,
                            colorScale: {
                                ranges: [{
                                    from: 0,
                                    to: 0,
                                    color: '#e8e8e8',
                                    name: ''
                                  },
                                  {
                                    from: 1,
                                    to: bigVal,
                                    color: '#662E91',
                                    name: ''
                                  }
                                ]
                            }
                        },
                    },
                    grid: {
                        borderColor: '#000',
                    },
                    xaxis: {
                        type: 'text',
                        categories: ['01-03','03-06','06-09','09-12','12-15','15-18','18-21','21-00'],
                    },
                    
                    title: {
                        text: 'Visitantes por Hora'
                    },
                    theme: {
                        mode: colorm == 'light'? 'light' : 'dark'
                    }
                };
            
                chart = new ApexCharts(document.querySelector("#chart"), options);
                chart.render();
            },
            error: function (err) {
                console.error('Failed retrieving information', err);
            },
        });

        // Stacked Bar Chart
        $.ajax({
            url: '/api/reportGateKeeper?dates=' + dat + filter,
            type: "GET",
            success: function (result) {
                let series = [];
                let labels = []
                result.forEach((res, idx) => {
                    if(res) {
                        res.forEach((r) => {
                            if(!series[r.uid]) {
                                series[r.uid] = {
                                    'name': r.name,
                                    'data': [0,0,0,0,0,0,0]
                                }
                            }
                            series[r.uid].data[idx] = r.cnt
                        })
                    }
                })
                series = Object.values(series)
                let ndt = new Date(dat + ' 00:00:00')
                for(let i=0;i<7;i++) {
                    if(ndt.getDay() + i <= 6)
                        labels.push(week[ndt.getDay() + i])
                    else
                        labels.push(week[(ndt.getDay() + i) % 7])
                }
                let colors = ["#3E3ACB", "#9F3E12", '#4f129f', '#005c17'];
                if(series.length > colors.length)
                    colors.push(randomDarkColor())


                var options = {
                    series: series,
                    chart: {
                        type: 'bar',
                        height: 350,
                        stacked: true,
                        toolbar: {
                            show: true
                        },
                        zoom: {
                            enabled: true
                        },
                        background: bgColor,
                        locales: [localeopt],
                        defaultLocale: "pt-br"
                    },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            legend: {
                                position: 'bottom',
                                offsetX: -10,
                                offsetY: 0
                            }
                        }
                    }],
                    plotOptions: {
                        bar: {
                            borderRadius: 8,
                            horizontal: false,
                        },
                    },
                    xaxis: {
                        type: 'text',
                        categories: labels,
                    },
                    legend: {
                        position: 'right',
                        offsetY: 40
                    },
                    fill: {
                        opacity: 1
                    },
                    title: {
                        text: 'Visitantes por porteiro'
                    },
                    theme: {
                        mode: colorm == 'light'? 'light' : 'dark'
                    },
                    colors: colors,
                };

                chart2 = new ApexCharts(document.querySelector("#chart2"), options);
                chart2.render();
                
            },
            error: function (err) {
                console.error('Failed retrieving information', err);
            },
        });
    }

    loadCharts()
    renderGates()
    renderUser_in()
});
