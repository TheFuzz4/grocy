@extends('layout.default')

@section('title', $L('Inventory'))
@section('activeNav', 'inventory')
@section('viewJsName', 'inventory')

@section('content')
<div class="row">
	<div class="col-xs-12 col-md-6 col-xl-4 pb-3">
		<h1>@yield('title')</h1>

		<form id="inventory-form" novalidate>

			@include('components.productpicker', array(
				'products' => $products,
				'nextInputSelector' => '#new_amount'
			))

			@include('components.numberpicker', array(
				'id' => 'new_amount',
				'label' => 'New amount',
				'hintId' => 'new_amount_qu_unit',
				'min' => 0,
				'value' => 1,
				'invalidFeedback' => $L('The amount cannot be lower than #1', '0'),
				'additionalAttributes' => 'data-notequal="notequal" not-equal="-1"',
				'additionalHtmlElements' => '<div id="inventory-change-info" class="form-text text-muted small d-none"></div>',
				'additionalHtmlContextHelp' => '<div id="tare-weight-handling-info" class="text-small text-info font-italic d-none">' . $L('Tare weight handling enabled - please weigh the whole container, the amount to be posted will be automatically calculcated') . '</div>'
			))
			
			@include('components.datetimepicker', array(
				'id' => 'best_before_date',
				'label' => 'Best before',
				'hint' => 'This will apply to added products',
				'format' => 'YYYY-MM-DD',
				'initWithNow' => false,
				'limitEndToNow' => false,
				'limitStartToNow' => false,
				'invalidFeedback' => $L('A best before date is required'),
				'nextInputSelector' => '#best_before_date',
				'additionalGroupCssClasses' => 'date-only-datetimepicker',
				'shortcutValue' => '2999-12-31',
				'shortcutLabel' => 'Never expires',
				'earlierThanInfoLimit' => date('Y-m-d'),
				'earlierThanInfoText' => $L('The given date is earlier than today, are you sure?')
			))

			@include('components.locationpicker', array(
				'locations' => $locations,
				'hint' => 'This will apply to added products'
			))

			<button id="save-inventory-button" class="btn btn-success">{{ $L('OK') }}</button>

		</form>
	</div>

	<div class="col-xs-12 col-md-6 col-xl-4">
		@include('components.productcard')
	</div>
</div>
@stop
