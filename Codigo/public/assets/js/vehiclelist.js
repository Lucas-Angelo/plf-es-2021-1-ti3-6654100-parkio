window.addEventListener("load", function () {
    let colors = []

    document.getElementById('btnFilter').addEventListener("click", renderVehicles);

    // Capturar e renderizar veículos de visistantes cadastrados
    function renderVehicles() {
        let filter = '';

        const plate = document.getElementById('txtPlateFilter').value;
        const gate = document.getElementById('gate').value;
        const user_in = document.getElementById('user_in').value;

        if(plate)
            filter += `&plate=${plate}`
        if(gate!=0)
            filter += `&gate=${gate}`
        if(user_in!=0)
            filter += `&user_in=${user_in}`

        $.ajax({
            url: '/api/vehicles?1=1'+filter,
            type: "GET",
            success: function(result){
                let html = '';
                let htmlSm = '';
                result.data.forEach(vehicle => {
                    let color = colors.find(function(c){ return c.hex == vehicle.color})
                    if(!color) {
                        color = {
                            hex: vehicle.color,
                            name: vehicle.color,
                        }
                    }

                    let created_at = new Date(vehicle.created_at);
                    let created_at_formatada = ((created_at.getDate().toString().padStart(2, "0"))) + "/" + ((created_at.getMonth() + 1).toString().padStart(2, "0")) + "/" + created_at.getFullYear() + " " + (created_at.getHours().toString().padStart(2, "0")) + ":" + (created_at.getMinutes().toString().padStart(2, "0"));

                    let left_at_formatada;
                    if(vehicle.left_at) {
                        let left_at = new Date(vehicle.left_at);
                        left_at_formatada = ((left_at.getDate().toString().padStart(2, "0"))) + "/" + ((left_at.getMonth() + 1).toString().padStart(2, "0")) + "/" + left_at.getFullYear() + " " + (left_at.getHours().toString().padStart(2, "0")) + ":" + (left_at.getMinutes().toString().padStart(2, "0"));
                    } else
                        left_at_formatada = '---'


                    let gate = vehicle.gate.description;

                    var htmlSegment, htmlSegmentSm;
                    console.log(color)

                    htmlSegment =   `<tr>
                                        <td scope="row">${vehicle.plate}</th>
                                        <td>${vehicle.model ? vehicle.model: '---'}</td>
                                        <td style="min-width:100px"><span class="color-cube" style="background-color: ${color.hex ? color.hex: null};"></span> ${color.name ? color.name: '---'}</td>
                                        <td>${gate}</td>
                                        <td>${vehicle.user_in.name}</td>
                                        <td>${vehicle.user_out_id?vehicle.user_out.name:'---'}</td>
                                        <td>${created_at_formatada}</td>
                                        <td>${left_at_formatada}</td>
                                        <td>
                                            <button disabled class="btn btn-secondary"><i class="fas fa-edit botoes"></i></button>
                                        </td>
                                    </tr>`;

                    htmlSegmentSm =   `<div class="card-veiculo">
                                        <button disabled class="btn btn-secondary float-end"><i class="fas fa-edit botoes"></i></button>
                                        <div class="placa">
                                            <h6>Placa:</h6>
                                            <p>${vehicle.plate}</p>
                                        </div>
                                        <div class="modelo">
                                            <h6>Modelo:</h6>
                                            <p>${vehicle.model}</p>
                                        </div>
                                        <div>
                                            <h6>Cor:</h6>
                                            <span class="color-cube" style="background-color: ${color.hex};"></span>
                                            <p>${color.name}</p>
                                        </div>
                                        <div class="portaria">
                                            <h6>Portaria:</h6>
                                            <p>${gate}</p>
                                        </div>
                                        <div class="porteiro">
                                            <h6>Porteiro:</h6>
                                            <p>${vehicle.user_in.name}</p>
                                        </div>
                                        <div class="criadoHora">
                                            <h6>Horário de entrada:</h6>
                                            <p>${created_at_formatada}</p>
                                        </div>
                                        <div class="atualizadoHora">
                                            <h6>Horário de saída:</h6>
                                            <p>${left_at_formatada}</p>
                                        </div>
                                    </div>`;

                    html += htmlSegment;
                    htmlSm += htmlSegmentSm;
                });

                let container;

                container = document.querySelector('#table-body');
                container.innerHTML = html;

                container = document.querySelector('#lista-veiculo');
                container.innerHTML = htmlSm;
            },
            error: function(err){
                console.error('Failed retrieving information', err);
            },
        });
    }

    function renderGates() {
        $.ajax({
            url: '/api/gate',
            type: "GET",
            success: function(result){
                let html = `<option value="0" selected>Selecione</option>`;

                result.forEach(gate => {
                    var htmlSegment;

                    htmlSegment =   `<option value="${gate.id}">${gate.description}</option>`;

                    html += htmlSegment;
                });

                let container;
                container = document.querySelector('#gate');
                container.innerHTML = html;
            },
            error: function(err){
                console.error('Failed retrieving information', err);
            },
        });
    }

    function renderUser_in () {
        $.ajax({
            url: '/api/users/search?type=p',
            type: "GET",
            success: function(result){
                let html = `<option value="0" selected>Selecione</option>`;

                result.data.forEach(user_in => {
                    var htmlSegment;

                    htmlSegment =   `<option value="${user_in.id}">${user_in.name}</option>`;

                    html += htmlSegment;
                });

                let container;
                container = document.querySelector('#user_in');
                container.innerHTML = html;
            },
            error: function(err){
                console.error('Failed retrieving information', err);
            },
        });
    }

    $.getJSON("/assets/json/colors.json", function(json) {
        colors = json;
        renderVehicles();
    });

    renderVehicles();
    renderGates();
    renderUser_in();
});

