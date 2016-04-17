<nav>

	@if ($URL == '/')
	    Home
	@else
	    <a href="/">Home</a>
	@endif

|

	@if ($URL == 'clients')
	    Clients
	@else
	    <a href="clients">Clients</a>
	@endif

|

	@if ($URL == 'contact')
	    Contact
	@else
	    <a href="contact">Contact</a>
	@endif

</nav>
