@extends('base')

@section('main')
<div class="row">
    <div class="col-md-12 mt-3">
        <h2>Produtos</h2>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Cod</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Preço</th>
                        <th scope="col">Entrega</th>
                        <th scope="col">Carrinho</th>
                    </tr>
                </thead>
                <tbody id="tabela-produtos">
                    @foreach($products as $key => $product)
                    <tr>
                        <th id="tab_pro_id_{{$key}}" scope="row">{{$product->pro_id}}</th>
                        <td id="tab_pro_nome_{{$key}}">{{$product->pro_nome}}</td>
                        <td id="tab_pro_preco_{{$key}}">R$ {{$product->pro_preco}},00</td>
                        <td id="tab_pro_entrega_{{$key}}">{{$product->pro_entrega}} dias</td>
                        <td><button id="buy" class="btn btn-primary" onclick="adicionarProduto(event, {{$key}})">Adicionar</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<form method="post" action="{{ route('vendas.store') }}">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <h1>Fazer Pedido</h1>
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
                    <tbody id="tabela-vendas">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>    
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary mb-3">FECHAR VENDA</button>
        </div>
    </div>
</form>
@if ($errors->any())
    <div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    </div><br />
@endif
@endsection

@section('post-script')
    <script>
        function adicionarProduto(e, key) {
            var proId = $('#tab_pro_id_'+key+'').text();
            var proNome = $('#tab_pro_nome_'+key+'').text();
            var proPreco = $('#tab_pro_preco_'+key+'').text();
            var proEntrega = $('#tab_pro_entrega_'+key+'').text();            

            $('#tabela-vendas').append('<tr><td><input class="form-control" type="text" name="pro_id[]" value="'+proId+'" readonly></td><td><input class="form-control" type="text" name="pro_nome[]" value="'+proNome+'" readonly></td><td><input class="form-control" type="text" name="pro_preco[]" value="'+proPreco+'" readonly></td><td><input class="form-control" type="text" name="pro_entrega[]" value="'+proEntrega+'" readonly></td></tr>');
        }
    </script>
@endsection