<aside id="left-panel">
	@if(Auth::user())
	<!-- User info -->
	<div class="login-info">
		<span> <!-- User image size is adjusted inside CSS, it should stay as is -->

			<a href="javascript:;" id="show-shortcut" data-action="toggleShortcut" >
				<img src="img/avatars/sunny.png" alt="me" class="online" />
				<span>
					{{ Auth::user()->first_name }}
				</span>
				<i class="fa fa-angle-down"></i>
			</a>

        </span>
    </div>
    @endif
    <nav>
        <ul>
            @role('admin')
            <li @if($active_menu =="users" ) class="active" @endif>
                <a href="/users">
                    <i class="fa fa-lg fa-fw fa-users" aria-hidden="true"></i>
                    <span class="menu-item-parent">Users Management</span>
                </a>
            </li>
            <li @if($active_menu =="doctors" ) class="active" @endif >
                <a href="/doctors" >
                    <i class="fa fa-lg fa-fw fa-list" aria-hidden="true"></i>
                    <span class="menu-item-parent">Doctors Management</span>
                </a>
            </li>
            <li @if($active_menu =="bookings" ) class="active" @endif >
                <a href="/bookings" >
                    <i class="fa fa-lg fa-product-hunt" aria-hidden="true"></i>
                    <span class="menu-item-parent">List Bookings</span>
                </a>
            </li>
            @endrole
     
        </ul>
    </nav>

	<span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span>

</aside>