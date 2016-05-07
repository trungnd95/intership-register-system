<tr class="text-center row-content">
	<td>{{ $stt }}</td>
	<td contenteditable="true" onlick="showEdit(this)" onBlur="saveDataToDatabase(this,'full_name',{!! $schoolyear->id!!},&quot;{{route('admin.shoolyears.edit',[$schoolyear->id])}} &quot;,'schoolyear')">{!! $schoolyear->full_name !!}</td>
	<td contenteditable="true" onlick="showEdit(this)" onBlur="saveDataToDatabase(this,'short_name',{!! $schoolyear->id!!},&quot;{{route('admin.shoolyears.edit',[$schoolyear->id])}} &quot;,'schoolyear')">{!! $schoolyear->short_name!!}</td>
	<td style="width: 20%">
		<a href="#delete-schoolyear" data-toggle="modal" data-target="#delete-schoolyear" class="btn btn-danger btn-delete-schoolyear-{{$schoolyear->id}}" data-id="{{$schoolyear->id}}">Xóa</a>
	</td>
</tr>