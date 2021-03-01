<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/user_login.css') }}">
</head>
<body>
    <section>
      <div class="container">
        <div class="user signinBx">
          <div class="imgBx"><img src="https://raw.githubusercontent.com/WoojinFive/CSS_Playground/master/Responsive%20Login%20and%20Registration%20Form/img1.jpg" alt="" /></div>
          <div class="formBx">
            <form action="{{ route('user.register') }}" method="post">
                @csrf
                    @if(Session::has('msg'))
                        <h5 class="small text-center text-success">Account successfully register</h5>
                    @endif
              <h2>Sign Up</h2>
              <input type="text" name="name" placeholder="Name" />
              <input type="text" name="contact" placeholder="Contact" />
              <input type="text" name="email" placeholder="Email" />
              <input type="password" name="password" placeholder="Password" />
              <input type="password" name="password_confirmation" placeholder="Confirm Password" />
              <input type="submit" name="signup" value="SIGN UP" />
              <p class="signup">
                ALREADY HAVE AN ACCOUNT ? SIGN IN.
                <a href="{{ route('user.login') }}">Sign Up.</a>
              </p>
            </form>
          </div>
        </div>
        
      </div>
    </section>
  </body>
  
</html>