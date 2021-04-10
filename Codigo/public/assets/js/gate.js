const handleEntranceFormSubmit = (event) => {
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
        time = categoryId == 1 ? 60 : 120
    const model = document.querySelector('#input-model').value
    const cpf = document.querySelector('#input-cpf').value
    const color = document.querySelector('#input-color').value
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
        .then((res) => {
            if (res.status !== 200) {} else {
                document.getElementById('entrance-form').reset();
            }
        })
        .catch((err) => {
            console.log(err)
        })
}

const url = '/api/vehicles/inside';

// Capturar e renderizar veículos de visistantes cadastrados
async function renderVehicles() {

    fetch(url)
        .then(response => response.json()) // retorna uma promise
        .then(result => {

            let html = '';
            let htmlSm = '';
            result.data.forEach(vehicle => {

                let created_at = new Date(vehicle.created_at);
                let created_at_formatada = ((created_at.getDate().toString().padStart(2, "0"))) + "/" + ((created_at.getMonth() + 1).toString().padStart(2, "0")) + "/" + created_at.getFullYear() + " " + (created_at.getHours().toString().padStart(2, "0")) + ":" + (created_at.getMinutes().toString().padStart(2, "0"));

                let left_at = new Date(vehicle.left_at);
                let left_at_formatada = ((left_at.getDate().toString().padStart(2, "0"))) + "/" + ((left_at.getMonth() + 1).toString().padStart(2, "0")) + "/" + left_at.getFullYear() + " " + (left_at.getHours().toString().padStart(2, "0")) + ":" + (left_at.getMinutes().toString().padStart(2, "0"));

                let gate = vehicle.gate.description;

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

        })
        .catch(err => {
            console.error('Failed retrieving information', err);
        });


}

renderVehicles();