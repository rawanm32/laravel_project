@extends('layouts.dashboard')

@section('title', 'الطلبات')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>الطلبات</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{__('Orders')}}</h3>
            </div>
            
            <!-- Filters -->
            <div class="card-body">
                <form method="GET" action="{{ route('orders.index') }}" class="mb-3">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" name="search" class="form-control" placeholder="{{__('Sersch')}}" value="{{ request('search') }}">
                        </div>
                        <div class="col-md-3">
                            <select name="status" class="form-control">
                                <option value="">جميع الحالات</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                                <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>قيد المعالجة</option>
                                <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>تم الشحن</option>
                                <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>تم التسليم</option>
                                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>ملغي</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="payment_status" class="form-control">
                                <option value="">جميع حالات الدفع</option>
                                <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                                <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>مدفوع</option>
                                <option value="failed" {{ request('payment_status') == 'failed' ? 'selected' : '' }}>فشل</option>
                                <option value="refunded" {{ request('payment_status') == 'refunded' ? 'selected' : '' }}>مسترد</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary">بحث</button>
                            <a href="{{ route('orders.index') }}" class="btn btn-secondary">إعادة تعيين</a>
                        </div>
                    </div>
                </form>

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>رقم الطلب</th>
                            <th>العميل</th>
                            <th>المبلغ</th>
                            <th>الحالة</th>
                            <th>حالة الدفع</th>
                            <th>التاريخ</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <a href="{{ route('orders.show', $order->id) }}" class="font-weight-bold">
                                        {{ $order->order_number }}
                                    </a>
                                </td>
                                <td>
                                    {{ $order->full_name }}<br>
                                    <small class="text-muted">{{ $order->email }}</small>
                                </td>
                                <td>${{ number_format($order->total, 2) }}</td>
                                <td>
                                    <span class="badge badge-{{ $order->status == 'delivered' ? 'success' : ($order->status == 'cancelled' ? 'danger' : 'warning') }}">
                                        {{ $order->status_label }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-{{ $order->payment_status == 'paid' ? 'success' : ($order->payment_status == 'failed' ? 'danger' : 'warning') }}">
                                        {{ $order->payment_status_label }}
                                    </span>
                                </td>
                                <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد؟')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">لا توجد طلبات</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection