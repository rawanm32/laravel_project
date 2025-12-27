@extends('layouts.dashboard')

@section('title')
{{__('Admins')}} 
@endsection
@section('content')
<div class="content books-management-page">
    <div class="container-fluid">
        
        <!-- Search Form Section -->
        <form action="{{ URL::current() }}" method="GET" class="search-form-container">
            <div class="search-card">
                <div class="search-header">
                    <i class="material-icons">filter_list</i>
                    <h3>{{__('Filter')}}</h3>
                </div>
                
                <div class="search-fields">
                    <div class="field-wrapper">
                        <div class="field-icon">
                            <i class="material-icons">{{__('Search')}}</i>
                        </div>
                        <x-form.input 
                            type="text" 
                            name="name" 
                            placeholder="{{__('name')}}" 
                            label="Name" 
                            value="{{ request('name') }}"  
                        />
                    </div>
                    
                    <div class="field-wrapper">
                        <div class="field-icon">
                            <i class="material-icons">check_circle</i>
                        </div>
                        <x-form.select 
                            name="status" 
                            :label="__('Status')" 
                            :options="['' => __('Status'), 'active' => __('Available'), 'inactive' => __('Unavailable')]" 
                            :selected="request('status')"
                        /> 
                    </div>

                    <div class="buttons-wrapper">
                        <button type="submit" class="btn-search-modern">
                            <i class="material-icons">{{__('Search')}}</i> 
                            <span>{{__('Search')}}</span>
                        </button>
                        <a href="{{ route('dashboard.books.index') }}" class="btn-cancel-modern">
                            <i class="material-icons">refresh</i>
                            <span>{{__('Cancel')}}</span>
                        </a>
                    </div>
                </div>
            </div>
        </form>

        <!-- Books Table Section -->
        <div class="row">
            <div class="col-md-12">
                <div class="card modern-card">
                    <div class="card-header modern-header">
                        <div class="header-left">
                            <div class="header-icon-wrapper">
                                <i class="material-icons">{{__('Books')}}</i>
                            </div>
                        
                        </div>
                        <div class="header-right">
                            <div class="total-badge">
                                <i class="material-icons">auto_stories</i>
                               
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body modern-body">
                        <x-alert/> 
                        
                        <div class="add-button-wrapper">
                            <a href="{{ route('admins.create') }}" class="btn-add-modern">
                                <i class="material-icons">add_circle_outline</i> 
                                <span>{{__('Add')}}</span>
                                <div class="button-shine"></div>
                            </a>
                        </div>
        
                        <div class="table-responsive modern-table-wrapper">
                            <table class="table modern-table">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="th-inner">
                                              
                                                <span>{{__('id')}}</span>
                                            </div>
                                        </th> 
                                        <th>
                                            <div class="th-inner"> 
                                            
                                           
                                                <span>{{__('name')}}</span>
                                            </div>
                                        </th>
                                       
                                      
                                        <th>
                                            <div class="th-inner">
                                            
                                                <span>{{__('Roles')}}</span>
                                            </div>
                                        </th>
                                        <th class="text-right" >
                                            <div class="th-inner">
                                                <i class="material-icons">settings</i>
                                                <span>{{__('Actions')}}</span>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($admins as $admin)
                                    <tr class="table-row-hover">
                                        <td>
                                          {{$admin->id}}
                                        </td>
                                      
                                        <td>
                                            {{ $admin->name }}
                                        </td>
                                        
                                        <td>
                                            
                                           
                                                <span>{{ $admin->roles->pluck('name')->join(', ') }}</span>
              
                                        </td>
                                 
                                       
                                        
                                        <td class="td-actions text-right"  >
                                            <div class="action-buttons-group">
                                                <a href="{{ route('admins.edit', $admin->id) }}" 
                                                   class="action-btn edit-btn"
                                                   title="تعديل">
                                                    <i class="material-icons">edit</i>
                                                </a>

                                                <form action="{{ route('admins.destroy', $admin->id) }}" 
                                                      method="POST" 
                                                      style="display:inline-block; margin: 0;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="action-btn delete-btn" 
                                                            title="{{__('Delete')}}"
                                                            onclick="return confirm('هل أنت متأكد من حذف الكتاب {{ $admin->name }}؟')">
                                                        <i class="material-icons">delete</i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                 
                        <div class="pagination-container">
                       
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* ============================================
   BOOKS MANAGEMENT PAGE STYLES
   ============================================ */

.books-management-page {
    padding: 25px 0;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: 100vh;
}

/* Search Form */
.search-form-container {
    margin-bottom: 25px;
}

.search-card {
    background: white;
    border-radius: 20px;
    padding: 25px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    animation: slideDown 0.4s ease-out;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.search-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid #f3f4f6;
}

.search-header i {
    font-size: 26px;
    color: #667eea;
}

.search-header h3 {
    font-size: 20px;
    font-weight: 700;
    color: #1f2937;
    margin: 0;
}

.search-fields {
    display: grid;
    grid-template-columns: 1fr 1fr auto;
    gap: 20px;
    align-items: end;
}

.field-wrapper {
    position: relative;
}

.field-icon {
    position: absolute;
    top: 38px;
    right: 12px;
    z-index: 1;
    color: #9ca3af;
}

.field-icon i {
    font-size: 20px;
}

.buttons-wrapper {
    display: flex;
    gap: 10px;
}

.btn-search-modern,
.btn-cancel-modern {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 12px 22px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 14px;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
}

.btn-search-modern {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}

.btn-search-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
}

.btn-cancel-modern {
    background: #f3f4f6;
    color: #6b7280;
}

.btn-cancel-modern:hover {
    background: #e5e7eb;
    color: #374151;
}

/* Modern Card */
.modern-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    border: none;
    overflow: hidden;
    animation: fadeIn 0.5s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.modern-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 25px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border: none;
}

.header-left {
    display: flex;
    align-items: center;
    gap: 18px;
}

.header-icon-wrapper {
    width: 55px;
    height: 55px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
}

.header-icon-wrapper i {
    font-size: 30px;
    color: white;
}

.header-text .card-title {
    font-size: 22px;
    font-weight: 700;
    color: white;
    margin: 0 0 5px 0;
}

.card-subtitle {
    font-size: 13px;
    color: rgba(255, 255, 255, 0.9);
    margin: 0;
}

.total-badge {
    background: rgba(255, 255, 255, 0.2);
    padding: 12px 20px;
    border-radius: 12px;
    backdrop-filter: blur(10px);
    display: flex;
    align-items: center;
    gap: 8px;
    color: white;
    font-weight: 700;
    font-size: 18px;
}

.total-badge i {
    font-size: 22px;
}

/* Card Body */
.modern-body {
    padding: 30px;
}

/* Add Button */
.add-button-wrapper {
    margin-bottom: 25px;
}

.btn-add-modern {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 13px 26px;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    border-radius: 14px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
}

.btn-add-modern:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(16, 185, 129, 0.5);
    color: white;
}

.button-shine {
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: left 0.6s;
}

.btn-add-modern:hover .button-shine {
    left: 100%;
}

/* Table */
.modern-table-wrapper {
    border-radius: 14px;
    overflow: hidden;
    border: 1px solid #e5e7eb;
}

.modern-table {
    margin: 0;
    background: white;
}

.modern-table thead {
    background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
}

.modern-table thead th {
    padding: 16px 14px;
    font-weight: 700;
    color: #1f2937;
    border-bottom: 2px solid #667eea;
    text-transform: uppercase;
    font-size: 12px;
    letter-spacing: 0.5px;
}

.th-inner {
    display: flex;
    align-items: center;
    gap: 8px;
}

.th-inner i {
    font-size: 18px;
    color: #667eea;
}

.table-row-hover {
    transition: all 0.3s ease;
    border-bottom: 1px solid #f3f4f6;
}

.table-row-hover:hover {
    background: linear-gradient(90deg, rgba(102, 126, 234, 0.04), transparent);
    transform: scale(1.01);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
}

.modern-table tbody td {
    padding: 14px;
    vertical-align: middle;
}

/* Book Image */
.image-container {
    width: 55px;
    height: 75px;
    border-radius: 8px;
    overflow: hidden;
    position: relative;
    cursor: pointer;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.book-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.image-container:hover .book-image {
    transform: scale(1.1);
}

.image-hover-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.image-container:hover .image-hover-overlay {
    opacity: 1;
}

.image-hover-overlay i {
    color: white;
    font-size: 24px;
}

.no-image-placeholder {
    width: 55px;
    height: 75px;
    background: linear-gradient(135deg, #e5e7eb 0%, #d1d5db 100%);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.no-image-placeholder i {
    color: #9ca3af;
    font-size: 26px;
}

/* Book Info */
.book-title-text {
    font-weight: 600;
    color: #1f2937;
    font-size: 15px;
}

.author-cell {
    display: flex;
    align-items: center;
    gap: 6px;
    color: #6b7280;
    font-size: 14px;
}

.author-cell i {
    font-size: 18px;
    color: #667eea;
}

.category-tag {
    display: inline-block;
    padding: 6px 14px;
    background: linear-gradient(135dg, #ddd6fe 0%, #c7d2fe 100%);
    color: #5b21b6;
    border-radius: 18px;
    font-size: 13px;
    font-weight: 600;
}

/* Price */
.price-wrapper {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.old-price {
    color: #9ca3af;
    text-decoration: line-through;
    font-size: 12px;
}

.new-price {
    font-size: 16px;
    font-weight: 700;
    color: #10b981;
}

.discount-badge {
    display: inline-block;
    padding: 2px 8px;
    background: linear-gradient(135deg, #fca5a5 0%, #f87171 100%);
    color: white;
    border-radius: 8px;
    font-size: 10px;
    font-weight: 700;
    width: fit-content;
}

.normal-price {
    font-size: 16px;
    font-weight: 700;
    color: #1f2937;
}

/* Action Buttons */
.action-buttons-group {
    display: flex;
    gap: 8px;
    justify-content: flex-end;
}

.action-btn {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
}

.edit-btn {
    background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
    color: white;
    box-shadow: 0 3px 10px rgba(251, 191, 36, 0.3);
}

.edit-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 18px rgba(251, 191, 36, 0.4);
    color: white;
}

.delete-btn {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    color: white;
    box-shadow: 0 3px 10px rgba(239, 68, 68, 0.3);
}

.delete-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 18px rgba(239, 68, 68, 0.4);
}

.action-btn i {
    font-size: 19px;
}

/* Pagination */
.pagination-container {
    margin-top: 25px;
    display: flex;
    justify-content: center;
}

/* Responsive */
@media (max-width: 992px) {
    .search-fields {
        grid-template-columns: 1fr;
    }
    
    .buttons-wrapper {
        width: 100%;
    }
    
    .btn-search-modern,
    .btn-cancel-modern {
        flex: 1;
        justify-content: center;
    }
}

@media (max-width: 768px) {
    .modern-header {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
    
    .header-left {
        flex-direction: column;
    }
}
</style>

@endsection