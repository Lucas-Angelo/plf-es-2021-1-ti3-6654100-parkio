const handleVisitorCategoryFormSubmit = (event) => {
    event.preventDefault();
    
    var request = 'POST'
    // by default request is POST unless the modal has id of any category
    const id = $("#categoryId").val();
    const description = document.querySelector('#input-description').value
    const time = document.querySelector('#input-time').value

    const data = {
        description,
        time
    }

    if (id != null && id != "") {
        request = 'PUT';
        data.id = id;
    }

    $.ajax({
        url: "/api/visitorCategory",
        type: request,
        data: data,
        success: function(res) {
            document.getElementById('visitorCategory-form').reset();
            updateVisitorCategoryTable();
            ModalVisitors.hide();
            showToast(res.message)
        },
        error: function(err, status) {
            console.log(err)
            showToast(err)
        },
    });
}


function removerCategoria(category) {

    var result = confirm("Você deseja excluir esta categoria ? Essa ação é irreversível!");

    if (result) {
        $.ajax({
            url: '/api/visitorCategory/' + category,
            type: 'DELETE',
            success: function(res) {
                showToast(res.message);
                updateVisitorCategoryTable();
            },
            error: function(err, status) {
                showToast(err);
            },
        });
    }
}


const updateVisitorCategoryTable = () => {

    $.ajax({
        url: "/api/visitorCategory",
        type: "GET",
        success: function(jsonRes) {
            const result = jsonRes;
            let html = '';
            let htmlSm = '';
            result.forEach(category => {

                var htmlSegment, htmlSegmentSm;

                htmlSegment = `<tr>
                                    <td>${category.description}</th>
                                    <td>${category.time} min</td>
                                    <td class="acoes">
                                        <button class="btn btn-secondary" onclick="modalEditCategory(${category.id},\`${category.description}\`,\`${category.time}\`)"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-danger" onclick="removerCategoria(${category.id})"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>`;

                htmlSegmentSm = `<div class="visitorCategoryCard mb-2">
                                        <button class="btn btn-danger" onclick="removerCategoria(${category.id})"><i class="fas fa-trash-alt"></i></button>
                                        <button class="btn btn-secondary" onclick="modalEditCategory(${category.id},\`${category.description}\`,\`${category.time}\`)"><i class="fas fa-edit"></i></button>
                                        <div class="type">
                                            <h6>Tipo:</h6>
                                            <p>${category.description}</p>
                                        </div>
                                        <div class="time">
                                            <h6>Tempo Recomendado:</h6>
                                            <p>${category.time} min</p>
                                        </div>
                                    </div>`;


                html += htmlSegment;
                htmlSm += htmlSegmentSm;
            });

            let container;
            container = document.querySelector('#category-table-body');
            container.innerHTML = html;

            container = document.querySelector('#lista-category');
            container.innerHTML = htmlSm;
        },
        error: function(err, status) {
            console.error('Failed retrieving information', err);
        },
    });
}

function modalEditCategory(id, description, time) {
    var myModal = $("#CreateCategoryModal");
    myModal.find(".modal-title").text("Editar Categoria");
    myModal.find('#categoryId').val(id);
    myModal.find('#input-description').val(description);
    myModal.find('#input-time').val(time);
    myModal.find(".btn").text("Editar");
    myModal.modal('show');
};

$(document).ready(()=>{
    updateVisitorCategoryTable();

    $('#CreateCategoryModal').on('hidden.bs.modal', function(e) {
        $(this).find(".modal-title").text("Cadastro de Categoria de Visitantes");
        $(this).find(".btn").text("Cadastrar");
        $("#categoryId").val("");
        $("#input-description").val("");
        $("#input-time").val("");
    })

})