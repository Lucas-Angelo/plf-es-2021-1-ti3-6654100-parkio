const url = '/api/users';

// Cadastrar usuário
const handleEntranceFormSubmit = (event) =>{
    event.preventDefault();
    
    const name = document.querySelector('#input-name').value
    const login = document.querySelector('#input-user').value
    const password = document.querySelector('#input-password').value
    const type = document.querySelector('#input-type').value
    
    const data = {
        name,
        login,
        password,
        type,
    }
    $.ajax({
        url: url,
        type: "POST",
        data: data,
        success: function(data, status){
            document.getElementById('cadastro').reset();
            document.getElementById('close-modal').click();
            renderUsers();
        },
        error: function(data, status){
            console.log(err)
        },
    });
}

// Capturar e renderizar usuários da API
async function renderUsers() {

    $.ajax({
        url: url,
        type: "GET",
        success: function(result, status){
            let html = '';
            let htmlSm = '';
            result.data.forEach(user => {

                let type;
                switch(user.type) {
                    case 'A':
                        type = 'Admin';
                    break;
                    case 'P':
                        type = 'Porteiro';
                    break;
                    case 'R':
                        type = 'Ronda';
                    break;
                    case 'S':
                        type = 'Síndico';
                    break;
                }

                var htmlSegment, htmlSegmentSm;

                htmlSegment =   `<tr>
                                    <td>${user.name}</th>
                                    <td>${user.login}</td>
                                    <td>${type}</td>
                                    <td class="acoes">
                                        <button class="btn btn-secondary"><i class="fas fa-lock"></i></button>
                                        <button class="btn btn-secondary"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>`;

                htmlSegmentSm =   `<div class="componente mb-2">
                                        <button class="btn btn-secondary"><i class="fas fa-trash-alt"></i></button>
                                        <button class="btn btn-secondary"><i class="fas fa-lock"></i></button>
                                        <div class="usuario">
                                            <h6>Usuário:</h6>
                                            <p>${user.name}</p>
                                        </div>
                                        <div class="tipo">
                                            <h6>Tipo:</h6>
                                            <p>${user.login}</p>
                                        </div>
                                        <div class="ultima">
                                            <h6>Última vez visto:</h6>
                                            <p>${type}</p>
                                        </div>
                                    </div>`;
                
        
                html += htmlSegment;
                htmlSm += htmlSegmentSm;
            });

            let container;

            container = document.querySelector('#table-body');
            container.innerHTML = html;

            container = document.querySelector('#lista-usuario');
            container.innerHTML = htmlSm;
        },
        error: function(err, status){
            console.error('Failed retrieving information', err);
        },
    });
}

renderUsers();