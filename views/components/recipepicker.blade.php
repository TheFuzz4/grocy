@push('componentScripts')
	<script src="{{ $U('/viewjs/components/recipepicker.js', true) }}?v={{ $version }}"></script>
@endpush

@php if(empty($prefillByName)) { $prefillByName = ''; } @endphp
@php if(empty($prefillById)) { $prefillById = ''; } @endphp
@php if(!isset($isRequired)) { $isRequired = true; } @endphp
@php if(empty($hint)) { $hint = ''; } @endphp

<div class="form-group" data-next-input-selector="{{ $nextInputSelector }}" data-prefill-by-name="{{ $prefillByName }}" data-prefill-by-id="{{ $prefillById }}">
	<label for="recipe_id">{{ $L('Recipe') }}&nbsp;&nbsp;<span id="{{ $hintId }}" class="small text-muted">{{ $hint }}</span></label>
	<select class="form-control recipe-combobox" id="recipe_id" name="recipe_id" @if($isRequired) required @endif>
		<option value=""></option>
		@foreach($recipes as $recipe)
			<option value="{{ $recipe->id }}">{{ $recipe->name }}</option>
		@endforeach
	</select>
	<div class="invalid-feedback">{{ $L('You have to select a recipe') }}</div>
</div>
