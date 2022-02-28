<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <main>
        <div class="row">
            <div class="col-6 padding">
                {{-- <figure> --}}
                <img src="../images/players.jpg" alt="">
                {{-- </figure> --}}

            </div>
            <div class="col-6">
                <nav aria-label="Breadcrumb" class="breadcrumb">
                    <ul>
                        <li><a href="{{ route('user') }}">Accueil</a></li>
                        <li><a href="{{ route('players') }}">Mes joueurs</a></li>
                        <li><span aria-current="page">{{ $player->pseudo }}</span></li>
                    </ul>
                </nav>

                {{--                <p>{{ $player->pseudo }} participe aux championnats : {{ $averagePointsByMatchByChampionship }}</p>--}}
                <div class="d-flex align-items-start">
                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                         aria-orientation="vertical">
                        <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                                aria-selected="true">Statistiques générales
                        </button>
                        @foreach($userChampionships as $userChampionship)
                            <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-profile" type="button" role="tab"
                                    aria-controls="v-pills-profile"
                                    aria-selected="false">{{ $userChampionship->title }}</button>
                        @endforeach
                    </div>
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                             aria-labelledby="v-pills-home-tab">
                            ELO : <br>
                            Score moyen : {{ $avgPointsByMatch[0]->score }}<br>
                            Pourcentage de victoire : : <br>
                            Pourcentage de participation : <br>
                            Nombre de victoires : {{ $totalWins[0]->totalWins }}<br>
                            Nombre de parties jouées : {{ $totalMatchsPlayed[0]->totalMatchsPlayed }}<br>
                            2èmes places : {{ $totalSecondPlace[0]->totalSecondPlace }}<br>
                            3èmes places : {{ $totalThirdPlace[0]->totalThirdPlace }}<br>
                            4èmes places : {{ $totalFourthPlace[0]->totalFourthPlace }}<br>
                            5èmes places : {{ $totalFifthPlace[0]->totalFifthPlace }}<br>
                            6èmes places : {{ $totalSixthPlace[0]->totalSixthPlace }}<br>

                            Place moyenne : {{ $avgPlaceByMatch[0]->place }}<br>
                            Nombre total de points : {{ $sumPoints[0]->totalScore }}<br>

                            Nombre de kills par partie :<br>
                            Nombre total de kills :<br>

                            Classement kills :<br>

                            Cibles favorites :<br>

                            Joueur 3 :<br>
                            Joueur 5 :<br>
                            Joueur 2 :<br>
                            Joueur 6 :<br>
                            Joueur 4 :<br>

                            Meilleurs ennemis :<br>

                            Joueur 4 :<br>
                            Joueur 2 :<br>
                            Joueur 6 :<br>
                            Joueur 3 :<br>
                            Joueur 5 :<br>


                        </div>
                        @foreach($userChampionships as $userChampionship)
                            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                 aria-labelledby="v-pills-profile-tab">...
                            </div>
                        @endforeach
                        {{--    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>--}}
                        {{--    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>--}}
                    </div>
                </div>

                <h1>Les decks de {{ $player->pseudo }}</h1>
                <table class='col-12 bg-main'>
                    <thead class='text-white bg-dark'>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                    </thead>
                    <tbody>
                    @foreach ($decks as $deck)
                        <tr>
                            <td>{{ $deck->id }}</td>
                            <td><a href="{{ route('displayDeckProfile', $deck->id) }}">{{ $deck->title }}</a></td>
                            <td><a href="{{ route('editForm.deck', $deck->id) }}"> modifier</a></td>
                            <td><a href="{{ route('delete.deck', $deck->id) }}"
                                   onclick="
                            var result = alert('Vous ne pouvez pas supprimer ce deck alors que des résultats lui sont associés');return false">supprimer</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <a href="{{ route('form.deck', ['id' => $player->id]) }}">Créer un deck</a>
            </div>
        </div>
    </main>
</x-app-layout>
