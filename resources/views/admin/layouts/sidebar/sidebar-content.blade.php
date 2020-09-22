<div class="sidebar-wrapper">
    <ul class="nav">
        <li class="nav-item {{ Str::contains(url()->current(), 'dashboard') ? 'active' : ''  }}">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="fa fa-home" aria-hidden="true"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="nav-item {{ Str::contains(url()->current(), 'category') ? 'active' : ''  }}">
            <a class="nav-link" href="{{ route('category.index') }}">
                <i class="fa fa-list" aria-hidden="true"></i>
                <p>Categories</p>
            </a>
        </li>
        <li class="nav-item {{ Str::contains(url()->current(), 'recipe') ? 'active' : ''  }}">
            <a class="nav-link collapsed" href="#componentsExamples" data-toggle="collapse" href="#componentsExamples"
                aria-expanded="{{ Str::contains(url()->current(), 'recipe') ? 'true' : 'false'  }}">
                <i class="material-icons">fastfood</i>
                <p>Recipes
                    <b class="caret"></b>
                </p>
            </a>
            <div class="collapse {{ Str::contains(url()->current(), 'recipe') ? 'show' : ''  }}"
                id="componentsExamples">
                <ul class="nav">
                    <li class="nav-item {{ Str::endsWith(url()->current() , 'recipe') ? 'active' : ''  }}">
                        <a class="nav-link" href="{{ route('recipe.index') }}">
                            <i class="material-icons">fastfood</i>
                            <span class="sidebar-normal"> All Recipes </span>
                        </a>
                    </li>
                    <li class="nav-item {{ Str::contains(url()->current(), 'recipe/create') ? 'active' : ''  }}">
                        <a class="nav-link" href="{{ route('recipe.create') }}">
                            <i class="material-icons">add_circle</i>
                            <span class="sidebar-normal"> Create Recipes </span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item {{ Str::contains(url()->current(), 'user') ? 'active' : ''  }}">
            <a class="nav-link" href="{{ route('user.index') }}">
                <i class="material-icons">face</i>
                <p>Users</p>
            </a>
        </li>
        <li class="nav-item {{ Str::contains(url()->current(), 'news') ? 'active' : ''  }}">
            <a class="nav-link" href="{{ route('news.index') }}">
                <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                <p>News</p>
            </a>

        </li>
        <li class="nav-item {{ Str::contains(url()->current(), 'slider') ? 'active' : ''  }}">
            <a class="nav-link" href="{{ route('slider.index') }}">
                <i class="fa fa-picture-o" aria-hidden="true"></i>
                <p>Slider</p>
            </a>
        </li>
        <li class="nav-item {{ Str::contains(url()->current(), 'settings') ? 'active' : ''  }}">
            <a class="nav-link" href="{{ route('news.index') }}">
                <i class="fa fa-cog" aria-hidden="true"></i>
                <p>Settings</p>
            </a>
        </li>
    </ul>
</div>