<nav>

	<div>
	@if ($URL == '/')
	    Home
	@else
	    <a href="/">Home</a>
	@endif
	</div>

	<div>
	@if ($URL == 'clients')
	    Clients
	@else
	    <a href="clients">Clients</a>
	@endif
	</div>

	<div>
	@if ($URL == 'contact')
	    Contact
	@else
	    <a href="contact">Contact</a>
	@endif
	</div>

</nav>
