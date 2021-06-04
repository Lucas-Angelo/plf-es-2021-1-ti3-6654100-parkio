var colors = []

window.addEventListener("load", function () {
    document.getElementById('btnFilter').addEventListener("click", (evt) => renderVehicles("normal", evt));
    document.getElementById('advancedBtnFilter').addEventListener("click", (evt) => renderVehicles("advanced", evt));

    renderVehicles();
    renderGates();
    renderUser_in();
});

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
        selectionCssClass: "vehiclelist-select2",
        width: "100%",
        dropdownParent: $('#EditVehicleModal'),
        templateResult: (color) => {
            var $color = $(
                '<span class="w-100"> <span class="square" style="background-color: '+color.id+'"></span> ' + color.text +' </span>'
            );
            return $color;
        },
        data: coloursArray
    });

    $('.gate-inputcolor').select2({
        width: "100%",
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
                container = document.querySelector("#advancedInputGate");
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
            container = document.querySelector("#advancedInputNameUserIn");
            container.innerHTML = html;
        },
        error: function(err){
            console.error('Failed retrieving information', err);
        },
    });
}

function showModal(id, plate, model, color){
    document.querySelector('#EditVehicleModal .modal-title').textContent = `Atualizar Dados do Veículo ${plate}`
    document.querySelector('#EditVehicleModal #input-plate').value = plate
    document.querySelector('#EditVehicleModal #input-model').value = model || ''
    $('#vehiclelist-input-color').val(color);
    $('#vehiclelist-input-color').trigger('change');
    document.querySelector('#EditVehicleModal form').onsubmit = (event) => updateVehicle(event,id)

    new bootstrap.Modal(document.getElementById('EditVehicleModal')).show()
}

function updateVehicle(event, id){
    event.preventDefault();
    const data = {
        plate: document.getElementById('input-plate').value,
        model: document.getElementById('input-model').value,
        color: document.getElementById('vehiclelist-input-color').value
    }

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

    renderGates();
    renderUser_in();

    return false;
}

