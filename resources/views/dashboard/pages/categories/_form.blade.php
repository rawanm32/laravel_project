<div class="card-body">
    <!-- Tabs for languages -->
    <ul class="nav nav-tabs" id="languageTabs" role="tablist">
        @foreach(config('app.available_locales', ['en', 'ar']) as $index => $locale)
            <li class="nav-item">
                <a class="nav-link {{ $index === 0 ? 'active' : '' }}" 
                   id="{{ $locale }}-tab" 
                   data-toggle="tab" 
                   href="#{{ $locale }}" 
                   role="tab">
                    {{ strtoupper($locale) }}
                </a>
            </li>
        @endforeach
    </ul>

    <div class="tab-content mt-3" id="languageTabsContent">
        @foreach(config('app.available_locales', ['en', 'ar']) as $index => $locale)
            <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" 
                 id="{{ $locale }}" 
                 role="tabpanel">
                
                <!-- Name Field -->
                <div class="form-group">
                    <label>{{ __('name') }}</label>
                    <input type="text" 
                           name="name_{{ $locale }}" 
                           class="form-control" 
                           placeholder="{{ __('Enter name') }}" 
                           value="{{ old('name_'.$locale, $category->exists ? $category->getTranslation('name', $locale) : '') }}">
                </div>

                <!-- Description Field -->
                <div class="form-group">
                    <label>{{ __('Description') }} ({{ strtoupper($locale) }})</label>
                    <textarea name="description_{{ $locale }}" 
                              class="form-control" 
                              rows="4">{{ old('description_'.$locale, $category->exists ? $category->getTranslation('description', $locale) : '') }}</textarea>
                </div>
            </div>
        @endforeach
    </div>

 

    <!-- Status -->
    <x-form.select 
        name="status" 
        label="Status" 
        :options="['active' => 'Active', 'inactive' => 'Inactive']" 
        :selected="$category->status ?? 'active'" 
    />
</div>

@push('scripts')
<script>
    // Optional: Auto-fill first language to others if needed
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Translation form loaded');
    });
</script>
@endpush