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
        }
    })
    .catch((err)=>{
        console.log(err)
    })
}