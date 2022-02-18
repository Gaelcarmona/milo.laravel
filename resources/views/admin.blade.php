<x-app-layout>
    <x-slot name="header">


        <header class='header bg-dark py-3 text-white'>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3">
                        <figure>
                            <img src="images/frame57.svg">
                        </figure>
                    </div>
                    <div class="col-9">
                        <nav class='navbar navbar-expand-lg'>
                            <ul class='navbar-nav me-right  mb-2 mb-lg-0'>
                                <li class='nav-item'>
                                    <a class='nav-link'>Statistiques</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link'>Se connecter</a>
                                </li>

                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <body>
        <main>
            <h1>Panel admin</h1>
            <h2>Les users</h2>
            <table>
                <thead>
                <th>id</th>
                <th>pseudo</th>
                <th>email</th>
                <th>image_id</th>
                <th>éditer</th>
                <th>supprimer</th>
                </thead>

                <tbody>
                <?php $users = User::all() ?>
                @foreach ($users as $user)


                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->pseudo}}</td>
                        <td>{{$user->email}}</td>
                        <td><img src="{{$user->image_id}}"></td>
                        <td><a href="{{ route('user.edit', $user->id) }}"> modifier</a></td>
                        <td><a href="{{ route('user.delete', $user->id) }}">supprimer</a></td>
                    </tr>

                @endforeach

                </tbody>

            </table>
            <a href="{{ route('register') }}">Créer un user</a>
        </main>
        </body>
        <footer class='footer navbar bottom bg-dark  text-white py-3'>
            <p class='mx-auto'>Formation développeur Web - Gaël Carmona</p>
        </footer>
    </x-slot>

</x-app-layout>
