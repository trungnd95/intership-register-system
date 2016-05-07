<table id="example1" class="table table-bordered table-striped">
	<thead>
		<tr class="text-center">
			<th width="60px" class="text-center">Chọn</th>
			<th class="text-center">Danh sách công ty</th>
			<th class="text-center">Số lượng tuyển</th>
			<th class="text-center">Vị trí còn</th>
		</tr>
	</thead>
	<tbody>
	@foreach($results as  $company)
		<tr class="text-center">
			<td><label><input type="checkbox" class="company_registered" value="{{ $company->id}}" name="items[]" ></label></td>
			<td><a href="#modal-view-company" data-toggle="modal" data-target="#modal-view-company" name="{{$company->name}}" address="{{$company->address}}" contact="{{$company->contact}}" description="{{$company->description}}">{{ $company->name}} </a></td>
			<td> {{ $company->recruitment_amount}}</td>
			<td>
				<?php  $count = 0; ?>
				@foreach($company->statuses as $status)
				@if($status->acceptance == "success" && $status->choosen == 1)
				<?php $count ++ ;?>
				@endif
				@endforeach
				{{ $company->recruitment_amount - $count}}
			</td>
		</tr>
		@endforeach
	</tbody>
</table>