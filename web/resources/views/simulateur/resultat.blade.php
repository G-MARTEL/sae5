

<h1>Résultats de la simulation</h1>
<ul>
    <li>Capital emprunté : {{ number_format($resultat['capital_emprunte'], 2) }} €</li>
    <li>Mensualité hors assurance : {{ number_format($resultat['mensualite'], 2) }} €</li>
    <li>Total des intérêts : {{ number_format($resultat['total_interets'], 2) }} €</li>
    <li>Mensualité avec assurance : {{ number_format($resultat['mensualite_totale'], 2) }} €</li>
</ul>
<a href="{{ route('simulateur') }}">Faire une nouvelle simulation</a>

