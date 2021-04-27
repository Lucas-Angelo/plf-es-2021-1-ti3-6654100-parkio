
const updateComplainTable = () =>{
console.log('fez a req')
    $.ajax({
        url: "/api/complain",
        type: "GET",
        success: function(jsonRes){
            const result = jsonRes.data;
            console.log(result)
            let html = '';
            let htmlSm = '';
            result.forEach(complain => {

                var htmlSegment, htmlSegmentSm;

                let created_at = new Date(complain.created_at);
                let created_at_formatada = ((created_at.getDate().toString().padStart(2, "0"))) + "/" + ((created_at.getMonth() + 1).toString().padStart(2, "0")) + "/" + created_at.getFullYear() + " " + (created_at.getHours().toString().padStart(2, "0")) + ":" + (created_at.getMinutes().toString().padStart(2, "0"));


                htmlSegment =   `<tr>
                                    <td>${complain.vehicle.plate}</th>
                                    <td>${complain.user.name}</td>
                                    <td>${created_at_formatada}</td>
                                    <td>${complain.description}</td>
                                </tr>`;

                htmlSegmentSm =   `<div class="componente mb-2">
                                        <div>
                                            <h6>Veículo:</h6>
                                            <p>${complain.vehicle.plate}</p>
                                        </div>
                                        <div>
                                            <h6>Delator:</h6>
                                            <p>${complain.user.name}</p>
                                        </div>
                                        <div>
                                            <h6>Data:</h6>
                                            <p>${created_at_formatada} min</p>
                                        </div>
                                        <div>
                                            <h6>Denúncia:</h6>
                                            <p>${complain.description} min</p>
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