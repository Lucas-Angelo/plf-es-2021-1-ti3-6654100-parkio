<div class="container-fluid {{ ($colormode == 'light')? 'parkio-header-light': 'parkio-header-dark'}}">
    <div class="row parkio-breadcrumb">
        <div class="col-4">
            <a href="/" id="backButton" class="p-2 mt-2 d-block mt-md-1 text-decoration-none">
                <i class="fas fa-angle-left"></i>
                <span class="d-none d-md-inline-block">
                    @yield('pagename')
                </span>
            </a>
        </div>
        <div class="col-4">
            <img src="{{ ($colormode == 'dark') ? url("/assets/img/parkiowhite.png"): url("/assets/img/parkio.png") }}" alt="ParkIO Logo" width="170px" class="m-auto d-block">
        </div>
        <div class="col-4">
            <span class="float-end p-2 d-block">
                <div class="dropdown">
                    <button class="btn dropdown-toggle btnDropMenuParkIO" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                        <i class="far fa-user-circle text-muted d-none d-md-inline-block"></i>
                        <span class="d-none d-md-inline-block" id="userName"></span>
                        <i class="d-block d-md-none fas fa-bars text-muted"></i>
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