// Capturar e renderizar veículos de visistantes cadastrados
function renderVehicles(search, evt, page = 1) {
    let filter = '';
    var plate, gate, user_in;
    var model, color, driver;

    if(search=="normal") {
        plate = document.getElementById('txtPlateFilter').value;
        gate = document.getElementById('gate').value;
        user_in = document.getElementById('user_in').value;

        if(plate)
            filter += `&plate=${plate}`
        if(gate!=0)
            filter += `&gate=${gate}`
        if(user_in!=0)
            filter += `&user_in=${user_in}`
    } else {
        plate = document.getElementById('advancedInputPlate').value;
        model = document.getElementById('advancedInputModel').value;
        color = document.getElementById('input-color').value;
        driver = document.getElementById('advancedInputName').value;
        user_in = document.getElementById('advancedInputNameUserIn').value;
        gate = document.getElementById('advancedInputGate').value;
        dateIn = document.getElementById('advancedInputDateIn').value;
        dateOut = document.getElementById('advancedInputDateOut').value;

        if(plate)
            filter += `&plate=${plate}`
        if(model)
            filter += `&model=${model}`
        if(color!=0)
            filter += `&color=${color.replace('#','%23')}`
        if(driver)
            filter += `&driver_name=${driver}`
        if(user_in!=0)
            filter += `&user_in=${user_in}`
        if(gate!=0)
            filter += `&gate=${gate}`
        if(dateIn)
            filter += `&in_time=${dateIn}`
        if(dateOut)
            filter += `&out_time=${dateOut}`
    }

    $.ajax({
        url: '/api/vehicles?page='+page+'&'+filter,
        type: "GET",
        success: function(result){
            let html = '';
            let htmlSm = '';
            result.data.forEach((vehicle, index) => {
                let color = colors.find(function(c){ return c.hex == vehicle.color})
                if(!color) {
                    color = {
                        hex: vehicle.color,
                        name: vehicle.color,
                    }
                }

                let created_at = new Date(vehicle.created_at);

                let left_at_formatada;
                if(vehicle.left_at) {
                    let left_at = new Date(vehicle.left_at);
                    left_at_formatada = ((left_at.getDate().toString().padStart(2, "0"))) + "/" + ((left_at.getMonth() + 1).toString().padStart(2, "0")) + "/" + left_at.getFullYear() + " " + (left_at.getHours().toString().padStart(2, "0")) + ":" + (left_at.getMinutes().toString().padStart(2, "0"));
                } else
                    left_at_formatada = '---'

                let limit_time = created_at.setMinutes( created_at.getMinutes() + vehicle.time );
                let time_past =  ( limit_time - Date.now() ) / (1000 * 60);
                let negative = time_past < 0;
                let hours = ( ((negative?-1:1) * time_past) / 60) .toFixed( 0 );
                let minutes = ( ((negative?-1:1) * time_past) % 60) .toFixed( 0 );

                let gate = vehicle.gate.description;

                var htmlSegment, htmlSegmentSm;


                htmlSegment =   `<tr>
                                    <td scope="row">${vehicle.plate}</th>
                                    <td>${vehicle.model ? vehicle.model: '---'}</td>
                                    <td style="min-width:100px"><span class="color-cube" style="background-color: ${color.hex ? color.hex: null};"></span> ${color.name ? color.name: '---'}</td>
                                    <td>${gate}</td>
                                    <td>${vehicle.user_in.name}</td>
                                    <td>${vehicle.user_out_id?vehicle.user_out.name:'---'}</td>
                                    <td id="time-vehicle-${index}">
                                    ${
                                        vehicle.left_at ? "---"
                                        : `${negative?'-':'+'}${hours}:${minutes}`
                                    }
                                    </td>
                                    <td id="status-vehicle-${index}">${negative?'<i class="fas fa-exclamation"></i>':''}</td>
                                    <td>
                                        <button onClick="showModal(${vehicle.id}, \`${vehicle.plate}\`, \`${vehicle.model?vehicle.model:''}\`, \`${vehicle.color?vehicle.color:''}\`)" class="btn btn-secondary"><i class="fas fa-edit botoes" ></i></button>
                                    </td>
                                </tr>`;

                htmlSegmentSm =   `<div class="card-veiculo">
                                    <button onClick="showModal(${vehicle.id}, \`${vehicle.plate}\`, \`${vehicle.model?vehicle.model:''}\`, \`${vehicle.color?vehicle.color:''}\`)" class="btn btn-secondary float-end"><i class="fas fa-edit botoes"></i></button>
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
                                        <h6>Porteiro Entrada:</h6>
                                        <p>${vehicle.user_in.name}</p>
                                    </div>
                                    <div class="porteiro">
                                        <h6>Porteiro Saída:</h6>
                                        <p>${vehicle.user_out_id?vehicle.user_out.name:'---'}</p>
                                    </div>
                                    <div>
                                        <span id='status-vehicle-mobile-${index}'>
                                            ${negative?'<i class="fas fa-exclamation"></i>':''}
                                        </span>
                                        <span id="time-vehicle-mobile-${index}">
                                        ${
                                            vehicle.left_at ? "Saída às " + left_at_formatada
                                            : `Tempo: ${negative?'-':'+'}${hours}:${minutes}`
                                        }
                                        </span>
                                    </div>
                                </div>`;

                html += htmlSegment;
                htmlSm += htmlSegmentSm;

                
                if (!vehicle.left_at)
                    setInterval(()=>{
                            time_past -= 1;
                            let negative = time_past < 0;
                            let hours = ( (negative?-1:1) * time_past / 60) .toFixed( 0 );
                            let minutes = ( (negative?-1:1) * time_past % 60) .toFixed( 0 );
                            document.getElementById(`time-vehicle-${index}`).innerText = `${negative?'-':'+'}${hours}:${minutes}` ;
                            document.getElementById(`time-vehicle-mobile-${index}`).innerText = `Tempo: ${negative?'-':'+'}${hours}:${minutes}` ;
                            if (negative){
                                document.getElementById(`status-vehicle-${index}`).innerHTML = '<i class="fas fa-exclamation"></i>';
                                document.getElementById(`status-vehicle-mobile-${index}`).innerHTML = '<i class="fas fa-exclamation"></i>';
                            }
                    }, 1000 * 60)
                
            });
            $(".vehiclelist-pagination").html('')
            for(let i=0;i<result.last_page;i++){
                $(".vehiclelist-pagination").append(`<li onclick="renderVehicles(${null}, ${null}, ${i+1})" class="page-item ${(i+1)==page?'active':''}"><a class="page-link" href="#">${i+1}</a></li>`);
            }

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

function openNav() {
    var largura = $(window).width();
    if(largura>800) {
        document.getElementById("mySidenav").style.width = "275px";
        document.getElementById("main").style.marginRight = "275px";
    } else {
        document.getElementById("mySidenav").style.width = "100vw";
    }
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginRight = "0";
}
