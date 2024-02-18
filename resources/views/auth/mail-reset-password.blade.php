<div class="card d-flex justify-content-center text-center">
    <div class="card-header">
        Cloudy
    </div>
    <div class="card-body">
        <h5 class="card-title text-xl">We receive a request to reset your password</h5>
        <p class="card-text">Use the link below to set up a new password for your account. <br>
            if you didn't request to reset password, ignore this <br>
            email and teh link will expire on its own.</p>
        <a href="{{ route('validation-forgot-password', ['token' => $token]) }}" class="btn btn-warning">SET NEW PASSWORD</a>
    </div>
</div>
