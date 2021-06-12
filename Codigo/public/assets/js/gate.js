let colors = [];
var defaultTime = 30;
let currentPlate = ''
let currentId = null

function TestaCPF(strCPF) {
    var Soma;
    var Resto;
    Soma = 0;
    if (
        strCPF.length != 11 ||
        strCPF == "00000000000" ||
        strCPF == "11111111111" ||
        strCPF == "22222222222" ||
        strCPF == "33333333333" ||
        strCPF == "44444444444" ||
        strCPF == "55555555555" ||
        strCPF == "66666666666" ||
        strCPF == "77777777777" ||
        strCPF == "88888888888" ||
        strCPF == "99999999999"
    )
        return false;

    for (i = 1; i <= 9; i++) Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (11 - i);
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11)) Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10))) return false;

    Soma = 0;
    for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11)) Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11))) return false;
    return true;
}

const setTime = (time) => {
    document.querySelector('#input-time').value = time;
}

const handleSelectChange = (event) => {
    const time = event.target.value.split('|')[1];
    setTime(time);
}

window.addEventListener("load", function() {
            $('#input-cpf').mask('000.000.000-00');

            $.ajax({
                        url: "/api/visitorCategory",
                        type: "GET",
                        success: function(jsonRes) {
                                if (jsonRes) {
                                    const HTMLOptions = `
                        ${
                            jsonRes.map(category=>{
                                return(
                                    `<option value="${category.id}|${category.time}">${category.description}</option>`
                                )
                            })
                        }
                    `
                    document.querySelector('#input-type').innerHTML = HTMLOptions;
                    setTime(jsonRes[0].time);
                    defaultTime = jsonRes[0].time;
            }
        },
        error: function(err, status){
            console.log(err)
        },
    });

    $(".select2").select2({
        width: '100%',
        selectionCssClass: "gate-select2",
        ajax: {
            url: "/api/destinations",
            data: function (params) {
                var query = {
                    search: params.term,
                };
                // Query parameters will be ?search=[term]&type=public
                return query;
            },
            processResults: function (res) {
                let destiniesArray = [];
                res.data.forEach((item, index) => {
                    destiniesArray.push({
                        id: item.id,
                        text: item.block + " " + item.apartament,
                    });
                });
                // Transforms the top-level key of the response object from 'items' to 'results'
                return {
                    results: destiniesArray,
                };
            },
        },
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
        $('.gate-inputcolor').select2({
            width: '100%',
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

    
});

const handlePlateChange = async (event) =>{
    let plate = $("#input-plate").val()
    if(plate.length >= 6) {
        let v = await searchWithNoReturn(plate)
        if(v.complaints && v.complaints.length > 0) {
            let complaints = ''
            v.complaints.forEach(function (comp) {
                complaints += `<small>-${comp.description}</small><br><small class='text-muted float-end'>${(new Date(comp.created_at)).toLocaleString('pt-br')}</small><br>`
            })
            Swal.fire({
                title: 'Aviso',
                html: `Esse veículo possuí ${v.complaints.length > 1 ? 'reclamações anteriores' : 'uma reclamação anterior'} :<br><br>
                        ${complaints}
                        <br>Deseja continuar ?`,
                icon: 'warning',
                confirmButtonText: 'OK'
            })
        }
    }
}


const handleExitFormSubmit = async (event) => {
    event.preventDefault();

    var vehicle = await search($("#input-plate-exit").val());

    plate = vehicle.plate;

    $(".span-plate-out").html(vehicle.plate);
    $(".span-plate-report").html(vehicle.plate);
    $("#vehicleId").val(vehicle.id);
    $("#vehiclePlate").val(vehicle.plate);

    const modal = new bootstrap.Modal(document.getElementById('modalSaidaVeiculo'));
    modal.toggle();
};

const handleComplainModal = (event) => {
    event.preventDefault();

    const plate = $(".span-plate-report").html();
    const vehicleId =  $("#vehicleId").val();
    const description = $("#report-description").val();
    const gateId = location.pathname.split('/')[2]; //Gate ID

    const data = {
        gateId,
        plate,
        vehicleId,
        description
    }

        $.ajax({
            url: "/api/complain",
            type: "POST",
            data: data,
            success:  function(result, status){
                showToast(result.message);

                var myModal = $("#reportModal");
                myModal.find("#vehicleId").val("");
                $(".span-plate-report").html("")
                myModal.find("#report-description").val("");
                myModal.modal('hide');
                $("#modalSaidaVeiculo").modal('hide');
                renderVehicles();

            },
            error:  function(err, status){
                showToast(err);
                renderVehicles();

            },

        });

}

async function dynamicExitModal(vehicleId){
    var vehicle = await searchById(vehicleId);
    $(".span-plate-out").html(vehicle.plate);
    $(".span-plate-report").html(vehicle.plate);
    $("#vehicleId").val(vehicle.id);
    $("#vehiclePlate").val(vehicle.plate);

    const modal = new bootstrap.Modal(document.getElementById('modalSaidaVeiculo'));
    modal.toggle();

};

async function dynamicTimeExtenderModal(vehicleId) {
    var vehicle = await searchById(vehicleId);

    $(".span-plate-delay").html(vehicle.plate);
    $("#inputDelayVehicleId").val(vehicle.id);

    const modal = new bootstrap.Modal(document.getElementById('modalTimeExtender'));
    modal.toggle();

}


function searchById(id){

    return new Promise(resolve => {
        $.ajax({
            url: `/api/vehicles/${id}`,
            type: "GET",
            success:  function(result, status){
                    resolve(result);
            },
            error:  function(err, status){
                showToast(err);
            },
        });

    });
};

function search(plate){

    return new Promise((resolve) => {
        $.ajax({
            url: `/api/vehicles/search?plate=${plate}`,
            type: "GET",
            success:  function(result, status){
                resolve(result);
            },
            error:  function(err, status){
                 showToast("Veículo não encontrado");
            },
        });

    });
};

function searchWithNoReturn(plate){

    return new Promise((resolve) => {
        $.ajax({
            url: `/api/vehicles/search?plate=${plate}`,
            type: "GET",
            success:  function(result, status){
                resolve(result);
            },
            error:  function(err, status){
                 
            },
        });

    });
};

const handleExitModal = async (event) => {
    event.preventDefault();

    const plate = $(".span-plate-out").text()
    const score = document.querySelector('input[name="scores"]:checked').value;
    const gateId = location.pathname.split('/')[2]; //Gate ID

    const data = {
        score,
        gateId,
    };

    var vehicle = await search(plate);

    if (vehicle != null) {
        if (vehicle.left_at == null) {
            var id = vehicle.id;
            $.ajax({
                url: `/api/vehicles/${id}`,
                type: "PUT",
                data: data,
                success: function(res, status){
                    if (status !== "success") {
                        document.getElementById("toast-msg").innerHTML =
                            "Não foi possível remover o veículo.";
                        resetExitForm();
                    } else {
                        document.getElementById("toast-msg").innerHTML =
                            "Veículo removido com sucesso!";
                        resetExitForm();
                        renderVehicles();
                    }
                },
                error: function(err, status){
                    if(err.responseJSON.error == "Vehicle can't go out on this gate!")
                        document.getElementById("toast-msg").innerHTML = "O Veículo entrou por outra portaria.";
                    else
                        document.getElementById("toast-msg").innerHTML = "Ocorreu um erro.";
                    resetExitForm();
                    console.log(err);
                },
            });
        } else {
            document.getElementById("toast-msg").innerHTML =
                "Veículo já removido anteriormente.";
            resetExitForm();
        }
    } else {
        document.getElementById("toast-msg").innerHTML =
            "Veículo não encontrado.";
        resetExitForm();
    }

};

const handleTimeExtenderModal = async (event) => {
    event.preventDefault();

    const description = $("#inputDelayDescription").val();
    const vehicleId =  $("#inputDelayVehicleId").val();
    const time = $("#inputDelayTime").val();

    const gateId = location.pathname.split('/')[2]; //Gate ID

    const data = {
        description,
        time,
        vehicleId,
        gateId,
    }

    $.ajax({
        url: "/api/delay",
        type: "POST",
        data: data,
        success:  function(result, status){
            showToast(result.message);

            var myModal = $("#modalTimeExtender");
            myModal.find("#inputDelayTime").val("");
            myModal.find("#inputDelayDescription").val("");
            myModal.modal('hide');
            renderVehicles();

        },
        error:  function(err, status){
            showToast("O veículo já saiu");
            renderVehicles();
        },

    });

}

const handleEntranceFormSubmit = (event) => {
    event.preventDefault();

    const plate = document.querySelector("#input-plate").value;
    const driverName = document.querySelector("#input-name").value;
    const destinationId = document.querySelector("#selDestination").value;
    let categoryId = document.querySelector('#input-type').value.split('|')[0];
    if (categoryId.length === 0) categoryId = 1;
    let time = document.querySelector("#input-time").value;
    if (!time) time = categoryId == 1 ? 60 : 120;
    const model = document.querySelector("#input-model").value;
    const cpf = document.querySelector("#input-cpf").value;
    const color = document.querySelector("#input-color").value;
    const gateId = location.pathname.split('/')[2]; //Gate ID

    const cpfOnlyNumbers = cpf.replaceAll('.', '').replaceAll('-', '')
    if(cpf && !TestaCPF(cpfOnlyNumbers)){
        Swal.fire({
            title: 'Aviso',
            html: `O CPF ${cpf} é inválido<br><br>
                    Corrija-o ou deixe o campo vazio`,
            icon: 'warning',
            confirmButtonText: 'OK'
        })
        return
    }


    const data = {
        plate,
        driverName,
        destinationId: +destinationId,
        categoryId,
        time,
        model,
        cpf,
        color,
        gateId,
    };
    $.ajax({
        url: "/api/vehicles",
        type: "POST",
        data: data,
        success: function(data, status){
            document.getElementById("entrance-form").reset();
            setTime(defaultTime);
            $(".select2").val(null).trigger('change');
            $(".gate-inputcolor").val(null).trigger('change');
            renderVehicles();
            showToast("Entrada de veículo registrada com sucesso!")
            return false
        },
        error: function(data, status){
            if(data.responseJSON.error == "Vehicle already inside")
                alert("Veículo já está registrado dentro do estacionamento! ");
            else
                alert("Erro ao cadastrar");
            return false
        },
    });
};



function resetExitForm() {
    document.getElementById("exit-form").reset();
    document.getElementById("exit-modal").reset();
    document.getElementById("close-modal").click();
    var toastElList = [].slice.call(document.querySelectorAll(".toast"));
    var toastList = toastElList.map(function (toastEl) {
        return new bootstrap.Toast(toastEl);
    });
    toastList.forEach((toast) => toast.show());

}

// Capturar e renderizar veículos de visistantes cadastrados
async function renderVehicles() {
    let gId = location.pathname.split('/')[2]; //Gate ID
    document.querySelector('#table-body').innerHTML = '<tr><td colspan="5" class="text-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Carregando...</span></div></td></tr>'
    $.ajax({
        url: `/api/vehicles?inside=1&gate=${gId}`,
        type: "GET",
        success: function(result){
            let html = '';
            let htmlSm = '';
            if(result.data.length > 0) {
                result.data.forEach((vehicle, index) => {
                    let color = colors.find(function(c){ return c.hex == vehicle.color})
                    if(!color) {
                        color = {
                            hex: vehicle.color,
                            name: vehicle.color,
                        }
                    }
                    let plate = vehicle.plate;
                    let created_at = new Date(vehicle.created_at);
                    let created_at_formatada = ((created_at.getDate().toString().padStart(2, "0"))) + "/" + ((created_at.getMonth() + 1).toString().padStart(2, "0")) + "/" + created_at.getFullYear() + " " + (created_at.getHours().toString().padStart(2, "0")) + ":" + (created_at.getMinutes().toString().padStart(2, "0"));

                    let limit_time = created_at.setMinutes( created_at.getMinutes() + vehicle.time );
                    let time_past =  ( limit_time - Date.now() ) / (1000 * 60);
                    let negative = time_past < 0;
                    let hours = ( ((negative?-1:1) * time_past) / 60) .toFixed( 0 );
                    let minutes = ( ((negative?-1:1) * time_past) % 60) .toFixed( 0 );

                    var htmlSegment, htmlSegmentSm;

                    htmlSegment = `<tr>
                                    <td scope="row">${vehicle.plate}</th>
                                    <td>${vehicle.model ? vehicle.model: '---'}</td>
                                    <td><span class="square" style="background-color: ${color.hex ? color.hex : '---'};"></span> ${color.name ? color.name: '---'}</td>
                                    <td>${created_at_formatada}</td>
                                    <td id="time-vehicle-${index}">
                                    ${negative?'-':'+'}${hours}:${minutes}
                                    </td>
                                    <td id="status-vehicle-${index}">${negative?'<i class="fas fa-exclamation"></i>':''}</td>
                                    <td>
                                    <button class="btn btn-secondary" onclick="dynamicTimeExtenderModal(${vehicle.id})"><i class="fas fa-clock"></i></button>
                                    <button class="btn btn-danger" onclick="dynamicExitModal(${vehicle.id})" ><i class="fas fa-sign-out-alt "></i></button>
                                    </td>
                                </tr>`;

                    htmlSegmentSm = `<div class="componente">
                                  <button class="btn btn-danger" onclick="dynamicExitModal(${vehicle.id})" ><i class="fas fa-sign-out-alt"></i></button>
                                  <button class="btn btn-secondary" onclick="dynamicTimeExtenderModal(${vehicle.id})"><i class="fas fa-clock "></i></button>
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
                                        <span class="square" style="background-color: ${color.hex};"></span>
                                        <p>${color.name}</p>
                                    </div>
                                    <div class="criadoHora">
                                        <h6>Horário de entrada:</h6>
                                        <p>${created_at_formatada}</p>
                                    </div>
                                    <span id='status-vehicle-mobile-${index}'>
                                        ${negative?'<i class="fas fa-exclamation"></i>':''}
                                    </span>
                                    <span id="time-vehicle-mobile-${index}">
                                    Tempo: ${negative?'-':'+'}${hours}:${minutes}
                                    </span>
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

                let container;

                container = document.querySelector('#table-body');
                container.innerHTML = html;

                container = document.querySelector('#lista-veiculo');
                container.innerHTML = htmlSm;
            } else {
                document.querySelector('#table-body').innerHTML = '<tr><td colspan="5" class="text-center">Nenhum visitante registado </td></tr>'
                document.querySelector('#lista-veiculo').innerHTML = '<div class="componente"> Nenhum visitante registado </div>'
            }



        },
        error: function(err, status){
            console.error('Failed retrieving information', err);
        },
    })
}