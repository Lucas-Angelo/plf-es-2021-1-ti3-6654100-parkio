<div class="container-fluid">
    <div class="row">
        <div class="col-4">
            <button type="button" class="btn btn-dark d-block d-md-none p-2 m-1">
                <i class="fas fa-bars text-muted"></i>
            </button>

            <a href="/" id="backButton" class="p-2 mt-1 d-none text-decoration-none text-white">
                <i class="fas fa-angle-left"></i>
                @yield('pagename')
            </a>
        </div>
        <div class="col-4">
            <img src="{{ url("/assets/img/parkiowhite.png") }}" alt="ParkIO Logo" width="200px" class="m-auto d-md-block d-none">
            <img src="{{ url("/assets/img/parkiowhite.png") }}" alt="ParkIO Logo" width="130px" class="m-auto d-block d-md-none">
        </div>
        <div class="col-4">
            <span class="float-end p-2 d-none d-md-block">
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="far fa-user-circle text-muted"></i>
                        <span id="userName"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton1">
                        
                        <li id="btnDropLogout">
                            <a class="dropdown-item cursor-pointer">Sair</a>
                        </li>
                    </ul>
                </div>
                
            </span>
        </div>
    </div>
</div>
<script>
    let uinfo = JSON.parse(getCookie('PARKIO_UIF'))
    $("#userName").text(uinfo.n)
    document.getElementById('btnDropLogout').addEventListener('click', logout)
    if(location.pathname != '/')
        $("#backButton").addClass('d-md-inline-block')
</script>