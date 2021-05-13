var colors = []

function showModal(id, plate, model, color){
    const colorOptions = colors.reduce((div, colorNow)=>{
        return div.concat(`
            <option ${colorNow.hex===color?'selected':''} value="${colorNow.hex}">
                ${colorNow.name}
            </option>
        `)
    }, `<option ${color.length<0?'selected':''} value="">Escolha uma cor</option>`)
    const modalContainer = `
    <div class="modal fade" id="EditVehicleModal" tabindex="-1" aria-labelledby="EditVehicleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditVehicleModalLabel">Atualizar Dados do Veículo ${plate}</h5>
                    <button id="closeEditVehicleModal" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form onSubmit="updateVehicle(event,${id})" class="row" id="visitorCategory-form">

                        <div class="mb-3 col-12">
                            <label for="input-plate" class="form-label">Placa<span class="required">*</span></label>
                            <input type="text"  value="${plate}" class="form-control" id="input-plate" autocomplete="false">
                        </div>
                        <div class="mb-3 col-12">
                            <label for="input-time" class="form-label">Modelo</label>
                            <input type="text" value="${model?model:''}" min="0" class="form-control" id="input-model">
                        </div>
                        <div class="mb-3 col-12">
                            <label for="vehiclelist-input-color" class="form-label">Cor</label>
                            <select class="form-select d-block" id="vehiclelist-input-color">
                                ${colorOptions}
                            </select>
                        </div>
                        

                        <div class="button-div text-center mt-3">
                            <button class="btn btn-secondary" type="submit">Atualizar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    `
    document.getElementById('modalEdit').innerHTML = modalContainer;
    var myModal = new bootstrap.Modal(document.getElementById('EditVehicleModal'))
    myModal.show()
    
    
}

function updateVehicle(event, id){
    event.preventDefault();
    const data = {
        plate: document.getElementById('input-plate').value,
        model: document.getElementById('input-model').value,
        color: document.getElementById('vehiclelist-input-color').value
    }
    console.log(data)

    $.ajax({
        url: `/api/vehicles/${id}`,
        type: "PUT",
        data: data,
        success:  function(result, status){
            showToast("Veículo atualizado com sucesso!");
            $("#EditVehicleModal").modal('hide');
            renderVehicles();

        },
        error:  function(err, status){
            showToast(err.statusText);
            renderVehicles();

        },

    });

    return false;
}
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
                htmlSegment =   `<tr>
                                    <td scope="row">${vehicle.plate}</th>
                                    <td>${vehicle.model}</td>
                                    <td><span class="color-cube" style="background-color: ${color.hex};"></span> ${color.name}</td>
                                    <td>${gate}</td>
                                    <td>${vehicle.user_in.name}</td>
                                    <td>${vehicle.user_out_id?vehicle.user_out.name:'---'}</td>
                                    <td>${created_at_formatada}</td>
                                    <td>${left_at_formatada}</td>
                                    <td>
                                        <button onClick="showModal(${vehicle.id}, \`${vehicle.plate}\`, \`${vehicle.model?vehicle.model:''}\`, \`${vehicle.color?vehicle.color:''}\`)" class="btn btn-secondary"><i class="fas fa-edit botoes" ></i></button>
                                    </td>
                                </tr>`;

                htmlSegmentSm =   `<div class="card-veiculo">
                                    <button class="btn btn-secondary float-end data-bs-toggle="modal" data-bs-target="#EditVehicleModal""><i class="fas fa-edit botoes"></i></button>
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

window.addEventListener("load", function () {

    document.getElementById('btnFilter').addEventListener("click", renderVehicles);
/*
    function showModal(id, plate, model, color){
        
    }*/
    
    $.getJSON("/assets/json/colors.json", function(json) {
        colors = json;
        let coloursArray = [];
        json.forEach((item, index) => {
            coloursArray.push({
                id: item.hex,
                text: item.name,
            });
        });

        $('#vehiclelist-input-color').select2({
            selectionCssClass: "gate-select2",
            templateResult: (color) => {
                var $color = $(
                    '<span> <span class="square" style="background-color: '+color.id+'"></span> ' + color.text +' </span>'
                );
                return $color;
            },
            data: coloursArray
        });
        renderVehicles();
    });

    renderVehicles();
    renderGates();
    renderUser_in();
});

