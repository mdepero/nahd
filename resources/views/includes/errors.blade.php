
		<div class="container">
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
					@foreach ($errors->all() as $error)
					    <div class="alert alert-danger alert-dismissable">
					    	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					    	{{ $error }}
					    </div>
					@endforeach
					@if (session('message'))
					    <div class="alert alert-info alert-dismissable">
					    	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					        {{ session('message') }}
					    </div>
					@endif
				</div>
			</div>
		</div>