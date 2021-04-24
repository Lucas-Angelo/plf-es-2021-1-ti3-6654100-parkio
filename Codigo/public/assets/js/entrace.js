const updateEntraceTable = () => {
    $.ajax({
        url: "/api/gate",
        type: "GET",
        success: function(jsonRes) {
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
                                    <button class="btn btn-secondary" onclick="modalEditGate(${gate.id})"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-secondary" onclick="remover(${gate.id})"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>`;

                htmlSegmentSm = `<div class="componente mb-2">
                                    <button class="btn btn-secondary" onclick="remover(${gate.id})"><i class="fas fa-trash-alt"></i></button>
                                    <button class="btn btn-secondary" onclick="modalEditGate(${gate.id})"> <i class="fas fa-edit"></i></button>
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
        },
        error: function(err, status) {
            console.log(err)
        },
    });
}


const handleGateFormSubmit = (event) => {
    event.preventDefault();

    const id = $("#gateId").val();
    const description = $("#gate-description").val();
    var request = 'POST'
        // by default request is POST unless the modal has id of any gate
    const data = {
        description
    }

    if (id != null && id != "") {
        request = 'PUT';
        data.id = id;
    }

    $.ajax({
        url: "/api/gate",
        type: request,
        data: data,
        success: function(res, status) {

            showToast(res.message);
            $('#gate-form').val("");
            updateEntraceTable();
            var myModal = $("#CreateGateModal");
            myModal.modal('hide');
        },
        error: function(err, status) {
            showToast(err);

        },
    });
}


function remover(gate) {

    var result = confirm("Você deseja excluir esta portaria ? Essa ação é irreversível!");

    if (result) {
        $.ajax({
            url: '/api/gate/' + gate,
            type: 'DELETE',
            success: function(res) {
                showToast(res.message);
                updateEntraceTable();
            },
            error: function(err, status) {
                showToast(err);
            },
        });
    }
}

//call the search API and fill the modal input forms
function modalEditGate(gate) {
    $.ajax({
        url: '/api/gate/' + gate,
        type: 'GET',
        success: function(data) {
            var myModal = $("#CreateGateModal");
            myModal.find(".modal-title").text("Editar Portaria");
            myModal.find('#gateId').val(data.id);
            myModal.find('#gate-description').val(data.description);
            myModal.find(".btn").text("Editar");
            myModal.modal('show');
        },
        error: function(err, status) {
            console.log(err)
        },
    });
};


$(document).ready(function() {

    updateEntraceTable();

    // clean the modal after closed
    $('#CreateGateModal').on('hidden.bs.modal', function(e) {
        $(this).find(".modal-title").text("Cadastrar Portaria");
        $(this).find(".btn").text("Cadastrar");
        $(".form-control").val("");
    })

})