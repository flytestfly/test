@if ($errors->any())
	<div class="row">
		<div class="col-md-10">
			<div class="alert alert-danger" style="margin-top: 20px;">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		</div>
	</div>
@endif