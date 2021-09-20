<form action="{{ route('schoolLogin') }}" method="post">
@csrf
<input type="text" name="email">
<input type="password" name="password">

<input type="submit" value="yuborish">
</form>
<!-- Validation Errors -->
<x-auth-validation-errors class="mb-4" :errors="$errors" />