<div class="container-fluid {{ ($colormode == 'light')? 'parkio-header-light': 'parkio-header-dark'}}">
    <div class="row parkio-breadcrumb">
        <div class="col-4">
            <button type="button" class="btn btn-dark d-block d-md-none p-2 m-1">
                <i class="fas fa-bars text-muted"></i>
            </button>

            <a href="/" id="backButton" class="p-2 mt-1 d-none text-decoration-none">
                <i class="fas fa-angle-left"></i>
                @yield('pagename')
            </a>
        </div>
        <div class="col-4">
            <img src="{{ ($colormode == 'dark') ? url("/assets/img/parkiowhite.png"): url("/assets/img/parkio.png") }}" alt="ParkIO Logo" width="170px" class="m-auto d-block">
        </div>
        <div class="col-4">
            <span class="float-end p-2 d-none d-md-block">
                <div class="dropdown">
                    <button class="btn dropdown-toggle btnDropMenuParkIO" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                        <i class="far fa-user-circle text-muted"></i>
                        <span id="userName"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton1" id="dropMenuParkIO">
                        <li>
                            <a class="dropdown-item cursor-pointer">
                                <div class="form-check form-switch p-0">
                                    <input class="form-check-input" {{ ($colormode == 'dark') ? 'checked': '' }} type="checkbox" id="switchColorMode" onchange="changeColorMode(this)">
                                    <label class="form-check-label" for="switchColorMode">Modo Escuro</label>
                                </div>
                            </a>
                        </li>
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

<style>
    #dropMenuParkIOMode {
        pointer-events: none;
    }
</style>