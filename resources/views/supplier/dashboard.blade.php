@include('supplier.headersupplier')

<style>
    .col-xl-2-4 {
        flex: auto;
        width: 20%;
    }
    form {
    display: flex;
    align-items: center;
    gap: 10px;
    background-color: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: fit-content;
    margin: 20px auto;
}

label {
    font-weight: bold;
}

input[type="date"] {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
}

button {
    padding: 10px 15px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

    button:hover {
        background-color: #0056b3;
    }
</style>

<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Thống kê </h1>
            </div>
             <form action="{{ url('/supplier/dashboard')}}" method="POST" onsubmit="return validateDates()">
                @csrf
                 <label for="startDate">Từ ngày:</label>
                 <input type="date" id="startDate" name="StartDate" value="{{$StartDate}}" required>
                        
                 <label for="endDate">Đến ngày:</label>
                 <input type="date" id="endDate" name="EndDate" value="{{$EndDate}}" required>
                        
                 <button type="submit">Xác nhận</button>
             </form>
            <!-- Content Row -->
            <div class="row">
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Doanh thu</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        @if (!empty($doanh_thu))
                                            {{ Number::format($doanh_thu) }}đ
                                        @else
                                            Không có dữ liệu
                                        @endif
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Tổng hóa đơn đã bán</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        @if (!empty($sumbill))
                                            {{ Number::format($sumbill) }}
                                        @else
                                            Không có dữ liệu
                                        @endif
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Tổng sản phẩm đã bán</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        @if (!empty($sumproduct))
                                            {{ Number::format($sumproduct) }}
                                        @else
                                            Không có dữ liệu
                                        @endif
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <!-- Content Row -->
            <div class="row">
                <!-- Area Chart -->
                <div class="col-xl-12 col-lg-12">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Biểu đồ doanh thu của năm</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="myAreaChart"
                                    data-data="{{ json_encode([
                                        $revenue->doanh_thu_thang_1,
                                        $revenue->doanh_thu_thang_2,
                                        $revenue->doanh_thu_thang_3,
                                        $revenue->doanh_thu_thang_4,
                                        $revenue->doanh_thu_thang_5,
                                        $revenue->doanh_thu_thang_6,
                                        $revenue->doanh_thu_thang_7,
                                        $revenue->doanh_thu_thang_8,
                                        $revenue->doanh_thu_thang_9,
                                        $revenue->doanh_thu_thang_10,
                                        $revenue->doanh_thu_thang_11,
                                        $revenue->doanh_thu_thang_12,
                                    ]) }}">
                                </canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Page level plugins -->
<script src="{{ asset('assetsadmin/vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('assetsadmin/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('assetsadmin/js/demo/chart-pie-demo.js') }}"></script>
