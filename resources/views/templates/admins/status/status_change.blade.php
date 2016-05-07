@if($item->acceptance == 'success')
<span>Đã chấp nhận</span>
@elseif ($item->acceptance == 'pending')
<span>Đang chờ</span>
@else ($item->acceptance == 'failure')
<span>Không được chấp nhận</span>
@endif
<br/><a href="#" class="btn btn-warning btn-edit-company-status">Sửa</a>
<div class="div_edit_company_status hidden">
	<select name="company_status edit-company-status"class="form-control" required="required">
		<option value="success">Đã chấp nhận</option
		>
		<option value="failure">Không được chấp nhận</option
			>
	</select>
	<a href="#" class="btn btn-success save-edit-company-status">Lưu</a>
	<input type="hidden" name="" value="{{$item->id}}" class="status_id">
</div>