const handleSubmit = (event) =>{
    event.preventDefault();
    
    const user = document.querySelector('#input-user').value;
    const pass = document.querySelector('#input-pass').value;

    const data = {
        user,
        pass
    }
    $.ajax({
        url: "/api/auth",
        type: "POST",
        data: {
            login: user,
            password: pass
        },
        success: function(data, status){
            document.cookie = "X-token=" + data.token;
            location.href = "./"
            return false
        },
        error: function(data, status){
            alert("Erro ao cadastrar");
            return false
        },
    });

}