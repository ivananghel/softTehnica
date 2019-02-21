@extends('layouts.app')
@section('content')

<div id="main" role="main">

	<div id="content" class="container">

		<div class="row">

			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-md-offset-3">
				<div class="well no-padding">
					<form  id="booking-form" class="smart-form client-form" method="post" action="save-booking">
						{{ csrf_field() }}
						<header>
							{{trans('lang.title_form')}}
						</header>
						<div id="result"></div>
						<fieldset>

							<section >
								<label class="label">{{trans('lang.option_procedure')}}</label>
								<label class="select">
									<select name="type_procedure" id="procedure">
										<option  value="">All</option>	
										@foreach($doctors as $doctor)
										<option value="{{$doctor->id}}">{{$doctor->type_procedure}}</option>	
										@endforeach
									</select><i></i>
								</label>
							</section>

							<section >
								<label class="label">{{trans('lang.option_doctor')}}</label>
								<label class="select">
									<select name="medic_id" id="doctor">
										<option  value="">All</option>
										@foreach($doctors as $doctor)
										<option value="{{$doctor->id}}">{{$doctor->name}}</option>	
										@endforeach
									</select><i></i>
								</label>
							</section>
							<section >
								<label class="label">{{trans('lang.option_date')}}</label>
								<div class="form-group">
									<div class='input-group date'  >
										<input type='text' class="form-control"  id='datetimepicker2' name="booking"/>
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</div>
								</section>
								<hr style="border-top: 2px dotted black;padding-bottom: 15px">
								<section >
									<label class="label">{{trans('lang.option_name')}}</label>
									<label class="input"> <i class="icon-append fa fa-user"></i>
										<input type="text" name="client_name">
										
									</label>
								</section>


								<section >
									<label class="label">{{trans('lang.option_number')}}</label>
									<label class="input"> <i class="icon-append fa fa-mobile-phone"></i>
										<input type="text" name="client_phone">
										
									</label>
								</section>
								<section>
									<label class="label">{{trans('lang.option_email')}}</label>
									<label class="input "> <i class="icon-append fa fa-envelope-o"></i>
										<input type="text" name="client_email">
										
									</label>
								</section>

								<section>
									
									<textarea class="form-control" name="client_comment" placeholder="{{trans('lang.option_textarea')}}" rows="4"></textarea>

								</section>
							</fieldset>
							<footer>
								<button type="submit" class="btn btn-primary">
									{{trans('lang.add_book')}}	
								</button>
							</footer>
						</form>

					</div>


				</div>
			</div>
		</div>

	</div>
	@endsection
	@section('custom_script')

	<script type="text/javascript">

		$('#datetimepicker2').datetimepicker({
			format: 'DD-MM-YYYY HH:mm',
			minDate: new Date(),
		});
	
		$(function () {
			var errorClass = 'invalid';
			var errorElement = 'em';

			$("#booking-form").validate({
				errorClass: errorClass,
				errorElement: errorElement,
				highlight: function (element) {
					$(element).parent().removeClass('state-success').addClass("state-error");
					$(element).removeClass('valid');
				},
				unhighlight: function (element) {
					$(element).parent().removeClass("state-error").addClass('state-success');
					$(element).addClass('valid');
				},

				rules: {
					type_procedure: {
						required: true
					},
					medic_id: {
						required: true
					},
					booking: {
						required: true
					},
					client_name: {
						required: true
					},
					client_phone: {
						required: true,
						number:true
					},
					client_email: {
						required: true,
						email:true
					},
				},
				errorPlacement: function (error, element) {
					error.insertAfter(element.parent());
				},
				submitHandler: function (form) {
					submit_form('#booking-form', '#result')
				}

			});

			$('#procedure').on('change', function() {
				$( "#doctor" ).val($(this).val());
			});

			$('#doctor').on('change', function() {
				$( "#procedure" ).val($(this).val());
			});
		});

	</script>
	@endsection

