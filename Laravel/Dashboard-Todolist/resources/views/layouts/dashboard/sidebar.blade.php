<nav id="sidebar">
    <div class="sidebar-header">
        <h3><img src="/img/logo.png" class="img-fluid" /><span class="ms-2">My Todolist</span></h3>
    </div>
    
    <ul class="list-unstyled components">
        <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="/dashboard">
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="{{ Request::is('todolists') ? 'active' : '' }}">
            <a href="/todolists">
                <i class="bi bi-list-task"></i>
                <span>To-do List</span>
            </a>
        </li>

        <li class="{{ Request::is('categories') ? 'active' : '' }}">
            <a href="/categories">
                <i class="bi bi-tag"></i>
                <span>Category</span>
            </a>
        </li>

        <li class="{{ Request::is('todolist/status/finished') ? 'active' : '' }}">
            <a href="/todolist/status/finished">
                <i class="bi bi-bookmark-check"></i>
                <span>Task Finished</span>
            </a>
        </li>

        <li class="{{ Request::is('/to-do-list') ? 'active' : '' }}">
            <a href="/todolist/status/unfinished">
                <i class="bi bi-bookmark-x"></i>
                <span>Task Unfinished</span>
            </a>
        </li>

        <li class="{{ Request::is('/to-do-list') ? 'active' : '' }}">
            <a href="/to-do-list">
                <i class="bi bi-person-circle"></i>
                <span>My Profile</span>
            </a>
        </li>
    </ul>
</nav>
