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
    fetch(url, {
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
            document.getElementById('cadastro').reset();
            document.getElementById('close-modal').click()
            location.reload();
        }
    })
    .catch((err)=>{
        console.log(err)
    })
}

// Capturar e renderizar usuários da API
async function renderUsers() {

    const width_resolution = window.screen.width;

    fetch(url)
    .then(response => response.json()) // retorna uma promise
    .then(result => {
        
        let html = '';
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
            let data = new Date(user.updated_at);
            let dataFormatada = ((data.getDate().toString().padStart(2, "0"))) + "/" + ((data.getMonth() + 1).toString().padStart(2, "0")) + "/" + data.getFullYear() + " " + (data.getHours().toString().padStart(2, "0")) + ":" + (data.getMinutes().toString().padStart(2, "0")); 
            
            var htmlSegment;
            if(width_resolution>800) {
                htmlSegment =   `<tr>
                                    <td>${user.name}</th>
                                    <td>${type}</td>
                                    <td>${dataFormatada}</td>
                                    <td class="acoes">
                                        <button class="btn btn-secondary"><i class="fas fa-lock"></i></button>
                                        <button class="btn btn-secondary"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>`;
            } else {
                htmlSegment =   `<div class="componente mb-2">
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
        if(width_resolution>800)
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