<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login Portal</title>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    height: 100vh;
    display: flex;
}

/* BAGIAN KIRI (GAMBAR) */
.left {
    width: 50%;
    background: url('/images/Logo-Langgeng-Jaya.png') no-repeat center;
    background-size: cover;
}

/* BAGIAN KANAN */
.right {
    width: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(to right, #ffffff 2%, #3E7B27 98%);
}

/* CARD LOGIN */
.login-box {
    width: 320px;
    text-align: center;
}

/* LOGO */
.logo-text {
    font-size: 30px;
    font-weight: bold;
    color: #000000;
    margin-bottom: 15px;
    transform: translateY(-30px); 
}
/* INPUT */
.input-group {
    margin-bottom: 15px;
    text-align: left;
}

.input-group label {
    font-size: 13px;
    color: #666;
}

.input-group input {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ddd;
    border-radius: 4px;
    outline: none;
}

.input-group input:focus {
    border-color: #6c4ccf;
}

/* REMEMBER + BUTTON */
.actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 10px;
}

.actions label {
    font-size: 12px;
    color: #555;
}

.btn {
    padding: 8px 16px;
    border: none;
    background: #00a8ff;
    color: white;
    border-radius: 4px;
    cursor: pointer;
}

.btn:hover {
    background: #0097e6;
}

/* LINK */
.links {
    margin-top: 15px;
    font-size: 12px;
    color: #777;
}

.links a {
    display: block;
    color: #555;
    text-decoration: none;
    margin-top: 5px;
}

.links a:hover {
    text-decoration: underline;
}
</style>

</head>
<body>

<div class="left"></div>

<div class="right">
    <div class="login-box">
        
        <div class="logo-text">Langgeng Jaya</div>
        <form action="{{ route('loginFunction') }}" method="POST">
            @csrf

            <div class="input-group">
                <label>Masukkan PIN</label>
                <input type="password" inputmode="numeric" pattern="[0-9]*" name="password" required>
                
            </div>

            <div class="actions">
                <label>
                    <input type="checkbox"> Remember Me
                </label>
                
                <button type="submit" class="btn">Log In</button>
            </div>
        </form>
        @if($errors->any())
                <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
        @endif

        <div class="links">
            <a href="#">Lost your password?</a>
        </div>

    </div>
</div>

</body>
</html>