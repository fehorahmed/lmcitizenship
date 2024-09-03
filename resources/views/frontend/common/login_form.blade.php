<form action="{{ route('login') }}" method="POST">
    @csrf
    <div class="form-group secti-margin1">
        <label for="email" class="title cmmone-class">ইমেইল/মোবাইল</label>
        <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}"
            placeholder="ইমেইল">
    </div>
    <div class="form-group secti-margin1">
        <label for="password" class="title cmmone-class">পাসওয়ার্ড</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="পাসওয়ার্ড">

    </div>


    <div class="form-group secti-margin1">
        <label class="login-bar">
            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
            স্মরণ রাখুন
        </label>
    </div>

    <div class="form-group secti-margin1">

        <input type="submit" value="সাইন ইন" class="btn btn-success">
        <br />
        <a class="btn btn-link" href="{{ url('/reset_password') }}">
            পাসওয়ার্ড ভুলে গিয়ে থাকলে , পুনরায় পাসওয়ার্ড ফেরত নিন
        </a>
    </div>
</form>
