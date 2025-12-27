<x-front-layout title="تفاصيل الطلب #{{ $order->order_number }}">
    
    <!-- Breadcrumb -->
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text text-center">
                        <h3>تفاصيل الطلب</h3>
                        <p style="color: rgba(255,255,255,0.9); margin-top: 10px;">
                            رقم الطلب: {{ $order->order_number }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Details Section -->
    <section class="order-details-section" style="padding: 80px 0; background: #f8f9fa;">
        <div class="container">
            <div class="row">
                <!-- Order Info -->
                <div class="col-lg-8">
                    <!-- Order Status -->
                    <div class="order-status-card" style="background: white; padding: 30px; border-radius: 12px; margin-bottom: 30px; box-shadow: 0 5px 20px rgba(0,0,0,0.1);">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h4 style="margin-bottom: 15px;">
                                    <i class="fa fa-info-circle"></i> حالة الطلب
                                </h4>
                                <span class="badge badge-{{ $order->status == 'completed' ? 'success' : ($order->status == 'cancelled' ? 'danger' : 'warning') }}" 
                                      style="font-size: 16px; padding: 10px 20px;">
                                    {{ $order->status_label }}
                                </span>
                            </div>
                            <div class="col-md-6 text-right">
                                <h4 style="margin-bottom: 15px;">
                                    <i class="fa fa-credit-card"></i> حالة الدفع
                                </h4>
                                <span class="badge badge-{{ $order->payment_status == 'paid' ? 'success' : ($order->payment_status == 'failed' ? 'danger' : 'warning') }}" 
                                      style="font-size: 16px; padding: 10px 20px;">
                                    {{ $order->payment_status_label }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="order-items-card" style="background: white; padding: 30px; border-radius: 12px; margin-bottom: 30px; box-shadow: 0 5px 20px rgba(0,0,0,0.1);">
                        <h4 style="margin-bottom: 25px; padding-bottom: 15px; border-bottom: 2px solid #dee2e6;">
                            <i class="fa fa-shopping-bag"></i> المنتجات المطلوبة
                        </h4>
                        
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>المنتج</th>
                                        <th>السعر</th>
                                        <th>الكمية</th>
                                        <th>الإجمالي</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->items as $item)
                                        <tr>
                                            <td>
                                                <strong>{{ $item->product->name }}</strong>
                                            </td>
                                            <td>${{ number_format($item->price, 2) }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td><strong>${{ number_format($item->total, 2) }}</strong></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Shipping Info -->
                    <div class="shipping-info-card" style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.1);">
                        <h4 style="margin-bottom: 25px; padding-bottom: 15px; border-bottom: 2px solid #dee2e6;">
                            <i class="fa fa-map-marker"></i> معلومات الشحن
                        </h4>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>الاسم:</strong> {{ $order->full_name }}</p>
                                <p><strong>البريد:</strong> {{ $order->email }}</p>
                                <p><strong>الهاتف:</strong> {{ $order->phone }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>العنوان:</strong> {{ $order->address }}</p>
                                <p><strong>المدينة:</strong> {{ $order->city }}</p>
                                <p><strong>الدولة:</strong> {{ $order->country }}</p>
                                @if($order->postal_code)
                                    <p><strong>الرمز البريدي:</strong> {{ $order->postal_code }}</p>
                                @endif
                            </div>
                        </div>

                        @if($order->notes)
                            <hr>
                            <p><strong>ملاحظات:</strong></p>
                            <p style="background: #f8f9fa; padding: 15px; border-radius: 8px;">{{ $order->notes }}</p>
                        @endif
                    </div>
                </div>

                <!-- Order Summary Sidebar -->
                <div class="col-lg-4">
                    <div class="order-summary-sidebar" style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); position: sticky; top: 20px;">
                        <h4 style="margin-bottom: 25px; padding-bottom: 15px; border-bottom: 2px solid #dee2e6;">
                            <i class="fa fa-file-invoice"></i> ملخص الطلب
                        </h4>

                        <div class="order-info" style="margin-bottom: 20px;">
                            <p style="color: #666; font-size: 14px; margin-bottom: 5px;">رقم الطلب</p>
                            <p style="font-weight: bold; font-size: 18px; color: #007bff;">{{ $order->order_number }}</p>
                        </div>

                        <div class="order-info" style="margin-bottom: 20px;">
                            <p style="color: #666; font-size: 14px; margin-bottom: 5px;">تاريخ الطلب</p>
                            <p style="font-weight: 600;">{{ $order->created_at->format('d M Y, H:i') }}</p>
                        </div>

                        <hr>

                        <div class="order-totals">
                            <div class="total-row" style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                <span>المجموع الفرعي:</span>
                                <span style="font-weight: 600;">${{ number_format($order->subtotal, 2) }}</span>
                            </div>
                            
                            <div class="total-row" style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                <span>الشحن:</span>
                                <span style="font-weight: 600;">${{ number_format($order->shipping, 2) }}</span>
                            </div>
                            
                            <div class="total-row" style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                <span>الضريبة:</span>
                                <span style="font-weight: 600;">${{ number_format($order->tax, 2) }}</span>
                            </div>
                            
                            <hr style="margin: 15px 0; border-top: 2px solid #dee2e6;">
                            
                            <div class="total-row" style="display: flex; justify-content: space-between; margin-bottom: 20px;">
                                <strong style="font-size: 18px;">الإجمالي:</strong>
                                <strong style="font-size: 22px; color: #007bff;">${{ number_format($order->total, 2) }}</strong>
                            </div>
                        </div>

                        <div class="payment-method" style="background: #f8f9fa; padding: 15px; border-radius: 8px; text-align: center; margin-bottom: 20px;">
                            <p style="margin: 0; color: #666; font-size: 14px;">طريقة الدفع</p>
                            <p style="margin: 5px 0 0 0; font-weight: bold; color: #333;">{{ $order->payment_method_label }}</p>
                        </div>

                        @auth
                            <a href="{{ route('orders.index') }}" class="boxed-btn3" style="width: 100%; text-align: center; display: block; padding: 12px;">
                                <i class="fa fa-list"></i> جميع طلباتي
                            </a>
                        @endauth

                        <a href="{{ route('home') }}" class="boxed-btn3" style="width: 100%; text-align: center; display: block; padding: 12px; margin-top: 10px; background: #6c757d;">
                            <i class="fa fa-home"></i> العودة للرئيسية
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .table th {
            background: #f8f9fa;
            font-weight: 600;
            padding: 15px;
        }
        
        .table td {
            padding: 15px;
            vertical-align: middle;
        }

        .badge {
            border-radius: 20px;
        }

        .boxed-btn3 {
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .boxed-btn3:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
    </style>

</x-front-layout>