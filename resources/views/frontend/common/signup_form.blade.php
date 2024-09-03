<form action="{{ route('user.registration') }}" method="POST" id="web_signup">
    @csrf
    <div class="form-group secti-margin1">

        <label for="name" class="title cmmone-class">নাম</label>
        <input type="text" class="form-control" required name="name" id="name" value="{{ old('name') }}"
            placeholder="নাম লিখুন">
    </div>
    <div class="form-group secti-margin1">

        <label for="email" class="sub_title cmmone-class">ইমেইল</label>
        <input type="email" class="form-control" required name="email" id="email" value="{{ old('email') }}"
            placeholder="ইমেইল  লিখুন">
    </div>

    <div class="form-group secti-margin1">
        <label for="phone" class="sub_title cmmone-class">মোবাইল নম্বর</label>

        <div class="input-group">
            <span class="input-group-addon">+88</span>
            <input type="text" class="form-control cmmone-class" name="phone" id="phone"
                value="{{ old('phone') }}" placeholder="মোবাইল নম্বর লিখুন">

        </div>
    </div>
    <div class="form-group secti-margin1">
        <label for="password" class="sub_title cmmone-class">পাসওয়ার্ড</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="পাসওয়ার্ড">


    </div>
    <div class="form-group secti-margin1">
        <label for="password_confirmation" class="sub_title cmmone-class">পাসওয়ার্ড পুনরায় দিন </label>
        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation"
            placeholder="পাসওয়ার্ড">

    </div>
    <div class="form-group secti-margin1">
        <input type="submit" value="সাইন আপ" class="btn btn-success">

    </div>
</form>
