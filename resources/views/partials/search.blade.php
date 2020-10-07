<form class="navbar-form navbar-left ml-3 mt-3" action="{{ route('search') }}">
	<div class="input-group">
		<input type="text" name="qr" class="form-control" placeholder="Search" value="{{ request()->input('qr') }}" required>
		<div class="input-group-btn">
			<button class="btn btn-primary" type="submit">
				<i class="fa fa-search fa-lg" aria-hidden="true">{{-- Search --}}</i>
			</button>
		</div>
	</div>
</form>