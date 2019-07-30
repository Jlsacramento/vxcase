@extends('base')

@section('main')
<div class="row">
    <div class="col-md-12 mt-3">
        <h1>Venda</h1>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Cod</th>
                        <th scope="col">Data da Compra</th>
                        <th scope="col">Data de Entrega</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">{{$sale['ven_id']}}</th>
                        <td>{{date('d/m/Y', strtotime($sale['created_at']))}}</td>
                        <td>{{$entrega}}</td>
                        <td>R$ {{$sale['ven_total']}},00</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h2>Produtos</h2>
        <div class="table-responsive">
        <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Cod</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Preço</th>
                        <th scope="col">Entrega</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($saleProducts as $product)
                    <tr>
                        <th scope="row">{{$product['pro_id']}}</th>
                        <td>{{$product['pro_nome']}}</td>
                        <td>R$ {{$product['pro_preco']}},00</td>
                        <td>{{$product['pro_entrega']}} dias</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection