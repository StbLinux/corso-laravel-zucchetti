@if(session('success'))
    @component('layouts.alerts._alerts_component', ['type' => 'success'])
        {{ session('success') }}
    @endcomponent
@endif

@if(session('notice'))
    @component('layouts.alerts._alerts_component', ['type' => 'warning'])
        {{ session('notice') }}
    @endcomponent
@endif

@if(session('error'))
    @component('layouts.alerts._alerts_component', ['type' => 'danger'])
        {{ session('error') }}
    @endcomponent
@endif
