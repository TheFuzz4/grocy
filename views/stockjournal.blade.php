@extends('layout.default')

@section('title', $L('Stock journal'))
@section('activeNav', 'stockjournal')
@section('viewJsName', 'stockjournal')

@section('content')
<div class="row">
	<div class="col">
		<h1>@yield('title')</h1>
	</div>
</div>

<div class="row my-3">
	<div class="col-xs-12 col-md-6 col-xl-3">
		<label for="search">{{ $L('Search') }}</label> <i class="fas fa-search"></i>
		<input type="text" class="form-control" id="search">
	</div>
	<div class="col-xs-12 col-md-6 col-xl-3">
		<label for="product-filter">{{ $L('Filter by product') }}</label> <i class="fas fa-filter"></i>
		<select class="form-control" id="product-filter">
			<option value="all">{{ $L('All') }}</option>
			@foreach($products as $product)
				<option value="{{ $product->id }}">{{ $product->name }}</option>
			@endforeach
		</select>
	</div>
</div>

<div class="row">
	<div class="col">
		<table id="stock-journal-table" class="table table-sm table-striped dt-responsive">
			<thead>
				<tr>
					<th class="border-right"></th>
					<th>{{ $L('Product') }}</th>
					<th>{{ $L('Amount') }}</th>
					<th>{{ $L('Booking time') }}</th>
					<th>{{ $L('Booking type') }}</th>
				</tr>
			</thead>
			<tbody class="d-none">
				@foreach($stockLog as $stockLogEntry)
				<tr class="@if($stockLogEntry->undone == 1) text-muted @endif">
					<td class="fit-content border-right">
						<a class="btn btn-secondary btn-sm undo-stock-booking-button @if($stockLogEntry->undone == 1) disabled @endif" href="#" data-booking-id="{{ $stockLogEntry->id }}" data-toggle="tooltip" data-placement="left" title="{{ $L('Undo booking') }}">
							<i class="fas fa-undo"></i>
						</a>
					</td>
					<td>
						<span class="name-anchor @if($stockLogEntry->undone == 1) text-strike-through @endif">{{ FindObjectInArrayByPropertyValue($products, 'id', $stockLogEntry->product_id)->name }}</span>
						@if($stockLogEntry->undone == 1)
						<br>
						{{ $L('Undone on') . ' ' . $stockLogEntry->undone_timestamp }}
						<time class="timeago timeago-contextual" datetime="{{ $stockLogEntry->undone_timestamp }}"></time>
						@endif
					</td>
					<td>
						{{ $stockLogEntry->amount }} {{ Pluralize($stockLogEntry->amount, FindObjectInArrayByPropertyValue($quantityunits, 'id', FindObjectInArrayByPropertyValue($products, 'id', $stockLogEntry->product_id)->qu_id_stock)->name, FindObjectInArrayByPropertyValue($quantityunits, 'id', FindObjectInArrayByPropertyValue($products, 'id', $stockLogEntry->product_id)->qu_id_stock)->name_plural) }}
					</td>
					<td>
						{{ $stockLogEntry->row_created_timestamp }}
						<time class="timeago timeago-contextual" datetime="{{ $stockLogEntry->row_created_timestamp }}"></time>
					</td>
					<td>
						{{ $L($stockLogEntry->transaction_type) }}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@stop
