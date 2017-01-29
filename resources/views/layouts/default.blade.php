<!DOCTYPE html>
<html class="no-js">

@include('includes.head')

	<body>

@include('includes.nav')

@hasSection('breadcrumbs')
	@include('includes.header')
@endif

@yield('content')

@include('includes.footer')

	</body>
	
</html>