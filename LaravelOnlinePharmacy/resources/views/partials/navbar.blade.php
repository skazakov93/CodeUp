<div class="navbar navbar-inverse navbar-fixed-top colorNav">
    <div class="container">
        <div class="navbar-header">
            <img class="img-responsive" style="float:left"src="/logo.png"/>
            <a href="/home" class="navbar-brand linkNavbar">Fast Medicine</a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only"></span>
                <span class="icon-bar"></span>

                <span class="icon-bar"></span>
                <span class="icon-bar"></span>

            </button>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li ><a class="linkNavbar" href="/drugs">Home</a></li>
                @if($loggedUser->id > 0)
                    <li><a href="/drugs/create">Create Drug</a></li>
                    <li><a href="/alldrugs">Admin Panel</a></li>
                @endif

            </ul>
            <form class="navbar-form navbar-right">
                @if($loggedUser->id > 0)
                    <a class="btn btn-primary" href="/logout">Log Out</a>
                @endif
                @if($loggedUser->id < 1)
                    <a class="btn btn-success" href="/login">Log In</a>
                    <a class="btn btn-primary" href="/register">Sign Up</a>
                @endif
            </form>
        </div>
    </div>
</div>