<!-- show a flash message -->
@if(Session::has('flash_message'))
    <div class="alert alert-success {{ Session::has('flash_message_important') ? 'alert-important' : '' }}">

        @if( Session::has('flash_message_important') )
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            @endif

                    <!--
                Session helper shorthand helper function

                if( the first item is a string, then we are doing session::get();
                otherwise, if we pass an array then we are setting a session
                -->
            {{ session('flash_message') }}

            <!--
                {{ Session::get('flash_message') }}
                -->
    </div>
@endif