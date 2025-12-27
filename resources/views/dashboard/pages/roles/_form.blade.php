<div class="card-body">
    {{-- اسم الدور --}}
    <x-form.input type="text" name="name" placeholder="Enter Role Name" label="Role Name" :value="$role->name" />

    <fieldset class="mt-3">
        <legend>Abilities</legend>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Ability</th>
                    <th class="text-center">{{__('allow')}}</th>
                    <th class="text-center">{{__('deny')}}</th>
                    <th class="text-center">{{__('inhert')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach (config('abilities') as $ability_code => $ability_name)
                    <tr>
                        <td>{{ $ability_name }}</td>
                        <td class="text-center">
                            <input type="radio" name="abilities[{{ $ability_code }}]" value="allow"
                                @checked(($role_abilities[$ability_code] ?? '') == 'allow')>
                        </td>
                        <td class="text-center">
                            <input type="radio" name="abilities[{{ $ability_code }}]" value="deny"
                                @checked(($role_abilities[$ability_code] ?? '') == 'deny')>
                        </td>
                        <td class="text-center">
                            <input type="radio" name="abilities[{{ $ability_code }}]" value="inherit"
                                @checked(($role_abilities[$ability_code] ?? '') == 'inherit')>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </fieldset>
</div>
