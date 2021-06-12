const url = '/api/users';

// Cadastrar usuário
const handleEntranceFormSubmit = (event) => {
    event.preventDefault();

    const name = document.querySelector('#input-name').value;
    const login = document.querySelector('#input-user').value;
    const campoPassword = document.querySelector('#input-password');
    const campoConfirmPassword = document.querySelector('#confirm-input-password');
    const type = document.querySelector('#input-type').value

    if(validatePassword(campoPassword, campoConfirmPassword)) {
        const password = campoPassword.value;
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
            success: function (data, status) {
                document.getElementById('cadastro').reset();
                document.getElementById('close-modal').click();
                renderUsers();
                showToast(data.message);
            },
            error: function (data, status) {
                console.log(err)
            },
        });
    } else {
        document.getElementById('input-password').reset();
        document.getElementById('confirm-input-password').reset();
        showToast(data.message);
    }
}

// Capturar e renderizar usuários da API
async function renderUsers() {

    $.ajax({
        url: url,
        type: "GET",
        success: function (result, status) {
            let html = '';
            let htmlSm = '';
            result.data.forEach(user => {

                let type;
                switch (user.type) {
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

                htmlSegment = `<tr>
                                    <td>${user.name}</th>
                                    <td>${user.login}</td>
                                    <td>${type}</td>
                                    <td class="acoes">
                                        <button class="btn btn-secondary changePass" onclick="userUpdate(${user.id},\`${user.login}\`)"><i class="fas fa-lock"></i></button>
                                        <button class="btn btn-danger" onclick="userDelete(${user.id})"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>`;

                htmlSegmentSm = `<div class="usercard mb-2">
                                        <button class="btn btn-danger" onclick="userDelete(${user.id})"><i class="fas fa-trash-alt"></i></button>
                                        <button class="btn btn-secondary changePass" onclick="userUpdate(${user.id},\`${user.login}\`)"><i class="fas fa-lock"></i></button>
                                        <div class="usuario">
                                            <h6>Nome:</h6>
                                            <p>${user.name}</p>
                                        </div>
                                        <div class="tipo">
                                            <h6>Login:</h6>
                                            <p>${user.login}</p>
                                        </div>
                                        <div class="ultima">
                                            <h6>Tipo:</h6>
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
        error: function (err, status) {
            console.error('Failed retrieving information', err);
        },
    });
}

function userDelete(user) {

    var result = confirm("Você deseja excluir este usuário ? Essa ação é irreversível!");

    if (result) {
        $.ajax({
            url: '/api/users/' + user,
            type: 'DELETE',
            success: function (res) {
                showToast(res.message);
                renderUsers();
            },
            error: function (err, status) {
                showToast(err);
            },
        });
    }
}

function userUpdate(userId, login) {
    var myModal = $("#trocarSenha");
    myModal.find("#trocarSenhaLabel").text(`Trocar senha do usuário: ${login}`);
    myModal.find('#idUserPass').val(userId);
    myModal.modal('show');
}

const handleChangePassFormSubmit = (event) => {
    event.preventDefault();

    const id = document.querySelector('#idUserPass').value;
    const campoPassword = document.querySelector('#novaSenha');
    const campoConfirmPassword = document.querySelector('#confirmarNovaSenha');

    if(validatePassword(campoPassword, campoConfirmPassword)) {
        const password = campoPassword.value;
        const data = {
            password
        }

        $.ajax({
            url: `/api/users/${id}`,
            type: "PUT",
            data: data,
            success: function (data, status) {
                document.getElementById('trocaSenha').reset();
                document.getElementById('close-modal-np').click();
                renderUsers();
                showToast("Senha alterada com sucesso!");
            },
            error: function (data, status) {
                console.log(err)
            },
        });
    }
}

function validatePassword(password, confirmPassword) {
    var equal = true;
    if(password.value != confirmPassword.value) {
        Swal.fire({
            title: 'Aviso',
            html: `As senhas inseridas são diferentes!`,
            icon: 'warning',
            confirmButtonText: 'OK'
        })
        equal = false;
    }
    return equal;
}

window.addEventListener("load", function () {
    const btns = document.querySelectorAll(".changePass");
    for (let i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
            document.getElementById('novaSenha').value = "";
            document.getElementById('confirmarNovaSenha').value = "";
        });
    }
});

renderUsers();
