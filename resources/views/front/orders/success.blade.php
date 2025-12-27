<x-front-layout title="تم إنشاء الطلب بنجاح">
    
    <!-- Breadcrumb -->
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text text-center">
                        <h3>تم إنشاء الطلب بنجاح</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Section -->
    <section class="order-success-section" style="padding: 80px 0; background: #f8f9fa;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <!-- Success Message -->
                    <div class="success-card text-center" style="background: white; padding: 50px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); margin-bottom: 30px;">
                        <div class="success-icon" style="margin-bottom: 30px;">
                            <i class="fa fa-check-circle" style="font-size: 80px; color: #28a745;"></i>
                        </div>
                        <h2 style="color: #28a745; margin-bottom: 15px;">تم إنشاء طلبك بنجاح!</h2>
                        <p style="font-size: 18px; color: #666; margin-bottom: 30px;">
                            شكراً لك على طلبك. سنقوم بمعالجته في أقرب وقت ممكن.
                        </p>
                        
                        <div class="order-number" style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 30px;">
                            <p style="margin: 0; color: #666; font-size: 14px;">رقم الطلب</p>
                            <h3 style="margin: 10px 0 0 0; color: #007bff; font-size: 28px; font-weight: bold;">
                                {{ $order->order_number }}
                            </h3>
                        </div>

                        <div class="order-actions" style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
                            <a href="{{ route('front.orders.show', $order->id) }}" class="boxed-btn3" style="padding: 15px 30px;">
                                <i class="fa fa-eye"></i> عرض تفاصيل الطلب
                            </a>
                            <a href="{{ route('home') }}" class="boxed-btn3" style="background: #6c757d; padding: 15px 30px;">
                                <i class="fa fa-home"></i> العودة للرئيسية
                            </a>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="order-summary-card" style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.1);">
                        <h4 style="margin-bottom: 25px; padding-bottom: 15px; border-bottom: 2px solid #dee2e6;">
                            <i class="fa fa-shopping-bag"></i> ملخص الطلب
                        </h4>

                        <!-- Customer Info -->
                        <div class="customer-info" style="margin-bottom: 25px;">
                            <h5 style="font-size: 16px; margin-bottom: 15px; color: #333;">معلومات العميل</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <p style="margin: 5px 0; color: #666;">
                                        <strong>الاسم:</strong> {{ $order->full_name }}
                                    </p>
                                    <p style="margin: 5px 0; color: #666;">
                                        <strong>البريد:</strong> {{ $order->email }}
                                    </p>
                                    <p style="margin: 5px 0; color: #666;">
                                        <strong>الهاتف:</strong> {{ $order->phone }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p style="margin: 5px 0; color: #666;">
                                        <strong>العنوان:</strong> {{ $order->address }}
                                    </p>
                                    <p style="margin: 5px 0; color: #666;">
                                        <strong>المدينة:</strong> {{ $order->city }}
                                    </p>
                                    <p style="margin: 5px 0; color: #666;">
                                        <strong>الدولة:</strong> {{ $order->country }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <!-- Order Items -->
                        <div class="order-items" style="margin-bottom: 25px;">
                            <h5 style="font-size: 16px; margin-bottom: 15px; color: #333;">المنتجات</h5>
                            @foreach($order->items as $item)
                                <div class="order-item" style="display: flex; justify-content: space-between; align-items: center; padding: 15px 0; border-bottom: 1px solid #f0f0f0;">
                                    <div style="flex: 1;">
                                        <strong>{{ $item->product->name }}</strong>
                                        <div style="color: #666; font-size: 13px; margin-top: 5px;">
                                            الكمية: {{ $item->quantity }} × ${{ number_format($item->price, 2) }}
                                        </div>
                                    </div>
                                    <div>
                                        <strong style="color: #007bff; font-size: 16px;">
                                            ${{ number_format($item->total, 2) }}
                                        </strong>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Order Totals -->
                        <div class="order-totals">
                            <div class="total-row" style="display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 16px;">
                                <span>المجموع الفرعي:</span>
                                <span style="font-weight: 600;">${{ number_format($order->subtotal, 2) }}</span>
                            </div>
                            
                            <div class="total-row" style="display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 16px;">
                                <span>الشحن:</span>
                                <span style="font-weight: 600;">${{ number_format($order->shipping, 2) }}</span>
                            </div>
                            
                            <div class="total-row" style="display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 16px;">
                                <span>الضريبة:</span>
                                <span style="font-weight: 600;">${{ number_format($order->tax, 2) }}</span>
                            </div>
                            
                            <hr style="margin: 15px 0; border-top: 2px solid #dee2e6;">
                            
                            <div class="total-row" style="display: flex; justify-content: space-between; margin-bottom: 20px;">
                                <strong style="font-size: 20px;">الإجمالي:</strong>
                                <strong style="font-size: 24px; color: #007bff;">${{ number_format($order->total, 2) }}</strong>
                            </div>

                            <div class="payment-info" style="background: #f8f9fa; padding: 15px; border-radius: 8px; text-align: center;">
                                <p style="margin: 0; color: #666;">طريقة الدفع</p>
                                <p style="margin: 5px 0 0 0; font-size: 18px; font-weight: bold; color: #333;">
                                    {{ $order->payment_method_label }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Next Steps -->
                    <div class="next-steps" style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); margin-top: 30px;">
                        <h4 style="margin-bottom: 20px;">
                            <i class="fa fa-info-circle"></i> ماذا بعد؟
                        </h4>
                        <ul style="list-style: none; padding: 0;">
                            <li style="padding: 10px 0; border-bottom: 1px solid #f0f0f0;">
                                <i class="fa fa-check" style="color: #28a745; margin-left: 10px;"></i>
                                سيتم مراجعة طلبك من قبل فريقنا
                            </li>
                            <li style="padding: 10px 0; border-bottom: 1px solid #f0f0f0;">
                                <i class="fa fa-check" style="color: #28a745; margin-left: 10px;"></i>
                                سنرسل لك رسالة تأكيد على بريدك الإلكتروني
                            </li>
                            <li style="padding: 10px 0; border-bottom: 1px solid #f0f0f0;">
                                <i class="fa fa-check" style="color: #28a745; margin-left: 10px;"></i>
                                يمكنك تتبع حالة الطلب من حسابك
                            </li>
                            <li style="padding: 10px 0;">
                                <i class="fa fa-check" style="color: #28a745; margin-left: 10px;"></i>
                                سيتم التواصل معك قريباً لتأكيد الشحن
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .boxed-btn3 {
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .boxed-btn3:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        @media (max-width: 768px) {
            .order-actions {
                flex-direction: column;
            }
            
            .order-actions a {
                width: 100%;
                text-align: center;
            }
        }
    </style>

</x-front-layout>