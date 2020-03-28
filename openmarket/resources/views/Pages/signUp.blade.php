@extends('Layouts.firstLayout')

@section('content')
    <form action="server.php" method="post">
            
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username">
            </div>
            <div class="input-group">
                <label>Firstname</label>
                <input type="text" name="firstname">
            </div>
            <div class="input-group">
                <label>lastname</label>
                <input type="text" name="lastname">
            </div>
            <div class="input-group">
                <label>email</label>
                <input type="text" name="email">
            </div>
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password_1">
            </div>
                    <div class="input-group">
                <label>Comfirm Password</label>
                <input type="password" name="password_2">
            </div>
            <div class="input-group">
                <button type="submit" name="register" class="btn" >Register&raquo;</button>
            </div>
            <p> already a member? <a href="/">sign in</a></p>
    </form>
@endsection