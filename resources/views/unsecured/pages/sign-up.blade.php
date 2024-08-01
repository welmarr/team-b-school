@if (session('page_need') == 'login-success')
    @include('unsecured.includes.sign-up.account-created')
@else
    @include('unsecured.includes.sign-up.form-page')
@endif
