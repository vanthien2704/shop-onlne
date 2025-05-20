@include('admin.headeradmin')

<h2 class="heading_admin">Thông tin ứng tuyển {{$editsupplier->id}}</h2>

<div class="container">
    <p>Họ tên: {{$editsupplier->name}}</p>
    <p>Số điện thoại: {{$editsupplier->phone}}</p>
    <p>Email: {{$editsupplier->email}}</p>
    <p>Ngày ứng tuyển: {{$editsupplier->date}}</p>
    <p>Trạng thái: {{ $editsupplier->status == 1 ? 'Đã duyệt' : 'Chờ duyệt' }}</p>
    <p>Nội dung: {{$editsupplier->content}}</p>
    <a href="{{ url()->previous() }}" class="btn btn-primary">Trở lại</a>
    @if ($editsupplier->status == 0)
        <a href="{{ url('/admin/supplier/addsupplier', $editsupplier->id) }}" class="btn btn-success">Duyệt</a>
    @endif
</div>