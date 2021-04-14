const handleEntranceFormSubmit = (event) => {
    event.preventDefault();

    const plate = document.querySelector("#input-plate").value;
    const driverName = document.querySelector("#input-name").value;
    const destinationId = document.querySelector("#selDestination").value;
    let categoryId = document.querySelector("#input-type").value;
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
            return false
        },
        error: function(data, status){
            alert("Erro ao cadastrar");
            return false
        },
    });
};

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

var tempScore;
window.onload = function () {
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
