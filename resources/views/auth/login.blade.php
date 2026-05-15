<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow p-4" style="width: 100%; max-width: 400px;">


            <form method="post" role="form" action="/login">
                @csrf
                <h2 class="text-center mb-4"> Inicie sesion</h2>

                <div class="mb-3">
                    <label class='form-label' htmlFor="">Correo: </label>
                    <input class="form-control @error('email') input-error @enderror" type='email' name='email' id='email' />
                    @error('email')
                        <div class="label -mt-4 mb-2">
                            <span class="label-text-alt text-error">{{ $message }} - (Correo: ras@gmail.com)</span>
                        </div>
                    @enderror

                    <label class='form-label' htmlFor="">Contraseña: </label>
                    <input class="form-control @error('password') input-error @enderror" type="text" name='password' id='password' />
                    @error('password')
                        <div class="label -mt-4 mb-2">
                            <span class="label-text-alt text-error">{{ $message }} - (Contraseña: prueba)</span>
                        </div>
                    @enderror
                </div>

                <input type="submit" value="Ingresar" class="btn btn-primary full-width" />
            </form>
        </div>
    </div>
</body>

</html>
