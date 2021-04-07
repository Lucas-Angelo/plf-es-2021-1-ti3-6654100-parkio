const handleEntranceFormSubmit = (event) =>{
    event.preventDefault();
    
    const plate = document.querySelector('#input-plate').value
    const driverName = document.querySelector('#input-name').value
    const block = document.querySelector('#input-block').value
    const destinationId = document.querySelector('#input-ap').value
    let categoryId = document.querySelector('#input-type').value
    if (categoryId.length === 0)
        categoryId = 1;
    let time = document.querySelector('#input-time').value
    if (!time)
        time = categoryId==1 ? 60 : 120
    const model = document.querySelector('#input-model').value
    const cpf = document.querySelector('#input-cpf').value
    const color = document.querySelector('#input-color').value
    const gateId = 1;

    const data = {
        plate,
        driverName,
        destinationId: + destinationId,
        categoryId,
        time,
        model,
        cpf,
        color,
        gateId
    }
    fetch('/api/vehicles/save', {
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
            document.getElementById('entrance-form').reset();
        }
    })
    .catch((err)=>{
        console.log(err)
    })
}