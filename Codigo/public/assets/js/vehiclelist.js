async function renderUsers() {

    const width_resolution = window.screen.width;

    fetch(url)
    .then(response => response.json()) // retorna uma promise
    .then(result => {
        
        let html = '';
        result.data.forEach(user => {

            let data = new Date(user.updated_at);
            let dataFormatada = ((data.getDate() )) + "/" + ((data.getMonth() + 1)) + "/" + data.getFullYear() + " " + data.getHours() + ":" + data.getMinutes(); 

            var htmlSegment;
            if(width_resolution>1900) {
                htmlSegment =   `<tr>
                                    <td scope="row">AAA-1111</th>
                                    <td>Ford Ka</td>
                                    <td> <span style="backgroud-color: red;"></span> Vermelho</td>
                                    <td>1</td>
                                    <td>Porteiro x</td>
                                    <td>05:45</td>
                                    <td>06:30</td>
                                    <td>
                                        <button lass="btn btn-secondary"><i class="fas fa-edit botoes"></i></button>
                                    </td>
                                </tr>`;
            } else {
                htmlSegment =   `<div class="componente">
                                        <button class="btn btn-secondary"><i class="fas fa-trash-alt"></i></button>
                                        <button class="btn btn-secondary"><i class="fas fa-lock"></i></button>
                                        <div class="usuario">
                                            <h6>Usuário:</h6>
                                            <p>${user.name}</p>
                                        </div>
                                        <div class="tipo">
                                            <h6>Tipo:</h6>
                                            <p>${type}</p>
                                        </div>
                                        <div class="ultima">
                                            <h6>Última vez visto:</h6>
                                            <p>${dataFormatada}</p>
                                        </div>
                                    </div>`;
            }
    
            html += htmlSegment;
        });

        let container;
        if(width_resolution>900)
            container = document.querySelector('#table-body');
        else
            container = document.querySelector('#lista-usuario');
        
        container.innerHTML = html;
        
    })
    .catch(err => {
        console.error('Failed retrieving information', err);
    });


}

renderUsers();