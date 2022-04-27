<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
        <title>Github Tag</title>
    </head>
    <body>
        <nav class="navbar navbar-dark bg-primary w-100">
            <a class="navbar-brand" href="{{route('home')}}">
                Github TAG
            </a>
        </nav>
        <div class="container">
            <div>
                <form method="GET" action="{{route('search')}}">
                    <div class="row">
                        <div class="form-group mt-5 col-11 mr-3 p-0">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Github username" value="{{isset($user) ? $user->login : ''}}">
                        </div>
        
                        <div class="form-group mt-5 col p-0">
                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>

            @isset($histories)
                <div id="last_search">
                    <div class="container">
                        <div class="row ">
                            @forelse ($histories as $history)
                                <div class="mr-1">
                                    <a href="http://localhost:8000/search?username={{$history->username}}">
                                        <img src="{{$history->avatar_url}}" width="80px" height="80px" alt="{{$history->username}}">
                                    </a>
                                </div>
                            @empty
                                <p>Não há histórico de buscas.</p>
                            @endforelse 
                        </div>
                    </div>
                </div>
            @endisset

            <div id="data">
                @isset($user)
                <div class="row">
                    <div class="card" style="width: 20%;">
                        <img src="{{$user->avatar_url}}" class="card-img-top" alt="{{$user->login}}">
                    </div>
                    
                    <div class="card" style="width: 80%;">
                        <div class="card-body">
                            <h5 class="card-title">{{$user->name}}
                                <span class="badge badge-info">{{$user->login}}</span>
                            </h5>
                            <p class="card-text">{{$user->bio}}</p>
                            <p class="card-text">{{$user->public_repos}} repositórios públicos</p>
                            <a href="{{$user->html_url}}" class="btn w-100 btn-primary">Visitar Perfil</a>
                        </div>
                    </div>
                </div>
                @endisset
            </div>
            <br>
            <div id="repos">
                @isset($repositories)
                <div class="container">
                    <div class="row">
                        @forelse ($repositories as $repository)
                        <div class="card" style="width: 17rem; margin: 2px;">
                            <div class="card-body">
                                <h5 class="card-title">{{$repository->name}}</h5>
                                <p class="card-text">{{$repository->description}}</p>
                                @foreach ($repository->topics as $topic)
                                    <span class="badge badge-info">{{$topic}}</span>
                                @endforeach
                                
                                <br><br>
                                <a href="{{$repository->html_url}}" class="card-link" style="position: absolute; bottom: 0; margin-bottom: 10px">Ver Repositório</a>
                            </div>
                        </div>
                        @empty
                            <p>Este usuário não possui repostórios públicos.</p>
                        @endforelse
                    </div>
                </div>
                @endisset
            </div>
        </div>
    </body>
</html>
