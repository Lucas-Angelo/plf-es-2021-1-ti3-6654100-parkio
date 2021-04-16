const handleGateFormSubmit = (event) => {
    event.preventDefault();

    const description = document.querySelector('#gate-description').value

    const data = {
        description
    }
    fetch('/api/gate', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then((res) => {
            if (res.status !== 200) {} else {
                document.getElementById('gate-form').reset();
                updateEntraceTable();
            }
        })
        .catch((err) => {
            console.log(err)
        })
}

const updateEntraceTable = () => {
    fetch('/api/gate', {
            method: 'GET'
        })
        .then(res => res.json())
        .then(jsonRes => {
            const result = jsonRes;

            let html = '';
            let htmlSm = '';
            result.forEach(gate => {

                let created_at = new Date(gate.created_at);
                let created_at_formatada = ((created_at.getDate().toString().padStart(2, "0"))) + "/" + ((created_at.getMonth() + 1).toString().padStart(2, "0")) + "/" + created_at.getFullYear() + " " + (created_at.getHours().toString().padStart(2, "0")) + ":" + (created_at.getMinutes().toString().padStart(2, "0"));

                var htmlSegment, htmlSegmentSm;

                htmlSegment = `<tr>
                                <td>${gate.description}</th>
                                <td>${created_at_formatada}</th>
                                <td class="acoes">
                                    <button class="btn btn-secondary" onclick="edit(${gate.id})"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-secondary" onclick="remover(${gate.id})"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>`;

                htmlSegmentSm = `<div class="componente mb-2">
                                    <button class="btn btn-secondary" onclick="remover(${gate.id})"><i class="fas fa-trash-alt"></i></button>
                                    <button class="btn btn-secondary" onclick="edit(${gate.id})"> <i class="fas fa-edit"></i></button>
                                    <div class="type">
                                        <h6>Identificação:</h6>
                                        <p>${gate.description}</p>
                                    </div>

                                    <div class="time">
                                        <h6>Criado em:</h6>
                                        <p>${created_at_formatada}</p>
                                    </div>

                                </div>`;


                html += htmlSegment;
                htmlSm += htmlSegmentSm;
            });

            let container;
            container = document.querySelector('#gate-table-body');
            container.innerHTML = html;

            container = document.querySelector('#lista-gate');
            container.innerHTML = htmlSm;


        })
        .catch(err => {
            console.error('Failed retrieving information', err);
        });

}

function remover(gate) {

    var result = confirm("Você deseja excluir a portaria ? Essa ação é irreversível!");
    if (result) {
        fetch('/api/gate/' + gate, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then((res) => {
                if (res.status !== 200) {} else {
                    updateEntraceTable();
                }
            })
            .catch((err) => {
                console.log(err)
            })
    }
}

 function edit(gate){
        
        console.log("teste");
        fetch('/api/gate/' + gate, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then((res) => {
                if (res.status !== 200) {} else {
                 return res.json();
                }
            }).then((data) =>{
                var myModal = Document.getElementById("CreateGateModal");

                console.log(myModal);
                console.log(data);
                Document.getElementById("gate-description").value(data.description);

                myModal.modal({show:true});
            })
            .catch((err) => {
                console.log(err)
            })
    

        // now get the values from the table
        //var firstName = $(this).closest('tr').find('td.firstName').html();
        //var lastName = $(this).closest('tr').find('td.lastName').html();
        //console.log(gate.description);
        //console.log(lastName);
        // and set them in the modal:
        //$('.firstName', myModal).val(firstName);
        //$('.lastNameName', myModal).val(lastName);
        // and finally show the modal
        // myModal.modal({ show: true });

        return false;
    };

window.onload = updateEntraceTable;