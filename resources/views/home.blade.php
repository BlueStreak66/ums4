@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.dashboard.title')</h3>
    <!-- <div class="row"> -->
		<div class="col">
			<!-- <div class="col-md-4"> -->
			<div class="row-md-4">
				<div class="panel panel-default">
						<div class="panel-heading">@lang('global.dashboard.payment_addr')</div>

						<div class="panel-body">
							<div class="row">
								<div class="col-md-4">
									<h3>1. Paypal Address : </h3>
										<h4 style="padding-left: 15px;"> &#07; z.dj1969@outlook.com </h4>
										<h4 style="padding-left: 15px;"> &#07; nicedevelopers@outlook.com </h4> 
											<h5 style="padding-left: 28px;">(Sub for z.dj1969@outlook.com) </h5>
										<h4 style="padding-left: 15px;"> &#07; a326178298@outlook.com </h4>
										<h4 style="padding-left: 15px;"> &#07; seniordev808@outlook.com </h4> 
											<h5 style="padding-left: 28px;">(Sub for a326178298@outlook.com) </h5>
										<!--<h4 style="padding-left: 15px;"> &#07; webdeveloper0315@outlook.com </h4>-->
								</div>

								<div class="col-md-4">
									<h3>2. Payoneer Address : </h3>
										<h4 style="padding-left: 15px;"> &#07; z.dj1969@outlook.com </h4>
										<h4 style="padding-left: 15px;"> &#07; a326178298@outlook.com </h4>
										<h4 style="padding-left: 15px;"> &#07; webdeveloper0315@outlook.com </h4>
								</div>
									
								<div class="col-md-4">
									<h3>3. Paypal Fee Checking site : </h3>
										<h4 style="padding-left: 15px;"> <a href="https://salecalc.com/paypal?l=cn&r=0&e=4.4&f=0.30&m=0&c=0"> Go to SaleCalc.com </a> </h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-md-6">
				<div class="panel panel-default">
						<div class="panel-heading">@lang('global.dashboard.post')</div>

						<div class="panel-body">
							<div class="row">
								<div class="row-md-10">
									<div class="col-md-10">
										<h3>Welcome to Posts</h3>
									</div>	
								</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-md-2">
				<div class="col">
					@can('payment_create')
					<p>
							<a href="{{ route('admin.posts.create') }}" class="btn btn-success">Add post</a>
					</p>
					@endcan
				</div>
			</div>
		</div>
@endsection
