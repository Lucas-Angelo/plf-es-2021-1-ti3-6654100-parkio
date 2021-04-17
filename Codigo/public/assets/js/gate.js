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
    const gateId = 1;

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
            renderVehicles();
            return false
        },
        error: function(data, status){
            alert("Erro ao cadastrar");
            return false
        },
    });
};

const setTime = (time) =>{
    document.querySelector('#input-time').value = time;
}

const handleSelectChange = (event) =>{
    const time = event.target.value.split('|')[1];
    setTime(time);
}

window.onload = () =>{
    fetch('/api/visitorCategory', { method: 'GET' })
    .then( res=>{
        if (res.status === 200){
            return res.json();
        }
    })
    .then( jsonRes=>{
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
    })
    .catch((err)=>{
        console.log(err)
    })
}
        

window.addEventListener("load", function () {
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
});

const handleScoreForm = (event) => {
    event.preventDefault();

    var scoreInput = document.querySelector("input[name = scores]:checked")
        .value;
    tempScore = scoreInput;
    if (scoreInput == "G") {
        document.getElementById("label-good").style.color = "lightgreen";
        document.getElementById("label-bad").style.color = "#5c5c68";
    }
    if (scoreInput == "B") {
        document.getElementById("label-bad").style.color = "#aaaaaa";
        document.getElementById("label-good").style.color = "#78a46e81";
    }
};

const handleExitFormSubmit = (event) => {
    event.preventDefault();

    const plate = document.querySelector("#input-plate-exit").value;
    if (tempScore == undefined) tempScore = "G";
    const score = tempScore;
    const gateId = "1";

    const data = {
        score,
        gateId,
    };

    $.ajax({
        url: `/api/vehicles/search?plate=${plate}`,
        type: "GET",
        data: JSON.stringify(data),
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
                            document.getElementById("toast-msg").innerHTML =
                                "Ocorreu um erro.";
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

var toastElList = [].slice.call(document.querySelectorAll(".toast"));
var toastList = toastElList.map(function (toastEl) {
    return new bootstrap.Toast(toastEl, option);
});

function resetExitForm() {
    document.getElementById("exit-form").reset();
    document.getElementById("close-modal").click();
    document.getElementById("liveToastBtn").click();
    document.getElementById("label-good").style.color = "lightgreen";
    document.getElementById("label-bad").style.color = "#5c5c68";
    tempScore = "G";
}

const url = '/api/vehicles/inside';
// Capturar e renderizar veículos de visistantes cadastrados
async function renderVehicles() {
    $.ajax({
        url: `/api/vehicles/inside`,
        type: "GET",
        success: function(result, status){
            let html = '';
            let htmlSm = '';
            result.data.forEach(vehicle => {

                let created_at = new Date(vehicle.created_at);
                let created_at_formatada = ((created_at.getDate().toString().padStart(2, "0"))) + "/" + ((created_at.getMonth() + 1).toString().padStart(2, "0")) + "/" + created_at.getFullYear() + " " + (created_at.getHours().toString().padStart(2, "0")) + ":" + (created_at.getMinutes().toString().padStart(2, "0"));

                var htmlSegment, htmlSegmentSm;

                htmlSegment = `<tr>
                                <td scope="row">${vehicle.plate}</th>
                                <td>${vehicle.model}</td>
                                <td><span style="background-color: ${vehicle.color};"></span> ${vehicle.color}</td>
                                <td>${created_at_formatada}</td>
                                <td>
                                <button class="btn btn-secondary"><i class="fas fa-clock"></i></button>
                                <button class="btn btn-danger"><i class="fas fa-sign-out-alt "></i></button>
                                </td>
                            </tr>`;

                htmlSegmentSm = `<div class="componente">
                              <button class="btn btn-danger"><i class="fas fa-sign-out-alt"></i></button>
                              <button class="btn btn-secondary"><i class="fas fa-clock "></i></button>
                                <div class="placa">
                                    <h6>Placa:</h6>
                                    <p>${vehicle.plate}</p>
                                </div>
                                <div class="modelo">
                                    <h6>Modelo:</h6>
                                    <p>${vehicle.model}</p>
                                </div>
                                <div class="cor">
                                    <h6>Cor:</h6>
                                    <span style="background-color: ${vehicle.color};"></span>
                                    <p>${vehicle.color}</p>
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
        },
        error: function(err, status){
            console.error('Failed retrieving information', err);
        },
    })
}


var tempScore;
window.onload = function () {
    renderVehicles();
    document
        .querySelector("#button-att")
        .addEventListener("click", function () {
            document.querySelector("#span-plate").innerHTML = `${
                document.querySelector("#input-plate-exit").value
            }`;
        });

    document.getElementById("liveToastBtn").onclick = function () {
        var toastElList = [].slice.call(document.querySelectorAll(".toast"));
        var toastList = toastElList.map(function (toastEl) {
            return new bootstrap.Toast(toastEl);
        });
        toastList.forEach((toast) => toast.show());
    };
    
};