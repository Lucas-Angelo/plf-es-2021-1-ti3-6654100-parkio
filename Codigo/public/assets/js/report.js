$(function () {
    // Heat Chart
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
    var options = {
        series: [{
            name: 'Sab',
            data: generateData(8, {
                min: 0,
                max: 90
            })
        },
        {
            name: 'Sex',
            data: generateData(8, {
                min: 0,
                max: 90
            })
        },
        {
            name: 'Qui',
            data: generateData(8, {
                min: 0,
                max: 90
            })
        },
        {
            name: 'Qua',
            data: generateData(8, {
                min: 0,
                max: 90
            })
        },
        {
            name: 'Ter',
            data: generateData(8, {
                min: 0,
                max: 90
            })
        },
        {
            name: 'Seg',
            data: generateData(8, {
                min: 0,
                max: 90
            })
        },
        {
            name: 'Dom',
            data: generateData(8, {
                min: 0,
                max: 90
            })
        }
        ],
        chart: {
            height: 350,
            type: 'heatmap',
            background: '#252531',
            locales: [localeopt],
            defaultLocale: "pt-br"
        },
        dataLabels: {
            enabled: false
        },
        colors: ["#662E91"],
        plotOptions: {
            heatmap: {
                reverseNegativeShade: false
            },
        },
        title: {
            text: 'Visitantes por Hora'
        },
        theme: {
            mode: 'dark'
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();

    function generateData(count, yrange) {
        var i = 0;
        var series = [];
        while (i < count) {
            var x = (i + 1).toString();
            var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;
            series.push({
                x: x,
                y: y
            });
            i++;
        }
        return series;
    }

    // Stacked Bar Chart
    var options = {
        series: [{
            name: 'Porteiro 1',
            data: [44, 55, 41, 67, 22, 43]
        }, {
            name: 'Porteiro 2',
            data: [13, 23, 20, 8, 13, 27]
        }, {
            name: 'Porteiro 3',
            data: [11, 17, 15, 15, 21, 14]
        }, {
            name: 'Porteiro 4',
            data: [21, 7, 25, 13, 22, 8]
        }],
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
            background: '#252531',
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
            type: 'datetime',
            categories: ['01/01/2011 GMT', '01/02/2011 GMT', '01/03/2011 GMT', '01/04/2011 GMT',
                '01/05/2011 GMT', '01/06/2011 GMT'
            ],
        },
        legend: {
            position: 'right',
            offsetY: 40
        },
        fill: {
            opacity: 1
        },
        theme: {
            mode: 'dark'
        },
        colors: ["#3E3ACB", "#9F3E12", randomDarkColor(), randomDarkColor()],
    };

    function randomDarkColor() {
        const x = Math.floor(Math.random() * 256);
        const y = 100 + Math.floor(Math.random() * 256);
        const z = 50 + Math.floor(Math.random() * 256);
        const bgColor = "rgb(" + x + "," + y + "," + z + ")";
        return bgColor
    }

    var chart = new ApexCharts(document.querySelector("#chart2"), options);
    chart.render();


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

    renderGates()
    renderUser_in()
});
