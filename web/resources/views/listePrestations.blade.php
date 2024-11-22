<h1>voici la liste des prestations</h1>

@foreach ($listePresta as $presta)

    <strong> id de la presta :</strong> {{ $presta->service_id}}<br/>
    <strong>titre  : </strong>{{ $presta->title}}<br/>
    <strong>secription : </strong>{{ $presta->descripcion}}<br/>
    <strong>avantage : </strong>{{ $presta->advantage}}<br/>
    <strong>situation : </strong>{{ $presta->situations}}<br/>

@endforeach