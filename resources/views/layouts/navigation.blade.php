<!-- Navigation -->
@auth
    @include('layouts.nav_helper.user')
@else
    @include('layouts.nav_helper.guest')
@endauth