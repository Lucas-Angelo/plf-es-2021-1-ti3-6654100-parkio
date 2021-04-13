const handleSubmit = (event) =>{
    event.preventDefault();
    
    const user = document.querySelector('#input-user').value;
    const pass = document.querySelector('#input-pass').value;

    const data = {
        user,
        pass
    }
    console.log(data)
    fetch(`/api/users`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then((res)=>{
        if (res.status !== 200){
        }
        else{
            document.getElementById('form').reset();
        }
    })
    .catch((err)=>{
        console.log(err)
    })
}