<tr class="text-center row-content">
	<td>{{ $stt }}</td>
	<td contenteditable="true" onlick="showEdit(this)" onBlur="saveDataToDatabase(this,'content',{!! $notify->id!!},&quot;{{route('admin.notification.edit',[$notify->id])}} &quot;,'notification')">{!! $notify->content !!}</td>
	<td style="width: 20%">
		<a href="#delete-notification" data-toggle="modal" data-target="#delete-notification" class="btn btn-danger btn-delete-notification-{{$notify->id}}" data-id="{{$notify->id}}">Xóa</a>
	</td>
</tr>