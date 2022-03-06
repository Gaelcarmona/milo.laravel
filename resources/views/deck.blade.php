<x-app-layout>
    <x-slot name="header">
    </x-slot>
        <nav aria-label="Breadcrumb" class="breadcrumb">
            <ul>
                <li><a href="{{ route('user') }}">Accueil</a></li>
                <li><a href="{{ route('players') }}">Mes joueurs</a></li>
                <li>
                    <a href="{{ route('displayPlayerProfile', $deck->user_id) }}">{{ $deck->user->pseudo }}</a>
                </li>
                <li><span aria-current="page">{{ $deck->title }}</span>
                </li>
            </ul>
        </nav>
        <p>hello</p>
        <p>Coucou je suis le deck "{{ $deck->title }}"</p>
        <p>Mon id est le {{ $deck->id }}</p>
        <p>j'ai été créé le {{ $deck->created_at }}</p>
        <p>mon propriétaire a pour id le n° {{ $deck->user_id }}</p>
</x-app-layout>
