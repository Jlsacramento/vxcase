@extends('base')

@section('main')
<div class="row">
    <div class="col-sm-12 mt-3">
    @if(Session::has('mensagem_sucesso'))
        <div class="alert alert-success">
            {{ Session::get('mensagem_sucesso') }}  
        </div>
    @endif
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h1>Vendas</h1>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Cod</th>
                        <th scope="col">Data</th>
                        <th scope="col">Total</th>
                        <th scope="col">Visualizar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sales as $sale)
                    <tr>
                        <th scope="row">{{$sale->ven_id}}</th>
                        <td>{{date('d/m/Y', strtotime($sale->created_at))}} </td>
                        <th scope="row">R$ {{$sale->ven_total}},00</th>
                        <td><a class="btn btn-primary" href="{{ route('vendas.show',$sale->ven_id)}}">Venda</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection