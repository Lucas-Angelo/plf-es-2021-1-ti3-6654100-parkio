const handleEntranceFormSubmit = (event) =>{
    event.preventDefault();
    
    const plate = document.querySelector('#input-plate').value
    const driverName = document.querySelector('#input-name').value
    const block = document.querySelector('#input-block').value
    const destinationId = document.querySelector('#input-ap').value
    let categoryId = document.querySelector('#input-type').value
    if (categoryId.length === 0)
        categoryId = 1;
    let time = document.querySelector('#input-time').value
    if (!time)
        time = categoryId==1 ? 60 : 120
    const model = document.querySelector('#input-model').value
    const cpf = document.querySelector('#input-cpf').value
    const color = document.querySelector('#input-color').value
    const gateId = 1;

    const data = {
        plate,
        driverName,
        destinationId: + destinationId,
        categoryId,
        time,
        model,
        cpf,
        color,
        gateId
    }
    console.log(data)
    fetch('/api/vehicles/save', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then((res)=>{
        if (res.status !== 200){
        }
        else{
            document.getElementById('entrance-form').reset();
        }
    })
    .catch((err)=>{
        console.log(err)
    })
}

var tempScore;
window.onload = function(){
    document.querySelector("#button-att").addEventListener("click", function(){ 
        document.querySelector("#span-plate").innerHTML = `${document.querySelector("#input-plate-exit").value}`;
    });

    document.getElementById("liveToastBtn").onclick = function() {
        var toastElList = [].slice.call(document.querySelectorAll('.toast'))
        var toastList = toastElList.map(function(toastEl) {
          return new bootstrap.Toast(toastEl)
        });
       toastList.forEach(toast => toast.show());
    };
}

const handleScoreForm = (event) =>{
    event.preventDefault();
    
    var scoreInput = document.querySelector('input[name = scores]:checked').value;
    tempScore = scoreInput;
    if(scoreInput=="G") {
        document.getElementById("label-good").style.color = "lightgreen";
        document.getElementById("label-bad").style.color = "#5c5c68";
    } 
    if(scoreInput=="B") {
        document.getElementById("label-bad").style.color = "#aaaaaa";
        document.getElementById("label-good").style.color = "#78a46e81";
    }
}

const handleExitFormSubmit = (event) =>{
    event.preventDefault();

    const plate = document.querySelector("#input-plate-exit").value;
    if(tempScore==undefined)
        tempScore = "G";
    const score = tempScore;
    const gateId = "1";

    const data = {
        score,
        gateId
    }

    fetch(`/api/vehicles/search?plate=${plate}`) // Buscar id da placa
    .then(response => response.json())
    .then(result => {
        var vehicle = result.items;
        if(vehicle!=null) {
            if(vehicle.left_at==null) {
                var id = vehicle.id;
                fetch(`/api/vehicles/${id}`, { // Atualizar dados do carro com essa placa
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then((res)=>{
                    if (res.status !== 200){
                        document.getElementById('toast-msg').innerHTML = 'Não foi possível remover o veículo.';
                        resetExitForm();
                    }
                    else{
                        document.getElementById('toast-msg').innerHTML = 'Veículo removido com sucesso!';
                        resetExitForm();
                    }
                })
                .catch((err)=>{
                    document.getElementById('toast-msg').innerHTML = 'Ocorreu um erro.';
                    resetExitForm();
                    console.log(err)
                })
            } else {
                document.getElementById('toast-msg').innerHTML = 'Veículo já removido anteriormente.';
                resetExitForm();
            }  
        } else {
            document.getElementById('toast-msg').innerHTML = 'Veículo não encontrado.';
            resetExitForm();
        }
    })
    .catch((err)=>{
        console.log(err);
    })
}

var toastElList = [].slice.call(document.querySelectorAll('.toast'))
var toastList = toastElList.map(function (toastEl) {
    return new bootstrap.Toast(toastEl, option)
})

function resetExitForm() {
    document.getElementById('exit-form').reset();
    document.getElementById('close-modal').click();
    document.getElementById('liveToastBtn').click();
    document.getElementById("label-good").style.color = "lightgreen";
    document.getElementById("label-bad").style.color = "#5c5c68";
    tempScore = "G";
}