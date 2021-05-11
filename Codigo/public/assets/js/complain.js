const updateComplainTable = () => {
    let filter = '';

    const plate = $('#txtPlateFilter').val();
    $('#table-body').innerHTML = '<tr><td colspan="9" class="text-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Carregando...</span></div></td></tr>';
    $('#lista-veiculo').innerHTML = '';

    if (plate) filter += `?plate=${plate}`;



    $.ajax({
        url: "/api/complain" + filter,
        type: "GET",
        success: function(jsonRes) {
            const result = jsonRes.data;
            let html = '';
            let htmlSm = '';
            result.forEach(complain => {

                var htmlSegment, htmlSegmentSm;

                htmlSegment = `<tr>
                                    <td>${complain.plate}</th>
                                    <td>${complain.description}</td>
                                    <td class="acoes">
                                        <button class="btn btn-danger" onclick="removerComplain(${complain.id})"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>`;

                htmlSegmentSm = `<div class="complainCard mb-2">
                                        <button class="btn btn-danger" onclick="removerComplain(${complain.id})"><i class="fas fa-trash-alt"></i></button>
                                        <div>
                                            <h6>Placa:</h6>
                                            <p>${complain.plate}</p>
                                        </div>
                                        <div>
                                            <h6>Motivo:</h6>
                                            <p>${complain.description}s</p>
                                        </div>
                                    </div>`;


                html += htmlSegment;
                htmlSm += htmlSegmentSm;
            });

            let container;
            container = document.querySelector('#complain-table-body');
            container.innerHTML = html;

            container = document.querySelector('#lista-complain');
            container.innerHTML = htmlSm;
        },
        error: function(err, status) {
            console.error('Failed retrieving information', err);
        },
    });
}


function removerComplain(id) {

    var result = confirm("Você deseja excluir este reporte ? Essa ação é irreversível!");

    if (result) {
        $.ajax({
            url: '/api/complain/' + id,
            type: 'DELETE',
            success: function(res, textStatus, xhr) {

                if (xhr.status == "200") {
                    showToast("Reporte removido com sucesso");
                } else {
                    showToast("Erro ao remover reporte");
                }

                updateComplainTable();
            },
            error: function(err, status) {
                showToast(err);
            },
        });
    }
}




window.addEventListener("load", function() {
    updateComplainTable();
    document.getElementById('btnFilterPlate').addEventListener("click", updateComplainTable);


})