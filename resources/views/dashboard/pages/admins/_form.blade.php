<div class="card-body">

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <x-form.input
      type="text"
      name="name"
      placeholder="Enter Name"
      label="Name"
      :value="old('name', $admin->name)"
  />

  @php
    $defaultEmail = old('email', $admin->exists ? $admin->email : 'admin@gmail.com');
  @endphp
  <x-form.input
      type="email"
      name="email"
      placeholder="Enter Email"
      label="Email"
      :value="$defaultEmail"
  />

  @php
    $defaultPassword = old('password', $admin->exists ? '' : '123456789');
  @endphp
  <x-form.input
      type="password"
      name="password"
      placeholder="{{ $admin->exists ? 'Leave blank to keep current password' : 'Enter Password' }}"
      label="Password"
      :value="$defaultPassword"
  />

  @php
    $selectedRoles = old('roles', $admin_roles ?? []);
  @endphp
  
  <div class="form-group mt-3">
    <label class="d-block mb-2">Roles</label>
    <div class="border rounded p-2" style="max-height:220px;overflow:auto;">
      @foreach ($roles as $role)
        <div class="form-check">
          <input
            class="form-check-input"
            type="checkbox"
            id="role_{{ $role->id }}"
            name="roles[]"
            value="{{ $role->id }}"
            @checked(in_array($role->id, $selectedRoles))
            style="
              width: 18px !important;
              height: 18px !important;
              cursor: pointer !important;
              appearance: auto !important;
              -webkit-appearance: checkbox !important;
              -moz-appearance: checkbox !important;
              position: relative !important;
              z-index: 1 !important;
              opacity: 1 !important;
              visibility: visible !important;
            "
          >
          <label class="form-check-label" for="role_{{ $role->id }}" style="margin-right: 10px; cursor: pointer;">
            {{ $role->name }}
          </label>
        </div>
      @endforeach
    </div>
    @error('roles')
      <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
  </div>

</div>

<style>
  /* إضافة CSS لتحسين مظهر checkboxes */
  .form-check-input {
    width: 18px !important;
    height: 18px !important;
    margin-left: 8px !important;
    margin-top: 0.3em !important;
    cursor: pointer !important;
    appearance: auto !important;
    -webkit-appearance: checkbox !important;
    -moz-appearance: checkbox !important;
    position: relative !important;
    z-index: 1 !important;
    opacity: 1 !important;
    visibility: visible !important;
    border: 2px solid #6b7280 !important;
    border-radius: 4px !important;
    background-color: white !important;
  }
  
  .form-check-input:checked {
    background-color: #3b82f6 !important;
    border-color: #3b82f6 !important;
    position: relative !important;
  }
  
  .form-check-input:checked::after {
    content: '✓' !important;
    position: absolute !important;
    color: white !important;
    font-size: 14px !important;
    font-weight: bold !important;
    top: 50% !important;
    left: 50% !important;
    transform: translate(-50%, -50%) !important;
  }
  
  .form-check-label {
    cursor: pointer !important;
    padding-right: 8px !important;
    user-select: none !important;
  }
  
  .form-check {
    display: flex !important;
    align-items: center !important;
    margin-bottom: 8px !important;
    padding: 8px 12px !important;
    border-radius: 6px !important;
    transition: background-color 0.2s !important;
  }
  
  .form-check:hover {
    background-color: #f3f4f6 !important;
  }
</style>