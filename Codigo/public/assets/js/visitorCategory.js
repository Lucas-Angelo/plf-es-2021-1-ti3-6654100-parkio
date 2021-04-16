

const handleVisitorCategoryFormSubmit = (event) =>{
    event.preventDefault();
    
    const description = document.querySelector('#input-description').value
    const time = document.querySelector('#input-time').value

    const data = {
        description,
        time
    }
    fetch('/api/visitorCategory', {
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
            document.getElementById('visitorCategory-form').reset();
            updateVisitorCategoryTable();
            ModalVisitors.hide();
        }
    })
    .catch((err)=>{
        console.log(err)
    })
}

const updateVisitorCategoryTable = () =>{

    fetch('/api/visitorCategory')
    .then(res => res.json())
    .then(jsonRes => {
        const result = jsonRes;
        
        let html = '';
        let htmlSm = '';
        result.forEach(category => {

            var htmlSegment, htmlSegmentSm;

            htmlSegment =   `<tr>
                                <td>${category.description}</th>
                                <td>${category.time} min</td>
                                <td class="acoes">
                                    <button class="btn btn-secondary"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-secondary"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>`;

            htmlSegmentSm =   `<div class="componente mb-2">
                                    <button class="btn btn-secondary"><i class="fas fa-trash-alt"></i></button>
                                    <button class="btn btn-secondary"><i class="fas fa-edit"></i></button>
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
        
        
    })
    .catch(err => {
        console.error('Failed retrieving information', err);
    });
    
}

window.onload = updateVisitorCategoryTable;