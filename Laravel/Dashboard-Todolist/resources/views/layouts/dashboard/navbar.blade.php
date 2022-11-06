<div class="top-navbar">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid" style="flex-wrap:unset;">
            <button type="button" id="sidebarCollapse" class="d-xl-block d-lg-block d-md-mone d-none ">
                <i class="bi bi-list text-white" style="font-size: 20px;"></i>
            </button>

            <a class="navbar-brand pt-1" href="#" style="font-size: 18px">Dashboard</a>

            <button class="d-inline-block d-lg-none more-button" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" id="sidebarCollapse">
                <i class="bi bi-list text-white mt-2" style="font-size: 20px; font-style:normal;"> </i>
            </button>

            <a class="navbar-menu text-white" href="#" style="font-size: 18px">Menu</a>

            <div class="collapse navbar-collapse d-lg-block d-xl-block d-md-block d-sm-block d-block"
                id="navbarSupportedContent">
                <ul class="nav navbar-nav ms-auto">
                    <li class="dropdown nav-item d-block ms-auto">
                        <button class="btn btn-primary nav-link text-white rounded-5" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false" style="font-weight: 400;">
                            @if (auth()->user()->image)
                                <img src="{{ asset('storage/' . $user->image) }}" width="35"
                                    class="img-fluid rounded-circle pe-1" style="margin-top: -3px">
                            @else
                                <img src="/img/anime.jpg" alt="{{ auth()->user()->name }}" width="35"
                                    class="img-fluid rounded-circle pe-1" style="margin-top: -3px">
                            @endif
                            
                            <span class="text-capitalize" style="font-size: 16px;">
                                Hi, {{ auth()->user()->name }}
                            </span>
                            <i class="bi bi-chevron-down mt-2" style="font-size: 13px;"></i>
                        </button>
                        
                        <ul class="dropdown-menu position-absolute rounded-4" style="right: 5px">
                            <li>
                                <a href="#" class="dropdown-item" style="font-size: 15px">
                                    <i class="bi bi-person ms-1" style="font-size: 20px"></i>
                                    Profile
                                </a>
                                
                                <form action="/logout" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item" style="font-size:15px">
                                        <i class="bi bi-box-arrow-right" style="font-size: 16px;"></i>
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
