let colors = [];

const setTime = (time) =>{
    document.querySelector('#input-time').value = time;
}

const handleSelectChange = (event) =>{
    const time = event.target.value.split('|')[1];
    setTime(time);
}    

window.addEventListener("load", function () {
    $.ajax({
        url: "/api/visitorCategory",
        type: "GET",
        success: function(jsonRes){
            if (jsonRes){
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
            }
        },
        error: function(err, status){
            console.log(err)
        },
    });
    
    $(".select2").select2({
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


const handleExitFormSubmit = (event) => {
    event.preventDefault();
    document.querySelector("#span-plate").innerHTML = `${document.querySelector("#input-plate-exit").value}`;
    const modal = new bootstrap.Modal(document.getElementById('modalNovoUsuario'));
    modal.toggle();
};

const handleExitModal = (event) => {
    event.preventDefault();
    const plate = document.querySelector("#input-plate-exit").value;
    const score = document.querySelector('input[name="scores"]:checked').value;
    const gateId = location.pathname.split('/')[2]; //Gate ID

    const data = {
        score,
        gateId,
    };

    $.ajax({
        url: `/api/vehicles/search?plate=${plate}`,
        type: "GET",
        data: data,
        success: function(result, status){
            var vehicle = result.items;
            if (vehicle != null) {
                if (vehicle.left_at == null) {
                    var id = vehicle.id;
                    $.ajax({
                        url: `/api/vehicles/${id}`,
                        type: "PUT",
                        data: data,
                        success: function(res, status){
                            console.log(res, status)
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
        },
        error: function(err, status){
            console.log(err);
        },
    });
};

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
            $(".select2").val(null).trigger('change');
            $(".gate-inputcolor").val(null).trigger('change');
            renderVehicles();
            showToast("Entrada de veículo registrada com sucesso!")
            return false
        },
        error: function(data, status){
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
    document.querySelector('#table-body').innerHTML = '<tr><td colspan="5" class="text-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></td></tr>'
    $.ajax({
        url: `/api/vehicles?inside=1&gate=${gId}`,
        type: "GET",
        success: function(result){
            let html = '';
            let htmlSm = '';
            if(result.data.length > 0) {
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
    
                    var htmlSegment, htmlSegmentSm;
    
                    htmlSegment = `<tr>
                                    <td scope="row">${vehicle.plate}</th>
                                    <td>${vehicle.model}</td>
                                    <td><span class="square" style="background-color: ${color.hex};"></span> ${color.name}</td>
                                    <td>${created_at_formatada}</td>
                                    <td>
                                    <button disabled class="btn btn-secondary"><i class="fas fa-clock"></i></button>
                                    <button disabled class="btn btn-danger"><i class="fas fa-sign-out-alt "></i></button>
                                    </td>
                                </tr>`;
    
                    htmlSegmentSm = `<div class="componente">
                                  <button disabled class="btn btn-danger"><i class="fas fa-sign-out-alt"></i></button>
                                  <button disabled class="btn btn-secondary"><i class="fas fa-clock "></i></button>
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
                                </div>`;
    
                    html += htmlSegment;
                    htmlSm += htmlSegmentSm;
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