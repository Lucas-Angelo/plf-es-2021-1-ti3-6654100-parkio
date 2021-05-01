
const updateComplainTable = () =>{
    $.ajax({
        url: "/api/complain",
        type: "GET",
        success: function(jsonRes){
            const result = jsonRes.data;
            let html = '';
            let htmlSm = '';
            result.forEach(complain => {

                var htmlSegment, htmlSegmentSm;

                htmlSegment =   `<tr>
                                    <td>${complain.plate}</th>
                                    <td>${complain.description}</td>
                                    <td class="acoes">
                                        <button class="btn btn-danger" disabled><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>`;

                htmlSegmentSm =   `<div class="componente mb-2">
                                        <button class="btn btn-danger" disabled><i class="fas fa-trash-alt"></i></button>
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
        error: function(err, status){
            console.error('Failed retrieving information', err);
        },
    });
}

window.addEventListener("load", updateComplainTable)