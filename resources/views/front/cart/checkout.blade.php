<x-front-layout title="إتمام الطلب">
    
    <!-- Breadcrumb -->
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text text-center">
                        <h3>إتمام الطلب</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Checkout Section -->
    <section class="checkout-section" style="padding: 80px 0; background: #f8f9fa;">
        <div class="container">
            <form id="checkout-form" action="{{ route('orders.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <!-- Billing Details -->
                    <div class="col-lg-7">
                        <div class="checkout-form" style="background: white; padding: 30px; border-radius: 12px; margin-bottom: 30px;">
                            <h4 style="margin-bottom: 25px; padding-bottom: 15px; border-bottom: 2px solid #dee2e6;">
                                <i class="fa fa-user"></i> معلومات الشحن
                            </h4>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="first_name">الاسم الأول <span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', Auth::user()->name ?? '') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="last_name">الاسم الأخير <span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="email">البريد الإلكتروني <span style="color: red;">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', Auth::user()->email ?? '') }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="phone">رقم الهاتف <span style="color: red;">*</span></label>
                                <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone', Auth::user()->phone ?? '') }}" placeholder="+966 5XX XXX XXX" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="address">العنوان <span style="color: red;">*</span></label>
                                <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" placeholder="الشارع، رقم المبنى" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="city">المدينة <span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="postal_code">الرمز البريدي</label>
                                        <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ old('postal_code') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="country">الدولة <span style="color: red;">*</span></label>
                                <select class="form-control" id="country" name="country" required>
                                    <option value="">اختر الدولة</option>
                                    <option value="SA" {{ old('country') == 'SA' ? 'selected' : '' }}>المملكة العربية السعودية</option>
                                    <option value="AE" {{ old('country') == 'AE' ? 'selected' : '' }}>الإمارات العربية المتحدة</option>
                                    <option value="KW" {{ old('country') == 'KW' ? 'selected' : '' }}>الكويت</option>
                                    <option value="QA" {{ old('country') == 'QA' ? 'selected' : '' }}>قطر</option>
                                    <option value="BH" {{ old('country') == 'BH' ? 'selected' : '' }}>البحرين</option>
                                    <option value="OM" {{ old('country') == 'OM' ? 'selected' : '' }}>عمان</option>
                                    <option value="EG" {{ old('country') == 'EG' ? 'selected' : '' }}>مصر</option>
                                    <option value="JO" {{ old('country') == 'JO' ? 'selected' : '' }}>الأردن</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="notes">ملاحظات إضافية (اختياري)</label>
                                <textarea class="form-control" id="notes" name="notes" rows="4" placeholder="ملاحظات حول طلبك، مثل ملاحظات خاصة بالتوصيل">{{ old('notes') }}</textarea>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="payment-method" style="background: white; padding: 30px; border-radius: 12px;">
                            <h4 style="margin-bottom: 25px; padding-bottom: 15px; border-bottom: 2px solid #dee2e6;">
                                <i class="fa fa-credit-card"></i> طريقة الدفع
                            </h4>
                            
                            <div class="form-check mb-3 payment-option" id="cash-option" style="padding: 15px; background: #f8f9fa; border-radius: 8px; border: 2px solid #007bff; cursor: pointer;">
                                <input class="form-check-input payment-radio" type="radio" name="payment_method" id="cash_on_delivery" value="cash" checked>
                                <label class="form-check-label" for="cash_on_delivery" style="cursor: pointer; width: 100%;">
                                    <strong><i class="fa fa-money"></i> الدفع عند الاستلام</strong>
                                    <p style="margin: 5px 0 0 0; font-size: 13px; color: #666;">ادفع نقداً عند استلام الطلب</p>
                                </label>
                            </div>

                            <div class="form-check mb-3 payment-option" id="bank-option" style="padding: 15px; background: #f8f9fa; border-radius: 8px; border: 2px solid transparent; cursor: pointer;">
                                <input class="form-check-input payment-radio" type="radio" name="payment_method" id="bank_transfer" value="bank">
                                <label class="form-check-label" for="bank_transfer" style="cursor: pointer; width: 100%;">
                                    <strong><i class="fa fa-bank"></i> تحويل بنكي</strong>
                                    <p style="margin: 5px 0 0 0; font-size: 13px; color: #666;">قم بالتحويل إلى حسابنا البنكي</p>
                                </label>
                            </div>

                            <div class="form-check payment-option" id="card-option" style="padding: 15px; background: #f8f9fa; border-radius: 8px; border: 2px solid transparent; cursor: pointer;">
                                <input class="form-check-input payment-radio" type="radio" name="payment_method" id="credit_card" value="card">
                                <label class="form-check-label" for="credit_card" style="cursor: pointer; width: 100%;">
                                    <strong><i class="fa fa-credit-card"></i> بطاقة الائتمان / الخصم</strong>
                                    <p style="margin: 5px 0 0 0; font-size: 13px; color: #666;">ادفع باستخدام Visa, Mastercard</p>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="col-lg-5">
                        <div class="order-summary" style="background: white; padding: 30px; border-radius: 12px; position: sticky; top: 20px;">
                            <h4 style="margin-bottom: 25px; padding-bottom: 15px; border-bottom: 2px solid #dee2e6;">
                                <i class="fa fa-shopping-bag"></i> ملخص الطلب
                            </h4>
                            
                            <div class="order-items" style="margin-bottom: 20px; max-height: 300px; overflow-y: auto;">
                                @foreach($cartItems as $item)
                                    <div class="order-item" style="display: flex; justify-content: space-between; align-items: center; padding: 15px 0; border-bottom: 1px solid #f0f0f0;">
                                        <div style="flex: 1;">
                                            <strong style="font-size: 15px;">{{ $item->book->name ?? 'كتاب' }}</strong>
                                            <div style="color: #666; font-size: 13px; margin-top: 5px;">
                                                الكمية: <span style="font-weight: 600;">{{ $item->quantity }}</span> × 
                                                <span style="font-weight: 600;">${{ number_format($item->book->price ?? 0, 2) }}</span>
                                            </div>
                                        </div>
                                        <div>
                                            <strong style="color: #007bff; font-size: 16px;">${{ number_format($item->quantity * ($item->book->price ?? 0), 2) }}</strong>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="order-totals" style="padding: 20px 0;">
                                <div class="total-row" style="display: flex; justify-content: space-between; margin-bottom: 15px; font-size: 16px;">
                                    <span>المجموع الفرعي:</span>
                                    <span style="font-weight: 600;">${{ number_format($total, 2) }}</span>
                                </div>
                                
                                <div class="total-row" style="display: flex; justify-content: space-between; margin-bottom: 15px; font-size: 16px;">
                                    <span>الشحن:</span>
                                    <span style="color: #28a745; font-weight: 600;">مجاني</span>
                                </div>
                                
                                <div class="total-row" style="display: flex; justify-content: space-between; margin-bottom: 15px; font-size: 16px;">
                                    <span>الضريبة:</span>
                                    <span>$0.00</span>
                                </div>
                                
                                <hr style="margin: 20px 0; border-top: 2px solid #dee2e6;">
                                
                                <div class="total-row" style="display: flex; justify-content: space-between; margin-bottom: 25px;">
                                    <strong style="font-size: 20px;">الإجمالي:</strong>
                                    <strong style="font-size: 26px; color: #007bff;">${{ number_format($total, 2) }}</strong>
                                </div>
                            </div>

                            <!-- زر الإرسال البسيط -->
                            <button type="submit" onclick="this.disabled=true;this.innerHTML='جاري إنشاء الطلب...';this.form.submit();" class="boxed-btn3" style="width: 100%; display: block; text-align: center; padding: 15px; font-size: 18px; font-weight: 600; border: none; cursor: pointer;">
                                <i class="fa fa-check-circle"></i> تأكيد الطلب وإنشاء الطلب
                            </button>

                            <div style="margin-top: 20px; padding: 15px; background: #f8f9fa; border-radius: 8px; text-align: center;">
                                <i class="fa fa-shield" style="color: #28a745; font-size: 32px; margin-bottom: 10px;"></i>
                                <p style="margin: 0; font-size: 13px; color: #666; font-weight: 600;">معاملات آمنة ومشفرة 100%</p>
                                <p style="margin: 5px 0 0 0; font-size: 12px; color: #999;">بياناتك محمية بأعلى معايير الأمان</p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- JavaScript البسيط فقط للتصميم -->
    <script>
        // فقط لتغيير مظهر خيارات الدفع
        document.querySelectorAll('.payment-radio').forEach(radio => {
            radio.addEventListener('change', function() {
                // إزالة الحدود من جميع الخيارات
                document.querySelectorAll('.payment-option').forEach(option => {
                    option.style.border = '2px solid transparent';
                    option.style.background = '#f8f9fa';
                });
                
                // إضافة حد للخيار المحدد
                const selectedOption = this.closest('.payment-option');
                if (selectedOption) {
                    selectedOption.style.border = '2px solid #007bff';
                    selectedOption.style.background = '#f0f7ff';
                }
            });
        });
    </script>

</x-front-layout>